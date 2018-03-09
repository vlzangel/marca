<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/suscripciones/suscripciones.css'>
<script src='<?php echo TEMA(); ?>/backend/suscripciones/suscripciones.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Suscripciones</h2> <hr>
    </div>

 	<div class="botones_container">
	    <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Producto" data-modulo="productos" data-modal="nuevo" data-id="" class="button button-primary button-large" />

        <input type='button' value='EXCEL' id='excel' data-modulo="suscripciones" data-file="suscripciones" class="button button-primary button-large" />
	</div> 

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th width="30">ID</th>
                <th width="30">Orden</th>
                <th width="100">Fecha suscripci&oacute;n</th>
                <th>Cliente</th>
                <th>Datos del cliente</th>
                <th>Producto(s)</th>
                <th>Precio(s)</th>
                <th>Proximo Cobro</th>
                <th>ID Asesor</th>
                <th>Asesor</th>
                <th>Email Asesor</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>