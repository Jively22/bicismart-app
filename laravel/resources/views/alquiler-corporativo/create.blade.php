<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquiler Corporativo - BiciSmart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 3rem 0;
        }
        
        .form-section {
            padding: 3rem 0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 2rem;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 1rem;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .step.active .step-number {
            background-color: var(--primary-color);
            color: white;
        }
        
        .step-label {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .step.active .step-label {
            color: var(--primary-color);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold">Alquiler Corporativo de Bicicletas</h1>
                    <p class="lead">Perfecto para eventos empresariales, team building y actividades corporativas en Lima</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-briefcase fa-5x opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Step Indicator -->
    <div class="container mt-4">
        <div class="step-indicator">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-label">Información de la Empresa</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-label">Detalles del Evento</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-label">Confirmación</div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h4 class="mb-0">Solicitud de Alquiler Corporativo</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('alquiler-corporativo.store') }}">
                                @csrf
                                
                                <h5 class="mb-3">Información de la Empresa</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="razon_social" class="form-label">Razón Social *</label>
                                        <input type="text" class="form-control" name="razon_social" id="razon_social" 
                                               value="{{ old('razon_social') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ruc_empresa" class="form-label">RUC *</label>
                                        <input type="text" class="form-control" name="ruc_empresa" id="ruc_empresa"
                                               value="{{ old('ruc_empresa') }}" required maxlength="11">
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-4">Persona de Contacto</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="contacto_nombre" class="form-label">Nombre Completo *</label>
                                        <input type="text" class="form-control" name="contacto_nombre" id="contacto_nombre"
                                               value="{{ old('contacto_nombre') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contacto_email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="contacto_email" id="contacto_email"
                                               value="{{ old('contacto_email') }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="contacto_telefono" class="form-label">Teléfono *</label>
                                        <input type="tel" class="form-control" name="contacto_telefono" id="contacto_telefono"
                                               value="{{ old('contacto_telefono') }}" required>
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-4">Detalles del Evento</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tipo_evento" class="form-label">Tipo de Evento *</label>
                                        <select class="form-select" name="tipo_evento" id="tipo_evento" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="Team Building">Team Building</option>
                                            <option value="Evento Corporativo">Evento Corporativo</option>
                                            <option value="Conferencia">Conferencia</option>
                                            <option value="Feria">Feria</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fecha_evento" class="form-label">Fecha del Evento *</label>
                                        <input type="date" class="form-control" name="fecha_evento" id="fecha_evento"
                                               value="{{ old('fecha_evento') }}" required min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="duracion_horas" class="form-label">Duración (horas) *</label>
                                        <input type="number" class="form-control" name="duracion_horas" id="duracion_horas"
                                               value="{{ old('duracion_horas', 4) }}" min="1" max="24" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cantidad_bicicletas" class="form-label">Cantidad de Bicicletas *</label>
                                        <input type="number" class="form-control" name="cantidad_bicicletas" id="cantidad_bicicletas"
                                               value="{{ old('cantidad_bicicletas', 10) }}" min="5" max="100" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="ubicacion_evento" class="form-label">Ubicación del Evento *</label>
                                        <textarea class="form-control" name="ubicacion_evento" id="ubicacion_evento" 
                                                  rows="3" required placeholder="Dirección exacta del evento...">{{ old('ubicacion_evento') }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="observaciones" class="form-label">Observaciones Adicionales</label>
                                        <textarea class="form-control" name="observaciones" id="observaciones" 
                                                  rows="3" placeholder="Requerimientos especiales, horarios específicos, etc.">{{ old('observaciones') }}</textarea>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Solicitud
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>