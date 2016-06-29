<?php

namespace App\Models;


class Model
{
    protected static $database_object;
    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }


    protected function __construct(){
        self::$database_object = Database_Model::instance();
    }

    public function get_all_articles(){
        $sql = "SELECT * FROM articles";
        $result = self::$database_object->prepared_select($sql);
        return $result;
    }

    public function get_article($id){
        $sql = "SELECT * FROM articles WHERE id=?";
        $result = self::$database_object->prepared_select($sql,array($id));
        return $result[0];
    }
}