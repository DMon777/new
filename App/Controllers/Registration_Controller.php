<?php
namespace App\Controllers;


class Registration_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        $this->title = "Регистрация";

    }

    protected function output(){

        $this->content = $this->render([],'App/Views/blocks/registration_content');

        $this->page = parent::output();
    }



}