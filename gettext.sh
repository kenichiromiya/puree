#!/bin/sh
xgettext --output messages.pot `find $PWD -name \*.php -type f`
msgmerge app/views/locale/en/LC_MESSAGES/messages.po messages.pot --output app/views/locale/en/LC_MESSAGES/messages.po
msgmerge app/views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.po messages.pot --output app/views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.po
msgfmt --output app/views/locale/en/LC_MESSAGES/messages.mo app/views/locale/en/LC_MESSAGES/messages.po
msgfmt --output app/views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.mo app/views/locale/ja_JP.UTF-8/LC_MESSAGES/messages.po
