<?php

class pages{
    
    public static function printList($name){
        
        $ar = self::getListArray();
        $tmpl = tmpl::getTmpl("main", $name);
        $i = 0;
        foreach($ar as $page){
            if($page['title'] != null){
                $i++;
            $page['url'] = substr($page['url'], 1);
            eval("?>".$tmpl);
            }
        }
        if($i == 0){
            $page['id'] = null;
            $page['title'] = "<font size='2'>(Нет элементов для отображения)</font>";
            eval("?>".$tmpl);
        }
        
    }
    
    public static function getListArray(){
       
        return DataBase::getAll("pages", "id", true);
        
    }
    
}