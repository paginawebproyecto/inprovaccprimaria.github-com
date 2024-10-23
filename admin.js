document.addEventListener('DOMContentLoaded', () => { 
    const productListAdmin = document.getElementById('product-list-admin');
    const productForm = document.querySelector('form');
    const productNameInput = document.getElementById('productName');
    const productPriceInput = document.getElementById('productPrice');
    const productImageInput = document.getElementById('productImage');

    // Obtener los productos desde el localStorage
    let products = JSON.parse(localStorage.getItem('products')) || [];

    // Función para actualizar la lista de productos en el administrador
    const updateProductListAdmin = () => {
        productListAdmin.innerHTML = '';
        products.forEach(product => {
            const productItem = document.createElement('div');
            productItem.classList.add('admin-item');
            productItem.innerHTML = `
                <figure>
                    <img src="${product.image}" alt="${product.name}" />
                </figure>
                <div class="info-product">
                    <h2>${product.name}</h2>
                    <p class="price">$${product.price.toFixed(2)}</p>
                    <button class="remove-product" data-name="${product.name}">Eliminar</button>
                </div>
            `;
            productListAdmin.appendChild(productItem);
        });
    };

    // Función para agregar un producto
    const addProduct = (name, price, image) => {
        const existingProduct = products.find(product => product.name === name);
        if (existingProduct) {
            alert('El producto ya existe.');
            return;
        }
        products.push({ name, price, image });
        localStorage.setItem('products', JSON.stringify(products));
        updateProductListAdmin();
    };

    // Función para eliminar un producto
    const removeProduct = (name) => {
        products = products.filter(product => product.name !== name);
        localStorage.setItem('products', JSON.stringify(products));
        updateProductListAdmin();
    };

    // Manejar el envío del formulario
    productForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = productNameInput.value.trim();
        const price = parseFloat(productPriceInput.value);
        const imageFile = productImageInput.files[0]; // Obtener el archivo de imagen

        if (name && !isNaN(price) && imageFile) {
            const image = URL.createObjectURL(imageFile); // Crear URL temporal para la imagen
            addProduct(name, price, image);

            // Enviar datos al servidor (PHP) para guardar en la base de datos
            const formData = new FormData();
            formData.append('productName', name);
            formData.append('productPrice', price);
            formData.append('productImage', imageFile); // Enviar el archivo de imagen

            fetch('upload_product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));

            // Limpiar el formulario
            productNameInput.value = '';
            productPriceInput.value = '';
            productImageInput.value = '';
        } else {
            alert('Por favor, ingrese un nombre, precio e imagen válidos.');
        }
    });

    // Manejar el evento de clic para eliminar productos
    productListAdmin.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-product')) {
            const name = e.target.dataset.name;
            removeProduct(name);
        }
    });

    // Actualizar la lista de productos al cargar la página
    updateProductListAdmin();
});
