"use strict";function floatchart(){var e={legend:{show:!1},series:{label:"",curvedLines:{active:!0,nrSplinePoints:20}},tooltip:{show:!0,content:"x : %x | y : %y"},grid:{hoverable:!0,borderWidth:0,labelMargin:0,axisMargin:0,minBorderMargin:0},yaxis:{min:0,max:30,color:"transparent",font:{size:0}},xaxis:{color:"transparent",font:{size:0}}};$.plot($("#sal-income"),[{data:[[0,25],[1,15],[2,20],[3,27],[4,10],[5,20],[6,10],[7,26],[8,20],[9,10],[10,25],[11,27],[12,12],[13,26]],color:"#42a5f5",lines:{show:!0,fill:!0,lineWidth:3},points:{show:!1},curvedLines:{apply:!0}}],e),$.plot($("#rent-income"),[{data:[[0,25],[1,15],[2,25],[3,27],[4,10],[5,20],[6,15],[7,26],[8,20],[9,13],[10,25],[11,27],[12,12],[13,1]],color:"#66bb6a",lines:{show:!0,fill:!0,lineWidth:3},points:{show:!1},curvedLines:{apply:!0}}],e),$.plot($("#income-analysis"),[{data:[[0,25],[1,30],[2,25],[3,27],[4,10],[5,20],[6,15],[7,26],[8,10],[9,13],[10,25],[11,27],[12,12],[13,27]],color:"#e53935",lines:{show:!0,fill:!0,lineWidth:3},points:{show:!1},curvedLines:{apply:!0}}],e)}$(document).ready(function(){var e;e=new GMaps({el:"#markers-map",lat:21.2334329,lng:72.866472,scrollwheel:!1}),e.addMarker({lat:21.2334329,lng:72.866472,title:"Marker with InfoWindow",infoWindow:{content:'<p>codedthemes<br/> Buy Now at <a href="">Themeforest</a></p>'}}),floatchart(),$(window).on("resize",function(){floatchart()}),$("#mobile-collapse").on("click",function(){setTimeout(function(){floatchart()},700)})});