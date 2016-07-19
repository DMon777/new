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
        $sql  = "SELECT id,title,href from tags JOIN articles_tags ON articles_tags.tag_id = tags.id WHERE articles_tags.article_id =".$article_id;
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

    public function get_all_articles(){
        $sql = "SELECT * FROM articles ORDER BY id DESC LIMIT 10";
        return self::$db->prepared_select($sql);
    }

    public function edit_article($headline,$key_words,$description,
                                 $small_article,$full_article,$category,$image,$tags,$article_id){//добавить тэги

     self::$db->pdo_update('articles',
                            ['title','keywords','description','small_article','full_article','category','image'],
                            [$headline,$key_words,$description,$small_article,$full_article,$category,$image],
                            ['id' => $article_id] );

        $this->edit_tags($tags,$article_id);

    }

    protected function edit_tags($tags,$article_id){
        self::$db->pdo_delete('articles_tags',['article_id' => $article_id]);

        for($i = 0;$i <= count($tags);$i++){
            self::$db->pdo_insert('articles_tags',['article_id','tag_id'],[$article_id,$tags[$i]]);
        }

    }

    public function add_article($headline,$key_words,$description,$small_article,
                                $full_article,$category,$image,$tags){

        self::$db->pdo_insert('articles',
                    ['title','keywords','description','category','small_article','full_article','publication_date','image'],
            [$headline,$key_words,$description,$category,$small_article,$full_article,time(),$image]
            );

        $article_id = self::$db->last_id();
        Likes_Model::instance()->insert_like($article_id);

        for($i = 0;$i <= count($tags);$i++){
            self::$db->pdo_insert('articles_tags',['article_id','tag_id'],[$article_id,$tags[$i]]);
        }

    }

    public function get_last_article_category(){
        $sql = "SELECT category FROM articles ORDER BY id DESC LIMIT 1";
        return self::$db->prepared_select($sql)[0]['category'];
    }

    public function get_last_article_id(){
        $sql = "SELECT id FROM articles ORDER BY id DESC LIMIT 1";
        return self::$db->prepared_select($sql)[0]['id'];
    }

    public function delete_article($article_id){
        $article = $this->get_article($article_id);
        $image = 'images/articles_images/'.$article['image'];

        if(file_exists($image)){
            unlink($image);
        }

        self::$db->pdo_delete('articles',['id' => $article_id]);
        self::$db->pdo_delete('articles_tags',['article_id' => $article_id]);
        Comments_Model::instance()->delete_comment_by_article_id($article_id);
        Likes_Model::instance()->delete_like_by_article_id($article_id);
    }

    public function add_new_tag($new_tag,$tag_href){
        return self::$db->pdo_insert('tags',['title','href'],[$new_tag,$tag_href]);
    }

    public function delete_tag($tag_id){
        self::$db->pdo_delete('tags',['id' => $tag_id]);
    }



}