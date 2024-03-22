const mysql = require('mysql');

// Crear conexión
const connection = mysql.createConnection({
    host: '10.4.27.79',
    user: 'root',
    password: 'Stanlyv_00363',
    database: 'gbmct_db'
});

// Conectar a la base de datos
connection.connect((err) => {
    if (err) {
        console.error('Error al conectar a la base de datos: ' + err.stack);
        return;
    }
    console.log('Conexión exitosa a la base de datos con el ID ' + connection.threadId);
});

// Cerrar la conexión después de la conexión exitosa
connection.end();
