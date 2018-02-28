<?php
/**
 *
 */
/**
 * @param
 * @param
 */
function loadPage($twig, $controllerName, $actionName){
    include_once PathPrefix . $controllerName . PathPostfix;
    $function = $actionName . 'Action';
    $function($twig);
}

function dbg($val = null, $die = true){
    echo '<pre>Debug: <br />';
    print_r($val);
    echo '</pre>';
    if ($die) die;
}

function redirect($url, $statusCode = 303){
    header('Location: ' . $url, true, $statusCode);
    die();
}