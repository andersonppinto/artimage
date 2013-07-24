<?php
header('Access-Control-Allow-Origin: *');
require_once "Mail.php";

$email = $_GET["email"];
include 'connection_open.php';

$result = mysql_query("select password from art_representante where email = '".$email."'");
if(!$result) {
	die("SQL Error => ".mysql_error());
}

$rows = array();
if($row = mysql_fetch_array($result))
{

	
	$from = "<laercio@hpcbrasil.com>";
	$to = $email;
	$subject = "ArtImage Password";
	$body = "Sua senha na aplicacao ArtImage => ".$row["password"];
	
	$host = "ssl://smtp.gmail.com";
	$port = "465";
	$username = "laercio@hpcbrasil.com";  //<> give errors
	$password = "WeWi11Win";
	
	$headers = array ('From' => $from,
			'To' => $to,
			'Subject' => $subject);
	$smtp = Mail::factory('smtp',
			array ('host' => $host,
					'port' => $port,
					'auth' => true,
					'username' => $username,
					'password' => $password));
	
	$mail = $smtp->send($to, $headers, $body);
	
	if ($mail) {
		echo("Email Enviado com Sucesso");
	} else {
		echo("Falha no Envio do Email");
	}
} else {
	echo "Representante nao Cadastrado.";
}

include 'connection_close.php';
?>