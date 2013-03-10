<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Session</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/sessions/index.css"/>
</head>

<body>
<div id="wrapper">
<?php include("header.php")?>
<div id="container">

<div id="main">
<form method="post" action="<?=BASE?>sessions/">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="done" value="<?=$done?>">
<label for="user_id"><?=_('Id')?></label>
<input id="user_id" type="text" name="user_id" value="<?=$req['user_id']?>"/><br/>
<label for="password"><?=_('Password')?></label>
<input id="password" type="password" name="password" /><br/>
<label for="persistent"><?=_('Persistent')?></label>
<input id="persistent" type="checkbox" name="persistent" /><br/>
<label for="submit"></label>
<input id="submit" type="submit" name="submit" value="<?=_('Submit')?>"/><br/>
</form>
</div><!--main-->
</div><!--container-->
</div><!--wrapper-->
<?php include("footer.php")?>
</body>
</html>
