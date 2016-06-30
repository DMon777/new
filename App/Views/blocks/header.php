<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link rel="stylesheet" href="http://<?=SITE_NAME;?>/styles/style.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <? foreach($scripts as $script): ?>
        <script type = "text/javascript" src="http://<?=SITE_NAME;?>/JS/<?=$script;?>.js"></script>
    <? endforeach; ?>

</head>
<body>

<div id = "karkas">
    <div id="main_wrapper">
        <header>

            <a href="#"> <img src="http://<?=SITE_NAME;?>/images/logo.png" alt="logo"> </a>
            <div id="social_icons">
                <a href="#"> <img src="http://<?=SITE_NAME;?>/images/social_icon1.png" alt="social_icon"></a>
                <a href="#"> <img src="http://<?=SITE_NAME;?>/images/social_icon2.png" alt="social_icon"></a>
                <a href="#"> <img src="http://<?=SITE_NAME;?>/images/social_icon3.png" alt="social_icon"></a>
            </div>
            <div id="header_background">
                <img src="http://<?=SITE_NAME;?>/images/header-bg.png" alt="header_background">

                <div id="auth">
                    <div>
                        <img src="http://<?=SITE_NAME;?>/images/x.png" id="auth_close_img" alt="close">

                        <form method = "post" action = "#">
                            <input type="text" name="login" placeholder="Логин"><br>
                            <input type="password" name="password" placeholder="Пароль"><br>
                            <input type="button" name="enter" value="войти">
                        </form>
                        <div class="forgot"><a href="">Забыли логин</a><span>|</span><a href="">Забыли пароль</a> </div>
                    </div>
                </div>

                <div class="adaptive_auth">
                    <img src="http://<?=SITE_NAME;?>/images/login.png" id="auth_img" alt="auth">
                </div>

                <!--   <div id = 'authorized'>
                       <p>Добро пожаловать на сайт</p>
                       <p>Логин</p>
                       <p><a href="#"> редактировать профиль </a> </p>
                   </div>-->

            </div>

        </header>
        <nav>
            <div id = "menu">
                <ul class = "main_menu">
                    <?foreach($menu as $key => $val): ?>
                        <?if(count($val['children'] > 0)):?>
                            <li><a href = "<?=$val['href']?>"><?=$val['title'];?></a>
                                <ul class = "inner_menu">
                                    <?foreach($val['children'] as $k => $v): ?>
                                        <li> <a href="<?=$v['href']?>"> <?=$v['title'];?> </a> </li>
                                    <?endforeach;?>
                                </ul>
                            </li>
                     <?else:?>
                            <li><a href = "<?=$val['href']?>"><?=$val['title'];?></a></li>
                    <?endif;?>
                    <?endforeach;?>
                </ul>

            </div>

            <div id="search">
                <form method="post" action = "#">
                    <div>
                        <input type="text" name = "search_text" placeholder="Найти...">
                        <input type="submit" name = "search" value = "">
                    </div>

                </form>
            </div>

            <div id="adaptive_menu">
                <img src="http://<?=SITE_NAME;?>/images/adaptive_menu.png" id="menu_image" alt="меню">

                <ul id="adaptive_main_menu">
                    <?foreach($menu as $key => $val): ?>
                        <?if(count($val['children'] > 0)):?>
                            <li><a href = "<?=$val['href'];?>"><?=$val['title'];?></a>
                                <ul class = "inner_adaptive_menu">
                                    <?foreach($val['children'] as $k => $v): ?>
                                        <li> <a href="<?=$v['href']?>"> <?=$v['title'];?> </a> </li>
                                    <?endforeach;?>
                                </ul>
                            </li>
                        <?else:?>
                            <li><a href = "<?=$val['href']?>"><?=$val['title'];?></a></li>
                        <?endif;?>
                    <?endforeach;?>
                </ul>

            </div>

            <div id="adaptive_search">
                <img src="http://<?=SITE_NAME;?>/images/adaptive_search.png" id="search_image" alt="найти">
            </div>
        </nav>
        <div class="clear"></div>

        <div id = "adaptive_search_form">
            <form method="post" action = "#">
                <input type="text" name = "search_text" placeholder="Найти...">
                <input type="image" src="images/search.png" name = "search" alt = "search">
                <img src="http://<?=SITE_NAME;?>/images/adaptive_close.png" id="adaptive_form_close" alt="Закрыть">
            </form>
        </div>
        <div class="clear"></div>