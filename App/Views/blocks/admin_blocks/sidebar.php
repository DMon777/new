<div id="content">


    <div id="left_content">
        <nav class = "admin_nav">
            <ul>

                <li><a href="http://<?=SITE_NAME;?>/admin"> Главная </a> </li>
                <li><a href="http://<?=SITE_NAME;?>/add_article"> Добавить статью </a> </li>
                <li><a href="http://<?=SITE_NAME;?>/edit_tags"> редактировать tags </a> </li>
                <li><a href="http://<?=SITE_NAME;?>/edit_category"> Редактировать категории </a></li>

            </ul>
        </nav>

            <p>hello <?=$_SESSION['auth']['user'];?></p>

        <a href="http://<?=SITE_NAME;?>/logout"> EXIT </a>

    </div>