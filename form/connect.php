<?php
	include "../classes/cbSQLConnect.class.php";
	date_default_timezone_set("America/Mexico_City");
	
	$databaseSetup = new cbSQLConnectConfig( cbSQLConnectVar::DB_MYSQL, "localhost","3306","mybookmarks","root","arquitectura2"); 

?>