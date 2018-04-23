<!-- 
<script src='<?php echo TEMA(); ?>/backend/clientes/clientes.js'></script>
 -->
<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/organigrama/organigrama.css'>
<script src="<?php echo TEMA(); ?>/backend/organigrama/lib/release/go.js"></script>
<script src="<?php echo TEMA(); ?>/backend/organigrama/lib/assets/js/goSamples.js"></script>
<script src="<?php echo TEMA(); ?>/backend/organigrama/organigrama.js"></script>

<div class="container_listados">

    <div class='titulos'>
        <button id="actualizar" style="font-weight: bold;padding:10px;float:right;">Actualizar Estructura</button>
        <h2>Estructura de Asesores</h2> 
        <hr>
    </div>
  
    <div id="myDiagramDiv"></div>

    <div id="cargando_estructura" class="text-center">
    	<img src="<?php echo TEMA(); ?>/backend/organigrama/image/estructura.png" class="responsive"><br>
    	<h1><i class="fa fa-cog fa-spin"></i> Cargando estructura</h1>
    </div>

</div>

