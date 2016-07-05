<?php
namespace App\Controllers;


use App\Models\Articles_Model;
use App\Models\Navigation;

class Categories_Controller extends Base_Controller
{

    protected $navigation_object;
    protected $current_page;
    protected $table_name = 'articles';
    protected $total_posts;
    protected $articles;
    protected $category_name;
    protected $category_title;

    protected function input($params = []){
        parent::input();

        $this->current_page = $params['page'] ?? 1;
        $this->navigation_object = new Navigation($this->current_page,$this->table_name);
        $this->category_name = $params['id'];
        $this->category_title = Articles_Model::instance()->get_category_title($this->category_name);

        $this->title = $this->category_title;
        $this->href = 'categories/id/'.$this->category_name;
        $this->articles = $this->navigation_object->get_articles_by_category($this->category_name);
        $this->total_posts = $this->navigation_object->count_articles_by_category($this->category_name);
        $this->navigation = $this->navigation_object->get_navigation($this->total_posts);
    }

    protected function output(){

        $this->content = $this->render([
            'navigation' => $this->navigation,
            'articles'   => $this->articles,
            'category_name' => $this->category_title
            ],'App/Views/blocks/index_content');

        $this->page = parent::output();
    }



}