<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';
	$produto = $_GET["produto"]; 
    $result1 = mysql_query("SELECT composicao.linha, composicao.Descricao descricao FROM art_produto, art_composicao WHERE produto.composicao = composicao.codigo and nome = '".$produto."' order by linha;");
	$rows1 = array();
    while($row = mysql_fetch_array($result1))
    {
		$bus1 = array(
			'linha' => $row['linha'],
			'descricao' => $row['descricao']
		);
		array_push($rows1, $bus1);
	}
		
  	$jasonstr = json_encode($rows1);
	echo $jasonstr;
	include 'connection_close.php';
?>