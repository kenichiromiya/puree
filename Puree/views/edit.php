<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php echo TITLE; ?> - <?=$title?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/edit.css"/>
<script type="text/javascript" src="<?=BASE?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=BASE?>js/javascript.js"></script>
</head>
<body>

<div id="wrapper">

<?php include("header.php")?>

<div id="container">
<div id="main">
<?php
$_method = "put";
if($session['user_id'] or $session['user_id'] == $row['user_id']){
include("form.php");
} ?>
<!--
<form action="<?=BASE?><?=$id?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
-->
</div><!--main-->
<div id="sub">
<?php include("list.php");?>
</div><!--sub-->
</div><!--container-->
</div><!--wrapper-->

</body>
</html>
