<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <title>Política de Reembolso - Imagen A Texto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.7.3/dist/alpine.min.js"></script>

</head>
<body>
<div>
<x-navbar/>
    <div class="container mx-auto p-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-xl font-bold mb-4">Política de Reembolso de Imagen A Texto</h1>
            <p>Última actualización: 30 Diciembre, 2023</p>

            <p>Bienvenido a Imagen A Texto. Agradecemos que hayas elegido nuestros servicios. La siguiente política de reembolso se aplica a todas las suscripciones adquiridas a través de nuestra plataforma utilizando Paddle como método de pago.</p>

            <h2 class="text-lg font-semibold">1. Condiciones Generales</h2>
            <p>Período de Reembolso: Ofrecemos un período de reembolso de 14 días para las suscripciones mensuales y de 30 días para las suscripciones anuales, a partir de la fecha de compra.</p>
            <p>Elegibilidad: Para ser elegible para un reembolso, el usuario no debe haber utilizado el servicio de manera significativa durante el período de reembolso.</p>
            <p>Proceso de Solicitud: Las solicitudes de reembolso deben enviarse a nuestro equipo de soporte a través de nicolasgmelian@gmail.com indicando el número de pedido y la razón del reembolso.</p>

            <h2 class="text-lg font-semibold mt-4">2. Reembolsos en Casos Especiales</h2>
            <p>Problemas Técnicos: Si experimentas problemas técnicos que impiden el uso adecuado del servicio y nuestro equipo técnico no puede resolverlos, serás elegible para un reembolso completo.</p>
            <p>Cambios en las Condiciones del Servicio: Si realizamos cambios en los términos del servicio que afecten negativamente tu uso actual, tienes derecho a un reembolso proporcional.</p>

            <h2 class="text-lg font-semibold mt-4">3. Exclusiones</h2>
            <p>Renovaciones: Las renovaciones automáticas de suscripciones no son elegibles para reembolso. Recomendamos cancelar la suscripción antes de la fecha de renovación si no deseas continuar.</p>
            <p>Uso Excesivo: No se otorgarán reembolsos si se detecta un uso excesivo o abuso del servicio durante el período de reembolso.</p>

            <h2 class="text-lg font-semibold mt-4">4. Procedimiento de Reembolso</h2>
            <p>Procesamiento: Una vez aprobada la solicitud, el reembolso se procesará a través de Paddle y puede tardar hasta 10 días hábiles en reflejarse en tu método de pago original.</p>
            <p>Notificaciones: Se te notificará por correo electrónico una vez que se haya procesado el reembolso.</p>

            <h2 class="text-lg font-semibold mt-4">5. Contacto</h2>
            <p>Para cualquier consulta relacionada con nuestra política de reembolso, por favor contacta a nuestro equipo de soporte en nicolasgmelian@gmail.com.</p>
        </div>
    </div>
</div>
</body>
</html>
