<aside>
    <div>

        <div id = "subscribe_block">
            <h1>Подписаться на обновления</h1>
            <p>Подпишитись по <b>e-mail</b> и вы всегда будете самым первым узнавать о новых статьях на нашем сайте!!!</p>
            <img src = "http://<?=SITE_NAME;?>/images/rss.png" id="rss_image">
            <a href="http://<?=SITE_NAME;?>/subscribe" id="subscribe">Подписаться</a>
        </div>

        <div class = "commercial_block">
            <h1>Реклама</h1>
            <img src="http://<?=SITE_NAME;?>/images/reklama3.jpg">
        </div>

        <div class = "tags_select">
            <h1>Выбор по тегам</h1>
            <p class="tags">tags:
                <?foreach($all_tags as $key => $val):?>
                    <a href="http://<?=SITE_NAME;?>/tags/title/<?=$val['href'];?>"> <?=$val['title']?> </a> |

                <?endforeach;?>

            </p>


        <!--    <p class = "tags">tags:<a href="#"> big_ass </a> |<a href="#"> big_tits </a> |<a href="#"> blond </a>
                |<a href="#"> lesbo </a> |<a href="#"> klassic_sex </a> |<a href="#"> small_tits </a> |
                <a href="#"> big_lips </a> |
            </p>-->

        </div>



    </div>
</aside>
<div class="clear"></div>