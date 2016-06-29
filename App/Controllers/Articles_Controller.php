<?php
namespace App\Controllers;


class Articles_Controller extends Base_Controller
{

    protected $articles;


    protected function input($params = array()){
        parent::input();

        $this->articles = $this->model_object->get_all_articles();


    }

    protected function output(){

        $this->content = $this->render(array('articles' => $this->articles),
            'App/Views/blocks/articles_content');

        $this->page = parent::output();
    }




}