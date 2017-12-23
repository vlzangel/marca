<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/productos/productos.css'>
<script src='<?php echo TEMA(); ?>/backend/productos/productos.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Productos</h2> <hr>
    </div>

	<div class="botones_container">
	    <input type='button' value='Nuevo' 		onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Producto" data-modulo="productos" data-modal="nuevo" data-id="" class="button button-primary button-large" />
	    <input type='button' value='Actualizar' onClick='actualizar()' class="button button-primary button-large" />
	</div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>Imagen</th>
                <th>ID</th>
                <th>Producto</th>
                <th>Tama&ntilde;os Para:</th>
                <th>Edades Para:</th>
                <th>Presentaciones</th>
                <th>Planes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>