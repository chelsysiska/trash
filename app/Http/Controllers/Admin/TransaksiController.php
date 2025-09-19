<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\KasMutasi;
use App\Models\KontribusiNasabah;
use App\Models\User; // nasabah
use DB;

class TransaksiController extends Controller
{
    public function index(){
        $transaksi = Transaksi::with('items','user')->latest()->paginate(15);
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create(){
        $nasabahList = User::where('role','nasabah')->get();
        $jenis = DB::table('jenis_sampah')->get();
        return view('admin.transaksi.create', compact('nasabahList','jenis'));
    }

    public function store(Request $request){
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.id_jenis' => 'required|exists:jenis_sampah,id_jenis',
            'items.*.berat_kg' => 'required|numeric|min:0.01',
            'items.*.harga_per_kg' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try{
            $totalBerat = 0;
            $totalNilai = 0;

            $transaksi = Transaksi::create([
                'id_user' => $request->id_user,
                'id_petugas' => auth()->id(),
                'tanggal' => $request->tanggal,
                'total_berat' => 0,
                'total_nilai' => 0,
            ]);

            foreach($request->items as $it){
                $subtotal = $it['berat_kg'] * $it['harga_per_kg'];
                TransaksiItem::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_jenis' => $it['id_jenis'],
                    'berat_kg' => $it['berat_kg'],
                    'harga_per_kg' => $it['harga_per_kg'],
                    'subtotal' => $subtotal,
                ]);

                $totalBerat += $it['berat_kg'];
                $totalNilai += $subtotal;
            }   

            // update totals
            $transaksi->update(['total_berat' => $totalBerat, 'total_nilai' => $totalNilai]);

            // create kas mutasi (uang masuk)
            KasMutasi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'nominal' => $totalNilai,
                'tipe' => 'debit',
                'keterangan' => 'Setoran sampah (ID: '.$transaksi->id_transaksi.')',
                'tanggal' => $request->tanggal,
            ]);

            // update kontribusi_nasabah (tambah total_setoran)
            $kontrib = KontribusiNasabah::firstOrCreate(
                ['id_nasabah' => $request->id_user],
                ['total_setoran' => 0]
            );
            $kontrib->increment('total_setoran', $totalNilai);

            DB::commit();
            return redirect()->route('admin.transaksi.index')->with('success','Transaksi berhasil disimpan');

        }catch(\Exception $e){
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

