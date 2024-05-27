const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
const port = 3000;

// Configurar CORS
app.use(cors());

app.use(bodyParser.json());

const db = mysql.createConnection({
    host: '10.4.27.112',
    user: 'stanvsdev',
    password: 'Stanlyvs_00363',
    database: 'dbmedios_gbm'
});

// Conectar a la base de datos
db.connect(err => {
    if (err) {
        console.error('Error connecting to the database:', err);
        return;
    }
    console.log('Connected to the database.');
});

// Ruta para obtener datos
app.get('/data', (req, res) => {
    const query = 'SELECT NumeroCinta, NombreCliente, TipoCinta, Descripcion, CodigoCinta, EnCintoteca FROM TableInventory';
    db.query(query, (err, results) => {
        if (err) {
            console.error('Error fetching data:', err);
            res.status(500).send(err);
            return;
        }
        res.json(results);
    });
});

// Iniciar el servidor
app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
