const express = require('express');
const app = express();
app.use(express.json());

let products = []; // Este array debería estar en una base de datos

// Endpoint para agregar producto
app.post('/api/add-product', (req, res) => {
    const { name, price, category, image } = req.body;
    products.push({ name, price, category, image });
    res.status(201).send('Producto agregado');
});

// Endpoint para eliminar producto
app.post('/api/remove-product', (req, res) => {
    const { name } = req.body;
    products = products.filter(product => product.name !== name);
    res.status(200).send('Producto eliminado');
});

// Endpoint para obtener productos
app.get('/api/products', (req, res) => {
    res.json(products);
});

app.listen(3000, () => console.log('Servidor corriendo en el puerto 3000'));
