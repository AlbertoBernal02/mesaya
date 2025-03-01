"use strict";

document.addEventListener('DOMContentLoaded', function () {
    // Función para validar el formulario
    function validarFormulario(event, form) {
        event.preventDefault(); // Evita el envío inmediato del formulario

        let valido = true; // Variable para verificar si el formulario es válido
        let errores = []; // Array para almacenar los mensajes de error

        // Identificar si es formulario de reservas o de productos
        const isReserva = form.id === "reservationForm";

        if (isReserva) {
            // Validación para RESERVAS
            const fecha = form.querySelector('[name="fecha"]'); // Input de fecha de reserva
            const hora = form.querySelector('[name="hora"]'); // Input de hora de reserva
            const numComensales = form.querySelector('[name="num_comensales"]'); // Input de número de comensales

            const hoy = new Date().toISOString().split('T')[0]; // Obtener la fecha de hoy en formato ISO

            if (!fecha || !fecha.value || fecha.value < hoy) {
                valido = false;
                errores.push("Debes seleccionar una fecha válida (no pasada)."); // Mensaje de error si la fecha no es válida
            }
            if (!hora || !hora.value) {
                valido = false;
                errores.push("Debes seleccionar una hora válida."); // Mensaje de error si la hora no es válida
            }
            if (!numComensales || isNaN(numComensales.value) || numComensales.value < 1 || numComensales.value > 50) {
                valido = false;
                errores.push("El número de comensales debe estar entre 1 y 50."); // Mensaje de error si el número de comensales no es válido
            }
        } else {
            // Validación para PRODUCTOS / RESTAURANTES
            const name = form.querySelector('[name="name"]'); // Input de nombre
            const category = form.querySelector('[name="categories_id"]:checked'); // Input de categoría seleccionada
            const image = form.querySelector('[name="image"]'); // Input de imagen
            const ubication = form.querySelector('[name="ubication"]'); // Input de ubicación
            const totalPrice = form.querySelector('[name="total_price"]'); // Input de precio medio
            const capacity = form.querySelector('[name="capacity"]'); // Input de aforo
            const openingTime = form.querySelector('[name="opening_time"]'); // Input de hora de apertura
            const closingTime = form.querySelector('[name="closing_time"]'); // Input de hora de cierre
            const email = form.querySelector('[name="email"]'); // Input de correo electrónico

            const nameRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ-]+$/; // Regex para validar el nombre
            const ubicationRegex = /^[a-zA-Z0-9\s,.-]+$/; // Regex para validar la ubicación
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex para validar el correo electrónico

            if (name && (!nameRegex.test(name.value) || name.value.length < 3)) {
                valido = false;
                errores.push("El nombre debe tener al menos 3 caracteres y solo puede contener letras, números y espacios."); // Mensaje de error si el nombre no es válido
            }
            if (form.querySelector('[name="categories_id"]') && !category) {
                valido = false;
                errores.push("Debes seleccionar una categoría."); // Mensaje de error si no se selecciona una categoría
            }
            if (image && image.files.length > 0) {
                const fileName = image.files[0].name.toLowerCase();
                if (!(/\.(jpg|jpeg|png)$/i).test(fileName)) {
                    valido = false;
                    errores.push("La imagen debe estar en formato JPG, JPEG o PNG."); // Mensaje de error si la imagen no es válida
                }
            }
            if (ubication && (!ubicationRegex.test(ubication.value) || ubication.value.length < 3)) {
                valido = false;
                errores.push("La ubicación debe tener al menos 3 caracteres y solo puede contener letras, números, comas y puntos."); // Mensaje de error si la ubicación no es válida
            }
            if (totalPrice && (isNaN(totalPrice.value) || totalPrice.value <= 0 || totalPrice.value > 1000)) {
                valido = false;
                errores.push("El precio medio debe ser un número entre 1 y 1000."); // Mensaje de error si el precio medio no es válido
            }
            if (capacity && (isNaN(capacity.value) || capacity.value < 1 || capacity.value > 500)) {
                valido = false;
                errores.push("El aforo debe estar entre 1 y 500 personas."); // Mensaje de error si el aforo no es válido
            }
            if (openingTime && closingTime) {
                if (!openingTime.value || !closingTime.value) {
                    valido = false;
                    errores.push("Debes indicar la hora de apertura y cierre."); // Mensaje de error si no se indican las horas de apertura y cierre
                } else if (closingTime.value <= openingTime.value) {
                    valido = false;
                    errores.push("La hora de cierre debe ser mayor que la de apertura."); // Mensaje de error si la hora de cierre no es válida
                }
            }
            if (email && !emailRegex.test(email.value)) {
                valido = false;
                errores.push("El correo electrónico no es válido."); // Mensaje de error si el correo electrónico no es válido
            }
        }

        // Mostrar errores
        if (!valido) {
            alert("Errores en el formulario:\n\n" + errores.join("\n")); // Mostrar los errores en una alerta
        } else {
            form.submit(); // Enviar el formulario si es válido
        }
    }

    // Aplicar validación a TODOS los formularios
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (event) {
            validarFormulario(event, this); // Validar el formulario al enviarlo
        });
    });
});