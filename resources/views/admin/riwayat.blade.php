@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Riwayat Transaksi</h1>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Nasabah</th>
                <th class="p-2 border">Berat (Kg)</th>
                <th class="p-2 border">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $item)
                <tr>
                    <td class="p-2 border">{{ $item->created_at }}</td>
                    <td class="p-2 border">{{ $item->user_id ?? '-' }}</td>
                    <td class="p-2 border">{{ $item->total_berat }}</td>
                    <td class="p-2 border">Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $riwayat->links() }}
    </div>
</div>
@endsection
