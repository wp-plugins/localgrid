<?php
/*----------------------------------------------------------------------------------------------------
							I N S T A L L A T I O N     F U N C T I O N  (  D A T A B A S E  )
----------------------------------------------------------------------------------------------------*/

register_activation_hook( MY_PLUGIN_DIR."/localgrid.php", 'localgrid_plugin_install' );

function localgrid_plugin_install(){
	//echo "SFSDF";die;
    global $wpdb;

	if(!defined('DB_CHARSET') || !($db_charset = DB_CHARSET))
		$db_charset = 'utf8';
	$db_charset = "CHARACTER SET ".$db_charset;
	if(defined('DB_COLLATE') && $db_collate = DB_COLLATE) 
		$db_collate = "COLLATE ".$db_collate;
		
	
    
	$table_name = $wpdb->prefix . "citygrid_list";
	
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
			id          bigint(11) NOT NULL AUTO_INCREMENT,
			name       varchar(555) NOT NULL,
   			date    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
            api_type      tinyint,
            
            city_what       varchar(555) NOT NULL,
   			city_where       varchar(555) NOT NULL,
   			search_type       varchar(555) NOT NULL,
   			sort       varchar(555) NOT NULL,
   			number       INT NOT NULL,
            start_date varchar(555),
            expires_before  varchar(555), 
            customer_only  varchar(555), 
            rating  varchar(555), 
            days  varchar(555), 
            
            
            PRIMARY KEY   (id)
            
		) {$db_charset} {$db_collate};";
		$results = $wpdb->query( $sql );
	}
    
    $table_name = $wpdb->prefix . "wplocal_shadoboxs";
	
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
			id          bigint(11) NOT NULL AUTO_INCREMENT,
			name       varchar(555) NOT NULL,
            height       varchar(555) NOT NULL,
            width       varchar(555) NOT NULL,
   			date    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
            content      TEXT,
            
            PRIMARY KEY   (id)
            
		) {$db_charset} {$db_collate};";
		$results = $wpdb->query( $sql );
	}
    
    
    add_option("citygrid_iteam_perpage",20);
    add_option("citygrid_shadobox_perpage",20);
    add_option("localgrid_citygrid_publisher_key","test");
    
    // customization 
    
        
    add_option("localgrid_title_color","333333");
    add_option("localgrid_title_size","16");
    add_option("localgrid_title_format","normal");
    
    add_option("localgrid_biztitle_color","333333");
    add_option("localgrid_biztitle_size","16");
    add_option("localgrid_biztitle_format","normal");
    
    add_option("localgrid_prh_color","333333");
    add_option("localgrid_prh_size","12");
    add_option("localgrid_prh_format","normal");
    
    add_option("localgrid_short_text_color","918888");
    add_option("localgrid_short_text_size","12");
    add_option("localgrid_short_text_format","normal");
    
    add_option("localgrid_link_color","0066CC");
    add_option("localgrid_link_size","12");
    add_option("localgrid_link_format","normal");
    
    add_option("localgrid_seperator_color","2DC6FF");
    add_option("localgrid_popup_color","0066CC");
    
    
    add_option("localgrid_feature_title_color","0066CC");
    add_option("localgrid_feature_bg_color","E2ECFB");
    add_option("localgrid_feature_saparotor_color","2DC6FF");
    add_option("localgrid_feature_text_color","333333");
    
    
    
    
    // restore default
         
    add_option("re_localgrid_title_color","333333");
    add_option("re_localgrid_title_size","16");
    add_option("re_localgrid_title_format","normal");
    
    add_option("re_localgrid_biztitle_color","333333");
    add_option("re_localgrid_biztitle_size","16");
    add_option("re_localgrid_biztitle_format","normal");
    
    add_option("re_localgrid_prh_color","333333");
    add_option("re_localgrid_prh_size","12");
    add_option("re_localgrid_prh_format","normal");
    
    add_option("re_localgrid_short_text_color","918888");
    add_option("re_localgrid_short_text_size","12");
    add_option("re_localgrid_short_text_format","normal");
    
    add_option("re_localgrid_link_color","0066CC");
    add_option("re_localgrid_link_size","12");
    add_option("re_localgrid_link_format","normal");
    
    add_option("re_localgrid_seperator_color","2DC6FF");
    add_option("re_localgrid_popup_color","0066CC");
    
    
    add_option("re_localgrid_feature_title_color","0066CC");
    add_option("re_localgrid_feature_bg_color","E2ECFB");
    add_option("re_localgrid_feature_saparotor_color","2DC6FF");
    add_option("re_localgrid_feature_text_color","333333");
    
    
    
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ---------------------------------    add script and style   ----------------------------------------------------
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

