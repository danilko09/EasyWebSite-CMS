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
<?php 

    if(filter_input(INPUT_POST, "post") === "1"){
        
        //Очистка кеша
        $tmp_url = DataBase::getFieldOnID("pages", filter_input(INPUT_GET, 'id'), "url");//определяется старый url страницы
        data_cacher::uncache("main/pages/ext".$tmp_url);//расширения
        data_cacher::uncache("main/pages/keys".$tmp_url);//ключевые слова
        data_cacher::uncache("main/pages/desc".$tmp_url);//описание
        data_cacher::uncache("main/pages/title".$tmp_url);//заголовок
        
        //Анализ полученных на входе данных
        echo "Некоторые данные на этой странице ещё не обновились, обновите или перейдите на другую страницу.<br/>";
        echo "<a style='color: blue;' href='".config::$URL_root.filter_input(INPUT_POST,"url")."'>Перейти на страницу.</a><br/>";
        if(filter_input(INPUT_POST, "title") == null){
            echo "<font color='red'>Введите название страницы!</font><br/>";
        }elseif(DataBase::getField("pages", "title", "id", filter_input(INPUT_GET, "id")) != filter_input(INPUT_POST,"title")){
            DataBase::setFieldOnID("pages", filter_input(INPUT_GET,"id"), "title", htmlspecialchars(filter_input(INPUT_POST,"title")));
            echo "<font color='green'>Название страницы успешно сохранено!</font><br/>";
        }
        
        if(filter_input(INPUT_POST,"url") == null){
            echo "<font color='red'>Введите расположение страницы!</font><br/>";
        }elseif(DataBase::getFieldOnID("pages", filter_input(INPUT_GET, "id"), "url") != "/".filter_input(INPUT_POST,"url")){
            echo "<font color='red'>Страница не была перемещена, т.к. это пробная версия движка!</font><br/>";
        }
        
        if(filter_input(INPUT_POST,"content") == null){
            echo "<font color='red'>Содержимое страницы не может быть пустым!</font><br/>";
        }else{
            file_put_contents(config::$files_root.filter_input(INPUT_POST,"url"), file_get_contents(SYSTEM_FILES."loader/site_top.php").filter_input(INPUT_POST, "content").file_get_contents(SYSTEM_FILES."loader/site_bottom.php"));
            echo "<font color='green'>Содержимое страницы обновлено!</font><br/>";
        }
          
        if(DataBase::getField("pages", "desc", "id", filter_input(INPUT_GET, "id")) != strip_tags(filter_input(INPUT_POST,"desc"))){
            DataBase::setFieldOnID("pages", filter_input(INPUT_GET,"id"), "desc", strip_tags(filter_input(INPUT_POST,"desc")));
            echo "<font color='green'>Описание страницы успешно сохранено!</font><br/>";
        }
        
        if(DataBase::getField("pages", "keys", "id", filter_input(INPUT_GET, "id")) != filter_input(INPUT_POST,"keys")){
            DataBase::setFieldOnID("pages", filter_input(INPUT_GET,"id"), "keys", filter_input(INPUT_POST,"keys"));
            echo "<font color='green'>Ключевые слова страницы успешно сохранены!</font><br/>";
        }
        
    }

?>
<script language="javascript" type="text/javascript"
src="/dev/system_files/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({
            mode : "exact",
            language: "ru",
            selector:'textarea',
            plugins: "advlist,autolink,charmap,code",
            toolbar:"code | undo redo | styleselect | bold italic | alignleft aligncenter alignright | charmap"
            
        });
</script>

<form method="POST">
    <input type='hidden' name='post' value="1"/>
    Название: <input type="text" name="title" value="<?php echo DataBase::getField("pages", "title", "id", filter_input(INPUT_GET, "id")); ?>"/><br/>    
    <!--Расположение страницы:<br/>
    <?php echo tmpl::getVar("site_root"); ?>--><input style="width: 300px;" type='hidden' name='url' value="<?php echo substr(DataBase::getFieldOnID("pages", filter_input(INPUT_GET, "id"), "url"),1); ?>" /><br/>
    <!--* Если вы хотите сделать страницу типа "http://site.ru/example" то в это поле пишите "http://site.ru/example/index.php".<br/> -->
    Содержимое страницы:<br/>
    <textarea style="width: 95%; height: 200px;" name="content">
        <?php echo str_replace(file_get_contents(SYSTEM_FILES."loader/site_bottom.php"),"",str_replace(file_get_contents(SYSTEM_FILES."loader/site_top.php"),"",file_get_contents(config::$files_root.substr(DataBase::getFieldOnID("pages", filter_input(INPUT_GET,"id"), "url"),1)))); ?>
    </textarea>
    
    Описание страницы:<br/>
    <textarea style="width: 95%; height: 40px;" name="desc">
        <?php echo DataBase::getFieldOnID("pages", filter_input(INPUT_GET,"id"), "desc"); ?>
    </textarea>
    Ключевые слова(через запятую):
    <input type='text' style="width: 95%;" name="keys" value='<?php echo DataBase::getFieldOnID("pages", filter_input(INPUT_GET,"id"), "keys"); ?>' />
    <input style="width: 95%;" type="submit" value="Сохранить"/>
</form>


<div>
    <a onclick="document.getElementById('developer-desc').style.display = 'block';">Примечание от разработчика</a>
    <p id="developer-desc">
        В данный момент создание страниц очень сильно урезано.<br/>
        Позже будет удобный выбор подключаемых к странице расширений.
    </p>
    <script>document.getElementById('developer-desc').style.display = "none";</script>
    
</div>

<?php include_once SYSTEM_FILES."admin/bottom.php";