<?php

/**
 * Helper & service 
 * functions.
 */

foreach (glob(ROOTPATH."/vendor/rik-janssen/formality/src/functions/*.php") as $filename){ require_once $filename; }
foreach (glob(ROOTPATH."/vendor/rik-janssen/formality/src/functions/forms/*.php") as $filename){ require_once $filename; }
foreach (glob(ROOTPATH."/vendor/rik-janssen/formality/src/functions/columns/*.php") as $filename){ require_once $filename; }

