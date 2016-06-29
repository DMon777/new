<?php
namespace App\Controllers;


class Index_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        $this->title = "Главная";

    }

    protected function output(){

        $this->content = $this->render([],'App/Views/blocks/index_content');
        $this->page = parent::output();
    }

}