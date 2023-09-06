<?php
if(!defined('WMIS_ENGINE')) {
   die('404');
}
function wmis_function( $wmis_atts ) {
    
    $default_wmis_params = array(
		    'ids' => '',
		    'category' => '',
		    'posttype' => 'post',
		    'poststatus' => 'publish',
		    'postperpage' => 9,
		    'taxonomyname' => '',
		    'taxonomyslug' => '',
		    'thumbsize' => 'large',
		    'cardbackground' => '#fff',
		    'titlesize' => '22',
		    'titlecolor' => '#333',
		    'datesize' => '16',
		    'datecolor' => '#666',
		    'excerptsize' => '16',
		    'excerptcolor' => '#444',
		    'readmoresize' => '16',
		    'readmorecolor' => '',
		    'columns' => 3,
		    'mobilecolumns' => 1,
		    'readmore' => 'Read More',
		    'showexcerpt' => 0,
		    'showreadmore' => 0,
		    'showtitle' => 1,
		    'showimage' => 1,
		    'showdate' => 1,
		    'openinnewtab' => 0,
		    'headingtype' => 'h2',
		    'nomoreposts' => 'No more posts',
		    'animateloadercolor' => '#85a2b6',
		    'loadmorebutton' => 0,
		    'loadmorebuttontext' => 'Load More',
		    'loadmoresize' => 'medium',
		    'loadmorecolor' => '#333',
		    'loadmorebackground' => '#eee',
		    'loadingoffset' => 10,
			'postorder'			=> 'DESC',
			'postorderby'		=> 'date'
		);

	$wmis_atts = shortcode_atts($default_wmis_params,$wmis_atts,'wmis');

    $wmis_valid_header_tags = array('h1','h2','h3','h4','h5','h6','p','div','span','b');
    $wmis_integer_check_keys = array('postperpage','columns','mobilecolumns','showexcerpt','showreadmore','showtitle','showimage','showdate','openinnewtab','loadmorebutton','loadingoffset','titlesize','datesize','excerptsize','readmoresize');
    $wmis_color_strings = array('cardbackground','titlecolor','datecolor','excerptcolor','readmorecolor','animateloadercolor','loadmorecolor','loadmorebackground');


    $wmisattskeys = array_keys($wmis_atts);
    
    foreach($wmisattskeys as $wmisattskeys_single){
        if($wmis_atts[$wmisattskeys_single] == ''){
            $wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];
        }
        /* STRIP HTML,JS ETC TAGS */
        $wmis_atts[$wmisattskeys_single] = wp_strip_all_tags($wmis_atts[$wmisattskeys_single]);
        
        //SANITIZE & VALIDATE: COMMAS & NUMBERS
        if(in_array($wmisattskeys_single,array('ids','category'))){
        if(!preg_match('/^[0-9,]+$/', $wmis_atts[$wmisattskeys_single])){  $wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];}    
        }
        
        //SANITIZE & VALIDATE: LETTERS,NUMBERS,HYPHEN,UNDERSCORE
        if(in_array($wmisattskeys_single,array('posttype','poststatus','taxonomyname','thumbsize'))){
        if(!preg_match('/^([a-z0-9\_\-]+)$/', $wmis_atts[$wmisattskeys_single])){  $wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];}    
        }
        
        //SANITIZE & VALIDATE: LETTERS,NUMBERS,HYPHEN,UNDERSCORE,COMMA
        if(in_array($wmisattskeys_single,array('taxonomyslug'))){
        if(!preg_match('/^([,a-z0-9\_\-]+)$/', $wmis_atts[$wmisattskeys_single])){  $wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];}    
        }
        
        //SANITIZE & VALIDATE: HASH COLORS
        if(in_array($wmisattskeys_single,$wmis_color_strings)){
        if(!preg_match('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/', $wmis_atts[$wmisattskeys_single])){  $wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];}    
        }
        
        //SANITIZE & VALIDATE: ONLY NUMBERS
        if(in_array($wmisattskeys_single,$wmis_integer_check_keys)){
        if(!preg_match('/^\d+$/', $wmis_atts[$wmisattskeys_single])){  $wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];}    
        }
        
        //SANITIZE & VALIDATE: ONLY TAGS
        if(in_array($wmisattskeys_single,array('headingtype'))){
        if(!in_array($wmis_atts[$wmisattskeys_single],$wmis_valid_header_tags)){$wmis_atts[$wmisattskeys_single] = $default_wmis_params[$wmisattskeys_single];}
        }
        
    }

