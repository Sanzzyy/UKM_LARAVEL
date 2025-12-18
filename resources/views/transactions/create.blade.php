<x-app-layout>
    <x-slot name="title">Transaksi Baru</x-slot>
    <x-slot name="header">Transaksi Baru</x-slot>

    <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Menu List -->
            <!-- Menu List -->
            <div class="lg:col-span-2">
                <x-card title="Pilih Menu" icon="🍽️">

                    <!-- 🔒 Fixed height container -->
                    <div class="lg:h-[calc(100vh-200px)] overflow-y-auto pr-2 custom-scroll">
                        <div class="space-y-4">

                            @foreach ($menus->groupBy('category.name') as $categoryName => $categoryMenus)
                                <div x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }" class="border rounded-lg bg-white">

                                    <!-- Category Header -->
                                    <button type="button" @click="open = !open"
                                        class="w-full flex justify-between items-center px-4 py-3
                                   bg-orange-50 hover:bg-orange-100 transition">

                                        <span class="font-bold text-orange-700">
                                            {{ $categoryName }}
                                        </span>

                                        <span x-text="open ? '−' : '+'" class="text-xl font-bold"></span>
                                    </button>

                                    <!-- Menu Items -->
                                    <div x-show="open" x-collapse class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        @foreach ($categoryMenus as $menu)
                                            <x-menu-card :menu="$menu" />
                                        @endforeach
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>

                </x-card>
            </div>



            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow sticky top-4 flex flex-col max-h-[85vh]">

                <!-- HEADER -->
                <div class="p-4 border-b">
                    <h3 class="text-xl font-bold text-gray-800">Ringkasan Order</h3>
                </div>

                <!-- CUSTOMER + ITEMS (SCROLLABLE) -->
                <div
                    class="flex-1 overflow-y-auto p-4
                scrollbar-thin
                scrollbar-thumb-orange-400
                scrollbar-track-orange-100">

                    <!-- Customer Info -->
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
                            <input type="text" name="customer_name" id="customer_name" placeholder="Nama Pelanggan"
                                class="w-full px-3 py-2 border rounded-lg mb-2">

                            <input type="text" name="customer_phone" id="customer_phone"
                                placeholder="No. Telepon (opsional)" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div id="orderItems" class="space-y-2">
                        <p class="text-gray-500 text-center py-4">Belum ada item</p>
                    </div>

                    <!-- Total -->
                    <div class="border-t pt-4 mt-4">
                        <div class="flex justify-between text-xl font-bold">
                            <span>Total:</span>
                            <span id="totalAmount">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- PAYMENT (COMPACT) -->
                <div class="p-3 border-t bg-white text-sm">

                    <!-- Method + Paid -->
                    <div class="grid grid-cols-2 gap-2">

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">
                                Metode
                            </label>
                            <select name="payment_method"
                                class="w-full px-2 py-1.5 border rounded-md text-sm focus:ring-orange-500">
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">
                                Dibayar
                            </label>
                            <input type="number" name="paid_amount" id="paidAmount"
                                class="w-full px-2 py-1.5 border rounded-md text-sm" placeholder="0" min="0">
                        </div>

                    </div>

                    <!-- Change -->
                    <div class="flex justify-between items-center mt-2">
                        <span class="font-semibold text-gray-700">Kembalian</span>
                        <span id="changeAmount" class="font-bold text-green-600 text-base">Rp 0</span>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full mt-2 py-2 text-sm font-semibold rounded-lg
               bg-orange-500 text-white hover:bg-orange-600
               disabled:opacity-50"
                        id="submitBtn" disabled>
                        Proses
                    </button>

                </div>


            </div>

        </div>
    </form>
</x-app-layout>
