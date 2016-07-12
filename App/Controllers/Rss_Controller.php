<?php

namespace App\Controllers;


use App\Models\Articles_Model;

class Rss_Controller extends  Base_Controller
{

    protected $articles;

    protected function input($params = []){
        parent::input();

        $this->articles = Articles_Model::instance()->get_all_articles();

    }

    protected function output(){
        $this->page = $this->render([
            'articles' => $this->articles
        ],
            'App/Views/blocks/rss');

    }



}