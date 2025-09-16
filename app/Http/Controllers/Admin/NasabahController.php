<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\HS;

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
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'alamat'   => 'nullable|string|max:255',
        'telepon'  => 'nullable|string|max:20',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'user',
        'alamat'   => $request->alamat,
        'telepon'  => $request->telepon,
    ]);

    return redirect()->route('admin.nasabah.index')
                     ->with('success', 'Nasabah berhasil ditambahkan.');
}

    public function edit(Nasabah $nasabah)
    {
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:nasabah,email,'.$nasabah->id
        ]);

        $nasabah->update($request->all());

        return redirect()->route('admin.nasabah.index')->with('success','Data nasabah berhasil diperbarui!');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        return redirect()->route('admin.nasabah.index')->with('success','Nasabah berhasil dihapus!');
    }
}
