<?php
// google map function 
function make_googlemap($gdata){
     $max_latitude=-9999999;
     $min_latitude=9999999;
     $max_longitude=-9999999;
     $min_longitude=9999999;
     
    if($gdata){
        $count=0;
        $total_lat="";
        $total_long="";
        $market_str="";
        foreach($gdata as $row){
          
            // max min latituade longutade
            if($row['lat']>$max_latitude) $max_latitude=$row['lat'];
            if($row['lat']<$min_latitude) $min_latitude=$row['lat'];    
            if($row['long']>$max_longitude) $max_longitude=$row['long'];    
            if($row['lat']<$min_longitude) $min_longitude=$row['long'];    
            
            $total_lat += $row['lat'];
            $total_long +=$row['long'];
            $market_str .="{lat:".$row['lat'].", lng:".$row['long'].", data:'<div style=\"min-height:100px;font-family:Tahoma;font-size:12px;line-height:15px\"><small>".addslashes($row['name'])."</small><br/>Address :".addslashes($row['address'])."<br/>Phone :<small>".$row['phone']."</small></div>'},";
            $count++;
        }    
    }
    $market_str = rtrim($market_str,",");

    $center_latitude = (float)$min_latitude + ($max_latitude-$min_latitude) / 2;
    $center_longitude = (float)$min_longitude + ($max_longitude-$min_longitude) / 2; 
    
    $miles = (3958.75 * acos(sin($min_latitude / 57.2958) * sin($max_latitude / 57.2958) + cos($min_latitude / 57.2958) * cos($max_latitude / 57.2958) * cos($max_longitude / 57.2958 - $min_longitude / 57.2958)));
    if($miles<0.2) $zoom=16;
    else if($miles<0.2) $zoom=16;
    else if($miles<0.5) $zoom=15;
    else if($miles<1) $zoom=14;
    else if($miles<2) $zoom=13;
    else if($miles<3) $zoom=12;
    else if($miles<7) $zoom=11;
    else if($miles<15) $zoom=10;
    else if($miles<20) $zoom=9;
    else $zoom=4;  
  
    //echo $miles.">>>>>>";die;
    
   $avg_lat= $total_lat/$count;
   $avg_long=  $total_long/$count;
   //echo $market_str;
   // die;
    echo "<script type='text/javascript'>
            jQuery(document).ready(function(){
                
          jQuery('#gmap')
          .gmap3(
          { action:'init',
            options:{
              center:[$center_latitude,$center_longitude],
              zoom: $zoom
            }
          },
          { action: 'addMarkers',
            markers:[
              $market_str
            ],
            marker:{
              options:{
                draggable: false
              },
              events:{
                mouseover: function(marker, event, data){
                  var map = jQuery(this).gmap3('get'),
                      infowindow = jQuery(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(data);
                  } else {
                    jQuery(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
                  }
                },
                mouseout: function(){
                  var infowindow = jQuery(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.close();
                  }
                }
              }
            }
          }
        );  
               
            }); 
        </script>";
}
function make_googlemap2($gdata){
     $max_latitude=-9999999;
     $min_latitude=9999999;
     $max_longitude=-9999999;
     $min_longitude=9999999;
     
    if($gdata){
        $count=0;
        $total_lat="";
        $total_long="";
        $market_str="";
        foreach($gdata as $row){
          
            // max min latituade longutade
            if($row['lat']>$max_latitude) $max_latitude=$row['lat'];
            if($row['lat']<$min_latitude) $min_latitude=$row['lat'];    
            if($row['long']>$max_longitude) $max_longitude=$row['long'];    
            if($row['lat']<$min_longitude) $min_longitude=$row['long'];    
            
            $total_lat += $row['lat'];
            $total_long +=$row['long'];
            $market_str .="{lat:".$row['lat'].", lng:".$row['long'].", data:'<div style=\"min-height:80px;\"><small>".addslashes($row['name'])."</small><br/>Phone :<small>".$row['phone']."</small></div>'},";
            $count++;
        }    
    }
    $market_str = rtrim($market_str,",");

    $center_latitude = (float)$min_latitude + ($max_latitude-$min_latitude) / 2;
    $center_longitude = (float)$min_longitude + ($max_longitude-$min_longitude) / 2; 
    
    $miles = (3958.75 * acos(sin($min_latitude / 57.2958) * sin($max_latitude / 57.2958) + cos($min_latitude / 57.2958) * cos($max_latitude / 57.2958) * cos($max_longitude / 57.2958 - $min_longitude / 57.2958)));
    if($miles<0.2) $zoom=16;
    else if($miles<0.2) $zoom=16;
    else if($miles<0.5) $zoom=15;
    else if($miles<1) $zoom=14;
    else if($miles<2) $zoom=13;
    else if($miles<3) $zoom=12;
    else if($miles<7) $zoom=11;
    else if($miles<15) $zoom=10;
    else if($miles<20) $zoom=9;
    else $zoom=4;  
  
    //echo $miles.">>>>>>";die;
    
   $avg_lat= $total_lat/$count;
   $avg_long=  $total_long/$count;
   //echo $market_str;
   // die;
    return "<script type='text/javascript'>
            jQuery(document).ready(function(){
                
          jQuery('#gmap3')
          .gmap3(
          { action:'init',
            options:{
              center:[$center_latitude,$center_longitude],
              zoom: $zoom
            }
          },
          { action: 'addMarkers',
            markers:[
              $market_str
            ],
            marker:{
              options:{
                draggable: false
              },
              events:{
                mouseover: function(marker, event, data){
                  var map = jQuery(this).gmap3('get'),
                      infowindow = jQuery(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(data);
                  } else {
                    jQuery(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
                  }
                },
                mouseout: function(){
                  var infowindow = jQuery(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.close();
                  }
                }
              }
            }
          }
        );  
               
            }); 
        </script>";
}
?>
