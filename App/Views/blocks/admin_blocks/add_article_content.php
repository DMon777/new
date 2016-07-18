<div id="right_content">
    <h1>Добавить статью</h1>

    <form method="post" action="" enctype="multipart/form-data">

        <table>
            <tr>
            <td> загрузить изображение</td>
            <td><input type="file" name="article_image" id="article_image"></td>
            </tr>

            <tr>
                <td> Заголовок </td>
                <td> <input type="text" name="headline"> </td>
            </tr>
            <tr>
                <td> keywords </td>
                <td> <input type="text" name="keywords" > </td>
            </tr>
            <tr>
                <td> description </td>
                <td> <input type="text" name="description" > </td>
            </tr>
            <tr>
                <td> Вступительная статья </td>
                <td><textarea name="small_article" cols = "70" rows="5">  </textarea></td>
            </tr>
            <tr>
                <td> Полная статья </td>
                <td> <textarea name="full_article"  cols = "70" rows="20"> </textarea></td>
            </tr>

            <tr>
                <td>Категория</td>
                <td>
                    <select name = "category">
                        <?foreach($categories as $key => $val):?>
                            <option  value="<?=$val['category_id'];?>">
                                <?=$val['title_in_menu'];?></option>
                        <?endforeach;?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>tags</td>
                <td>
                    <?foreach($tags as $key => $val):?>
                            <input type="checkbox" value = "<?=$val['id'];?>" name="tags[]"> <?=$val['title'];?>&nbsp;|
                    <?endforeach;?>
                </td>


            <tr>
                <td colspan="2"> <input type="submit" name="add_article" value="Сохранить статью"> </td>
            </tr>
        </table>
    </form>

</div>
<div class = "clear"></div>

</div>