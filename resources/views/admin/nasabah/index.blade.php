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
        @foreach($nasabah as $n)
        <tr class="border-b">
            <td class="p-2">{{ $loop->iteration }}</td>
            <td class="p-2">{{ $n->nama }}</td>
            <td class="p-2">{{ $n->alamat }}</td>
            <td class="p-2">{{ $n->telepon }}</td>
            <td class="p-2">{{ $n->email }}</td>
            <td class="p-2 space-x-2">
                <a href="{{ route('admin.nasabah.edit',$n->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">✏️ Edit</a>
                <form action="{{ route('admin.nasabah.destroy',$n->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">🗑 Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $nasabah->links() }}
</div>
@endsection
