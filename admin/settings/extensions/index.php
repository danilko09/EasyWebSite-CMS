<?php

error_reporting(E_ALL);

ini_set("display_errors", 1);

if (!defined("SYSTEM_FILES")) {
    define("SYSTEM_FILES", "/home/u209268861/public_html/dev/system_files/");
}
/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

include_once SYSTEM_FILES.'admin/top.php';

$exts = DataBase::getAll("extensions", "id", true);

var_dump(filter_input_array(INPUT_POST));

?>
<h3>Управление расширениями</h3>
В таблице ниже приведены все установленные на сайте расширения.<br/>
<form method="POST">
<table>
    <tr><th>id</th><th>Название</th><th>Глобальное(*)</th><th>В меню расширений(**)</th></tr>
    
    <?php
    foreach($exts as $num=>$ext){
        echo "<tr>";
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