<?php

class JCG_Plugins_Admin {
  private $plugin_name;
  private $version;

  public function __construct($plugin_name, $version) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  public function edit_cv_meta_columns($columns) {
    $columns = array(
      'cb'            => '<input type="checkbox" />',
      'title'         => 'CV Item',
      'country'       => 'Country',
      'project'       => 'Project',
      'cv_categories' => 'CV Categories',
      'date'          => 'Date'
    );
    return $columns;
  }

  public function manage_cv_meta_columns($column, $post_id) {
    global $post;

    if ($column == 'country') {
      $country = get_post_meta($post_id, '_cv_country', true);
      echo empty($country) ? 'Unknown' : $country;
    } elseif ($column == 'project') {
      $films       = get_post_meta($post_id, '_cv_related_project', true);
      $ret = '';

      if ( !empty($films) ) {
        foreach ($films as $film) {
          $ret .= '<a href="' . get_permalink($film) . '">' . get_the_title($film) . '</a><br />';
        }
      }
      echo $ret;
    } elseif ($column == 'cv_categories') {
      $terms = get_the_terms($post_id, 'cv_cat');
      
      if ( empty($terms) ) {
        echo 'No CV Categories';
      } else {
        $termsReturn = '';
        foreach ($terms as $term) {
          $url = esc_url( add_query_arg( array('post_type' => $post->post_type, 'cv_cat' => $term->slug), 'edit.php' ) );
          $termsReturn .= '<a href="' . $url . '">' . $term->name . '</a><br />';
        }
        echo $termsReturn;
      }
    }
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

  public function cv_metaboxes() {
    if ( !function_exists('new_cmb2_box') ) {
      return;
    }

    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/plugins/cv/cv.php';
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
