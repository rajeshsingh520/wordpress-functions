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


/** For PRO VERSION */

/**
 * Deactivate the proversion if free version is not available
 */
if(!pi_edd_free_check()) {
    function pi_edd_pro_notice(){
        global $pagenow;
        if ( true ) {
             echo '<div class="notice notice-warning is-dismissible">
                 <p>FREE version is needed for the working of Pro CSS JS Manager. so install it from this link <a href="https://wordpress.org/plugins/estimate-delivery-date-for-woocommerce/" target="_blank">Download</a></p>
             </div>';
        }
    }
    add_action('admin_notices', 'pi_edd_pro_notice');
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}


/**
 * Checking Pro version, this goes in free version
 */
function pi_dcw_pro_check(){
	if(is_plugin_active( 'pi-dcw-pro/pi-dcw-pro.php')){
		return true;
	}
	return false;
}

/**
 * Checking Free version, this goes in pro version
 */
function pi_dcw_free_check(){
	if(is_plugin_active( 'pi-dcw/pi-dcw.php')){
		return true;
	}
	return false;
}
