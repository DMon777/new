<?php

namespace App\Controllers;

use App\Models\User_Model;

class Activate_Controller extends Base_Controller
{

    protected $code;
    protected $activate_message;
    protected $activate_table;

    protected function input($params = [])
    {
        parent::input();

        $this->code = $params['code'];

        switch($params['item']){

            case 'user':
            $this->activate_user();
            break;
            case 'subscriber':
            $this->activate_subscriber();
            break;

        }
    }

    protected function output()
    {
        $this->content = $this->render(['message' => $this->activate_message], 'App/Views/blocks/activate_content');

        $this->page = parent::output();
    }

    protected function activate_user(){
        $this->title = 'Активация логина';
        $this->keywords = 'активация нового пользователя';
        $this->description = 'активация нового пользователя';
        $this->activate_table = 'users';


        if (!User_Model::instance()->activate_user($this->code,$this->activate_table)) {
            $this->activate_message = 'произошла какято ошибочка';
        } else {
            $this->activate_message = "Спасибо за регистрацию на сайте " . SITE_NAME . " теперь вы можете заходить на сайт под своим логином
                            и паролем";
        }
    }

    protected function activate_subscriber(){
        $this->title = 'Активация подписки';
        $this->keywords = 'активация нового подписчика';
        $this->description = 'активация нового подписчика';
        $this->activate_table = 'subscribers';
        if (!User_Model::instance()->activate_user($this->code,$this->activate_table)) {
            $this->activate_message = 'произошла какято ошибочка';
        } else {
            $this->activate_message = " Вы оформили подписку на новости на сайте - ".SITE_NAME;
        }
    }



}