<?php
header('Access-Control-Allow-Origin: *');

$type = $_POST["type"];
$pedidoId = $_POST["PedidoId"]; ,
$orcamentoId = $_POST["OrcamentoId"];
if($type != 'D') {
	$cliente = $_POST["Cliente"];
	$representante = $_POST["Representante"];
	$transportadora = $_POST["Transportadora"];
	$pagamento = $_POST["Pagamento"];
	$observacao = $_POST["Observacao"];
	$dataPedido = $_POST["DataPedido"];
	$dataOrcamento = $_POST["DataOrcamento"];
	$items = $_POST["Items"];
}

$pedidosItems = explode("%%", $items);

include 'connection_open.php';

switch($type)
{
	case 'I';

		$strSql = "Insert into art_pedido "
				  "(PedidoId"
				  ", OrcamentoId"
				  ", Cliente"
				  ", Representante"
				  ", Transportadora"
				  ", Pagamento"
				  ", Observacao"
				  ", dataPedido"
				  ", dataOrcamento) "
				  ." VALUES "
				  ."(".$pedidoId
				  .",".$orcamentoId
				  .",'".$cliente."'"
				  .",'".$representante."'"
				  .",'".$transportadora."'"
				  .",'".$pagamento."'"
				  .",'".$observacao."'"
  				  .",'".$dataPedido."'"
  				  .",'".$dataOrcamento."')";

		$result = mysql_query($strSql);
		if(!$result) {
			die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
		}

		$result = mysql_query("Delete from art_pedido_item WHERE PedidoId = ".$pedidoId." and OrcamentoId = " + $orcamentoId);
		if(!$result) {
			die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
		}
		foreach ($pedidosItems as $item) {
			list($produto, $quantidade, $preco) = explode("||", $item);
			$strSql = "Insert into art_pedido_item "
						"(PedidoId"
						", OrcamentoId"
						", produto"
						", Quantidade"
						", Preco) "
						." VALUES "
						."(".$pedidoId
						.",".$orcamentoId
						.",'".$produto."'"
						.",".$quantidade
						.",".$preco.")";

			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		}
		break ;
	case 'U';
		$strSql = "UPDATE art_representante SET "
		 		  ." Cliente = '".$cliente."'"
				  .", Representante = '".$representante."'"
				  .", Transportadora = '".$transportadora."'"
				  .", Pagamento = '".$pagamento."'"
				  .", Observacao = '".$observacao."'"
				  .", dataPedido = '".$dataPedido."'"
				  .", dataOrcamento = '".$dataOrcamento."'";
				  ."WHERE PedidoId = ".$pedidoId." and OrcamentoId = " + $orcamentoId;
		$result = mysql_query($strSql);
		if(!$result) {
			die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
		}
		$result = mysql_query("Delete from art_pedido_item WHERE PedidoId = ".$pedidoId." and OrcamentoId = " + $orcamentoId);
		if(!$result) {
			die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
		}
		foreach ($pedidosItems as $item) {
			list($produto, $quantidade, $preco) = explode("||", $item);
			$strSql = "Insert into art_pedido_item "
			"(PedidoId"
			", OrcamentoId"
			", produto"
			", Quantidade"
			", Preco) "
			." VALUES "
			."(".$pedidoId
			.",".$orcamentoId
			.",'".$produto."'"
			.",".$quantidade
			.",".$preco.")";

			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		}


		break;
	case 'D';
			$strSql = "Delete from art_pedido  WHERE PedidoId = ".$pedidoId." and OrcamentoId = " + $orcamentoId;
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}

			$strSql = "Delete from art_pedido_item  WHERE PedidoId = ".$pedidoId." and OrcamentoId = " + $orcamentoId;
			$result = mysql_query($strSql);
			if(!$result) {
				die('Error: <br>SQL =>'.$strSql."<br>Message =>".mysql_error());
			}
		break;
	default;
		echo "Tipo Invalido => ".$type."<br>";
}

$strSql = "Update art_status set lastDate = NOW() Where name = 'Representante'";
$result = mysql_query($strSql);


include 'connection_close.php';
echo "ok";
?>