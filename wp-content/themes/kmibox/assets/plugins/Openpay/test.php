<?php
	require_once('Openpay.php');
	$openpay = Openpay::getInstance('mbkjg8ctidvv84gb8gan', 'sk_883157978fc44604996f264016e6fcb7');
	$customer = $openpay->customers->get( 'aemf5bsy5oktuvjgjy8a' );
?>
<pre>
	<?php #print_r( $customer->subscriptions->get( 'sdjralke0xu0nyxiss1d' ) ); ?>
	<?php print_r( $customer->charges->getList( [ 'limit' => 2000] ) ); ?>
</pre>
