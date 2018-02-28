<?php

include_once '../config/config.php';
include_once '../config/db.php';
include_once '../lib/main.php';

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'Index';
//$id = isset($_GET['id']) ? $_GET['id'] : '1';


loadPage($twig, $controllerName, $actionName);
