<div id="right_content">
    <script type="text/javascript">

        function delete_article(article_id){

            if(confirm("Вы действительно хотите удалить эту статью?")){
                window.location='http://<?=SITE_NAME;?>/delete/item/article/id/'+article_id;
            }
            else{
                return false;
            }
        }

    </script>
    <div>

        <h2>Главная страница админ панели</h2>
        <p>Здравствуйте уважаемый Дима Бессалов , вы находитесь в админ панели вашего сайта</p>


        <div class="articles">

            <?if($articles):?>

                <?foreach($articles as $key => $val):?>
                    <p><?=$val['title'];?> | <a href="/edit_article/id/<?=$val['id'];?>"> Редактировать </a> |
                        <a href = "" onclick="delete_article(<?=$val['id'];?>)">  Удалить </a> </p>

                <?endforeach;?>

            <?else:?>

                <p>Статей не найдено!!!</p>

            <?endif;?>


        </div>

    </div>

    <div>

        <?if($navigation):?>

            <table>
                <tr>
                    <? if($navigation['first']):?>
                        <td> <a href="http://<?=SITE_NAME;?>/<?=$href;?>/page/<?=$navigation['first'];?>">В начало</a></td>
                    <?endif;?>
                    <? if($navigation['arrow_back']):?>
                        <td>  <a href="http://<?=SITE_NAME;?>/<?=$href;?>/page/<?=$navigation['arrow_back'];?>" class="arrow">
                                <img src="http://<?=SITE_NAME;?>/images/arrow_back.png" alt="back">
                            </a>
                        </td>
                    <?endif;?>
                    <? if($navigation['previous']):?>
                        <? foreach($navigation['previous'] as $val):?>

                            <td> <a href="http://<?=SITE_NAME;?>/<?=$href;?>/page/<?=$val;?>"><?=$val;?></a></td>
                        <? endforeach;?>
                    <? endif;?>
                    <? if($navigation['current']):?>
                    <td><a href="#" class="current_page"><?=$navigation['current']?></a>
                        <? endif;?>

                        <? if($navigation['next']):?>
                        <? foreach($navigation['next'] as $val):?>
                    <td><a href="http://<?=SITE_NAME;?>/<?=$href;?>/page/<?=$val;?>"><?=$val;?></a><td>
                        <? endforeach;?>
                        <? endif;?>

                        <? if($navigation['arrow_forward']):?>
                    <td><a href = "http://<?=SITE_NAME;?>/<?=$href;?>/page/<?=$navigation['arrow_forward'];?>" class="arrow">
                            <img src="http://<?=SITE_NAME;?>/images/arrow_forward.png" alt="forvard">
                        </a>
                    <td>
                        <? endif;?>

                        <? if($navigation['last_page']):?>
                    <td><a href = "http://<?=SITE_NAME;?>/<?=$href;?>/page/<?=$navigation['last_page'];?>"> В конец </a></td>
                <? endif;?>

                </tr>
            </table>




        <?endif;?>


    </div>


</div>
<div class = "clear"></div>

</div>