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

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">Alamat</th>
            <th class="p-2">Telepon</th>
            <th class="p-2">Email</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($nasabah as $item)
        <tr class="border-b">
            <td class="p-2">{{ $item->name }}</td>
            <td class="p-2">{{ $item->alamat }}</td>
            <td class="p-2">{{ $item->telepon }}</td>
            <td class="p-2">{{ $item->email }}</td>
            <td class="p-2">
                <a href="{{ route('admin.nasabah.edit', $item->id) }}" class="text-blue-500">Edit</a> |
                <form action="{{ route('admin.nasabah.destroy', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-gray-500 p-4">Belum ada nasabah</td>
        </tr>
    @endforelse
</tbody>
</table>

<div class="mt-4">
    {{ $nasabah->links() }}
</div>
@endsection
