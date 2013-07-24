<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';

	$result = mysql_query("select * from art_composicao");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
    	$bus = array('codigo' => $row['Codigo'],
			    	'linha' => $row['Linha'],
			    	'descricao' => $row['Descricao']);
		array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>