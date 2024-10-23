document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');
    const loginForm = document.getElementById('login-form');
    const roleField = document.getElementById('role');
    const userFields = document.getElementById('user-fields');

    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const role = roleField.value;
            const fullName = document.getElementById('full-name').value;
            const password = document.getElementById('password').value;

            let user = {
                role,
                fullName,
                password,
            };

            if (role === 'usuario') {
                user.grade = document.getElementById('grade').value;
                user.id = document.getElementById('id').value;
                user.phone = document.getElementById('phone').value;
                user.email = document.getElementById('email').value;
            }

            localStorage.setItem('user', JSON.stringify(user));
            alert('Registro exitoso');
            window.location.href = 'login.html';
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const fullName = document.getElementById('full-name').value;
            const password = document.getElementById('password').value;
            const storedUser = JSON.parse(localStorage.getItem('user'));

            if (storedUser && storedUser.fullName === fullName && storedUser.password === password) {
                window.location.href = 'index.html';
            } else {
                alert('Nombre o contraseña incorrectos');
            }
        });
    }
});
