/* 
    Making sure woocommerce is there 
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(!is_plugin_active( 'woocommerce/woocommerce.php')){
    function pi_edd_my_error_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'Please Install and Activate WooCommerce plugin, without that this plugin cant work', 'pi-edd' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'pi_edd_my_error_notice' );
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}

/* buy link and buy price */
define('PISOL_RESTAURANT_MENU_BUY_URL', 'https://www.piwebsolution.com/cart/?add-to-cart=574&variation_id=675');
define('PI_EDD_PRICE', '<u>$15 Only</u>');
