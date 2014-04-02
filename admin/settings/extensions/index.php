<?php

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

include_once SYSTEM_FILES.'admin/top.php';

if(filter_input_array(INPUT_POST) != null){
    foreach(filter_input_array(INPUT_POST) as $key=>$val){
        if(is_int($key) && $val == "1"){
            if(filter_input(INPUT_POST,"gid".$key) != null){ DataBase::setFieldOnID("extensions", $key, "global", 1); }
            else{ DataBase::setFieldOnID("extensions", $key, "global", 0); }
            if(filter_input(INPUT_POST, "mid".$key) != null){ DataBase::setFieldOnID("extensions", $key, "adm_show", 1); }
            else{ DataBase::setFieldOnID("extensions", $key, "adm_show", 0); }
        }
    }
}

$exts = DataBase::getAll("extensions", "id", true);

?>
<h3>Управление расширениями</h3>
В таблице ниже приведены все установленные на сайте расширения.<br/>
С помощью галочек напротив названий расширений вы можете редактировать их автоматическое подключение на всех страницах и видимость в меню "расширения" соответственно.
<form method="POST">
<table>
    <tr><th>id</th><th>Название</th><th>Глобальное(*)</th><th>В меню расширений(**)</th></tr>
    
    <?php
    foreach($exts as $num=>$ext){
        echo "<tr>";
        echo "<input type='hidden' name='".$ext['id']."' value='1'/>";
        echo "<td>".($num+1)."</td>";
        echo "<td>".locales::getLocal($ext['id'], "ext.title")."</td>";
        if($ext['global'] == 0){echo "<td><input name='gid".$ext['id']."' type='checkbox'/></td>";}
        else{ echo "<td><input name='gid".$ext['id']."' type='checkbox' checked='checked'/></td>";}
        if($ext['adm_show'] == 0){echo "<td><input name='mid".$ext['id']."' type='checkbox'/></td>";}
        else{ echo "<td><input name='mid".$ext['id']."' type='checkbox' checked='checked'/></td>";}
        echo "</tr><br/>";    
    }

    ?>
    
</table>
    <input type='submit' value='Сохранить'/>
</form><br/>
* - Подключен ко всем страницам на сайте<br/>
** - Отображается в списках расширений (блок слева; в меню "расширения")

<?php include_once SYSTEM_FILES."admin/bottom.php";