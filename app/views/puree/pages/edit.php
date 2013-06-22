<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php echo TITLE; ?> - <?=$title?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/detail.css"/>
<script type="text/javascript" src="<?=BASE?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=BASE?>js/javascript.js"></script>
</head>
<body>

<div id="wrapper">

<?php include("header.php")?>

<div id="container">
<div id="main">
<?php
$_method = "put";
if($session['user_id'] or $session['user_id'] == $row['user_id']){
include("form.php");
} ?>
<!--
<form action="<?=BASE?><?=$id?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
-->

<div id="items" >
<?php
foreach($files as $file) :
?>
<?php
if($file['filename']):
?>
<?php
    if (!file_exists("upload/large/".$file['filename'])){
        $im = new Imagick();
        $im->readImage("upload/".$file['filename']);
        $width = $im->getImageWidth();
        if ($width > 600) {
            $im->resizeImage(600, 0, imagick::FILTER_MITCHELL, 1);
        }
        $large = "upload/large/".$file['filename'];
        if (!is_dir(dirname($large))) {
            mkdir(dirname($large),0777,true);
        }
        $im->writeImage($large);
        $im->destroy();

    }

    if (!file_exists("upload/small/".$file['filename'])){
        $im = new Imagick();
        $im->readImage("upload/".$file['filename']);
        $width = $im->getImageWidth();
        if ($width > 150) {
            $im->resizeImage(150, 0, imagick::FILTER_MITCHELL, 1);
        }
        $small = "upload/small/".$file['filename'];
        if (!is_dir(dirname($small))) {
            mkdir(dirname($small),0777,true);
        }
        $im->writeImage($small);
        $im->destroy();

    }
?>
<div class="item">
<div class="thumb">
<a href="<?=BASE?>upload/large/<?=$file['filename']?>" class="upload"><img src="<?=BASE?>upload/small/<?=$file['filename']?>"></a>
<!--img src="<?=BASE?>upload/small/<?=$file['filename']?>" class=""-->
<?php if($session['role'] == "admin" or $file['user_id'] == $session['user_id']): ?>
<form action="<?=BASE?>files/<?=$file['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<!--input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>"-->
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
</div><!--thumb-->
</div><!--item-->
<?php
endif;
?>
<?php endforeach; ?>
</div><!--items-->
<?php if($session['role'] == "admin" or $row['user_id'] == $session['user_id']): ?>
<form action="<?=BASE?>files/<?=$req['id']?>">
<!--input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>"-->
<div id="drag" draggable="true">
<?=_('Drag to add files')?>
</div><!--drag-->
</form>
<?php endif;?>
</div><!--main-->
<div id="sub">
<?php include("list.php");?>
</div><!--sub-->
</div><!--container-->
</div><!--wrapper-->

</body>
</html>
