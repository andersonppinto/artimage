<?php
header('Access-Control-Allow-Origin: *');

$user = $_POST['txtUser'];
$password = $_POST['txtPassword'];
include 'connection_open.php';

	$result = mysql_query("select * from art_representante where email  = '".$user."' and password = '".$password."';");
	if($row = mysql_fetch_array($result))
	{
		echo "OK";
	} else {
		echo "Usuario ou Senha Invalidos";
		
	}
include 'connection_close.php';
	
?>