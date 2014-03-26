<?php

/* 
 * EasyWebSite Engine
 * Лицензии как таковой пока нет, поэтому можно использовать на свое усмотрение.
 */

class id1{
    
    public static $mask = "users";
    
    public static function onLoad(){
        if(!isset($_SESSION['onlineCounter']) || $_SESSION['onlineCounter'] != true){
            $_SESSION['onlineCounter'] = true;
            DataBase::insert("sessions",array("sessionid" =>  session_id(),"date"=>date("ymdHi")));
        }else{
            DataBase::setField("sessions", "date", date("ymdHi"), "sessionid", session_id());
        }
        users::regExt("onlineCount", "id1", "count");
        users::regExt("onlineCount_record", "id1", "recordCount");
        users::regExt("onlineCount_record_date", "id1", "recordDate");
    }
    public static function count(){
        $s = DataBase::getAll("sessions", "id", true);
        $ses = array();
        foreach($s as $user){
            if(!isset($ses[$user['sessionid']]) && $user['date'] > (date("ymdHi") - 5)){
                $ses[$user['sessionid']] = $user['id'];
            }else{
                DataBase::deleteOnID("sessions", $user['id']);
            }
        }
        if(count($ses) > registry::getValue("id1.record")){
            registry::setValue("id1.record", count($ses));
            registry::setValue("id1.recordDate", date("j m Y"));
        }
        echo count($ses);
    }
    
    public static function recordCount(){
        echo registry::getValue("id1.record");
    }
    
    public static function recordDate(){
        echo registry::getValue("id1.recordDate");
    }
    
}