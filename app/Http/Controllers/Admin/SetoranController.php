<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index(Nasabah $nasabah)
{
    $setoran = Setoran::where('nasabah_id', $nasabah->id)->get();
    return view('admin.setoran.index', compact('nasabah', 'setoran'));
}

public function create(Nasabah $nasabah)
{
    $jenisSampah = JenisSampah::all();
    return view('admin.setoran.create', compact('nasabah', 'jenisSampah'));
}

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

public function edit(Setoran $setoran)
{
    $nasabah = $setoran->nasabah;
    return view('admin.setoran.edit', compact('nasabah', 'setoran'));
}

public function update(Request $request, Setoran $setoran)
{
    $request->validate([
        'berat' => 'required|numeric',
        'harga_per_kg' => 'required|numeric',
        'tanggal' => 'required|date',
    ]);

    $total = $request->berat * $request->harga_per_kg;

    $setoran->update([
        'berat' => $request->berat,
        'harga_per_kg' => $request->harga_per_kg,
        'total_harga' => $total,
        'tanggal' => $request->tanggal,
    ]);

    return redirect()->route('admin.nasabah.setoran.index', $setoran->nasabah_id)
        ->with('success', 'Setoran berhasil diperbarui');
}

public function destroy(Setoran $setoran)
{
    $nasabah_id = $setoran->nasabah_id;
    $setoran->delete();

    return redirect()->route('admin.nasabah.setoran.index', $nasabah_id)
        ->with('success', 'Setoran berhasil dihapus');
}
}
