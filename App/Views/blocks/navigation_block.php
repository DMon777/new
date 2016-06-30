<div id="navigation">
    <div>
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








       <!-- <table>
            <tr>
                <td> <a href="#"> В начало </a> </td>
                <td> <a href="#" class = "arrow"> <img src="images/arrow_back.png" alt="back">  </a> </td>
                <td> <a href="#" class = "current_page"> 1 </a> </td>
                <td> <a href="#"> 2 </a> </td>
                <td> <a href="#"> 3 </a> </td>
                <td> <a href="#"> 4 </a> </td>
                <td> <a href="#"> 5 </a> </td>
                <td> <a href="#" class="arrow"> <img src="images/arrow_forward.png" alt="forvard">  </a> </td>
                <td> <a href="#"> В конец </a> </td>
            </tr>
        </table>-->
    </div>
</div>