add_action("init","init_wplocalplus");

function init_wplocalplus() {
    
    error_reporting(0); 
    wp_enqueue_script('jquery');
     
    // citygrid list  script 
    wp_enqueue_script('script',LG_PLUGIN_URL."/localgrid/js/script.js" );
    wp_enqueue_script('script');
    
     // style include 
    wp_enqueue_style('style',LG_PLUGIN_URL."/localgrid/style/style.css" );
    wp_enqueue_style('style');
    
    

    // datepicker script 
    wp_enqueue_script('datepicker',LG_PLUGIN_URL."/localgrid/library/datepicker/js/datepicker.js" );
    wp_enqueue_script('datepicker');
   
    wp_enqueue_script('eye',LG_PLUGIN_URL."/localgrid/library/datepicker/js/eye.js" );
    wp_enqueue_script('eye');
    
    wp_enqueue_script('utils',LG_PLUGIN_URL."/localgrid/library/datepicker/js/utils.js" );
    wp_enqueue_script('utils');
    
   
    // date picker CSS 
    
    wp_enqueue_style('demos',LG_PLUGIN_URL."/localgrid/library/datepicker/css/datepicker.css" );
    wp_enqueue_style('demos');

    
    //fancybox 
    
    
    wp_enqueue_script('fancyboxjs',LG_PLUGIN_URL."/localgrid/library/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js" );
    wp_enqueue_script('fancyboxjs');
    
    wp_enqueue_style('fancyboxcss',LG_PLUGIN_URL."/localgrid/library/fancybox/fancybox/jquery.fancybox-1.3.4.css" );
    wp_enqueue_style('fancyboxcss');

    
    // bubbletip
    
    wp_enqueue_script('bubbletipjs',LG_PLUGIN_URL."/localgrid/library/bubbletip/js/jQuery.bubbletip-1.0.6.js" );
    wp_enqueue_script('bubbletips');
    
    wp_enqueue_style('bubbletipcss',LG_PLUGIN_URL."/localgrid/library/bubbletip/js/bubbletip/bubbletip.css" );
    wp_enqueue_style('bubbletipcss');

    
    // ratings 
    wp_enqueue_script('raty',LG_PLUGIN_URL."/localgrid/library/ratings/js/jquery.raty.min.js" );
    wp_enqueue_script('raty');
    
     // jscolor
    wp_enqueue_script('jscolor',LG_PLUGIN_URL."/localgrid/library/jscolor/jscolor.js" );
    wp_enqueue_script('jscolor');
    

    // gmap3
    wp_enqueue_script('gmap3script',"http://maps.google.com/maps/api/js?sensor=false" );
    wp_enqueue_script('gmap3script');
    
    wp_enqueue_script('gmap3',LG_PLUGIN_URL."/localgrid/library/gmap3/gmap3.js" );
    wp_enqueue_script('gmap3');
    
    
    
}
if($_GET['page']=="wplocal_shadowbox"){
    add_action('admin_init', 'editor_admin_init');
    add_action('admin_head', 'editor_admin_head');
    
} 


function editor_admin_init() {
  wp_enqueue_script('word-count');
  wp_enqueue_script('post');
  wp_enqueue_script('editor');
  wp_enqueue_script('media-upload');
}

function editor_admin_head() {
  wp_tiny_mce();
}



?>