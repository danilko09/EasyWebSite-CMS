<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class registry{
    
    public static function getValue($key){
        if(DataBase::isExists("registry", "key", $key)){
            return DataBase::getField("registry", "value", "key", $key);
        }else{
            DataBase::insert("registry", array("key"=>$key,"value"=>null));
            return null;
        }
    }
    
    public static function setValue($key,$value){
        if(DataBase::isExists("registry", "key", $key)){
            DataBase::setField("registry", "value", $value, "key", $key);
        }else{
            DataBase::insert("registry", array("key"=>$key,"value"=>$value));
        }
        return true;
    }
    
}