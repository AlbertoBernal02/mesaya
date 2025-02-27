"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const openingTimeInput = document.querySelector('input[name="opening_time"]');
    const closingTimeInput = document.querySelector('input[name="closing_time"]');
    const unavailableHoursSelect = document.querySelector('#unavailable_hours');

    function updateUnavailableHours() {
        unavailableHoursSelect.innerHTML = ""; // Limpiar opciones anteriores
        
        let openingTime = openingTimeInput.value;
        let closingTime = closingTimeInput.value;

        if (!openingTime || !closingTime) return; // Evitar errores si aún no se ha seleccionado
        
        let openingHour = parseInt(openingTime.split(':')[0], 10);
        let closingHour = parseInt(closingTime.split(':')[0], 10);

        // Si la hora de cierre es menor o igual que la de apertura, no generamos opciones
        if (closingHour <= openingHour) return;

        // Generar opciones de hora en hora
        for (let hour = openingHour; hour < closingHour; hour++) {
            let formattedHour = hour.toString().padStart(2, '0') + ":00";
            let option = new Option(formattedHour, formattedHour);
            unavailableHoursSelect.appendChild(option);
        }
    }

    // Escuchar cambios en los inputs de hora
    openingTimeInput.addEventListener("change", updateUnavailableHours);
    closingTimeInput.addEventListener("change", updateUnavailableHours);

    // Cargar inicialmente en caso de que haya valores precargados
    updateUnavailableHours();
});