<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';

	$produto = $_GET["produto"]; 
    $result = mysql_query("select id, nome, artista, preco, foto, pagina, composicao, descricao descri_produto, medida, medida as medidap from art_produto where nome = '".$produto."';");			
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
		$bus = array(
				'descri_produto' => $row['descri_produto'],
				'medida' => $row['medidap'],
				'medidap' => $row['medidap'],
				'preco' => $row['preco']
				);
		array_push($rows, $bus);
     }
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;
	include 'connection_close.php';
?>