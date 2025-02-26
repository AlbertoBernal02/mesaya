document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Selecciona el formulario
    const passwordInput = document.getElementById('password'); // Input de contraseña
    const confirmPasswordInput = document.getElementById('password_confirmation'); // Confirmación de contraseña
    const submitButton = form.querySelector('button[type="submit"]'); // Botón de envío

    function validatePasswords() {
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();
        let errorMessage = '';

        // Si el campo password está vacío, no hacer validación aún
        if (password === '') {
            confirmPasswordInput.setCustomValidity('');
            submitButton.disabled = false;
            return;
        }

        // Validaciones de contraseña
        if (password.length < 8) {
            errorMessage = 'La contraseña debe tener al menos 8 caracteres.';
        } else if (confirmPassword !== '' && password !== confirmPassword) {
            errorMessage = 'Las contraseñas no coinciden.';
        }

        // Mostrar mensaje de error si lo hay
        confirmPasswordInput.setCustomValidity(errorMessage);
        submitButton.disabled = !!errorMessage;

        // Si hay un error, mostrarlo solo cuando el usuario ha escrito algo en confirmPassword
        if (errorMessage && confirmPassword !== '') {
            confirmPasswordInput.reportValidity();
        }
    }

    // Validar solo cuando el usuario escriba en los campos, sin forzar el foco
    passwordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);

    // Validación antes de enviar el formulario
    form.addEventListener('submit', function (event) {
        validatePasswords();
        if (confirmPasswordInput.validationMessage) {
            event.preventDefault(); // Evita el envío si hay errores
        }
    });
});
