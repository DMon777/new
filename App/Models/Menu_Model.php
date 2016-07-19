<?php


namespace App\Models;


class Menu_Model extends Abstract_Model
{

    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }



    public function make_menu_tree($start_level = 0){

        $sql = "SELECT * FROM menu WHERE parent_id=".$start_level;
        $result = self::$db->prepared_select($sql);

        $map =[];
        if(!empty($result)){
            foreach($result as $item)
            {
                $item['children'] = $this->make_menu_tree($item['id']);
                $map[] = $item;
            }
        }
        return $map;
    }

}