<?php
namespace App\Controllers;
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
    protected $navigation;
    protected $need_navigation = true;
    protected $scripts = [];

    protected function input($params = []){

        $this->scripts = ['jQuery','menu'];

        $this->menu = Menu_Model::instance()->make_menu_tree();

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

        $this->side_bar = $this->render([],'App/Views//blocks/side_bar_content');
        if($this->need_navigation){
            $this->navigation = $this->render([],'App/Views//blocks/navigation');
        }

        $page = $this->render([
            'header'        => $this->header,
            'footer'        => $this->footer,
            'content'       => $this->content,
            'navigation'    => $this->navigation,
            'side_bar'      => $this->side_bar],
            'App/Views/blocks/base_template');
        return $page;
    }

}