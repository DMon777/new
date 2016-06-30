<main id = "registration_content">
    <div>
        <p class = "bread_crumbs">
            <a href="http://<?=SITE_NAME;?>/index">Главная</a><span>/Регистрация</span>
        </p>

        <article>

            <h1>Регистрация</h1>

            <div id="registration_form">
                <table>
                    <form method="post" action="#">
                        <tr>
                            <td class="field_name">Логин</td>
                            <td>
                                <input type="text" name="login"><br>
                                <span class = 'registration_error_message'>Сообщение об ошибке</span>
                            </td>

                        </tr>
                        <tr>
                            <td class="field_name">Email</td>
                            <td>
                                <input type="text" name="email"><br>
                                <span class = 'registration_error_message'>Сообщение об ошибке</span>
                            </td>

                        </tr>
                        <tr>
                            <td class="field_name">Пароль</td>
                            <td>
                                <input type="password" name="password"><br>
                                <span class = 'registration_error_message'>Сообщение об ошибке</span>
                            </td>

                        </tr>
                        <tr>
                            <td class="field_name">Подтвердите<br> пароль</td>
                            <td>
                                <input type="password" name="confirm_password"><br>
                                <span class = 'registration_error_message'>Сообщение об ошибке</span>
                            </td>

                        </tr>

                        <tr>
                            <td class="field_name">Введите код<br> с картинки</td>
                            <td>
                                <img src="images/captch.png" id="captcha" width="150"><br>
                                <span class = 'registration_error_message'>Сообщение об ошибке</span>
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

            <p id="registration_message">Сообщение об удачной или неудачной регистрации</p>
        </article>
    </div><!--  end main -->
    <div class = "clear"></div>

</main>