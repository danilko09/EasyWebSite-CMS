<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class id1{
    
    public static $mask = "users";
    
    public static function onLoad(){
        users::regExt("toster", "id1", "tost");
    }
    public static function tost(){
        echo "hello";
    }
    
}