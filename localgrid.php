<?php
/*
Plugin Name: LocalGrid
Plugin URI: http://localgrid.cannylab.com
Description: Make your site as best place for local business directory , deals and review .
Version: 1.0
Author: cannylab
Author URI: http://cannylab.com
Author email: imran.aspire@gmail.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/*----------------------------------------------------------------------------------------------------
					D E C L E A R I N G     V A R I A B L E S
----------------------------------------------------------------------------------------------------*/

if ( ! defined( 'LG_CONTENT_URL' ) ) define( 'LG_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'LG_CONTENT_DIR' ) ) define( 'LG_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'LG_PLUGIN_URL'  ) ) define( 'LG_PLUGIN_URL',  LG_CONTENT_URL. '/plugins' );
if ( ! defined( 'LG_PLUGIN_DIR'  ) ) define( 'LG_PLUGIN_DIR',  LG_CONTENT_DIR . '/plugins' );
if ( ! defined( 'MY_PLUGIN_DIR'  ) ) define( 'MY_PLUGIN_DIR',  LG_CONTENT_DIR . '/plugins/localgrid' );



//admin user level
$localgrid_plugin_access = 8;  

//including files
include_once(dirname(__FILE__).'/include/functions.php');
include_once(dirname(__FILE__).'/include/router.php');
include_once(dirname(__FILE__).'/include/install.php');
include_once(dirname(__FILE__).'/include/meta-box.php');
include_once(dirname(__FILE__).'/include/show-content.php');
include_once(dirname(__FILE__).'/include/gmap.php');
include_once(dirname(__FILE__).'/include/zipcode-shoertcode.php');
include_once(dirname(__FILE__).'/include/allcity.php');



/*----------------------------------------------------------------------------------------------------
									A D M I N     M E N U
----------------------------------------------------------------------------------------------------*/



function localgrid_menu() {
	
    $mymenu = new localgrid_option();    
}


add_action('admin_menu', 'localgrid_menu');

class localgrid_option
{
    public function __construct()
    {
        // the method that handles all requests
       $request_handler = array( $this, 'request_handler' );
       global $localgrid_plugin_access;
       // wordpress functions to add menus and submenus
       add_menu_page(__( 'LocalGrid'),__( 'LocalGrid'),$localgrid_plugin_access,'localgrid_option',$request_handler,LG_PLUGIN_URL."/localgrid/images/localgrid.png");
       add_submenu_page('localgrid_option',  __( 'Business List' ), __( 'Business List' ), $localgrid_plugin_access, 'wplocal_citygridlist', $request_handler );
    
    }
 
    /*The request handler function that declares the needed vars and calls
      the router*/
    public function request_handler()
    {
        
        /*as mentioned, we use the page as the controller*/
        $controller = $_GET['page'];
        /*and the action variable for the method*/
       
        $action = $_GET['action'];
 
        // we add a small check to see if the page requested is this
         //  controller
        if( $controller == get_class( $this ) )
        {
            // if it is, we can use the instance of this controller instead
            $controller = $this;
        }
 
        // now the params. All the other get variables
        $params = $_GET;
 
        // we can remove the page and action variables first
        unset( $params['page'] );
        unset( $params['action'] );
 
        // finally! let's set up data for the router
        $route = array( $controller, $action, $params );
       // print_r($route);
        // we are using the instance of this class as the default controller
        $default_controller = $this;
 
        // the default method - Kohana 2 style!
        $default_method = 'index';
       

        if(is_string($route[0]) && file_exists( MY_PLUGIN_DIR."/modules/".$route[0].".php"))
            include_once("modules/".$route[0].".php");
        
        $router = new localgrid_Router( $route, $default_controller, $default_method );
        
         //print_r($route);die;

    }
    
    /* since this is the default controller,
    we should set up the default method here as well*/
 
