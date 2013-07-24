<?php
	$con = mysql_connect("mysql01.penabola.com.br","","");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("penabola", $con);
?>
