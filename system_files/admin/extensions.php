<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class extensions{
    
    public static function printList($name){
        
        $ar = self::getListArray();
        $tmpl = tmpl::getTmpl("main", $name);
        if(is_array($ar)){
        foreach($ar as $ext){
            if($ext != null && isset($ext['global'])){
                $ext['title'] = locales::getLocal($ext['id'], "ext.title");
                eval("?>".$tmpl);
            }
        }}
        
    }
    
    public static function getListArray(){
       
        return DataBase::getAll("extensions", "id", true);
        
    }
    
}