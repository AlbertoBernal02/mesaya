"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const reservationDate = document.getElementById('reservationDate');
    const timeSlot = document.getElementById('timeSlot');

    // Establecer la fecha mínima (hoy)
    const today = new Date().toISOString().split('T')[0];
    reservationDate.setAttribute('min', today);

    // 🟢 Evento para actualizar datos en el modal antes de abrirlo
    document.querySelectorAll('.open-reservation-modal').forEach(button => {
        button.addEventListener('click', function() {
            const restaurantId = this.getAttribute('data-restaurante-id');
            document.getElementById('restaurante').value = restaurantId;
        });
    });

    // 🟢 Evento para cargar los horarios cuando se selecciona una fecha
    reservationDate.addEventListener('change', function () {
        const selectedDate = this.value;
        const restaurantId = document.getElementById('restaurante').value;
        loadAvailableTimes(selectedDate, restaurantId);
    });

    // 🟢 Función para cargar horarios disponibles desde el backend
    async function loadAvailableTimes(selectedDate, restaurantId) {
        timeSlot.innerHTML = ''; // Limpiar opciones previas

        try {
            const response = await fetch(`/get-schedule?restaurant_id=${restaurantId}&date=${selectedDate}`);
            if (!response.ok) throw new Error('Error al obtener horarios');

            const data = await response.json();
            const openingTime = parseInt(data.opening_time.split(':')[0]);
            const closingTime = parseInt(data.closing_time.split(':')[0]);
            const unavailableHours = data.unavailable_hours || [];

            // Crear opciones de horario
            for (let hour = openingTime; hour < closingTime; hour++) {
                const timeSlotValue = `${hour}:00`;
                if (!unavailableHours.includes(timeSlotValue)) {
                    const option = document.createElement('option');
                    option.value = timeSlotValue;
                    option.textContent = `${hour}:00 - ${hour + 1}:00`;
                    timeSlot.appendChild(option);
                }
            }
        } catch (error) {
            console.error('Error al obtener los horarios:', error);
        }
    }
});