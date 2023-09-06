<?php
// compose update google/vision
require_once '../../vendor/autoload.php';

use Google\Cloud\Core\ServiceBuilder;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

// Init google cloud vision API
$config = [
    'keyFile' => json_decode(file_get_contents(__DIR__ . '/konstantinos-kourentzes-com-c9adc5ef1290.json'), true),
    'projectId' => 'konstantinos-kourentzes-com',
];

try {
    //$imageAnnotator = new ImageAnnotatorClient($config);
    // $imageAnnotator = new Google\Cloud\Vision\V1\ImageAnnotatorClient($config);
    $imageAnnotator = new ImageAnnotatorClient();

    // main fn
    function update_image_descriptions($image_id, $image_file, $imageAnnotator) {
        $image = file_get_contents($image_file);
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();
        $image_description = [];

        
        foreach ($labels as $label) {
            $image_description[] = $label->getDescription();
        }

        /*
        Alternate Image description is -> _wp_attachment_image_alt
        Call through WP is -> $image_alt = get_post_meta( $image->id, '_wp_attachment_image_alt', true);
        */
        if ($image_id) {
            $updated = update_post_meta($image_id, '_wp_attachment_image_alt', implode(', ', $image_description));
            if ($updated) {
                echo "Updated alternate text for image: {$image_file}" . PHP_EOL;
            } else {
                echo "Failed to update alternate text for image: {$image_file}" . PHP_EOL;
            }
        }
    }

    //change to do multiples from selected
    $selectedImageIds = isset($_POST['image_ids']) ? $_POST['image_ids'] : array();

    /* 
        
        Constants:
        WP_CONTENT_DIR  // no trailing slash, full paths only
        WP_CONTENT_URL  // full url 
        WP_PLUGIN_DIR  // full path, no trailing slash
        WP_PLUGIN_URL  // full url, no trailing slash
        
    */
    if ( !defined('WP_CONTENT_DIR') )
        define( 'WP_CONTENT_DIR', '../../' );
    $media_directory = WP_CONTENT_DIR . '/uploads/';


    echo("before foreach: ".$selectedImageIds);
    foreach ($selectedImageIds as $image_id) {
        $image_file = get_attached_file($image_id);
        echo("before update_image_descriptions");
        update_image_descriptions($image_id, $image_file, $imageAnnotator);
        echo("after update_image_descriptions");

    }
    echo("after foreach");

    // clean up 
    $imageAnnotator->close();
} catch(Exception $e) {
    echo $e->getMessage();
}
