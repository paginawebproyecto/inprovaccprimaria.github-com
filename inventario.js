document.addEventListener('DOMContentLoaded', function() {
    fetch('get_inventory.php')
        .then(response => response.json())
        .then(data => {
            const inventoryList = document.getElementById('inventory-list');
            data.forEach(product => {
                inventoryList.innerHTML += `
                    <div class="inventory-item">
                        <p>${product.nombre}</p>
                        <p>Precio: $${product.precio}</p>
                        <p>Inventario: ${product.inventario}</p>
                        <button onclick="updateInventory(${product.id})">Actualizar Inventario</button>
                    </div>
                `;
            });
        });
});

function updateInventory(productId) {
    // Función para actualizar el inventario (mostrar un formulario, etc.)
}
