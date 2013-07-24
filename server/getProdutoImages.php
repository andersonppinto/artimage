<?php
header('Access-Control-Allow-Origin: *');
$pagina = $_GET["pagina"];
$linhas = $_GET["items"];
$artista = $_GET["artista"];
$familia = $_GET["familia"];
include 'connection_open.php';


	$result = mysql_query("select id, nome, artista, preco, foto, pagina, composicao from art_produto where artista = '".$artista."' and familia = '".$familia."' and referencia = '' and pagina = '".$pagina."'");
	if(!$result) {
		die("SQL Error => ".mysql_error());
	}
	$rows = array();
	$linhas = mysql_num_rows($result);
	if($linhas > 9) {
		$linhas = 9;
	}
	//echo "linha=".$linhas;

	if ($linhas == 1)
	{
		echo '<link type="text/css" rel="stylesheet" media="screen" href="artimage/css_galeria1.css">';
	}	
	elseif	($linhas == 2  || $linhas == 4)
	{
		echo '<link type="text/css" rel="stylesheet" media="screen" href="artimage/css_galeria2.css">';
	}
	elseif	($linhas == 3  || $linhas == 6 || $linhas == 7 || $linhas == 9|| $linhas == 5 || $linhas == 8)
	{
		echo '<link type="text/css" rel="stylesheet" media="screen" href="artimage/css_galeria9.css">';
	}
	$i = 0;
	$nome = array();
	if ($linhas == 1)
	{
		while($row = mysql_fetch_array($result))
		{
			$i++;
			if ($i == 1)
			{
				echo '<li class=last><img src="'.$row["foto"].'" width=450 height=450 alt="baubles"></li>';
				echo '<li>'.$row["nome"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/info.png" id="'.$row["nome"].'" onClick="lerJson(this);" align=center style="top: 30px; left: 550px; " alt="wreath"></li>';
			}
			else
			{
				echo '<li><img src="'.$row["foto"].'" width=250 height=250 alt="'.$row["nome"].'"></li>';
			}
			$nome[$i] = $row["nome"];
			//$nova_pagina = $row[pagina]; 
		}
	}
	elseif ($linhas == 2 || $linhas == 4)
	{
		while($row = mysql_fetch_array($result))
		{
			$i++;
			if ($i == 2 || $i ==4)
			{
			echo '<li class=last><img src="'.$row["foto"].'" width=300 height=300 alt="baubles"></li>';
			echo '<li>'.$nome[$i-1].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/info.png" id="'.$nome[$i-1].'" onClick="lerJson(this);" align=center style="top: 30px; left: 350px; " alt="star"></li>';
			echo '<li>'.$row["nome"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/img/info.png" id="'.$row["nome"].'" onClick="lerJson(this);" align=center style="top: 30px; left: 550px; " alt="wreath"></li>';
			}
			else
			{
			echo '<li><img src="'.$row["foto"].'" width=300 height=300 alt="'.$row["nome"].'"></li>';
			}
			$nome[$i] = $row["nome"];
			//$nova_pagina = $row[pagina]; 
		}
	}
	elseif ($linhas == 3 || $linhas == 5 || $linhas == 6 || $linhas == 7 || $linhas == 8 || $linhas == 9)
	{
		while($row = mysql_fetch_array($result))
		{
			$i++;
			if ($i == 3 || $i ==6 || $i == 9)
			{
			echo '<li class=last><img src="'.$row["foto"].'" width=250 height=250 alt="baubles"></li>';
			echo '<li>'.$nome[$i-2].'&nbsp;&nbsp;&nbsp;<img id="'.$nome[$i-2].'" src="/img/info.png" onClick="lerJson(this);" align=center style="top: 30px; left: 80px; " alt="'.$nome[$i-2].'"></li>';
			echo '<li>'.$nome[$i-1].'&nbsp;&nbsp;&nbsp;<img id="'.$nome[$i-2].'" src="/img/info.png" onClick="lerJson(this);" align=center style="top: 30px; left: 350px; " alt="star"></li>';
			echo '<li>'.$row["nome"].'&nbsp;&nbsp;&nbsp;<img id="'.$row["nome"].'"   src="/img/info.png" onClick="lerJson(this);" align=center style="top: 30px; left: 550px; " alt="wreath"></li>';
			}
			elseif (($i == 5 && $linhas == 5) || ($i == 8 && $linhas == 8))
			{
			echo '<li class=last><img src="'.$row["foto"].'" width=250 height=250 alt="baubles"></li>';
			echo '<li border=0><img src="artimage/img/space.png" width=250 height=250 border=0></li>';
			echo '<li>'.$nome[$i-1].'<img src="/img/info.png" id="'.$nome[$i-1].'" align=right onClick="lerJson(this);" align=right 	style="top: 30px; left: 350px; " alt="star"></li>';
			echo '<li>'.$row["nome"].'<img src="/img/info.png" id="'.$row["nome"].'" onClick="lerJson(this);" align=right 				style="top: 30px; left: 550px; " alt="wreath"></li>';
			}
			elseif ($i == 7 && $linhas == 7)
			{
			//{
			echo '<li class=last><img src="'.$row["foto"].'" width=250 height=250 alt="baubles"></li>';
			echo '<li border=0><img src="artimage/img/space.png" width=250 height=250 border=0></li>';
			echo '<li border=0><img src="artimage/img/space.png" width=250 height=250 border=0></li>';
			echo '<li>'.$row["nome"].'<img src="/img/info.png" onClick="lerJson(this);" align=right 				style="top: 30px; left: 550px; " alt="wreath"></li>';
			}
			else
			{
			echo '<li><img src="'.$row["foto"].'" width=250 height=250 alt="'.$row["nome"].'"></li>';
			}
			$nome[$i] = $row["nome"];
			//$nova_pagina = $row[pagina]; 
		}
	}

	include 'connection_close.php';
	
?>  