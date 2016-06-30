<?php

namespace App\Models;


class Navigation {

    protected  $posts_by_one_page = 3;
    protected  $links_by_sides = 2;
    protected  $current_page;
    protected  $table_name;
    protected static $db;


    public function __construct($current_page,$table_name){
        self::$db = Database_Model::instance();
        $this->current_page = $current_page;
        $this->table_name = $table_name;
    }

    public function get_navigation($total_posts){
        $total_pages = ceil($total_posts/$this->posts_by_one_page);
        $navigation_array  = array();
        if($this->current_page != 1){
            $navigation_array['first'] = 1;
            $navigation_array['arrow_back'] = $this->current_page-1;
        }
        if($this->current_page > $this->links_by_sides + 1){
            for($i = $this->current_page - $this->links_by_sides;$i < $this->current_page;$i++){
                $navigation_array['previous'][] = $i;
            }
        }

        else{
            for($i = 1;$i < $this->current_page;$i++){
                $navigation_array['previous'][] = $i;
            }
        }
        $navigation_array['current'] = (int)$this->current_page;
        if($this->current_page+$this->links_by_sides < $total_pages){
            for($i = $this->current_page + 1;$i <= $this->current_page+$this->links_by_sides;$i++){
                $navigation_array['next'][] = $i;
            }
        }
        else{
            for($i = $this->current_page+1;$i <= $total_pages;$i++){
                $navigation_array['next'][] = $i;
            }
        }
        if($this->current_page != $total_pages){
            $navigation_array['arrow_forward'] = $this->current_page + 1;
            $navigation_array['last_page'] = $total_pages;
        }
        return $navigation_array;
    }

    public function get_articles(){
        $shift = $this->posts_by_one_page*($this->current_page - 1);
        $sql = "SELECT id,title,small_article,quantity_views,publication_date,image,count_likes FROM articles RIGHT JOIN likes ON articles.id = likes.article_id  LIMIT $shift,$this->posts_by_one_page";
        $result = self::$db->prepared_select($sql);
        return $result;
    }

    public function count_articles(){
        $sql = "SELECT COUNT(*) as count from articles";
        return (int)self::$db->prepared_select($sql)[0]['count'];
    }

    public function count_articles_by_category($category_name){
        $category_id = $this->get_category_id($category_name);
        $sql = "SELECT COUNT(*) as count from articles WHERE category=".$category_id['category_id'];
        return (int)self::$db->prepared_select($sql)[0]['count'];
    }

    public function get_articles_by_category($category_name){
       $category_id = $this->get_category_id($category_name);
        $shift = $this->posts_by_one_page*($this->current_page - 1);
        $sql2 = "SELECT id,title,small_article,quantity_views,publication_date,image,count_likes FROM articles RIGHT JOIN likes ON articles.id = likes.article_id
          WHERE category = ".$category_id['category_id']."  LIMIT $shift,$this->posts_by_one_page";
        $result = self::$db->prepared_select($sql2);
        return $result;
    }

    protected function get_category_id($category_name){
        $sql = "SELECT category_id from categories WHERE category_name='$category_name'";
        return self::$db->prepared_select($sql)[0];
    }



    protected function get_tag_id($tag_name){
        $sql = "SELECT id FROM tags WHERE href='$tag_name'";
        $result = self::$db->prepared_select($sql);
        return $result[0];
    }

    public function count_articles_by_tags($tag_name){
        $tag_id = $this->get_tag_id($tag_name);
        $tag_id = (int)$tag_id['id'];
        $sql = "SELECT COUNT(*) as count FROM articles  JOIN articles_tags ON articles.id = articles_tags.article_id WHERE articles_tags.tag_id=".$tag_id;
        $result = self::$db->prepared_select($sql);
        return (int)$result[0]['count'];
    }

    public function get_articles_by_tag($tag_name){
        $shift = $this->posts_by_one_page*($this->current_page - 1);
        $tag_id = $this->get_tag_id($tag_name);
        $tag_id = (int)$tag_id['id'];
        $sql = "SELECT * FROM articles JOIN articles_tags ON articles.id = articles_tags.article_id WHERE articles_tags.tag_id=".$tag_id." LIMIT $shift,$this->posts_by_one_page";
        $result = self::$db->prepared_select($sql);

        foreach($result as $key => $val){
            $result[$key]['tags'] = Articles_Model::instance()->get_tags($val['id']);
        }
        return $result;
    }







}