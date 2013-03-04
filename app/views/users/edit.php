<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/users/edit.css"/>
<script type="text/javascript" src="<?=BASE?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=BASE?>js/javascript.js"></script>
</head>
<body>

<div id="wrapper">

<?php include("header.php")?>
<div id="container">
<div id="main">
<div id="user">
<?php
/*
if (!file_exists("upload/users/large/<?=$icon?>")){
        $image = new Image();
        $image->resize("upload/users/large/<?=$icon?>","images/pic_noimage110_dgray.jpg",100,100);
}
*/
?>
<img src="<?=BASE?>upload/users/large/<?=$icon?>">
<h1><?=$id?></h1>
<a href="<?=$url?>"><?=$url?></a>
<p>
<?=$profile?>
</p>
</div><!--user-->
<?php if($session['user_id'] == $id){ ?>

<form action="<?=BASE?>users/<?=$id?>" method="post" enctype="multipart/form-data">
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

</div><!--main-->
</div><!--container-->
</div><!--wrapper-->
<?php include("footer.php")?>

</body>
</html>
