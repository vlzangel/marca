<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/cupones/cupones.css'>
<script src='<?php echo TEMA(); ?>/backend/cupones/cupones.js'></script>


<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/lib/datapicker/jquery.datepick.css'>
<script src='<?php echo TEMA(); ?>/lib/datapicker/jquery.plugin.js'></script>
<script src='<?php echo TEMA(); ?>/lib/datapicker/jquery.datepick.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Cupones</h2> <hr>
    </div>

	<div class="botones_container">
	    <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Cup&oacute;n" data-modulo="cupones" data-modal="nuevo" data-id="" class="button button-primary button-large" />
	</div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Nombre</th>
                <th>Importe del cup&oacute;n</th>
                <th>N° de Usos</th>
                <th>Informaci&oacute;n</th>
                <th style="width: 80px;">Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>