<?php

/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

$URIt = explode("/",filter_input(INPUT_SERVER,"PHP_SELF"));
$conf = explode("/",config::$URL_root);
$URI = "";
for($i = 0; $i<count($URIt) ;$i++){
    if($URIt[$i] !== $conf[$i] && $i < (count($conf)-1)){$URI = "index"; echo $i; exit;}
    elseif($i != 0 && $URIt[$i] !== $conf[$i]){$URI .= "/".$URIt[$i];}
}
