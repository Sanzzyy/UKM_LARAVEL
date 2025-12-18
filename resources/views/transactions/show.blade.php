<x-app-layout>
    <x-slot name="title">Detail Transaksi</x-slot>
    <x-slot name="header">Detail Transaksi - {{ $transaction->transaction_code }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8" id="invoice">
            {{-- HEADER STRUK --}}
            <div class="text-center mb-8 border-b pb-6">
                <h1 class="text-3xl font-bold text-orange-600 mb-2">🍛 Mitra Nasi Goreng</h1>
                <p class="text-gray-600 text-sm">Jl. Raya Nasgor No. 123, Lubuklinggau</p>
                <p class="text-gray-600 text-sm">Telp: 0812-3456-7890</p>
            </div>

            {{-- INFO TRANSAKSI --}}
            <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Kode Transaksi</p>
                    <p class="font-bold text-lg text-orange-600">{{ $transaction->transaction_code }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 mb-1">Tanggal & Waktu</p>
                    <p class="font-bold">{{ $transaction->created_at->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $transaction->created_at->format('H:i') }} WIB</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Pelanggan</p>
                    <p class="font-bold">{{ $transaction->customer->name ?? 'Umum' }}</p>
                    @if ($transaction->customer && $transaction->customer->phone && $transaction->customer->phone != '-')
                        <p class="text-sm text-gray-500">{{ $transaction->customer->phone }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 mb-1">Dilayani Oleh</p>
                    <p class="font-bold">{{ $transaction->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ ucfirst($transaction->user->role) }}</p>
                </div>
            </div>

            {{-- ITEMS TABLE --}}
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Pesanan</h3>
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-300">
                            <th class="text-left py-3 text-gray-600">Item</th>
                            <th class="text-center py-3 text-gray-600">Qty</th>
                            <th class="text-right py-3 text-gray-600">Harga</th>
                            <th class="text-right py-3 text-gray-600">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->transactionDetails as $detail)
                            <tr class="border-b border-gray-200">
                                <td class="py-3">
                                    <p class="font-semibold text-gray-800">{{ $detail->menu->name }}</p>
                                    @if ($detail->notes)
                                        <p class="text-sm text-orange-600">
                                            <span class="font-semibold">Note:</span> {{ $detail->notes }}
                                        </p>
                                    @endif
                                </td>
                                <td class="text-center py-3">{{ $detail->quantity }}</td>
                                <td class="text-right py-3">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td class="text-right py-3 font-semibold">Rp
                                    {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- SUMMARY --}}
            <div class="border-t-2 border-gray-300 pt-4 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-800">TOTAL</span>
                    <span class="text-2xl font-bold text-orange-600">Rp
                        {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Metode Pembayaran</span>
                    <span class="font-semibold uppercase">
                        @if ($transaction->payment_method == 'cash')
                            💵 Cash
                        @elseif($transaction->payment_method == 'transfer')
                            🏦 Transfer
                        @else
                            📱 QRIS
                        @endif
                    </span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Dibayar</span>
                    <span class="font-semibold">Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-green-600 text-lg">
                    <span class="font-bold">Kembalian</span>
                    <span class="font-bold">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="text-center mt-8 pt-6 border-t">
                <p class="text-gray-600 mb-4">Terima kasih atas kunjungan Anda!</p>
                <p class="text-sm text-gray-500">Struk ini adalah bukti pembayaran yang sah</p>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex justify-center space-x-4 mt-6 no-print">
            <a href="{{ route('transactions.index') }}">
                <x-button variant="secondary" icon="⬅️">Kembali</x-button>
            </a>
            <x-button variant="primary" icon="🖨️" onclick="window.print()">
                Print Struk
            </x-button>
        </div>
    </div>

    {{-- PRINT STYLES --}}
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice,
            #invoice * {
                visibility: visible;
            }

            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            /* Hide sidebar and header when printing */
            aside,
            header,
            .p-8:not(#invoice) {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
