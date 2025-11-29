@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-primary mb-3">Contáctanos</h1>
    <p class="text-muted">Déjanos un mensaje y te responderemos en breve.</p>
    <form class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Tu nombre">
        </div>
        <div class="col-md-6">
            <label class="form-label">Correo</label>
            <input type="email" class="form-control" placeholder="correo@ejemplo.com">
        </div>
        <div class="col-12">
            <label class="form-label">Mensaje</label>
            <textarea class="form-control" rows="4" placeholder="Cuéntanos en qué podemos ayudarte"></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="button">Enviar</button>
        </div>
    </form>
</div>
@endsection
