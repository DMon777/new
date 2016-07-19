<?php

namespace App\Controllers;


use App\Models\Articles_Model;

class Edit_Tags_Controller extends Base_Admin_Controller
{

    protected $tags;
    protected $new_tag;
    protected $tag_href;


    public function input($params = []){
        parent::input();

        if($_POST['add_new_tag']){
            $this->add_new_tag();
        }

        $this->tags = Articles_Model::instance()->get_all_tags();
    }

    public function output(){

        $this->content = $this->render(
            [
                'tags' => $this->tags
            ],
            'App/Views/blocks/admin_blocks/edit_tags_content'
            );
        $this->page = parent::output();
    }

    protected function add_new_tag(){
        $this->new_tag = $_POST['new_tag'];
        $this->tag_href = $_POST['tag_href'];

        Articles_Model::instance()->add_new_tag($this->new_tag,$this->tag_href);
    }


}