<?php

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