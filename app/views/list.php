<h1>ページ一覧</h1>
<ul>
<?php
foreach($pages as $page) :
?>
<li><a href="<?=BASE?><?=$page['id']?>"><?=$page['title']?></a></li>
<?php endforeach; ?>
</ul>
