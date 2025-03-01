"use strict";

// Función para actualizar la vista previa de la imagen
function previewImage(event) {
    const file = event.target.files[0]; // Captura el archivo seleccionado
    const output = document.getElementById('imagePreview'); // Elemento donde se muestra la imagen

    if (file && output) {
        const reader = new FileReader(); // Crea un nuevo FileReader
        reader.onload = function () {
            // Borra el `src` y actualiza con la nueva imagen seleccionada
            output.src = "";
            output.src = reader.result; // Establece el resultado de la lectura como el src de la imagen
        };
        reader.readAsDataURL(file); // Lee el archivo como una URL de datos
    }
}

// Esperar a que el DOM cargue para agregar el evento al input file
document.addEventListener("DOMContentLoaded", function () {
    const inputImage = document.getElementById('image'); // Obtiene el input de la imagen
    if (inputImage) {
        inputImage.addEventListener('change', previewImage); // Agrega el evento change al input
    }
});
