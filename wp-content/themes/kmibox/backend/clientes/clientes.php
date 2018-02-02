<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/clientes/clientes.css'>
<script src='<?php echo TEMA(); ?>/backend/clientes/clientes.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Clientes</h2> <hr>
    </div>

<!-- 	<div class="botones_container">
	    <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Producto" data-modulo="productos" data-modal="nuevo" data-id="" class="button button-primary button-large" />
	</div> -->

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Registro</th>
                <th>Nombre y Apellido</th>
                <th>Email</th>
                <th>Tel&eacute;fono</th>
                <th>Donde nos conocio?</th>
                <th>Usuario Kmimos</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>