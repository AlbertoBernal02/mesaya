"use strict";
document.addEventListener('DOMContentLoaded', function () {
    function validarFormulario(event, form) {
        event.preventDefault(); // Evita el envío inmediato del formulario

        let valido = true;
        let errores = [];

        const name = form.querySelector('[name="name"]');
        const category = form.querySelector('[name="categories_id"]:checked');
        const image = form.querySelector('[name="image"]');
        const ubication = form.querySelector('[name="ubication"]');
        const totalPrice = form.querySelector('[name="total_price"]');
        const capacity = form.querySelector('[name="capacity"]');
        const openingTime = form.querySelector('[name="opening_time"]');
        const closingTime = form.querySelector('[name="closing_time"]');
        const unavailableHours = form.querySelector('[name="unavailable_hours"]');

        // Expresiones regulares
        const nameRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ-]+$/;
        const ubicationRegex = /^[a-zA-Z0-9\s,.-]+$/;

        // Validar nombre
        if (!nameRegex.test(name.value) || name.value.length < 3) {
            valido = false;
            errores.push("El nombre debe tener al menos 3 caracteres y solo puede contener letras, números y espacios.");
        }

        // Validar categoría seleccionada
        if (!category) {
            valido = false;
            errores.push("Debes seleccionar una categoría.");
        }

        // Validar imagen (solo si el usuario sube una nueva)
        if (image.files.length > 0) {
            const fileName = image.files[0].name.toLowerCase();
            if (!(/\.(jpg|jpeg|png)$/i).test(fileName)) {
                valido = false;
                errores.push("La imagen debe estar en formato JPG, JPEG o PNG.");
            }
        }

        // Validar ubicación
        if (!ubicationRegex.test(ubication.value) || ubication.value.length < 3) {
            valido = false;
            errores.push("La ubicación debe tener al menos 3 caracteres y solo puede contener letras, números, comas y puntos.");
        }

        // Validar precio medio
        if (isNaN(totalPrice.value) || totalPrice.value <= 0 || totalPrice.value > 1000) {
            valido = false;
            errores.push("El precio medio debe ser un número entre 1 y 1000.");
        }

        // Validar aforo
        if (isNaN(capacity.value) || capacity.value < 1 || capacity.value > 500) {
            valido = false;
            errores.push("El aforo debe estar entre 1 y 500 personas.");
        }

        // Validar horas
        if (!openingTime.value || !closingTime.value) {
            valido = false;
            errores.push("Debes indicar la hora de apertura y cierre.");
        } else if (closingTime.value <= openingTime.value) {
            valido = false;
            errores.push("La hora de cierre debe ser mayor que la de apertura.");
        }

        // Validar horas no disponibles (opcional, si es obligatorio seleccionarlas)
        if (unavailableHours && unavailableHours.selectedOptions.length === 0) {
            valido = false;
            errores.push("Debes seleccionar al menos una hora no disponible.");
        }

        // Mostrar errores
        if (!valido) {
            alert("Errores en el formulario:\n\n" + errores.join("\n"));
        } else {
            form.submit();
        }
    }

    // Aplicar validación al formulario de edición
    const editForm = document.querySelector('form');
    editForm.addEventListener('submit', function (event) {
        validarFormulario(event, this);
    });
});