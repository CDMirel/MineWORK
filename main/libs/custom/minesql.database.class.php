<?php
if(empty($db)){
	require_once 'minesql.database.php';
}
class database {
	//Creates a new table in your specified database
	function create_table($db, $table_name, array $items){
		$sql = "CREATE TABLE IF NOT EXISTS $table_name(
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),";
		foreach($items as $key => $item){
			$sql .= $key.' '.$item["type"].''.$item['length'].',';
		}
		$sql = rtrim($sql, ",").")";
		$stmt = $db->prepare($sql);
		if($stmt->execute()){
			return true;
		} else {
			//Rethink this method, try to return the sql data (if dev mode is on and return a false value)
			return $sql;
		}
	}


	function insert_table($db, $table_name, array $items){
		$sql = "INSERT INTO $table_name";
		$sql .= " (`".implode("`, `", array_keys($items))."`)";
		$sql .= " VALUES (:".implode(", :", array_keys($items)).") ";
		$stmt = $db->prepare($sql);
		foreach($items as $key => &$item){
			$stmt->bindParam(':'.$key, $item);
		}
		if($stmt->execute()){
			return true;
		} else {
			return false;
		}
	}


	//Function returns all tables in both an array and text version ['text']/['raw']
	function get_columns($db, $table_name){
		$sql = "DESCRIBE $table_name";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
		$return['raw'] = $data;
		$return['text'] = "Your Tables Are: ";
		foreach($data as $str){
			$return['text'] .= "|".$str."|";
		}
		return $return;
	}
}
