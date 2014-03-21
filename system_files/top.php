<?php 
error_reporting(E_ALL);

ini_set("display_errors", 1);

if(!defined("SYSTEM_FILES")){
    define("SYSTEM_FILES","/home/u209268861/public_html/dev/system_files/");
}

//Подгрузка конфига
include_once SYSTEM_FILES.'config.php';

//Определение URI страницы
include_once SYSTEM_FILES.'URIDetect.php';

//Подгрузка необходимых расширений
$mod = "site";
include_once SYSTEM_FILES."includes.php";

//Подстановка верхней части шаблона
include_once SYSTEM_FILES."template/top.html";
