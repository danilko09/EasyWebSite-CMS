<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}

class pages{
    
    public static function printList($name){
        
        $ar = self::getListArray();
        $tmpl = tmpl::getTmpl("main", $name);
        foreach($ar as $page){
            $page['url'] = substr($page['url'], 1);
            eval("?>".$tmpl);
        }
        
    }
    
    public static function getListArray(){
       
        return DataBase::getAll("pages", "id", true);
        
    }
    
}