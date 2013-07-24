<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Flextracker - Promoções</title>
    <link rel="stylesheet" type="text/css" href="jquery/css/ui-lightness/jquery-ui-1.8.21.custom.css">
  	<script type="text/javascript" src="Scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="jquery/js/jquery-ui-1.8.21.custom.min.js"></script>
   
    <link rel="apple-touch-icon" sizes="72x72" href="Images/Logos/Motion_Logo.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="Images/Logos/Motion_Logo.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="Images/Logos/Motion_Logo.png" />
    
    <meta name = "viewport" content = "width=device-width" />
    <meta name = "viewport" content = "user-scalable=no, width=device-width" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <!--[if !IE]>-->
    <link type="text/css" rel="stylesheet" media="only screen and (max-device-width: 480px)" href="iPhone.css" />
    <link type="text/css" rel="stylesheet" media="only screen and (min-device-width: 481px) and (max-device-width: 1024px)" href="iPad.css" />
    <link type="text/css" rel="stylesheet" media="only screen and (min-device-width: 1024px)" href="Large.css" />
    <!--<![endif]-->


</head>
<body>
<script>
var lstOffers;
var indOffer = 0;
var initDragOffer = 0;

$(document).ready(function () {
	//$("#divOffers").bind("mousemove",$.proxy(self, 'DownMouse'));
	 $(document).mousemove(function(e){
		 posMouseX = e.pageX;
   	  }); 
	
	imageObj = new Image();
	
	$( "#divOffers" ).draggable({
			revert: true,  
			containment: "#organizer", 
			scroll: false, 
			
			start: function() {
				initDragOffer = posMouseX;
			},
			drag: function() {
	
			},
			stop: function() {
				if(initDragOffer > posMouseX) {
					previousOffer();
				} else {
					nextOffer();
				}
			}
	});

	$.getJSON("GetOffer_flex.php", function (json) {
		lstOffers = json;
		ShowOffer();
		for (var j = 0; j < lstOffers.length; j++) {
			row = lstOffers[j];
			imageObj.src = GetFullName(row['foto']);
		}
	});
	setInterval(function(){nextOffer()},20000);
});

function ShowOffer() {
	var row = lstOffers[indOffer];
	var price = parseFloat(row['preco']);
	var html = "";
	html += "<div id='divBorder'>";
	html += "<img id='imgOffer' src='" + GetFullName(row['foto']) + "'>";
	html += "<br />";
	html += "<div id='divOfferFooter'>";
	html += "<span id='spnPrice'>" + price.formatMoney(0)  + "</span><br />";
	html += row['nome'];
	html += "</div>";
	html += "</div>";
	//html += "<div id='divNav'>";
	html += "<nav>";
	html += "<a href='javascript:previousOffer();'><img id='imgPreviuos' src='Images/home/previous.png'></a>";
    html += "<a href='javascript:nextOffer();'><img id='imgNext' src='Images/home/next.png' ></a>";
  	html += "</nav>";
	//html += "</div>";
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

</script>

<div id="organizer">
    <table align=center id="tbMenu" border="0">
    	<tr>
        	<td><div border=0 id="TitleSearch">Veja nossa promoções</div>
			<div id="divMenu"></div></td>
		</tr>
		<tr>
 			<td id="tdOffer"><div id="divOffers"></div></td>
        </tr>
 	</table>
</body>
</body>
</html>
