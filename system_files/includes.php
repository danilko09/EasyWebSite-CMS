<?php

//Расположение системы
if(!defined("SYSTEM_FILES")){define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");}

//Начало сессии
session_start();

//Подключение к бд
include_once SYSTEM_FILES.'database.php';
//Подключение локализаций
include_once SYSTEM_FILES.'locales.php';
//Подключение реестра
include_once SYSTEM_FILES.'registry.php';

if($mod === "site"){
    //Подключаем шаблонизатор сайта
    include_once SYSTEM_FILES."template/tmpl.php";
    //Если страницы нет в БД, то регаем её
    if(!DataBase::isExists("pages", "url", $URI)){DataBase::insert("pages",array("title"=>"new page","url"=>$URI,"desc"=>"","keys"=>"","ext"=>""));}
    //Поиск и подгрузка расширений
    //1.Глобальные
    $gl = DataBase::getAllOnField("extensions", "global", 1, "id", true);
    if(is_array($gl) && count($gl) > 0){
        foreach($gl as $ext){
            include_once SYSTEM_FILES."extensions/".$ext['id'].".php";
            if(isset($ext['id']::$mask)){
                include_once SYSTEM_FILES."masks/".$ext['id']::$mask.".php";
            }
            if(method_exists($ext['id'], "onLoad")){$ext['id']::onLoad();}
        }
    }
    //2.Расширения для страницы
    $lc = explode(",", DataBase::getField("pages", "ext", "url",$URI, "id", true));
    if(is_array($lc)){
        foreach($lc as $ext){
            if(strlen($ext) > 0){
                include_once SYSTEM_FILES."extensions/".$ext.".php";
                if(isset($ext::$mask)){
                    include_once SYSTEM_FILES."masks/".$ext::$mask.".php";
                }
                if(method_exists($ext, "onLoad")){$ext::onLoad();}
            }
        }
    }
    //3.Добавим keywords и description
    include_once SYSTEM_FILES."meta_data.php";
}elseif($mod == "admin"){
    
    //Подключаем авторизацию для админки
    include_once SYSTEM_FILES."admin/auth.php";
    
    //Подключаем генератор списка страниц
    include_once SYSTEM_FILES."admin/pages.php";
    
    //Подключаем генератор списка расширений
    include_once SYSTEM_FILES."admin/extensions.php";
    
    //Подключаем шаблонизатор админки
    include_once config::$files_root."admin/template/tmpl.php";
    
}
