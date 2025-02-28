"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const openingTimeInput = document.querySelector('input[name="opening_time"]');
    const closingTimeInput = document.querySelector('input[name="closing_time"]');
    const unavailableHoursContainer = document.querySelector("#unavailable-hours-container");
    const toggleButton = document.getElementById("toggle-all");

    function updateUnavailableHours() {
        unavailableHoursContainer.innerHTML = ""; // Limpiar checkboxes previos
        
        let openingTime = openingTimeInput.value;
        let closingTime = closingTimeInput.value;

        if (!openingTime || !closingTime) return; // Evitar errores si aún no se ha seleccionado
        
        let openingHour = parseInt(openingTime.split(':')[0], 10);
        let closingHour = parseInt(closingTime.split(':')[0], 10);

        if (closingHour <= openingHour) return; // Evitar errores si las horas no son válidas

        // Generar checkboxes de hora en hora
        for (let hour = openingHour; hour < closingHour; hour++) {
            let formattedHour = hour.toString().padStart(2, '0') + ":00";

            let div = document.createElement("div");
            div.classList.add("col-md-3");

            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.classList.add("form-check-input", "unavailable-hour");
            checkbox.name = "unavailable_hours[]";
            checkbox.value = formattedHour;
            checkbox.id = "hora_" + formattedHour;

            let label = document.createElement("label");
            label.classList.add("form-check-label");
            label.htmlFor = checkbox.id;
            label.textContent = formattedHour;

            let formCheckDiv = document.createElement("div");
            formCheckDiv.classList.add("form-check");
            formCheckDiv.appendChild(checkbox);
            formCheckDiv.appendChild(label);

            div.appendChild(formCheckDiv);
            unavailableHoursContainer.appendChild(div);
        }
    }

    // Botón para seleccionar/deseleccionar todas
    toggleButton.addEventListener("click", function () {
        const checkboxes = document.querySelectorAll(".unavailable-hour");
        let allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
        checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
    });

    // Escuchar cambios en los inputs de hora
    openingTimeInput.addEventListener("change", updateUnavailableHours);
    closingTimeInput.addEventListener("change", updateUnavailableHours);

    // Cargar inicialmente en caso de que haya valores precargados
    updateUnavailableHours();
});