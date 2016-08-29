<div id="right_content">


    <script type="text/javascript">
        function delete_category(id){

            if(confirm("Вы действительно хотите удалить эту категорию?")){
                window.location='http://<?=SITE_NAME;?>/delete/item/category/id/'+id;
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
                <a href = "" onclick="delete_category('<?=$val['id'];?>')"> Delete </a>
            </p>
        <?endforeach;?>

        <input type="submit" name="sort" value="sort">
    </form>

    <h3>Добавить новую категорию:</h3>
    <form method="post" action = "">
      <label for="new_category"> Название категории -  </label>  <input type="text" name="new_category" ><br>
      <label for="href"> ссылка -  </label>  <input type="text" name="href" ><br>

        <input type="submit" name="add_category" value="добавить">

    </form>

</div>
<div class = "clear"></div>

</div>