<?php


namespace App\Controllers;


class Forgot_Controller extends Base_Controller
{
    protected $reconstruction_string;
    protected $forgot_item;

    protected function input($params = []){
        parent::input();

        $this->forgot_item = $params['item'];
        if($this->forgot_item == 'login'){
            $this->reconstruction_string = "Восстановление логина";
        }
        elseif($this->forgot_item == 'password'){
            $this->reconstruction_string = "Восстановление пароля";
        }

    }

    protected function output(){

        $this->content = $this->render([
            'reconstruction' => $this->reconstruction_string
        ],'App/Views/blocks/forgot_content');

        $this->page = parent::output();
    }
}