@extends('layouts.admin')

@section('title','Data Nasabah')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Data Nasabah</h1>
    <a href="{{ route('admin.nasabah.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Nasabah</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="border border-gray-300 px-4 py-2 text-center">Nama</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Alamat</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Email</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nasabah as $nasabah)
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-center">{{ $nasabah->nama }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $nasabah->alamat }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $nasabah->email }}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    @if($nasabah->status == 'aktif')
                        <span class="text-green-600 font-bold">Aktif</span>
                    @else
                        <span class="text-red-600 font-bold">Tidak Aktif</span>
                    @endif
                </td>
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <a href="{{ route('admin.nasabah.setoran.index', $nasabah->id) }}" class="text-blue-600">Setoran</a> |
                    <a href="{{ route('admin.nasabah.edit', $nasabah->id) }}" class="text-blue-600">Edit</a> | 
                    <form action="{{ route('admin.nasabah.destroy', $nasabah->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
