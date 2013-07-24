<?php
header('Access-Control-Allow-Origin: *');
	include 'connection_open.php';

	$result = mysql_query("select * from art_pedido");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
    	$bus = array('pedidoId' => $row['PedidoId'],
    				 'orcamentoId' => $row['OrcamentoId'],
    				 'cliente' => $row['Cliente'],	
    				 'representante' => $row['Representante'],
			    	'transportadora' => $row['Transportadora'],
			    	'pagamento' => $row['Pagamento'],
			    	'observacao' => $row['Observacao']);
		array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>