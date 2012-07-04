<?php

// ----------------------   citygridlist shortcode -------------------------------

add_action('wp_head', 'citygridlisthead');


function citygridlisthead(){
    if(is_single() || is_page()){
        add_shortcode("localgrid" ,"citygridlist_show_result");
        add_action('wp_footer', 'localgrid_shadowbox');
        
    }
    else{
        add_shortcode("localgrid" ,"citygridlist_show_result2");
        
        
    }
        
}



// shortcode :  [wplocalplus]   
   

function citygridlist_show_result2($content){
    global $post;
	global $wpdb;
    
    
    
    return $content;
}




function citygridlist_show_result($content){
    global $post;
	global $wpdb;
    global $count;
    $publisher=get_option('localgrid_citygrid_publisher_key');
    $citygridlist_table = $wpdb->prefix . "citygrid_list";
    
    $citygridlist = get_post_meta($post->ID, 'citygridlist', true);
    $popup_keyword = get_post_meta($post->ID, 'popup_keyword', true);
    
    
    $sql = "Select *from $citygridlist_table WHERE  id=".$citygridlist;
    $result=$wpdb->get_row($sql);
	
    $style= '<style>
           
            .locationleft a,.locationleft2 a,.description a,.location a{
                color:#'.get_option("localgrid_link_color").' !important; 
                font-size:'.get_option("localgrid_link_size").'px !important;   
                font-style:'.get_option("localgrid_link_format").' !important;     
            
            }
             .city_title a,.address_title{
                 color:#'.get_option("localgrid_title_color").' !important; 
                 font-size:'.get_option("localgrid_title_size").'px !important;   
                 font-style:'.get_option("localgrid_title_format").' !important;     
            }
            .locationleft label,.locationleft2 label,.contentBox label , .location label{
                color:#'.get_option("localgrid_short_text_color").' !important; 
                font-size:'.get_option("localgrid_short_text_size").'px !important;   
                font-style:'.get_option("localgrid_short_text_format").' !important;     
            
            }
            
            .description{
                color:#'.get_option("localgrid_prh_color").' !important; 
                font-size:'.get_option("localgrid_prh_size").'px !important;   
                font-style:'.get_option("localgrid_prh_format").' !important;     
                
            }
            .business_title a{
                color:#'.get_option("localgrid_biztitle_color").' !important; 
                font-size:'.get_option("localgrid_biztitle_size").'px !important;   
                font-style:'.get_option("localgrid_biztitle_format").' !important;
                text-decoration: none;
                
                
             }
             .business_title2{
                color:#'.get_option("localgrid_biztitle_color").' !important; 
                font-size:'.get_option("localgrid_biztitle_size").'px !important;   
                font-style:'.get_option("localgrid_biztitle_format").' !important;
                float:left; 
                padding-right:5px;    
                
             }
            .location,location2{
                   border-bottom:1px solid #'.get_option("localgrid_seperator_color").' !important; 
             
             }
             
            .featureadbox{
                width:480px;
                padding: 10px;
                clear:both;
                background-color: #'.get_option("localgrid_feature_bg_color").';      
            }
            .featureinnerbox{
                width:auto;
                border-bottom: 1px solid #'.get_option("localgrid_feature_saparotor_color").';
            }
            .featureinnerbox a{
                color:#'.get_option("localgrid_feature_title_color").' !important; 
            }
            .featureinnerbox p{
                margin-bottom: 0px !important;
                
            }
            .featureinnerbox small{
                  color:#'.get_option("localgrid_feature_text_color").' !important; 
             }
            </style>';
    
    
    if($result){
		if($result->api_type==1){
		
			$typestr="";
			if($result->search_type!="")
				$typestr="type=".$result->search_type."&";
			
			$whatstr="";
			if($result->city_what!="")
				$whatstr="what=".$result->city_what."&";
			
			$wherestr="";
			if($result->city_where!="")
				$wherestr="where=".$result->city_where."&";
			
			$rppstr="";
			if($result->number!="")
				$rppstr="rpp=".$result->number."&";
			
            // order filtring 
            $order="";
            if(isset($_POST['filtersubmit'])){ //print_r($_POST);
                if($_POST['order']!=""){
                    $order=$_POST['order'];
                }
            }
            
            $or_s1="";
            if($order=="")
                $or_s1=' selected="selected" ';
            
            $or_s2="";
            if($order=="highestrated")
                $or_s2=' selected="selected" ';
            
            $or_s3="";
            if($order=="alpha")
                $or_s3=' selected="selected" ';
            
            $or_s4="";
            if($order=="mostreviewed")
                $or_s4=' selected="selected" ';
            
            $or_s5="";
            if($order=="dist")
                $or_s5=' selected="selected" ';
            
            $or_s6="";
            if($order=="topmatches")
                $or_s6=' selected="selected" ';
            
            //echo $order.">>>>>";
            $sort_str="";
            if($order!="")
                $sort_str="sort=$order&";
            //echo $sort_str;die;
            
            
            $radius="";
            $radius_str="";
            if(isset($_POST['filtersubmit'])){
                if($_POST['radius']!=0){
                    $radius=$_POST['radius'];
                    $radius_str="radius=".$_POST['radius']."&";

                }
            }
            
            
			$str="http://api.citygridmedia.com/content/places/v2/search/where?";
			$placesString=$str.$typestr.$whatstr.$wherestr.$rppstr.$sort_str.$radius_str."publisher=$publisher";
			
		   //echo $placesString;die;
			$locationResult = simplexml_load_file($placesString);
			 
			// filtering form
            
            // radious filtring 
            
            
            $radius_selection0="";
            if($radius=="")
                $radius_selection0=' selected="selected" ';
            
            $radius_selection1="";
            if($radius==1)
                $radius_selection1=' selected="selected" ';
            $radius_selection2="";
            if($radius==2)
                $radius_selection2=' selected="selected" ';
            $radius_selection5="";
            if($radius==5)
                $radius_selection5=' selected="selected" ';
            
            $radius_selection10="";
            if($radius==10)
                $radius_selection10=' selected="selected" ';
            $radius_selection20="";
            if($radius==20)
                $radius_selection20=' selected="selected" ';
            
           
           
            
            
            
            $place_latitude=(string) $locationResult->regions->region->latitude;
            $place_longitude=(string) $locationResult->regions->region->longitude;
           
             
            $filtering_str='
                       <div class="fliterbox"> 
                        <form id="filterform" method="post" class="search controls" action="">
                              <input type="hidden" value="day spas" name="query" id="query">
                              <input type="hidden" value="Atlanta, GA" name="location" id="location">
                            <table id="filtertable" width="100%">
                                <tr>
                                    <td valign="top"><label>Distance</label></td>
                                    <td>
                                         <select title="Distance" name="radius" id="radius">
                                            <option '.$radius_selection0.' value="0">Within City</option>
                                            <option '.$radius_selection1.'  value="1">Within 1 mile</option>
                                            <option  '.$radius_selection2.' value="2">Within 2 miles</option>
                                            <option  '.$radius_selection5.' value="5">Within 5 miles</option>
                                            <option  '.$radius_selection10.' value="10">Within 10 miles</option>
                                            <option  '.$radius_selection20.' value="20">Within 20 miles</option>
                                         </select>
                                    </td>
                                    <td><label>Sort by</label> </td>
                                    <td>
                                        <select name="order" id="sphinx_search_order">
                                            <option '.$or_s1.' value="">Select Order</option>
                                            <option '.$or_s2.'  value="highestrated">highest rated first</option>
                                            <option  '.$or_s3.' value="alpha">alphabetical order</option>
                                            <option  '.$or_s4.' value="mostreviewed">most reviewed first</option>
                                            <option  '.$or_s5.' value="dist">closest first</option>
                                            <option  '.$or_s6.'  value="topmatches">best match</option>
                                        </select>
                                    </td>
                                    <td> <input type="submit" value="Submit" name="filtersubmit" class="button"> </td>
                                </tr>
                            
                           </table>   
                             
                            </form>
                        </div>';
            
            
             
			$places=$locationResult->locations;
             //print_r($places);die;
              // google map 
              if($places->location){
                $gdata=array();
				foreach($places->location as $row){
				
				        $gdataset=array();
                        $gdataset['lat']=(string)$row->latitude;
                        $gdataset['long']=(string)$row->longitude;
                        $gdataset['name']=(string)$row->name;
                        $gdataset['address']=(string)$row->address->street." , ".(string)$row->address->state."  ".(string)$row->address->postal_code." , ".(string)$row->address->city." . ";
                        $gdataset['phone']=(string)$row->phone_number;
                        
                        $gdata[]=$gdataset;
				    
                    
                   
				}
              }
              //print_r($gdata);
             make_googlemap($gdata);
             
             
             // make the query string 
             
             
             $qstring="<input type='hidden' id='citystring' value='$placesString' />"; 
             
		     $star=1; 
			 if($places->location){
				$result_string="<div id='gmap'></div>".$filtering_str.$qstring;
				foreach($places->location as $row){
					
               
                        if($row->rating=="")
                        $row->rating=0;
                    
    					$imgstr="";
    					if($row->image!="")
    						$imgstr='<img width="100" height="90" id="img'.$star.'"  src="'.$row->image.'"/>';
                                       
    					 $result_string .= '<script type="text/javascript">
                                                jQuery(document).ready(function(){
                                                    jQuery("#star'.$star.'").raty({
                                                        readOnly:true,
                                                        start:'.$row->rating.'/2,
                                                        half:  true,
                                                        starOn: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-on.png",
                                                        starOff: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-off.png", 
                                                        starHalf: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-half.png"
                                                    });	
                                                    
                                                    jQuery("#rm'.$star.'").fancybox({
                                        				"titlePosition"		: "inside",
                                        				"transitionIn"		: "none",
                                        				"transitionOut"		: "none",
                                                        "padding" : "20",
                                                        "overlayColor": "#999",
                                                        "overlayOpacity"	: 0.9
                                                       
                                                         
                                        			});
                                                    
                                                }); 
                                            </script>
                                            <input type="hidden" id="rate'.$star.'" value="'.$row->rating.'" />
                                            <input type="hidden" class="baseurl" value="'.LG_PLUGIN_URL.'" />
                                            <input type="hidden" id="lat'.$star.'" value="'.(string)$row->latitude.'" />
                                            <input type="hidden" id="long'.$star.'" value="'.(string)$row->longitude.'" />
                                            
                                            
                                            <div  class="location">
    											<div class="locationleft">
    												  <strong class="city_title" id="bt'.$star.'"><a style="text-decoration: none;" class="moredetail" val="'.$star.'" id="rm'.$star.'" href="#inline'.$star.'">'.$row->name.'</a></strong>
                                                      <p id="star'.$star.'" class="starratings">  <strong> '.$row->business_name.' </strong> </p>
    												  <label id="add'.$star.'">'.$row->address->street.','.$row->address->state.'  '.$row->address->postal_code.'</label>  
    												  <label id="ct'.$star.'">'.$row->address->city.' </label> 
    												  <label id="ph'.$star.'">Phone : '.$row->phone_number.'</label> 
                                                      
    											</div>
    											'.$imgstr.'
                                                <div style="clear: both;"></div>  
    										</div>
                                            
                                            <div style="display: none;">
                                        		<div id="inline'.$star.'" style="width:900px;height:400px;overflow:auto;">
                                                
                                                
                                        		</div>
                                        	</div>
                                            ';
    					 
    		              $star++; 
                        
                    
                   
                    
                    
				}
   
			 }
			 else{
				$result_string =  "<h2>Sorry no result for your given parameters </h2>";
			 }
		}
		if($result->api_type==2){
		
			$typestr="";
			if($result->search_type!="")
				$typestr="type=".$result->search_type."&";
			
			$whatstr="";
			if($result->city_what!="")
				$whatstr="what=".$result->city_what."&";
			
			$wherestr="";
			if($result->city_where!="")
				$wherestr="where=".$result->city_where."&";
			
			$rppstr="";
			if($result->number!="")
				$rppstr="rpp=".$result->number."&";
			
			
			$startstr="";
			if($result->start_date!="")
				$startstr="start_date=".$result->start_date."&";
			
			$exiprestr="";
			if($result->expires_before!="")
				$exiprestr="expires_before=".$result->expires_before."&";
			
			 // order filtring 
            $order="";
            if(isset($_POST['filtersubmit'])){ //print_r($_POST);
                if($_POST['order']!=""){
                    $order=$_POST['order'];
                }
            }
            
            
            $or_s1="";
            if($order=="")
                $or_s1=' selected="selected" ';
            
            $or_s2="";
            if($order=="dist")
                $or_s2=' selected="selected" ';
            
            $or_s3="";
            if($order=="relevance")
                $or_s3=' selected="selected" ';
            
            $or_s4="";
            if($order=="alpha")
                $or_s4=' selected="selected" ';
            
            $or_s5="";
            if($order=="startdate")
                $or_s5=' selected="selected" ';
            
            $or_s6="";
            if($order=="expirydate")
                $or_s6=' selected="selected" ';
            
            //echo $order.">>>>>";
            $sort_str="";
            if($order!="")
                $sort_str="sort=$order&";
            
            
			$radius="";
            $radius_str="";
            if(isset($_POST['filtersubmit'])){
                if($_POST['radius']!=0){
                    $radius=$_POST['radius'];
                    $radius_str="radius=".$_POST['radius']."&";
                }
            }
            
			
			$str="http://api.citygridmedia.com/content/offers/v2/search/latlon?";
			$offerString=$str.$typestr.$whatstr.$wherestr.$rppstr.$startstr.$exiprestr.$sort_str.$radius_str."publisher=$publisher";
			
			$locationResult = simplexml_load_file($offerString);
			
            //print_r($locationResult);die;
            // filtering form
            
            // radious filtring 
           
            $radius_selection0="";
            if($radius=="")
                $radius_selection0=' selected="selected" ';
            
            $radius_selection1="";
            if($radius==1)
                $radius_selection1=' selected="selected" ';
            $radius_selection2="";
            if($radius==2)
                $radius_selection2=' selected="selected" ';
            $radius_selection5="";
            if($radius==5)
                $radius_selection5=' selected="selected" ';
            
            $radius_selection10="";
            if($radius==10)
                $radius_selection10=' selected="selected" ';
            $radius_selection20="";
            if($radius==20)
                $radius_selection20=' selected="selected" ';
            
           
           
            
            
            
            $place_latitude=(string) $locationResult->regions->region->latitude;
            $place_longitude=(string) $locationResult->regions->region->longitude;
           
             
            $filtering_str='
                       <div class="fliterbox"> 
                        <form id="filterform" method="post" class="search controls" action="">
                              <input type="hidden" value="day spas" name="query" id="query">
                              <input type="hidden" value="Atlanta, GA" name="location" id="location">
                            <table id="filtertable" width="100%">
                                <tr>
                                    <td valign="top"><label>Distance</label></td>
                                    <td>
                                         <select title="Distance" name="radius" id="radius">
                                            <option '.$radius_selection0.' value="0">Within City</option>
                                            <option '.$radius_selection1.'  value="1">Within 1 mile</option>
                                            <option  '.$radius_selection2.' value="2">Within 2 miles</option>
                                            <option  '.$radius_selection5.' value="5">Within 5 miles</option>
                                            <option  '.$radius_selection10.' value="10">Within 10 miles</option>
                                            <option  '.$radius_selection20.' value="20">Within 20 miles</option>
                                         </select>
                                    </td>
                                    <td><label>Sort by</label> </td>
                                    <td>
                                        <select name="order" id="sphinx_search_order">
                                            <option '.$or_s1.' value="">Select Order</option>
                                            <option  '.$or_s2.' value="dist">closest first</option>
                                            <option '.$or_s3.'  value="relevance">Relevance</option>
                                            <option  '.$or_s4.' value="alpha">alphabetical order</option>
                                            <option  '.$or_s5.' value="startdate">Startdate  </option>
                                            <option  '.$or_s6.'  value="expirydate">Expirydate  </option>
                                            
                                        </select>
                                    </td>
                                    <td> <input type="submit" value="Submit" name="filtersubmit" class="button"> </td>
                                </tr>
                            
                           </table>   
                             
                            </form>
                        </div>';
            
            
             
			$offers=$locationResult->offers;
             
             // google map 
              if($offers->offer){
                $gdata=array();
				foreach($offers->offer as $row){
				    
                  
                    
            
				        $gdataset=array();
                        $gdataset['lat']=(string)$row->locations->location->latitude;
                        $gdataset['long']=(string)$row->locations->location->longitude;
                        $gdataset['name']=(string)$row->locations->location->name;
                         $gdataset['address']=(string)$row->locations->location->address->street." , ".
                            (string)$row->locations->location->address->state." , ".
                            (string)$row->locations->location->address->postal_code."  ".
                            (string)$row->locations->location->address->city." . ";
                        $gdataset['phone']=(string)$row->locations->location->phone;
                        
                        $gdata[]=$gdataset;
				    
                    
				}
              }
             make_googlemap($gdata);
            
            
            $qstring="<input type='hidden' id='citystring' value='$offerString' />";
            
             $star=1; 
			 if($offers->offer){
				$result_string=$qstring."<div id='gmap'></div>".$filtering_str;
                 
				foreach($offers->offer as $row){
				    //print_r($row);die;
				  
			
				       $drestr="";
    				   if($row->description!="")
    						$drestr='<p class="description"  id="description'.$star.'" ><strong>Description :</strong>'.$row->description.'</p>';
    				  
    				   $trmstr="";
    				   /*if($row->terms!="")
    						$trmstr='<label><strong>Trems :</strong>'.$row->terms.'</label>';
    				   */
    				   $startstr="";
    				   if($row->start_date!="")
    						$startstr='  <label  id="start'.$star.'" ><strong>Start date : </strong>'.date('Y-m-d',strtotime($row->start_date)).'</label>';
    						
    				   $exprstr="";
    				   if($row->expiration_date!="")
    						$exprstr='  <label  id="expire'.$star.'" ><strong>Expire date : </strong>'.date('Y-m-d',strtotime($row->expiration_date)).'</label>';
    				   
    				   
    				   $facevaluestr="";
    				   if($row->face_value!=0)
    						$facevaluestr='<label  id="face'.$star.'" ><strong>Face value:</strong>'.$row->face_value.'</label>';
    				   
    					$disvaluestr="";
    				   if($row->discount_value!=0)
    						$disvaluestr='<label  id="discount'.$star.'" ><strong>Discount value:</strong>'.$row->discount_value.'</label>';
    				   
    				   $bishourtstr="";
    				   if($row->business_hours!="")
    						$bishourtstr='  <label  id="hour'.$star.'" ><strong>Business_hours: </strong>'.date('Y-m-d',strtotime($row->business_hours)).'</label>';
    				   
    				   
    				   
    				   $imgstr="";
    					if($row->locations->location->image_url!="")
    						$imgstr='<img  id="img'.$star.'"  width="100" height="90"  src="'.$row->locations->location->image_url.'"/>';      
    				   
    					
    				  
    				   if($row->locations->location->rating=="")
                            $row->locations->location->rating=0;
    									
    				   $result_string .='  
                                     <script type="text/javascript">
                                        jQuery(document).ready(function(){
                                            jQuery("#star'.$star.'").raty({
                                                readOnly:true,
                                                start:'.$row->locations->location->rating.'/2,
                                                half:  true,
                                                starOn: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-on.png",
                                                starOff: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-off.png", 
                                                starHalf: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-half.png"
                                            });	
                                            
                                            jQuery(".dealdetail").click(function(){
                                                
                                            })
                                            
                                            jQuery("#rm'.$star.'").fancybox({
                                        				"titlePosition"		: "inside",
                                        				"transitionIn"		: "none",
                                        				"transitionOut"		: "none",
                                                        "padding" : "20",
                                                        "overlayColor": "#999",
                                                        "overlayOpacity"	: 0.9
                                                       
                                                         
                                        	});
                                            
                                        }); 
                                    </script>
                            
                                    <input type="hidden" id="rate'.$star.'" value="'.$row->locations->location->rating.'" />
                                    <input type="hidden" class="baseurl" value="'.LG_PLUGIN_URL.'" />
                                    <input type="hidden" id="lat'.$star.'" value="'.(string)$row->locations->location->latitude.'" />
                                    <input type="hidden" id="long'.$star.'" value="'.(string)$row->locations->location->longitude.'" />
                                 
                                    <div  class="location2">
                                        <div class="locationleft2">
                                              <strong id="btitle'.$star.'" class="business_title" href="javascript:void(0);"><a class="dealdetail" id="rm'.$star.'" val="'.$star.'" href="#inline'.$star.'">'.$row->locations->location->name.'</a></strong>
                                              <strong   id="offer'.$star.'"  class="city_title">'.$row->title.'</strong>
                                                <p id="star'.$star.'" class="starratings">  <strong> '.$row->business_name.' </strong> </p>
                                              '.$drestr.$trmstr.'
                                              <label  id="offer'.$star.'" > <strong> offer type: </strong>'.$row->offer_types->offer_type.' </label> 
                                              '.$startstr.$exprstr.$facevaluestr.$disvaluestr.$bishourtstr.'  
                                        </div>
                                        <div class="contentBox">
                                              <strong class="address_title">Address :</strong>
                                              <hr/>
                                              <label  id="address'.$star.'" >'.$row->locations->location->address->street.','.$row->locations->location->address->state.'  '.$row->locations->location->address->postal_code.'</label>  
                                              <label  id="city'.$star.'" >'.$row->locations->location->address->city.' </label> 
                                              <label  id="phone'.$star.'" >Phone : '.$row->locations->location->phone.'</label> 
                                             
                                              <div style="clear: both;"></div>        
                                              '.$imgstr.'
                                        </div>
                                         
                                     </div> <div style="clear: both;"></div>
                                     <div style="display: none;">
                                        		<div id="inline'.$star.'" style="width:900px;height:500px;overflow:auto;">
                                                
                                                
                                        		</div>
                                      </div>';
                                      
                                     $star++;  
				    
				}
          
			 }
			 else{
				$result_string = "<h2>Sorry no result for your given parameters </h2>";
			 }
		}
		if($result->api_type==3){
		
			$typestr="";
			if($result->search_type!="")
				$typestr="type=".$result->search_type."&";
			
			$whatstr="";
			if($result->city_what!="")
				$whatstr="what=".$result->city_what."&";
			
			$wherestr="";
			if($result->city_where!="")
				$wherestr="where=".$result->city_where."&";
			
			$rppstr="";
			if($result->number!="")
				$rppstr="rpp=".$result->number."&";
			
			
			
			
			$ratingtstr="";
			if($result->rating!="")
				$ratingtstr="rating=".$result->rating."&";
			
			$daysstr="";
			if($result->days!="")
				$daysstr="days=".$result->days."&";
			
			
			
			
			$str="http://api.citygridmedia.com/content/reviews/v2/search/where?";
			$reviewString=$str.$typestr.$whatstr.$wherestr.$rppstr.$ratingtstr.$daysstr."publisher=$publisher";
			
			$locationResult = simplexml_load_file($reviewString);
			 
			 $reviews=$locationResult->reviews;
	       $star=1;
			 if($reviews->review){
			     $result_string="";
				foreach($reviews->review as $row){
				  
                  if($row->review_rating=="")
                        $row->review_rating=0;
                  
                   $prostr="";
                   if($row->pros!="")
                    $prostr=' <label><strong>Pros :</strong>'.$row->pros.'</label> ';
                  
                   $cronstr="";
                   if($row->cons!="")
                    $cronstr= ' <label><strong>Cons :</strong>'.$row->cons.'</label> '; 
					$result_string .= '
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery("#star'.$star.'").raty({
                                readOnly:true,
                                start:'.$row->review_rating.'/2,
                                half:  true,
                                starOn: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-on.png",
                                starOff: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-off.png", 
                                starHalf: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-half.png"
                            });	
                        
                        }); 
                    </script>
                     <div  class="location">
											  
                                              <strong class="business_title2"> '.$row->business_name.' </strong> <label id="star'.$star.'" class="starratings"></label>
                                              <div style="clear: both;"></div>  
                                              <p  class="city_title">'.$row->review_title.'</p>
											  <p class="description">'.$row->review_text.'
												<a class="readmore" href="'.$row->review_url.'">read more</a>
											  </p>
											  
											  '.$prostr.$cronstr.'
											  <img class="authorimage" src="'.LG_PLUGIN_URL.'/localgrid/images/author.png" />
                                              <label><strong>Review date :</strong>'.date('Y-m-d',strtotime($row->review_date)).'</label>
											  
                                              <label><strong>Author </strong>'.$row->review_author.' </label> 
										<div style="clear: both;"></div>   
									 </div>';
				  
					$star++;				
				   
				}
                
			 }
			 else{
				echo "<h2>Sorry no result for your given parameters </h2>";
			 }
		}
		
	}
        
    if($popup_keyword)
	   return preg_replace_callback("/$popup_keyword/", 'citygrid_content_count',  $content.$style.$result_string);
    else   
        return $content.$style.$result_string;

}


