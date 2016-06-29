<?php

namespace App\Controllers;


class Controller_Exception extends \Exception
{

    public function __construct(){
        $this->page404();
    }
    private function page404(){
        header('Location:http://'.SITE_NAME.'/page404');
    }


}