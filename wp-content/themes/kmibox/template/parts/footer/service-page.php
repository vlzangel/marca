<?php $result = get_products(); ?>

<script type='text/javascript'>
var extras = {}; 
	<?php if(!empty($result['extra'])){ ?>
		extras = $.parseJSON(JSON.stringify(eval( <?php echo $result['product']; ?>)));
	<?php } ?> 	
</script>