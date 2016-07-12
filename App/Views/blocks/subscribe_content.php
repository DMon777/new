<main id = "subscribe_content">
    <div>
        <p class = "bread_crumbs">
            <a href="http://<?=SITE_NAME;?>/index">Главная</a><span>/Подписка</span>
        </p>
        <article>
            <h1>Подписка</h1>
            <div id="edit_profile_form">
                <table>
                    <form method="post" action="#">
                        <?if(isset($_SESSION['auth']['user'])):?>
                        <p>Здравствуйте <?=$_SESSION['auth']['user'];?>, </p>
                        <?else:?>
                            <tr>
                                <td>
                                    <input type="text" name="name" placeholder="Имя">
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="email" placeholder="Email"><br>
                                </td>
                            </tr>
                        <?endif;?>

                        <tr>
                            <td>
                                <p>выберите темы по которым хотите получать уведомления</p>
                            </td>
                        </tr>

                        <?foreach($categories as $key => $val):?>

                            <tr>
                                <td>
                                    <p><input type="checkbox" name="category[]" value="<?=$val['category_id']?>">
                                        <?=$val['title_in_menu'];?></p>
                                </td>
                            </tr>

                        <?endforeach;?>

                        <tr>
                            <td>
                                <input type="submit" name="subscribe" value="Подписаться" class="button">
                            </td>
                        </tr>

                    </form>
                </table>

                <?if($message):?>
                    <p><?=$message;?></p>
                <?endif;?>

            </div>
        </article>
    </div><!--  end main -->
    <div class = "clear"></div>

</main>