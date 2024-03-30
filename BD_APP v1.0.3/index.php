<?php

require_once('controllers/TablaController.php');

$ruta = $_SERVER['REQUEST_URI'];
$controlador = new TablaController();
$controlador->mostrarTabla();

