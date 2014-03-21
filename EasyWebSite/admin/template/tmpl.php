<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
class tmpl{
      
    private static $vars = array(
        "site_root" => "http://msc-testing.zz.mu/dev/",
        "box_color" => "#88CCAA"
    );
    
    public static function getVar($name){
        
        return self::$vars[$name];
        
    }
    
    public static function random(){
        $array = array("http://www.sunhome.ru/UsersGallery/wallpapers/79/20110425.jpg",
                "http://upload.wikimedia.org/wikipedia/ru/c/c3/%D0%9F%D1%80%D0%B8%D1%80%D0%BE%D0%B4%D0%B0_%D0%B2%D0%BE%D0%BA%D1%80%D1%83%D0%B3_%D0%A1%D0%B0%D1%82%D0%BA%D0%B8_-_%D0%BB%D0%B5%D1%81%D0%BD%D0%B0%D1%8F_%D0%B4%D0%BE%D1%80%D0%BE%D0%B3%D0%B0.jpeg",
                "http://besplatnosms.ucoz.com/fon_meniaetsia/nastol.com.ua_32804.jpg",
                "http://www.sunhome.ru/UsersGallery/wallpapers/79/28121519.jpg",
                "http://kapuchel.net/uploads/posts/2013-10/1381844147_187186_priroda_oboi_derevya_park_les_trava_fotografii_kra_1920x1200_www.gdefon.ru.jpg"
                );
        if(!isset($_SESSION['tmpl_tmp_img'])){$_SESSION['tmpl_tmp_img'] = $array[(rand(1, count($array))-1)];}
        echo $_SESSION['tmpl_tmp_img'];
        
    }
    
    public static function getTop(){
                
        $a = explode("{content}",file_get_contents(config::$files_root."admin/template/tmpl.html"));
        eval("?>".$a[0]);
        
    }
    
    public static function getBottom(){
                
        $a = explode("{content}",file_get_contents(config::$files_root."admin/template/tmpl.html"));
        eval("?>".$a[1]);
        
    }
    
    public static function getTmpl($ext_id,$file){
        
        $ctmpl_root = config::$files_root."admin/template/custom/";
        
        if($ext_id != "main" && file_exists($ctmpl_root."id".$ext_id."/".$file)){
            return file_get_contents($ctmpl_root."id".$ext_id."/".$file);
        }elseif(file_exists($ctmpl_root.$ext_id."/".$file)){
            return file_get_contents($ctmpl_root.$ext_id."/".$file);
        }
        
    }
    
}