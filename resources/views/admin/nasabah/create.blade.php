@extends('layouts.admin')

@section('title', 'Tambah Nasabah')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Tambah Nasabah</h1>

    <form action="{{ route('admin.nasabah.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2"
                   value="{{ old('name') }}" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded p-2"
                   value="{{ old('email') }}" required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700">Alamat</label>
            <textarea name="alamat" id="alamat" class="w-full border rounded p-2">{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-4">
    <label for="telepon" class="block text-gray-700">Telepon</label>
    <input type="text" name="telepon" id="telepon" class="w-full border rounded p-2"
           value="{{ old('telepon') }}">
    @error('telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

        <div class="flex justify-end">
            <a href="{{ route('admin.nasabah.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
