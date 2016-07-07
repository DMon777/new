<main id="search_results_content">

    <p class = "bread_crumbs">
        <a href="http://<?=SITE_NAME;?>/index">Главная</a><span>/Результаты поиска</span>
    </p>
    <h1>Результаты поиска</h1>

    <div>
        <?if($search_result):?>
            <p>Количество результатов по вашему запросу : <?=count($search_result);?></p>
            <?foreach($search_result as $key => $val):?>
                <article>
                <h1><?=$val['title'];?></h1>
                <p><?=$val['small_article'];?></p>
                <div class = "article_information">
                    <a href="http://<?=SITE_NAME;?>/article/id/<?=$val['id'];?>" class="read_more button">Читать далее</a>
                </div>
                </article>
            <?endforeach;?>

            <?else:?>
            <p> по вашему запросу ничего не найдено!!! </p>

        <?endif;?>

    </div>
</main>