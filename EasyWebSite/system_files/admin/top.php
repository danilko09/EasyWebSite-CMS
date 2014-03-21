<?php

if(!defined("SYSTEM_FILES")){
    define("SYSTEM_FILES","/home/u209268861/public_html/dev/system_files/");
}

//Подгрузка конфига
include_once SYSTEM_FILES.'config.php';

//Подгрузка всяких там DataBase...
$mod = "admin";
include_once SYSTEM_FILES.'includes.php';

//Если авторизирован, то пущай работает, иначе - переход на страницу авторизации админа
if(!admin_auth::isAdmin() && !defined("login_page")){header("Location: ".config::$URL_root."admin/login.php");}

//Отправка верхней части шаблона
tmpl::getTop();

//Возвращаемся к скрипту