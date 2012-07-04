<?php

function distance($lat1, $lon1, $lat2, $lon2) { 

  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);


        return $miles;
     
}

/*  function list for wp-plugin */
if( !function_exists('localgrid_get_numof_records_bysql') ):
function localgrid_get_numof_records_bysql($sql){
    global $wpdb;
	$resultset = $wpdb->get_results($sql);
	return count( $resultset );
}
endif;

if( !function_exists('localgrid_get_numof_records') ):
function localgrid_get_numof_records($tbl_name='', $condition=''){
	global $wpdb;
	
	if( $tbl_name=='' ) return -1;
	
	$sql = "SELECT * FROM ". $wpdb->prefix . $tbl_name;
	if( $condition!='' )
		$sql .= ' WHERE '.$condition;
		
	$resultset = $wpdb->get_results($sql);
	return count( $resultset );
}
endif;

/*debug function*/
if( !function_exists('mvcpre_print') ):
function mvcpre_print($res, $dump=false){
	echo "<pre>";
		if( $dump ) var_dump( $res );
		else print_r( $res );
	echo "</pre>";
}
endif;

add_action("admin_footer","localgrid_script");

function localgrid_script(){
    echo    "<script>
                 .star1,.star2,.star3,.star4,.star5,
                 .star6,.star7,.star8,.star9,.star10,
                 .star11,.star12,.star13,.star14,.star15,
                 .star16,.star17,.star18,.star19,.star20,
                 .star21,.star22,.star23,.star24,.star25,
                 .star26,.star27,.star28,.star29,.star30
                 {
                    width: 5% !important;
                 }   
            </script>";
}

/*

*/

?>