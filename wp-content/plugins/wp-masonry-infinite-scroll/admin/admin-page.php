<?php
if(!defined('WMIS_ENGINE')) {
   die('404');
}

function wmis_admin_page() {
	add_menu_page(
			__( 'WMIS', 'wmis' ),
			__( 'WMIS', 'wmis' ),
			'manage_options',
			'wmis',
			'wmis_admin_page_contents',
			'dashicons-schedule',
			20
	);
}
add_action( 'admin_menu', 'wmis_admin_page' );


function wmis_admin_page_contents() {
?>
<h1 style="text-align:center;margin-top:2%;">
<a href="https://wporbit.net" target="_blank"><img src="<?php echo plugins_url( '../images/wpfavicon.png' , __FILE__ ); ?>" style="width: 80px;margin: 0 auto 2%;"></a>
<br>WordPress Masonry &amp; Infinite Scroll</h1>

<div class="wmis_admin_main_container">
<div class="wmis_admin_col_1">
    
    <div class="shortcode_container">
        <h2 style="margin:0;">Shortcode Generator</h2>
        <p>Use this shortcode generator to create your own customised masonry layout and paste it into the page you want to convert to blog/posts page.
        <b><span style="color:#cc0000;">Important:</span> Infinite scrolling may produce incorrect results while previewing the page. Please save the page before previewing it.</b>
        </p>
        <form onsubmit="return wmis_generate_shortcode();" id="shortcode_generator_form" action="#">
            <div class="wmis_section_group">
                <h3>Post Type Settings</h3>
                <div class="wmis_form_group">
                <label>Choose Post Type</label>
                    <select name="wmis_posttype">
                    <option value="">--</option>
                    <?php
                    $wmis_all_post_types = get_post_types();
                    foreach($wmis_all_post_types as $single_wmis_post_type){
                        echo '<option value="'.$single_wmis_post_type.'">'.$single_wmis_post_type.'</option>';
                    }
                    ?>
                    </select>
                </div>
                
                <div class="wmis_form_group">
                <label>Choose Post Status</label>
                    <select name="wmis_poststatus">
                    <option value="">--</option>
                    <option value="inherit">inherit</option>
                    <?php
                    $wmis_all_post_statuses = array_keys(get_post_statuses());
                    foreach($wmis_all_post_statuses as $single_wmis_post_status){
                        echo '<option value="'.$single_wmis_post_status.'">'.$single_wmis_post_status.'</option>';
                    }
                    ?>
                    </select>
                    Choose inherit for Media Post Type. Leave blank for others.
                </div>
                
                <div class="wmis_form_group">
                    <label>Number of items per load</label>
                    <input name="wmis_postperpage" placeholder="9" type="number" value=""/>  
                </div>
                
                <div class="wmis_form_group">
                    <label>Comma Separated Post IDs </label>
                    <input name="wmis_ids" type="text" placeholder ="1,2,3" value=""/> (Fill only if you want to show particular posts)
                </div>
				
				
                <div class="wmis_form_group">
                    <label>Order</label>
                    <select name="wmis_postorder">
                    <option value="DESC">DESC</option>
					<option value="ASC">ASC</option>
                    </select>
                </div>
				
                <div class="wmis_form_group">
                    <label>Order By</label>
                    <select name="wmis_postorderby">
						
							<option value="date">Date</option>
							<option value="ID">Post ID</option>
							<option value="author">Author ID</option>
							<option value="title">Title</option>
							<option value="name">Permalink / Slug</option>
							<option value="modified">Date Modified</option>
							<option value="rand">Random</option>
							<option value="comment_count">Comment Count</option>
							<option value="menu_order">Menu Order</option>
						
                    </select>
                </div>
                
            </div> 
            
            <div class="wmis_section_group">
                <h3>Category / Taxonomy Settings</h3>
                
                <div class="wmis_form_group">
                    <label>Choose Category</label>
                    <select multiple="multiple"  name="wmis_category">
                    <option value="">All</option>
                    <?php
                    $wmis_all_cats = get_categories();
                    print_r($wmis_all_cats);
                    foreach($wmis_all_cats as $wmis_single_cat){
                        echo '<option value="'.$wmis_single_cat->cat_ID.'">'.$wmis_single_cat->slug.'</option>';
                    }
                    ?>
                    </select>  
                    (Leave as is if you are not sure.) 
                </div>  
                
                <div class="wmis_form_group">
                    <label>Taxonomy</label>
                    <select name="wmis_taxonomyname">
                    <option value="">--</option>
                    <?php
                    $wmis_all_tax = get_taxonomies();
                    foreach($wmis_all_tax as $wmis_single_tax){
                        echo '<option value="'.$wmis_single_tax.'">'.$wmis_single_tax.'</option>';
                    }
                    ?>
                    </select>
                    (Leave as is if you are not sure.) 
                </div>  
                                
                <div class="wmis_form_group">
                    <label>Taxonomy Terms</label>
                    <select multiple="multiple"  name="wmis_taxonomyslug">
                    <?php
                    foreach($wmis_all_tax as $wmis_single_tax){
                    echo '<optgroup label="'.$wmis_single_tax.'">';
                    $wmis_all_terms = get_terms(array('taxonomy' => $wmis_single_tax));
                    foreach($wmis_all_terms as $wmis_single_term){
                        echo '<option value="'.$wmis_single_term->slug.'">'.$wmis_single_term->slug.'</option>';
                    }
                    echo '</optgroup>';
                    }
                    

                    ?>
                    </select>
                    (Leave as is if you are not sure.) 
                </div>
                

        </div>
            
            
            
        <div class="wmis_section_group">
                <h3>Masonry Items Look & Feel</h3>
                
                <div class="wmis_form_group">
                    <label>Masonry Grid Boxes Background Color</label>
                    <input type="text"  name="wmis_cardbackground" placeholder ="Eg: #333333" value=""/>  (Only HEX color codes.)
                </div>
                
                <div class="wmis_form_group">
                    <label>Masonry Columns on Desktop</label>
                    <input type="number" value="" placeholder="3" name="wmis_columns"/>  
                </div>
                
                <div class="wmis_form_group">
                    <label>Masonry Columns on Mobile</label>
                    <input type="number" value="" placeholder="1" name="wmis_mobilecolumns"/>  
                </div>
                
                
                <div class="wmis_form_group">
                    <label>Scroll Threshold</label>
                    Load new items when user scrolls to <input type="number" value="" name="wmis_loadingoffset"/> Pixels from bottom of loaded articles.
                </div>
                
                <div class="wmis_form_group">
                    <label>No More Items Text</label>
                    <input type="text" value="" placeholder="No More Posts." name="wmis_nomoreposts"/> 
                </div>
                
                
                <div class="wmis_form_group">
                    <label>Animated Loading Icon Color</label>
                    <input type="text" placeholder ="Eg: #333333" value="" name="wmis_animateloadercolor"/>  (Only HEX color codes.)
                </div>
                
        </div>
        
        
        
        
        
        <div class="wmis_section_group">
                <h3>Post Image Settings</h3>
                
                <div class="wmis_form_group">
                    <label>Display Post Image?</label>
                    <input type="radio" value="1" name="wmis_showimage"> YES<br>
                    <input type="radio" value="0" name="wmis_showimage"> NO
                </div>
                
                <div class="wmis_form_group">
                    <label>Post Image Size</label>
                    <select name="wmis_thumbsize">
                    <option value="">--</option>
                    <?php
                    $wmis_thumbnails = get_intermediate_image_sizes();
                    foreach($wmis_thumbnails as $wmis_thumbnails_single){
                        echo '<option value="'.$wmis_thumbnails_single.'">'.$wmis_thumbnails_single.'</option>';
                    }
                    ?>
                    </select> 
                </div>
                
        </div>
        
        <div class="wmis_section_group">
                <h3>Post Title Settings</h3>
                
                <div class="wmis_form_group">
                    <label>Display Title?</label>
                    <input type="radio" value="1" name="wmis_showtitle"> YES<br>
                    <input type="radio" value="0" name="wmis_showtitle"> NO
                </div>
                
                <div class="wmis_form_group">
                    <label>Title Font Size</label>
                    <input type="text" placeholder ="22" name="wmis_titlesize" value=""/> (Enter font size in pixels. Without 'px')
                </div>
                
                <div class="wmis_form_group">
                    <label>Title Font Color</label>
                    <input type="text" placeholder ="#333333" name="wmis_titlecolor" value=""/>  (Only HEX color codes.)
                </div>

                <div class="wmis_form_group">
                    <label>Title Tag</label>
                    <input type="text" name="wmis_headingtype" placeholder ="Eg: h2 or h3" value=""/>
                </div>
</div>
        <div class="wmis_section_group">
                <h3>Post Date Settings</h3>
                
                <div class="wmis_form_group">
                    <label>Display Date?</label>
                    <input type="radio" value="1" name="wmis_showdate"> YES<br>
                    <input type="radio" value="0" name="wmis_showdate"> NO
                </div>
                
                <div class="wmis_form_group">
                    <label>Date Font Size</label>
                    <input type="text" placeholder ="22" name="wmis_datesize" value=""/> (Enter font size in pixels. Without 'px')
                </div> 
                
                <div class="wmis_form_group">
                    <label>Date Color</label>
                    <input type="text" placeholder ="#333333" name="wmis_datecolor" value=""/> (Only HEX color codes.)
                </div> 
                
</div>
        <div class="wmis_section_group">
                <h3>Post Excerpt Settings</h3>
                
                <div class="wmis_form_group">
                    <label>Display Excerpt?</label>
                    <input type="radio" value="1" name="wmis_showexcerpt"> YES<br>
                    <input type="radio" value="0" name="wmis_showexcerpt"> NO
                </div>
                
                <div class="wmis_form_group">
                    <label>Excerpt Font Size</label>
                    <input type="text" placeholder ="22" name="wmis_excerptsize" value=""/> (Enter font size in pixels. Without 'px')
                </div>
                
                <div class="wmis_form_group">
                    <label>Excerpt Color</label>
                    <input type="text" placeholder ="#333333" name="wmis_excerptcolor" value=""/> (Only HEX color codes.)
                </div>
    </div>
    
            <div class="wmis_section_group">
                <h3>Read More Link Settings</h3>
                
                <div class="wmis_form_group">
                    <label>Display Read More Link?</label>
                    <input type="radio" value="1" name="wmis_showreadmore"> YES<br>
                    <input type="radio" value="0" name="wmis_showreadmore"> NO
                </div>
                
                <div class="wmis_form_group">
                    <label>Read More Link Font Size</label>
                    <input type="text" placeholder ="22" name="wmis_readmoresize" value=""/> (Enter font size in pixels. Without 'px')
                </div>
                
                <div class="wmis_form_group">
                    <label>Read More Link Color</label>
                    <input type="text" placeholder ="#333333" name="wmis_readmorecolor" value=""/> (Only HEX color codes.)
                </div>
                
                <div class="wmis_form_group">
                    <label>Read More Link Text</label>
                    <input type="text" placeholder ="Read More" name="wmis_readmore" value=""/>
                </div> 
                
                <div class="wmis_form_group">
                    <label>Open all Post Links in New tab</label>
                    <input type="radio" value="1" name="wmis_openinnewtab"> YES<br>
                    <input type="radio" value="0" name="wmis_openinnewtab"> NO
                </div>

        </div>
                
                
        <div class="wmis_section_group">
                <h3>Load More Button</h3>
                <p>Enable this only if you want to disable automatic infinite loading and enable a custom button that triggers loading of next posts.</p>
                
                <div class="wmis_form_group">
                    <label>Enable Load More Button?</label>
                    <input type="radio" value="1" name="wmis_loadmorebutton"> YES<br>
                    <input type="radio" value="0" name="wmis_loadmorebutton"> NO
                </div>
                
                <div class="wmis_form_group">
                    <label>Load More Button Size</label>
                    <select name="wmis_loadmoresize">
                        <option value="" selected>--</option>
                        <option value="large">Large</option>
                        <option value="medium">Medium</option>
                        <option value="small">Small</option>
                    </select>
                </div> 
                
                <div class="wmis_form_group">
                    <label>Load More Text</label>
                    <input type="text" placeholder ="Load More" name="wmis_loadmorebuttontext" value=""/>
                </div> 
                
                <div class="wmis_form_group">
                    <label>Load More Text Color</label>
                    <input type="text" placeholder ="#ffffff" name="wmis_loadmorecolor" value=""/> (Only HEX color codes.)
                </div>
                
                
                <div class="wmis_form_group">
                    <label>Load More Background</label>
                    <input type="text" placeholder ="#333333" name="wmis_loadmorebackground" value=""/> (Only HEX color codes.)
                </div> 
                
        </div>
                
                <button class="shortcodebutton" type="submit">GENERATE SHORTCODE</button>
        </form>
        
        <input type="text" id="generated_shortcode" onfocus="this.select();" readonly="readonly" value="[wmis]" placeholder="Result..." style="margin: 3% 0 0;width: 100%;">
        <label>Copy and paste the above shortcode into the page you want to convert into masonry layout.</label>

</div>
    
    
    
</div>
<div class="wmis_admin_col_2">
<a href="https://wporbit.net" target="_blank"><img src="<?php echo plugins_url( '../images/logo.png' , __FILE__ ); ?>" style="width: 100%;max-width: 200px;margin: 1% auto 6%;display: block;"></a>
<h3 style="color:#333;">Looking for WordPress Support & Maintenance? </h3>
<p>We offer WordPress Maintenance and Tech Support for bloggers & business owners. Our custom plans are tailor-made to save you time so you can focus on building the blog/site of your dreams!</p>
<p><a class="wmis_button" style="display:block;width:100%;box-sizing:border-box;border-radius:4px;text-align:center;color:#fff;" target="_blank" href="https://wporbit.net/">Starts $29/mo</a></p>
</div>

<div class="wmis_admin_col_2">
    <h3 style="color:#333;margin-top:0;">Quick Shortcodes</h3>
    
    <span class="wmis_shortcode">
    <label>Basic usage with default blog posts.</label>
    <input type="text" onfocus="this.select();" readonly="readonly" value="[wmis]"></span>
    <hr>
    
    <span class="wmis_shortcode">
    <label>Changing number of blog posts per page load.</label>
    <input type="text" onfocus="this.select();" readonly="readonly" value='[wmis postperpage="12"]'></span>
    <hr>
    
    <span class="wmis_shortcode">
    <label>Showing only specific category posts by Category ID parameter.</label>
    <input type="text" onfocus="this.select();" readonly="readonly" value='[wmis category="16,18"]'></span>
    <hr>
    
    <span class="wmis_shortcode">
    <label>Changing number of columns in the masonry grid on desktop and mobile.</label>
    <input type="text" onfocus="this.select();" readonly="readonly" value='[wmis columns="4" mobilecolumns="2"]'></span>
    <hr>    
    
    <span class="wmis_shortcode">
    <label>Displaying or hiding image, title, date, excerpt and read more by 1 & 0.</label>
    <input type="text" onfocus="this.select();" readonly="readonly" value='[wmis showimage="1" showtitle="0" showdate="0" showexcerpt="0" showreadmore="0"]'></span>
    <hr>   
    
    <span class="wmis_shortcode">
    <label>Disable auto infinite scroll & enable Load More button.</label>
    <input type="text" onfocus="this.select();" readonly="readonly" value='[wmis loadmorebutton="1"]'></span>
    
</div>


<div class="wmis_admin_col_2">
    <h3 style="color:#333;margin-top:0;text-align: center;">Love this Plugin?</h3>
    <span class="dashicons dashicons-smiley" style="font-size: 100px;display: block;text-align: center;width: 100%;height: auto;color: #002e6a;"></span>
    <p style="text-align: center;">Review it on WordPress.org</p>
<p style="text-align: center;"><a href="https://wordpress.org/support/plugin/wp-masonry-infinite-scroll/" style="background: gold;text-decoration: none;padding: 9px 30px;color: #003366;border-radius: 30px;border-bottom: solid 2px #dbb900;font-weight: 500;display: block;max-width: 150px;text-align: center;margin: auto;" target="_blank">Review</a></p>
</div>


</div>
<script>
function wmis_generate_shortcode(){
        var wmis_shortcode_array = [];
        var wmis_shortcodeform = document.getElementById('shortcode_generator_form');
            for ( var i = 0; i < wmis_shortcodeform.elements.length; i++ ) {
                var wmis_elements = wmis_shortcodeform.elements[i];
                if(wmis_elements.value != ''){
                if(wmis_elements.type == 'radio' && wmis_elements.checked == false){continue;}
                if(wmis_elements.type == 'select-multiple'){
                    wmis_shortcode_array.push((wmis_elements.name).replace('wmis_','') + '="'+ wmis_multiselect(wmis_elements) +'"');
                    continue;
                }
                    wmis_shortcode_array.push((wmis_elements.name).replace('wmis_','') + '="'+ wmis_elements.value +'"');
                }   
            }
        if(wmis_shortcode_array.length == 0){
            var final_wmis_shortcode = '[wmis]';
        }
        else{
            var final_wmis_shortcode = '[wmis '+wmis_shortcode_array.join(" ")+']';
        }
        
        document.getElementById('generated_shortcode').value = final_wmis_shortcode;
        return false;
}
function wmis_multiselect(select) {
  var wmis_result = [];
  var wmis_options = select && select.options;
  var wmis_opt;

  for (var i=0, iLen=wmis_options.length; i<iLen; i++) {
    wmis_opt = wmis_options[i];

    if (wmis_opt.selected) {
      wmis_result.push(wmis_opt.value || wmis_opt.text);
    }
  }
  return wmis_result.join(',');
}
</script>
<style>
    .wmis_admin_main_container h2{
        font-size: 22px;
    }
    
    .wmis_admin_main_container p{
        font-size: 15px;
    }
    .wmis_admin_col_1,.wmis_admin_col_2{
    box-sizing: border-box;
    padding: 2%;
    }
    .wmis_admin_col_1{
    width: 70%;
    background: #fff;
    border-radius: 4px;
    min-height: 300px;
    margin: 1%;
    float: left;
    }
    .wmis_admin_col_2{
    width: 26%;
    background: #fff;
    border-radius: 4px;
    margin: 1%;
    float: left;
    }
   .wmis_cform input,.wmis_cform textarea{
    width: 100%;
    margin-bottom: 10px;
    border: solid 1px #ccc;
    border-radius: 4px;
    }
    .wmis_cform input[type="submit"],.shortcodebutton,.wmis_button{
    background: #cc0000;
    color: #fff;
    border: 0;
    padding: 10px 20px;
    cursor: pointer;
    display:inline-block;
    text-decoration:none;
    }
    .shortcode_container{
        border:solid 1px #ddd;
        padding: 2%;
        border-radius: 4px;
    }
    
    .wmis_section_group{
    border: solid 1px #ddd;
    padding: 3% 2.5%;
    background: #f5f5f5;
    margin-bottom: 30px;
    position: relative;
    border-radius: 6px;
    }
    
    .wmis_section_group h3{
         color:#fff;
         margin: 0;
         position: absolute;
         right: 0;
         top: 0;
         background: #333;
         padding: 4px 8px 6px;
         font-size: 14px;
         border-bottom-left-radius: 4px;
         border-top-right-radius: 4px;
    }

    .wmis_form_group{
        margin-bottom:15px;
        padding-bottom:15px;
        border-bottom:solid 1px #eee;
    }
    
    .wmis_section_group .wmis_form_group:last-of-type{
        margin-bottom:0;
        padding-bottom:0;
        border-bottom:0;
    }
    
    .wmis_form_group label{
        display:block;
        font-weight:bold;
        margin-bottom:5px;
    }
    .wmis_form_group select{
        width: 200px;
    }
    .wmis_shortcode input{
        width:100%;
    }
    .wmis_shortcode label{
        display:block;
        margin-bottom:5px;
    }
</style>
<?php
}
