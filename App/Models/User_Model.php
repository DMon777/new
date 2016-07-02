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



}