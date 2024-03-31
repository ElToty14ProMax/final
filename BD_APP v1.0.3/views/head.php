<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gestion de Ventas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="views/css/bootstrap-5.3.2-dist/css/mins.css">
        <link rel="stylesheet" href="views/css/style.css">
    </head>
    <body>
        <!--Contenido de mis vista a partir de aqui abajo-->
        <div>
           <div class="container-fluid my-0 px-3 encabezado"> <h1 class="display-5 my-0">Gestion de ventas</h1> </div>
           <ul class="nav nav-pills justify-content-end menu" >
                <li class="nav-item" >
                    <a href="index.php?method=getData&table=clientes" class="nav-link" >Clientes</a>
                </li>
                <li class="nav-item" >
                    <a href="index.php?method=getData&table=vendedores" class="nav-link" >Vendedores</a>
                </li>
                <li class="nav-item" >
                    <a href="index.php?method=getData&table=pedidos" class="nav-link" >Pedidos</a>
                </li>
                <li class="nav-item" >
                    <a href="index.php?method=getData&table=productos" class="nav-link" >Productos</a>
                </li>
                <li class="nav-item" >
                    <a href="index.php?method=getData&table=oficinas" class="nav-link" >Oficinas</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" >Nuevo</a>
                    <ul class="dropdown-menu bg-secondary" >
                        <li>
                            <a href="index.php?method=viewNewRow&row=clientes" class="dropdown-item" >Cliente</a>
                        </li>
                        <li>
                            <a href="index.php?method=viewNewRow&row=vendedores" class="dropdown-item" >Vendedor</a>
                        </li>
                        <li>
                            <a href="index.php?method=viewNewRow&row=pedidos" class="dropdown-item" >Pedido</a>
                        </li>
                        <li>
                            <a href="index.php?method=viewNewRow&row=productos" class="dropdown-item" >Producto</a>
                        </li>
                        <li>
                            <a href="index.php?method=viewNewRow&row=oficinas" class="dropdown-item" >Oficina</a>
                        </li>
                    </ul>
                </li>
           </ul>

       