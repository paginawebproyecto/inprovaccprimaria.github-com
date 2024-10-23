document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const role = urlParams.get('role'); // Detecta el rol desde la URL (por ejemplo: ?role=admin)
    const roleInput = document.getElementById('role');
    const userFields = document.getElementById('user-fields');
    const adminFields = document.getElementById('admin-fields');

    if (role) {
        roleInput.value = role; // Establece el valor de role según la URL
        if (role === 'user') {
            userFields.style.display = 'block';
            adminFields.style.display = 'none';
        } else if (role === 'admin') {
            userFields.style.display = 'none';
            adminFields.style.display = 'block';
        }
    }
});
