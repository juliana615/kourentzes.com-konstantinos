<?php
/*
Plugin Name: WP Masonry & Infinite Scroll
Description: Highly customizable shortcodes to create pages with beautiful masonry layout and infinite scrolling effect. Supports posts, pages, media, CPT & Taxonomies.
Version: 2.0
Author: Kaushik Somaiya
Author URI: https://wporbit.net
Text Domain: wp-masonry-infinite-scroll
License: GPL2
*/

    define('WMIS_ENGINE',1);

    require_once plugin_dir_path( __FILE__ ) . '/includes/functions.php';
    require_once plugin_dir_path( __FILE__ ) . '/admin/admin-page.php';

    add_action( 'wp_enqueue_scripts', 'wmis_plugtohead' );
    function wmis_plugtohead() {
        wp_enqueue_script('jquery');
        wp_enqueue_style( 'wmis-style', plugins_url( '/css/wmis.css' , __FILE__ ));
        wp_enqueue_script( 'wmis-jquery-infinitescroll-min', plugins_url( '/js/infinite-scroll.pkgd.min.js' , __FILE__ ));
        wp_enqueue_script( 'wmis-isotope-pkgd-min', plugins_url( '/js/isotope.pkgd.min.js' , __FILE__ ));
		wp_enqueue_script( 'wmis-imagesloaded-pkgd-min', plugins_url( '/js/imagesloaded.pkgd.min.js' , __FILE__ ));
    }
?>