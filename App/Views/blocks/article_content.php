<main class = "full_article_content">
    <div>

        <script type="text/javascript">

            function delete_comment(comment_id){

                if(confirm("Вы действительно хотите удалить этот комментарий?")){
                    window.location='http://<?=SITE_NAME;?>/delete/item/comment/id/'+comment_id;
                }
                else{
                    return false;
                }
            }

        </script>

        <article>
            <p class = "bread_crumbs">

                <a href="/index">Главная</a><span>/<?=$article['title'];?></span>

            </p>

            <?if($article):?>
                <h1><?=$article['title'];?></h1>
                <p class = "tags">tags:
                    <?foreach($article['tags'] as $key => $val):?>
                        <a href="http://<?=SITE_NAME;?>/tags/title/<?=$val['href'];?>"> <?=$val['title'];?> </a> |
                    <?endforeach;?>

                </p>
                <img src="http://<?=SITE_NAME;?>/images/articles_images/<?=$article['image'];?>" class="full_article_header_image">
                <span class = "article_date">Дата:<?=date('d/m/Y',$article['publication_date']);?></span>
                <p><?=$article['full_article'];?></p>

                <div class = "article_information">

                    <ul>
                        <li>
                            <input type="hidden" class = "article_id" value="<?=$article['id'];?>">
                            <img src="/images/likes.png" class = "likes_img"><span class = 'count_likes'><?=$article['count_likes'];?></span>


                        </li>

                        <li>
                            <img src="/images/count_rewiews.png" class = "count_rewiews_img"><span><?=$article['quantity_views'];?></span>
                        </li>
                    </ul>
                    <a href="<?=$_SERVER['HTTP_REFERER'];?>" class="read_more button">Вернуться обратно</a>
                </div>

            <?else:?>
            <p>Статья не найдена!</p>
            <?endif;?>


        </article>

        <div id="comments_main">
            <h1>Комментарии</h1>
            <div>
                <?if(isset($_SESSION['auth']['user'])):?>
                    <a href="#" class="add_comment_button button">Добавить комментарий</a>

                    <div id = "text_comment">
                        <form method="post" action="">
                            <textarea name="text_comment"> </textarea>
                            <input type="submit" name = "send_comment" class="button" value="отправить">
                        </form>
                        <span class="x">
                            <img src = "/images/x.png">
                        </span>
                    </div>
                 <?else:?>
                    <p>Только зарегестрированные пользователи могут оставлять комментарии.</p>
                <?endif;?>

            </div>

            <? if($comments):?>

                <?=$comments; ?>
            <?else:?>
                <p> Комментариев пока нет </p>
            <?endif;?>


    </div><!--  end main -->

    <div class = "clear"></div>

</main>