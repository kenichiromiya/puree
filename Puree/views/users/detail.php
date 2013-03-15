<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/index.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/users.css"/>
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

<a href="<?=BASE?>users/<?=$req['id']?>?view=edit"><?=_('Edit')?></a>
<div id="user">
<?php
/*
if (!file_exists("upload/users/large/<?=$icon?>")){
        $image = new Image();
        $image->resize("upload/users/large/<?=$icon?>","images/pic_noimage110_dgray.jpg",100,100);
}
*/
?>
<div id="image">
<img src="<?=BASE?>upload/users/large/<?=$row['icon']?>">
</div>
<div id="profile">
<h1><?=$row['id']?></h1>
<a href="<?=$row['url']?>"><?=$row['url']?></a>
<p>
<?=$row['profile']?>
</p>
</div>
</div><!--user-->


<br/>
<div id="items" >
<?php
foreach($rows as $row) :
?>
<?php if($row['filename']) :?>
<div class="item">
<div class="thumb">
<?php if($row['title']){ ?>
<p><?=$row['title']?></p>
<?php } ?>

<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['filename']?>" ></a>

<form action="<?=BASE?><?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
</div><!--thumb-->
</div><!--item-->
<?php endif; ?>
<?php endforeach; ?>
</div><!--items-->
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
foreach($rows as $row) :
?>
<li><a href="<?=BASE?><?=$row['id']?>"><?=$row['title']?></a></li>
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
function image($var)
{
        if(preg_match("/jpg|jpeg/",$var)){
                return true;
        }
}
?>
