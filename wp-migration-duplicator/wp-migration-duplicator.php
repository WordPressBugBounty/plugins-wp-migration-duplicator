<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://www.webtoffee.com/
 * @since             1.0.0
 * @package           Wp_Migration_Duplicator
 *
 * @wordpress-plugin
 * Plugin Name:       WebToffee WP Backup and Migration
 * Plugin URI:        https://wordpress.org/plugins/wp-migration-duplicator/
 * Description:       Migrate WordPress contents and database quickly with ease.
 * Version:           1.5.8
 * Author:            WebToffee
 * Author URI:        https://www.webtoffee.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wp-migration-duplicator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if(!defined('WP_MIGRATION_DUPLICATOR_VERSION')) //check plugin file already included
{
    define('WT_MGDP_PLUGIN_DEVELOPMENT_MODE', false );
    define('WT_MGDP_PLUGIN_BASENAME', plugin_basename(__FILE__) );
    define('WT_MGDP_PLUGIN_PATH', plugin_dir_path(__FILE__) );
    define('WT_MGDP_PLUGIN_URL', plugin_dir_url(__FILE__));
    define('WT_MGDP_PLUGIN_FILENAME',__FILE__);
    define('WT_MGDP_POST_TYPE','wp_migration_duplicator');
    define('WT_MGDP_DOMAIN','wp-migration-duplicator');
    define('WT_MGDP_CLOUD_STORAGE_LOCATION','webtoffee_migrations');

    /**
     * Currently plugin version.
     */
    define('WP_MIGRATION_DUPLICATOR_VERSION', '1.5.8' );
}
if ( !defined( 'WT_MGDP_PLUGIN_DEBUG_BASIC_TROUBLESHOOT' ) ) {
	define( 'WT_MGDP_PLUGIN_DEBUG_BASIC_TROUBLESHOOT', 'https://www.webtoffee.com/finding-php-error-logs-in-migrator-plugin/' );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-migration-duplicator-activator.php
 */
function activate_wp_migration_duplicator() {
    if (is_plugin_active('wp-migration-duplicator-pro/wp-migration-duplicator-pro.php')) {
        // translators: 1: support link
        wp_die(sprintf(esc_html__("Is everything fine? You already have the Premium version installed in your website. For any issues, kindly raise a ticket via %s", "wp-migration-duplicator"), "<a target='_blank' href='https://www.webtoffee.com/support/'>support</a>"), "", array('back_link' => 1));
    }else{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-migration-duplicator-activator.php';
	Wp_Migration_Duplicator_Activator::activate();
    }
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-migration-duplicator-deactivator.php
 */
function deactivate_wp_migration_duplicator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-migration-duplicator-deactivator.php';
        @delete_option( 'wt_mgdp_options' );
	Wp_Migration_Duplicator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_migration_duplicator' );
register_deactivation_hook( __FILE__, 'deactivate_wp_migration_duplicator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_migration_duplicator() {

 if( !function_exists('is_plugin_active') ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 }

 if (!is_plugin_active('wp-migration-duplicator-pro/wp-migration-duplicator-pro.php')) {
        require plugin_dir_path( __FILE__ ) . 'includes/class-wp-migration-duplicator.php';
	$plugin = new Wp_Migration_Duplicator();
	$plugin->run();
 }

}

/* Plugin page links */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wt_wp_migration_duplicator_plugin_action_links_basic' );

function wt_wp_migration_duplicator_plugin_action_links_basic( $links ) {

    $plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wp-migration-duplicator' ) . '">' . esc_html__( 'Settings', 'wp-migration-duplicator' ) . '</a>',
		'<a href="https://www.webtoffee.com/wordpress-backup-migration-user-guide/" target="_blank">' . esc_html__( 'Documentation', 'wp-migration-duplicator' ) . '</a>',
                '<a href="https://wordpress.org/support/plugin/wp-migration-duplicator/#new-topic-0" target="_blank">' . esc_html__( 'Support', 'wp-migration-duplicator' ) . '</a>',
                '<a href="https://www.webtoffee.com/plugins/" target="_blank"  style="color:#3db634;">' . esc_html__( 'Premium Plugins', 'wp-migration-duplicator' ) . '</a>',
                '<a target="_blank" style="color:#f909ff;" href="https://wordpress.org/support/plugin/wp-migration-duplicator/reviews#new-post">' . esc_html__( 'Review', 'wp-migration-duplicator' ) . '</a>',
            );

	if ( array_key_exists( 'deactivate', $links ) ) {
		$links[ 'deactivate' ] = str_replace( '<a', '<a class="wtmigrator-deactivate-link"', $links[ 'deactivate' ] );
	}
	return array_merge( $plugin_links, $links );
}

// Add dismissible server info for file restrictions
include_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-migration-non-apache-info.php';
$inform_server_secure					 = new Wt_Mgdb_Inform_Server_Secure( 'Migration' );
$inform_server_secure->plugin_title		 = "WebToffee WP Backup and Migration";

/**
* Missing plugins warning.
*/
add_action( 'admin_notices',  'wt_missing_plugins_warning');
if(!function_exists('wt_missing_plugins_warning')){
    function wt_missing_plugins_warning() {
        $screen = get_current_screen();
        if ( $screen->id !== 'toplevel_page_wp-migration-duplicator'){
            return;
        }else{
            if(!extension_loaded('zip') && !extension_loaded('zlib')){
                /* Display the notice*/
                $class = 'notice notice-error';
                // translators: 1:  opening bold tag, 2: closing bold tag, 3: opening bold tag, 4: closing bold tag                
               printf( '<div class="%s"><p>%s</p></div>', esc_attr( $class ), ( sprintf(esc_html__('%1$s WebToffee WP Backup and Migration %2$s has been activated. To ensure proper functioning, kindly enable the %3$s ZipArchive extension %4$s in server. ', 'wp-migration-duplicator'), '<b>', '</b>', '<b>', '</b>')) );

            }
        }
    }
}
run_wp_migration_duplicator();
