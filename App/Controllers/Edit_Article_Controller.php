<?php

namespace App\Controllers;


use App\Models\Articles_Model;
use App\Models\Category_Model;
use App\Models\Comments_Model;

class Edit_Article_Controller extends Base_Admin_Controller
{

    protected $article;
    protected $article_id;
    protected $tags;
    protected $categories;
    protected $comments;
    protected $comments_map;

    protected $image;
    protected $key_words;
    protected $description;
    protected $headline;
    protected $small_article_text;
    protected $full_article_text;
    protected $article_category;
    protected $article_tags;

    protected function input($params = []){
        parent::input();

        $this->title = "редактирование статьи";
        $this->article_id = $params['id'];

        if($_POST['save_changes']){
            $this->edit_article();
        }

        $this->article = Articles_Model::instance()->get_article($this->article_id);
        $this->tags = Articles_Model::instance()->get_all_tags();
        $this->categories = Category_Model::instance()->get_categories();


        $this->comments_map = Comments_Model::instance()->make_comments_tree($this->article_id);

        ob_start();
        Comments_Model::instance()->print_admin_comments_map($this->comments_map);
        $this->comments = ob_get_contents();
        ob_end_clean();

    }

    protected function output(){

        $this->content = $this->render([
            'categories' => $this->categories,
            'article' => $this->article,
            'tags' => $this->tags,
            'comments' => $this->comments
        ],'App/Views/blocks/admin_blocks/edit_article_content');

        $this->page = parent::output();

    }

    protected function change_image(){
        $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
        foreach ($blacklist as $item){
            if(preg_match("/$item\$/i", $_FILES['article_image']['name'])) exit;
        }

        $pattern = '/[А-Яа-я]/';
        if(!empty($_FILES['article_image']['name'])){

            if(preg_match($pattern,$_FILES['article_image']['name'])){
                $this->image = $this->translate_russian_words($_FILES['article_image']['name']);
            }

            else $this->image = $_FILES['article_image']['name'];

            $dir_to_upload_avatar   = "images/articles_images/".$this->image;
            if(move_uploaded_file($_FILES['article_image']['tmp_name'],$dir_to_upload_avatar)){

                $file_name = "images/articles_images/".Articles_Model::instance()->get_article($this->article_id)['image'];
                if(is_file($file_name)){
                    unlink($file_name);
                }
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $this->image = Articles_Model::instance()->get_article($this->article_id)['image'];
            return false;
        }
    }

    protected function edit_article(){

        $this->key_words  = $_POST['keywords'];
        $this->description  = $_POST['description'];
        $this->headline  = $_POST['headline'];
        $this->small_article_text  = $_POST['small_article'];
        $this->full_article_text  = $_POST['full_article'];
        $this->article_category = $_POST['category'];
        $this->article_tags = $_POST['tags'];

        $this->change_image();

        Articles_Model::instance()->edit_article
        (
            $this->headline,$this->key_words,$this->description,
            $this->small_article_text,$this->full_article_text,
            $this->article_category,$this->image,$this->article_tags,
            $this->article_id
        );
    }



}