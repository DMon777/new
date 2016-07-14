<?php

namespace App\Models;


class Comments_Model extends Abstract_Model
{

    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }

    public function insert_comment($text_comment,$parent_id,$article_id,$user_login,$user_id,$avatar){
        return self::$db->pdo_insert('comments',['parent_id','article_id','text_comment','user_login','user_id','avatar'],
            [$parent_id,$article_id,$text_comment,$user_login,$user_id,$avatar]);
    }

    public function make_comments_tree($article_id,$start = 0){

        $sql = "SELECT * FROM comments WHERE article_id=".$article_id." AND parent_id=".$start;
        $comments = self::$db->prepared_select($sql);
        $map = [];

        if(!empty($comments)){
            foreach($comments as $comment)
            {
                $comment['children'] = $this->make_comments_tree($article_id,$comment['comment_id']);
                $map[] = $comment;
            }

        }
        return $map;
    }

    public function print_comments_map($map){

        if(!empty($map)){
            foreach($map as $val):?>

                <div class="comment">
                    <div class = "comments_left">
                        <img src = "/images/avatars/<?=$val['avatar'];?>">
                        <p class="login"><?=$val['user_login'];?></p>
                    </div>

                    <div class="comments_right">
                        <p class="comment_text"><?=$val['text_comment'];?></p>

                        <?if(isset($_SESSION['auth']['user']) && $val['user_login'] != $_SESSION['auth']['user']):?>
                            <button class = "add_answer answer_button button">Ответить</button>
                        <?endif;?>

                        <div class = "answer_form">
                            <form method="post" action="">
                                <textarea name="answer_comment"></textarea>
                                <input type="hidden" name="parent_id" value="<?=$val['comment_id']?>">
                                <input type="hidden" name="user_login" value="<?=$val['user_login']?>">
                                <span class="x_answer"><img src="/images/x.png"> </span>
                                <input type="submit" name="send_answer" class="add_answer button" value = "Отправить">
                            </form>
                        </div>
                        <?if($val['user_login'] == $_SESSION['auth']['user']):?>
                            <span class="delete_comment"><a href = "" onclick="delete_comment(<?=$val['comment_id'];?>)">
                                    <img src="/images/x.png" alt = "delete">
                                </a> </span>
                        <?endif;?>


                    </div>
                    <div class = "clear"></div>
                    <img class="separate_comments_line" src="/images/comments_separate_line.png">
                    <? $this->print_comments_map($val['children']); ?>
                </div>

                <?php
            endforeach;
        }
        else{
            return false;
        }
    }

    public function print_admin_comments_map($map){
        if(!empty($map)){
            foreach($map as $val):?>
                <ul class="comments_list">
                    <li><?=$val['user_login'];?></li>
                        <li><?=$val['text_comment'];?></li>
                           <li>
                               <a href = "" onclick="delete_comment(<?=$val['comment_id'];?>)">
                                    <img src="/images/x.png" alt = "delete">
                               </a>
                           </li>
                  <li> <? $this->print_admin_comments_map($val['children']); ?></li>
                </ul>
                <?php
            endforeach;
        }
        else{
            return false;
        }
    }






    public function delete_comment($comment_id){
        self::$db->pdo_delete('comments',['comment_id'=>$comment_id]);
        $sql = "SELECT comment_id FROM comments WHERE parent_id=".(int)$comment_id;
        $comment_child = self::$db->prepared_select($sql)[0];
        if($comment_child){
            $this->delete_comment($comment_child['comment_id']);
        }
    }

    public function change_avatar($new_avatar_name,$user_id){
        self::$db->pdo_update('comments',['avatar'],[$new_avatar_name],['user_id' => $user_id]);
    }

    public function get_user_by_comment_id($comment_id){
        $sql = "SELECT user_login FROM comments WHERE comment_id=".$comment_id;
        $result = self::$db->prepared_select($sql)[0];
        $user = User_Model::instance()->get_user($result['user_login']);
        return $user;
    }


}