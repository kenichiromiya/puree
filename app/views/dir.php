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
$files = array_diff( scandir("upload/".$row['id']), array(".", "..") );
$images = array();
foreach($files as $file){
    if(preg_match("/jpg|jpeg/",$file)){
        array_push($images,"upload/".$row['id']."/".$file);
    }
}
if (count($images)){

    $filename = $images[0];
    $im = new Imagick();
    $im->readImage($filename);
    $im->cropThumbnailImage(200, 200);
    if (!is_dir(dirname($preview))) {
        mkdir(dirname($preview),0777,true);
    }
    $im->writeImage($preview);
    $im->destroy();

/*
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
*/
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
