<?php

namespace App\Controllers;


use App\Models\Articles_Model;

class Search_Controller extends Base_Controller
{

    protected $search_result;
    protected $search_string;

    protected function input($params = []){
        parent::input();
        $this->title = "Результаты поиска";
        $this->search_string = $_GET['search_text'];
        $this->search_result = Articles_Model::instance()->get_search_results($this->search_string);

    }

    protected function output(){
        $this->content = $this->render([
           'search_result' => $this->search_result,
           'search_string' => $this->search_string
        ],
            'App/Views/blocks/search_result_content');

        $this->page = parent::output();
    }


}