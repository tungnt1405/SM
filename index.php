<?php
require_once('plugins/my-plugin.php');
session_start();
?>
<?php
/*
* Data is fetched from controller and displayed to views
* All data obtained will be transferred to index
* This is the default page to display data
*/

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'pages';
    $action     =  'index';
}

require_once("routers/base-route.php");
?>
