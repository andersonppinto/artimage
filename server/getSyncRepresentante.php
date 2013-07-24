<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';

	$result = mysql_query("select * from art_representante");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
    	$bus = array('codigo' => $row['codigo'],
       				 'nome' => $row['nome'],
			    	'cnpj' => $row['cnpj'],
			    	'rg' => $row['rg'],
			    	'contato' => $row['contato'],	
			    	'email'	=> $row['email'],
			    	'telefone' => $row['telefone'],
			    	'endereco' => $row['endereco'],
			    	'bairro' => $row['bairro'],	
			    	'cep' => $row['cep'],	
			    	'cidade' => $row['cidade'],
			    	'uf' => $row['uf'],
    				'password' => $row['password']);
    	
    	
		array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>