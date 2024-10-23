let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

function addToCart(product) {
    const existingItem = cartItems.find(item => item.name === product.name);

    if (existingItem) {
        existingItem.quantity += product.quantity; // Incrementa la cantidad si el producto ya está en el carrito
    } else {
        cartItems.push(product); // Agrega el nuevo producto
    }

    localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Guarda el carrito en el localStorage
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartCount = document.getElementById('cart-count');
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');

    // Limpia el contenido del carrito
    cartItemsContainer.innerHTML = '';
    let totalPrice = 0;

    if (cartItems.length === 0) {
        cartItemsContainer.innerHTML = '<li>El carrito está vacío.</li>';
        totalPriceElement.textContent = 'Total: $0';
    } else {
        cartItems.forEach(item => {
            const listItem = document.createElement('li');
            listItem.textContent = `${item.name} - Cantidad: ${item.quantity} - Precio: $${item.price * item.quantity}`;
            cartItemsContainer.appendChild(listItem);
            totalPrice += item.price * item.quantity; // Suma el precio total
        });

        cartCount.textContent = cartItems.length; // Actualiza el contador
        totalPriceElement.textContent = `Total: $${totalPrice}`; // Actualiza el total
    }
}

// Llama a updateCartDisplay al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    updateCartDisplay();
});

// Función para abrir/cerrar el carrito
document.getElementById('toggle-cart').addEventListener('click', () => {
    const cart = document.getElementById('cart');
    cart.classList.toggle('closed');
});
