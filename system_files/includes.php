<?php

//Начало сессии
session_start();

//Подключение к бд
include_once SYSTEM_FILES.'database.php';
//Подключение локализаций
include_once SYSTEM_FILES.'locales.php';
//Подключение реестра
include_once SYSTEM_FILES.'registry.php';
//Подключение кеша
include_once SYSTEM_FILES.'data_cacher.php';

if($mod === "site"){
    //Подключаем шаблонизатор сайта
    include_once SYSTEM_FILES."template/tmpl.php";
    //Если страницы нет в кеше и БД, то регаем её в БД
    if(!data_cacher::iscached("main/pages".$URI) && !DataBase::isExists("pages", "url", $URI)){DataBase::insert("pages",array("title"=>"new page","url"=>$URI,"desc"=>"","keys"=>"","ext"=>""));}
    //Поиск и подгрузка расширений
    //1.Глобальные
    //Подгрузка списка глобальных расширений из кеша/БД
    if(data_cacher::iscached("main/ext/global")){
        $gl = unserialize(data_cacher::getcache("main/ext/global"));
    }else{
        $gl = DataBase::getAllOnField("extensions", "global", 1, "id", true);
        data_cacher::cache(serialize($gl),"main/ext/global");
    }
    //Сама подгрузка глобальных расширений
    if(is_array($gl) && count($gl) > 0){
        foreach($gl as $ext){
            include_once SYSTEM_FILES."extensions/id".$ext['id'].".php";
            $class = "id".$ext['id'];
            if(isset($class::$mask)){
                include_once SYSTEM_FILES."masks/".$class::$mask.".php";
            }
            if(method_exists($class, "onLoad")){$class::onLoad();}
        }
    }
    //2.Расширения для страницы
    if(data_cacher::iscached("main/pages/ext".$URI)){
        $lc = unserialize(data_cacher::getcache("main/pages".$URI));
    }else{
        $lc = explode(",", DataBase::getField("pages", "ext", "url",$URI, "id", true));
        data_cacher::cache(serialize($lc),"main/pages".$URI);
    }
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
}elseif($mod === "admin"){
    
    //Подключаем авторизацию для админки
    include_once SYSTEM_FILES."admin/auth.php";
    
    //Подключаем генератор списка страниц
    include_once SYSTEM_FILES."admin/pages.php";
    
    //Подключаем генератор списка расширений
    include_once SYSTEM_FILES."admin/extensions.php";
    
    //Подключаем шаблонизатор админки
    include_once config::$files_root."admin/template/tmpl.php";
    
}
