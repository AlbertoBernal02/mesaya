import './bootstrap'; // Importa el archivo bootstrap.js

// Espera a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Realiza una solicitud para obtener las categorías
    fetch('/categories')
        .then(response => response.json()) // Convierte la respuesta a JSON
        .then(data => {
            let select = document.getElementById("categories_id"); // Obtiene el elemento select
            select.innerHTML = '<option value="">Selecciona una categoría</option>'; // Añade una opción por defecto
            data.forEach(category => {
                let option = document.createElement("option"); // Crea una nueva opción
                option.value = category.id; // Establece el valor de la opción
                option.textContent = category.name; // Establece el texto de la opción
                select.appendChild(option); // Añade la opción al select
            });
        })
        .catch(error => console.error("Error al cargar las categorías:", error)); // Maneja errores
});

import './reservas.js'; // Importa el archivo reservas.js

import './imagePreview.js'; // Importa el archivo imagePreview.js

import './validateFormWelcome.js'; // Importa el archivo validateFormWelcome.js

import './validateFormEdit.js'; // Importa el archivo validateFormEdit.js

import './validarPassword.js'; // Importa el archivo validarPassword.js

import './unavailableHours.js'; // Importa el archivo unavailableHours.js

import './confirmDelete.js'; // Importa el archivo confirmDelete.js