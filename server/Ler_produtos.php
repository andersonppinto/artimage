<html>
<head>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="apple-touch-icon" href="http://www.penabola.com.br/artimage/artimage.htmkilo.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>Sistema de pedidos Artimage</title>
        <link type="text/css" rel="stylesheet" media="screen" href="artimage/jqtouch.css">
        <link type="text/css" rel="stylesheet" media="screen" href="artimage/apple/theme.css">
        <link type="text/css" rel="stylesheet" media="screen" href="artimage/apple/box.css">
        <link type="text/css" rel="stylesheet" media="screen" href="artimage/llife.css">
		<link type="text/css" rel="stylesheet" media="screen" href="artimage/apple/box.css">
		<link type="text/css" rel="stylesheet" media="only screen and (min-device-width: 1024px)" href="artimage/offer.css" />
        <script type="text/javascript" src="artimage/jquery.js"></script>
        <script type="text/javascript" src="artimage/jqtouch.js"></script>
        <script type="text/javascript" src="artimage/llife.js"></script>
        <script type="text/javascript" src="artimage/app_offer.js"></script>
    </head>
<?php
	include 'connection_open.php';

    	$item = $_GET["item"]; 
		$pagina = $_GET["pagina"];
		if ($pagina == '') {
			echo "<!--pagb=".$pagina."-->";
			//$result = mysql_query("select id, nome, artista, preco, foto from produto where artista = '".$item."' and referencia = '' order by nome;");
			//$result = mysql_query("select id, nome, artista, preco, foto, pagina from produto where artista = '".$item."' and referencia = '' and pagina = (select min(pagina) from produto where artista = '".$item."' and referencia = '' ) order by pagina, nome");
			$result = mysql_query("select id, nome, artista, preco, foto, pagina, composicao from produto where artista = '".$item."' and referencia = '' and pagina = (select min(pagina) from produto where artista = '".$item."' and referencia = '' and pagina > '".$pagina."') order by pagina, nome");			
		}
		else
		{
			echo "<!--pagc=".$pagina."-->";
			$result = mysql_query("select id, nome, artista, preco, foto, pagina, composicao from produto where artista = '".$item."' and referencia = '' and pagina = (select min(pagina) from produto where artista = '".$item."' and referencia = '' and pagina > '".$pagina."') order by pagina, nome");			
			//echo "<!--pag="."select id, nome, artista, preco, foto, pagina from produto where artista = '".$item."' and referencia = '' and pagina = (select min(pagina) from produto where artista = '".$item."' and referencia = '' and pagina > '".$pagina."') order by pagina, nome"."-->";
		}
		$rows = array();
		$linhas = mysql_num_rows($result);
		//echo "linha=".$linhas;
?>    

<script>
  var $rs;
  var html;
  var descri_produto;
  var medida;
  var medidap;
  var composi1;
  var composi2;
  var composi3;
