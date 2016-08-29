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

        $sql = "SELECT * FROM menu WHERE parent_id=".$start_level." ORDER BY sorting ASC";
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

    public function get_categories(){
        $sql = "SELECT * FROM menu WHERE parent_id > 0 ORDER BY sorting ASC";
        return self::$db->prepared_select($sql);
    }

    public function category_sorting($sorting,$categories){

        for($i = 0;$i < count($categories);$i++){
            self::$db->pdo_update('menu',['sorting'],[$sorting[$i]],['id' => $categories[$i]['id']]);
        }
    }

    public function add_category($title,$href){

        $num_sort = count($this->get_categories())+1;
        $full_href = 'categories/id/'.$href;
        self::$db->pdo_insert('menu',['title','href','parent_id','sorting'],
            [$title,$full_href,2,$num_sort]);
    }

    public function delete_category($id){
        self::$db->pdo_delete('menu',['id' => $id]);
    }
}