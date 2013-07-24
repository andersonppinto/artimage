<?php
header('Access-Control-Allow-Origin: *');
$type = $_POST["type"];
$codigo = $_POST["txtCodigo"];
if($type != 'D') {
	$nome = $_POST["txtNome"];
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
include 'connection_open.php';

switch($type)
{
	case 'I';

			$strSql = "Insert into art_representante "
					  ."(codigo"
					  .", nome"
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
					  ."('".$codigo."'"
					  .",'".$nome."'"
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

			$strSql = "UPDATE art_representante SET "
						."nome = '".$nome."'"
						.", cnpj = '".$cnpj."'"
						.", rg = '".$rg."'"
						.", contato = '".$contato."'"
						.", email = '".$email."'"
						.", telefone = '".$telefone."'"
						.", endereco = '".$endereco."'"
						.", bairro = '".$bairro."'"
						.", cep = '".$cep."'"
						.", cidade = '".$cidade."'"
						.", uf = '".$uf."'"
			."WHERE codigo = '".$codigo."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	case 'D';
			
			$strSql = "Delete from art_representante  WHERE codigo = '".$codigo."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	default;
		echo "Tipo Invalido => ".$type."<br>";
}

$strSql = "Update art_status set lastDate = NOW() Where name = 'Representante'";
$result = mysql_query($strSql);


include 'connection_close.php';
echo "ok";
?>