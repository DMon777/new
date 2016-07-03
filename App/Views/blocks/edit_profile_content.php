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
                                    <input type="file" name="avatar" >
                                    <img id="avatar" src="http://<?=SITE_NAME;?>/images/default-avatar.jpg">
                                </td>
                                <td><span class = 'registration_error_message'>Сообщение об ошибке</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" name="login" placeholder="Логин">
                                </td>
                                <td><span class = 'registration_error_message'>Сообщение об ошибке</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="email" placeholder="Email">
                                </td>
                                <td><span class = 'registration_error_message'>Сообщение об ошибке</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" placeholder="Пароль">
                                </td>
                                <td><span class = 'registration_error_message'>Сообщение об ошибке</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="confirm_password" placeholder="Повторите пароль">
                                </td>
                                <td><span class = 'registration_error_message'>Сообщение об ошибке</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="registration" value="Применить" class="button">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>


             <?else:?>
                <p>У вас нет доступа к этой странице!!!</p>

            <?endif;?>


        </article>
    </div><!--  end main -->
    <div class = "clear"></div>

</main>