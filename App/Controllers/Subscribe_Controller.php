<?php


namespace App\Controllers;


class Subscribe_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        $this->title = "Подписка на обновления";
    }

    protected function output(){

        $this->content = $this->render([],'App/Views/blocks/subscribe_content');

        $this->page = parent::output();
    }



}