<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/users.css"/>
</head>
<body>

<div id="wrapper">

<?php include("header.php")?>
<div id="container">
<div id="main">
<?=_('User confirmation')?>
<form action="<?=BASE?>users/?view=complete" method="post">
<input type="hidden" name="_method" value="put">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="code" value="<?=$code?>">
<!--<label for="submit"><?=_('User confirmation')?></label>-->
<input id="submit" type="submit" value="<?=_('Submit')?>"/>
</form>

</div><!--main-->
</div><!--container-->

</div><!--wrapper-->
<?php include("footer.php")?>

</body>
</html>