//  var descri_comp();

  $(document).ready(function(){
		$("ul.gallery li:nth-child(3n)").addClass("last");
  });
  
  function lerJson(objeto)
  {
  	var varjson = "ler_composi.php?produto=" + objeto.id;
	$.getJSON(varjson, function (json) {
	rs = json;
	for (var j = 0; j < rs.length; j++) {
			row = rs[j];
			descri_produto = row['descri_produto'];
			medida = row['medida'];
			medidap = row['medidap'];
		}
	});
//	alert('abrir');
	lerComp(objeto);
  }
  function lerComp(objeto)
  {
	 var varjson = "ler_composi1.php?produto=" + objeto.id;
	$.getJSON(varjson, function (json) {
	rs = json;
	for (var j = 0; j < rs.length; j++) {
			row = rs[j];
			composi1 = row['descricao'];
			composi2 = row['descricao'];
			composi3 = row['descricao'];
		}
	});
	setTimeout(function() {
		abrirBox(objeto, descri_produto);
	}, 1000);	
  }
  function abrirBox(objeto, p1)
  {
 	var left = (objeto.x-170) + "px";
	var top = (objeto.y-290) + "px";
	document.getElementById('box').style.top = top;
	document.getElementById('box').style.left = left;
//  	var varjson = "ler_composi.php?produto=" + objeto.id;
//	lerJson(varjson)
	html = '<blockquote class="box-produto" align=left>';
	html += '<font color=#962828><b>' + objeto.id + '</b></font><font color=#000000>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="artimage/img/bot_fechar.png" onclick="fechaBox();" width=12 height=12 align=right></font><BR><BR>';
	html += '<font color=#000000>' + descri_produto + '</font><BR>';
	html += '<font color=#000000>' + medida + '</font><BR>';
	html += '<font color=#000000>(' + medidap + ')</font><BR><BR>';
	html += '<font color=#000000>' + composi1 + '</font><BR>';
	html += '<font color=#000000>' + composi2 + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><BR>';
	html += '<font color=#000000>' + composi3 + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>R$ 219,90</b></font><BR><BR>';
	html += '<font color=#000000>Cores: <INPUT TYPE="checkbox" Name="preto" Value="preto"> Preto&nbsp;<INPUT TYPE="checkbox" Name="branco" Value="branco"> Branco&nbsp;</font></font>';
	html += '<font color=#000000>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><img src="artimage/img/comprar.png" width=100 height=20 align=right>';
	html += '</blockquote>';	
	$("#box").html(html);


			document.getElementById('box').style.visibility = 'visible';

  }
  function fechaBox()
  {
	document.getElementById('box').style.visibility = 'hidden';
  }
  function proxPag(pag, sentido)
  {
	//alert(sentido);
	window.open('http://www.penabola.com.br/artimage/ler_produtos.php?item=artista9&pagina='+pag, '_parent','');
  }
  </script>
<style type="text/css">
	body {
		padding: 0px;
		margin: 0;
		font: 0.9em Arial, Helvetica, sans-serif;
	}
</style>
<?php
echo "<!--linhas=".$linhas."-->";
	
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
?>
    <body id="ler_produtos">
	<div id="dorivalmoreira"  style="min-height: 1000px;" >
			<center>
            <div class="toolbar">
                <h1><?php echo $item; ?></h1>
                <a class="button back" href="http://www.penabola.com.br/artimage/artimage.htm">Voltar</a>
            </div>
			<div id="wrapper">
		<ul class="gallery">
<?php
		$i == 0;
		$nome == array();
		if ($linhas == 1)
		{
			while($row = mysql_fetch_array($result))
			{
				$i++;
				if ($i == 1)
				{
				echo '<li class=last><img src="'.$row[foto].'" width=450 height=450 alt="baubles"></li>';
				//<img src="imgold/next_arrow.gif" onclick="proxPag('.$nova_pagina.');">
				echo '<li>'.$row[nome].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="artimage/apple/img/info.png" id="'.$row[nome].'" onClick="lerJson(this);" align=center style="top: 30px; left: 550px; " alt="wreath"></li>';
				}
				else
				{
				echo '<li><img src="'.$row[foto].'" width=250 height=250 alt="'.$row[nome].'"></li>';
				}
				$nome[$i] = $row[nome];
				$nova_pagina = $row[pagina]; 
			}
		}
		elseif ($linhas == 2 || $linhas == 4)
		{
			while($row = mysql_fetch_array($result))
			{
				$i++;
				if ($i == 2 || $i ==4)
				{
				echo '<li class=last><img src="'.$row[foto].'" width=300 height=300 alt="baubles"></li>';
				echo '<li>'.$nome[$i-1].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=center style="top: 30px; left: 350px; " alt="star"></li>';
				echo '<li>'.$row[nome].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=center style="top: 30px; left: 550px; " alt="wreath"></li>';
				}
				else
				{
				echo '<li><img src="'.$row[foto].'" width=300 height=300 alt="'.$row[nome].'"></li>';
				}
				$nome[$i] = $row[nome];
				$nova_pagina = $row[pagina]; 
			}
		}
		elseif ($linhas == 3 || $linhas == 5 || $linhas == 6 || $linhas == 7 || $linhas == 8 || $linhas == 9)
		{
			while($row = mysql_fetch_array($result))
			{
				$i++;
				if ($i == 3 || $i ==6 || $i == 9)
				{
				echo '<li class=last><img src="'.$row[foto].'" width=250 height=250 alt="baubles"></li>';
				echo '<li>'.$nome[$i-2].'&nbsp;&nbsp;&nbsp;<img id='.$nome[$i-2].' src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=center style="top: 30px; left: 80px; " alt="'.$nome[$i-2].'"></li>';
				echo '<li>'.$nome[$i-1].'&nbsp;&nbsp;&nbsp;<img id='.$nome[$i-2].' src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=center style="top: 30px; left: 350px; " alt="star"></li>';
				echo '<li>'.$row[nome].'&nbsp;&nbsp;&nbsp;<img id='.$row[nome].'   src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=center style="top: 30px; left: 550px; " alt="wreath"></li>';
				}
				elseif (($i == 5 && $linhas == 5) || ($i == 8 && $linhas == 8))
				{
				echo '<li class=last><img src="'.$row[foto].'" width=250 height=250 alt="baubles"></li>';
				echo '<li border=0><img src="artimage/img/space.png" width=250 height=250 border=0></li>';
				echo '<li>'.$nome[$i-1].'<img src="artimage/apple/img/info.png" align=right onClick="abrirBox(this);" align=right 	style="top: 30px; left: 350px; " alt="star"></li>';
				echo '<li>'.$row[nome].'<img src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=right 				style="top: 30px; left: 550px; " alt="wreath"></li>';
				}
				elseif ($i == 7 && $linhas == 7)
				{
				//{
				echo '<li class=last><img src="'.$row[foto].'" width=250 height=250 alt="baubles"></li>';
				echo '<li border=0><img src="artimage/img/space.png" width=250 height=250 border=0></li>';
				echo '<li border=0><img src="artimage/img/space.png" width=250 height=250 border=0></li>';
				echo '<li>'.$row[nome].'<img src="artimage/apple/img/info.png" onClick="abrirBox(this);" align=right 				style="top: 30px; left: 550px; " alt="wreath"></li>';
				}
				else
				{
				echo '<li><img src="'.$row[foto].'" width=250 height=250 alt="'.$row[nome].'"></li>';
				}
				$nome[$i] = $row[nome];
				$nova_pagina = $row[pagina]; 
			}
		}
