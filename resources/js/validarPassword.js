document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Selecciona el formulario
    const passwordInput = document.getElementById('password'); // Input de contraseña
    const confirmPasswordInput = document.getElementById('password_confirmation'); // Confirmación de contraseña
    const submitButton = form.querySelector('button[type="submit"]'); // Botón de envío

    // Función para validar las contraseñas
    function validatePasswords() {
        const password = passwordInput.value.trim(); // Obtener y limpiar el valor de la contraseña
        const confirmPassword = confirmPasswordInput.value.trim(); // Obtener y limpiar el valor de la confirmación de contraseña
        let errorMessage = ''; // Mensaje de error

        // Si el campo password está vacío, no hacer validación aún
        if (password === '') {
            confirmPasswordInput.setCustomValidity(''); // Limpiar mensaje de error
            submitButton.disabled = false; // Habilitar el botón de envío
            return;
        }

        // Validaciones de contraseña
        if (password.length < 8) {
            errorMessage = 'La contraseña debe tener al menos 8 caracteres.'; // Mensaje de error si la contraseña es muy corta
        } else if (confirmPassword !== '' && password !== confirmPassword) {
            errorMessage = 'Las contraseñas no coinciden.'; // Mensaje de error si las contraseñas no coinciden
        }

        // Mostrar mensaje de error si lo hay
        confirmPasswordInput.setCustomValidity(errorMessage); // Establecer mensaje de error
        submitButton.disabled = !!errorMessage; // Deshabilitar el botón de envío si hay un error

        // Si hay un error, mostrarlo solo cuando el usuario ha escrito algo en confirmPassword
        if (errorMessage && confirmPassword !== '') {
            confirmPasswordInput.reportValidity(); // Mostrar el mensaje de error
        }
    }

    // Validar solo cuando el usuario escriba en los campos, sin forzar el foco
    passwordInput.addEventListener('input', validatePasswords); // Validar al escribir en el campo de contraseña
    confirmPasswordInput.addEventListener('input', validatePasswords); // Validar al escribir en el campo de confirmación de contraseña

    // Validación antes de enviar el formulario
    form.addEventListener('submit', function (event) {
        validatePasswords(); // Validar contraseñas
        if (confirmPasswordInput.validationMessage) {
            event.preventDefault(); // Evita el envío si hay errores
        }
    });
});
