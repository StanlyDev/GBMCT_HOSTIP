// Importa el módulo MySQL
const mysql = require('mysql');
// Importa el módulo http
const http = require('http');

// Configura la conexión a la base de datos
const connection = mysql.createConnection({
  host: '10.4.27.79', // La dirección del servidor de la base de datos
  user: 'stanvsdev', // Tu nombre de usuario
  password: 'Stanlyvs_00363', // Tu contraseña
  database: 'gbmct_db' // Nombre de tu base de datos
});

connection.connect((err) => {
  if (err) {
    console.error('Error de conexión:', err);
    return;
  }
  console.log('Conexión a la base de datos establecida');
});

const server = http.createServer((req, res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Request-Method', '*');
  res.setHeader('Access-Control-Allow-Methods', 'OPTIONS, GET');
  res.setHeader('Access-Control-Allow-Headers', '*');

  if (req.method === 'GET' && req.url === '/data') {
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
  } else {
    res.statusCode = 404;
    res.end('Ruta no encontrada');
  }
});

const PORT = 3000;
server.listen(PORT, () => {
  console.log(`Servidor en ejecución en http://localhost:${PORT}/`);
});
