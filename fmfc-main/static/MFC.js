function esusuarioUnico(usuario) {

}
document.querySelector('.Autenticacion').addEventListener('submit', function(event) {
    var usuario = document.getElementById('Usuario').value;
    var password = document.getElementById('Password').value;

    if (usuario !== usuario.toLowerCase() || usuario.include(' ')) {
        alert('El nombre del usuario debe estar en minusculas y no debe contener espacios')
        event.preventDefault();
        return;
    }
    if (!esusuarioUnico(usuario)) {
        alert('Este usuario esta en uso.')
        event.preventDefault();
        return;
    }
    if (!/^[\w./&*]+$/.test(password)) {
        alert('la contraseña contiene caracteres alfanumericos y simbolos como /*.etc')
        event.preventDefault();
        return;
    }
});

document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    // Aquí puedes hacer una llamada AJAX para enviar los datos al servidor
    // y manejar la respuesta
});
$(document).ready(function(){
    $('[data-bs-toggle="offcanvas"]').hover(function(){
        $('#offcanvasExample').offcanvas('show');
    });
});