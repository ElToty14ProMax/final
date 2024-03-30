document.getElementById('fileInput').addEventListener('change', function(e) {
    var filePath = e.target.value;
    document.getElementById('filePath').value = filePath;
});

function importFile() {
    // Aquí puedes agregar el código para importar el archivo seleccionado
    alert('Archivo importado');
}
document.addEventListener('DOMContentLoaded', function() {
    // Obtener los elementos del menú desplegable
    var infoLink = document.querySelector('a[href="#"]');
    var editLink = document.querySelectorAll('a[href="#"]')[1];

    // Obtener los contenidos a mostrar
    var userInfoCard = document.getElementById('userInfoCard');
    var userEditForm = document.getElementById('userEditForm');

    // Función para mostrar el contenido
    function showContent(content) {
        // Ocultar todos los contenidos
        userInfoCard.style.display = 'none';
        userEditForm.style.display = 'none';

        // Mostrar el contenido seleccionado
        content.style.display = 'block';
    }

    // Agregar eventos de clic a los enlaces
    infoLink.addEventListener('click', function(e) {
        e.preventDefault(); // Prevenir la acción por defecto del enlace
        showContent(userInfoCard);
    });

    editLink.addEventListener('click', function(e) {
        e.preventDefault(); // Prevenir la acción por defecto del enlace
        showContent(userEditForm);
    });
});