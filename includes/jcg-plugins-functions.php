<?php

require_once('helpers/Settings.php');

function jcg_get_social() {
  return array(
    'github'   => 'GitHub',
    'vimeo'    => 'Vimeo',
    'youtube'  => 'YouTube',
    'facebook' => 'Facebook',
    'twitter'  => 'Twitter',
    'flickr'   => 'Flickr',
    'linkedin' => 'LinkedIn',
    'imdb'     => 'IMDB'
  );
}

function cv_get_posts_as_multicheck_options($types) {
  global $post;
  $posts = array();

  $query = new WP_Query( array(
    'post_type'      => $types,
    'order'          => 'DESC',
    'orderby'        => 'date',
    'posts_per_page' => -1
  ) );

  while ( $query->have_posts() ) :
    $query->the_post();
    $posts[$post->ID] = '[' . $post->post_type . '] ' . $post->post_title;
  endwhile;

  return $posts;
}
