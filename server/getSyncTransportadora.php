<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';

	$result = mysql_query("select * from art_transportadora");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
	    	$bus = array('nome' => $row['nome'],
				    	'contato' => $row['contato'],	
				    	'email'	=> $row['email'],
				    	'telefone' => $row['telefone'],
				    	'razaosocial' => $row['razaosocial']);
    	array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>