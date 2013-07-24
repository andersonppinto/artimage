<?php
	header('Access-Control-Allow-Origin: *');
	$nome = $_GET["nome"];
	include 'connection_open.php';

	$result = mysql_query("update art_status set lastDate = NOW()");
	if(!$result) {
		die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
	}
	
	echo "<h1>Update realizado com Sucesso</h1>";

	include 'connection_close.php';
	
?>