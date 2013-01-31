<div id="meta">
<div class="account">
<?php
/*
if (!file_exists("upload/accounts/thumb/<?=$row['account_id']?>/icon.jpeg")){
	$image = new Image();
	$image->resize("upload/accounts/thumb/<?=$row['account_id']?>/icon.jpeg","images/pic_noimage110_dgray.jpg",50,50);
}
*/
?>
<?php if ($account_id){?>
<?=_('Uploaded by')?>
<div class="icon">
<a href="<?=BASE?>accounts/<?=$account_id?>"><img src="<?=BASE?>upload/accounts/thumb/<?=$account_id?>/icon.jpeg"></a>
</div>
<div class="account_id">
<a href="<?=BASE?>accounts/<?=$account_id?>"><?=$account_id?></a>
</div>
<?php } ?>

</div><!--account-->
<?php if ($created and $created != "0000-00-00 00:00:00"){?>
<?=_('Created at')?>
<div class="created">
<?=$created?>
</div><!--created-->
<?php } ?>
<?php if ($modified and $modified != "0000-00-00 00:00:00"){?>
<?=_('Modified at')?>
<div class="modified">
<?=$modified?>
</div><!--modified-->
<?php } ?>
<?php if ($tags){?>
<p>
<?=_('Tags')?>:
<?php
foreach (explode(" ",$tags) as $tag){
?>
<a href="<?=BASE?>?tag=<?=$tag?>"><?=$tag?></a>
<?php
}
?>
</p>
<?php
}
?>
<!--
<div id="trends">
<?=_('Trends')?>
</div>
-->
<!--trends-->
</div><!--meta-->
