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

$wiki=new Text_Wiki_Mediawiki();

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

<!---
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['filename']?>" ></a>
-->
<!--a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/docu_txt.png" ></a-->

<?php
$preview = "upload/preview/".$row['id'].".jpg";
if (!is_dir(dirname($preview))) {
    mkdir(dirname($preview),0777,true);
}
if(is_file($preview)) :?>
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?><?=$preview?>"></a>
<?php else :?>
<?php
$files = array_diff( scandir("upload/thumb/".$row['id']), array(".", "..") );
$images = array();
foreach($files as $file){
    if(preg_match("/jpg|jpeg/",$file)){
        array_push($images,"upload/thumb/".$row['id']."/".$file);
    }
}
if (count($images)){
    //$imgBase = new Imagick("images/puree_empty.png");
    $imgBase = new Imagick();
    $imgBase->newImage(200, 200, new ImagickPixel('white'));
    $imgBase->setImageFormat('jpg');
    for ($i=0;$i<2;$i++) {
        for ($j=0;$j<2;$j++) {
            $filename = $images[$i*2+$j];
            //$imgFrame = new Imagick($filename);
            //$imgFrame = new Imagick("upload/thumb/02036/24a4339e-s.jpg");
            if ($filename) {
                $imgFrame = new Imagick($filename);
                //$imgFrame = new Imagick("upload/thumb/02036/24a4339e-s.jpg");
                $imgFrame->resizeImage(94, 94, Imagick::FILTER_POINT, 1); 
                $imgBase->compositeImage($imgFrame, $imgFrame->getImageCompose(), $j*98+4, $i*98+4);
            }
        }
    }
    $imgBase->writeImages($preview,TRUE);

?>
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?><?=$preview?>"></a>
<?php
} else {
?>
<a href="<?=BASE?><?=$row['id']?>"><img class="icon" src="<?=BASE?>images/puree_empty.png" ></a>
<?php
}
?>
<?php endif; ?>

<?php if($session['role'] == "admin" or $row['user_id'] == $session['user_id']): ?>
<!--
<input type="checkbox" name="id[]" value="<?=$row['id']?>">
-->
<?php //if($session['user_id'] and preg_match("/".$session['user_id']."/",$req['id'])){ ?>
<form action="<?=BASE?><?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
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
