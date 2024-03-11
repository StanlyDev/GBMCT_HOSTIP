function descargarExcel() {
  var tabla = document.querySelector('.tabla_invent table');
  var ws = XLSX.utils.table_to_sheet(tabla);
  var wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, 'Inventario');
  XLSX.writeFile(wb, 'inventario_excel.xlsx');
}
/*Devoloped by Brandon Ventura*/