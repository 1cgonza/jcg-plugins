<?php
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
  remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //
  // removing plugin dashboard boxes
  remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget

  add_settings_section(
    'general_section',    // ID for the section
    '',                   // Title which renders on the page
    '',                   // Callback function
    'jcg_options'         // The page where this section is rendered
  );

  add_settings_field(
    'default_image',
    'Default Image',
    'jcg_render_default_image',
    'jcg_options',
    'general_section'
  );

  add_settings_field(
    'jcg_options_description',
    'Default description',
    'jcg_render_option_description',
    'jcg_options',
    'general_section'
  );

  register_setting(
    'general_section',
    'jcg_theme_options'
  );

  /*==========  ABOUT  ==========*/
  add_settings_section(
    'about_section',      // ID for the section
    '',                   // Title which renders on the page
    '',                   // Callback function
    'jcg_about'           // The page where this section is rendered
  );

  add_settings_field(
    'jcg_about_contact',
    'Contact',
    'jcg_render_contact',
    'jcg_about',
    'about_section'
  );

  add_settings_field(
    'jcg_about_social',
    'Social Links',
    'jcg_render_social',
    'jcg_about',
    'about_section'
  );

  add_settings_field(
    'jcg_about_bio',
    'Bio Academic',
    'jcg_render_bio',
    'jcg_about',
    'about_section'
  );

  add_settings_field(
    'jcg_about_bio_bio',
    'Bio Biographical',
    'jcg_render_bio_bio',
    'jcg_about',
    'about_section'
  );

  register_setting(
    'about_section',
    'jcg_about_options'
  );

  /*==========  CALLBACK FUNCTIONS  ==========*/
  function jcg_render_option_description() {
    $options = (array)get_option('jcg_theme_options');
    $description = !empty($options['description']) ? $options['description'] : '';

    echo '<textarea name="jcg_theme_options[description]" cols="80" rows="10">' . $description . '</textarea>';
  }

  function jcg_render_default_image() {
    $options = (array)get_option('jcg_theme_options');
    $profileImage = !empty($options['image']) ? $options['image'] : '';
    ?>
      <div id="profile-image-container" class="hidden">
        <img id="profile-image" src="" alt="" title="" />
      </div>
      <input id="profile-image-input" type="hidden" name="jcg_theme_options[image]" id="jcg_theme_options_image" value="<?php echo $profileImage ?>" />
      <p class="hide-if-no-js">
        <a title="Set Default Image" href="javascript:;" id="assign-profile-image">Set Default Image</a>
      </p>
    <?php
  }

  function jcg_render_contact() {
    $options = (array)get_option('jcg_about_options');
    $email = !empty($options['email']) ? $options['email'] : '';
    $phone = !empty($options['phone']) ? $options['phone'] : '';

    $contact = '<label for="jcg_about_options_phone">Phone: </label>';
    $contact .= '<input id="jcg_about_options_phone" class="regular-text" type="tel" name="jcg_about_options[phone]" value="' . $phone . '">';
    $contact .= '<br /><br />';
    $contact .= '<label for="jcg_about_options_email">Email: </label>';
    $contact .= '<input id="jcg_about_options_email" class="regular-text" type="tel" name="jcg_about_options[email]" value="' . $email . '">';

    echo $contact;
  }

  function jcg_render_social() {
    $options = (array)get_option('jcg_about_options');
    $socialAccounts = array(
      'github'   => 'GitHub',
      'vimeo'    => 'Vimeo',
      'youtube'  => 'YouTube',
      'facebook' => 'Facebook',
      'twitter'  => 'Twitter',
      'flickr'   => 'Flickr',
      'linkedin' => 'LinkedIn',
      'imdb'     => 'IMDB'
    );

    $social = '';

    foreach ($socialAccounts as $slug => $name) {
      $value = !empty($options[$slug]) ? $options[$slug] : '';
      $social .= '<label for="jcg_about_options_' . $slug . '">' . $name . ': </label>';
      $social .= '<input id="jcg_about_options_' . $slug . '" class="regular-text" type="text" name="jcg_about_options[' . $slug . ']" value="' . $value . '">';
      $social .= '<br /><br />';
    }

    echo $social;
  }

  function jcg_render_bio() {
    $options = (array)get_option('jcg_about_options');
    $bio = !empty($options['bio']) ? $options['bio'] : '';

    $settings = array(
      'media_buttons' => false,
      'textarea_name' => 'jcg_about_options[bio]'
    );
    wp_editor($bio, 'jcg_about_options_bio', $settings);
  }

  function jcg_render_bio_bio() {
    $options = (array)get_option('jcg_about_options');
    $bio = !empty($options['bio_bio']) ? $options['bio_bio'] : '';

    $settings = array(
      'media_buttons' => false,
      'textarea_name' => 'jcg_about_options[bio_bio]'
    );
    wp_editor($bio, 'jcg_about_options_bio_bio', $settings);
  }