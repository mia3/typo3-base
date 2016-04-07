<?php

if (!isset($_REQUEST['token'])) {
    exit();
}

$config = json_decode(file_get_contents('.deploy'), TRUE);

if ($_REQUEST['token'] !== $config['secret']) {
    die('fuck off');
}

system('git fetch origin 2>&1') . chr(10);
echo chr(10) . chr(10);

system('git reset --hard origin/' . $config['branch']) . chr(10);
echo chr(10) . chr(10);

system('composer install 2>&1 1>&1') . chr(10);
echo chr(10) . chr(10);

system('./typo3cms database:updateschema "*.add, *.change" 2>&1');
echo chr(10) . chr(10);

echo 'done' . chr(10);
