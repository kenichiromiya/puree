<h2><?=_('Login')?></h2>
<form method="post" action="sessions/">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="done" value="<?=$done?>">
<label for="id"><?=_('Id')?></label>
<input id="id" type="text" name="id" /><br/>
<label for="password"><?=_('Password')?></label>
<input id="password" type="password" name="password" /><br/>
<label for="persistent"><?=_('Persistent')?></label>
<input id="persistent" type="checkbox" name="persistent" /><br/>
<label for="submit"><?=_('Submit')?></label>
<input id="submit" type="submit" name="submit" value="<?=_('Submit')?>"/><br/>
</form>
