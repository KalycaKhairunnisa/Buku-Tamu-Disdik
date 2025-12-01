@extends('layouts.app')

@section('title', 'Input Data Buku Tamu')

@section('extra-css')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
<style>
    .form-section {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-top: 4px solid #87CEEB;
    }

    .form-title {
        color: #005a9c;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #ADD8E6;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .signature-section {
        background-color: #f0f8ff;
        padding: 20px;
        border-radius: 10px;
        border: 2px solid #ADD8E6;
        margin-bottom: 25px;
    }

    .signature-section h5 {
        color: #005a9c;
        font-weight: 700;
        margin-bottom: 15px;
    }

    #signaturePad {
        border: 2px solid #87CEEB;
        border-radius: 8px;
        background-color: white;
        cursor: crosshair;
        width: 100%;
        height: 250px;
        display: block;
        touch-action: none;
    }

    .signature-controls {
        margin-top: 15px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .form-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 40px;
    }

    .form-buttons .btn {
        padding: 12px 40px;
        font-weight: 600;
        font-size: 16px;
        border-radius: 25px;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 25px 15px;
        }

        .form-title {
            font-size: 20px;
        }

        #signaturePad {
            height: 200px;
        }

        .form-buttons {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-section">
            <h2 class="form-title">
                <i class="fas fa-edit"></i> Formulir Input Data Buku Tamu
            </h2>

            <form id="guestBookForm" action="{{ route('guest-books.store') }}" method="POST">
                @csrf

                <!-- Kecamatan -->
                <div class="form-group">
                    <label for="kecamatan_id" class="form-label">
                        <i class="fas fa-map-pin"></i> Kecamatan
                    </label>
                    <select id="kecamatan_id" name="kecamatan_id" class="form-select @error('kecamatan_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach ($kecamatan as $item)
                            <option value="{{ $item->id }}" {{ old('kecamatan_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kecamatan_id')
                        <small class="invalid-feedback d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nama Pengambil -->
                <div class="form-group">
                    <label for="nama_pengambil" class="form-label">
                        <i class="fas fa-user"></i> Nama Orang yang Mengambil
                    </label>
                    <input type="text" id="nama_pengambil" name="nama_pengambil"
                           class="form-control @error('nama_pengambil') is-invalid @enderror"
                           placeholder="Masukkan nama lengkap"
                           value="{{ old('nama_pengambil') }}" required>
                    @error('nama_pengambil')
                        <small class="invalid-feedback d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nama TK/KB -->
                <div class="form-group">
                    <label for="nama_tk_kb" class="form-label">
                        <i class="fas fa-school"></i> Nama TK/KB
                    </label>
                    <input type="text" id="nama_tk_kb" name="nama_tk_kb"
                           class="form-control @error('nama_tk_kb') is-invalid @enderror"
                           placeholder="Masukkan nama TK/KB"
                           value="{{ old('nama_tk_kb') }}" required>
                    @error('nama_tk_kb')
                        <small class="invalid-feedback d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Tanda Tangan -->
                <div class="signature-section">
                    <h5>
                        <i class="fas fa-pen-fancy"></i> Tanda Tangan Digital
                    </h5>
                    <canvas id="signaturePad" class="border"></canvas>
                    <div class="signature-controls">
                        <button type="button" id="clearSignature" class="btn btn-secondary btn-sm">
                            <i class="fas fa-redo"></i> Hapus
                        </button>
                        <button type="button" id="undoSignature" class="btn btn-secondary btn-sm">
                            <i class="fas fa-undo"></i> Undo
                        </button>
                    </div>
                    <input type="hidden" id="tanda_tangan" name="tanda_tangan" required>
                    @error('tanda_tangan')
                        <small class="invalid-feedback d-block" style="display:block;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                    <a href="{{ route('guest-books.index') }}" class="btn btn-danger btn-lg">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    const canvas = document.getElementById('signaturePad');
    const signatureInput = document.getElementById('tanda_tangan');
    const clearBtn = document.getElementById('clearSignature');
    const undoBtn = document.getElementById('undoSignature');
    const form = document.getElementById('guestBookForm');

    // Set canvas size
    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }

    // Initialize signature pad
    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'white',
        penColor: '#005a9c',
        velocityFilterWeight: 0.7,
        minWidth: 0.5,
        maxWidth: 2.5,
        throttle: 16,
    });

    // Resize canvas on window resize
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    // Clear signature
    clearBtn.addEventListener('click', () => {
        signaturePad.clear();
        signatureInput.value = '';
    });

    // Undo signature
    undoBtn.addEventListener('click', () => {
        const data = signaturePad.toData();
        if (data.length > 0) {
            data.pop();
            signaturePad.fromData(data);
        }
    });

    // Save signature on form submit
    form.addEventListener('submit', (e) => {
        if (signaturePad.isEmpty()) {
            e.preventDefault();
            alert('Mohon berikan tanda tangan digital Anda terlebih dahulu.');
            return;
        }

        // Save signature as base64 data URL
        signatureInput.value = canvas.toDataURL();
    });

    // Handle touch events for better mobile support
    document.addEventListener('touchmove', (e) => {
        if (e.target === canvas) {
            e.preventDefault();
        }
    }, false);
</script>
@endsection
