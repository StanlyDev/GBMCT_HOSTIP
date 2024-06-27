 var fecha = new Date();

 var dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
 var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

 var nombreDia = dias[fecha.getDay()];
 var numeroDia = fecha.getDate();
 var nombreMes = meses[fecha.getMonth()];
 var anio = fecha.getFullYear();

 document.getElementById('nombreDia').textContent = nombreDia;
 document.getElementById('numeroDia').textContent = numeroDia;
 document.getElementById('nombreMes').textContent = nombreMes;
 document.getElementById('anio').textContent = anio;
 /*Devoloped by Brandon Ventura*/