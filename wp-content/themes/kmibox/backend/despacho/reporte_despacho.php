<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/despacho/despacho.css'>
<script src='<?php echo TEMA(); ?>/backend/despacho/despacho.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Productos</h2> <hr>
    </div>

	<div class="botones_container">
	    <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Producto" data-modulo="despacho" data-modal="nuevo" data-id="" class="button button-primary button-large" />
	</div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>Orden</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Presentaci&oacute;n</th>
                <th>Plan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>