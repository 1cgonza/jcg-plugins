<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://juancgonzalez.com
 * @since      1.0.0
 *
 * @package    JCG_Plugins
 * @subpackage JCG_Plugins/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    JCG_Plugins
 * @subpackage JCG_Plugins/admin
 * @author     Juan Camilo Gonzalez <info@juancgonzalez.com>
 */
class JCG_Plugins_Admin {
  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  public function register_post_types() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/jcg-plugins-post-types.php';
  }

  public function register_theme_options_pages() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/jcg-plugins-register-pages.php';
  }

  public function init_theme_options() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/jcg-plugins-init-theme-options.php';
  }

  public function login_url() {
    return home_url();
  }

  public function login_title() {
    return get_option('blogname');
  }

  public function add_custom_types_to_archives ($query) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
      $query->set( 'post_type', array(
       'post', 'nav_menu_item', 'films', 'experiments'
      ));
      return $query;
    }
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {
    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jcg-plugins-admin.css', array(), $this->version, 'all' );
  }

  public function enqueue_login_styles() {
    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jcg-plugins-login.css', array(), $this->version, 'all' );
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts($page) {
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jcg-plugins-admin.js', array( 'jquery' ), $this->version, 'all' );

    if ( $page == 'toplevel_page_jcg_options' ) {
      wp_enqueue_media();
      wp_enqueue_script( $this->plugin_name . '-upload', plugin_dir_url(__FILE__) . 'js/jcg-plugins-upload.js', array( 'jquery' ), $this->version, 'all' );
    }
  }

}
