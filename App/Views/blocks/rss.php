<?php

echo '<?xml version="1.0" encoding="UTF-8" ?>'

;?>
<rss version="2.0">
    <channel>
        <title>Лента <?=SITE_NAME;?></title>
        <link>http://<?=SITE_NAME;?></link>
        <description>All about pornstars</description>

        <?foreach($articles as $key => $val):?>

            <item>
                <title><?=$val['title'];?></title>
                <link>http://<?=SITE_NAME;?>/article/id/<?=$val['id'];?></link>
                <description><?=$val['small_article'];?></description>
            </item>


        <?endforeach;?>

    </channel>
</rss>

