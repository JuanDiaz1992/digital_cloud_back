<?php
require_once "APPS/Business/controller/get_controler.php";
$response = new GetController();
$response->getData($table,$select);

?>