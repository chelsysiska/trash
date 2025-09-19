@extends('layouts.admin')

@section('content')
<h2>Tambah Setoran - {{ $nasabah->nama_nasabah }}</h2>

<form action="{{ route('admin.nasabah.setoran.store', $nasabah->id) }}" method="POST">
    @csrf
    <div>
        <label>Tanggal</label>
        <input type="date" name="tanggal_setor" required>
    </div>
    <div>
        <label>Berat (kg)</label>
        <input type="number" step="0.01" name="berat" required>
    </div>
    <div>
        <label>Harga per Kg</label>
        <input type="number" step="0.01" name="harga" required>
    </div>

    <button type="submit">Simpan</button>
</form>
@endsection
