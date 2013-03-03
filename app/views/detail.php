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
<?=$title?>
</h1>
<?php
if($filename):
        //if (!file_exists("upload/large/".$filename)){
                $image = new Image();
                $image->imageresize("upload/large/".$filename,"upload/".$filename,900,900);
        //}
?>
<div class="image">
<a href="<?=BASE?>upload/<?=$filename?>"><img src="<?=BASE?>upload/large/<?=$filename?>"></a>
</div><!--image-->
<?php
endif;
?>
<div id="text">
<?php
echo Markdown($text);
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
echo $wiki->transform($text, 'xhtml');

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
foreach($rows as $row) :
?>
<div class="item">
<div class="thumb">
<?php if($row['title']){ ?>
<p><?=$row['title']?></p>
<?php } ?>
<?php if($row['filename']) :?>
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['filename']?>" ></a>
<?php else :?>
<?php
/*
$images = array_diff( scandir("upload/thumb/".$row['id']), array(".", "..") );
$images = array_filter($images,"image");
$image = array_pop($images);
*/
if ($image){
?>
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['id']?>/<?=$image?>"></a>
<?php
} else {
?>
<!--a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/folder_org_t256.png" --></a>
<a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/docu_txt.png" ></a>
<?php
}
?>
<?php endif; ?>
<?php if($editable): ?>
<!--
<input type="checkbox" name="id[]" value="<?=$row['id']?>">
-->
<?php //if($session['account_id'] and preg_match("/".$session['account_id']."/",$req['id'])){ ?>
<form action="<?=BASE?><?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
</div><!--thumb-->
</div><!--item-->
<?php endforeach; ?>
</div><!--items-->

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
foreach($files as $row) :
?>
<div class="item">
<div class="thumb">
<?php if($row['title']){ ?>
<p><?=$row['title']?></p>
<?php } ?>
<?php if($row['filename']) :?>
<?php
/*
if (!file_exists("upload/thumb/".$row['filename'])){
	$image = new Image();
	$image->resize("upload/thumb/".$row['filename'],"upload/".$row['filename'],200,300);
}
*/

?>
<a href="<?=BASE?>files/<?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['filename']?>" ></a>
<?php else :?>
<?php 
/*
$images = array_diff( scandir("upload/thumb/".$row['id']), array(".", "..") );
$images = array_filter($images,"image");
$image = array_pop($images);
*/
if ($image){
?>
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['id']?>/<?=$image?>"></a>
<?php
} else {
?>
<!--a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/folder_org_t256.png" --></a>
<a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/docu_txt.png" ></a>
<?php
}
?>
<?php endif; ?>
<?php if($editable): ?>
<!--
<input type="checkbox" name="id[]" value="<?=$row['id']?>">
-->
<?php //if($session['account_id'] and preg_match("/".$session['account_id']."/",$req['id'])){ ?>
<form action="<?=BASE?>files/<?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
</div><!--thumb-->
</div><!--item-->
<?php endforeach; ?>
<!--
<input type="submit" name="_method" value="delete">
<input type="submit" name="_method" value="put">
</form>
-->
</div><!--items-->
<!--
<div id="page-nav">
	<a href="?page=<?=$next?>"><?=_('Next')?></a>
</div>
-->
<form action="<?=BASE?>files/<?=$req['id']?>">
<input type="hidden" name="redirect" value="<?=BASE?><?=$req['id']?>">
<div id="drag" draggable="true">
<?=_('Drag to add files')?>
</div><!--drag-->
</form>
<?php include("pagination.php")?>
<?php
foreach($pages['rows'] as $row) :
?>
<a href="<?=BASE?><?=$row['id']?>"><?=$row['title']?></a>
<?php endforeach; ?>
</div><!--main-->
<?php //if($session['account_id'] and preg_match("/\/$/",$req['id'])){ ?>

<!--
<div id="contents">
<?php if($session['account_id']){ ?>
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
