document.addEventListener('DOMContentLoaded', () => {
    const ordersTableBody = document.getElementById('orders-table-body');

    const updateOrdersList = async () => {
        try {
            const response = await fetch('get_orders.php'); // Llamar al archivo PHP
            const orders = await response.json(); // Convertir la respuesta a JSON

            // Limpiar el cuerpo de la tabla
            ordersTableBody.innerHTML = '';

            // Si no hay pedidos, muestra un mensaje
            if (orders.length === 0) {
                ordersTableBody.innerHTML = '<tr><td colspan="6">No hay pedidos realizados aún.</td></tr>';
                return;
            }

            // Agregar cada pedido a la tabla
            orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.nombre}</td>
                    <td>${order.email}</td>
                    <td>${order.grado || 'No especificado'}</td>
                    <td>${order.telefono || 'No especificado'}</td>
                    <td>${new Date(order.fecha).toLocaleString()}</td>
                    <td>
                        <ul>
                            ${JSON.parse(order.productos).map(product => `
                                <li>${product.name} - ${product.quantity} x $${product.price.toFixed(2)}</li>
                            `).join('')}
                        </ul>
                    </td>
                `;
                ordersTableBody.appendChild(row);
            });
        } catch (error) {
            console.error('Error al cargar los pedidos:', error);
            ordersTableBody.innerHTML = '<tr><td colspan="6">Error al cargar los pedidos.</td></tr>';
        }
    };

    updateOrdersList();
});
