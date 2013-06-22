<form id="editor" action="<?=BASE?><?=$req['id']?>" method="post">
<?php 
if($_method == "put"){
    $value['title'] = $row['title'];
//    $value['tags'] = $row['tags'];
    $value['text'] = $row['text'];
}
?>
<input type="hidden" name="_method" value="<?=$_method?>">
<input type="hidden" name="type" value="page">
<input type="hidden" name="user_id" value="<?=$session['user_id']?>">
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
<input id="title" type="text" name="title" size="60" value="<?=$value['title']?>"/><br/>
<!--
<label for="view"><?=_('View')?></label>
<select id="view" name="view">
<option value="" <?php if($form['view'] == ''){ echo 'selected';}?>></option>
<option value="large" <?php if($form['view'] == 'large'){ echo 'selected';}?>><?=_('large')?></option>
</select><br/>
<label for="filename"><?=_('Filename')?></label>
<input id="filename" type="text" name="filename" value="<?=$form['filename']?>"/><br/>
-->
<!--
<label for="tags"><?=_('Tags')?></label>
<input id="tags" type="text" name="tags" value="<?=$values['tags']?>"/><br/>
-->
<!--
<label for="description"><?=_('Description')?></label>
<textarea id="description" name="description" rows="10" cols="20">
<?=$description?>
</textarea><br/>
-->
<label for="text"><?=_('Text')?></label>
<div id="edit" contenteditable="true" style="overflow:auto; word-wrap:break-word;"><?=$value['text']?></div><br>
<textarea id="text" name="text" rows="20" cols="100" style="display:none">
<?=$value['text']?>
</textarea><br/>
<button type="button" id="save" >保存</button><br>
<!--label for="submit"><?=_('Submit')?></label-->
<!--input id="submit" type="submit" value="<?=_('Submit')?>"/><br/-->

</form>
