const mysql = require('mysql');

const conection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'GBM_CT'
})

conection.connect((err)=>{
    if(err){
        throw err
    }
    else{
        console.log('Conectado')
    }
})

/*const insert = "INSERT INTO UserDB (IdUser,Usuario, Contraseña) VALUES (NULL, 'admin', 'passw0rd*')"
conection.query(insert, (err, rows)=>{
    if(err) throw err
})*/

conection.query('SELECT * FROM UserDB', (err, rows)=>{
    if(err){
        throw err
    }
    else{
        console.log('Datos: ')
        console.log(rows)
    }
})

conection.end();