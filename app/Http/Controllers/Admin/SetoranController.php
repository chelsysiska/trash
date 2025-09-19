<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index($nasabah_id)
    {
        $nasabah = Nasabah::findOrFail($nasabah_id);
        $setoran = Setoran::where('nasabah_id', $nasabah_id)->get();

        return view('admin.setoran.index', compact('nasabah', 'setoran'));
    }

    public function create($nasabah_id)
    {
        $nasabah = Nasabah::findOrFail($nasabah_id);
        return view('admin.setoran.create', compact('nasabah'));
    }

    public function store(Request $request, $nasabah_id)
    {
        $request->validate([
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'tanggal_setor' => 'required|date',
        ]);

        $total = $request->berat * $request->harga;

        Setoran::create([
            'nasabah_id' => $nasabah_id,
            'berat' => $request->berat,
            'harga' => $request->harga,
            'total' => $total,
            'tanggal_setor' => $request->tanggal_setor,
        ]);

        return redirect()->route('admin.nasabah.setoran.index', $nasabah_id)
        ->with('success', 'Setoran berhasil ditambahkan');
    }

    public function edit($nasabah_id, $id)
    {
        $nasabah = Nasabah::findOrFail($nasabah_id);
        $setoran = Setoran::findOrFail($id);

        return view('admin.setoran.edit', compact('nasabah', 'setoran'));
    }

    public function update(Request $request, $nasabah_id, $id)
    {
        $request->validate([
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'tanggal_setor' => 'required|date',
        ]);

        $setoran = Setoran::findOrFail($id);
        $setoran->update([
            'berat' => $request->berat,
            'harga' => $request->harga,
            'total' => $request->berat * $request->harga,
            'tanggal_setor' => $request->tanggal_setor,
        ]);

        return redirect()->route('admin.nasabah.setoran.index', $nasabah_id)
        ->with('success', 'Setoran berhasil ditambahkan');
    }

    public function destroy($nasabah_id, $id)
    {
        $setoran = Setoran::findOrFail($id);
        $setoran->delete();

        return redirect()->route('admin.nasabah.setoran.index', $nasabah_id)
        ->with('success', 'Setoran berhasil ditambahkan');
    }

    
}
