document.addEventListener('DOMContentLoaded', () => {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const orderForm = document.getElementById('order-form');

    // Llenar la tabla del carrito con los productos
    const orderCartProducts = document.getElementById('order-cart-products');
    const orderTotal = document.getElementById('order-total');

    const displayCartItems = () => {
        orderCartProducts.innerHTML = '';
        let total = 0;

        cartItems.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.quantity}</td>
                <td>${item.product}</td>
                <td>$${item.unitPrice.toFixed(2)}</td>
                <td>$${(item.quantity * item.unitPrice).toFixed(2)}</td>
            `;
            orderCartProducts.appendChild(row);
            total += item.quantity * item.unitPrice;
        });

        orderTotal.innerText = `$${total.toFixed(2)}`; // Formatear el total con dos decimales
    };

    const saveOrder = (e) => {
        e.preventDefault();

        // Verificar si hay productos en el carrito
        if (cartItems.length === 0) {
            alert("No hay productos en el carrito.");
            return;
        }

        // Obtener los datos del formulario
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const grade = document.getElementById('grade').value;
        const phone = document.getElementById('phone').value;

        // Validación de campos vacíos
        if (!name || !email || !grade || !phone) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        // Crear un FormData para enviar los datos
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('grade', grade);
        formData.append('phone', phone);
        formData.append('cartItems', JSON.stringify(cartItems)); // Enviar el carrito como JSON

        // Enviar el pedido a procesar
        fetch('procesar_pedido.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mostrar el resultado del procesamiento
            window.location.href = `resumen-pedido.html?total=${total.toFixed(2)}`; // Redirigir con el total en la URL
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };

    // Mostrar los productos en el carrito al cargar la página
    displayCartItems();

    // Evitar que el formulario se recargue
    orderForm.addEventListener('submit', saveOrder);
});
