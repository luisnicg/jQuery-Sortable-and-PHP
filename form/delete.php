<?php
	include "connect.php";
	
	$database = new cbSQLConnect($databaseSetup, cbSQLConnectVar::FETCH_ASSOC);

	$data = $_POST["choices"];

	foreach ($data as $value) {
		$newid = str_replace('cb-','',$value);
		$database->SQLUpdate("bookmarks", "estado", "0", "id",(int)$newid);
	}

	echo $var;
?>