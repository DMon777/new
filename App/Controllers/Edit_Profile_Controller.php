<?php

namespace App\Controllers;


use App\Models\User_Model;

class Edit_Profile_Controller extends Base_Controller
{

    protected $user;
    protected $login;
    protected $email;
    protected $message;

    protected function input($params = []){
        parent::input();

        $this->title = "Редактировать профиль";
        $this->scripts = ['jQuery','menu','auth','ajax_upload','upload','registration'];
        $this->user = User_Model::instance()->get_user($_SESSION['auth']['user']);

        if($_POST['edit_profile']) {
            $this->edit_profile();
        }

    }

    protected function output(){

        $this->content = $this->render(
            [
                'user'    => $this->user,
                'message' => $this->message
            ],
            'App/Views/blocks/edit_profile_content');

        $this->page = parent::output();
    }

    protected function edit_profile(){
        $this->login = $this->clean_str($_POST['login']);
        $this->email = $this->clean_str($_POST['email']);

        if(User_Model::instance()->check_busy_login($this->login) || strlen($this->login) < 3){
            $this->message = 'ошибка логина!!!';
            return false;
        }

        if(!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/"
                ,$this->email )||
            User_Model::instance()->check_busy_email($this->email)){
            $this->message = 'ошибка email!!!';
            return false;
        }

        User_Model::instance()->edit_profile($this->login,$this->email,$this->user['id']);
        $this->user = User_Model::instance()->get_user($_SESSION['auth']['user']);
    }


}