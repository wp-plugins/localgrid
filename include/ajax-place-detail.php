<?php
    
    // ajax work for citygrid listing preview in admin panel 
    
    include "../../../../wp-load.php";
    global $wpdb;
    //print_r($_POST);die;
    $publisher=get_option('localgrid_citygrid_publisher_key');
    
  
        $locationResult = simplexml_load_file($_POST["qstring"]);
        $places=$locationResult->locations;
        $totalrow =20;
        $i=0;
        $temp=0;
        while($i!=2 && $totalrow >$temp){
            $rand=rand(0,19);
           // echo $rand;
            $result =$places->location[$rand];
            if($result->name!="" && $result->name!=$_POST['btitle']){
                if($i==0){
                    $sussestion1=$result;
                    $i++;
                }
                else if($result->name!=$sussestion1->name){
                    $sussestion2=$result;

                    $i++;    
                }
                     
                
            }
            $temp++;
            
        }
        //print_r($sussestion1);
        //print_r($sussestion2);
        
        //die;
        
        // die;
        $sussestion1_str="";
       if($sussestion1)
            $sussestion1_str='  <div class=rbox>
                                <p><h2>'.$sussestion1->name.'</h2></p>
                                <p id="sug1'.$_POST['id'].'" class="starratings" ></p>
                                <p>Address :<strong>'.$sussestion1->address->street.' , '.$sussestion1->address->state.'  '.$sussestion1->address->postal_code.' , '.$sussestion1->address->city.'</strong></p>

                             </div>';
                             
       
       $sussestion2_str="";
       if($sussestion2)
            $sussestion2_str='<div class=rbox>
                                <p><h2>'.$sussestion2->name.'</h2></p>
                                <p id="sug2'.$_POST['id'].'" class="starratings" ></p>
                                <p>Address :<strong>'.$sussestion2->address->street.' , '.$sussestion2->address->state.'  '.$sussestion2->address->postal_code.' , '.$sussestion2->address->city.'</strong></p>

                             </div> ';
       $sug_headstr="";                              
       if($sussestion1_str!="" || $sussestion2_str !="")
       $sug_headstr=' <h2 style="color:#3A66D5">Not sure yet? Consider these two similar businesses</h2>
                             <br />';
                             
        $sussestion_str='<div class="relatedbox">
                             '.$sug_headstr.$sussestion1_str.$sussestion2_str.' 
                        </div>';
        
       
        
          
    
    $s1rating=0;
    if($sussestion1->rating!="")
        $s1rating=$sussestion1->rating;
    
    
    $s2rating=0;
    if($sussestion2->rating!="")
        $s2rating=$sussestion2->rating;
    
    $script= '<script type="text/javascript">
                jQuery(document).ready(function(){
                        
                        jQuery("#ratings'.$_POST['id'].'").raty({
                            readOnly:true,
                            start:'.$_POST['rate'].'/2,
                            half:  true,
                            starOn: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-on.png",
                            starOff: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-off.png", 
                            starHalf: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-half.png"
                        });
                        
                        jQuery("#sug1'.$_POST['id'].'").raty({
                            readOnly:true,
                            start:'.$s1rating.'/2,
                            half:  true,
                            starOn: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-on.png",
                            starOff: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-off.png", 
                            starHalf: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-half.png"
                        });
                         jQuery("#sug2'.$_POST['id'].'").raty({
                            readOnly:true,
                            start:'.$s2rating.'/2,
                            half:  true,
                            starOn: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-on.png",
                            starOff: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-off.png", 
                            starHalf: "'.LG_PLUGIN_URL.'/localgrid/library/ratings/img/star-half.png"
                        });
                        
                        jQuery("#gmap'.$_POST['id'].'").gmap3(
                          { action:"init",
                            options:{
                              center:['.$_POST['lat'].','.$_POST['lon'].'],
                              zoom: 14
                            }
                          },
                          { action: "addMarker",
                            latLng:['.$_POST['lat'].', '.$_POST['lon'].']
                          }
                        );
                        	
                });
               
                 
             </script>';

    
    $content_str =  '<div class="leftbox2">
                       <div class="disbox"> 
                            <p><h1>'.$_POST['btitle'].'</h1></p>
                            <p id="ratings'.$_POST['id'].'" class="starratings"></p>
                            <p>Address :<strong>'.$_POST['address'].'</strong></p>
                            <p><strong>'.$_POST['city'].'</strong></p>
                            <p><strong>'.$_POST['phone'].'</strong></p>
                        </div>
                        <img src="'.$_POST['img'].'" />
                        '.$sussestion_str.'
                    </div>
                    <div class="rightbox2">
                        <div id="gmap'.$_POST['id'].'"  class="content-gmap" ></div>
                        <a href="http://www.mapquest.com/directions"> Get direction </a>
                    </div><p style="padding-top:20px" target="_blank"><a href="http://localgrid.com">powered by wplocalplus</a> </p>';
         
     echo $script.$content_str ;    
          
    
   
      
    
?>