$count = 1; 
// keyword replacing 
function citygrid_content_count($matches) {
    
    global $post;
	global $count;
    
    
    $popup_keyword = get_post_meta($post->ID, 'popup_keyword', true);
    $popup_text = get_post_meta($post->ID, 'popup_text', true);
    $popup_text_link = get_post_meta($post->ID, 'popup_text_link', true);
  
    
    $temp=$count;
    $count++;
    $script ="<script type=\"text/javascript\">
                        jQuery(document).ready(function(){
                        jQuery('#bubbleup$temp').bubbletip(jQuery('#tip_up$temp'));
                             
                       }); 
                   </script>";
   /*                  
  return $script.'<a  class="CAbutton"  id="button_with_popup_selectable'.$temp.'" href="#">'.$matches[0].'</a>';
  */
  
  return $script."<a id='bubbleup$temp' href='$popup_text_link'>$popup_keyword</a>
            <div id='tip_up$temp' style='display:none;'>
                <a style='color:#".get_option("localgrid_popup_color")."' href='$popup_text_link'>$popup_text</a> 
            </div>
        ";
}

function localgrid_shadowbox(){
    global $post;
    global $wpdb;
	$shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs";
    $shadoboxlist= get_post_meta($post->ID, 'shadoboxlist', true);
    if($shadoboxlist){
        
        $sql="select *from $shadowbox_table where id=$shadoboxlist";
        $result=$wpdb->get_row($sql);
        
        $width="500";
        $height="";
        
        if($result->width)
            $width=$result->width;
        
        if($result->height)
            $height="height:".$result->height."px;";
        
         $script ="<script type=\"text/javascript\">
                        jQuery(document).ready(function(){
                         jQuery('#shadowboxlink').fancybox({
                				'titlePosition'		: 'inside',
                				'transitionIn'		: 'none',
                				'transitionOut'		: 'none',
                                'padding' : '20',
                                'overlayColor': '#172525'
                			});
                                             
                       }); 
                   </script>";
        
        $content= '<a id="shadowboxlink" href="#inlinebox">Inline</a>
                <div style="display: none;">
            		<div id="inlinebox" style="width:'.$width.'px;'.$height.'overflow:auto;">
                    '.htmlspecialchars_decode(stripcslashes($result->content)).'
            		</div>
            	</div>';
                
        echo $script.$content;
        //echo htmlspecialchars_decode($result->content);
    }
    
}



?>