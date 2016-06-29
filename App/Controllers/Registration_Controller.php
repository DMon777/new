<?php
namespace App\Controllers;


class Registration_Controller extends Base_Controller
{

    protected function input($params = array()){
        parent::input();

    }

    protected function output(){

        $this->content = $this->render(array(),'App/Views/blocks/registration_content');

        $this->page = parent::output();
    }



}