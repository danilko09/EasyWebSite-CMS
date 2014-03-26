<?php

class tmpl{
        
    public static function getTop(){
        
        $a = explode("{content}",file_get_contents(SYSTEM_FILES."template/tmpl.html"));
        eval("?>".$a[0]);
        
    }
    
    public static function getBottom(){
        
        $a = explode("{content}",file_get_contents(SYSTEM_FILES."template/tmpl.html"));
        eval("?>".$a[1]);
        
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