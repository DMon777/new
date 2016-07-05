<main id = "sitemap_content">
    <div>
        <p class = "bread_crumbs">
            <a href="http://<?=SITE_NAME;?>/index">Главная</a><span>/Карта сайта</span>
        </p>
        <article>
            <h1>Карта сайта</h1>
            <h2>Меню</h2>
            <ul>
                <? foreach($menu as $key => $val):  ?>
                    <?if(count($val['children'] ) > 0):?>
                        <li><a href = "http://<?=SITE_NAME;?>/<?=$val['href'];?>"><?=$val['title'];?></a>
                            <ul>
                                <?foreach($val['children'] as $k => $v): ?>
                                    <li> <a href="http://<?=SITE_NAME;?>/<?=$v['href']?>"> <?=$v['title'];?> </a> </li>
                                <?endforeach;?>
                            </ul>
                        </li>
                    <?else:?>
                        <li><a href = "http://<?=SITE_NAME;?>/<?=$val['href']?>"><?=$val['title'];?></a></li>
                    <?endif;?>
                <?endforeach;?>

            <h2>Статьи</h2>

            <?foreach($categories as $key => $val):?>
                <h3><?=$val['title_in_menu'];?></h3>
                <ul>
                <?foreach($val['articles'] as $k => $v):?>
                    <li> <a href="http://<?=SITE_NAME;?>/article/id/<?=$v['id']?>"> <?=$v['title'];?> </a> </li>
                <?endforeach;?>
                </ul>
            <?endforeach;?>

        </article>
        <div class = "clear"></div>

    </div>
</main>