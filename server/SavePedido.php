<?php
header('Access-Control-Allow-Origin: *');

$cliente = $_POST["cliente"];
$transportadora = $_POST["transportadora"];
$pagamento = $_POST["pagamento"];
$observacao = $_POST["observacao"];
$orcamento = $_POST["orcamento"];
$pedido = $_POST["pedido"];
$representante = $_SESSION['user'];
include 'connection_open.php';


	if($pedido == "New") {
		$result = mysql_query("Select Max(PedidoId) from art_pedido where PedidoId > 0" );
		if($row = mysql_fetch_array($result))
		{
			$pedido = $row[0] + 1;
		} else {
			$pedido = 1;
		}
		$orcamento = 0;
	}

	if($orcamento == "New") {
		$result = mysql_query("Select Max(OrcamentoId) from art_pedido where OrcamentoId > 0" );
		if($row = mysql_fetch_array($result))
		{
			$orcamento = $row[0] + 1;
		} else {
			$orcamento = 1;
		}
		$pedido = 0;
	}

	$strSql = "Insert into art_pedido "
			."(PedidoId"
			.",OrcamentoId"
			.",Cliente"
			.",Representante"
			.",Transportadora"
			.",Pagamento"
			.",Observacao) "
			." VALUES "
			."(".$pedido
			.",".$orcamento
			.",'".$cliente."'"
			.",'".$representante."'"

			.",'".$transportadora."'"
			.",'".$pagamento."'"
			.",'".$observacao."')";


	$result = mysql_query($strSql);
	if(!$result) {
		die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
	}

	$strSql = "Update art_status set lastDate = NOW() Where name = 'Pedido'";
	$result = mysql_query($strSql);


	if($pedido > 0) {
		echo "Pedido => ".$pedido." Inserido com Sucesso";
	} else {
		echo "Orcamento => ".$orcamento." Inserido com Sucesso";
	}

	include 'connection_close.php';
?>