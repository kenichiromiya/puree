<?php
include_once "app/functions/markdown.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?php echo TITLE; ?> - <?=$title?></title>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?=BASE?>css/detail.css"/>
<script type="text/javascript" src="<?=BASE?>js/jquery-1.7.1.min.js"></script>
<!--
<script type="text/javascript" src="<?=BASE?>js/jquery.masonry.min.js""></script>
<script type="text/javascript" src="<?=BASE?>js/jquery.bottom-1.0.js"></script>
-->
<script type="text/javascript" src="<?=BASE?>js/javascript.js"></script>
</head>
<body>

<div id="wrapper">

<?php include("header.php")?>

<div id="container">
<div id="main">
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

</div><!--main-->
<div id="sub">
<?php include("meta.php")?>
</div><!--sub-->

</div><!--container-->
</div><!--wrapper-->

<?php include("footer.php")?>
</body>
</html>
