<?php
DataBase::construct();
class DataBase{
	private static $mysqli;
	/**
         * 
         * Устанавливает соединение с БД
         * 
         */
	public static function construct (){
		self::$mysqli = new mysqli(db_config::$host, db_config::$user, db_config::$pass, db_config::$base);
		self::$mysqli->query("SET NAMES 'UTF-8'");
	}
	
	private static function query($query){return self::$mysqli->query($query);}
	
	private static function select($table_name, $fields, $where = "", $order = "", $up = true, $limit = "" ){
                $data = "";
                for($i = 0; $i < count($fields); $i++){if((strpos($fields[$i], "(") === false) && ($fields[$i] != "*" )){$fields[$i] = "`".$fields[$i]."`";}}
		$fields = implode(",", $fields);$table_name = db_config::$pref.$table_name;
                if(!$order){$order = "ORDER BY `id`";}else{
                    if($order != "RAND()" && !$up){$order = "ORDER BY `$order` DESC";
                    }elseif($order != "RAND()"){$order = "ORDER BY `$order`";
                    }else{$order = "ORDER BY $order";}}
                if($limit){$limit = "LIMIT $limit";}if($where){$query = "SELECT $fields FROM $table_name WHERE $where $order $limit";}else{$query = "SELECT $fields FROM $table_name $order $limit";}$result_set = self::query($query);if(!$result_set){return false;}
		$i = 0;while($row = $result_set->fetch_assoc()){$data[$i] = $row;$i++;}
		$result_set->close();return $data;
	}
	/**
         * 
         * Вставка в таблицу новой строки
         * 
         * @param $table_name string Название таблицы
         * @param $new_values array Массив данных для вставки
         * @return void Не должна что-то возвращать, но может вернуть ошибку.
         * 
         */
	public static function insert($table_name, $new_values){
		$table_name = db_config::$pref.$table_name; $fields = ""; $values = "";
                foreach ($new_values as $field => $value){$fields .= "`".$field."`,";}
		foreach ($new_values as $value){$values .= "'".addslashes($value)."',";}
		$fields = substr($fields, 0, -1);$values = substr($values, 0, -1);
                $query = "INSERT INTO $table_name (".$fields.") VALUES (".$values.")";
		return self::query($query);
	}
	
	private static function update($table_name, $upd_fields, $where){
            $table_name = db_config::$pref.$table_name;$fields = "";

            foreach($upd_fields as $field => $value){$fields .= "`$field` = '".addslashes($value)."',";}
            $query = "UPDATE $table_name SET ".$fields;$query = substr($query, 0, -1);
            if($where){$query .= " WHERE $where";return self::query($query);
            }else{return false;}
	}
	
	private static function delete($table_name, $where = ""){
		$table_name = db_config::$pref.$table_name;
		if($where){$query = "DELETE FROM $table_name WHERE $where";return self::query($query);
		}else{return false;}
	}
	
	public static function deleteAll($table_name){$table_name = db_config::$pref.$table_name;$query = "TRUNCATE TABLE `$table_name`";return self::query($query);}
	
	public static function getField($table_name, $field_out, $field_in, $value_in){
		$data = self::select($table_name, array($field_out), "`$field_in`='".addslashes($value_in)."'");
                if($data == false || count($data) != 1){return false;}
                return $data[0][$field_out];
	}
	
	public static function getFieldOnID($table_name, $id, $field_out){
                if(!self::existsID($table_name, $id)){return false;}
		return self::getField($table_name, $field_out, "id", $id);
		
	}
	
	public static function getAll($table_name, $order, $up){return self::select($table_name, array("*"), "", $order, $up);}
	
	public static function deleteOnID($table_name, $id){if(!self::existsID($table_name, $id)){return false;}return self::delete($table_name, "`id` = '$id'");}
	
	public static function setField($table_name, $field, $value, $field_in, $value_in){return self::update($table_name, array($field => $value), "`$field_in`='".addslashes($value_in)."'");}
	
	public static function setFieldOnID($table_name, $id, $field, $value){	if(!self::existsID($table_name, $id)){return false;}return self::setField($table_name, $field, $value, "id", $id);	}
	
	public static function getElementOnID($table_name, $id){
                if(!self::existsID($table_name, $id)){return false;}$arr = self::select($table_name, array("*"), "`id` = '$id'");return $arr[0];	
	}
	
	public static function getAllOnField($table_name, $field, $value, $order, $up){return self::select($table_name, array("*"), "`$field` = '".addslashes($value)."'", $order, $up);}
	
	public static function getLastID($table_name){$data = self::select($table_name, array("MAX(`id`)"));return $data[0]["MAX(`id`)"];}
	
	public static function getRandomElements($table_name, $count){return self::select($table_name, array("*"), "", "RAND()", true, $count);}
	
	public static function getCount($table_name){$data = self::select($table_name, array("COUNT(`id`)"));return $data[0]["COUNT(`id`)"];}
	
	public static function isExists($table_name, $field, $value){
		$data = self::select($table_name, array("id"), "`$field` = '".addslashes($value)."'");
                if(count($data) == 0 || !is_array($data)){return false;}return true;
	}
	
	private static function existsID($table_name, $id){
                if(!self::validID($id)){return false;}$data = self::select($table_name, array("id"), "`id`='".addslashes($id)."'");
                if(count($data) === 0){return false;}return true;
	}
	
	public static function search($table_name, $words, $fields){
            $words = mb_strtolower(trim(quotemeta($words)));if($words == ""){return false;}$where = ""; $arraywords = explode(" ", $words); $logic = "OR";

            foreach($arraywords as $key => $value){
                if(isset($arraywords[$key - 1])){$where .= $logic;}
                for($i = 0; $i < count($fields); $i++){$where .= "`".$fields[$i]."` LIKE '%".addslashes($value)."%'";if(($i + 1) != count($fields)){$where .= " OR";}}
            }$results = self::select($table_name, array("*"), $where);if(!$results){return false;}$k = 0;$data = array();
            for($i = 0; $i < count($results); $i++){
                    for($j = 0; $j < count($results); $j++){$results[$i][$fields[$j]] = mb_strtolower(strip_tags($results[$i][$fields[$j]]));}
                    $data[$k] = $results[$i];$data[$k]["relevant"] = self::getRelevantForSearch($results[$i], $fields, $words);$k++;
            }return self::OrderResultSearch($data, "relevant");
	}
	
	private static function getRelevantForSearch($result, $fields, $words){
		$relevant = 0;$arraywords = explode(" ", $words);
		for($i = 0; $i < count($fields); $i++){
			for($j = 0; $j < count($arraywords); $j++){
				$relevant += substr_count($result[$fields[$i]], $arraywords[$j]);
		}}return $relevant;
	}
	
	private static function OrderResultSearch($data, $order){
            
            for($i = 0; $i < count($data) - 1; $i++){
                $k = $i;for($j = i + 1; $i < count($data); $i++){if($data[$j][$order] > $data[$k][$order]){$k = $j;}}
                $temp = $data[$k];$data[$k] = $data[$i];$data[$i] = $temp;
            }return $data;
	}
	
	public static function destruct(){if(self::$mysqli){self::$mysqli->close();}}
	
	private static function validID($id){if(!self::isIntNumber($id)){return false;}if($id <= 0){return false;}return true;}
	
	private static function isIntNumber($number){
                if(!is_int($number) && !is_string($number)){return false;}
                if(!preg_match("/^-?(([1-9][0-9]*|0))$/", $number)){return false;}
		return true;
	}
	
}