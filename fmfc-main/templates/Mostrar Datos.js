document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('myInput');
    input.addEventListener('keyup', function() {
        var filter = input.value.toUpperCase();
        var rows = document.getElementById('myTable').getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
});

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

