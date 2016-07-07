<?php


namespace App\Models;


class Articles_Model extends Abstract_Model
{
    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    public function get_tags($article_id){
        $sql  = "SELECT title,href from tags JOIN articles_tags ON articles_tags.tag_id = tags.id WHERE articles_tags.article_id =".$article_id;
        $result = self::$db->prepared_select($sql);
        return $result;
    }

    public function get_tag_title($href){
        $sql = "SELECT title FROM tags WHERE href='$href'";
        return self::$db->prepared_select($sql)[0]['title'];
    }

    public function get_category_title($category_name){
        $sql = "SELECT title_in_menu FROM categories WHERE category_name='$category_name'";
        return self::$db->prepared_select($sql)[0]['title_in_menu'];
    }

    public function get_all_tags(){
        $sql = "SELECT * FROM tags";
        $result = self::$db->prepared_select($sql);
        return $result;
    }

    public function get_all_categories(){
        $sql = "SELECT * FROM categories";
        $categories = self::$db->prepared_select($sql);
        foreach ($categories as $key => $val) {
            $categories[$key]['articles'] = $this->get_articles_by_category_id($val['category_id']);
        }
        return $categories;
    }

    protected function get_articles_by_category_id($category_id){
        $sql = "SELECT id,title FROM articles WHERE category=".$category_id;
        return self::$db->prepared_select($sql);
    }

    public function get_search_results($search_string){
        $sql = "SELECT id,title,small_article,full_article FROM articles WHERE MATCH (title,full_article) AGAINST('$search_string')";
        return self::$db->prepared_select($sql);
    }

    public function get_article($article_id){
        $sql = "SELECT * FROM articles RIGHT JOIN likes ON articles.id=likes.article_id WHERE id=".$article_id;
        $result = self::$db->prepared_select($sql)[0];
        $result['tags'] = $this->get_tags($result['id']);
        return $result;
    }

    public function add_views($article_id,$quantity_views){
        $new_quantity_views = $quantity_views+1;
        return self::$db->pdo_update('articles',['quantity_views'],[$new_quantity_views],
                   ['id' => $article_id] );
    }


}