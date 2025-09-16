@extends('layouts.admin')

@section('title','Tambah Nasabah')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Nasabah</h1>

    <form action="{{ route('admin.nasabah.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block">Nama</label>
            <input type="text" name="nama" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block">Telepon</label>
            <input type="text" name="telepon" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.nasabah.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
