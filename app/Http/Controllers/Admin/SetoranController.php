<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Nasabah $nasabah)
    {
        $setoran = $nasabah->setoran()->with('jenisSampah')->get();
        return view('admin.setoran.index', compact('nasabah', 'setoran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Nasabah $nasabah)
    {
        $jenisSampah = JenisSampah::all();
        return view('admin.setoran.create', compact('nasabah', 'jenisSampah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_sampah_id' => 'required|exists:jenis_sampah,id',
            'berat' => 'required|numeric',
            'harga_per_kg' => 'required|numeric',
        ]);

        $total = $request->berat * $request->harga_per_kg;

        Setoran::create([
            'nasabah_id' => $nasabah->id,
            'tanggal' => $request->tanggal,
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'berat' => $request->berat,
            'harga_per_kg' => $request->harga_per_kg,
            'total_harga' => $total,
        ]);

        return redirect()->route('admin.nasabah.setoran.index', $nasabah->id)
            ->with('success', 'Setoran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setoran $setoran)
    {
        $nasabah = $setoran->nasabah;
        // Menambahkan jenisSampah untuk ditampilkan di form edit
        $jenisSampah = JenisSampah::all(); 
        return view('admin.setoran.edit', compact('nasabah', 'setoran', 'jenisSampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setoran $setoran)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_sampah_id' => 'required|exists:jenis_sampah,id',
            'berat' => 'required|numeric',
            'harga_per_kg' => 'required|numeric',
        ]);

        $total = $request->berat * $request->harga_per_kg;

        $setoran->update([
            'tanggal' => $request->tanggal,
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'berat' => $request->berat,
            'harga_per_kg' => $request->harga_per_kg,
            'total_harga' => $total,
        ]);

        return redirect()->route('admin.nasabah.setoran.index', $setoran->nasabah_id)
            ->with('success', 'Setoran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setoran $setoran)
    {
        $nasabah_id = $setoran->nasabah_id;
        $setoran->delete();

        return redirect()->route('admin.nasabah.setoran.index', $nasabah_id)
            ->with('success', 'Setoran berhasil dihapus');
    }
}
