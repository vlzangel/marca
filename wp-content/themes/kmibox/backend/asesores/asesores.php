<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/asesores/asesores.css'>
<script src='<?php echo TEMA(); ?>/backend/asesores/asesores.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Asesores</h2> <hr>
    </div>

    <div class="botones_container">
        <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Asesor" data-modulo="asesores" data-modal="nuevo" data-id="" class="button button-primary button-large" />

        <input type='button' value='EXCEL' id='excel' data-modulo="asesores" data-file="asesores" class="button button-primary button-large" />
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>ID</th>
                <th>C&oacute;digo</th>
                <th>Nombre y Apellido</th>
                <th>Email</th>
                <th>Tel&eacute;fono</th>
                <th>Total Puntos</th>
                <th>Asesor Padre</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>