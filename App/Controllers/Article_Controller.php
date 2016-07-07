<?php

namespace App\Controllers;

use App\Models\Articles_Model;
use App\Models\Comments_Model;
use App\Models\User_Model;

class Article_Controller extends Base_Controller
{

    protected $article;
    protected $article_id;
    protected $user;
    protected $text_comment;
    protected $parent_id;
    protected $comments;
    protected $comments_map;


    protected function input($params = []){
        parent::input();

        $this->scripts = ['jQuery','menu','auth','comments'];
        $this->article_id = $params['id'];
        $this->article = Articles_Model::instance()->get_article($this->article_id);
        $this->title = $this->article['title'];
        $this->keywords = $this->article['keywords'];
        $this->description = $this->article['description'];

        Articles_Model::instance()->add_views($this->article_id,$this->article['quantity_views']);

        if(isset($_SESSION['auth']['user'])){
            $this->user = User_Model::instance()->get_user($_SESSION['auth']['user']);
        }

        if($_POST['send_comment']){
            $this->parent_id = $_POST['parent_id'] ?? 0;
            $this->text_comment = $this->clean_str($_POST['text_comment']);
            Comments_Model::instance()->insert_comment($this->text_comment,$this->parent_id,$this->article_id,$this->user['login'],
                            $this->user['avatar']);
        }

        if($_POST['send_answer']){
            $this->parent_id = $_POST['parent_id'];
            $this->text_comment = $this->clean_str($_POST['answer_comment']);
            Comments_Model::instance()->insert_comment($this->text_comment,$this->parent_id,$this->article_id,$this->user['login'],
                $this->user['avatar']);
        }

        $this->comments_map = Comments_Model::instance()->make_comments_tree($this->article_id);

        ob_start();
        Comments_Model::instance()->print_comments_map($this->comments_map);
        $this->comments = ob_get_contents();
        ob_end_clean();

    }

    protected function output(){

        $this->content = $this->render([
            'article'  => $this->article,
            'comments' => $this->comments
        ],
            'App/Views/blocks/article_content');

        $this->page = parent::output();
    }


}