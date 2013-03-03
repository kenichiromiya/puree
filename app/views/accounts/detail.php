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

<div id="account">
<?php
/*
if (!file_exists("upload/accounts/large/<?=$icon?>")){
        $image = new Image();
        $image->resize("upload/accounts/large/<?=$icon?>","images/pic_noimage110_dgray.jpg",100,100);
}
*/
?>
<img src="<?=BASE?>upload/accounts/large/<?=$icon?>">
<h1><?=$id?></h1>
<a href="<?=$url?>"><?=$url?></a>
<p>
<?=$profile?>
</p>
</div><!--account-->
<?php if($session['account_id'] == $id){ ?>

<form action="<?=BASE?>accounts/<?=$id?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="put">
<label for="id"><?=_('Username')?></label>
<?php if ($id) { ?>
<input type="text" id="id" name="id" size="20" disabled="disabled" value="<?=$id?>"/><br/>
<?php } else { ?>
<input type="text" id="id" name="id" size="20" value=""/><br/>
<?php }?>
<!--
<label for="password"><?=_('Password')?></label>
<input id="password" type="password" name="password" /><br/>
-->
<label for="email"><?=_('Email')?></label>
<input id="email" type="text" name="email" value="<?=$email?>"/><br/>
<label for="role"><?=_('Role')?></label>
<select id="role" name="role">
<!--option value="admin"<?php if($role == 'admin') { echo 'selected=""'; }?>>admin</option-->
<option value="user"<?php if($role == 'user') { echo 'selected=""'; }?>>user</option>
</select><br/>
<label for="url"><?=_('URL')?></label>
<input id="url" type="text" name="url" value="<?=$url?>"/><br/>
<label for="profile"><?=_('Profile')?></label>
<textarea id="profile" name="profile">
<?=$profile?>
</textarea><br/>
<label for="icon"><?=_('Icon')?></label>
<input id="icon" type="file" name="icon" value=""/><br/>
<label for="submit"><?=_('Submit')?></label>
<input id="submit" type="submit" value="<?=_('Submit')?>"/><br/>
</form>

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
<a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/docu_txt.png" ></a>
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
<!--
<div id="page-nav">
	<a href="?page=<?=$next?>"><?=_('Next')?></a>
</div>
-->
<?php include("pagination.php")?>
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
