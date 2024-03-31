<?php
require_once('config.php');
require_once('controller/index_controller.php');

if(isset($_REQUEST['method'])){
    if(method_exists('Controller',$_REQUEST['method'])){
         Controller::{$_REQUEST['method']}();
    }
 }
 else{
     Controller::main();
 }
