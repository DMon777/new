<main id = "subscribe_content">
    <div>
        <p class = "bread_crumbs">
            <a href="http://<?=SITE_NAME;?>/index">Главная</a><span>/<?=$reconstruction;?></span>
        </p>
        <article>
            <h1><?=$reconstruction;?></h1>
            <div id="edit_profile_form">
                <table>
                    <form method="post" action="#">

                        <tr>
                            <td>
                                <p>введите email который вы указывали при регистрации :</p>
                            </td>
                        </tr>

                        <tr>

                            <td>
                                <input type="text" name = "recovery_email">
                            </td>

                        </tr>


                        <tr>
                            <td>
                                <input type="submit" name="recovery_button" value="Продолжить" class="button">
                            </td>
                        </tr>

                    </form>
                </table>
            </div>
            <?if($recovery_message):?>

                <p><?=$recovery_message;?></p>

            <?endif;?>
        </article>
    </div><!--  end main -->
    <div class = "clear"></div>

</main>