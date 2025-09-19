<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id_user;
        $setoran = Transaksi::with('items')->where('id_user',$id_user)->latest()->get();
        $kasMasuk = KasMutasi::where('tipe','debit')->sum('nominal');
        $kasKeluar = KasMutasi::where('tipe','kredit')->sum('nominal');
    }
}