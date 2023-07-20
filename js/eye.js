document.addEventListener('DOMContentLoaded', function () {
    feather.replace();

    const passwordFields = document.querySelectorAll('input[type="password"]');
    const passwordIcons = document.querySelectorAll('.password-icon');
    const eyeIcons = document.querySelectorAll('.feather-eye');
    const eyeOffIcons = document.querySelectorAll('.feather-eye-off');

    for (let i = 0; i < passwordFields.length; i++) {
        const passwordField = passwordFields[i];
        const passwordIcon = passwordIcons[i];
        const eyeIcon = eyeIcons[i];
        const eyeOffIcon = eyeOffIcons[i];

        eyeIcon.addEventListener('click', () => {
            eyeIcon.style.display = 'none';
            eyeOffIcon.style.display = 'block';
            passwordField.type = 'text';
        });

        eyeOffIcon.addEventListener('click', () => {
            eyeOffIcon.style.display = 'none';
            eyeIcon.style.display = 'block';
            passwordField.type = 'password';
        });
    }
});
