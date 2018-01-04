<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/tipos/tipos.css'>
<script src='<?php echo TEMA(); ?>/backend/tipos/tipos.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Tipos de Mascotas</h2> <hr>
    </div>

	<div class="botones_container">
	    <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Tipo de Mascota" data-modulo="tipos" data-modal="nuevo" data-id="" class="button button-primary button-large" />
	</div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Tipo</th>
                <th style="width: 80px;">Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>