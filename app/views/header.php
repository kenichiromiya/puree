<div id="header">
<h1 class="logo">
<a href="<?=BASE?>"><img src="<?=LOGO?>"/></a>
</h1>
<div class="menu">
</div>

<div class="navi">
<?php if($session['id']) { ?>
<a href="<?=BASE?>accounts/<?=$session['account_id']?>"><?=$session['account_id']?></a>
<a href="?view=add"><?=_('Add')?></a>
<a href="?view=edit"><?=_('Edit')?></a>
<form action="<?=BASE?>sessions/<?=$session['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Sign Out')?>">
</form>
<?php
} else {
?>
<a href="<?=BASE?>sessions/"><?=_('Sign In')?></a>
<a href="<?=BASE?>accounts/"><?=_('Create an account')?></a>
<?php } ?>
</div><!--navi-->
</div><!--header-->
