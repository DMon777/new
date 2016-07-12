<?php
namespace App\Controllers;


use App\Models\User_Model;
use App\classes\Mail;

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
    protected $subject = "registration";
    protected $from = 'd.mon110kg@gmail.com';
    protected $headers;
    protected $registration_message;

    protected function input($params = []){
        parent::input();

        $this->title = "Регистрация";
        $this->scripts = ['jQuery','menu','registration','jquery.tagcloud'];

        if($_POST['registration']){
            $this->registration();
        }

    }

    protected function output(){

        $this->content = $this->render(['message' => $this->registration_message],
            'App/Views/blocks/registration_content');

        $this->page = parent::output();
    }

    protected function registration(){
        $this->login      = $this->clean_str($_POST['login']);
        $this->password   = $this->clean_str($_POST['password']);
        $this->confirm_password   = $this->clean_str($_POST['confirm_password']);
        $this->email      = $this->clean_str($_POST['email']);
        $this->captcha    = $this->clean_str($_POST['captcha']);
        $this->rand_code = rand(100000,999999);

        if(User_Model::instance()->check_busy_login($this->login) || strlen($this->login) < 3 ){

            return false;

        }

        if(!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/"
                        ,$this->email )||
            User_Model::instance()->check_busy_email($this->email)){
            $this->registration_message = "Ошибка при регистрации , попробуйте еще.";
            return false;
        }

        if($this->password != $this->confirm_password  || strlen($this->password) < 5 ){
            $this->registration_message = "Ошибка при регистрации , попробуйте еще.";
            return false;
        }

         if(strnatcasecmp ($this->captcha,$_SESSION['captcha'])){
             $this->registration_message = "Ошибка при регистрации , попробуйте еще.";
             return false;
         }


        User_Model::instance()->reg_user($this->login,$this->password,$this->email,$this->rand_code);


        $this->email_message = "Вы подали заявку на регистрацию на сайте - ".SITE_NAME." ,для активации своего аккаунта
                                перейдите по ссылке  -  http://".SITE_NAME."/activate/item/user/code/".$this->rand_code;

        Mail::send_mail($this->email,$this->subject,$this->email_message,$this->from);
        $this->registration_message = "На ваш почтовый ящик было отправлено письмо с ссылкой на подтверждение регистрации,проверьте почтовый ящик.";
        return true;

    }



}