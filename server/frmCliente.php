<?php
header('Access-Control-Allow-Origin: *');
include 'connection_open.php';

$type = $_POST["type"];	
$nome = $_POST["txtNome"];
if($type != 'D') {
	$cnpj = $_POST["txtCnpj"];
	$rg = $_POST["txtRG"];
	$contato = $_POST["txtContato"];
	$email = $_POST["txtEmail"];
	$telefone = $_POST["txtTelefone"];
	$endereco = $_POST["txtEndereco"];
	$bairro = $_POST["txtBairro"];
	$cep = $_POST["txtCep"];
	$cidade = $_POST["txtCidade"];
	$uf = $_POST["txtUF"];
}
switch($type)
{
	case 'I';

			$strSql = "Insert into art_cliente "
					  ."(nome"
					  .", cnpj"
					  .", rg"
					  .", contato"
					  .", email"
					  .", telefone"
					  .", endereco"
					  .", bairro"
					  .", cep"
					  .", cidade"
					  .", uf) "
					  ." VALUES "
					  ."('".$nome."'"
					  .",'".$cnpj."'"
					  .",'".$rg."'"
					  .",'".$contato."'"
					  .",'".$email."'"
					  .",'".$telefone."'"
	  				  .",'".$endereco."'"
	  				  .",'".$bairro."'"
	  				  .",'".$cep."'"
					  .",'".$cidade."'"
					  .",'".$uf."')";
					  				  				  				  				  				  				  
					  
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
							}
		break;
	case 'U';
			$strSql = "UPDATE art_cliente SET "
						."cnpj = '".$cnpj."'"
						.", rg = '".$rg."'"
						.", contato = '".$contato."'"
						.", email = '".$email."'"
						.", telefone = '".$telefone."'"
						.", endereco = '".$endereco."'"
						.", bairro = '".$bairro."'"
						.", cep = '".$cep."'"
						.", cidade = '".$cidade."'"
						.", uf = '".$uf."'"
			."WHERE nome = '".$nome."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	case 'D';
			
			$strSql = "Delete from art_cliente  WHERE nome = '".$nome."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	default;
		echo "Tipo Invalido => ".$type."<br>";
}

$strSql = "Update art_status set lastDate = NOW() Where name = 'Cliente'";
$result = mysql_query($strSql);

include 'connection_close.php';

echo "ok";
?>