<?php


//////////////////////////////////////////////////////////////////////////////////////

/////////////////////      wplocalplus custom meta box           /////////////////////////

//////////////////////////////////////////////////////////////////////////////////////

/* Define the custom box */
add_action('add_meta_boxes', 'localgrid_metaboxlist');

/* Do something with the data entered */

/* Adds a box to the main column on the Post and Page edit screens */
function localgrid_metaboxlist() {
    add_meta_box( 'localgrid_sectionid', __( 'localgrid', 'localgrid_textdomain' ),'localgrid_meta_box', 'post','side',"high" );
    add_meta_box( 'localgrid_sectionid', __( 'localgrid', 'localgrid_textdomain' ),'localgrid_meta_box', 'page','side',"high" );
   
}

/* Prints the box content */
function localgrid_meta_box() {

    global $post;
    global $wpdb;
 	$citygridlist_table = $wpdb->prefix . "citygrid_list";
    $shadobox_table = $wpdb->prefix . "wplocal_shadoboxs";
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="localgrid_noncename" id="localgrid_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	
	// Get the location data if its already been entered
	$citygridlist  = get_post_meta($post->ID, 'citygridlist', true);
  	$popup_keyword  = get_post_meta($post->ID, 'popup_keyword', true);
    $popup_text  = get_post_meta($post->ID, 'popup_text', true);
  	$popup_text_link  = get_post_meta($post->ID, 'popup_text_link', true);
    $shadoboxlist  = get_post_meta($post->ID, 'shadoboxlist', true);
    
    
  	
    $sql = "SELECT * FROM $citygridlist_table ";
    
    $slider_list = $wpdb->get_results($sql);
    
    
    $sql = "SELECT * FROM $shadobox_table ";
    
    $shadobox_list = $wpdb->get_results($sql);
    
    // slider1
    
    if($slider_list){
        echo "<p><strong>Business List</strong></p>" ;
        echo "<p><select  name='citygridlist' id='citygridlist' style='width:260px'>"; 
        echo "<option value='' >Select Your Citygrid List</option>";               
        foreach($slider_list as $row){
            
            if($citygridlist==$row->id)
                echo "<option value='".$row->id."' selected >".$row->name."</option>";
            else
                echo "<option value='".$row->id."'>".$row->name."</option>";
        }
        echo "</select></p>";
    }
    
        
    echo "<br/><br/><p>Add the shortcode  <code>[localgrid]</code> in your post where you want to display it .</p>"; 
	// Echo out the field
    

   
   
 

}



// color meta box  

function localgrid_color_box(){
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="wpslise2see_noncename_color" id="wpslise2see_noncename_color" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the location data if its already been entered
    echo "<p>Color <input type='text' name='localgrid_popup_color' value='".get_option("localgrid_popup_color")."' id= 'localgrid_popup_color' /></p><p><small>Example : 39A5E3</small></p>"; 
    // Echo out the field

}


function localgrid_meta_box_save($post_id, $post) {
 
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['localgrid_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}
    
   
	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
 
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
    
   
    
    //echo $_POST['citygridlist2']."<<<<";die;
   	$events_meta['citygridlist']  = $_POST['citygridlist'];
    $events_meta['popup_keyword']  = $_POST['popup_keyword'];
    $events_meta['popup_text']  = $_POST['popup_text'];
    $events_meta['popup_text_link']  = $_POST['popup_text_link'];
    $events_meta['shadoboxlist']  = $_POST['shadoboxlist'];
    
   
    //$events_meta['localgrid_popup_color']  = $_POST['localgrid_popup_color'];
    update_option("localgrid_popup_color",$_POST['localgrid_popup_color']);
    
    
    
    //print_r($_POST);die;
    
   // $events_meta['homeArticle']     = $_POST['homeArticle'];
	// Add values of $events_meta as custom fields
 
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
 
}
 
add_action('save_post', 'localgrid_meta_box_save', 1, 2); // save the custom fields



?>