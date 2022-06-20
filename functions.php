<?php

require_once( get_theme_file_path('inc/tgm.php') );
require_once( get_theme_file_path('inc/attatchments.php') );

if(site_url() == "http://theme-dev.test/") {
    define( 'VERSION', time() );
} else {
    define( 'VERSION', wp_get_theme()->get( 'Version' ) );
}

function philosophy_theme_setup() {
    load_theme_textdomain( 'philosophy' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-list' ) );
    add_theme_support( 'post-formats', array('image', 'gallery', 'video', 'audio', 'link', 'quote') );
    add_image_size( "philosophy-square-small", 400, 400, true);
    add_editor_style( 'assets/css/editor-style.css' );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    register_nav_menu( 'topmenu', __( 'Top Menu', 'philosophy' ) );
}
add_action( 'after_setup_theme', 'philosophy_theme_setup' );

function philosophy_theme_scripts() {
    wp_enqueue_style( 'fontawesome-css', get_theme_file_uri() . '/assets/css/font-awesome/font-awesome.min.css', null, "1.0" );
    wp_enqueue_style( 'fonts-css', get_theme_file_uri() . '/assets/css/fonts.css', null, "1.0" );
    wp_enqueue_style( 'base-css', get_theme_file_uri() . '/assets/css/base.css', null, "1.0" );
    wp_enqueue_style( 'main-css', get_theme_file_uri() . '/assets/css/main.css', null, "1.0" );
    wp_enqueue_style( 'philosophy-css', get_stylesheet_uri(), null, VERSION );

    wp_enqueue_script( 'modernizr', get_theme_file_uri() . '/assets/js/modernizr.js', null, "1.0", false );
    wp_enqueue_script( 'pace-js', get_theme_file_uri() . '/assets/js/pace.min.js', null, "1.0", false );
    wp_enqueue_script( 'plugins-js', get_theme_file_uri() . '/assets/js/plugins.js', array('jquery'), "1.0", true );
    wp_enqueue_script( 'main-js', get_theme_file_uri() . '/assets/js/main.js', array('jquery'), "1.0", true );
}
add_action( 'wp_enqueue_scripts', 'philosophy_theme_scripts' );

function philosophy_pagination() {
    global $wp_query;

    $links = paginate_links(array(
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'list',
    ));
    $links = str_replace('page-numbers', 'pgn__num', $links);
    $links = str_replace('next pgn__num', 'pgn__next', $links);
    $links = str_replace('prev pgn__num', 'pgn__prev', $links);
	$links = str_replace('<ul class="pgn__num">', '<ul>', $links);
	echo $links;
}