document.addEventListener('DOMContentLoaded', function() {
    // Simulación del cálculo del total del carrito
    let total = calcularTotalCarrito(); // Asegúrate de reemplazar esto con el cálculo real del carrito

    // Verifica si se está calculando el total correctamente
    console.log('Total calculado en el carrito:', total);

    // Guarda el total en localStorage
    localStorage.setItem('cartTotal', total);

    // Mostrar el total en el carrito para depuración
    const totalPriceElement = document.getElementById('total-price');
    if (totalPriceElement) {
        totalPriceElement.textContent = `$${parseFloat(total).toFixed(2)}`;
    }
});
