<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/asesores_niveles/asesores_niveles.css'>
<script src='<?php echo TEMA(); ?>/backend/asesores_niveles/asesores_niveles.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Asesores</h2> <hr>
    </div>

    <div class="botones_container">
        <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Asesor" data-modulo="asesores_niveles" data-modal="nuevo" data-id="" class="button button-primary button-large" />

        <input type='button' value='EXCEL' id='excel' data-modulo="asesores_niveles" data-file="asesores_niveles" class="button button-primary button-large" />
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>Orden</th>
                <th>Nivel</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Bono</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>