<div id="right_content">


    <script type="text/javascript">
        function delete_tag(tag_id){

            if(confirm("Вы действительно хотите удалить этот тег?")){
                window.location='http://<?=SITE_NAME;?>/delete/item/tag/id/'+tag_id;
            }
            else{
                return false;
            }
        }
    </script>
    <h1>Редактировать теги</h1>

    <h3>Добавить тег : </h3>

    <form method="post" action="">

       <label for="new_tag">Заголовок тега - </label> <input type="text" name="new_tag"><br>
       <label for="tag_href">Ссылка тега - </label> <input type="text" name="tag_href"><br>
        <input type="submit" name = "add_new_tag" value="добавить">

    </form>
    <ol>
    <?foreach($tags as $key => $val):?>
        <li> <?=$val['title'];?> - <a href = "" onclick="delete_tag(<?=$val['id'];?>)"> Удалить </a> </li>
    <?endforeach;?>
    </ol>

</div>
<div class = "clear"></div>

</div>