<?php

/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class locales{
    
    public static function getLocal($ext,$key){
        if($ext == null || $ext == ""){return null;}
        if(is_file(SYSTEM_FILES."locales/".config::$language."/".$ext.".php")){
            include_once SYSTEM_FILES."locales/".config::$language."/".$ext.".php";
            $class = "id".$ext."locals";
            if(class_exists($class) && method_exists($class, "get")){
                return $class::get($key);
            }
        }else{return "id".$ext.".".config::$language.".".$key;}
    }
    
}