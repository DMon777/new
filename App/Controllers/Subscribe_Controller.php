<?php

namespace App\Controllers;


use App\Models\Category_Model;
use App\Models\User_Model;
use App\classes\Mail;

class Subscribe_Controller extends Base_Controller
{

    protected $categories;
    protected $subscribe_categories;
    protected $subscriber_name;
    protected $email;
    protected $message;
    protected $user;
    protected $rand_code;
    protected $subject = "активация подписки";
    protected $from = 'd.mon110kg@gmail.com';
    protected $email_message;

    protected function input($params = []){
        parent::input();

        $this->title = "Подписка на обновления";
        $this->categories = Category_Model::instance()->get_categories();


        if($_POST['subscribe']){
            $this->add_subscriber();
        }
    }

    protected function output(){

        $this->content = $this->render([
            'categories' => $this->categories,
            'message'    => $this->message

        ],'App/Views/blocks/subscribe_content');

        $this->page = parent::output();
    }

    protected function add_subscriber(){

        if(isset($_SESSION['auth']['user'])){

            $this->user = User_Model::instance()->get_user($_SESSION['auth']['user']);
            $this->subscriber_name = $this->user['login'];
            $this->email = $this->user['mail'];
        }
        else{

            $this->subscriber_name = $this->clean_str( $_POST['name']);
            $this->email = $this->clean_str( $_POST['email']);

            if(strlen($this->subscriber_name) < 3){
                $this->message = "Имя слишком короткое!";
                return false;
            }

            if(!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/"
                ,$this->email )){
                $this->message = "Не правильный формат ввода email";
                return false;
            }
        }

        $this->subscribe_categories = $_POST['category'];



        if(!$this->subscribe_categories){
            $this->message = "Вы не выбрали ни одной категории , что же вам тогда присылать?";
            return false;
        }

        $this->rand_code = rand(100000,999999);

        if(Category_Model::instance()->add_subscriber($this->subscriber_name,$this->email,$this->subscribe_categories,$this->rand_code)){

        $this->email_message = "Вы подали заявку на рассылку новостей на сайте - ".SITE_NAME." ,для активации
                                перейдите по ссылке  -  http://".SITE_NAME."/activate/item/subscriber/code/".$this->rand_code.".Если вы не подписывались на
                                новости просто проигнорируйте данное письмо.";
        Mail::send_mail($this->email,$this->subject,$this->email_message,$this->from);
        $this->message = "на ваш email было отправлено письмо с сылкой для активации подписки, проверьте ваш почтовый ящик.";
            return true;
        }
        else{
            $this->message = "произошла ошибка!";
        }

    }



}