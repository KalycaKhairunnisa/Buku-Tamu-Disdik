@extends('layouts.app')

@section('title', $kecamatan->nama)

@section('content')
<div class="container-lg">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5">{{ $kecamatan->nama }}</h1>
        </div>
        <div class="col-auto">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('kecamatan.edit', $kecamatan) }}" class="btn btn-warning me-2">Edit</a>
            @endif
            <a href="{{ route('kecamatan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted mb-1">Nama Kecamatan</p>
                            <h5 class="mb-0">{{ $kecamatan->nama }}</h5>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1">Jumlah Buku Tamu</p>
                            <h5 class="mb-0">{{ $kecamatan->guestBooks()->count() }}</h5>
                        </div>
                    </div>

                    @if($kecamatan->keterangan)
                        <hr class="my-3">
                        <h6>Keterangan</h6>
                        <p class="mb-0">{{ $kecamatan->keterangan }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h2 class="h4 mb-3">Buku Tamu di Kecamatan {{ $kecamatan->nama }}</h2>

    @if($kecamatan->guestBooks()->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengambil</th>
                        <th>Nama TK/KB</th>
                        <th>Pembuat</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kecamatan->guestBooks()->latest()->get() as $gb)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gb->nama_pengambil }}</td>
                            <td>{{ $gb->nama_tk_kb }}</td>
                            <td>{{ $gb->user?->name ?? 'Unknown' }}</td>
                            <td>{{ $gb->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-secondary">Belum ada buku tamu untuk kecamatan ini</div>
    @endif
</div>
@endsection
