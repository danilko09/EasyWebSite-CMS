<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}

include_once SYSTEM_FILES.'top.php';

?>
    
Тест генератора страниц

<?php include_once SYSTEM_FILES.'bottom.php';