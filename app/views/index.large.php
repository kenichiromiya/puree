<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/index.large.css"/>
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
<?php if($title){ ?>
<h1 class="title"><?=$title?></h1>
<?php } ?>
<div class="markdown">
<?php
$markdown = new Markdown();
echo $markdown->parse($text);
?>
</div><!--markdown-->
<?php if($editable){?>
<input id="location" type="text" size="15">
<button onclick='location.href="<?=BASE?><?=$id?>"+$("#location").val()+"?view=edit"'><?=_('Add')?></button>
<div id="drag" draggable="true">
<?=_('Drag to add a photo')?>
</div><!--drag-->
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
foreach($rows as $row) :
?>
<div class="item">
<?php if($row['title']){ ?>
<h1 class="title"><a href="<?=BASE?><?=$row['id']?>"><?=$row['title']?></a></h1>
<?php } ?>
<?php if($row['filename']) :?>
<?php
/*
if (!file_exists("upload/large/".$row['filename'])){
	$image = new Image();
	$image->resize("upload/large/".$row['filename'],"upload/".$row['filename'],900,900);
}
*/
?>
<div class="image">
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/large/<?=$row['filename']?>" ></a>
</div>
<?php endif; ?>
<div class="markdown">
<?php
$markdown = new Markdown();
echo $markdown->parse($row['text']);
?>
</div><!--markdown-->
<?php if(preg_match("#/$#",$row['id'])) :?>
<a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/folder_org_t256.png"></a>
<?php endif; ?>
<?php if($editable): ?>
<!--
<input type="checkbox" name="id[]" value="<?=$row['id']?>">
-->
<?php //if($session['user_id'] and preg_match("/".$session['user_id']."/",$req['id'])){ ?>
<form action="<?=BASE?><?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
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
<?php include("pagination.php")?>
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
<div id="sub">
<?php include("meta.php")?>
</div><!--sub-->
</div><!--container-->
</div><!--wrapper-->
<?php include("footer.php")?>

</body>
</html>
