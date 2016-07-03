<?php

namespace App\Controllers;


class Logout_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();
        $this->logout();
    }

    protected function logout(){
        unset($_SESSION['auth_user']);
        session_destroy();
        $this->redirect();
    }


}