    public function index( $args = NULL )
    {
        if(isset($_POST['wplocalsettings_submit'])&& $_POST['localgrid_citygrid_publisher_key']!=""){
            update_option("localgrid_citygrid_publisher_key",$_POST['localgrid_citygrid_publisher_key']);
        }
        if(isset($_POST['customization_update'])){
             update_option("localgrid_title_color",$_POST['localgrid_title_color']);
             update_option("localgrid_title_size",$_POST['localgrid_title_size']);
             update_option("localgrid_title_format",$_POST['localgrid_title_format']);

             update_option("localgrid_biztitle_color",$_POST['localgrid_biztitle_color']);
             update_option("localgrid_biztitle_size",$_POST['localgrid_biztitle_size']);
             update_option("localgrid_biztitle_format",$_POST['localgrid_biztitle_format']);

             update_option("localgrid_prh_color",$_POST['localgrid_prh_color']);
             update_option("localgrid_prh_size",$_POST['localgrid_prh_size']);
             update_option("localgrid_prh_format",$_POST['localgrid_prh_format']);

             update_option("localgrid_short_text_color",$_POST['localgrid_short_text_color']);
             update_option("localgrid_short_text_size",$_POST['localgrid_short_text_size']);
             update_option("localgrid_short_text_format",$_POST['localgrid_short_text_format']);

             update_option("localgrid_link_color",$_POST['localgrid_link_color']);
             update_option("localgrid_link_size",$_POST['localgrid_link_size']);
             update_option("localgrid_link_format",$_POST['localgrid_link_format']);

            
             update_option("localgrid_seperator_color",$_POST['localgrid_seperator_color']);
             update_option("localgrid_popup_color",$_POST['localgrid_popup_color']);
             
             
             update_option("localgrid_feature_title_color",$_POST['localgrid_feature_title_color']);
             update_option("localgrid_feature_bg_color",$_POST['localgrid_feature_bg_color']);
             update_option("localgrid_feature_saparotor_color",$_POST['localgrid_feature_saparotor_color']);
             update_option("localgrid_feature_text_color",$_POST['localgrid_feature_text_color']);
            
             

        }
        if(isset($_POST['customization_restore'])){
             update_option("localgrid_title_color",get_option("re_localgrid_title_color"));
             update_option("localgrid_title_size",get_option('re_localgrid_title_size'));
             update_option("localgrid_title_format",get_option('re_localgrid_title_format'));

             update_option("localgrid_biztitle_color",get_option('re_localgrid_biztitle_color'));
             update_option("localgrid_biztitle_size",get_option('re_localgrid_biztitle_size'));
             update_option("localgrid_biztitle_format",get_option('re_localgrid_biztitle_format'));

             update_option("localgrid_prh_color",get_option('re_localgrid_prh_color'));
             update_option("localgrid_prh_size",get_option('re_localgrid_prh_size'));
             update_option("localgrid_prh_format",get_option('re_localgrid_prh_format'));

             update_option("localgrid_short_text_color",get_option('re_localgrid_short_text_color'));
             update_option("localgrid_short_text_size",get_option('re_localgrid_short_text_size'));
             update_option("localgrid_short_text_format",get_option('re_localgrid_short_text_format'));

             update_option("localgrid_link_color",get_option('re_localgrid_link_color'));
             update_option("localgrid_link_size",get_option('re_localgrid_link_size'));
             update_option("localgrid_link_format",get_option('re_localgrid_link_format'));

            
             update_option("localgrid_seperator_color",get_option('re_localgrid_seperator_color'));
             update_option("localgrid_popup_color",get_option('re_localgrid_popup_color'));
             
             
             
             update_option("localgrid_feature_title_color",get_option('re_localgrid_feature_title_color'));
             update_option("localgrid_feature_bg_color",get_option('re_localgrid_feature_bg_color'));
             update_option("localgrid_feature_saparotor_color",get_option('re_localgrid_feature_saparotor_color'));
             update_option("localgrid_feature_text_color",get_option('re_localgrid_feature_text_color'));
             
             
             
             
                
        }
    ?>
        <div id="poststuff" class="metabox-holder has-right-sidebar" style="width: 900px;">
        <h2>LocalGrid</h2>  
      
         <div class="postbox " style="">
            <h3 class="hndle" ><span>CityGrid</span></h3>
            <div class="inside" style="width: 800px;overflow: hidden;">
            <form method="post" action="">
                <p>
                    <label>Citygrid Publisher Key</label>
                    <input type="text" name="localgrid_citygrid_publisher_key" value="<?php echo get_option('localgrid_citygrid_publisher_key') ?>" />
                    <small style="color: red;">You need to add your own citygrid publisher key</small>
                </p>
                <p><a href="http://developer.citygridmedia.com/dashboard/registration" target="_blank">get the citygrid publisher key</a></p>
                <p><input type="submit" name="wplocalsettings_submit" value="Update" /></p>
            </form>    
            </div>
            
        </div>
        
          
        
        <div class="postbox " style="float:left;width:100%">
            <h3 class="hndle" ><span>Customization </span></h3>
            <div class="inside" style="float: left;">
                <form action="" method="post">
                    <p><strong>Title </strong> </p>
                    <p>
                     Color 
                        <input type="text" class="color" name="localgrid_title_color" value="<?php echo get_option("localgrid_title_color"); ?>" />
                        Size <input class="side2" type="text" name="localgrid_title_size" value="<?php echo get_option("localgrid_title_size"); ?>" />
                        Format :    <input  type="radio" <?php if(get_option("localgrid_title_format")=="normal") echo 'checked=""' ?>  value="normal" name="localgrid_title_format" /> normal 
                                    <input value="italic"  <?php if(get_option("localgrid_title_format")=="italic") echo 'checked=""' ?>  name="localgrid_title_format" type="radio" /> italic
                         
                    </p>
                    <p><strong>Business Title </strong> </p>
                    <p>
                        Color 
                        <input type="text" class="color" name="localgrid_biztitle_color" value="<?php echo get_option("localgrid_biztitle_color"); ?>" />
                        Size <input class="side2" type="text" name="localgrid_biztitle_size" value="<?php echo get_option("localgrid_biztitle_size"); ?>" />
                        Format :    <input  type="radio" <?php if(get_option("localgrid_biztitle_format")=="normal") echo 'checked=""' ?>  value="normal" name="localgrid_biztitle_format" /> normal 
                                    <input value="italic"  <?php if(get_option("localgrid_biztitle_format")=="italic") echo 'checked=""' ?>  name="localgrid_biztitle_format" type="radio" /> italic
                         
                    </p>
                    <p><strong>Paragraph</strong> </p>
                    <p>
                        Color 
                        <input type="text" class="color" name="localgrid_prh_color" value="<?php echo get_option("localgrid_prh_color"); ?>" />
                        Size <input class="side2" type="text" name="localgrid_prh_size" value="<?php echo get_option("localgrid_prh_size"); ?>" />
                        Format :    <input   <?php if(get_option("localgrid_prh_format")=="normal") echo 'checked=""' ?>  value="normal" name="localgrid_prh_format" type="radio" /> normal 
                                    <input  <?php if(get_option("localgrid_prh_format")=="italic") echo 'checked=""' ?> value="italic"  name="localgrid_prh_format" type="radio" /> italic
                         
                    </p>
                    <p><strong>Small Text</strong> </p>
                    <p>
                        Color 
                        <input type="text" class="color" name="localgrid_short_text_color" value="<?php echo get_option("localgrid_short_text_color"); ?>" />
                        Size <input class="side2" type="text" name="localgrid_short_text_size" value="<?php echo get_option("localgrid_short_text_size"); ?>" />
                        Format :    <input   <?php if(get_option("localgrid_short_text_format")=="normal") echo 'checked=""' ?>  value="normal" name="localgrid_short_text_format" type="radio" /> normal 
                                    <input  <?php if(get_option("localgrid_short_text_format")=="italic") echo 'checked=""' ?> value="italic"  name="localgrid_short_text_format" type="radio" /> italic
                         
                    </p>
                    <p><strong>Links </strong> </p>
                    <p>
                        Color 
                        <input type="text" class="color" name="localgrid_link_color" value="<?php echo get_option("localgrid_link_color"); ?>" />
                        Size <input class="side2" type="text" name="localgrid_link_size" value="<?php echo get_option("localgrid_link_size"); ?>" />
                        Format :    <input   <?php if(get_option("localgrid_link_format")=="normal") echo 'checked=""' ?>  value="normal" name="localgrid_link_format" type="radio" /> normal 
                                    <input  <?php if(get_option("localgrid_link_format")=="italic") echo 'checked=""' ?> value="italic"  name="localgrid_link_format" type="radio" /> italic
                         
                    </p>
                    <p><strong>Separator  </strong> </p>
                    <p>
                        Color 
                        <input type="text" class="color" name="localgrid_seperator_color" value="<?php echo get_option("localgrid_seperator_color"); ?>" />
                    </p>
                    
                    <p><strong>Popup link   </strong> </p>
                    <p>
                        Color 
                        <input type="text" class="color" name="localgrid_popup_color" value="<?php echo get_option("localgrid_popup_color"); ?>" />
                    </p>
                    
                    <p><strong>Feature AD</strong> </p>
                    <p>
                        Title color
                        <input type="text" class="color" name="localgrid_feature_title_color" value="<?php echo get_option("localgrid_feature_title_color"); ?>" />
                        Background Color 
                        <input class="color" type="text" name="localgrid_feature_bg_color" value="<?php echo get_option("localgrid_feature_bg_color"); ?>" />
                        Separator
                        <input type="text" class="color" name="localgrid_feature_saparotor_color" value="<?php echo get_option("localgrid_feature_saparotor_color"); ?>" />
                        Text Color
                        <input class="color" type="text" name="localgrid_feature_text_color" value="<?php echo get_option("localgrid_feature_text_color"); ?>" />
                         
                    </p>
                    
                    
                    
                    <p><input type="submit" name="customization_update" value="Update" /> 
                        <input style="margin-left: 20px;" type="submit" name="customization_restore" value="Restore Default Value" />  </p>
                </form>
                
            </div>
            <div class="postbox-container" style="float:right;padding-right: 10px;width:280px" >
                <div class="metabox-holder">
                    <div class="meta-box-sortables ui-sortable">
                        <div id="breadcrumsnews" class="postbox">
                        <h3 class="hndle"><span>Latest feed from author's site</span></h3>
                        <div class="inside">
                            <?php
                                $url="http://mdimran.net/feed/";    
                                $news = simplexml_load_file($url);
                                
                                $feed_content = "";
                                $qsp_feed_number=10;
                                $count = 0;
                                echo ' <ul class="pluginbuddy-nodecor">';
                                foreach($news->channel->item as $item) {
                                    if($qsp_feed_number > $count){
                                        echo ' <li>-<a href="'.$item->link .'">'.$item->title .'</a></li>';
                                    }
                                    $count ++ ;
                                }
                                echo '</ul>' ;
                            ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postbox-container" style="float:right;padding-right: 10px;width:280px" >
                <div class="metabox-holder">
                    <div class="meta-box-sortables ui-sortable">
                        <div id="breadcrumsnews" class="postbox">
                        <h3 class="hndle"><span>localGrid Pro</span></h3>
                        <div class="inside">
                            <strong>Comming soon .....</strong>
                            <ul>
                                <li>-  Affiliation programm for CityGrid API services</li>
                                <li>-  You can get paid from CityGrid Custom AD api services</li>
                                <li>-  Add your own feature AD list in the top of the cityGrid Search</li>
                                <li>-  Custom Widget for Deals/Reviews/Places</li>
                            </ul>
                            <p>Keep in touch with <a href="http://cannylab.com">cannyLab</a></p> 
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        
        </div>
        
       
        <div class="postbox " style="clear:both">
            <h3 class="hndle" ><span>How To Use</span></h3>
            <div class="inside" style="width: 800px;overflow: hidden;">
            <h2>Add Business List </h2>
            <ul>
                <li>- To add your own business list you need  to click to Business List in the LocaGrid Tab </li>
                <li>- In here you will get three types of business list Places/Deals/Reviews </li>
                <li>- Add your desire business list just adding what? and where ? </li>
            </ul>

            <h2>How to show the output ?</h2>
            <ul>
                <li>- To Show LocalGrid outout in your  page/post you have to select one of the business list from the dropdown which is right top of the edit page/post .</li>
                <li>- Put the shortcode <code>[localgird]</code> in your content.</li>
            </ul>

            <h2>Custom Search Page</h2>
            <ul>
                <li>- Put the shortcode <code>[localgrid_zipcode]</code> in your content.</li>
            </ul>
            
            <h2>All City with categorywise browse</h2>
            <ul>
                <li>- Put the shortcode <code>[allcity]</code> in your content.</li>
            </ul>
            
            </div>
        </div>
       
          
  
    </div>
    <?php
    }
     
 
}

function localgrid_add_plugin_links($links, $file) {
	
	if ( $file == plugin_basename(__FILE__) ) {
		$links[] = '<a href="http://cannylab.com">LocalGrid Pro Comming soon</a>';
	}
	return $links;
}

add_filter('plugin_row_meta', 'localgrid_add_plugin_links', 10, 2);


?>