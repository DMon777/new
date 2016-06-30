<?php


namespace App\Controllers;


class Sitemap_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        $this->title = "Карта сайта";
    }

    protected function output(){

        $this->content = $this->render([],'App/Views/blocks/sitemap_content');

        $this->page = parent::output();
    }


}