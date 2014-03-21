<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class admin_auth{
    
    public static function isAdmin(){
        if(isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] == 1){
            return true;
        }
        return false;
    }
    
    public static function doAdmin($pass){
        if($pass == registry::getValue("main.admin_pass")){
            $_SESSION['admin_auth'] = 1;
            return true;
        }else{
            return false;
        }
    }
    
    public static function logout(){
        $_SESSION['admin_auth'] = 0;
    }
    
}