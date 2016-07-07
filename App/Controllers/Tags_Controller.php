<?php
/**
 * Created by PhpStorm.
 * User: Дима
 * Date: 01.07.2016
 * Time: 0:18
 */

namespace App\Controllers;

use App\Models\Articles_Model;
use App\Models\Navigation;

class Tags_Controller extends Base_Controller
{

    protected $articles;
    protected $tag;
    protected $current_page;
    protected $total_posts;
    protected $navigation_object;
    protected $table_name = 'articles';
    protected $category_name;


    protected function input($params = array()){
        parent::input();

        $this->tag = $params['title'];
        $this->category_name = Articles_Model::instance()->get_tag_title($this->tag);
        $this->title  = $this->category_name;

        $this->href = 'tags/title/'.$this->tag;
        $this->current_page = $params['page'] ?? 1;
        $this->navigation_object = new Navigation($this->current_page,$this->table_name);

        $this->total_posts = $this->navigation_object->count_articles_by_tags($this->tag);
        $this->articles = $this->navigation_object->get_articles_by_tag($this->tag);

        if($this->total_posts >3 ){
            $this->navigation = $this->navigation_object->get_navigation($this->total_posts);
        }


    }

    protected function output(){

        $this->content = $this->render(['articles' => $this->articles,
            'navigation' => $this->navigation,
            'href' => $this->href,
            'category_name' => $this->category_name
            ],
            'App/Views/blocks/index_content');

        $this->page = parent::output();
    }


}