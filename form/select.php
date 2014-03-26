<?php
	include "connect.php";
	
	$database = new cbSQLConnect($databaseSetup, cbSQLConnectVar::FETCH_ASSOC);
	// Get my bookmarks
	$datas = $database->QuerySingle("SELECT * FROM bookmarks WHERE estado = '1' ORDER BY orden DESC ");

	$var = '';
	foreach ($datas as $value) {
		$var .= "
		<li class='ui-state-default' id='order-".$value['id']."'>
		<input type='checkbox' class='checkbox' id='cb-".$value['id']."'>
		<a href='".$value['url']."' target='_blank'>".$value['url']."</a>
		<img class='edit-ico' id='img-".$value['id']."' src='img/edit-icon.png'>
		</li>";
	}

	echo $var;
?>