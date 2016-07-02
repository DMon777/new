<?php
namespace App\Controllers;


use App\Models\User_Model;

class Registration_Controller extends Base_Controller
{

    protected $login;
    protected $password;
    protected $confirm_password;
    protected $email;
    protected $captcha;
    protected $rand_code;
    protected $email_message;
    protected $to;
    protected $subject = "Без темы";
    protected $from = 'd.mon11kg@gmail.com';
    protected $headers;

    protected function input($params = []){
        parent::input();

        $this->title = "Регистрация";
        $this->scripts = ['jQuery','menu','registration'];

        if($_POST['registration']){
            $this->registration();
        }

    }

    protected function output(){

        $this->content = $this->render([],'App/Views/blocks/registration_content');

        $this->page = parent::output();
    }

    protected function registration(){
        $this->login      = $this->clean_str($_POST['login']);
        $this->password   = $this->clean_str($_POST['password']);
        $this->confirm_password   = $this->clean_str($_POST['confirm_password']);
        $this->email      = $this->clean_str($_POST['email']);
        $this->captcha    = $this->clean_str($_POST['captcha']);
        $this->rand_code = rand(100000,999999);

        User_Model::instance()->reg_user($this->login,$this->password,$this->email,$this->rand_code);


        $this->email_message = "Вы подали заявку на регистрацию на сайте - ".SITE_NAME." ,для активации своего аккаунта
                                перейдите по ссылке  -  http://".SITE_NAME."/activate/code/".$this->rand_code;

        $this->subject = "=?utf-8?B?".base64_encode($this->subject)."?=";
        $this->headers = "From: $this->from\r\nReply-to:$this->from\r\nContent-type:text/plain;charset = utf-8\r\n";

        mail($this->email,$this->email_message,$this->subject,$this->headers);

    }



}