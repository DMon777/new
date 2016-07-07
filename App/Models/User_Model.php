<?php

namespace App\Models;


class User_Model extends Abstract_Model
{

    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    public function reg_user($login,$password,$email,$code){
        $password = password_hash($password,PASSWORD_DEFAULT);
        return self::$db->pdo_insert('users',['login','password','mail','code'],
                               [$login,$password,$email,$code] );
    }

    public function activate_user($code){
        return self::$db->pdo_update('users',['code','activate'],['',1],['code' => $code]);
    }

    public function check_busy_login($login){
        $sql = "SELECT login FROM users WHERE login='$login'";
        $result = self::$db->prepared_select($sql);
        if($result){
            return true;
        }
        return false;
    }

    public function check_busy_email($email){
        $sql = "SELECT mail FROM users WHERE mail='$email'";
        $result = self::$db->prepared_select($sql);
        if($result){
            return true;
        }
        return false;
    }

    public function auth_user($login,$password){

        $sql = "SELECT login,password FROM users WHERE login='$login'";
        $result = self::$db->prepared_select($sql)[0];

        if($result && password_verify($password,$result['password'])){
            $_SESSION['auth']['user'] = $login;
            return true;
        }
        else{
            return false;
        }

    }

    public function is_auth(){
        if(isset($_SESSION['auth']['login'])){
            return true;
        }
        return false;
    }

    public function get_user_by_id($user_id){
        $sql = "SELECT login,avatar FROM users WHERE id=".$user_id." AND activate=1";
        return self::$db->prepared_select($sql)[0];
    }

    public function get_user($login){
        $sql = "SELECT * FROM users WHERE login='$login'"." AND activate=1";
        return self::$db->prepared_select($sql)[0];
    }


}