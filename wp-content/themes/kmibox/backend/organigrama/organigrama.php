<!-- 
<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/clientes/clientes.css'>
<script src='<?php echo TEMA(); ?>/backend/clientes/clientes.js'></script>
 -->
<script src="<?php echo TEMA(); ?>/backend/organigrama/lib/release/go.js"></script>
<script src="<?php echo TEMA(); ?>/backend/organigrama/lib/assets/js/goSamples.js"></script>
<script src="<?php echo TEMA(); ?>/backend/organigrama/organigrama.js"></script>

<div class="container_listados">

    <div class='titulos'>
      <h2>Organigrama de Asesores</h2> <hr>
    </div>
  
    <div id="myDiagramDiv" style="background-color: white; border: solid 1px #cfcfcf; height: 500px"></div>

<textarea id="mySavedModel" style="width:100%;height:300px">{ 
"class": "go.GraphLinksModel",
"nodeDataArray": [
{"key":"1", "name":"Corrado 'Junior' Soprano", "title":"The Boss"},
{"key":"2", "name":"Tony Soprano", "title":"Underboss"},
{"key":"3", "name":"Herman 'Hesh' Rabkin", "title":"Advisor"},
{"key":"4", "name":"Paulie Walnuts", "title":"Capo"},
{"key":"5", "name":"Ralph Cifaretto", "title":"Capo MIA"},
{"key":"6", "name":"Silvio Dante", "title":"Consigliere"},
{"key":"7", "name":"Bobby Baccilien", "title":"Capo"},
{"key":"8", "name":"Sal Bonpensiero", "title":"MIA"},
{"key":"9", "name":"Christopher Moltisanti", "title":"Made Man"},
{"key":"10", "name":"Furio Giunta", "title":"Muscle"},
{"key":"11", "name":"Patsy Parisi", "title":"Accountant"}
],
"linkDataArray": [
{"from":"1", "to":"2"},
{"from":"1", "to":"3"},
{"from":"2", "to":"4"},
{"from":"2", "to":"5"},
{"from":"2", "to":"6"},
{"from":"2", "to":"7"},
{"from":"4", "to":"8"},
{"from":"4", "to":"9"},
{"from":"4", "to":"10"},
{"from":"4", "to":"11"}
]
}</textarea>


</div>

