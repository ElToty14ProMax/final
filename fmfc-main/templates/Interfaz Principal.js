// Función para establecer el elemento activo basado en la URL actual
function setActiveNavItem() {
        var path = window.location.pathname;
        var navItems = document.querySelectorAll('.navbar-nav .nav-item');
        navItems.forEach(function(item) {
            var link = item.querySelector('a');
            if (link.href.indexOf(path) !== -1) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
}

        // Establecer el elemento activo cuando la página se carga
        setActiveNavItem();

        // Actualizar el elemento activo cuando se hace clic en un enlace de la barra de navegación
        document.querySelectorAll('.navbar-nav .nav-item a').forEach(function(link) {
            link.addEventListener('click', function() {
                setActiveNavItem();
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
        
      