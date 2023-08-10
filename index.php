<?php

require_once "gestionRestauranteSettings/cors.php";


//Manejo de errores
ini_set('display_errors',1);
ini_set('logs_errors',1);
ini_set('error_log','C:/xampp/htdocs/gestion_restaurante/Error/php_error_log');

//Manejo de rutas
require_once "gestionRestauranteSettings/routes_controller.php";
$index = new RoutesController();
$index-> index();






?>