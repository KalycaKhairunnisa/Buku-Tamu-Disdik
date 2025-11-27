<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Buku Tamu Dinas Pendidikan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #87CEEB 0%, #ADD8E6 100%);
            padding: 40px 30px;
            text-align: center;
            border-bottom: 4px solid #4a90e2;
        }

        .login-header h1 {
            margin: 0;
            color: #005a9c;
            font-size: 28px;
            font-weight: 700;
        }

        .login-header p {
            color: #005a9c;
            margin-top: 10px;
            font-size: 14px;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            color: #005a9c;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            border: 2px solid #ADD8E6;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
            background-color: #f0f8ff;
        }

        .btn-login {
            background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #357abd 0%, #1e4976 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74,144,226,0.3);
            color: white;
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .login-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ADD8E6;
        }

        .login-footer a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-footer a:hover {
            color: #005a9c;
            text-decoration: underline;
        }

        .invalid-feedback {
            display: block;
            margin-top: 5px;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 20px;
            }

            .login-body {
                padding: 30px 20px;
            }

            .login-header {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-lock"></i> Login Admin</h1>
            <p>Buku Tamu Dinas Pendidikan Kabupaten Garut</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> Login gagal!
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-key"></i> Password
                    </label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Masukkan password Anda" required>
                    @error('password')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="login-footer">
                <p style="margin: 0; color: #666; font-size: 14px;">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
