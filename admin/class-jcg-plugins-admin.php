<?php

class JCG_Plugins_Admin {
  private $plugin_name;
  private $version;

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

  public function enqueue_styles() {
    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jcg-plugins-admin.min.css', array(), $this->version, 'all' );
  }

  public function enqueue_login_styles() {
    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jcg-plugins-login.min.css', array(), $this->version, 'all' );
  }

  public function enqueue_scripts($page) {
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jcg-plugins-admin.js', array( 'jquery' ), $this->version, 'all' );

    if ( $page == 'toplevel_page_jcg_options' ) {
      wp_enqueue_media();
      wp_enqueue_script( $this->plugin_name . '-upload', plugin_dir_url(__FILE__) . 'js/jcg-plugins-upload.js', array( 'jquery' ), $this->version, 'all' );
    }
  }
}
