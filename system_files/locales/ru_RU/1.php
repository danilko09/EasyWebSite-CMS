<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class id1locals{
    
    private static $locals = array(
        "ext.title" => "Пример расширения"
    );
    
    public static function get($key){
        if(isset(self::$locals[$key])){
            return self::$locals[$key];
        }else{
            return "bad_local id1.".config::$language.$key;
        }
    }
    
}