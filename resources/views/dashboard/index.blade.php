<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-stats-card label="Menu" :value="$totalMenus" icon="🍴" />
        <x-stats-card label="Transaksi" :value="$totalTransactions" icon="📝" />
        <x-stats-card label="Pelanggan" :value="$totalCustomers" icon="👥" />
        <x-stats-card label="Pendapatan" value="Rp {{ number_format($totalRevenue, 0, ',', '.') }}" icon="💰" />
    </div>

    <!-- Graph + Today Summary -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        <!-- Revenue Chart -->
        <div class="xl:col-span-2 bg-white rounded-xl shadow p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4">
                <h3 class="font-bold text-gray-800">📈 Grafik Pendapatan</h3>

                <select id="chartFilter" class="border rounded-lg px-3 py-1.5 text-sm w-full sm:w-auto">
                    <option value="daily">Hari Ini</option>
                    <option value="weekly">Mingguan</option>
                    <option value="monthly">Bulanan</option>
                    <option value="yearly">Tahunan</option>
                </select>
            </div>

            <canvas id="revenueChart" height="120"></canvas>
        </div>

        <!-- Today Summary (IMPROVED) -->
        <div class="bg-white rounded-xl shadow p-5 sm:p-6 flex flex-col gap-4">

            <h3 class="font-bold text-gray-800">📊 Ringkasan Hari Ini</h3>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4">
                <div class="rounded-lg bg-orange-50 p-4">
                    <p class="text-xs text-gray-500 mb-1">Transaksi</p>
                    <p class="text-2xl font-bold text-orange-500">
                        {{ $todayTransactions }}
                    </p>
                </div>

                <div class="rounded-lg bg-emerald-50 p-4">
                    <p class="text-xs text-gray-500 mb-1">Pendapatan</p>
                    <p class="text-lg font-bold text-emerald-600 leading-tight">
                        Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- CTA -->
            <a href="{{ route('transactions.create') }}"
                class="mt-auto text-center bg-emerald-500 hover:bg-emerald-600
                       text-white py-2.5 rounded-lg transition font-semibold">
                ➕ Transaksi Baru
            </a>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-xl shadow p-5 sm:p-6">
        <h3 class="font-bold text-gray-800 mb-4">🕐 Transaksi Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Pelanggan</th>
                        <th class="px-4 py-3 text-left">Kasir</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentTransactions as $trx)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $trx->transaction_code }}</td>
                            <td class="px-4 py-3">{{ $trx->customer->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $trx->user->name }}</td>
                            <td class="px-4 py-3 font-semibold text-green-600">
                                Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-gray-500">
                                {{ $trx->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script>
    window.chartData = @json($chartData);
</script>
