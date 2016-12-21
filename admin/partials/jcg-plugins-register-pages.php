<?php
  add_menu_page(
    'Theme Options',              // ID
    'Theme Options',              // Page Title
    'manage_options',             // Menu Title
    'jcg_options',                // Capabilities
    'render_theme_options_pages', // Callback
    'dashicons-hammer'
  );

  add_submenu_page(
    'jcg_options',                // ID
    'About',                      // Page Title
    'About',                      // Menu Title
    'manage_options',             // Capabilities
    'jcg_about',                  // Menu Slug
    'render_theme_options_pages'  // Callback
  );

  add_submenu_page(
    'upload.php',                 // ID
    'Flickr',                     // Page Title
    'Flickr',                     // Menu Title
    'manage_options',             // Capabilities
    'jcg_flickr',                 // Menu Slug
    'render_flickr'               // Callback
  );

  function render_theme_options_pages() {
    require_once 'jcg-plugins-options-page.php';
  }

  function render_flickr() {
    require_once 'flickr/jcg-plugins-flickr.php';
  }
