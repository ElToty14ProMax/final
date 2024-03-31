<?php
require_once('model/index_model.php');

class Controller{
    //metodo para cargar la vista principal de la aplicacion
    static function main(){
        require_once('views/layouts/main.php');
    }
    //metodo para cargar las tablas en la aplicacion de forma dinamica
    static function getData(){
        $table = $_REQUEST['table'];
        $model = new Model();
        $data = $model->getData($table, 'true');
        require('views/layouts/table.php');
    }
    //metodo para mostrar la vista de insertar una nueva fila en una tabla
    static function viewNewRow(){
        $model = new Model();
        $row = $_REQUEST['row'];
        $data_cols = $model->getNameColumns($row);
        require('views/layouts/nuevo.php');
    }
    //metodo para guardar los datos de una nueva fila en la base de datos
    static function saveNewRow(){
        $model = new Model();
        $rowToSave = $_REQUEST['rowToSave'];
        $colsName = $model->getNameColumns($rowToSave);
        $consult = "";
        foreach($colsName as $col){
            if($col == 'lim_credito'||$col == 'objetivo'||$col == 'ventas'||$col == 'importe'||$col == 'precio'||$col == 'cuota'){
                $consult.=$_REQUEST[$col]."::money,";
            }
            else if($col == 'empresa'||$col == 'nombre'||$col == 'titulo'||$col == 'fab'||$col == 'producto'||$col == 'id_fab'||$col == 'id_producto'||$col == 'descripcion'||$col == 'ciudad'||$col == 'region'){
                $consult.="'".$_REQUEST[$col]."',";
            }
            else if($col == 'contrato'||$col == 'fecha_pedido'){
                $consult.="('".$_REQUEST[$col]."')::timestamp,";
            }
            else{
                $consult.=$_REQUEST[$col].",";
            }
        }
        $consult = substr_replace($consult,'',-1,1);
        try{
            $model->insertData($rowToSave,$consult);
            header("location:".urlsite);
        }
        catch(PDOException $exc){
            echo $exc;
        }
    }
    //metodo para parsear de manera facil los valores de mis tablas segun sea necesario
    static function parseColum($colName, $colValue){
        //parsea a datos de tipo money
        if($colName == 'lim_credito'||$colName == 'objetivo'||$colName == 'ventas'||$colName == 'importe'||$colName == 'precio'||$colName == 'cuota'){
            return $colValue."::money";
        }
        //parsea a datos de tipo cadena de caracteres
        else if($colName == 'empresa'||$colName == 'nombre'||$colName == 'titulo'||$colName == 'fab'||$colName == 'producto'||$colName == 'id_fab'||$colName == 'id_producto'||$colName == 'descripcion'||$colName == 'ciudad'||$colName == 'region'){
            return "'".$colValue."'";
        }
        //parsea a datos de tipo timestamp
        else if($colName == 'contrato'||$colName == 'fecha_pedido'){
            return "('".$colValue."')::timestamp";
        }
        //asume que son datos de tipo entero
        else{
            return $colValue;
        }
    }
    //metodo para elegir el formulario de actualizacion de una fila determinada de forma dinamica
    static function viewSetRow(){
        $model = new Model();
        $tableSet = $_REQUEST['tableSet'];
        $colName = $_REQUEST['colName'];
        $colValue = $_REQUEST['colValue'];
        $parseValue = Controller::parseColum($colName,$colValue);
        $condition = $colName." = ".$parseValue;
        $dataToSet = $model->getData($tableSet,$condition);
        require('views/layouts/actualizar.php');
    }
}