<?php if($session['role'] == "admin" or $row['user_id'] == $session['user_id']): ?>
<div class="operation">
<form class="ope" action="<?=BASE?>" method="get">
<input type="hidden" name="view" value="add">
<input type="submit" value="<?=_('Add')?>">
</form>
<form class="ope" action="<?=BASE?><?=$row['id']?>" method="get">
<input type="hidden" name="view" value="edit">
<input type="submit" value="<?=_('Edit')?>">
</form>
<form class="ope" action="<?=BASE?><?=$row['id']?>" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=_('Delete')?>">
</form>
</div>
<?php endif; ?>
