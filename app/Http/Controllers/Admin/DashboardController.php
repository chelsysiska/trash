<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total nasabah (role user/nasabah)
        $totalNasabah = DB::table('users')
            ->where('role', 'user') // sesuaikan kalau role nasabah pakai nama lain
            ->count();

        // Total sampah (kg)
        $totalSampah = DB::table('transaksi_sampah')
            ->sum('total_berat') ?? 0;

        // Pendapatan bulan ini
        $pendapatanBulanIni = DB::table('transaksi_sampah')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga') ?? 0;

        // Transaksi hari ini
        $transaksiHariIni = DB::table('transaksi_sampah')
            ->whereDate('created_at', Carbon::today())
            ->count();

        // 5 transaksi terbaru
        $transaksiTerbaru = DB::table('transaksi_sampah')
            ->join('users', 'transaksi_sampah.user_id', '=', 'users.id')
            ->select('transaksi_sampah.*', 'users.name as nasabah_name')
            ->orderBy('transaksi_sampah.created_at', 'desc')
            ->limit(5)
            ->get();

        // Nasabah paling aktif bulan ini
        $nasabahAktif = DB::table('users')
            ->join('transaksi_sampah', 'users.id', '=', 'transaksi_sampah.user_id')
            ->select(
                'users.name',
                DB::raw('COUNT(transaksi_sampah.id) as transaksi_count'),
                DB::raw('SUM(transaksi_sampah.total_berat) as total_berat')
            )
            ->where('users.role', 'user')
            ->whereMonth('transaksi_sampah.created_at', Carbon::now()->month)
            ->whereYear('transaksi_sampah.created_at', Carbon::now()->year)
            ->groupBy('users.id', 'users.name')
            ->orderBy('transaksi_count', 'desc')
            ->limit(5)
            ->get();

        // Chart sampah bulanan (6 bulan terakhir)
        $months = [];
        $dataBulanan = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M Y');
            $total = DB::table('transaksi_sampah')
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total_berat') ?? 0;
            $dataBulanan[] = floatval($total);
        }
        $chartBulanan = [
            'labels' => $months,
            'data' => $dataBulanan
        ];

        // Chart jenis sampah
        $jenisSampah = DB::table('detail_transaksi')
            ->join('jenis_sampah', 'detail_transaksi.jenis_sampah_id', '=', 'jenis_sampah.id')
            ->select('jenis_sampah.nama_sampah', DB::raw('SUM(detail_transaksi.berat) as total_berat'))
            ->groupBy('jenis_sampah.id', 'jenis_sampah.nama_sampah')
            ->orderBy('total_berat', 'desc')
            ->limit(6)
            ->get();

        $labels = [];
        $dataJenis = [];
        foreach ($jenisSampah as $item) {
            $labels[] = $item->nama_sampah;
            $dataJenis[] = floatval($item->total_berat);
        }
        if (empty($labels)) {
            $labels = ['Plastik', 'Kertas', 'Logam', 'Kaca'];
            $dataJenis = [0, 0, 0, 0];
        }
        $chartJenisSampah = [
            'labels' => $labels,
            'data' => $dataJenis
        ];

        return view('admin.dashboard', compact(
            'totalNasabah',
            'totalSampah',
            'pendapatanBulanIni',
            'transaksiHariIni',
            'transaksiTerbaru',
            'nasabahAktif',
            'chartBulanan',
            'chartJenisSampah'
        ));
    }

    public function riwayat()
{
    // contoh ambil semua transaksi
    $riwayat = DB::table('transaksi_sampah')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    return view('admin.riwayat', compact('riwayat'));
}

}
