<?php

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
switch($type)
{
	case 'I';
		try {
			$con = mysql_connect("mysql01.penabola.com.br","penabola","bilong1");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("penabola", $con);

			$strSql = "Insert into art_cliente "
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
			mysql_close($con);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		break;
	case 'U';
		try {
			$con = mysql_connect("mysql01.penabola.com.br","penabola","bilong1");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("penabola", $con);

			$strSql = "UPDATE art_cliente SET "
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
			mysql_close($con);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		break;
	case 'D';
		try {
			$con = mysql_connect("mysql01.penabola.com.br","penabola","bilong1");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("penabola", $con);
			
			$strSql = "Delete from art_cliente  WHERE codigo = '".$codigo."'";
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
			mysql_close($con);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		break;
	default;
		echo "Tipo Invalido => ".$type."<br>";
}
header("Location: clientes.php");
?>