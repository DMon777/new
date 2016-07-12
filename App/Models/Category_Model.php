<?php

namespace App\Models;


class Category_Model extends Abstract_Model
{

    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    public function add_subscriber($name,$email,$categories,$code){

        $sql = "SELECT email FROM subscribers WHERE email='$email'";
        $result = self::$db->prepared_select($sql);
        if($result){
            return false;
        }
        else{
            self::$db->pdo_insert('subscribers',['email','name','code'],[$email,$name,$code]);
            $subscriber_id = self::$db->last_id();
            for($i = 0;$i <= count($categories);$i++){
                self::$db->pdo_insert('categories_subscribe',['subscriber_id','category_id'],[$subscriber_id,$categories[$i]]);
            }
            return true;
        }
    }


    public function get_categories(){
        $sql = "SELECT * FROM categories";
        return self::$db->prepared_select($sql);
    }

}