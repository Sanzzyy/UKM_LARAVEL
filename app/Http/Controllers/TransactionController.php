<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'customer', 'transactionDetails.menu'])
            ->latest()
            ->paginate(20)
            ->onEachSide(2); // jumlah angka di kiri & kanan halaman aktif

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $menus = Menu::where('is_available', true)
            ->with('category')
            ->orderBy('category_id')
            ->get();

        $customers = Customer::all();

        return view('transactions.create', compact('menus', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',

            'customer_name' => 'required_without:customer_id|string|max:255',
            'customer_phone' => 'nullable|string|max:20',

            'payment_method' => 'required|in:cash,transfer,qris',
            'paid_amount' => 'required|numeric|min:0',

            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);




        DB::beginTransaction();
        try {
            // Create or get customer
            if (empty($validated['customer_id'])) {
                $customer = Customer::create([
                    'name' => $validated['customer_name'],
                    'phone' => $validated['customer_phone'] ?? null,
                ]);

                $validated['customer_id'] = $customer->id;
            }


            // Calculate total
            $totalAmount = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $subtotal = $menu->price * $item['quantity'];
                $totalAmount += $subtotal;

                $itemsData[] = [
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                    'notes' => $item['notes'] ?? null,
                ];
            }

            // Validasi jika uang kurang
            if ($validated['paid_amount'] < $totalAmount) {
                return back()->withErrors([
                    'paid_amount' => 'Uang dibayar tidak mencukupi'
                ])->withInput();
            }

            // Create transaction
            $transaction = Transaction::create([
                'transaction_code' => 'TRX-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
                'user_id' => Auth::id(),
                'customer_id' => $validated['customer_id'],
                'total_amount' => $totalAmount,
                'paid_amount' => $validated['paid_amount'],
                'change_amount' => $validated['paid_amount'] - $totalAmount,
                'payment_method' => $validated['payment_method'],
            ]);

            // Create transaction details
            foreach ($itemsData as $itemData) {
                $transaction->transactionDetails()->create($itemData);
            }

            DB::commit();

            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'customer', 'transactionDetails.menu']);
        return view('transactions.show', compact('transaction'));
    }
}
