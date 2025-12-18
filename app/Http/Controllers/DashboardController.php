<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total data
        $totalMenus = Menu::count();
        $totalTransactions = Transaction::count();
        $totalCustomers = Customer::count();
        $totalRevenue = Transaction::sum('total_amount');

        // Hari ini
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->count();
        $todayRevenue = Transaction::whereDate('created_at', Carbon::today())->sum('total_amount');

        // Menu terpopuler
        $popularMenus = TransactionDetail::select(
            'menus.name',
            DB::raw('SUM(transaction_details.quantity) as total_sold')
        )
            ->join('menus', 'transaction_details.menu_id', '=', 'menus.id')
            ->groupBy('menus.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Transaksi terbaru
        $recentTransactions = Transaction::with(['customer', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        // =======================
        // GRAPH PENDAPATAN
        // =======================

        // ---------- DAILY (per jam hari ini) ----------
        $daily = Transaction::selectRaw('HOUR(created_at) as hour, SUM(total_amount) as total')
            ->whereDate('created_at', Carbon::today())
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $dailyLabels = $daily->pluck('hour')
            ->map(fn($h) => sprintf('%02d:00', $h))
            ->toArray();

        $dailyData = $daily->pluck('total')->toArray();


        // ---------- WEEKLY (Senin - Minggu) ----------
        $weeklyRaw = Transaction::selectRaw('
        DAYOFWEEK(created_at) as day_num,
        SUM(total_amount) as total
    ')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->groupBy('day_num')
            ->orderBy('day_num')
            ->get();

        $dayMap = [
            1 => 'Min',
            2 => 'Sen',
            3 => 'Sel',
            4 => 'Rab',
            5 => 'Kam',
            6 => 'Jum',
            7 => 'Sab',
        ];

        $weeklyLabels = $weeklyRaw->pluck('day_num')
            ->map(fn($d) => $dayMap[$d])
            ->toArray();

        $weeklyData = $weeklyRaw->pluck('total')->toArray();


        // ---------- MONTHLY (tanggal 1–31 bulan ini) ----------
        $monthly = Transaction::selectRaw('
        DAY(created_at) as day,
        SUM(total_amount) as total
    ')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $monthlyLabels = $monthly->pluck('day')
            ->map(fn($d) => 'Tgl ' . $d)
            ->toArray();

        $monthlyData = $monthly->pluck('total')->toArray();


        // ---------- YEARLY (Jan - Des) ----------
        $yearly = Transaction::selectRaw('
        MONTH(created_at) as month,
        SUM(total_amount) as total
    ')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthMap = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $yearlyLabels = $yearly->pluck('month')
            ->map(fn($m) => $monthMap[$m])
            ->toArray();

        $yearlyData = $yearly->pluck('total')->toArray();


        // ---------- FINAL CHART DATA ----------
        $chartData = [
            'daily' => [
                'labels' => $dailyLabels,
                'data' => $dailyData,
            ],
            'weekly' => [
                'labels' => $weeklyLabels,
                'data' => $weeklyData,
            ],
            'monthly' => [
                'labels' => $monthlyLabels,
                'data' => $monthlyData,
            ],
            'yearly' => [
                'labels' => $yearlyLabels,
                'data' => $yearlyData,
            ],
        ];



        return view('dashboard.index', compact(
            'totalMenus',
            'totalTransactions',
            'totalCustomers',
            'totalRevenue',
            'todayTransactions',
            'todayRevenue',
            'popularMenus',
            'recentTransactions',
            'chartData'
        ));
    }
}
