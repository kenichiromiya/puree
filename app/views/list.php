<?php
foreach($image['rows'] as $row) :
?>
<div class="item">
<div class="thumb">
<?php if($row['title']){ ?>
<p><?=$row['title']?></p>
<?php } ?>
<?php
if (!file_exists("upload/thumb/".$row['filename'])){
	$image = new Image();
	$image->imageresize("upload/thumb/".$row['filename'],"upload/".$row['filename'],200);
}
?>
<a href="<?=BASE?><?=$row['id']?>"><img src="<?=BASE?>upload/thumb/<?=$row['filename']?>"></a>
</div>
<?php if($session['account_id'] == $row['account_id']): ?>
<?php //if($session['account_id'] and preg_match("/".$session['account_id']."/",$req['id'])){ ?>
<form action="<?=BASE?><?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
<?php endif; ?>
</div>
<?php endforeach; ?>
