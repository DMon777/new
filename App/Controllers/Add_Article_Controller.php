<?php

namespace App\Controllers;


use App\classes\Mail;
use App\Models\Articles_Model;
use App\Models\Category_Model;

class Add_Article_Controller extends Base_Admin_Controller
{

    protected $image;
    protected $key_words;
    protected $description;
    protected $headline;
    protected $small_article_text;
    protected $full_article_text;
    protected $article_category;
    protected $article_tags;
    protected $tags;
    protected $categories;

    protected function input($params = []){
        parent::input();

        $this->title = "добавление статьи";
        $this->scripts = ['jQuery','ckeditor/ckeditor','AjexFileManager/ajex','ckeditor_inclusion'];
        $this->tags = Articles_Model::instance()->get_all_tags();
        $this->categories = Category_Model::instance()->get_categories();

        if($_POST['add_article']){

          if($this->add_article()){
               $this->send_mail_to_subscribers();
            }
        }

    }

    protected function output(){

        $this->content = $this->render([
            'tags' => $this->tags,
            'categories' => $this->categories
        ],'App/Views/blocks/admin_blocks/add_article_content');

        $this->page = parent::output();
    }

    protected function add_image(){
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
            move_uploaded_file($_FILES['article_image']['tmp_name'],$dir_to_upload_avatar);
        }
    }

    protected function add_article(){

        $this->key_words  = $_POST['keywords'];
        $this->description  = $_POST['description'];
        $this->headline  = $_POST['headline'];
        $this->small_article_text  = $_POST['small_article'];
        $this->full_article_text  = $_POST['full_article'];
        $this->article_category = $_POST['category'];
        $this->article_tags = $_POST['tags'];

        $this->add_image();

        Articles_Model::instance()->add_article
        (
            $this->headline,$this->key_words,$this->description,
            $this->small_article_text,$this->full_article_text,
            $this->article_category,$this->image,$this->article_tags
        );
        return true;
    }

    protected function send_mail_to_subscribers(){

        $emails = Category_Model::instance()->get_subscribers_emails();
        $article_id = Articles_Model::instance()->get_last_article_id();
        $from = "d.mon110kg@gmail.com";
        $subject = "Рассылка";
        $message = "На нашем сайте вышла новая статья -".$this->headline.".
        перейдите по ссылке - http://".SITE_NAME."/article/id/".$article_id;

        for($i = 0;$i < count($emails);$i++){
            Mail::send_mail($emails[$i],$subject,$message,$from);
            sleep(1);
        }
    }



}