<?php

namespace App\Controllers;


class Article_Controller extends Base_Controller
{

    protected $article;


    protected function input($params = []){
        parent::input();


    }

    protected function output(){

        $this->content = $this->render(array('article' => $this->article),
            'App/Views/blocks/article_content');

        $this->page = parent::output();
    }




}