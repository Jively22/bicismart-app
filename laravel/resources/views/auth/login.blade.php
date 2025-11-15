<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - BiciSmart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --secondary-color: #64748b;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .auth-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .auth-header {
            background: white;
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .auth-tabs {
            display: flex;
            background: white;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .auth-tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            background: none;
            border: none;
            font-weight: 500;
            color: var(--secondary-color);
            transition: all 0.3s ease;
        }
        
        .auth-tab.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }
        
        .auth-tab:hover {
            color: var(--primary-color);
        }
        
        .auth-body {
            background: white;
            padding: 2rem;
        }
        
        .user-type-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .user-type-btn {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            color: var(--secondary-color);
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .user-type-btn.active {
            border-color: var(--primary-color);
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-color);
        }
        
        .user-type-btn i {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card auth-card">
                    <!-- Header -->
                    <div class="auth-header">
                        <h2 class="fw-bold mb-1" style="color: var(--primary-color);">
                            <i class="fas fa-bicycle me-2"></i>BiciSmart
                        </h2>
                        <p class="text-muted mb-0">Bienvenido de vuelta</p>
                    </div>

                    <!-- Tabs -->
                    <div class="auth-tabs">
                        <button class="auth-tab active" onclick="switchTab('login')">
                            Iniciar Sesión
                        </button>
                        <button class="auth-tab" onclick="switchTab('register')">
                            Registrarse
                        </button>
                    </div>

                    <!-- Login Form -->
                    <div class="auth-body" id="login-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- User Type Selection -->
                            <div class="user-type-tabs">
                                <button type="button" class="user-type-btn active" onclick="setUserType('cliente')">
                                    <i class="fas fa-user"></i>
                                    Cliente
                                </button>
                                <button type="button" class="user-type-btn" onclick="setUserType('empresa')">
                                    <i class="fas fa-building"></i>
                                    Empresa
                                </button>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="tu@email.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password"
                                       placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Recordar sesión
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>
                            </div>

                            <!-- Links -->
                            <div class="text-center mt-4">
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none" href="{{ route('password.request') }}" style="color: var(--primary-color);">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                                <div class="mt-2">
                                    <span class="text-muted">¿No tienes cuenta?</span>
                                    <a class="text-decoration-none ms-1" href="{{ route('register') }}" style="color: var(--primary-color);">
                                        Regístrate aquí
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let currentUserType = 'cliente';
        
        function switchTab(tab) {
            if (tab === 'login') {
                window.location.href = "{{ route('login') }}";
            } else {
                window.location.href = "{{ route('register') }}";
            }
        }
        
        function setUserType(type) {
            currentUserType = type;
            
            // Update button states
            document.querySelectorAll('.user-type-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // You can add logic here to show/hide fields based on user type
            if (type === 'empresa') {
                // Show empresa-specific fields if needed
            } else {
                // Show cliente fields
            }
        }
        
        // Set the user type in a hidden field if needed
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'user_type';
            hiddenInput.value = currentUserType;
            form.appendChild(hiddenInput);
        });
    </script>
</body>
</html>