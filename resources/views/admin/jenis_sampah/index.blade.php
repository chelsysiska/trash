@extends('layouts.admin')

@section('title','Data Jenis Sampah')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Data Jenis Sampah</h1>
    <a href="{{ route('admin.jenis_sampah.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Jenis Sampah</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2 text-center">Nama</th>
            <th class="border px-4 py-2 text-center">Harga</th>
            <th class="border px-4 py-2 text-center">Satuan</th>
            <th class="border px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td class="border px-4 py-2 text-center">{{ $row->nama }}</td>
            <td class="border px-4 py-2 text-center">{{ number_format($row->harga, 0, ',', '.') }}</td>
            <td class="border px-4 py-2 text-center">{{ $row->satuan }}</td>
            <td class="border px-4 py-2 text-center">
                <a href="{{ route('admin.jenis_sampah.edit', $row->id) }}" class="text-blue-600">Edit</a> |
                <form action="{{ route('admin.jenis_sampah.destroy', $row->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $data->links() }}
</div>
@endsection
