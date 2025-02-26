"use strict";
document.addEventListener('DOMContentLoaded', function () {
    function validarFormulario(event, form) {
        event.preventDefault(); // Evita el envío inmediato del formulario

        let valido = true;
        let errores = [];

        // Identificar si es formulario de reservas o de productos
        const isReserva = form.id === "reservationForm";

        if (isReserva) {
            // 🔹 Validación para RESERVAS
            const fecha = form.querySelector('[name="fecha"]');
            const hora = form.querySelector('[name="hora"]');
            const numComensales = form.querySelector('[name="num_comensales"]');

            const hoy = new Date().toISOString().split('T')[0];

            if (!fecha || !fecha.value || fecha.value < hoy) {
                valido = false;
                errores.push("Debes seleccionar una fecha válida (no pasada).");
            }
            if (!hora || !hora.value) {
                valido = false;
                errores.push("Debes seleccionar una hora válida.");
            }
            if (!numComensales || isNaN(numComensales.value) || numComensales.value < 1 || numComensales.value > 50) {
                valido = false;
                errores.push("El número de comensales debe estar entre 1 y 50.");
            }
        } else {
            // 🔹 Validación para PRODUCTOS / RESTAURANTES
            const name = form.querySelector('[name="name"]');
            const category = form.querySelector('[name="categories_id"]:checked');
            const image = form.querySelector('[name="image"]');
            const ubication = form.querySelector('[name="ubication"]');
            const totalPrice = form.querySelector('[name="total_price"]');
            const capacity = form.querySelector('[name="capacity"]');
            const openingTime = form.querySelector('[name="opening_time"]');
            const closingTime = form.querySelector('[name="closing_time"]');
            const email = form.querySelector('[name="email"]');

            const nameRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ-]+$/;
            const ubicationRegex = /^[a-zA-Z0-9\s,.-]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (name && (!nameRegex.test(name.value) || name.value.length < 3)) {
                valido = false;
                errores.push("El nombre debe tener al menos 3 caracteres y solo puede contener letras, números y espacios.");
            }
            if (form.querySelector('[name="categories_id"]') && !category) {
                valido = false;
                errores.push("Debes seleccionar una categoría.");
            }
            if (image && image.files.length > 0) {
                const fileName = image.files[0].name.toLowerCase();
                if (!(/\.(jpg|jpeg|png)$/i).test(fileName)) {
                    valido = false;
                    errores.push("La imagen debe estar en formato JPG, JPEG o PNG.");
                }
            }
            if (ubication && (!ubicationRegex.test(ubication.value) || ubication.value.length < 3)) {
                valido = false;
                errores.push("La ubicación debe tener al menos 3 caracteres y solo puede contener letras, números, comas y puntos.");
            }
            if (totalPrice && (isNaN(totalPrice.value) || totalPrice.value <= 0 || totalPrice.value > 1000)) {
                valido = false;
                errores.push("El precio medio debe ser un número entre 1 y 1000.");
            }
            if (capacity && (isNaN(capacity.value) || capacity.value < 1 || capacity.value > 500)) {
                valido = false;
                errores.push("El aforo debe estar entre 1 y 500 personas.");
            }
            if (openingTime && closingTime) {
                if (!openingTime.value || !closingTime.value) {
                    valido = false;
                    errores.push("Debes indicar la hora de apertura y cierre.");
                } else if (closingTime.value <= openingTime.value) {
                    valido = false;
                    errores.push("La hora de cierre debe ser mayor que la de apertura.");
                }
            }
            if (email && !emailRegex.test(email.value)) {
                valido = false;
                errores.push("El correo electrónico no es válido.");
            }
        }

        // Mostrar errores
        if (!valido) {
            alert("Errores en el formulario:\n\n" + errores.join("\n"));
        } else {
            form.submit();
        }
    }

    // Aplicar validación a TODOS los formularios
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (event) {
            validarFormulario(event, this);
        });
    });
});