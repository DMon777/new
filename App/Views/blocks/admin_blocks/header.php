<html>
<head>
    <link rel = "stylesheet" href="http://<?=SITE_NAME;?>/styles/admin_styles.css" type = "text/css">
    <?if($scripts):?>
    <? foreach($scripts as $script): ?>
        <script type = "text/javascript" src="http://<?=SITE_NAME;?>/JS/<?=$script;?>.js"></script>
    <? endforeach; ?>
    <?endif;?>
    <title>
        <?=$title;?>
    </title>

</head>
<body>

<div id = "wrapper">
    <div id="header">
        <h1>ADMIN PANEL</h1>
    </div>