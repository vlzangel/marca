<link rel='stylesheet' type='text/css' href='<?php echo TEMA() ?>/backend/subscribers/subscribers.css'>
<script src='<?php echo TEMA(); ?>/backend/subscribers/subscribers.js'></script>

<div class="container_listados">

    <div class='titulos'>
        <h2>Control de Lista y Suscriptores</h2> <hr>
    </div>

<!-- 	<div class="botones_container">
	    <input type='button' value='Nuevo' onClick='abrir_link( jQuery(this) )'  data-titulo="Nuevo Producto" data-modulo="productos" data-modal="nuevo" data-id="" class="button button-primary button-large" />
	</div> -->

    <table id="subscribers" class="table table-striped table-bordered nowrap" cellspacing="0" style="min-width: 100%;" >
        <thead>
            <tr> 
                <th>Fecha</th>
                <th>Email</th>
                <th>Tel&eacute;fono</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
 