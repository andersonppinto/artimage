<?php
header('Access-Control-Allow-Origin: *');
include 'connection_open.php';
$produto = $_GET["produto"];
$result1 = mysql_query("SELECT nome FROM  art_produto WHERE referencia = '".$produto."'");
$rows1 = array();
while($row = mysql_fetch_array($result1))
{
	$bus1 = array(
			'nome' => $row['nome']
	);
	array_push($rows1, $bus1);
}

$jasonstr = json_encode($rows1);
echo $jasonstr;
include 'connection_close.php';
?>