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
<body>
<div>
<x-navbar/>
<div class="container mx-auto p-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-xl font-bold mb-4">Términos y Condiciones de Imagen A Texto</h1>
        
        <h2 class="text-lg font-semibold">1. Introducción</h2>
        <p>Estos Términos y Condiciones rigen el uso de la aplicación Imagen A Texto. Al utilizar nuestra aplicación, aceptas estar sujeto a estos términos.</p>
        
        <h2 class="text-lg font-semibold mt-4">2. Uso de la Aplicación</h2>
        <p>La aplicación Imagen A Texto permite a los usuarios convertir imágenes en texto. Los usuarios deben utilizar la aplicación de manera responsable y legal.</p>
        
        <h2 class="text-lg font-semibold mt-4">3. Cuentas y Registro</h2>
        <p>Para acceder a ciertas funciones, debes crear una cuenta proporcionando un email válido y una contraseña.</p>
        
        <h2 class="text-lg font-semibold mt-4">4. Privacidad</h2>
        <p>Tu privacidad es importante para nosotros. Consulta nuestra Política de Privacidad para entender cómo recopilamos y usamos tu información.</p>
        
        <h2 class="text-lg font-semibold mt-4">5. Propiedad Intelectual</h2>
        <p>Todos los derechos de propiedad intelectual en la aplicación son propiedad de Imagen A Texto o de nuestros licenciantes. No se te otorgan derechos sobre la aplicación excepto para usarla de acuerdo con estos términos.</p>
        
        <h2 class="text-lg font-semibold mt-4">6. Limitación de Responsabilidad</h2>
        <p>Imagen A Texto no será responsable de cualquier daño directo, indirecto, incidental, especial o consecuente que surja del uso o la incapacidad de usar la aplicación.</p>
        
        <h2 class="text-lg font-semibold mt-4">7. Modificaciones a los Términos</h2>
        <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Te notificaremos de cualquier cambio importante en los términos.</p>
        
        <h2 class="text-lg font-semibold mt-4">8. Contacto</h2>
        <p>Si tienes preguntas sobre estos términos, contáctanos en nicolasgmelian@gmail.com .</p>
    </div>
</div>
</div>
</body>
</html>