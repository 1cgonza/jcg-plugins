<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://juancgonzalez.com
 * @since      1.0.0
 *
 * @package    JCG_Plugins
 * @subpackage JCG_Plugins/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    JCG_Plugins
 * @subpackage JCG_Plugins/includes
 * @author     Juan Camilo Gonzalez <info@juancgonzalez.com>
 */
class JCG_Plugins {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      JCG_Plugins_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {
    $this->plugin_name = 'jcg-plugins';
    $this->version = '1.0.0';

    $this->load_dependencies();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jcg-plugins-loader.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jcg-plugins-admin.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/cv/class-jcg-plugins-cv.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-jcg-plugins-public.php';

    $this->loader = new JCG_Plugins_Loader();
  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks() {
    $plugin_admin = new JCG_Plugins_Admin( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'init', $plugin_admin, 'register_post_types' );
    $this->loader->add_action( 'admin_menu', $plugin_admin, 'register_theme_options_pages' );
    $this->loader->add_action( 'admin_init', $plugin_admin, 'init_theme_options' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    $this->loader->add_action( 'login_enqueue_scripts', $plugin_admin, 'enqueue_login_styles' );

    $this->loader->add_filter( 'login_headerurl', $plugin_admin, 'login_url' );
    $this->loader->add_filter( 'login_headertitle', $plugin_admin, 'login_title' );
    $this->loader->add_filter( 'pre_get_posts', $plugin_admin, 'add_custom_types_to_archives' );
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks() {
    $plugin_public = new JCG_Plugins_Public( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    JCG_Plugins_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

}
