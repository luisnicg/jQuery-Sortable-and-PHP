<?php
	include "connect.php";
	
	$database = new cbSQLConnect($databaseSetup, cbSQLConnectVar::FETCH_ASSOC);

	$data = $_POST["choices"];

	$newarray = explode("&", $data[0]);

	$i = count($newarray);
	foreach ($newarray as $key => $value) {
		$ides = explode("=", $value);
		$database->SQLUpdate("bookmarks", "orden", $i, "id",(int)$ides[1]);
		$i--;
	}

	//print_r($data[0]);
?>