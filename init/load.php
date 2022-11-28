<?php


foreach (glob(ROOTPATH."/vendor/vesperphp/frontal/functions/*.php") as $filename){ require_once $filename; }
foreach (glob(ROOTPATH."/vendor/vesperphp/frontal/functions/forms/*.php") as $filename){ require_once $filename; }
foreach (glob(ROOTPATH."/vendor/vesperphp/frontal/functions/columns/*.php") as $filename){ require_once $filename; }

require_once ROOTPATH.'/vendor/vesperphp/frontal/init/routes.php';
require_once ROOTPATH.'/vendor/vesperphp/frontal/init/hooks.php';