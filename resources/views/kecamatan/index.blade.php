@extends('layouts.app')

@section('title', 'Manajemen Kecamatan')

@section('content')
<div class="container-lg">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="display-5">Manajemen Kecamatan</h1>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('kecamatan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Kecamatan
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    @if($kecamatan->count())
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">No</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Keterangan</th>
                                        <th style="width:140px;">Jumlah Buku Tamu</th>
                                        <th style="width:180px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kecamatan as $k)
                                        <tr>
                                            <td>{{ ($kecamatan->currentPage() - 1) * $kecamatan->perPage() + $loop->iteration }}</td>
                                            <td>{{ $k->nama }}</td>
                                            <td>{{ $k->keterangan ?? '-' }}</td>
                                            <td>{{ $k->guestBooks()->count() }}</td>
                                            <td>
                                                <a href="{{ route('kecamatan.show', $k) }}" class="btn btn-sm btn-outline-primary me-1">Lihat</a>
                                                @if(auth()->check() && auth()->user()->role === 'admin')
                                                    <a href="{{ route('kecamatan.edit', $k) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                                    <form action="{{ route('kecamatan.destroy', $k) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah anda yakin ingin menghapus kecamatan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4">
                            <p class="mb-0">Belum ada data kecamatan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $kecamatan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
