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

            case 'validate_email':
                $this->validate_email($_POST['email']);
                break;

            case 'validate_captcha':
                $this->validate_captcha($_POST['captcha']);
                break;
            case 'auth':
                $this->ajax_auth($_POST['login'],$_POST['password']);
                break;
        }
    }

    protected function validate_login($login){
        if(empty($login)){
            echo "заполните поле!!!";
            return false;
        }

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

    public function validate_email($email){
        if(empty($email)){
            echo "заполните поле!!!";
            return false;
        }
        $pattern = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/";
        if(!preg_match($pattern,$email)){
            echo " не правильный формат ввода email";
        }
        if(User_Model::instance()->check_busy_email($email)){
            echo "этот почтовый ящик уже зарегестрирован!!!";
        }

    }

    public function validate_captcha($captcha){
        if(strnatcasecmp ($captcha,$_SESSION['captcha'])){
            echo "код с картинки введен не верно!!!";
        }
        return false;
    }

    public function ajax_auth($login,$password){
        if(empty($login) || empty($password)){
            echo "поля должны быть заполнены!!!";
            return false;
        }
        if(User_Model::instance()->auth_user($login,$password)){
            echo $login;
        }
        else{
            echo "неверный логин или пароль!";
        }

    }



}