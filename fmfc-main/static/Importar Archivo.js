document.getElementById('fileInput').addEventListener('change', function(e) {
    var filePath = e.target.value;
    document.getElementById('filePath').value = filePath;
  });

  function importFile() {
    // Aquí puedes agregar el código para importar el archivo seleccionado
    alert('Archivo importado');
  }