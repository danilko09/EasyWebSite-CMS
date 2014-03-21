<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}

class tmpl{
        
    public static function getTop(){
        
        return file_get_contents("top.html");
        
    }
    
    public static function getBottom(){
        
        return file_get_contents("bottom.html");
        
    }
    
    public static function getTmpl($ext_id,$file){
        
        $ctmpl_root = SYSTEM_FILES."template/custom/";
        
        if($ext_id != "main" && file_exists($ctmpl_root."id".$ext_id."/".$file)){
            return file_get_contents($ctmpl_root."id".$ext_id."/".$file);
        }elseif(file_exists($ctmpl_root.$ext_id."/".$file)){
            return file_get_contents($ctmpl_root.$ext_id."/".$file);
        }
        
    }
    
}