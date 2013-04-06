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

<div id="wrapper">
<?php include("header.php")?>

<div id="container">
<div id="main">
<div id="breadcrumbs">
<a href="<?=BASE?>"><?=_('Top')?></a>
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
?>
<?php
require_once "Text/Wiki/Mediawiki.php";

$wiki=new \Text_Wiki_Mediawiki();

//$wiki->setRenderConf('Xhtml', 'Wikilink', 'new_url', BASE.$req['id'].'/%s');
$wiki->setRenderConf('Xhtml', 'Wikilink', 'view_url', BASE.$req['id'].'%s');
$wiki->setRenderConf('Xhtml', 'Wikilink', 'new_url', BASE.$req['id'].'%s');
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
<?php include("dir.php")?>
<!--
<div id="page-nav">
	<a href="?page=<?=$next?>"><?=_('Next')?></a>
</div>
-->
<?php include("pagination.php")?>
</div><!--main-->
<div id="sub">
<h1>ページ一覧</h1>
<ul>
<?php
foreach($pages as $page) :
?>
<li><a href="<?=BASE?><?=$page['id']?>"><?=$page['title']?></a></li>
<?php endforeach; ?>
</ul>
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
function is_image($var)
{
        if(preg_match("/jpg|jpeg/",$var)){
                return true;
        }
}
?>
