<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario"])) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="Interfaz Principal.css" type="text/css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <h2 class="navbar-brand">MFC</h2>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Interfaz Principal.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Importar Archivo.html">Importar Archivo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Mostrar Datos.html">Mostrar Datos</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <!-- Icono de usuario -->
                            <?php echo isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : 'Invitado'; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Información</a></li>
                            <li><a class="dropdown-item" href="#">Editar</a></li>
                            <li><a class="dropdown-item" href="MFC.html">Desconectarse</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
  </nav>
  <div class="row">
    <div class="col-1">
      <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
        <nav class="nav nav-pills flex-column">
          <a class="nav-link" href="#item-1">Item 1</a>
          <nav class="nav nav-pills flex-column">
            <a class="nav-link ms-3 my-1" href="#item-1-1">Item 1-1</a>
            <a class="nav-link ms-3 my-1" href="#item-1-2">Item 1-2</a>
          </nav>
          <a class="nav-link" href="#item-2">Item 2</a>
          <a class="nav-link" href="#item-3">Item 3</a>
          <nav class="nav nav-pills flex-column">
            <a class="nav-link ms-3 my-1" href="#item-3-1">Item 3-1</a>
            <a class="nav-link ms-3 my-1" href="#item-3-2">Item 3-2</a>
          </nav>
        </nav>
      </nav>
    </div>
  
    <div class="col-8">
      <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
        <div id="item-1">
          <h4>Item 1</h4>
          <p>...</p>
        </div>
        <div id="item-1-1">
          <h5>Item 1-1</h5>
          <p>...</p>
        </div>
        <div id="item-1-2">
          <h5>Item 1-2</h5>
          <p>...</p>
        </div>
        <div id="item-2">
          <h4>Item 2</h4>
          <p>...</p>
        </div>
        <div id="item-3">
          <h4>Item 3</h4>
          <p>...</p>
        </div>
        <div id="item-3-1">
          <h5>Item 3-1</h5>
          <p>...</p>
        </div>
        <div id="item-3-2">
          <h5>Item 3-2</h5>
          <p>...</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Contenido para mostrar la información del usuario -->
  <div id="userInfoCard">
    <button type="button" class="close" aria-label="Close" onclick="document.getElementById('userInfoCard').style.display = 'none';">
    <span aria-hidden="true">&times;</span>
    </button>
    <div class="card-body">
      <h5 class="card-title">Información del Usuario</h5>
      <p class="card-text">Nombre:<?php echo $_SESSION['usuario']; ?></p>
    </div>
  </div>

  <!-- Contenido para editar la información del usuario -->
  <div id="userEditForm" class="useredit" style="display: none;" >
    <form action="updateUser.php" method="post">
      <div class="form-group"  >
        <label for="userName">Nombre</label>
        <input type="text" class="form-control" id="userName" placeholder="Nombre" value="<?php echo $_SESSION['usuario'];?>">
      </div>
      <div class="form-group">
        <label for="userPassword">Contraseña</label>
        <input type="password" class="form-control" id="userPassword" placeholder="Contraseña" required >
      </div>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="Interfaz Principal.js"></script>
    
</body>
</html>


