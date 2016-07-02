<?php


namespace App\Controllers;

use App\Models\User_Model;
class Ajax_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        switch($params['method']){
            case 'validate_login':
                $this->validate_login($_POST['login']);
                break;

            case 'test2':
                $this->test2($this->test_val2);
                break;
            case 'auth':
                $this->auth_login = $_POST['auth_login'];
                $this->auth_password = $_POST['auth_password'];
                $this->auth($this->auth_login,$this->auth_password);
                break;
        }

    }


    protected function validate_login($login){
        $pattern = "/^[A-Za-z0-9_-]{3,16}$/";
        if(!preg_match($pattern,$login)){
            echo "Логин должен состоять только из латинский букв цифр дефисов и знаков подчеркивания а так же состоять
            более чем из 3-х символов";

        }
        if(User_Model::instance()->check_busy_login($login)){
            echo "Этот логин уже занят";
        }
        return true;
    }


}