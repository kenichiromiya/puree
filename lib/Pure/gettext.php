<?php
$language = 'en';
if (ereg('ja', $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    #$language = 'ja_JP.UTF-8';
    $language = 'ja_JP.UTF-8';
}
// Set locale and default domain.
putenv("LANG=$language");
setlocale(LC_ALL, $language);
$domain = 'messages';
bindtextdomain($domain, "app/views/locale");
textdomain($domain);
?>
