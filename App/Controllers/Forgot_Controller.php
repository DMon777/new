<?php


namespace App\Controllers;


use App\classes\Mail;
use App\Models\User_Model;

class Forgot_Controller extends Base_Controller
{
    protected $reconstruction_string;
    protected $forgot_item;
    protected $email;
    protected $login;
    protected $subject;
    protected $message;
    protected $recovery_message;
    protected $from = "d.mon110kg@gmail.com";
    protected $new_password;

    protected function input($params = []){
        parent::input();

        $this->forgot_item = $params['item'];
        $pattern           = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/";
        $this->email       = $this->clean_str($_POST['recovery_email']);

        if($this->forgot_item == 'login'){
            $this->reconstruction_string = "Восстановление логина";

            if($_POST['recovery_button']){
                if(!preg_match($pattern,$this->email)){
                    $this->recovery_message =  " не правильный формат ввода email";
                    return false;
                }

                $this->login = User_Model::instance()->get_login_by_email($this->email);
                if($this->login){
                    $this->subject = "Восстановление логина";
                    $this->message = "Ваш логин на сайте ".SITE_NAME." - ".$this->login['login']." спасибо что остаетесь с нами!!!";
                    Mail::send_mail($this->email,$this->subject,$this->message,$this->from);
                    $this->recovery_message = "На ваш почтовый ящик отправлено письмо с вашим логином , проверьте почту!!!";
                }
                else{
                    $this->recovery_message = "Это адрес электронной почты не зарегестрирован!!!";
                }
            }
        }

        if($this->forgot_item == 'password'){
            $this->reconstruction_string = "Восстановление пароля";

            if($_POST['recovery_button']){
                if(!preg_match($pattern,$this->email)){
                    $this->recovery_message =  " не правильный формат ввода email";
                    return false;
                }
                $this->login = User_Model::instance()->get_login_by_email($this->email);
                if($this->login){
                    $this->subject = "Восстановление пароля";
                    $this->new_password = $this->generate_password();
                    $this->message = "Здравствуйте ".$this->login['login']."! Вот ваш новый пароль - ".$this->new_password;

                    Mail::send_mail($this->email,$this->subject,$this->message,$this->from);
                    User_Model::instance()->update_password($this->login['login'],$this->new_password);
                    $this->recovery_message = "На ваш почтовый ящик отправлено письмо с вашим новым паролем , проверьте почту!!!";
                }
                else{
                    $this->recovery_message = "Это адрес электронной почты не зарегестрирован!!!";
                }
            }
        }

        $this->title = $this->reconstruction_string;

    }

    protected function output(){

        $this->content = $this->render([
            'reconstruction'   => $this->reconstruction_string,
            'recovery_message' => $this->recovery_message
        ],'App/Views/blocks/forgot_content');

        $this->page = parent::output();
    }

    protected function generate_password(){
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $password_length = 7;
        $num_chars = strlen($chars);
        $password = '';
        for($i = 0;$i < $password_length;$i++){
            $password .= substr($chars, rand(1, $num_chars) - 1, 1);
        }
        return $password;
    }
}