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