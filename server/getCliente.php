<?php
header('Access-Control-Allow-Origin: *');
	$nome = $_GET["nome"];
	include 'connection_open.php';

	$result = mysql_query("select nome from art_cliente where nome like '%".$nome."%' LIMIT 10");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
		$bus = array('nome' => $row['nome'], 'codigo' => $row['nome']);
		array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>