<?php
$pagination = new Pagination();
$pagination = $pagination->getpagination(array("page"=>$req['page'],"per_page"=>PER_PAGE,"total"=>$count));
echo "<div id=\"pagination\">";
if($pagination['prev_page']){
    echo "<span id=\"prev\"><a href=\"$path?page={$pagination['prev_page']}\">&lt; "._('Prev Page')."</a></span>&nbsp;";
} else {
    echo "<span id =\"prev\">&lt; "._('Prev Page')."</span>&nbsp;";
}
foreach ($pagination['pages'] as $value) {
    if ($value != $pagination['page']){
        echo "<span class=\"page\"><a href=\"$path?page=$value\">$value</a></span>&nbsp;";
    } else {
        echo "<span class=\"page\">$value</span>&nbsp;";
    }
}

if($pagination['next_page']){
    echo "<span id=\"next\"><a href=\"$path?page={$pagination['next_page']}\">"._('Next Page')." &gt;</a></span>&nbsp;";
} else {
    echo "<span id =\"next\">"._('Next Page')." &gt;</span>&nbsp;";
}
echo "</div>";

?>