/* debug
echo '<pre>';
print_r($wmis_atts);
echo '</pre>';
*/
	
	if ($wmis_atts['ids'] != ''){
	    $wmis_idarray = explode(',',$wmis_atts['ids']);
        $wmis_orderarray_loop = array('post__in' => $wmis_idarray, 'orderby' => 'post__in', 'order' => $wmis_atts['postorder']);
	}
	else{
	    $wmis_orderarray_loop = array('orderby' => $wmis_atts['postorderby'], 'order' => $wmis_atts['postorder']);
	}
	
	if ($wmis_atts['category'] != ''){
	    $wmis_catidarray = explode(',',$wmis_atts['category']);
	    $wmis_catidarray_loop = array('category__in' => $wmis_catidarray);
	}
	else{
	    $wmis_catidarray_loop = array();
	}
	

    $wmis_posttype_loop = array('post_type' => $wmis_atts['posttype']);
    
    $wmis_poststatus_loop = array('post_status' => $wmis_atts['poststatus']);

    $wmis_postperpage_loop = array('posts_per_page' => $wmis_atts['postperpage']);
	
	if ($wmis_atts['taxonomyname'] != '' && $wmis_atts['taxonomyslug'] != ''){
	
	$wmis_taxslug_array = explode(',',$wmis_atts['taxonomyslug']);

    $wmis_taxquery_loop = array('tax_query' => array(
            array (
                'taxonomy' => $wmis_atts['taxonomyname'],
                'field' => 'slug',
                'terms' => $wmis_taxslug_array
            )
    ));
    
	}
	else{
	    $wmis_taxquery_loop = array();
	}
	
	
    // Set default page 1
    if(!isset($_GET['wmis_page'])){
        $wmis_pagination = 1;
    }
    else{
        // SANITIZE AND VALIDATE $ GET
        if(filter_var($_GET['wmis_page'], FILTER_VALIDATE_INT)){
            $wmis_pagination = (int)$_GET['wmis_page'];
        }
        else{
            $wmis_pagination = 1;
        }
    }


    $wmis_common_loop = array(
        'paged' => $wmis_pagination,
    );

    $wmis_final_loop = array_merge($wmis_common_loop,$wmis_orderarray_loop,$wmis_catidarray_loop,$wmis_posttype_loop,$wmis_poststatus_loop,$wmis_postperpage_loop,$wmis_taxquery_loop);

    $wmisloop = new WP_Query($wmis_final_loop);

    // Open in new tab
    $openinnewtab = '';
    if($wmis_atts['openinnewtab'] == 1){
        $openinnewtab = ' target="_blank" ';
    }

    // Exit if page number exceeds total pagination
    if($wmis_pagination > $wmisloop->max_num_pages){
        status_header( 404 );
        exit();
    }

  
    $titlestyleprint = 'font-size:'.$wmis_atts['titlesize'].'px;color:'.$wmis_atts['titlecolor'].';';
    
    $datestyleprint = 'font-size:'.$wmis_atts['datesize'].'px;color:'.$wmis_atts['datecolor'].';';
    
    $excerptstyleprint = 'font-size:'.$wmis_atts['excerptsize'].'px;color:'.$wmis_atts['excerptcolor'].';';
    
    $readmorestyleprint = 'font-size:'.$wmis_atts['readmoresize'].'px;color:'.$wmis_atts['readmorecolor'].';';
    
    $loadmorestyleprint = 'color:'.$wmis_atts['loadmorecolor'].';background-color:'.$wmis_atts['loadmorebackground'].';';

    ob_start();
    
    echo '<div class="wmis_main_container">';
    if ($wmisloop->have_posts()){
    while ( $wmisloop->have_posts() ) : $wmisloop->the_post();
    $wmis_featuredimage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $wmis_atts['thumbsize'] );
    $wmis_featuredimagesrc = $wmis_featuredimage[0];
    ?>
    <div class="wmis_articles wmis_col_<?php echo $wmis_atts['columns']; ?> wmis_col_mobile_<?php echo $wmis_atts['mobilecolumns']; ?>" style="background-color:<?php echo $wmis_atts['cardbackground']; ?>">
    <?php if($wmis_atts['showimage'] == 1){ ?><a <?php echo $openinnewtab; ?> class="wmis_image_link" href="<?php echo get_the_permalink(); ?>"><img src="<?php echo $wmis_featuredimagesrc; ?>" class="wmis_featured_image"/></a><?php } ?>
    <div class="wmis_content_container"><?php if($wmis_atts['showtitle'] == 1){ ?><<?php echo $wmis_atts['headingtype']; ?> class="wmis_title"><a style="<?php echo $titlestyleprint; ?>" <?php echo $openinnewtab; ?> class="wmis_title_link" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></<?php echo $wmis_atts['headingtype']; ?>><?php } ?>
