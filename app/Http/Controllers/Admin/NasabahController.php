<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::latest()->paginate(10);
        return view('admin.nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama'   => 'required|string|max:45',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
        'email' => 'required|email|unique:nasabah,email',
    ]);

    Nasabah::create([
        'nama'   => $request->nama,
        'alamat' => $request->alamat,
        'telepon' => $request->telepon,
        'email' => $request->email,
    ]);

    return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil ditambahkan!');
}

    public function edit(Nasabah $nasabah)
    {
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:nasabah,email,' . $id,
        'telepon' => 'required|string|max:20',
    ]);

    $nasabah = Nasabah::findOrFail($id);
    $nasabah->update([
        'nama'   => $request->nama,
        'alamat' => $request->alamat,
        'email'  => $request->email,
        'telepon'  => $request->telepon,
    ]);

    return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil diperbarui!');
}

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        return redirect()->route('admin.nasabah.index')->with('success','Nasabah berhasil dihapus!');
    }
}