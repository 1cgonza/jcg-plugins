<?php

/**
 * @link              http://juancgonzalez.com
 * @since             1.0.0
 * @package           JCG_Plugins
 *
 * @wordpress-plugin
 * Plugin Name:       JCG Plugins
 * Plugin URI:        https://github.com/1cgonza/wp-jcg-plugins
 * Description:       A set of plugins and theme options for a portfolio website.
 * Version:           1.0.1
 * Author:            Juan Camilo Gonzalez
 * Author URI:        http://juancgonzalez.com
 * GitHub Plugin URI: https://github.com/1cgonza/jcg-plugins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jcg-plugins
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_jcg_plugins() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jcg-plugins-activator.php';
	JCG_Plugins_Activator::activate();
}

function deactivate_jcg_plugins() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jcg-plugins-deactivator.php';
	JCG_Plugins_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jcg_plugins' );
register_deactivation_hook( __FILE__, 'deactivate_jcg_plugins' );

require plugin_dir_path( __FILE__ ) . 'includes/class-jcg-plugins.php';

/**
 * @since    1.0.0
 */
function run_jcg_plugins() {
	$plugin = new JCG_Plugins();
	$plugin->run();
}
run_jcg_plugins();