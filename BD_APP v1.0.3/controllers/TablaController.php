<?php

require_once('models/TablaModel.php');

class TablaController
{
    public function mostrarTabla()
    {
        $modelo = new TablaModel();
        $datos = $modelo->obtenerRegistros();
        $columnas = $datos['columnas'];
        $registros = $datos['registros'];

        require_once('views/tabla_view.php');
    }
}
