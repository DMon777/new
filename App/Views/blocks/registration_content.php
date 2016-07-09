<main id = "registration_content">
    <div>
        <p class = "bread_crumbs">
            <a href="http://<?=SITE_NAME;?>/index">Главная</a><span>/Регистрация</span>
        </p>

        <article>

            <h1>Регистрация</h1>

            <?if(!isset($_SESSION['auth']['user'])):?>
                <div id="registration_form">
                    <table>
                        <form method="post" action="#" id="reg_form">
                            <tr>
                                <td class="field_name">Логин</td>
                                <td>
                                    <input type="text" name="login" id="login"><br>
                                    <span class = 'registration_error_message login_error'></span>
                                </td>

                            </tr>
                            <tr>
                                <td class="field_name">Email</td>
                                <td>
                                    <input type="text" name="email" id="email"><br>
                                    <span class = 'registration_error_message email_error'></span>
                                </td>

                            </tr>
                            <tr>
                                <td class="field_name">Пароль</td>
                                <td>
                                    <input type="password" name="password" id="password"><br>
                                    <span class = 'registration_error_message password_error' ></span>
                                </td>

                            </tr>
                            <tr>
                                <td class="field_name">Подтвердите<br> пароль</td>
                                <td>
                                    <input type="password" name="confirm_password" id="confirm_password"><br>
                                    <span class = 'registration_error_message confirm_password_error'></span>
                                </td>

                            </tr>

                            <tr>
                                <td class="field_name">Введите код<br> с картинки</td>
                                <td>
                                    <img src="http://<?=SITE_NAME;?>/captcha.php" id="captcha" width="150"><br>
                                    <input type="text" name="captcha" id="captcha_field"><br>
                                    <span class = 'registration_error_message captcha_error'></span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td  align="center">
                                    <input type="submit" name="registration" value="Зарегестрироваться" class="button">
                                </td>
                                <td></td>
                            </tr>

                        </form>

                    </table>

                </div>

                <p id="registration_message"><?=$message;?></p>
            <?else:?>
                <p>Вы уже зарегестрированны!</p>
            <?endif;?>


        </article>
    </div><!--  end main -->
    <div class = "clear"></div>

</main>