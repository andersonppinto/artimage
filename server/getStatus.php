<?php
header('Access-Control-Allow-Origin: *');

	include 'connection_open.php';

	$result = mysql_query("select name, lastDate from art_status");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	
	$rows = array();
    while($row = mysql_fetch_array($result))
    {
		$bus = array('name' => $row['name'], 'lastDate' => $row['lastDate']);
		array_push($rows, $bus);
	}
		
  	$jasonstr = json_encode($rows);
	echo $jasonstr;

	include 'connection_close.php';
	
?>