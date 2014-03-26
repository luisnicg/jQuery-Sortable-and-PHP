<?php
	include "connect.php";
	
	$database = new cbSQLConnect($databaseSetup, cbSQLConnectVar::FETCH_ASSOC);

	$date = date('Y-m-d H:i:s');

	$id = str_replace('img-', '', $_POST["id"]);
	$url = $_POST["url"];

	if(!empty($id)){
		$database->SQLUpdate("bookmarks", "url", $url, "id",$id);
	}else{
		// Count rows for order
		$count = $database->QuerySingle("SELECT count(*) AS total FROM bookmarks");

		$insert = $database->SQLInsert(array( 
			array( 
				'id' => null,
				'url' => $url, 
				'fecha' => $date,
				'orden' => (int)$count[0]['total'] + 1,
				'estado' =>'1')
			), "bookmarks"); // return true if sucess or false
		echo $insert;
	}
?>