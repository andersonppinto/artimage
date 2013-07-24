<?php
header('Access-Control-Allow-Origin: *');

?>
<script type="text/javascript">
function Cliente_change() {
	$("#divListCliente").show();

	$.getJSON("/server/getCliente.php?nome=" + $("#txtCliente").val(), function(json) {
		var sHtml = "<ul class='edgetoedge'>";
		var sName = "";
		$.each(json, function(item,line) {
			sName = line["nome"],
			sHtml += "<li class='arrow'><a href='javascript:SelectClientes(\"" + sName + "\")'>" + sName + "</a></li>";
		});
		sHtml += "</ul>";
		$("#divListCliente").html(sHtml);
	});
}
function SelectClientes(cliente) {
	$("#divListCliente").hide();
	$("#txtCliente").val(cliente);
	pedido.Cliente = cliente;
}

function SelectTransportadora(transportadora) {
	$("#divListTransportadora").hide();
	$("#txtTransportadora").val(transportadora);
	pedido.Transportadora = transportadora;
}

function btnSave_Click() {
 	pedido.cliente = $("#txtCliente").val();
 	pedido.transportadora = $("#txtTransportadora").val();
 	pedido.pagamento = $("#cmbPagamento").val();
 	pedido.observacao =	$("#txtObservacao").val();

 	SavePedidoLocal();
	$.post("SavePedido.php", {
		pedido : JSON.stringify(pedido)
	}, 
	function(data) {
			alert(data);
			//window.location = "pedidos.php";
	});
	                                                                                                                                        
	
}

function Transportadora_change() {
	$("#divListTransportadora").show();

	$.getJSON("/server/getTransportadora.php?nome=" + $("#txtTransportadora").val(), function(json) {
		var sHtml = "<ul class='edgetoedge'>";
		$.each(json, function(item,line) {
			var sName = line["nome"];
			sHtml += "<li class='arrow'><a href='javascript:SelectTransportadora(\"" + sName + "\")'>" + sName + "</a></li>";
		});
		sHtml += "</ul>";
		$("#divListTransportadora").html(sHtml);
	});

}
</script>
<div id="divSearchCliente">
<ul class="rounded">
<li><h1>Cliente</h1><input type="text" placeholder="Nome Cliente" id="txtCliente"
autocapitalize="off" autocorrect="off" autocomplete="off"  onkeyup="Cliente_change()" ></li>
</ul>
</div>
<div id="divListCliente">
</div>
<div id="divSearchTransportadora">
<ul class="rounded">
<li><h1>Transportadora</h1><input type="text" placeholder="Nome Transportadora" id="txtTransportadora"
autocapitalize="off" autocorrect="off" autocomplete="off"  onkeyup="Transportadora_change()" ></li>
</ul>
</div>
<div id="divListTransportadora"></div>
<div id="divPagamento">
<ul class="rounded">
<li><h1>Pagamento</h1><select id="cmbPagamento"><option>A VISTA</option></select></li>
<li><h1>Consideracoes</h1><input type="text" placeholder="Consideracoes Finais" id="txtObservacao"
autocapitalize="off" autocorrect="off" autocomplete="off" ></li>
</ul>
</div>
<div id="divListProduto">
	
</div>
<input type="button" id="btnSave" onclick="btnSave_Click()" value="Gravar">