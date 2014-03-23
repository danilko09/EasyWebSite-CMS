<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class users{
    
    private static $exts = array();
    
    public static function regExt($func,$rclass,$rfunct){
        
        if(!isset(self::$exts[$func])){
            self::$exts[$func]['class'] = $rclass;
            self::$exts[$func]['funct'] = $rfunct;
            return true;
        }else{return false;}
        
    }
    
    public static function __callStatic($name, $arguments){
        
        if(isset(self::$exts[$name])){
            $class = self::$exts[$name]['class'];
            $funct = self::$exts[$name]['funct'];
            return $class::$funct($arguments);
        }else{return null;}
    }
    
}