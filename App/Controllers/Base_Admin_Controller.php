<?php

namespace App\Controllers;


class Base_Admin_Controller extends Main_Controller
{

    protected $header;
    protected $side_bar;
    protected $content;
    protected $footer;
    protected $title;
    protected $close = true;


    protected function input($params = []){
        parent::input();

    }

    protected function output(){

        $this->header = $this->render(['title' => $this->title],'App/Views/blocks/admin_blocks/header');

        $this->side_bar = $this->render([],'App/Views/blocks/admin_blocks/sidebar');

        $this->footer = $this->render([],'App/Views/blocks/admin_blocks/footer');

        $page = $this->render([
            'header'   => $this->header,
            'footer'   => $this->footer,
            'content'  => $this->content,
            'side_bar' => $this->side_bar
        ],
            'App/Views/blocks/admin_blocks/base_template');

        return $page;

    }

}