var lstOffers;
var indOffer = 0;
var initDragOffer = 0;

$(document).ready(function () {
	//$("#divOffers").bind("mousemove",$.proxy(self, 'DownMouse'));
	 $(document).mousemove(function(e){
		 posMouseX = e.pageX;
   	  }); 
	
});


function LerProdutos(item){
	indOffer = 0;
	initDragOffer = 0;
	var html = "";
	html += "<div id='mensagem'>";
	html += "<img id='imgPreviuos' src='artimage/img/loading.gif'><span>Aguardando a leitura do banco de dados!</span>";
	html += "</div>";
	$("#divOffers").html(html);
	//imageObj = new Image();
	$.getJSON("GetOffer_flex.php?item="+item, function (json) {
		lstOffers = json;
		ShowOffer();
		//for (var j = 0; j < lstOffers.length; j++) {
		//	row = lstOffers[j];
			//imageObj.src = GetFullName(row['foto']);
		//	imageObj.src = row['foto'];
		//}
	});
}
function ShowOffer() {
	var row = lstOffers[indOffer];
	var price = parseFloat(row['preco']);
	var html = "";
	html += "<div id='divBorder'>";
	//html += "<img id='imgOffer' src='" + GetFullName(row['foto']) + "'>";
	html += "<img id='imgOffer' src='" + row['foto'] + "'>";
	html += "<br />";
	html += "<div id='divOfferFooter'>";
	//html += "<span id='spnPrice'>" + price.formatMoney(0)  + "</span><br />";
	html += "<span id='spnPrice'>" + price + "</span><br />";
	html += row['nome'];
	html += "</div>";
	html += "</div>";
	html += "<nav>";
	html += "<a href='javascript:previousOffer();'><img id='imgPreviuos' src='Images/home/previous.png'></a>";
    html += "<a href='javascript:nextOffer();'><img id='imgNext' src='Images/home/next.png' ></a>";
  	html += "</nav>";
	//alert(html);
	$("#divOffers").html(html);
}
function previousOffer() {
	if(indOffer == 0) {
		indOffer = lstOffers.length - 1;
	} else {
		indOffer--;
	}
	ShowOffer();
}

function nextOffer() {
	if(indOffer >=  lstOffers.length-1) {
		indOffer = 0;
	} else {
		indOffer++;
	}
	ShowOffer();
}

function GetFullName(fullName) {
	var result;
	var aNames = fullName.split('||');
	//alert(aNames);
	var i = aNames[0].indexOf("?");
	if(i == 0) {
		result = aNames[0];
	} else {
		result = aNames[0].substr(0,i);
	}
	return result;
}
// Extend the default Number object with a formatMoney() method:
// usage: someVar.formatMoney(decimalPlaces, symbol, thousandsSeparator, decimalSeparator)
// defaults: (2, "$", ",", ".")
Number.prototype.formatMoney = function(places, symbol, thousand, decimal) {
	places = !isNaN(places = Math.abs(places)) ? places : 2;
	symbol = symbol !== undefined ? symbol : "$";
	thousand = thousand || ",";
	decimal = decimal || ".";
	var number = this, 
	    negative = number < 0 ? "-" : "",
	    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
};


