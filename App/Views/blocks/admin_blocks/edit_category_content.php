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
    <h1>Редактировать категории</h1>

        <h3>Сортировка пунктов меню:</h3>

    <form method="post" action = "" class="form_sorting">

        <?foreach($categories as $key => $val):?>
            <p><?=$val['title'];?> - sorting:
                <select name = "sorting[]">
            <?for($i = 1;$i <= count($categories);$i++):?>
                <option value="<?=$i?>"
                    <?php
                        if($val['sorting'] == $categories[$i-1]['sorting']){
                            echo "selected";
                        }
                    ?>
                    ><?=$i;?> </option>
            <?endfor;?>
                </select>
            </p>
        <?endforeach;?>

        <input type="submit" name="sort" value="sort">
    </form>


</div>
<div class = "clear"></div>

</div>