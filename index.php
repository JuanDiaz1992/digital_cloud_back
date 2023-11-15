<?php

require_once "digital_cloud_settings/cors.php";
$os_info = php_uname('s');
require "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
/*El bloque de código anterior es el encargado de traer las variables de entorno*/


//Manejo de errores
ini_set('display_errors',1);
ini_set('logs_errors',1);
if(strpos($os_info, 'Windows')!== false){
    ini_set('error_log','F:/xampp/htdocs/digital_cloud/Error/php_error_log');

}else if(strpos($os_info, 'Linux')!== false){
    ini_set('error_log','home/Documentos/htdocs/digital_cloud/Error/php_error_log');

}

//Manejo de rutas
require_once "digital_cloud_settings/routes_controller.php";
$index = new RoutesController();
$index-> index();






?>