<?php

header('Access-Control-Allow-Origin: *');
$type = $_POST["type"];
$nome = $_POST["txtNome"];

if($type != 'D') {
	$contato = $_POST["txtContato"];
	$email = $_POST["txtEmail"];
	$telefone = $_POST["txtTelefone"];
	$razao = $_POST["txtRazao"];
}
include 'connection_open.php';

switch($type)
{
	case 'I';

			$strSql = "Insert into art_transportadora "
					  ."( nome"
					  .", razaosocial"
					  .", contato"
					  .", email"
					  .", telefone) "
					  ." VALUES "
					  ."('".$nome."'"
					  .",'".$razao."'"
					  .",'".$contato."'"
					  .",'".$email."'"
					  .",'".$telefone."')";

					  
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
							}
		break;
	case 'U';

			$strSql = "UPDATE art_transportadora SET "
						."razaosocial= '".$razao."'"
						.", nome = '".$nome."'"
						.", contato = '".$contato."'"
						.", email = '".$email."'"
						.", telefone = '".$telefone."'"
			." WHERE nome = '".$nome."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	case 'D';
			
			$strSql = "Delete from art_transportadora  WHERE nome = '".$nome."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	default;
		echo "Tipo Invalido => ".$type."<br>";
}

$strSql = "Update art_status set lastDate = NOW() Where name = 'Transportadora'";
$result = mysql_query($strSql);

include 'connection_close.php';

echo "ok";
?>