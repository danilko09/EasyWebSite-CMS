<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class data_cacher {
    
    private static $key = "Очень прочный ключ :)";

    public static function cache($data,$tmp_file,$crypt = false){
        if(!file_exists(SYSTEM_FILES."cache/".$tmp_file)){ self::checkfs($tmp_file); }
        if($crypt != false){ $data = self::crypt($data);}
        file_put_contents(SYSTEM_FILES."cache/".$tmp_file, $data);
    }
    
    public static function getcache($tmp_file,$decrypt = false){
        $data = file_get_contents(SYSTEM_FILES."cache/".$tmp_file);
        if($decrypt != false){ $data = self::decrypt($data); }
        return $data;
    }
    
    public static function uncache($tmp_file){
        if(is_file(SYSTEM_FILES."cache/".$tmp_file)){unlink(SYSTEM_FILES."cache/".$tmp_file);}
    }
    
    public static function iscached($tmp_file){
        return file_exists(SYSTEM_FILES."cache/".$tmp_file);
    }
    
    private static function crypt($str){
        $key = self::$key;$i = 0;$out = "";
        for($a = 0;$a < strlen($str); $a++){
            $out .= chr((ord($str[$a]) + ord($key[$i])));
            $i++;
            if($i > (strlen($key)-1)){$i = 0;}
        }
        return $out;
    }
    
    private static function decrypt($str){
        $key = self::$key;$i = 0;$out = "";
        for($a = 0;$a < strlen($str); $a++){
            $out .= chr(ord($str[$a]) - ord($key[$i]));
            $i++;
            if($i > (strlen($key)-1)){$i = 0;}
        }
        return $out;
    }
    
    private static function checkfs($dir){
        $tmp = explode("/", $dir);$f = "";
        for($i = 0; $i < (count($tmp) - 1); $i++){
            $f .= "/".$tmp[$i];
            if(!is_dir(SYSTEM_FILES."cache".$f)){ mkdir(SYSTEM_FILES."cache".$f); }
        }
    }
    
}