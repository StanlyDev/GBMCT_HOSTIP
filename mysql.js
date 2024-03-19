const mysql = require('mysql');

const conection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Stanlyv_00363',
    database: 'GBMCT_DB'
})

conection.connect((err)=>{
    if(err){
        throw err
    }
    else{
        console.log('Conectado')
    }
})

connection.connect((err) => {
    if (err) {
      console.error('Error al conectar a la base de datos: ' + err.stack);
      return;
    }
    console.log('Conexión exitosa a la base de datos con el ID ' + connection.threadId);
  });
  

conection.end();