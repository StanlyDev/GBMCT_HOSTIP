const express = require('express');
const mysql = require('mysql');

const app = express();
const port = 3000;

// Configuración de la conexión a la base de datos
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Stanlyv_00363',
    database: 'gbmct_db'
});

// Ruta para obtener los datos del inventario
app.get('/datosInventario', (req, res) => {
    connection.query('SELECT * FROM InventarioCintas', (error, results, fields) => {
        if (error) {
            console.error('Error al ejecutar la consulta:', error);
            res.status(500).json({ error: 'Error al obtener los datos del inventario' });
            return;
        }
        res.json(results);
    });
});

app.listen(port, () => {
    console.log(`Servidor escuchando en http://localhost:${port}`);
});
