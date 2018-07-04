<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/despacho/despacho.css'>
<script src='<?php echo TEMA(); ?>/backend/despacho/despacho.js'></script>

<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/lib/datapicker/jquery.datepick.css'>
<script src='<?php echo TEMA(); ?>/lib/datapicker/jquery.plugin.js'></script>
<script src='<?php echo TEMA(); ?>/lib/datapicker/jquery.datepick.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Despachos</h2> <hr>
    </div>

	<div class="botones_container">
        <input type='button' value='EXCEL' id='excel' data-modulo="despacho" data-file="despacho" class="button button-primary button-large" />
        <input type='button' value='HISTORICO' onclick="location.href = '<?php echo HOME()."/wp-admin/admin.php?page=despacho&all=yes"; ?>';" class="button button-primary button-large" />
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Orden</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Compa&ntilde;ia de Env&iacute;o</th>
                <th>Gu&iacute;a de Rastreo</th>
                <th>Fecha Env&iacute;o</th>
                <th>Fecha Entrega</th>
                <th>Tiempo de Entrega</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php
    include_once( dirname(__DIR__).'/recursos/modal.php' );
?>

<script type="text/javascript">
    <?php
        $url = "var URL_DESPACHOS = TEMA+'/backend/despacho/ajax/despacho.php';";
        if( $_GET["all"] == "yes" ){
            $url = "var URL_DESPACHOS = TEMA+'/backend/despacho/ajax/despacho.php?all=yes';";
        }
        echo $url;
    ?>
</script>