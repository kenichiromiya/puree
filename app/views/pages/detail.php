<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/detail.css"/>
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
<div id="breadcrumbs">
<a href="<?=BASE?>"><?=_('Top')?></a> &gt;
<?php if($breadcrumbs['id5']):?>
<a href="<?=BASE?><?=$breadcrumbs['id5']?>"><?=$breadcrumbs['title5']?></a> &gt;
<?php endif;?>
<?php if($breadcrumbs['id4']):?>
<a href="<?=BASE?><?=$breadcrumbs['id4']?>"><?=$breadcrumbs['title4']?></a> &gt;
<?php endif;?>
<?php if($breadcrumbs['id3']):?>
<a href="<?=BASE?><?=$breadcrumbs['id3']?>"><?=$breadcrumbs['title3']?></a> &gt;
<?php endif;?>
<?php if($breadcrumbs['id2']):?>
<a href="<?=BASE?><?=$breadcrumbs['id2']?>"><?=$breadcrumbs['title2']?></a> &gt;
<?php endif;?>
<?php if($breadcrumbs['id1']):?>
<a href="<?=BASE?><?=$breadcrumbs['id1']?>"><?=$breadcrumbs['title1']?></a>
<?php endif;?>
</div>
<?php include("operation.php");?>
<h1 class="title">
<?=$row['title']?>
</h1>
<div id="text">
<?php
//echo Markdown($text);
//$markdown = new Markdown();
//echo $markdown->parse($row['text']);
/*
require_once "Text/Wiki.php";
$wiki = new Text_Wiki();

$wiki->setFormatConf('Xhtml', 'translate', HTML_SPECIALCHARS);
echo $wiki->transform($text, 'xhtml');
*/
require_once "Text/Wiki/Mediawiki.php";

$wiki=new Text_Wiki_Mediawiki();

//$wiki->setRenderConf('Xhtml', 'Wikilink', 'new_url', BASE.$req['id'].'/%s');
$wiki->setRenderConf('Xhtml', 'Wikilink', 'view_url', BASE.$req['id'].'/%s');
$wiki->setRenderConf('Xhtml', 'Wikilink', 'new_url', BASE.$req['id'].'/%s');
$wiki->setRenderConf('Xhtml', 'Wikilink', 'new_text', '');
$wiki->setFormatConf('Xhtml','translate',HTML_SPECIALCHARS);
echo $wiki->transform($row['text'], 'xhtml');

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
<div id="items" >
<?php
/*
foreach($page['rows'] as $row) :
?>
<?php endforeach; */?>
<!--
<form action="<?=BASE?>" method="post">
-->
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
//$image = new Image();
//$image->resize("upload/large/".$filename,"upload/".$filename,900,900);
?>
<div class="image">
<a href="<?=BASE?>upload/<?=$file['filename']?>"><img src="<?=BASE?>upload/large/<?=$file['filename']?>"></a>
<?php if($session['role'] == "admin" or $file['user_id'] == $session['user_id']): ?>
<form action="<?=BASE?>files/<?=$file['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
</div><!--image-->
<?php
endif;
?>
<?php /*
<div class="item">
<div class="thumb">
<?php if($file['title']){ ?>
<p><?=$file['title']?></p>
<?php } ?>


<?php if($file['filename']) :?>
<?php
$im = new Imagick();
$im->readImage("upload/".$file['filename']);
$im->cropThumbnailImage(200, 200);
$thumb = "upload/thumb/".$file['filename'];
if (!is_dir(dirname($thumb))) {
    mkdir(dirname($thumb),0777,true);
}
$im->writeImage($thumb);
$im->destroy();

?>
<a href="<?=BASE?>files/<?=$file['id']?>"><img src="<?=BASE?>upload/thumb/<?=$file['filename']?>" ></a>
<?php endif; ?>
<?php if($session['role'] == "admin" or $file['user_id'] == $session['user_id']): ?>
<!--
<input type="checkbox" name="id[]" value="<?=$file['id']?>">
-->
<?php //if($session['user_id'] and preg_match("/".$session['user_id']."/",$req['id'])){ ?>
<form action="<?=BASE?>files/<?=$file['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
</div><!--thumb-->
</div><!--item-->
*/ ?>
<?php endforeach; ?>
<!--
<input type="submit" name="_method" value="delete">
<input type="submit" name="_method" value="put">
</form>
-->
</div><!--items-->
<?php include("dir.php")?>
<!--
<div id="page-nav">
	<a href="?page=<?=$next?>"><?=_('Next')?></a>
</div>
-->
<?php if($session['role'] == "admin" or $row['user_id'] == $session['user_id']): ?>
<form action="<?=BASE?>files/<?=$req['id']?>">
<input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>">
<div id="drag" draggable="true">
<?=_('Drag to add files')?>
</div><!--drag-->
<?php endif;?>
</form>
</div><!--main-->
<div id="sub">
<?php include("list.php");?>
</div><!--sub-->
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
function isImage($var)
{
        if(preg_match("/jpg|jpeg/",$var)){
                return true;
        }
}
?>
