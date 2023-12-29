<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Convierte imágenes a texto fácilmente con nuestro avanzado convertidor online. Ideal para extraer texto de fotos, documentos escaneados y capturas de pantalla. Convierte de imagen a texto, foto a texto o jpg a texto de manera rápida y precisa.">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">




    <title>Imagen A Texto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.7.3/dist/alpine.min.js"></script>

   <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0YV2YJNKQW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0YV2YJNKQW');
</script>

</head>
<div>
<x-navbar/>

<div class="text-center mt-10 mb-10">
    <h2 class="font-bold text-3xl text-neutral">Convierte tus imagenes a textos con un simple click</h2>
</div>
<div class="container mx-auto p-4 max-w-screen-lg">
    <form action="{{ url('/') }}" method="post" enctype="multipart/form-data" id="my-form" class="text-center border-2 border-dashed border-primary rounded-lg pb-12 pt-12 text-center">
        @csrf
        <div id="arrastra" class="text-lg font-semibold">
            Arrastra tus imágenes aquí
        </div>
    
        <!-- En algún lugar dentro de su formulario o cerca de él -->
        <div id="loading-spinner-container" class="hidden">
            <span class="loading loading-spinner loading-lg"></span>
        </div>
    
        <label for="image" class="hidden">Subir Imagen</label>
        <input type="file" name="images[]" id="image" accept="image/*" class="file-input file-input-bordered file-input-primary w-full max-w-xs mx-auto block mt-4" multiple onchange="previewImage(event)">
        <button type="submit" class="btn text-white text-base btn-primary mt-6 mb-2">Extraer Texto</button>
        <button id="restart-button" type="button" class="btn text-base btn-secondary mt-6 mb-2 hidden">Volver a empezar</button>
    </form>
    

   
   <div id="image-preview-container" class="mt-4"></div>
</div>
</div>

<x-sectionDescription />


<x-explication />


<!-- mostrar si el usuario no esta suscripto -->
@guest
<x-priceSection/>
@endguest

@auth
@if (!Auth::user()->subscribed())
<x-priceSection/>
@endif
@endauth

<x-questions />
<x-footer/>


<!-- Modal para limite de imagenes -->
<dialog id="my_modal_1" class="modal">
  <div class="modal-box text-center">
    <h3 class="font-bold text-lg">Limite Máximo: 3 Imágenes</h3>
    <p class="py-2">¡Compra nuestra subscripcion y sube hasta 30 imagenes a la vez!</p>
    <div class="modal-action justify-center">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        <!-- if there is a button in form, it will close the modal -->
        <a href="/#premium" class="btn button gradient mt-2 premium">
            Comprar
        </a>
      </form>
    </div>
  </div>
</dialog>

<!-- Modal para imagenes muy grandes -->
<dialog id="my_modal_4" class="modal">
  <div class="modal-box text-center">
    <h3 class="font-bold text-lg">Imagen demasiado grande</h3>
    <p class="py-2">El tamaño máximo de la imagen es de 3 MB, adquiere nuestra subscripcion y sube imagenes de hasta 15mb</p>
    <div class="modal-action justify-center">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        <!-- if there is a button in form, it will close the modal -->
        <a href="/#premium" class="btn button gradient mt-2 premium">
            Comprar
        </a>
      </form>
    </div>
  </div>
</dialog>

<!-- Modal para archivos no soportados -->
<dialog id="my_modal_3" class="modal">
  <div class="modal-box text-center">
    <h3 class="font-bold text-lg">Archivo no soportado</h3>
    <p class="py-4">Solo se permiten imagenes</p>
    <div class="modal-action justify-center">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        <!-- if there is a button in form, it will close the modal -->
      </form>
    </div>
  </div>
</dialog>



<script>


var isSubscribed = false;
    @auth
        isSubscribed = {{ Auth::user()->subscribed() ? 'true' : 'false' }};
    @endauth

let archivosTotales = [];
let imagenCounter= 0;
const limiteDeImagenes = isSubscribed ? 30 : 3;
let contadorImagenes = 0;
const tamañoImagenes = 3 * 1024 * 1024; // 3 MB
const tamañoMaximoImagenes = isSubscribed ? 15 * 1024 * 1024 : 3 * 1024 * 1024; // 15 MB

