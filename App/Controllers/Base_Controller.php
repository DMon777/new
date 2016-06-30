<?php
namespace App\Controllers;
use App\Models\Articles_Model;
use App\Models\Menu_Model;


abstract class Base_Controller extends Main_Controller
{
    protected $header;
    protected $title;
    protected $side_bar;
    protected $content;
    protected $menu;
    protected $keywords;
    protected $description;
    protected $footer;
    protected $navigation_block;
    protected $need_navigation_block = true;
    protected $href;
    protected $navigation;
    protected $scripts = [];
    protected $all_tags;

    protected function input($params = []){

        $this->scripts = ['jQuery','menu'];

        $this->menu = Menu_Model::instance()->make_menu_tree();

        $this->all_tags = Articles_Model::instance()->get_all_tags();


    }

    protected function output(){
        $this->header = $this->render([
            'title'       => $this->title,
            'description' => $this->description,
            'keywords'    => $this->keywords,
            'menu'        => $this->menu,
            'scripts'     => $this->scripts],
            'App/Views/blocks/header');

        $this->footer = $this->render([],'App/Views//blocks/footer');

        $this->side_bar = $this->render(['all_tags' => $this->all_tags],'App/Views//blocks/side_bar_content');
        if($this->need_navigation_block){
            $this->navigation_block = $this->render([
                'href'       => $this->href,
                'navigation' => $this->navigation
            ],
           'App/Views//blocks/navigation_block');
        }

        $page = $this->render([
            'header'        => $this->header,
            'footer'        => $this->footer,
            'content'       => $this->content,
            'navigation_block'    => $this->navigation_block,
            'side_bar'      => $this->side_bar],
            'App/Views/blocks/base_template');
        return $page;
    }

}