?>    

		</ul>
		<div id=box style="position: absolute; top: 20px; left: 100px; width=300; visibility: hidden; z-index:3;">
		</div>		
		</div>
        <div id="cesta" style="position: absolute; top: 55px; left: 820px; height: 1000; width:193; border: 0px solid; z-index:1; 
		      background: -moz-linear-gradient(90deg, #00abeb, #f5f5f5, #d7d7d7, #f5f5f5);
              background: -webkit-gradient(linear, left top, left bottom, from(#d7d7d7), to(#f5f5f5), color-stop(0.5, #f5f5f5), color-stop(0.5, #f5f5f5));
				">
        </div>
		<div id="orcamento" style="position: absolute; top: 70px; left: 830px; height: 37; width:173; background-image: url(artimage/img/bot_salvar_orca.png); z-index:2;">
		</div>
		<div id="salvar" style="position: absolute; top: 120px; left: 830px; height: 37; width:173; background-image: url(artimage/img/bot_salvar_pedido.png); z-index:2;">
		</div>
		<div id="pdf" style="position: absolute; top: 170px; left: 830px; height: 37; width:173; background-image: url(artimage/img/bot_pdf.png); z-index:2;">
		</div>
		<div id="'" style="position: absolute; top: 220px; left: 830px; height: 37; width:173; background-image: url(artimage/img/bot_cancelar.png); z-index:2;">
		</div>
		<div id="carrinho" style="position: absolute; top: 270px; left: 830px; height: 428; width:175; background-image: url(artimage/img/cesta.png); z-index:2;">
		</div>
		<div id="next" onclick="proxPag('<?php echo $nova_pagina; ?>','pre');" style="position: absolute; top: 310px; left: 790px; height: 47; width:27; background-image: url(artimage/img/min_next.jpg); z-index:2;">
		</div>
		<div id="prev" onclick="proxPag('<?php echo $nova_pagina; ?>','pos');" style="position: absolute; top: 310px; left: 0px; height: 47; width:27; background-image: url(artimage/img/min_prev.jpg); z-index:2;">
		</div>
		<div id="pictureoverlay">
    <div class="close"></div>
    <img width="300" />
</div>
		</center>
	</div> <!-- fim da div produtos -->
<?php
	include 'connection_close.php';
?>    
</body></html>