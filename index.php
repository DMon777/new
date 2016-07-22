<?php
session_start();
require_once "autoload.php";
require_once "config.php";

use App\Controllers\Route_Controller;
use App\Controllers\Controller_Exception;
error_reporting(0);
try{
    $controller =  Route_Controller::instance();
    $controller->route();
}
catch(Controller_Exception $e){

}

?>