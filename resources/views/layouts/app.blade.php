<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Buku Tamu Dinas Pendidikan</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        
        header {
            background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);
            padding: 30px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 4px solid #4a90e2;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .header-text h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #005a9c;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.5);
        }
        
        .header-text p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #005a9c;
            font-weight: 400;
        }
        
        .nav-buttons {
            display: flex;
            gap: 10px;
        }
        
        .nav-buttons a {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-buttons .btn-primary {
            background-color: white;
            color: #005a9c;
        }
        
        .nav-buttons .btn-primary:hover {
            background-color: #005a9c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,90,156,0.3);
        }
        
        main {
            padding: 40px 20px;
            min-height: calc(100vh - 300px);
        }
        
        .container-lg {
            max-width: 1200px;
        }
        
        footer {
            background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);
            color: #005a9c;
            text-align: center;
            padding: 30px 20px;
            margin-top: 60px;
            border-top: 4px solid #4a90e2;
            font-size: 14px;
        }
        
        footer p {
            margin: 5px 0;
            font-weight: 500;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border-top: 4px solid #87CEEB;
        }
        
        .card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);
            color: #005a9c;
            border-radius: 15px 15px 0 0 !important;
            font-weight: 600;
            font-size: 18px;
            padding: 20px;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #357abd 0%, #1e4976 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74,144,226,0.3);
        }
        
        .btn-secondary {
            background-color: #87CEEB;
            border: none;
            color: #005a9c;
            border-radius: 25px;
            font-weight: 500;
        }
        
        .btn-secondary:hover {
            background-color: #4a90e2;
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            border: none;
            border-radius: 25px;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #bb2d3b 100%);
            border: none;
            border-radius: 25px;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #ADD8E6;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
            background-color: #f0f8ff;
        }
        
        .form-label {
            font-weight: 600;
            color: #005a9c;
            margin-bottom: 10px;
        }
        
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .table thead {
            background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);
        }
        
        .table thead th {
            color: #005a9c;
            font-weight: 700;
            border: none;
            padding: 15px;
        }
        
        .table tbody td {
            vertical-align: middle;
            padding: 15px;
            border-color: #f0f0f0;
        }
        
        .table tbody tr:hover {
            background-color: #f0f8ff;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            font-weight: 500;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .badge {
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-info {
            background-color: #87CEEB;
            color: #005a9c;
        }
        
        .pagination {
            margin-top: 20px;
        }
        
        .pagination .page-link {
            border-radius: 5px;
            border: 1px solid #ADD8E6;
            color: #4a90e2;
        }
        
        .pagination .page-link:hover {
            background-color: #87CEEB;
            color: #005a9c;
            border-color: #4a90e2;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
            border-color: #4a90e2;
        }
        
        .filter-section {
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border-top: 4px solid #87CEEB;
        }
        
        .filter-title {
            color: #005a9c;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 15px;
        }
        
        .signature-pad {
            border: 2px dashed #ADD8E6;
            border-radius: 10px;
            background-color: #f0f8ff;
            cursor: crosshair;
        }
        
        .signature-controls {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            .logo {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
            
            .header-text h1 {
                font-size: 22px;
            }
            
            .nav-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            main {
                padding: 20px 10px;
            }
            
            .table {
                font-size: 12px;
            }
            
            .table thead th, .table tbody td {
                padding: 10px;
            }
        }
    </style>
    
    @yield('extra-css')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container-lg">
            <div class="header-content">
                <div class="logo-section">
                    <div class="logo">
                        <img src="{{ asset('images/disdik25.jpg') }}" alt="Logo Dinas Pendidikan" title="Dinas Pendidikan Kabupaten Garut">
                    </div>
                    <div class="header-text">
                        <h1>Buku Tamu Dinas Pendidikan</h1>
                        <p>Kabupaten Garut</p>
                    </div>
                </div>
                <div class="nav-buttons">
                    <a href="{{ route('guest-books.index') }}" class="btn-primary">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="{{ route('guest-books.create') }}" class="btn-primary">
                        <i class="fas fa-plus-circle"></i> Input Data
                    </a>
                    @auth
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="color: #005a9c; font-size: 14px;">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </span>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-primary" style="padding: 10px 15px;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container-lg">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> 
                    <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p><i class="fas fa-copyright"></i> 2025 Dinas Pendidikan Kabupaten Garut</p>
        <p>Website Buku Tamu Digital</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('extra-js')
</body>
</html>
