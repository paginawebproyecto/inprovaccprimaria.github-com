document.addEventListener('DOMContentLoaded', function () {
    // Recuperar el valor del total del carrito desde localStorage
    const total = localStorage.getItem('cartTotal');
    
    // Mostrar el valor recuperado en la consola
    console.log('Valor recuperado del localStorage:', total);

    // Mostrar el total en el elemento con ID 'total-price'
    const totalPriceElement = document.getElementById('total-price');
    if (total && totalPriceElement) {
        totalPriceElement.textContent = `$${parseFloat(total).toFixed(2)}`; // Formatear con dos decimales
    } else {
        totalPriceElement.textContent = '$0'; // Si no hay valor, mostrar $0
        console.error('No se encontró un valor para el total en localStorage.');
    }

    // Manejar el clic en el botón de "Cerrar sesión"
    document.getElementById('logout-btn').addEventListener('click', function () {
        // Eliminar la sesión
        localStorage.removeItem('userSession'); // Simulación de cierre de sesión
        window.location.href = 'login.html'; // Redirigir a la página de inicio de sesión
    });

    // Manejar el clic en el botón de "Seguir comprando"
    document.getElementById('continue-shopping-btn').addEventListener('click', function () {
        window.location.href = 'menu.html'; // Redirigir a la página de menú
    });
});
