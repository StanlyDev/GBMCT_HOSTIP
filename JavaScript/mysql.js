const express = require('express');
const mysql = require('mysql');

const app = express();
const PORT = 3001;

// Configurar conexión a la base de datos
const connection = mysql.createConnection({
  host: '10.4.27.79',
  user: 'stanvsdev',
  password: 'Stanlyvs_00363',
  database: 'gbmct_db'
});

// Establecer la conexión a la base de datos
connection.connect((err) => {
  if (err) {
    console.error('Error de conexión:', err);
    return;
  }
  console.log('Conexión a la base de datos establecida');
});

// Middleware para habilitar CORS
app.use((req, res, next) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
  res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
  res.setHeader('Access-Control-Allow-Credentials', true);
  next();
});

// Ruta para obtener los datos desde el servidor
app.get('/data', (req, res) => {
  connection.query('SELECT * FROM InventarioCintas', (err, results) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err);
      res.statusCode = 500;
      res.end('Error interno del servidor');
      return;
    }
    res.statusCode = 200;
    res.setHeader('Content-Type', 'application/json');
    res.end(JSON.stringify(results));
  });
});

// Iniciar el servidor
app.listen(PORT, () => {
  console.log(`Servidor en ejecución en http://localhost:${PORT}/`);
});
