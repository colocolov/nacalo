<?php
/**
 * Enqueue scripts and styles.
 */
function kls_scripts() {
// styles
	//wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'kls-main-css', get_template_directory_uri() . '/assets/css/style.css', array(), date('his') );
	wp_enqueue_style( 'kls-style', get_stylesheet_uri(), array(), _S_VERSION );

// scripts
	wp_enqueue_script( 'jquery' );
	//wp_enqueue_script( 'kls-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	//wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/js/vendor/swiper-bundle.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'kls-main-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), _S_VERSION, true );
	//wp_enqueue_script( 'kls-navigation', get_template_directory_uri() . '/js/myjs.js', array('kls-main-js'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kls_scripts' );