// modal 
if (isSubscribed) {
    // Configuración para usuarios suscritos
    document.querySelector('#my_modal_1 .modal-box h3').textContent = "Limite Máximo Alcanzado";
    document.querySelector('#my_modal_1 .modal-box p').textContent = "Has alcanzado el límite máximo de 30 imágenes.";
    // Ocultar el botón de suscripción
    let premiumButton = document.querySelector('#my_modal_1 .premium');
    if (premiumButton) premiumButton.style.display = 'none';

    document.querySelector('#my_modal_4 .modal-box h3').textContent = "Imagen Demasiado Grande";
    document.querySelector('#my_modal_4 .modal-box p').textContent = "El tamaño máximo permitido es de 15 MB.";
    // Ocultar el botón de suscripción en el modal de imagen grande
    let premiumButtonModal4 = document.querySelector('#my_modal_4 .premium');
    if (premiumButtonModal4) premiumButtonModal4.style.display = 'none';
}




//funcion para previsualizar las imagenes
function previewImage(files){
    var output = document.getElementById('image-preview-container');
    
    Array.from(files).forEach((file) =>{
        // verificar si el archivo es una imagen
        if(!file.type.startsWith('image/')){
            document.getElementById('my_modal_3').showModal();
            return;
        }

        if(contadorImagenes >= limiteDeImagenes){
            document.getElementById('my_modal_1').showModal();
            return;
        }

        if(file.size > tamañoMaximoImagenes){
            document.getElementById('my_modal_4').showModal();
            return;
        }
        

        var reader = new FileReader();
        reader.onload = function(event){
            var imageContainer = document.createElement('div');
            imageContainer.className = "flex ml-4 items-center";

            // Usar un contador para generar un ID único
            var imageIdentifier = file.name;

            imageContainer.id= "preview-" + imageIdentifier;


            imageContainer.innerHTML = `
                <img src="${event.target.result}" class="block rounded-lg w-40 h-40 object-contain mt-2" />
                <div id="text-${imageIdentifier}" class="text-container w-full m-4"></div>
            `;

            output.appendChild(imageContainer);
        };

        reader.readAsDataURL(file);
        });

}


document.getElementById('image').addEventListener('change', function(){
    if(contadorImagenes + this.files.length > limiteDeImagenes){
        document.getElementById('my_modal_1').showModal();
        return;
    }

   previewImage(this.files);
    actualizarArchivosTotales(Array.from(this.files));
});

function handleDragOver(e) {
    e.preventDefault();
    // Aquí puedes agregar cualquier lógica adicional necesaria
}

function handleDrop(e) {
    e.preventDefault();
    let archivosDesdeDrag = e.dataTransfer.files;
    if(contadorImagenes + archivosDesdeDrag.length > limiteDeImagenes){
        document.getElementById('my_modal_1').showModal();
        return;
    }
    previewImage(archivosDesdeDrag);
    actualizarArchivosTotales(Array.from(archivosDesdeDrag));
}

document.querySelector('#my-form').addEventListener('dragover', handleDragOver);
document.querySelector('#my-form').addEventListener('drop', handleDrop);



// Función para actualizar archivosTotales y el input de archivo
function actualizarArchivosTotales(nuevosArchivos) {
    nuevosArchivos = nuevosArchivos.filter(archivo => archivo.size <= tamañoMaximoImagenes);
    archivosTotales = archivosTotales.concat(nuevosArchivos);
    if (archivosTotales.length > limiteDeImagenes) {
        archivosTotales = archivosTotales.slice(0, limiteDeImagenes);
    }
    asignarArchivosAInput();
}

// Función para asignar archivosTotales al input de archivo usando DataTransfer
function asignarArchivosAInput() {
    // no agregar cuando no es una imagen
    archivosTotales = archivosTotales.filter(archivo => archivo.type.match('image'));

    let dataTransfer = new DataTransfer();
    archivosTotales.forEach(archivo => {
        dataTransfer.items.add(archivo);
    });
    document.getElementById('image').files = dataTransfer.files;
}

// funcion para enviar los archivos al servidor
document.getElementById('my-form').addEventListener('submit', function(e){
    e.preventDefault(); // Evita que se abra el archivo en el navegador

     // Mostrar el spinner
     document.getElementById('loading-spinner-container').classList.remove('hidden');

    let formData = new FormData();// recogemos los datos del formulario
    console.log("Archivos a enviar:", archivosTotales);


    archivosTotales.forEach(archivo => {
        formData.append('images[]', archivo);
    });

    // Verificar si se han seleccionado imágenes
    if (archivosTotales.length === 0) {
        document.getElementById('my_modal_1').showModal();
        return;
    }

    fetch('/', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        mostrarResultados(data);
        // Ocultar el spinner
        document.getElementById('loading-spinner-container').classList.add('hidden');
    })
    .catch(error => {
        console.error(error);
        // Ocultar el spinner
        document.getElementById('loading-spinner-container').classList.add('hidden');
    });
});

