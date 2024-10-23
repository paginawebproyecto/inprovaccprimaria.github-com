document.addEventListener('DOMContentLoaded', function() {
    // Función para cargar productos
    function loadProducts() {
        // Aquí puedes usar fetch o AJAX para cargar productos desde el servidor
        fetch('get_products.php')
            .then(response => response.json())
            .then(data => {
                const productosSection = document.getElementById('productos');
                productosSection.innerHTML = '';
                data.forEach(producto => {
                    productosSection.innerHTML += `
                        <div class="producto">
                            <h2>${producto.nombre}</h2>
                            <p>${producto.descripcion}</p>
                            <p>Precio: $${producto.precio}</p>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    loadProducts();
});
let currentSlide = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('#slider .slide');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    const offset = -currentSlide * 100;
    document.querySelector('.slider-container').style.transform = `translateX(${offset}%)`;
}

function moveSlide(step) {
    showSlide(currentSlide + step);
}

// Inicializa el slider
showSlide(currentSlide);

// Opcional: Agregar un intervalo automático
setInterval(() => {
    moveSlide(1);
}, 5000); // Cambia la imagen cada 5 segundos
