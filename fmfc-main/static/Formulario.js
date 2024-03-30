document.querySelector('formulario').addEventListener('submit', function(event) {
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellidos').value;
    var telefono= document.getElementById('telefono').value;
    var postal= document.getElementById('postal').value;
    var spanNombre=document.getElementById('error-nombre').value;
    var spanApellido=document.getElementById('error-apellido').value;
    var spanTelefono=document.getElementById('error-number').value;
    var spanPostal=document.getElementById('error-postal').value;
    if (!/^\w+$/.test(nombre)){
        spanNombre.textContent('El nombre solo debe contener letras')
        event.preventDefault();
        return;
    }else{
        spanApellido.textContent = '';
    }
    if (!/^\w+$/.test(apellido)){
        spanApellido.textContent('El apellido solo debe contener letras')
        event.preventDefault();
        return;
    }else{
        spanApellido.textContent = '';
    }
    if(!/^\d{5}$/.test(postal)){
        spanPostal.textContent('El codigo postal solo debe contener 5 digitos')
        event.preventDefault();
        return;
    }else{
        spanApellido.textContent = '';
    }
    if (!/^\d{6}$/.test(telefono)){
        spanTelefono.textContent('El telefono debe tener 6 digitos')
        event.preventDefault();
        return;
    }else{
        spanApellido.textContent = '';
    }
});