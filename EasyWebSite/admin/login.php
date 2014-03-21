<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

define("login_page",0);//Чтоб top.php не перекидывал снова сюда
ob_start();
include_once SYSTEM_FILES.'admin/top.php';

//Проверка необходимости сброса авторизации
if(filter_input(INPUT_GET,"logout") == "1"){admin_auth::logout();}
//Проверка на авторизацию
if(admin_auth::isAdmin()){ob_clean();header("Location: ".config::$URL_root."admin");}

?>
<h3>Вход в административную панель</h3>
<?php
$pass = filter_input(INPUT_POST,"password");
if($pass != null){if(admin_auth::doAdmin($pass)){ob_clean();header("Location: ".config::$URL_root."admin");}
else{echo "<font color='red'>Неправильный пароль!</font>";}}
?>
<form method='POST'>
    
    Сайт: <input style='width: 220px;' disabled type='text' value='<?php echo "http://".filter_input(INPUT_ENV,"HTTP_HOST").config::$URL_root; ?>'/><br/>
    Пароль: <input style='width: 220px;' type='password' name='password' /><br/>
    <input type='submit' value='Войти'/>
    
</form>

<?php include_once SYSTEM_FILES.'admin/bottom.php'; ob_flush();