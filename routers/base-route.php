<?php
/*
* Build the router and register controller methods for the application component
* displaying the application controllers and actions.
*/

$controllers = array(
    'pages' => ['index'],
);
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action     =  'index';
}

include_once('controllers/' . $controller . '-controller.php');

$class = str_ireplace("-", "", ucwords($controller, "-") . "Controller");
$controller =  new $class();

$controller->$action();
