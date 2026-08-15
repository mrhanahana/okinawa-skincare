<?php
/************************************************************************************** 
/* cssをインポート */
/**************************************************************************************/
function child_enqueue_assets() {
  /* FontAwesome */
  wp_enqueue_style(
    'fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
    array(),
    '6.5.2'
  );
	
  wp_enqueue_style(
    'parent-style',
    get_template_directory_uri() . '/style.css'
  );

  wp_enqueue_style(
    'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array( 'parent-style' )
  );

  wp_enqueue_style(
    'component',
    get_stylesheet_directory_uri() . '/css/component.css',
    array( 'child-style' ),
    filemtime( get_stylesheet_directory() . '/css/component.css' )
  );

  wp_enqueue_style(
    'utility',
    get_stylesheet_directory_uri() . '/css/utility.css',
    array( 'component' ),
    filemtime( get_stylesheet_directory() . '/css/utility.css' )
  );

  wp_enqueue_style(
    'child-custom',
    get_stylesheet_directory_uri() . '/css/custom.css',
    array( 'utility' ),
    filemtime( get_stylesheet_directory() . '/css/custom.css' )
  );

  wp_enqueue_style(
    'child-page',
    get_stylesheet_directory_uri() . '/css/page.css',
    array( 'child-custom' ),
    filemtime( get_stylesheet_directory() . '/css/page.css' )
  );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_assets', 20 );