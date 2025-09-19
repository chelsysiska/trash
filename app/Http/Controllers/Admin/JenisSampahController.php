<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::paginate(10);
        return view('admin.jenis_sampah.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|string|max:50',
        ]);

        JenisSampah::create($request->all());

        return redirect()->route('admin.jenis_sampah.index')
                         ->with('success', 'Jenis sampah berhasil ditambahkan!');
    }

    public function edit(JenisSampah $jenis_sampah)
    {
        return view('admin.jenis_sampah.edit', compact('jenis_sampah'));
    }

    public function update(Request $request, JenisSampah $jenis_sampah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required|string|max:50',
        ]);

        $jenis_sampah->update($request->all());

        return redirect()->route('admin.jenis_sampah.index')
                         ->with('success', 'Jenis sampah berhasil diperbarui!');
    }

    public function destroy(JenisSampah $jenis_sampah)
    {
        $jenis_sampah->delete();

        return redirect()->route('admin.jenis_sampah.index')
                         ->with('success', 'Jenis sampah berhasil dihapus!');
    }
}
