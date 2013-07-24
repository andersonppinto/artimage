<?php
	//echo date('m/d/Y h:i:s a', time());
    try {
        $con = mysql_connect("mysql01.penabola.com.br","penabola","bilong1");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("penabola", $con);
		$item = $_GET["item"]; 
       	$result = mysql_query("select id, nome, preco, foto from produto where artista = '".$item."' and referencia = '';");
		$rows = array();
        while($row = mysql_fetch_array($result))
        {
			//$rows[] = $row;
			$bus = array(
					'id' => $row['id'],
					'nome' => $row['nome'],
					'preco' => $row['preco'],
					'foto' => $row['foto']);
			//Carrega o array como pilha
			array_push($rows, $bus);
			//echo $row[0]."-".$row[1]."-".$row[2]."-".$row[3]."<BR>";//.$row[4]."-".$row[5]."<BR>";
        }
		
  		$jasonstr = json_encode($rows);
		echo $jasonstr;
		//echo json_encode($rows);
		//echo date('m/d/Y h:i:s a', time());
        mysql_close($con);
    } catch(Exception $e) {
        echo $e->getMessage();
    }        
?>