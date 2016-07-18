<?php

namespace App\Models;


class Likes_Model extends Abstract_Model
{

    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    public function add_like($article_id){

       $count_likes = $this->count_likes($article_id);

        if($count_likes != 0){

            $likers = $this->get_likers($article_id);

            foreach($likers as $key => $val){
                if($val['user_login'] == $_SESSION['auth']['user']){
                    $this->delete_like($_SESSION['auth']['user'],$article_id);
                    return false;
                }
            }
                self::$db->pdo_update('likes',['count_likes'],[$count_likes+1],['article_id' => $article_id]);
                $like_id = $this->get_like_id($article_id);
                $this->add_liker($like_id,$article_id,$_SESSION['auth']['user']);
        }
        else{
            self::$db->pdo_update('likes',['count_likes'],[1],['article_id' => $article_id]);
            $like_id = $this->get_like_id($article_id);
            $this->add_liker($like_id,$article_id,$_SESSION['auth']['user']);
        }
    }

    public function count_likes($article_id){
        $sql = "SELECT count_likes FROM likes WHERE article_id=".$article_id;
        return self::$db->prepared_select($sql)[0]['count_likes'];
    }

    protected function get_likers($article_id){
        $sql = "SELECT user_login FROM likers  LEFT JOIN likes
         ON likes.like_id=likers.like_id WHERE likers.article_id='$article_id'";
        return self::$db->prepared_select($sql);
    }

    protected function delete_like($user_login,$article_id){
       $sql = "DELETE FROM likers WHERE user_login='$user_login' AND article_id=$article_id";
       // self::$db->pdo_delete('likers',['user_login' => $user_login,'article_id' => $article_id],['=','AND']);

        self::$db->query($sql);

        $count_likes = $this->count_likes($article_id);
        $count_likes -= 1;
        self::$db->pdo_update('likes',['count_likes'],[$count_likes],['article_id' => $article_id]);
    }

    protected function add_liker($like_id,$article_id,$user_login){
        return self::$db->pdo_insert('likers',['like_id','article_id','user_login'],
            [$like_id,$article_id,$user_login]);
    }

    protected function get_like_id($article_id){
        $sql = "SELECT like_id FROM likes WHERE article_id=".$article_id;
        return  self::$db->prepared_select($sql)[0]['like_id'];
    }

    public function insert_like($article_id){
        self::$db->pdo_insert('likes',['article_id'],[$article_id]);
    }

}