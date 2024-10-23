document.addEventListener('DOMContentLoaded', () => {
    const orderForm = document.getElementById('order-form');
    const orderCartProducts = document.getElementById('order-cart-products');
    const orderTotalElement = document.getElementById('order-total');

    // Recupera los productos del carrito desde localStorage
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || []; 
    let total = 0;

    // Función para actualizar la visualización del carrito
    const updateCartDisplay = () => {
        orderCartProducts.innerHTML = ''; // Limpiar la tabla
        total = 0; // Reiniciar el total

        // Si el carrito está vacío, mostrar un mensaje
        if (cartItems.length === 0) {
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `<td colspan="4">El carrito está vacío.</td>`;
            orderCartProducts.appendChild(emptyRow);
            orderTotalElement.innerText = `$0`; // Mostrar $0 como total
            return;
        }

        // Mostrar cada producto en el carrito
        cartItems.forEach(item => {
            const row = document.createElement('tr');
            const totalValue = item.price * item.quantity; // Calcular el total por producto
            total += totalValue; // Sumar al total general

            row.innerHTML = `
                <td>${item.quantity}</td>
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td>$${totalValue}</td>
            `;
            orderCartProducts.appendChild(row);
        });

        // Mostrar el total final
        orderTotalElement.innerText = `$${total}`; 
    };

    // Evento de envío del formulario para guardar el pedido
    orderForm.addEventListener('submit', saveOrder);

    // Función para guardar el pedido
    const saveOrder = (e) => {
        e.preventDefault(); // Evitar el envío normal del formulario

        // Verificar que haya productos en el carrito
        if (cartItems.length === 0) {
            alert("No hay productos en el carrito.");
            return;
        }

        // Recoger datos del formulario
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const grade = document.getElementById('grade').value;
        const phone = document.getElementById('phone').value;

        // Crear un objeto FormData para enviar
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('grade', grade);
        formData.append('phone', phone);
        formData.append('cartItems', JSON.stringify(cartItems)); // Incluir el carrito como JSON

        // Enviar el pedido al servidor
        fetch('procesar_pedido.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mostrar el resultado del procesamiento
            localStorage.removeItem('cartItems'); // Limpiar el carrito
            window.location.href = 'resumen-pedido.html'; // Redirigir a la página de resumen
        })
        .catch(error => {
            console.error('Error:', error); // Manejar errores
        });
    };

    // Actualizar la visualización del carrito al cargar la página
    updateCartDisplay();
});
