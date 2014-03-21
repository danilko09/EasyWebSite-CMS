<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

include_once SYSTEM_FILES.'admin/top.php'; ?>
<h3>Создание страницы</h3><br/>
<font color="red">
<?php
if(filter_input(INPUT_POST, "post") === "1"){
       
    $title_box = filter_input(INPUT_POST,"title");
    $url_box = filter_input(INPUT_POST,"url");
    $content_box = filter_input(INPUT_POST,"content");
    $keys_box = filter_input(INPUT_POST,"keys");
    $desc_box = filter_input(INPUT_POST,"desc");
    
    if(filter_input(INPUT_POST,"title") == null){
        echo "Укажите название страницы!<br/>";
    }
    
    if(filter_input(INPUT_POST,"url") == null){
        echo "Укажите расположение страницы!<br/>";
    }else{
        $var = explode("/",filter_input(INPUT_POST,"url"));
        $var2 = explode(".",$var[(count($var)-1)]);
        if(count($var2) > 1 && $var2[(count($var2) - 1)] != null){
            if(!file_exists(config::$files_root.filter_input(INPUT_POST,"url"))){
                $url_type = 0;//echo "file";
            }else{echo "По этому адресу уже есть файл!";}
        }elseif(!is_dir(config::$files_root.filter_input(INPUT_POST,"url"))){
            $url_type = 1;//echo "dir";
        }else{
            echo "По этому адресу уже существует папка!";
        }
    }
    
    if(filter_input(INPUT_POST,"content") == null){
        echo "Напишите содержание страницы!<br/>";
    }
    
}

?>
</font>

<font color="green">
    <?php
    
        if(filter_input(INPUT_POST, "post") === "1"){
            
            if(filter_input(INPUT_POST,"title") != null && isset($url_type) && filter_input(INPUT_POST,"content") != null){
                echo "Страница успешно сохранена.<br/>(Страница не будет записана, т.к. это демо-версия движка.)";
            }
            
        }
    
    ?>
</font>

<form method="POST">
    <input type="hidden" name="post" value="1"/>
    Название: <input type="text" name="title" value="<?php echo $title_box; ?>"/><br/>    
    Расположение страницы:<br/>
    <?php echo tmpl::getVar("site_root"); ?><input style="width: 300px;" type='text' name='url' value="<?php echo $url_box; ?>"/><br/>
    * Если вы хотите сделать страницу типа "http://site.ru/example" то в это поле пишите "http://site.ru/example/index.php"<br/>Так же, если вы хотите создать папку, в названии которой есть точка, то расположение должно кончаться символом '/'.<br/> 
    Содержимое страницы (HTML-код):<br/>
    <textarea style="width: 95%; height: 150px;" name="content"><?php echo $content_box; ?></textarea>
    
    Описание страницы:<br/>
    <textarea style="width: 95%; height: 60px;" name="desc"><?php echo $desc_box; ?></textarea>
    Ключевые слова(через запятую):
    <textarea style="width: 95%; height: 30px;" name="keys"><?php echo $keys_box; ?></textarea>
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