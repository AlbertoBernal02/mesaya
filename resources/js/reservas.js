"use strict";

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    const reservationDate = document.getElementById('reservationDate'); // Elemento de fecha de reserva
    const timeSlot = document.getElementById('timeSlot'); // Elemento de selección de horario

    // Establecer la fecha mínima (hoy)
    const today = new Date().toISOString().split('T')[0]; // Obtener la fecha de hoy en formato ISO
    reservationDate.setAttribute('min', today); // Establecer la fecha mínima en el input de fecha

    // Evento para actualizar datos en el modal antes de abrirlo
    document.querySelectorAll('.open-reservation-modal').forEach(button => {
        button.addEventListener('click', function() {
            const restaurantId = this.getAttribute('data-restaurante-id'); // Obtener el ID del restaurante
            document.getElementById('restaurante').value = restaurantId; // Establecer el ID del restaurante en el input oculto
        });
    });

    // Evento para cargar los horarios cuando se selecciona una fecha
    reservationDate.addEventListener('change', function () {
        const selectedDate = this.value; // Obtener la fecha seleccionada
        const restaurantId = document.getElementById('restaurante').value; // Obtener el ID del restaurante
        loadAvailableTimes(selectedDate, restaurantId); // Cargar los horarios disponibles
    });

    // Función para cargar horarios disponibles desde el backend
    async function loadAvailableTimes(selectedDate, restaurantId) {
        timeSlot.innerHTML = ''; // Limpiar opciones previas

        try {
            const response = await fetch(`/get-schedule?restaurant_id=${restaurantId}&date=${selectedDate}`); // Realizar la solicitud al backend
            if (!response.ok) throw new Error('Error al obtener horarios'); // Manejar errores

            const data = await response.json(); // Convertir la respuesta a JSON
            const openingTime = parseInt(data.opening_time.split(':')[0]); // Obtener la hora de apertura
            const closingTime = parseInt(data.closing_time.split(':')[0]); // Obtener la hora de cierre
            const unavailableHours = data.unavailable_hours || []; // Obtener las horas no disponibles

            // Crear opciones de horario
            for (let hour = openingTime; hour < closingTime; hour++) {
                const timeSlotValue = `${hour}:00`; // Formatear la hora
                if (!unavailableHours.includes(timeSlotValue)) { // Verificar si la hora está disponible
                    const option = document.createElement('option'); // Crear una nueva opción
                    option.value = timeSlotValue; // Establecer el valor de la opción
                    option.textContent = `${hour}:00 - ${hour + 1}:00`; // Establecer el texto de la opción
                    timeSlot.appendChild(option); // Añadir la opción al select
                }
            }
        } catch (error) {
            console.error('Error al obtener los horarios:', error); // Manejar errores
        }
    }
});