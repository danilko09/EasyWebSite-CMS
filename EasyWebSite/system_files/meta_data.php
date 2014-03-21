<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class meta_data{
    
    public static function printKeys(){
        echo self::getKeys();
    }
    
    public static function getKeys(){
        global $URI;
        return DataBase::getField("pages", "keys", "url", $URI);
    }
    
    public static function printDesc(){
        echo self::getDesc();
    }
    
    public static function getDesc(){
        global $URI;
        return DataBase::getField("pages", "desc", "url", $URI);
    }
    
    public static function printTitle(){
        echo self::getTitle();
    }
    
    public static function getTitle(){
        global $URI;
        return DataBase::getField("pages", "title", "url", $URI);
    }
}