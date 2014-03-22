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
            }else{echo "По этому адресу уже существует другая страница!";}
        }elseif(!is_dir(config::$files_root.filter_input(INPUT_POST,"url"))){
            $url_type = 1;//echo "dir";
        }else{
            echo "По этому адресу уже существует другая страница!";
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
                DataBase::insert("pages", array("url"=>"/".filter_input(INPUT_POST,"url"),"title"=>filter_input(INPUT_POST,"title"), "desc"=>strip_tags(filter_input(INPUT_POST,"desc")),"keys"=>filter_input(INPUT_POST,"keys")));
                if($url_type == 0){
                    file_put_contents(config::$files_root.filter_input(INPUT_POST,"url"), file_get_contents(SYSTEM_FILES."loader/site_top.php").filter_input(INPUT_POST, "content").file_get_contents(SYSTEM_FILES."loader/site_bottom.php"));
                }
                echo "Страница успешно сохранена.<br/>";
            }
            
        }
    
    ?>
</font>

<script language="javascript" type="text/javascript"
src="/dev/system_files/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({
            mode : "exact",
            language: "ru",
            selector:'textarea',
            plugins: "advlist,autolink,autoresize,charmap,code",
            autoresize_min_height: "5",
            autoresize_max_height: "50",
            toolbar:"code | undo redo | styleselect | bold italic | alignleft aligncenter alignright | charmap"
            
        });
</script>

<form method="POST">
    <input type="hidden" name="post" value="1"/>
    Название: <input type="text" name="title" value="<?php echo $title_box; ?>"/><br/>    
    Расположение страницы:<br/>
    <?php echo tmpl::getVar("site_root"); ?><input style="width: 300px;" type='text' name='url' value="<?php echo $url_box; ?>"/><br/>
    * Если вы хотите сделать страницу типа "http://site.ru/example" то в это поле пишите "http://site.ru/example/index.php"<br/>Так же, если вы хотите создать папку, в названии которой есть точка, то расположение должно кончаться символом '/'.<br/> 
    Содержимое страницы:<br/>
    <textarea id="elm_content" style="width: 95%; height: 150px;" name="content"><?php echo $content_box; ?></textarea>
    
    Описание страницы:<br/>
    <textarea style="width: 95%; height: 60px;" name="desc"><?php echo $desc_box; ?></textarea>
    Ключевые слова(через запятую):<br/>
    <input style='width: 95%;' type='text' name="keys" value='<?php echo $keys_box; ?>'/>
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