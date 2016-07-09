<?php
namespace App\Controllers;

use App\Models\User_Model;
class Ajax_Controller extends Base_Controller
{

    protected function input($params = []){
        parent::input();

        switch($params['method']){
            case 'validate_login':
                $this->validate_login($_POST['login']);
                break;

            case 'validate_email':
                $this->validate_email($_POST['email']);
                break;

            case 'validate_captcha':
                $this->validate_captcha($_POST['captcha']);
                break;
            case 'auth':
            $this->ajax_auth($_POST['login'],$_POST['password']);
            break;
            case 'upload_avatar':
                $this->upload_avatar();
                break;
        }
    }

    protected function validate_login($login){
        if(empty($login)){
            echo "заполните поле!!!";
            return false;
        }

        $pattern = "/^[A-Za-z0-9_-]{3,16}$/";
        if(!preg_match($pattern,$login)){
            echo "Логин должен состоять только из латинский букв цифр дефисов и знаков подчеркивания а так же состоять
            более чем из 3-х символов";
        }
        if(User_Model::instance()->check_busy_login($login)){
            echo "Этот логин уже занят";
        }
        return true;
    }

    public function validate_email($email){
        if(empty($email)){
            echo "заполните поле!!!";
            return false;
        }
        $pattern = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/";
        if(!preg_match($pattern,$email)){
            echo " не правильный формат ввода email";
        }
        if(User_Model::instance()->check_busy_email($email)){
            echo "этот почтовый ящик уже зарегестрирован!!!";
        }

    }

    public function validate_captcha($captcha){
        if(strnatcasecmp ($captcha,$_SESSION['captcha'])){
            echo "код с картинки введен не верно!!!";
        }
        return false;
    }

    public function ajax_auth($login,$password){
        if(empty($login) || empty($password)){
            echo "поля должны быть заполнены!!!";
            return false;
        }
        if(User_Model::instance()->auth_user($login,$password)){
            echo $login;
        }
        else{
            echo "неверный логин или пароль!";
        }

    }

    public function upload_avatar(){

        $upload_dir = "images/avatars/";
        $types = ["image/gif","image/png","image/jpeg","image/pjpeg","image/x-png"];
        $size = 2097152;

        $pattern = '/[А-Яа-я]/';
        if(($_FILES['avatar']['name'])) {

            if (preg_match($pattern, $_FILES['avatar']['name'])) {
                $_FILES['avatar']['name'] = $this->translate_russian_words($_FILES['avatar']['name']);
            }
            $file = $_FILES['avatar']['name'];
        }

        $result = [];
        if(!isset($file)){
            $result = ["answer" => "ошибка загрузки файла!!!"];
            exit(json_encode($result));
        }
        if($_FILES['avatar']['size'] > $size ){
            $result = ["answer" => "ошибка загрузки файла,файл слишком большой!!!"];
            exit(json_encode($result));
        }
        if(!in_array($_FILES['avatar']['type'],$types)){
            $result = ["answer" => "ошибка загрузки файла,не допустимое расширение файлов!!!"];
            exit(json_encode($result));
        }

        if(move_uploaded_file($_FILES['avatar']['tmp_name'],$upload_dir.$_FILES['avatar']['name'])){

            $user = User_Model::instance()->get_user($_SESSION['auth']['user']);



            if(file_exists('images/avatars/'.$user['avatar']) && $user['avatar'] != 'default_avatar.jpg' ){
                unlink('images/avatars/'.$user['avatar']);
            }
            User_Model::instance()->change_avatar($user['id'],$file);

            $result = ["answer" => "","file" => $_FILES['avatar']['name']];
            exit(json_encode($result));
        }

    }



}