// Mostrar los resultados en la página
function mostrarResultados(data) {
    console.log(data);
    data.forEach((item) => {
        // Asegúrate de que el ID de la imagen coincida con el enviado desde el servidor
        let imageContainer = document.getElementById("preview-" + item.image);
        if (imageContainer) {
            let textAreaId = "textarea-" + item.id;
            let textContainer = imageContainer.querySelector('.text-container');
            textContainer.innerHTML = `
            <div class="relative">
                <textarea id="${textAreaId}" class="w-full textarea textarea-secondary" rows="4">${item.text}</textarea>
                <div class="button-container">
                <div class="tooltip" data-tip="copiar">
                <button onclick="copiarTexto('${textAreaId}')" class="btnIcon"><img class="buttonSvg" src="/svg/copy.svg" /></button>
                </div>
                <div class="tooltip" data-tip="descargar">
                <button onclick="descargarTexto('${textAreaId}')" class="btnIcon"><img class="buttonSvg" src="/svg/download.svg" /></button>
                </div>
                </div>
            </div>`;
        }
    });

      // Ocultar el botón "Extraer Texto"
      document.querySelector('button[type="submit"]').classList.add('hidden');

      // ocultar el input
        document.getElementById('image').classList.add('hidden');

// Deshabilitar drag and drop
document.querySelector('#my-form').removeEventListener('dragover', handleDragOver);
document.querySelector('#my-form').removeEventListener('drop', handleDrop);
document.getElementById('restart-button').classList.remove('hidden');
document.getElementById('arrastra').classList.add('hidden');
// remover clase border-primary al formulario
document.getElementById('my-form').classList.remove('border-primary');
// agregar clase border-neutral al formulario
document.getElementById('my-form').classList.add('border-secondary');


} 
function copiarTexto(textAreaId) {
    let textarea = document.getElementById(textAreaId);
    textarea.select();
    document.execCommand("copy");
}

function descargarTexto(textAreaId) {
    let texto = document.getElementById(textAreaId).value;
    let elemento = document.createElement('a');
    elemento.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(texto));
    elemento.setAttribute('download', "texto_imagenatexto.txt"); // Cambiar el nombre del archivo aquí

    elemento.style.display = 'none';
    document.body.appendChild(elemento);

    elemento.click();

    document.body.removeChild(elemento);
}




document.getElementById('restart-button').addEventListener('click', function() {
    document.getElementById('image-preview-container').innerHTML = ''; // Limpiar previsualización
    document.getElementById('image').value = ''; // Restablecer el input de archivos

    document.querySelector('button[type="submit"]').classList.remove('hidden'); // Mostrar botón "Extraer Texto"
    document.getElementById('image').classList.remove('hidden'); // Mostrar input
    document.getElementById('arrastra').classList.remove('hidden');

    // Reasignar clase border-primary al formulario
    document.getElementById('my-form').classList.add('border-primary');
    // remover clase border-secondary al formulario
    document.getElementById('my-form').classList.remove('border-secondary');

    this.classList.add('hidden'); // Ocultar botón "Volver a empezar"

    archivosTotales = []; // Reiniciar lista de archivos
    contadorImagenes = 0; // Reiniciar el contador de imágenes

    // Reasignar eventos de drag and drop
    var formElement = document.querySelector('my-form');
    formElement.addEventListener('dragover', handleDragOver);
    formElement.addEventListener('drop', handleDrop);

        

    asignarArchivosAInput(); // Asignar de nuevo los archivos totales al input
});






</script>

<style>
   

.button-container {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.5rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-right: 10px;
}


.btnIcon {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30px; /* Ajusta el tamaño del botón */
    height: 30px; /* Asegura que el botón sea cuadrado */
    border: 1.5px solid black; /* Borde negro */
    padding: 3px;
    margin: 4px;
    background-color: white;
    cursor: pointer;
    border-radius: 5px; /* Bordes redondeados */
}

.btn-circle:focus, .btn-circle:active {
    box-shadow: none; /* Ejemplo: eliminar sombra para cambiar la apariencia */
    outline: none; /* Eliminar el contorno que aparece al enfocar */
}
</style>
</html>