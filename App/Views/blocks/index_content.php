<main class="index_content">
    <div>
        <p class = "bread_crumbs">

            <?if($category_name):?>
                <a href="http://<?=SITE_NAME;?>/index">Главная</a>
                <span> /<?=$category_name;?> </span>

            <?else:?>
                <span>Главная </span>
            <?endif;?>
        </p>
        <?if($articles):?>

            <?foreach($articles as $key => $val):?>
                <div class = "article_image">
                    <img src="http://<?=SITE_NAME;?>/images/articles_images/<?=$val['image']; ?>" alt="<?=$val['title'];?>">
                </div>

                <article>
                    <h1><?=$val['title'];?></h1>
                    <span class = "article_date">Дата:<?=date('d/m/Y',$val['publication_date']);?></span>
                    <p><?=$val['small_article'];?></p>
                    <div class = "article_information">

                        <ul>

                            <li>
                                <img src="http://<?=SITE_NAME;?>/images/likes.png" alt="likes"><span><?=$val['count_likes']?></span>
                            </li>
                            <li>
                                <img src="http://<?=SITE_NAME;?>/images/count_rewiews.png" alt="rewiews"><span><?=$val['quantity_views']?></span>
                            </li>
                        </ul>
                        <a href="http://<?=SITE_NAME;?>/article/id/<?=$val['id'];?>" class="read_more button">Читать далее</a>
                    </div>
                </article>
                <div class = "clear"></div>

            <?endforeach;?>


        <?else:?>
            <p>Статей нет!</p>

        <?endif;?>







    <!--    <div class = "article_image">
            <img src="images/articles_images/Alexis_Texas.jpg" alt="Alexis Texas">
        </div>

        <article>
            <h1>Header</h1>
            <p class = "tags">tags:<a href="#"> big_ass </a> |<a href="#"> big_tits </a> |<a href="#"> blond </a></p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                accusantium doloremque laudantium. totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
            </p>
            <div class = "article_information">
                <span class = "article_date">Дата:05/06/2016</span>
                <ul>
                    <li>
                        <img src="images/count_rewiews.png" alt="rewiews"><span>1</span>
                    </li>
                    <li>
                        <img src="images/likes.png" alt="likes"><span>1</span>
                    </li>
                </ul>
                <a href="#" class="read_more button">Читать далее</a>
            </div>
        </article>
        <div class = "clear"></div>

        <div class = "article_image ">
            <img src="images/articles_images/Annika_Albrite.jpg" alt = "Annika Albrite" >
        </div>

        <article>
            <h1>Header</h1>
            <p class = "tags">tags:<a href="#"> big_ass </a> |<a href="#"> big_tits </a> |<a href="#"> blond </a></p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                accusantium doloremque laudantium. totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
            </p>
            <div class = "article_information ">
                <span class = "article_date">Дата:05/06/2016</span>
                <ul>
                    <li>
                        <img src="images/count_rewiews.png" alt="reviews"><span>1</span>
                    </li>
                    <li>
                        <img src="images/likes.png" alt="likes"><span>1</span>
                    </li>
                </ul>
                <a href="#" class="read_more button">Читать далее</a>
            </div>
        </article>
        <div class = "clear"></div>

        <div class = "article_image ">
            <img src="images/articles_images/Mia_Malkova.jpg" alt="Mia Malkova">
        </div>

        <article>
            <h1>Header</h1>
            <p class = "tags">tags:<a href="#"> big_ass </a> |<a href="#"> big_tits </a> |<a href="#"> blond </a></p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                accusantium doloremque laudantium. totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
            </p>
            <div class = "article_information ">
                <span class = "article_date">Дата:05/06/2016</span>
                <ul>
                    <li>
                        <img src="images/count_rewiews.png" alt="reviews"><span>1</span>
                    </li>
                    <li>
                        <img src="images/likes.png" alt="likes"><span>1</span>
                    </li>
                </ul>
                <a href="#" class="read_more button">Читать далее</a>
            </div>
        </article>
        <div class = "clear"></div>-->

    </div>
</main>