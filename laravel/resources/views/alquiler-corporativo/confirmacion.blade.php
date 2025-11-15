<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación - BiciSmart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #10b981;
        }
        
        .confirmation-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .confirmation-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <section class="confirmation-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card confirmation-card">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-check-circle fa-4x text-success mb-4"></i>
                            <h2>¡Solicitud Recibida!</h2>
                            <p class="lead">Hemos recibido tu solicitud de alquiler corporativo.</p>
                            
                            <div class="alert alert-info mt-4">
                                <strong>Número de solicitud:</strong> 
                                @if(session('solicitud_id'))
                                    <span class="badge bg-primary">#{{ session('solicitud_id') }}</span>
                                @else
                                    <span class="badge bg-primary">#{{ rand(1000, 9999) }}</span>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ url('/') }}" class="btn btn-primary me-2">Volver al Inicio</a>
                                <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-outline-primary">Nueva Solicitud</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>