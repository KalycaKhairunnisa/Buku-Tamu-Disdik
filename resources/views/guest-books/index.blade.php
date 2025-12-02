@extends('layouts.app')

@section('title', 'Data Buku Tamu')

@section('extra-css')
<style>
    .data-section {
        margin-top: 30px;
    }

    .section-title {
        color: #005a9c;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #87CEEB;
    }

    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        border-top: 4px solid #87CEEB;
    }

    .filter-title {
        color: #005a9c;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .export-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .export-buttons .btn {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        font-size: 14px;
    }

    .table-responsive {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }

    .no-data {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        color: #999;
    }

    .no-data i {
        font-size: 80px;
        color: #ADD8E6;
        margin-bottom: 20px;
        display: block;
    }

    .no-data p {
        font-size: 18px;
        margin: 0;
        color: #666;
    }

    .signature-thumb {
        max-width: 100px;
        max-height: 100px;
        border: 1px solid #ADD8E6;
        border-radius: 5px;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 15px;
    }

    .empty-state {
        text-align: center;
        padding: 100px 20px;
    }

    .empty-state i {
        font-size: 100px;
        color: #ADD8E6;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #005a9c;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .filter-form {
            grid-template-columns: 1fr;
        }

        .export-buttons {
            flex-direction: column;
        }

        .export-buttons .btn {
            width: 100%;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="data-section">
    <h2 class="section-title">
        <i class="fas fa-table"></i> Data Buku Tamu
    </h2>

    <!-- Export Buttons -->
    <div class="export-buttons">
        <a href="{{ route('guest-books.export-pdf', request()->query()) }}" class="btn btn-success" target="_blank">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('guest-books.export-excel', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <h5 class="filter-title">
            <i class="fas fa-filter"></i> Pencarian & Filter
        </h5>

        <form method="GET" action="{{ route('guest-books.index') }}">
            <div class="filter-form">
                <div>
                    <label class="form-label">Kecamatan</label>
                    <select name="kecamatan" class="form-select">
                        <option value="">-- Semua Kecamatan --</option>
                        @foreach ($kecamatan as $item)
                            <option value="{{ $item->id }}" {{ (string)request('kecamatan') === (string)$item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Nama Pengambil</label>
                    <input type="text" name="nama_pengambil" class="form-control"
                           placeholder="Cari nama..." value="{{ request('nama_pengambil') }}">
                </div>

                <div>
                    <label class="form-label">Nama TK/KB</label>
                    <input type="text" name="nama_tk_kb" class="form-control"
                           placeholder="Cari TK/KB..." value="{{ request('nama_tk_kb') }}">
                </div>

                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('guest-books.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    @if ($guestBooks->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50"><i class="fas fa-hashtag"></i> No.</th>
                        <th><i class="fas fa-map-pin"></i> Kecamatan</th>
                        <th><i class="fas fa-user"></i> Nama Pengambil</th>
                        <th><i class="fas fa-school"></i> Nama TK/KB</th>
                        <th><i class="fas fa-user"></i> Pembuat</th>
                        <th><i class="fas fa-calendar"></i> Tanggal</th>
                        <th width="100"><i class="fas fa-pen-fancy"></i> Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guestBooks as $key => $book)
                        <tr>
                            <td>
                                <strong>{{ ($guestBooks->currentPage() - 1) * $guestBooks->perPage() + $key + 1 }}</strong>
                            </td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $book->getRelationValue('kecamatan')?->nama ?? $book->kecamatan ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $book->nama_pengambil }}</td>
                            <td>{{ $book->nama_tk_kb }}</td>
                            <td>{{ $book->user?->name ?? 'Unknown' }}</td>
                            <td>
                                <small>{{ $book->created_at->format('d-m-Y H:i') }}</small>
                            </td>
                            <td>
                                @if ($book->tanda_tangan)
                                    <button class="btn btn-sm btn-outline-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#signatureModal{{ $book->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Signature Modal -->
                                    <div class="modal fade" id="signatureModal{{ $book->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);">
                                                    <h5 class="modal-title" style="color: #005a9c; font-weight: 700;">
                                                        Tanda Tangan - {{ $book->nama_pengambil }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center" style="background-color: #f0f8ff;">
                                                    <img src="{{ $book->tanda_tangan }}" alt="Signature"
                                                         style="max-width: 100%; height: auto; border: 2px solid #ADD8E6; border-radius: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-inbox" style="font-size: 40px; color: #ADD8E6;"></i>
                                <p class="mt-2 text-muted">Tidak ada data ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <div style="display: flex; justify-content: center; margin-top: 30px;">
                {{ $guestBooks->links('pagination::bootstrap-5') }}
            </div>
        </nav>

        <div style="text-align: center; margin-top: 20px; color: #666;">
            <small>
                Menampilkan <strong>{{ $guestBooks->count() }}</strong> dari <strong>{{ $guestBooks->total() }}</strong> data
            </small>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum Ada Data</h3>
            <p>Mulai dengan mengisi formulir buku tamu terlebih dahulu.</p>
            <a href="{{ route('guest-books.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle"></i> Input Data Baru
            </a>
        </div>
    @endif
</div>
@endsection
