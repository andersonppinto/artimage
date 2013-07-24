<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';

	$result = mysql_query("select * from art_produto");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
    	$bus = array('id' => $row['id'],
			    	'nome' => $row['nome'],
			    	'artista' => $row['artista'],	
			    	'preco' => $row['preco'],	
			    	'foto' => $row['foto'],	
			    	'pagina' => $row['pagina'],	
			    	'referencia' => $row['referencia'],
			    	'composicao' => $row['composicao'],
			    	'descricao' => $row['descricao'],
			    	'medida' => $row['medida'],
			    	'medidapol' => $row['medidapol'],
			    	'familia' => $row['familia'],
			    	'auxiliar' => $row['auxiliar'],
			    	'peso' => $row['peso'],
			    	'qtd' => $row['qtd'],	
			    	'ncm' => $row['ncm'],
			    	'modelo' => $row['modelo'],	
			    	'lancamento' => $row['lancamento'],	
			    	'site' => $row['site'],	
			    	'ean' => $row['ean'],
			    	'catalogo' => $row['catalogo']);
		array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>