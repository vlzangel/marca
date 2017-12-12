<?php
/**
 * Admin new order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author WooThemes
 * @package WooCommerce/Templates/Emails/HTML
 * @version 2.5.0
 */

$resumen = get_resumen();
$user =  get_user_info();
$email = $user['email'];
$subtotal = $resumen['subtotal'];
$total = $resumen['total'];
$cantidad = $resumen['cant_item']; 
$direccion = $user['calle'];
$telefono = $user['telef_movil'];
$nombre = $user['display_name'];
$producto = $resumen ['kmibox']['size'];
$precio =0; 

 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }
print_r(expression);
 include( realpath( __DIR__ . '/../../template/email/pedido_completado.php' ) );
              wp_mail(
                $email,
                "Pago por tarjeta", 
                $HTML
              );