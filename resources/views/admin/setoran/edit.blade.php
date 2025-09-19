@extends('layouts.app')

@section('content')
<a href="{{ route('admin.nasabah.setoran.create', $nasabah->id) }}">Tambah Setoran</a>
<div class="container">
    <h2>Edit Setoran untuk {{ $nasabah->nama_nasabah }}</h2>

    <form action="{{ route('nasabah.setoran.update', [$nasabah->id, $setoran->id]) }}" method="POST">
        @method('PUT')
        <div class="mb-3">
            <label>Berat (Kg)</label>
            <input type="number" step="0.1" name="berat" value="{{ $setoran->berat }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga per Kg</label>
            <input type="number" name="harga" value="{{ $setoran->harga }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Setor</label>
            <input type="date" name="tanggal_setor" value="{{ $setoran->tanggal_setor }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.setoran.index', $nasabah->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
