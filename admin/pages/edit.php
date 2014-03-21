<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

include_once SYSTEM_FILES.'admin/top.php'; ?>
<h3>Редактирование страницы</h3><br/>
<form>
    Название: <input type="text" name="title" value="<?php echo DataBase::getField("pages", "title", "id", filter_input(INPUT_GET, "id")); ?>"/><br/>    
    Расположение страницы:<br/>
    <?php echo tmpl::getVar("site_root"); ?><input style="width: 300px;" type='text' name='url' value="<?php echo substr(DataBase::getFieldOnID("pages", filter_input(INPUT_GET, "id"), "url"),1); ?>" /><br/>
    * Если вы хотите сделать страницу типа "http://site.ru/example" то в это поле пишите "http://site.ru/example/index.php".<br/> 
    Содержимое страницы (HTML-код):<br/>
    <textarea style="width: 95%; height: 150px;" name="content">
        <?php echo str_replace(file_get_contents(SYSTEM_FILES."loader/site_bottom.php"),"",str_replace(file_get_contents(SYSTEM_FILES."loader/site_top.php"),"",file_get_contents(config::$files_root.substr(DataBase::getFieldOnID("pages", filter_input(INPUT_GET,"id"), "url"),1)))); ?>
    </textarea>
    
    Описание страницы:<br/>
    <textarea style="width: 95%; height: 60px;" name="desc">
        <?php echo DataBase::getFieldOnID("pages", filter_input(INPUT_GET,"id"), "desc"); ?>
    </textarea>
    Ключевые слова(через запятую):
    <textarea style="width: 95%; height: 30px;" name="keys">
        <?php echo DataBase::getFieldOnID("pages", filter_input(INPUT_GET,"id"), "keys"); ?></textarea>
    <input style="width: 95%;" type="submit" value="Сохранить"/>
</form>


<div>
    <a onclick="document.getElementById('developer-desc').style.display = 'block';">Примечание от разработчика</a>
    <p id="developer-desc">
        В данный момент создание страниц очень сильно урезано.<br/>
        Позже будет удобный редактор текста(типа TinyMCE),а так же удобный выбор подключаемых к странице расширений.
    </p>
    <script>document.getElementById('developer-desc').style.display = "none";</script>
    
</div>

<?php include_once SYSTEM_FILES."admin/bottom.php";