// Requerir los módulos necesarios
const http = require('http');
const mysql = require('mysql');

// Configurar la conexión a la base de datos
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'Stanlyv_00363',
  database: 'gbmct_db'
});

// Establecer conexión a la base de datos
connection.connect((err) => {
  if (err) {
    console.error('Error de conexión:', err);
    return;
  }
  console.log('Conexión a la base de datos establecida');
});

// Crear el servidor HTTP
const server = http.createServer((req, res) => {
  // Configurar encabezados CORS
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Request-Method', '*');
  res.setHeader('Access-Control-Allow-Methods', 'OPTIONS, GET');
  res.setHeader('Access-Control-Allow-Headers', '*');

  // Verificar el método de solicitud
  if (req.method === 'GET' && req.url === '/data') {
    // Realizar consulta a la base de datos
    connection.query('SELECT * FROM InventarioCintas', (err, results) => {
      if (err) {
        console.error('Error al ejecutar la consulta:', err);
        res.statusCode = 500;
        res.end('Error interno del servidor');
        return;
      }
      
      // Enviar los resultados como JSON
      res.statusCode = 200;
      res.setHeader('Content-Type', 'application/json');
      res.end(JSON.stringify(results));
    });
  } else {
    // Manejar otras rutas o métodos de solicitud
    res.statusCode = 404;
    res.end('Ruta no encontrada');
  }
});

// Escuchar en un puerto específico
const PORT = 3000;
server.listen(PORT, () => {
  console.log(`Servidor en ejecución en http://localhost:${PORT}/`);
});
