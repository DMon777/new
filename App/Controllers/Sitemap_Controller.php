<?php

namespace App\Controllers;

use App\Models\Articles_Model;

class Sitemap_Controller extends Base_Controller
{

    protected $categories;
    protected $articles;

    protected function input($params = []){
        parent::input();
        $this->title = "Карта сайта";
        $this->categories = Articles_Model::instance()->get_all_categories();
    }

    protected function output(){

        $this->content = $this->render([
            'menu'       => $this->menu,
            'categories' => $this->categories
        ],
            'App/Views/blocks/sitemap_content');

        $this->page = parent::output();
    }


}