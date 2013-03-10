<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/index.css"/>
<script type="text/javascript" src="<?=BASE?>js/jquery-1.7.1.min.js"></script>
<!--script type="text/javascript" src="<?=BASE?>js/jquery.masonry.min.js"></script-->
<!--<script type="text/javascript" src="<?=BASE?>js/jquery.infinitescroll.min.js"></script>-->
<!--script type="text/javascript" src="<?=BASE?>js/jquery.bottom-1.0.js"></script-->
<!--script type="text/javascript" src="<?=BASE?>js/jquery.browser.min.js"></script-->
<!--<script type="text/javascript" src="<?=BASE?>js/jstorage.js"></script>-->
<script type="text/javascript" src="<?=BASE?>js/javascript.js"></script>
<!--script type="text/javascript" src="<?=BASE?>js/bottom.js"></script-->
</head>
<body>
<?php
include_once "app/functions/markdown.php";
?>

<div id="wrapper">
<?php include("header.php")?>

<div id="container">
<div id="main">
<?php if($id5):?>
<a href="<?=BASE?><?=$id5?>"><?=$title5?></a> &gt;
<?php endif;?>
<?php if($id4):?>
<a href="<?=BASE?><?=$id4?>"><?=$title4?></a> &gt;
<?php endif;?>
<?php if($id3):?>
<a href="<?=BASE?><?=$id3?>"><?=$title3?></a> &gt;
<?php endif;?>
<?php if($id2):?>
<a href="<?=BASE?><?=$id2?>"><?=$title2?></a> &gt;
<?php endif;?>
<?php if($id1):?>
<a href="<?=BASE?><?=$id1?>"><?=$title1?></a>
<?php endif;?>
<h1 class="title">
<?=$row['title']?>
</h1>
<?php
if($row['filename']):
?>
<?php
    if (!file_exists("upload/large/".$row['filename'])){
        $im = new Imagick();
        $im->readImage("upload/".$row['filename']);
        $width = $im->getImageWidth();
        if ($width > 600) {
            $im->resizeImage(600, 0, imagick::FILTER_MITCHELL, 1);
        }
        $im->writeImage("upload/large/".$row['filename']);
        $im->destroy();

    }
//$image = new Image();
//$image->resize("upload/large/".$filename,"upload/".$filename,900,900);
?>
<div class="image">
<a href="<?=BASE?>upload/<?=$row['filename']?>"><img src="<?=BASE?>upload/large/<?=$row['filename']?>"></a>
</div><!--image-->
<?php
endif;
?>
<div id="text">
<?php
echo Markdown($text);
//$markdown = new Markdown();
//echo $markdown->parse($row['text']);
?>
</div><!--text-->
<div id="twitter">
<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div><!--twitter-->

<?php if($editable){?>
<!--
<input id="location" type="text" size="15">
<button onclick='location.href="<?=BASE?><?php echo preg_replace("#[^/]+$#","",$id)?>"+$("#location").val()+"?view=edit"'><?=_('Add')?></button>
-->
<?php } ?>
</div><!--main-->
<?php //if($session['user_id'] and preg_match("/\/$/",$req['id'])){ ?>

<!--
<div id="contents">
<?php if($session['user_id']){ ?>
<input id="multiple" type="file" multiple="multiple" />
<br />

<?php } ?>
</div>
-->
</div><!--container-->
</div><!--wrapper-->
<?php include("footer.php")?>

</body>
</html>
<?php
function image($var)
{
        if(preg_match("/jpg|jpeg/",$var)){
                return true;
        }
}
?>
