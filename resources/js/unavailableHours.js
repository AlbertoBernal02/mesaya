"use strict";

// Esperar a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    const openingTimeInput = document.querySelector('input[name="opening_time"]'); // Input de hora de apertura
    const closingTimeInput = document.querySelector('input[name="closing_time"]'); // Input de hora de cierre
    const unavailableHoursContainer = document.querySelector("#unavailable-hours-container"); // Contenedor de horas no disponibles
    const toggleButton = document.getElementById("toggle-all"); // Botón para seleccionar/deseleccionar todas

    // Función para actualizar las horas no disponibles
    function updateUnavailableHours() {
        unavailableHoursContainer.innerHTML = ""; // Limpiar checkboxes previos
        
        let openingTime = openingTimeInput.value; // Obtener la hora de apertura
        let closingTime = closingTimeInput.value; // Obtener la hora de cierre

        if (!openingTime || !closingTime) return; // Evitar errores si aún no se ha seleccionado
        
        let openingHour = parseInt(openingTime.split(':')[0], 10); // Convertir la hora de apertura a entero
        let closingHour = parseInt(closingTime.split(':')[0], 10); // Convertir la hora de cierre a entero

        if (closingHour <= openingHour) return; // Evitar errores si las horas no son válidas

        // Generar checkboxes de hora en hora
        for (let hour = openingHour; hour < closingHour; hour++) {
            let formattedHour = hour.toString().padStart(2, '0') + ":00"; // Formatear la hora

            let div = document.createElement("div"); // Crear un div contenedor
            div.classList.add("col-md-3"); // Añadir clase al div

            let checkbox = document.createElement("input"); // Crear un checkbox
            checkbox.type = "checkbox"; // Establecer el tipo de input
            checkbox.classList.add("form-check-input", "unavailable-hour"); // Añadir clases al checkbox
            checkbox.name = "unavailable_hours[]"; // Establecer el nombre del checkbox
            checkbox.value = formattedHour; // Establecer el valor del checkbox
            checkbox.id = "hora_" + formattedHour; // Establecer el id del checkbox

            let label = document.createElement("label"); // Crear una etiqueta
            label.classList.add("form-check-label"); // Añadir clase a la etiqueta
            label.htmlFor = checkbox.id; // Establecer el atributo for de la etiqueta
            label.textContent = formattedHour; // Establecer el texto de la etiqueta

            let formCheckDiv = document.createElement("div"); // Crear un div contenedor para el checkbox y la etiqueta
            formCheckDiv.classList.add("form-check"); // Añadir clase al div
            formCheckDiv.appendChild(checkbox); // Añadir el checkbox al div
            formCheckDiv.appendChild(label); // Añadir la etiqueta al div

            div.appendChild(formCheckDiv); // Añadir el div contenedor al div principal
            unavailableHoursContainer.appendChild(div); // Añadir el div principal al contenedor de horas no disponibles
        }
    }

    // Botón para seleccionar/deseleccionar todas
    toggleButton.addEventListener("click", function () {
        const checkboxes = document.querySelectorAll(".unavailable-hour"); // Obtener todos los checkboxes
        let allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked); // Verificar si todos los checkboxes están seleccionados
        checkboxes.forEach(checkbox => checkbox.checked = !allChecked); // Seleccionar/deseleccionar todos los checkboxes
    });

    // Escuchar cambios en los inputs de hora
    openingTimeInput.addEventListener("change", updateUnavailableHours); // Actualizar horas no disponibles al cambiar la hora de apertura
    closingTimeInput.addEventListener("change", updateUnavailableHours); // Actualizar horas no disponibles al cambiar la hora de cierre

    // Cargar inicialmente en caso de que haya valores precargados
    updateUnavailableHours(); // Llamar a la función para actualizar las horas no disponibles
});