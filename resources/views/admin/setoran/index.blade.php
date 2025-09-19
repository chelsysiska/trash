@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Setoran {{ $nasabah->nama }}</h4>
        <a href="{{ route('admin.nasabah.index') }}" class="btn btn-sm btn-secondary">← Kembali</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($setoran as $index => $s)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($s->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $s->keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada setoran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
