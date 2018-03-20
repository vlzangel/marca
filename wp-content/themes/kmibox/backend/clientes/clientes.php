<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/clientes/clientes.css'>
<script src='<?php echo TEMA(); ?>/backend/clientes/clientes.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Clientes</h2> <hr>
    </div>

    <div class="botones_container">
        <input type='button' value='EXCEL' id='excel' data-modulo="clientes" data-file="clientes" class="button button-primary button-large" />
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Fecha Registro</th>
                <th>Nombre y Apellido</th>
                <th>Email</th>
                <th>Tel&eacute;fono</th>
                <th>Direcci&oacute;n</th>
                <th>Donde nos conocio?</th>
                <th>Usuario Kmimos</th>
                <th>Es Asesor</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>