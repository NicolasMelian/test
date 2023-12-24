<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <title>Imagen A Texto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.7.3/dist/alpine.min.js"></script>

</head>
<div>
<x-navbar/>
    <div class="container mx-auto p-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-xl font-bold mb-4">Política de Privacidad de Imagen A Texto</h1>
            
            <h2 class="text-lg font-semibold">1. Recolección de Información</h2>
            <p>Recopilamos información cuando utilizas nuestra aplicación o servicio, incluyendo:</p>
            <ul class="list-disc ml-5">
                <li><strong>Información de la Cuenta</strong>: Tu nombre, dirección de correo electrónico y contraseña al crear una cuenta.</li>
                <li><strong>Datos de Acceso</strong>: Información sobre tu dispositivo, tipo de navegador y sistema operativo, así como tu actividad de navegación en nuestra aplicación.</li>
                <li><strong>Cookies</strong>: Utilizamos cookies para mejorar tu experiencia y recordar tus preferencias.</li>
                <li><strong>Google Analytics y Métricas</strong>: Para rastrear y analizar el tráfico y comportamiento de los usuarios en la aplicación.</li>
                <li><strong>Servicios de Terceros</strong>: Podemos usar servicios de terceros para el seguimiento y análisis del tráfico y comportamiento de los usuarios.</li>
            </ul>

            <h2 class="text-lg font-semibold mt-4">2. Uso de Información Personal</h2>
            <p>Utilizamos la información personal recopilada para:</p>
            <ul class="list-disc ml-5">
                <li>Proporcionar y mejorar nuestro servicio.</li>
                <li>Procesar tus suscripciones y pagos.</li>
                <li>Comunicarnos contigo sobre tu cuenta y transacciones.</li>
                <li>Detectar riesgos o fraudes.</li>
                <li>Proveer información o publicidad sobre nuestros productos y servicios.</li>
                <li>Cumplir con leyes y regulaciones aplicables.</li>
            </ul>

            <h2 class="text-lg font-semibold mt-4">3. Divulgación de Información Personal</h2>
            <p>No vendemos ni compartimos tu información personal con terceros para su uso comercial o de marketing. Sin embargo, podemos compartirla con:</p>
            <ul class="list-disc ml-5">
                <li><strong>Proveedores de Servicios</strong>: Para asistirnos en operaciones como alojamiento web, análisis de datos, procesamiento de pagos y servicio al cliente.</li>
                <li><strong>Cumplimiento de Leyes y Autoridades</strong>: Para cumplir con leyes, regulaciones o procesos legales.</li>
                <li><strong>Protección de Derechos y Seguridad</strong>: Para proteger los derechos, propiedad o seguridad de Imagen A Texto, nuestros usuarios o el público.</li>
            </ul>

            <h2 class="text-lg font-semibold mt-4">4. Tus Derechos</h2>
            <p>Si eres residente de un país con leyes específicas de protección de datos, tienes ciertos derechos en relación con tu información personal, incluyendo el derecho de acceder, corregir, actualizar o eliminar tu información personal. Si deseas ejercer alguno de estos derechos, por favor contáctanos.</p>

            <h2 class="text-lg font-semibold mt-4">5. Cambios a esta Política de Privacidad</h2>
            <p>Podemos actualizar esta Política de Privacidad ocasionalmente para reflejar cambios en nuestras prácticas o para cumplir con requisitos legales o regulatorios.</p>

            <h2 class="text-lg font-semibold mt-4">6. Contáctanos</h2>
            <p>Si tienes preguntas o inquietudes sobre esta Política de Privacidad o nuestras prácticas de privacidad, contáctanos en nicolasgmelian@gmail.com.</p>
            <p>Nos esforzaremos por responder a tu consulta y abordar cualquier preocupación que puedas tener.</p>
        </div>
    </div>
</div>
</body>
</html>
