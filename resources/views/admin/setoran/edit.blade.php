@extends('layouts.admin')

@section('content')

<div class="container mx-auto p-6">
<div class="bg-white shadow-md rounded-lg p-6 w-full md:w-2/3 lg:w-1/2 mx-auto">
<h2 class="text-2xl font-semibold mb-6 text-center">
Edit Setoran untuk {{ $nasabah->nama }}
</h2>

    {{-- Pastikan rute ke 'update' dan pastikan parameter setoran ada --}}
    <form action="{{ route('admin.setoran.update', $setoran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Tanggal Setor -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Tanggal Setor</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $setoran->tanggal) }}"
                class="w-full border rounded p-2" required>
        </div>

        <!-- Jenis Sampah -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Jenis Sampah</label>
            <select name="jenis_sampah_id" id="jenis_sampah" class="w-full border rounded p-2" required>
                @foreach ($jenisSampah as $sampah)
                <option value="{{ $sampah->id }}" data-harga="{{ $sampah->harga_per_kg }}"
                    {{ old('jenis_sampah_id', $setoran->jenis_sampah_id) == $sampah->id ? 'selected' : '' }}>
                    {{ $sampah->nama_sampah }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Berat -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Berat (Kg)</label>
            <input type="number" step="0.1" id="berat" name="berat" value="{{ old('berat', $setoran->berat) }}"
                class="w-full border rounded p-2" required>
        </div>

        <!-- Harga per Kg -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Harga per Kg</label>
            <input type="number" id="harga" name="harga_per_kg" value="{{ old('harga_per_kg', $setoran->harga_per_kg) }}"
                class="w-full border rounded p-2" readonly>
        </div>

        <!-- Total Harga -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Total Harga</label>
            <input type="number" id="total" name="total_harga" value="{{ old('total_harga', $setoran->total_harga) }}"
                class="w-full border rounded p-2 bg-gray-100" readonly>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.nasabah.setoran.index', $nasabah->id) }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Batal
            </a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>
</div>

</div>

<script>
// Ambil elemen form
const jenisSampahSelect = document.getElementById('jenis_sampah');
const beratInput = document.getElementById('berat');
const hargaInput = document.getElementById('harga');
const totalInput = document.getElementById('total');

// Fungsi untuk hitung total harga
function hitungTotal() {
    const harga = parseFloat(hargaInput.value) || 0;
    const berat = parseFloat(beratInput.value) || 0;
    totalInput.value = (berat * harga).toFixed(0); // tanpa koma
}

// Saat jenis sampah diganti
jenisSampahSelect.addEventListener('change', function () {
    const harga = this.options[this.selectedIndex].getAttribute('data-harga');
    hargaInput.value = harga || 0;
    hitungTotal();
});

// Saat berat diinput
beratInput.addEventListener('input', hitungTotal);

// Inisialisasi saat halaman pertama kali dimuat
document.addEventListener('DOMContentLoaded', () => {
    const hargaAwal = jenisSampahSelect.options[jenisSampahSelect.selectedIndex].getAttribute('data-harga');
    hargaInput.value = hargaAwal || 0;
    hitungTotal();
});
</script>


@endsection