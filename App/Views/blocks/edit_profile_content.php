<main id = "edit_profile_content">
    <div>
        <article>

            <?if(isset($_SESSION['auth']['user'])):?>
                <h1>Редактировать профиль</h1>

                <div id="edit_profile_form">
                    <table>
                        <form method="post" action="#" enctype="multipart/form-data" >

                            <tr>
                                <td>
                                    <img id="avatar" src="http://<?=SITE_NAME;?>/images/avatars/<?=$user['avatar'];?>">
                                </td>
                                <td><span class = 'registration_error_message avatar_error'></span></td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" name="login" id="edit_login" value="<?=$user['login'];?>" >
                                </td>
                                <td><span class = 'registration_error_message login_error'></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="email" id="edit_email" value = "<?=$user['mail'];?>">
                                </td>
                                <td><span class = 'registration_error_message email_error'></span></td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" name="edit_profile" value="Применить" class="button">
                                </td>
                            </tr>

                        </form>
                    </table>
                    <?if($message):?>
                        <p id="edit_profile_message"> <?=$message;?> </p>
                    <?endif;?>

                </div>


             <?else:?>
                <p>У вас нет доступа к этой странице!!!</p>

            <?endif;?>


        </article>
    </div><!--  end main -->
    <div class = "clear"></div>

</main>