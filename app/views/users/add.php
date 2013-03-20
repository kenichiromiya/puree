<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/users/index.css"/>
<?=$head?>
</head>
<body>
<div id="wrapper">
<?php include("header.php")?>

<?php
?>
<div id="container">
<div id="main">
<form action="<?=$base?>users/?view=add" method="post">
<input type="hidden" name="_method" value="post">
<label for="id"><?=_('Username')?></label>
<input type="text" id="id" name="id" size="20" value="<?=$row['id']?>"/><?=$errors['id']?><br/>
<label for="password"><?=_('Password')?></label>
<input id="password" type="password" name="password" /><?=$errors['password']?><br/>
<label for="email"><?=_('Email')?></label>
<input id="email" type="text" name="email" value="<?=$row['email']?>"/><?=$errors['email']?><br/>
<label for="submit"><?=_('Submit')?></label>
<input id="submit" type="submit" value="<?=_('Submit')?>"/><br/><br/>
</form>

</div><!--main-->
</div><!--container-->


</div><!--wrapper-->
<?php include("footer.php")?>
</body>
</html>
