@extends('layouts.admin')

@section('title','Tambah Setoran')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Setoran untuk {{ $nasabah->nama_nasabah }}</h1>

    <form action="{{ route('admin.nasabah.setoran.store', $nasabah->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block">Tanggal Setor</label>
            <input type="date" name="tanggal" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Jenis Sampah</label>
            <select name="jenis_sampah_id" id="jenis_sampah" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Jenis Sampah --</option>
                @foreach ($jenisSampah as $sampah)
                <option value="{{ $sampah->id }}" data-harga="{{ $sampah->harga_per_kg }}">
                    {{ $sampah->nama_sampah }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Berat (Kg)</label>
            <input type="number" step="0.01" id="berat" name="berat" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Harga per Kg</label>
            <input type="number" id="harga" name="harga_per_kg" class="w-full border rounded p-2" readonly>
        </div>

        <div class="mb-4">
            <label class="block">Total Harga</label>
            <input type="number" id="total" name="total_harga" class="w-full border rounded p-2" readonly>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.nasabah.setoran.index', $nasabah->id) }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

<script>
    const jenisSampahSelect = document.getElementById('jenis_sampah');
    const beratInput = document.getElementById('berat');
    const hargaInput = document.getElementById('harga');
    const totalInput = document.getElementById('total');

    jenisSampahSelect.addEventListener('change', function () {
        let harga = this.options[this.selectedIndex].getAttribute('data-harga');
        hargaInput.value = harga || 0;
        totalInput.value = (parseFloat(beratInput.value) || 0) * (parseFloat(harga) || 0);
    });

    beratInput.addEventListener('input', function () {
        let harga = parseFloat(hargaInput.value) || 0;
        totalInput.value = (parseFloat(this.value) || 0) * harga;
    });
</script>
@endsection
