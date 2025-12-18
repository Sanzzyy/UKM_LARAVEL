<x-app-layout>
    <x-slot name="title">Riwayat Transaksi</x-slot>
    <x-slot name="header">Riwayat Transaksi</x-slot>

    {{-- MOBILE HINT --}}
    <div class="mb-2 px-4 py-2 text-xs text-gray-500 bg-blue-50 rounded lg:hidden">
        👉 Geser ke kanan untuk melihat detail transaksi
    </div>

    <x-card>
        {{-- SCROLL AREA (UNTUK MOBILE) --}}
        <div class="overflow-x-auto">
            <table class="min-w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kode Transaksi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pelanggan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kasir
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pembayaran
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Waktu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                        <tr
                            class="{{ $transaction->total_amount >= 100000 ? 'bg-yellow-50' : 'hover:bg-gray-50' }} transition">
                            {{-- KODE TRANSAKSI --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-mono font-bold text-orange-600">
                                    {{ $transaction->transaction_code }}
                                </span>
                            </td>

                            {{-- PELANGGAN --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $transaction->customer->name ?? 'Umum' }}
                            </td>

                            {{-- KASIR --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->user->name }}
                            </td>

                            {{-- TOTAL --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-green-600">
                                    Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                </span>
                                @if ($transaction->total_amount >= 100000)
                                    <span
                                        class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">
                                        BIG
                                    </span>
                                @endif
                            </td>

                            {{-- PEMBAYARAN --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($transaction->payment_method == 'cash')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        CASH
                                    </span>
                                @elseif($transaction->payment_method == 'transfer')
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        TRANSFER
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                        QRIS
                                    </span>
                                @endif
                            </td>

                            {{-- WAKTU --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('transactions.show', $transaction) }}">
                                    <x-button variant="info" size="sm">Detail</x-button>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-2">📋</span>
                                    <span>Belum ada transaksi</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Pagination --}}
        <x-pagination :paginator="$transactions" />

    </x-card>
</x-app-layout>
