<form action="<?=BASE?><?=$req['id']?>" method="post">
<?php 
if($req['view'] == "add"){
    $method = "post";
}
if($req['view'] == "edit"){
    $method = "put";
}
?>
<input type="hidden" name="_method" value="<?=$method?>">
<input type="hidden" name="type" value="page">
<input type="hidden" name="account_id" value="<?=$session['account_id']?>">
<!--
<label for="type"><?=_('Type')?></label>
<select id="type" name="type">
<option value="image"><?=_('Image')?></option>
<option value="text"><?=_('Text')?></option>
</select><br/>
-->
<!--
<label for="id"><?=_('Id')?></label>
<?=BASE?><input id="id" type="text" name="id" value="<?=$id?>"/><br/>
-->
<label for="title"><?=_('Title')?></label>
<input id="title" type="text" name="title" size="60" value="<?=$form['title']?>"/><br/>
<!--
<label for="view"><?=_('View')?></label>
<select id="view" name="view">
<option value="" <?php if($form['view'] == ''){ echo 'selected';}?>></option>
<option value="large" <?php if($form['view'] == 'large'){ echo 'selected';}?>><?=_('large')?></option>
</select><br/>
<label for="filename"><?=_('Filename')?></label>
<input id="filename" type="text" name="filename" value="<?=$form['filename']?>"/><br/>
-->
<label for="tags"><?=_('Tags')?></label>
<input id="tags" type="text" name="tags" value="<?=$form['tags']?>"/><br/>
<!--
<label for="description"><?=_('Description')?></label>
<textarea id="description" name="description" rows="10" cols="20">
<?=$form['description']?>
</textarea><br/>
-->
<label for="text"><?=_('Text')?></label>
<textarea id="text" name="text" rows="20" cols="100">
<?=$form['text']?>
</textarea><br/>
<label for="submit"><?=_('Submit')?></label>
<input id="submit" type="submit" value="<?=_('Submit')?>"/><br/>

</form>
