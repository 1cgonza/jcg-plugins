<?php
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
  remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //
  // removing plugin dashboard boxes
  remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget

  $general = new JCG_Settings('general_section', '', '', 'jcg_options', 'jcg_theme_options');
  $general->addField(
    'default_image',
    'Default Image',
    'jcg_render_default_image'
  );

  $general->addField(
    'jcg_options_description',
    'Default description',
    'jcg_render_option_description'
  );

  /*==========  ABOUT  ==========*/
  $about = new JCG_Settings('about_section', '', '', 'jcg_about', 'jcg_about_bio');
  $about->addField(
    'jcg_about_contact',
    'Contact',
    'jcg_render_contact'
  );

  $about->addField(
    'jcg_about_social',
    'Social Links',
    'jcg_render_social'
  );

  $about->addField(
    'jcg_about_bio',
    'Bio Academic',
    'jcg_render_bio'
  );

  $about->addField(
    'jcg_about_bio_bio',
    'Bio Biographical',
    'jcg_render_bio_bio'
  );

  /*==========  CALLBACK FUNCTIONS  ==========*/
  function jcg_render_option_description() {
    require_once dirname( __FILE__ ) . '/options/display-section-description.php';
  }

  function jcg_render_default_image() {
    require_once dirname( __FILE__ ) . '/options/display-section-default-image.php';
  }

  function jcg_render_contact() {
    require_once dirname( __FILE__ ) . '/options/display-section-contact.php';
  }

  function jcg_render_social() {
    require_once dirname( __FILE__ ) . '/options/display-section-social.php';
  }

  function jcg_render_bio() {
    require_once dirname( __FILE__ ) . '/options/display-section-bio.php';
  }

  function jcg_render_bio_bio() {
    require_once dirname( __FILE__ ) . '/options/display-section-bio-bio.php';
  }
