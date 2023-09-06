<?php
/*
Plugin Name: Google Cloud Vision Image Description
Description: Adds a button to update descriptions for selected images using Google Cloud Vision. Apparently this is how WP handles infodata. 
Version: 1.0 yeeee it worked
*/

// Enqueue custom JavaScript for Media Library
function enqueue_custom_js_for_media_library($hook) {
    if ($hook == 'upload.php' || $hook == 'media-upload.php') {
        wp_enqueue_script('custom-media-library-js', plugin_dir_url(__FILE__) . 'custom-media-library.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'enqueue_custom_js_for_media_library');