<?php if($wmis_atts['showdate'] == 1){ ?><div class="wmis_date" style="<?php echo $datestyleprint; ?>"><?php echo get_the_date('d M Y'); ?></div><?php } ?>
<?php if($wmis_atts['showexcerpt'] == 1){ ?><div class="wmis_excerpt" style="<?php echo $excerptstyleprint; ?>"><?php echo get_the_excerpt(); ?></div><?php } ?>
<?php if($wmis_atts['showreadmore'] == 1){ ?><div class="wmis_readmore"><a class="wmis_readmore_link" style="<?php echo $readmorestyleprint; ?>" <?php echo $openinnewtab; ?> href="<?php echo get_the_permalink(); ?>"><?php echo $wmis_atts['readmore']; ?></a></div><?php } ?></div>
</div>
    <?php
    endwhile;
    }
    echo '</div>';
    ?>

    <div class="wmis-pagination">
        <a href="<?php global $wp; echo home_url($wp->request); ?>/?wmis_page=<?php echo $wmis_pagination + 1; ?>">Next</a>
    </div>
    
    <div class="wmis-page-load-status">
        <div class="infinite-scroll-request">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block;" width="120px" height="120px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <path d="M20 50A30 30 0 0 0 80 50A30 32 0 0 1 20 50" fill="<?php echo $wmis_atts['animateloadercolor']; ?>" stroke="none">
                    <animateTransform attributeName="transform" type="rotate" dur="0.7407407407407407s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51"></animateTransform>
                    </path>
                    </svg>
        </div>
      <div class="infinite-scroll-last"><?php echo $wmis_atts['nomoreposts']; ?></div>
      <div class="infinite-scroll-error"><?php echo $wmis_atts['nomoreposts']; ?></div>
    </div>

    <?php
    if($wmis_atts['loadmorebutton'] == 1){
        echo '<div class="wmis-view-more-button-container"><button style="'.$loadmorestyleprint.'" class="wmis-view-more-button wmis_button_'.$wmis_atts['loadmoresize'].'">'.$wmis_atts['loadmorebuttontext'].'</button></div>';
    }
    ?>


    <script>
    jQuery( document ).ready( function($){

    var $wmiscontainer = $( ".wmis_main_container" );
    $wmiscontainer.imagesLoaded( function() {
		
        $wmiscontainer.isotope({
            itemSelector: '.wmis_articles',
            layoutMode: 'masonry',
            masonry: {
                gutter: 0
            }
		});
	
        
    // get Isotope instance
    var wmisisoinstance = $wmiscontainer.data('isotope');
    $wmiscontainer.infiniteScroll({
        path: '.wmis-pagination a',
        append: '.wmis_articles',
        outlayer: wmisisoinstance,
        scrollThreshold: <?php echo $wmis_atts['loadingoffset']; ?>,
        history: false,
        status: '.wmis-page-load-status',
        hideNav: '.wmis-pagination',
        <?php
    if($wmis_atts['loadmorebutton'] == 1){
        echo 'button: \'.wmis-view-more-button\','.PHP_EOL;
        echo '      scrollThreshold: false,'.PHP_EOL;
    }
    ?>
    });
	});
    
    <?php
    if($wmis_atts['loadmorebutton'] == 1){
    ?>
    var wmislastflag = 0;
    $wmiscontainer.on( 'last.infiniteScroll', function( event, response, path ) {
        $('.wmis-view-more-button').css('visibility','visible');
        wmislastflag =1;
    });
    $wmiscontainer.on( 'append.infiniteScroll', function( event, response, path, items ) {
        if(wmislastflag == 0){
        $('.wmis-view-more-button').css('visibility','visible');
        }
    });
    $(".wmis-view-more-button").on("click",function(){
        $('.wmis-view-more-button').css('visibility','hidden');
    });
    <?php
    }
    ?>
    
    
    });
    </script>
    
    
    <style>
    @media screen and (max-width:1080px){
    .wmis_main_container .wmis_excerpt{
        font-size:<?php echo ceil(($wmis_atts['excerptsize']*90)/100); ?>px !important;
    }
    .wmis_main_container .wmis_readmore_link{
        font-size:<?php echo ceil(($wmis_atts['readmoresize']*90)/100); ?>px !important;
    }
    
    .wmis_main_container .wmis_date{
        font-size:<?php echo ceil(($wmis_atts['datesize']*90)/100); ?>px !important;
    }
    
    .wmis_main_container .wmis_title_link{
        font-size:<?php echo ceil(($wmis_atts['titlesize']*90)/100); ?>px !important;
    }
    }
    
    
    @media screen and (max-width:600px){
    
    .wmis_main_container .wmis_excerpt{
        font-size:<?php echo ceil(($wmis_atts['excerptsize']*80)/100); ?>px !important;
    }
    .wmis_main_container .wmis_readmore_link{
        font-size:<?php echo ceil(($wmis_atts['readmoresize']*80)/100); ?>px !important;
    }
    
    .wmis_main_container .wmis_date{
        font-size:<?php echo ceil(($wmis_atts['datesize']*80)/100); ?>px !important;
    }
    
    .wmis_main_container .wmis_title_link{
        font-size:<?php echo ceil(($wmis_atts['titlesize']*80)/100); ?>px !important;
    }
    
    }
    </style>
    
    
    <?php
    $wmis_output_string = ob_get_contents();
    ob_end_clean();
    return $wmis_output_string;
    }
    add_shortcode( 'wmis', 'wmis_function' );
?>