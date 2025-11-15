<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - BiciSmart</title>
    
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
        
        .empresa-fields {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card auth-card">
                    <!-- Header -->
                    <div class="auth-header">
                        <h2 class="fw-bold mb-1" style="color: var(--primary-color);">
                            <i class="fas fa-bicycle me-2"></i>BiciSmart
                        </h2>
                        <p class="text-muted mb-0">Crea tu cuenta</p>
                    </div>

                    <!-- Tabs -->
                    <div class="auth-tabs">
                        <button class="auth-tab" onclick="switchTab('login')">
                            Iniciar Sesión
                        </button>
                        <button class="auth-tab active" onclick="switchTab('register')">
                            Registrarse
                        </button>
                    </div>

                    <!-- Register Form -->
                    <div class="auth-body" id="register-form">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- User Type Selection -->
                            <div class="user-type-tabs">
                                <button type="button" class="user-type-btn active" onclick="showClienteForm()">
                                    <i class="fas fa-user"></i>
                                    Cliente
                                </button>
                                <button type="button" class="user-type-btn" onclick="showEmpresaForm()">
                                    <i class="fas fa-building"></i>
                                    Empresa
                                </button>
                            </div>

                            <!-- Hidden field for user type -->
                            <input type="hidden" name="role" id="role" value="cliente">

                            <!-- Cliente Fields -->
                            <div id="cliente-fields">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="name" class="form-label">Nombre completo</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                               placeholder="Juan Pérez">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email') }}" required autocomplete="email"
                                               placeholder="tu@email.com">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Teléfono</label>
                                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               name="phone" value="{{ old('phone') }}"
                                               placeholder="+51 999 999 999">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Empresa Fields -->
                            <div id="empresa-fields" class="empresa-fields">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="empresa_nombre" class="form-label">Nombre de la empresa</label>
                                        <input id="empresa_nombre" type="text" class="form-control" 
                                               name="empresa_nombre" value="{{ old('empresa_nombre') }}"
                                               placeholder="Empresa S.A.C.">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="ruc" class="form-label">RUC</label>
                                        <input id="ruc" type="text" class="form-control" 
                                               name="ruc" value="{{ old('ruc') }}"
                                               placeholder="20XXXXXXXXX">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="contacto_nombre" class="form-label">Nombre del contacto</label>
                                        <input id="contacto_nombre" type="text" class="form-control" 
                                               name="contacto_nombre" value="{{ old('contacto_nombre') }}"
                                               placeholder="Juan Pérez">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="empresa_email" class="form-label">Correo corporativo</label>
                                        <input id="empresa_email" type="email" class="form-control" 
                                               name="empresa_email" value="{{ old('empresa_email') }}"
                                               placeholder="contacto@empresa.com">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="empresa_phone" class="form-label">Teléfono</label>
                                        <input id="empresa_phone" type="tel" class="form-control" 
                                               name="empresa_phone" value="{{ old('empresa_phone') }}"
                                               placeholder="+51 999 999 999">
                                    </div>
                                </div>
                            </div>

                            <!-- Common Fields -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password"
                                           placeholder="Mínimo 8 caracteres">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control" 
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Repite tu contraseña">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center mt-4">
                                <span class="text-muted">¿Ya tienes cuenta?</span>
                                <a class="text-decoration-none ms-1" href="{{ route('login') }}" style="color: var(--primary-color);">
                                    Inicia sesión aquí
                                </a>
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
        function switchTab(tab) {
            if (tab === 'login') {
                window.location.href = "{{ route('login') }}";
            } else {
                window.location.href = "{{ route('register') }}";
            }
        }
        
        function showClienteForm() {
            document.getElementById('cliente-fields').style.display = 'block';
            document.getElementById('empresa-fields').style.display = 'none';
            document.getElementById('role').value = 'cliente';
            
            // Update button states
            document.querySelectorAll('.user-type-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }
        
        function showEmpresaForm() {
            document.getElementById('cliente-fields').style.display = 'none';
            document.getElementById('empresa-fields').style.display = 'block';
            document.getElementById('role').value = 'empresa';
            
            // Update button states
            document.querySelectorAll('.user-type-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }
        
        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            showClienteForm(); // Default to cliente form
        });
    </script>
</body>
</html>