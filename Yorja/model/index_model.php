<?php
class Model{
//esta clase establecera la conexion con mi base de datos y trabajra sobre el intercambio de datos
private $host = 'localhost';
private $dbname = 'ventas';
private $user = 'postgres';
private $password ='Toty*020314';
private $conexion;
//iniciamos la conexion con nuestra base de datos en el constructor de la clase modelo
public function __construct(){
    try{
        $this->conexion = new PDO("pgsql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
    }
    catch( PDOException $exs){
        echo 'no se pudo establecer correctamente la conexion por el error:'.$exs.'';
    }
}
//metodo para realizar consultas a la base de datos
private function select($table, $condition){
        $consult = 'select * from '.$table.' where '.$condition;
        $result = $this->conexion->query($consult);
        if($result){
        return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new PDOException();
        }
}
//metodo para dar formato a los datos devueltos por la consulta
public function getData($table, $condition){
    $data = $this->select($table, $condition);
    if(!$data){
        throw new PDOException();
    }
    $dicc=[];
    $dicc['col'] = array_keys($data[0]);
    $dicc['row'] = [];
    foreach($data as $row){
        array_push($dicc['row'], array_values($row));
    }
    return $dicc;
}
//metodo para insertar los datos en la base de datos
public function insertData($table, $data){
    $consult = 'insert into '.$table.' values ('.$data.');';
    $result = $this->conexion->query($consult);
    if(!$result){
        throw new PDOException();
    }
}
//metodo para actualizar los datos de la tabla
public function updateData($table, $update, $condition){
    $consult = 'update '.$table.' set '.$update.' where '.$condition;
    $result = $this->conexion->query($consult);
    if(!$result){
        throw new PDOException();
    }
}
//metodo para eliminar una fila da una tabla determinada
public function deleteData($table, $condition){
    $consult = 'delete from '.$table.' where '.$condition;
    $result = $this->conexion->query($consult);
    if(!$result){
        throw new PDOException();
    }
}
//metodo para obtener las columnas de una tabla determinada
public function getNameColumns($table){
    $consult = 'select * from '.$table;
    $result =$this->conexion->query($consult);
    if(!$result){
        throw new PDOException();
    }
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return array_keys($row);
}
}//fin de mi calse modelo

// $modelo = new Model;
//  try{
//  var_dump($modelo->insertData('cliente', 'true'));}
//  catch(PDOException ){
//      echo 'se ha lanzado un error al insertar';
//  }