<?php

class JCG_Plugins {
  protected $loader;
  protected $plugin_name;
  protected $version;

  public function __construct() {
    $this->plugin_name = 'jcg-plugins';
    $this->version = '1.0.0';

    $this->load_dependencies();
    $this->define_admin_hooks();
  }

  private function load_dependencies() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/jcg-plugins-functions.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jcg-plugins-loader.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jcg-plugins-admin.php';
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/cv/class-jcg-plugins-cv.php';

    $this->loader = new JCG_Plugins_Loader();
  }

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

  public function run() {
    $this->loader->run();
  }

  public function get_plugin_name() {
    return $this->plugin_name;
  }

  public function get_loader() {
    return $this->loader;
  }

  public function get_version() {
    return $this->version;
  }
}
