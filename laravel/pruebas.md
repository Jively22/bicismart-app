# Escenarios de Prueba - BiciSmart

## ESCENARIO 1: USUARIO NO AUTENTICADO
- [x] Acceder a página principal (/) - DISEÑO MEJORADO
- [x] Ver formulario de alquiler corporativo (/alquiler-corporativo)
- [x] Enviar solicitud de alquiler corporativo (GUARDA EN BD)
- [x] Ver página de confirmación
- [x] NO puede acceder a /bicicletas (error 403)
- [x] NO puede acceder a /alquileres (error 403)

## ESCENARIO 2: USUARIO EMPRESA
- [x] Registrarse como empresa (con campo role)
- [x] Iniciar sesión
- [x] Ver "Mis Alquileres" (/mis-alquileres)
- [x] Crear nueva solicitud corporativa
- [x] NO puede acceder a CRUDs de admin (error 403)

## ESCENARIO 3: ADMINISTRADOR
- [x] Iniciar sesión como admin
- [x] Acceder a CRUD de Bicicletas (/bicicletas)
- [x] Acceder a CRUD de Alquileres (/alquileres)
- [x] Ver solicitudes corporativas en lista
- [x] Gestionar inventario de bicicletas (Crear, Ver, Editar)
- [x] Gestionar alquileres (Crear, Ver, Editar, Cambiar estados)