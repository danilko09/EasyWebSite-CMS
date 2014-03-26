<?php

/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class id1locals{
    
    private static $locals = array(
        "ext.title" => "Посетители на сайте",
        "ext.description" => "Считает и выводит количество посетителей на сайте."
    );
    
    public static function get($key){
        if(isset(self::$locals[$key])){
            return self::$locals[$key];
        }else{
            return "bad_local id1.".config::$language.$key;
        }
    }
    
}