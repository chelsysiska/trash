@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">📊 Dashboard Admin Bank Sampah</h1>

    <!-- 3 Kartu Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h3>Total Nasabah</h3>
            <p class="text-3xl">{{ $totalNasabah }}</p>
        </div>

        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h3>Total Sampah (Kg)</h3>
            <p class="text-3xl">{{ $totalSampah }}</p>
        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h3>Pendapatan Bulan Ini</h3>
            <p class="text-3xl">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Chart -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Grafik Berat Sampah per Bulan</h3>
            <canvas id="chartBulanan"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Jenis Sampah Terbanyak</h3>
            <canvas id="chartJenis"></canvas>
        </div>
    </div>

    <!-- Transaksi terbaru -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-4">5 Transaksi Terbaru</h3>
        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Nasabah</th>
                    <th class="p-2 border">Berat (Kg)</th>
                    <th class="p-2 border">Total Harga</th>
                    <th class="p-2 border">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiTerbaru as $t)
                    <tr>
                        <td class="p-2 border">{{ $t->nasabah_name }}</td>
                        <td class="p-2 border">{{ $t->total_berat }}</td>
                        <td class="p-2 border">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td class="p-2 border">{{ $t->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Belum ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Nasabah aktif -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">5 Nasabah Paling Aktif Bulan Ini</h3>
        <ul>
            @forelse($nasabahAktif as $n)
                <li class="border-b py-2">
                    {{ $n->name }} - {{ $n->transaksi_count }} transaksi ({{ $n->total_berat }} Kg)
                </li>
            @empty
                <li class="text-gray-500">Belum ada data</li>
            @endforelse
        </ul>
    </div>
</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('chartBulanan');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($chartBulanan['labels']),
            datasets: [{
                label: 'Berat Sampah (Kg)',
                data: @json($chartBulanan['data']),
                borderColor: 'rgb(37, 99, 235)',
                fill: false,
                tension: 0.3
            }]
        }
    });

    const ctx2 = document.getElementById('chartJenis');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: @json($chartJenisSampah['labels']),
            datasets: [{
                data: @json($chartJenisSampah['data']),
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#14b8a6'],
            }]
        }
    });
</script>
@endsection
