@props(['customers'])

<div class="bg-white rounded-xl shadow-sm p-6 sticky top-4">

    <h3 class="text-xl font-bold text-gray-800 mb-4">🧾 Ringkasan Order</h3>

    {{-- CUSTOMER --}}
    <div class="mb-4">
        <label class="block text-sm font-bold text-gray-700 mb-2">Pelanggan</label>

        <select name="customer_id" id="customer_id" class="w-full px-3 py-2 border rounded-lg mb-2"
            onchange="toggleCustomerInput()">

            <option value="">Pelanggan Baru</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>

        <div id="newCustomerFields">
            <input type="text" name="customer_name" placeholder="Nama Pelanggan"
                class="w-full px-3 py-2 border rounded-lg mb-2" required>

            <input type="text" name="customer_phone" placeholder="No. Telepon (opsional)"
                class="w-full px-3 py-2 border rounded-lg">
        </div>
    </div>

    {{-- ITEMS --}}
    <div id="orderItems" class="mb-4 space-y-2 max-h-60 overflow-y-auto">
        <p class="text-gray-500 text-center py-4">Belum ada item</p>
    </div>

    {{-- TOTAL --}}
    <div class="border-t pt-4 mb-4">
        <div class="flex justify-between text-2xl font-bold">
            <span>Total</span>
            <span id="totalAmount">Rp 0</span>
        </div>
    </div>

    {{-- PAYMENT --}}
    <div class="mb-4">
        <label class="block text-sm font-bold text-gray-700 mb-2">Metode Pembayaran</label>
        <select name="payment_method" class="w-full px-3 py-2 border rounded-lg" required>
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="qris">QRIS</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-bold text-gray-700 mb-2">Uang Dibayar</label>
        <input type="number" name="paid_amount" id="paidAmount" min="0"
            class="w-full px-3 py-2 border rounded-lg" onkeyup="calculateChange()" required>
    </div>

    <div class="mb-6">
        <div class="flex justify-between text-lg">
            <span class="font-bold text-gray-700">Kembalian</span>
            <span id="changeAmount" class="font-bold text-green-600">Rp 0</span>
        </div>
    </div>

    <button type="submit" id="submitBtn" disabled
        class="w-full bg-orange-600 hover:bg-orange-700
               disabled:bg-gray-400 text-white font-bold
               py-3 rounded-lg transition">
        Proses Transaksi
    </button>
</div>
