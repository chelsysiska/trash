@extends('layouts.admin')

@section('title', 'Daftar Setoran')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Setoran {{ $nasabah->nama }}</h1>

<a href="{{ route('admin.nasabah.setoran.create', ['nasabah' => $nasabah->id]) }}"
   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mb-4 inline-block">
   + Tambah Setoran
</a>

<table class="w-full border border-gray-300">
    <thead>
        <tr>
            <th class="p-2 border text-center">Tanggal</th>
            <th class="p-2 border text-center">Berat (Kg)</th>
            <th class="p-2 border text-center">Harga per Kg</th>
            <th class="p-2 border text-center">Total Harga</th>
            <th class="p-2 border text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($setoran as $item)
            <tr>
                <td class="p-2 border text-center">{{ $item->tanggal }}</td>
                <td class="p-2 border text-center">{{ $item->berat }}</td>
                <td class="p-2 border text-center">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                <td class="p-2 border text-center">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>

                <td class="p-2 border text-center space-x-1">
                    <a href="{{ route('admin.setoran.edit', $item->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 text-sm rounded">Edit</a>

                    <form action="{{ route('admin.setoran.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 text-sm rounded"
                                onclick="return confirm('Yakin hapus setoran ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada setoran</td>
            </tr>
        @endforelse
    </tbody>
</table>
    </div>
</div>
@endsection
