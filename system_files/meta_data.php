<?php

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
        if(data_cacher::iscached("main/pages/keys".$URI)){
            return data_cacher::getcache("main/pages/keys".$URI);
        }else{
            $a = DataBase::getField("pages", "keys", "url", $URI);
            data_cacher::cache($a, "main/pages/keys".$URI);
            return $a;
        }
    }
    
    public static function printDesc(){
        echo self::getDesc();
    }
    
    public static function getDesc(){
        global $URI;
        if(data_cacher::iscached("main/pages/desc".$URI)){
            return data_cacher::getcache("main/pages/desc".$URI);
        }else{
            $a = DataBase::getField("pages", "desc", "url", $URI);
            data_cacher::cache($a, "main/pages/desc".$URI);
            return $a;
        }
    }
    
    public static function printTitle(){
        echo self::getTitle();
    }
    
    public static function getTitle(){
        global $URI;
        if(data_cacher::iscached("main/pages/title".$URI)){
            return data_cacher::getcache("main/pages/title".$URI);
        }else{
            $a = DataBase::getField("pages", "title", "url", $URI);
            data_cacher::cache($a, "main/pages/title".$URI);
            return $a;
        }
    }
}