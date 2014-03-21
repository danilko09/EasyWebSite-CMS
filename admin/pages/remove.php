<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

include_once SYSTEM_FILES."admin/top.php";?>
<h3>Удаление страницы</h3>
Вы действительно хотите удалить страницу "<?php echo DataBase::getField("pages", "title", "id", filter_input(INPUT_GET,"id")); ?>" ?<br/>
<center>
    <form>

        <input style="width: 100px;" type="submit" name="yes" value="Да"/> <input style="width: 100px;" type="submit" name="no" value="Нет"/>
        <input type="hidden" name="id" value="<?php echo filter_input(INPUT_GET, "id") ?>">
        
    </form>
</center>
<?php include_once SYSTEM_FILES."admin/bottom.php";