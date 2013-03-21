#!/bin/sh
xgettext --output messages.pot `find $PWD -name \*.php -type f`
msgmerge views/locale/en/LC_MESSAGES/messages.po messages.pot --output views/locale/en/LC_MESSAGES/messages.po
msgmerge views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.po messages.pot --output views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.po
msgfmt --output views/locale/en/LC_MESSAGES/messages.mo views/locale/en/LC_MESSAGES/messages.po
msgfmt --output views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.mo views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.po
