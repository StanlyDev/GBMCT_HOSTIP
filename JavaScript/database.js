const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
    host: '185.27.134.145',
    user: 'if0_36338233',
    password: 'StanlyVS00363',
    database: 'if0_36338233_cintotecdb'
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
    const query = 'SELECT id, cliente, tipo, descripcion, codigo, en_cintoteca FROM yourtable';
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
