<?php
    
    // ajax work for citygrid listing preview in admin panel 
    
    include "../../../../wp-load.php";
    global $wpdb;
    //print_r($_POST);die;
    $publisher=get_option('localgrid_citygrid_publisher_key');
    
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
    
    
    
    // preview of the places 
    if($_POST['cityapitype']==1){
        
        $typestr="";
        if($_POST['palcestype']!="")
            $typestr="type=".$_POST['palcestype']."&";
        
        $whatstr="";
        if($_POST['placeswhat']!="")
            $whatstr="what=".$_POST['placeswhat']."&";
        
        $wherestr="";
        if($_POST['placeswhere']!="")
            $wherestr="where=".$_POST['placeswhere']."&";
        
        $rppstr="";
        if($_POST['placesnumber']!="")
            $rppstr="rpp=".$_POST['placesnumber']."&";
        
        $str="http://api.citygridmedia.com/content/places/v2/search/where?";
        $placesString=$str.$typestr.$whatstr.$wherestr.$rppstr."publisher=$publisher";
        
       
        $locationResult = simplexml_load_file($placesString);
         
         
         $places=$locationResult->locations;
     
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
          $qstring="<input type='hidden' id='citystring' value='$placesString' />";
          
          $bussinees_detail_script='<script type="text/javascript">
                                        jQuery(document).ready(function(){
                                            
                                            jQuery(".moredetail").click(function(){
                                            var id=jQuery(this).attr("val");
                                            var btitle=jQuery("#rm"+id).html();
                                            var address=jQuery("#add"+id).html();
                                            var rate=jQuery("#rate"+id).val();
                                            var city=jQuery("#ct"+id).html();
                                            var phone=jQuery("#ph"+id).html();
                                            var img=jQuery("#img"+id).attr("src");
                                            var lat=jQuery("#lat"+id).val();
                                            var lon=jQuery("#long"+id).val();
                                            var qstring=jQuery("#citystring").val();  
                                            jQuery("#inline"+id).html(\'<img class="fancybox-loading2" src="\'+jQuery(".baseurl").val()+\'/localgrid/images/content-loader.gif" />\');
                                            jQuery(".fancybox-loading2").css("display","block");
                                            jQuery.post(jQuery(".baseurl").val()+"/localgrid/include/ajax-place-detail.php",
                                                        {  qstring:qstring,id:id,btitle:btitle,address:address ,rate:rate,city:city,phone:phone,img:img,lat:lat,lon:lon},
                                               function(data) {
                                                jQuery("#inline"+id).html(data);
                                               //jQuery(".fancybox-loading2").css("display","none");
                                                  //  jQuery(window).load("inline"+id)
                                               }
                                            );
                                            
                                          })
                                       }); 
                                    </script>';
           
         $star=1; 
         if($places->location){ 
            $result_string=$qstring.$bussinees_detail_script."<div id='gmap3'></div>";
            foreach($places->location as $row){
                
                      if($row->rating=="")
                        $row->rating=0;
                    
					$imgstr="";
					if($row->image!="")
						$imgstr='<img width="100" height="90"  src="'.$row->image.'"/>';           
					 $result_string .= '
                                     <script type="text/javascript">
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
                                        	</div>';
				 
	                                 $star++; 
    
            }
         }
         else{
            echo "<h2>Sorry no result for your given parameters </h2>";
         }
        
        
    }
    else if($_POST['cityapitype']==2){
        //print_r($_POST);
        $typestr="";
        if($_POST['offertype']!="")
            $typestr="type=".$_POST['offertype']."&";
        
        $whatstr="";
        if($_POST['offerwhat']!="")
            $whatstr="what=".$_POST['offerwhat']."&";
        
        $wherestr="";
        if($_POST['offerwhere']!="")
            $wherestr="where=".$_POST['offerwhere']."&";
        
        $rppstr="";
        if($_POST['offernumber']!="")
            $rppstr="rpp=".$_POST['offernumber']."&";
        
        
        $startstr="";
        if($_POST['offerstartdate']!="")
            $startstr="start_date=".$_POST['offerstartdate']."&";
        
        $exiprestr="";
        if($_POST['offerexpiresbefore']!="")
            $exiprestr="expires_before=".$_POST['offerexpiresbefore']."&";
        
        
        
        
        $str="http://api.citygridmedia.com/content/offers/v2/search/latlon?";
        $offerString=$str.$typestr.$whatstr.$wherestr.$rppstr.$startstr.$exiprestr."publisher=$publisher";
        //echo $offerString;die;
        $locationResult = simplexml_load_file($offerString);
         
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
        
         $bussinees_detail_script='<script type="text/javascript">
                                        jQuery(document).ready(function(){
                                            
                                            jQuery(".dealdetail").click(function(){
                                                
                                                
                                                var id=jQuery(this).attr("val");
                                                
                                                var btitle=jQuery("#rm"+id).html();
                                                var address=jQuery("#address"+id).html();
                                                var offer=jQuery("#offer"+id).html();
                                                var description=jQuery("#description"+id).html();
                                                var start=jQuery("#start"+id).html();
                                                var expire=jQuery("#expire"+id).html();
                                                var face=jQuery("#face"+id).html();
                                                
                                                var discount=jQuery("#discount"+id).html();
                                                var hour=jQuery("#hour"+id).html();
                                                
                                                var rate=jQuery("#rate"+id).val();
                                                var city=jQuery("#city"+id).html();
                                                var phone=jQuery("#phone"+id).html();
                                                var img=jQuery("#img"+id).attr("src");
                                                var lat=jQuery("#lat"+id).val();
                                                var lon=jQuery("#long"+id).val();
                                                var qstring=jQuery("#citystring").val();  
                                                
                                                jQuery("#inline"+id).html(\'<img class="fancybox-loading2" src="\'+jQuery(".baseurl").val()+\'/localgrid/images/content-loader.gif" />\');
                                                
                                                
                                                
                                                jQuery(".fancybox-loading2").css("display","block");
                                                jQuery.post(jQuery(".baseurl").val()+"/localgrid/include/ajax-deal-detail.php",
                                                {  qstring:qstring,id:id,btitle:btitle,address:address,description:description, start:start,expire:expire
                                                ,face:face,offer:offer,discount:discount,hour:hour,rate:rate,city:city,phone:phone,img:img,lat:lat,lon:lon},
                                                    function(data) {
                                                    jQuery("#inline"+id).html(data);
                                                    //jQuery(".fancybox-loading2").css("display","none");
                                                    //  jQuery(window).load("inline"+id)
                                                    }
                                                );
                                            
                                            
                                          })
                                       }); 
                                    </script>';
          
         if($offers->offer){ 
            $star=1;
            $result_string=$bussinees_detail_script.$qstring."<div id='gmap3'></div>";
            foreach($offers->offer as $row){
              
               $drestr="";
				   if($row->description!="")
						$drestr='<p class="description"  id="description'.$star.'" ><strong>Description :</strong>'.$row->description.'</p>';
				  
				   $trmstr="";
				   /*if($row->terms!="")
						$trmstr='<label><strong>Trems :</strong>'.$row->terms.'</label>';
				   */
				   $startstr="";
				   if($row->start_date!="")
						$startstr='  <label  id="start'.$star.'"><strong>Start date : </strong>'.date('Y-m-d',strtotime($row->start_date)).'</label>';
						
				   $exprstr="";
				   if($row->expiration_date!="")
						$exprstr='  <label  id="expire'.$star.'"><strong>Expire date : </strong>'.date('Y-m-d',strtotime($row->expiration_date)).'</label>';
				   
				   
				   $facevaluestr="";
				   if($row->face_value!=0)
						$facevaluestr='<label  id="face'.$star.'" ><strong>Face value:</strong>'.$row->face_value.'</label>';
				   
					$disvaluestr="";
				   if($row->discount_value!=0)
						$disvaluestr='<label  id="discount'.$star.'" ><strong>Discount value:</strong>'.$row->discount_value.'</label>';
				   
				   $bishourtstr="";
				   if($row->business_hours!="")
						$bishourtstr='  <label   id="hour'.$star.'"><strong>Business_hours: </strong>'.date('Y-m-d',strtotime($row->business_hours)).'</label>';
				   
				   
				   
				   $imgstr="";
					if($row->locations->location->image_url!="")
						$imgstr='<img width="100" height="90"  src="'.$row->locations->location->image_url.'"/>';      
				   
					
				  
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
    else if($_POST['cityapitype']==3){
        //print_r($_POST); die;
        $typestr="";
        if($_POST['reviewtype']!="")
            $typestr="review_type=".$_POST['reviewtype']."&";
        
        $whatstr="";
        if($_POST['reviewwhat']!="")
            $whatstr="what=".$_POST['reviewwhat']."&";
        
        $wherestr="";
        if($_POST['reviewwhere']!="")
            $wherestr="where=".$_POST['reviewwhere']."&";
        
        
        $rppstr="";
        if($_POST['reviewnumber']!="")
            $rppstr="rpp=".$_POST['reviewnumber']."&";
        
        
        $ratingtstr="";
        if($_POST['ratings']!="")
            $ratingtstr="rating=".$_POST['ratings']."&";
        
        $daysstr="";
        if($_POST['days']!="")
            $daysstr="days=".$_POST['days']."&";
        
        
        
        
        $str="http://api.citygridmedia.com/content/reviews/v2/search/where?";
        $reviewString=$str.$typestr.$whatstr.$wherestr.$rppstr.$ratingtstr.$daysstr."publisher=$publisher";
        
        
        
        //echo $reviewString;
        //$target = "http://api.citygridmedia.com/content/places/v2/search/where?what=spa&where=90045&rpp=2&publisher=test";
    
        $locationResult = simplexml_load_file($reviewString);
        //print_r($locationResult);die; 
         
         $reviews=$locationResult->reviews;
       //print_r($reviews);die;
         if($reviews->review){ 
            $star=1;
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
                            	jQuery(".readmore").fancybox({
				"width"				: "90%",
				"height"			: "90%",
				"autoScale"			: false,
				"transitionIn"		: "none",
				"transitionOut"		: "none",
				"type"				: "iframe"
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
											  
                                              <label><strong>Author </strong> '.$row->review_author.'</label> 
										<div style="clear: both;"></div>   
									 </div>';
				  
					$star++;	                 
               
            }
         }
         else{
            echo "<h2>Sorry no result for your given parameters </h2>";
         }
        
        
    }
   echo $style.$result_string;
      
    
?>