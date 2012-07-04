<?php
/**
 *  wplocal_citygridlist CLASS FOR ADMIN
 *
 * @link http://www.mdimran.net/
 * @author Imran <imran.aspire@gmail.com>
 *
 */
 
 class wplocal_citygridlist{
    
     /**
     * Default Action of  wplocal_citygridlist
     */
    public function index(){
        
        $this->condition();
        global $wpdb;
    	$per_page = get_option('citygrid_iteam_perpage');
        
        $citygrid_table = $wpdb->prefix . "citygrid_list";
        
        // check the codition
        
       
        
        
        $sql= "SELECT  *from $citygrid_table ";
        
   
        $total_sql=$sql;
        
    	$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 0;
    	if ( empty($pagenum) ) $pagenum = 1;
    	if( ! isset( $per_page ) || $per_page < 0 ) $per_page = 10;
    	$num_pages = ceil( localgrid_get_numof_records_bysql($sql) / $per_page);
    	
       
    	$app_pagin = paginate_links(array(
    		'base' => add_query_arg( 'pagenum', '%#%' ),
    		'format' => '',
    		'prev_text' => __('&laquo;'),
    		'next_text' => __('&raquo;'),
    		'total' => $num_pages,
    		'current' => $pagenum
    	));
    	
        
    	// Get all the promos from the database
    		
    	if(isset($_REQUEST['orderby'])) {
    		$sql .= " ORDER BY " . $_REQUEST['criteria'] . " " . $_REQUEST['order'];
    		$option_selected[$_REQUEST['criteria']] = " selected=\"selected\"";
    		$option_selected[$_REQUEST['order']] = " selected=\"selected\"";
    	}
    	else {
    		$sql .= " ORDER BY id ";
    		$option_selected['id'] = " selected=\"selected\"";
    		$option_selected['ASC'] = " selected=\"selected\"";
    	}
    	if( $pagenum > 0 ) $sql .= " LIMIT ". (($pagenum-1)*$per_page) .", ". $per_page;
    	
    	$wpdb->show_errors=true;
    	//getting results
    	$comment_list = $wpdb->get_results($sql);
    
       	if( isset($_GET['pagenum']) ) $pagenum_url='&amp;pagenum='.$_GET['pagenum'];
	       else $pagenum_url = '';
	
    	foreach($comment_list as $row) {
    		if($alternate) $alternate = "";
    		else $alternate = " class=\"alternate\"";
            if($row->api_type==1)
                $api="Places";
            if($row->api_type==2)
                $api="Offers";
            if($row->api_type==3)
                $api="Reviews";
            
    		$elem_list .= "<tr{$alternate}>";
    		$elem_list .= "<th scope=\"row\" class=\"check-column\"><input type=\"checkbox\" name=\"bulkcheck[]\" value=\"" .  $row->id . "\" /></th>";
    		$elem_list .= "<td>". $row->id .'</td>';
            $elem_list .= "<td>". $row->name .'</td>';
            $elem_list .= "<td>". $row->date .'</td>';
            $elem_list .= "<td>". $api.'</td>';
        	$elem_list .= '<td style="text-align:center"><a href="'. $_SERVER['PHP_SELF'] . "?page=wplocal_citygridlist&amp;action=edit&amp;id=" . $row->id . '" class="delete">Edit</a></td>';
    		$elem_list .= '<td style="text-align:center"><a href="'. $_SERVER['PHP_SELF'] . "?page=wplocal_citygridlist&amp;action=delete&amp;id=" . $row->id . '" onclick="return confirm(\'Are you sure you want to delete this List ?\');" class="delete">Delete</a></td>';
    		$elem_list .= "</tr>";
    	}
    
?>
       
       	<div class="wrap">
		
		<?php if($msg): ?><div id="message" class="updated fade"><p><?php echo $msg; ?></p></div><?php endif; ?>
		
		<h2>Business List Management</h2>
		
		<?php if($elem_list): ?>
		
		<p>Currently, you have <?php echo localgrid_get_numof_records_bysql($total_sql); ?> listings</p>
		
		<form id="record_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wplocal_citygridlist">
			<div class="tablenav">
				<div class="alignleft actions" id="toptab">
					<p>
                    <input type="submit" name="bulkaction" value="Delete" onclick="return confirm('Are you sure you want to delete these listings   ?');" class="button-secondary" />
					Sort by:
					</p>
                    <p>
                    <select style="width: 100px;" name="criteria">
						<option value="id"<?php echo $option_selected['id']; ?>>ID</option>
                         <option value="name"<?php echo $option_selected['name']; ?>>Name</option>
                        <option value="date"<?php echo $option_selected['date']; ?>>Date</option>
                        <option value="api_type"<?php echo $option_selected['api_type']; ?>>Type</option>
                    </select>
                    </p > 
                    <p>
					<select  style="width: 50px;padding: 0px;"  name="order">
						<option value="ASC"<?php echo $option_selected['ASC']; ?>>ASC</option>
						<option value="DESC"<?php echo $option_selected['DESC']; ?>>DESC</option>
					</select>
                    </p>
                   <p> 
					<input type="submit" name="orderby" value="Go" class="button-secondary" />
                   </p>
                    <p>    &nbsp;&nbsp;&nbsp; Schedule Per page <input style="width: 50px;" type="text" value="<?php echo get_option("citygrid_iteam_perpage") ?>" name="citygrid_iteam_perpage" />
                    <input type="submit" name="citygrid_iteam_perpage_submit" value="update" />
                    </p>
                </div>
				<?php if($app_pagin): ?>
				<div class="tablenav-pages">
					<span class="displaying-num">
						Displaying 
						<?php echo ( $pagenum - 1 ) * $per_page + 1; ?> - 
						<?php echo min( $pagenum * $per_page, localgrid_get_numof_records_bysql($total_sql) ); ?> of 
						<?php echo localgrid_get_numof_records_bysql($total_sql); ?>
						<?php echo $app_pagin; ?>
					</span>
				</div>
				<?php endif; ?>
				<div style="clear:both;"><!----></div>
			</div>
				
				<table class="widefat">
					<thead><tr>
						<th class="check-column"><input type="checkbox" onclick="record_form_checkAll(document.getElementById('record_form'));" /></th>
						
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th colspan="2" style="text-align:center">Action</th>
                        
					</tr></thead>
					
					<tbody id="the-list"><?php echo $elem_list; ?></tbody>
				</table>
				
			<div class="tablenav">
				<div class="alignleft actions">
					<input type="submit" name="bulkaction" value="Delete" onclick="return confirm('Are you sure you want to delete these  listings  ?');" class="button-secondary" />
				</div>
				<?php if($app_pagin): ?>
				<div class="tablenav-pages">
					<span class="displaying-num">
						Displaying 
						<?php echo ( $pagenum - 1 ) * $per_page + 1; ?> - 
						<?php echo min( $pagenum * $per_page, localgrid_get_numof_records_bysql($total_sql) ); ?> of 
						<?php echo localgrid_get_numof_records_bysql($total_sql); ?>
						<?php echo $app_pagin; ?>
					</span>
				</div>
				<?php endif; ?>
				<div style="clear:both;"><!----></div>
			</div>
			
		</form>
		<?php else: ?>
		<p>No record is in the database</p>
		<?php endif; ?>
		<?php $this->addCitygridListBox();?>
	   </div>
       

<?php        
    }
     /**
     *   show the add box of citygrid list
     */
    public function addCitygridListBox($id=0){
        global $wpdb;
        $citygrid_table = $wpdb->prefix . "citygrid_list";
        
        $lable="ADD";
        if($id){
            $lable="Edit";
            $sql="Select *from $citygrid_table where id=$id";
            $list_result=$wpdb->get_row($sql);
            //echo $list_result->api_type.">>>>>"; 
        ?>
        
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#cityapitype option").each(function(){
                    if(jQuery(this).val()==<?php echo $list_result->api_type; ?>)
                        jQuery(this).attr("selected","selected")
                    })
                    
                    if(jQuery("#cityapitype").val()!=""){
                        jQuery(".cityBox").slideUp();  
                        if(jQuery("#cityapitype").val()==1){
                            jQuery("#placesBox").slideDown();
                            jQuery("#palcestype option").each(function(){ 
                                if(jQuery(this).val()=="<?php echo $list_result->search_type; ?>")
                                    jQuery(this).attr("selected","selected")
                            })
    
                        }  
                        if(jQuery("#cityapitype").val()==2)
                        jQuery("#offersBox").slideDown();  
                        if(jQuery("#cityapitype").val()==3)
                        jQuery("#reviewBox").slideDown();  
                    }
                })
            </script>
        <?php
               
        }
        ?>
       
         <div class="wrap" style="padding-top: 15px;">
            <div id="poststuff" class="metabox-holder has-right-sidebar">
                <div class="postbox " style=""> 
              


                    <h3 class="hndle" ><span><?php echo $lable; ?> Business list</span></h3>
                    <div class="inside" style="padding: 0px 10px 0 10px">
                       <form id="addcitygridlist"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wplocal_citygridlist">
                            
                            <div class="exBox">
                                <label>Name</label><input type="text" value="<?php echo $list_result->name; ?>" name="listname" id="listname" />
                            </div>
                            <div class="exBox">
                                    <label>Business Type</label>
                                    <select name="cityapitype" id="cityapitype">
                                                <option value="">Select Category</option>
                                                <option  value="1">Places</option>
                                                <option value="2">Offers</option>
                                                <option value="3">Reviews</option>
                                    </select>
                            </div>
                            <div id="placesBox" class="cityBox">
                                <div class="exBox">
                                    <label>Places Type</label>
                                    <select name="palcestype" id="palcestype">
                                                <option value="">none</option>
                                                <option value="movie">movie</option>
                                                <option value="movietheater">movietheater</option>
                                                <option value="restaurant">restaurant</option>
                                                <option value="hotel">hotel</option>
                                                <option value="travel">travel</option>
                                                <option value="barclub">barclub</option>
                                                <option value="spabeauty">spabeauty</option>
                                                <option value="shopping">shopping</option>
                                    </select>
                                </div>
                                <div class="exBox">
                                    <label>What</label> <input type="text" value="<?php echo $list_result->city_what ?>" name="placeswhat" id="placeswhat" />
                                </div>
                                <div class="exBox">
                                    <label>Where</label>
                                    
                                    <input type="text"  <?php if($list_result->city_where){ ?>  value="<?php echo $list_result->city_where ?>" <?php }else{ echo 'value="EX: Cambridge,MA"';}?> onblur="if(this.value==''){this.value='EX: Cambridge,MA'};" onfocus="if(this.value=='EX: Cambridge,MA'){this.value=''};" name="placeswhere" id="placeswhere" />
       
                                     <br />
                                    <p>Example-zipcode: 91110</p> 
                                </div>
                                
                               <div class="exBox">
                                    <label>Number of the result</label> <input type="text" name="placesnumber"  <?php if($list_result->number){ ?>  value="<?php echo $list_result->number ?>" <?php }else{ echo 'value="20"';}?> />
                               </div>
                            </div>
                           
                           <div id="offersBox" class="cityBox">
                                <div class="exBox">
                                    <label>Offer Type</label>
                                    <select name="offertype" id="offertype">
                                                <option value="">none</option>
                                                <option value="percentoff">percentoff</option>
                                                <option value="free">free </option>
                                                <option value="dollarsoff">dollarsoff </option>
                                                <option value="gift">gift </option>
                                                <option value="buy1get1">buy1get1</option>
                                                <option value="purchase">purchase </option>
                                                <option value="other">other</option>
                                                <option value="printablecoupon">printablecoupon </option>
                                                <option value="groupbuy">groupbuy </option>
                                                <option value="dailydeal">dailydeal </option>
                                    </select>
                                </div>
                                <div class="exBox">
                                    <label>What</label> <input type="text"  value="<?php echo $list_result->city_what ?>"  name="offerwhat" id="offerwhat" />
                                </div>
                                <div class="exBox">
                                    <label>Where</label>
                                    
                                    <input type="text"   <?php if($list_result->city_where){ ?>  value="<?php echo $list_result->city_where ?>" <?php }else{ echo 'value="EX: Cambridge,MA"';}?>  onblur="if(this.value==''){this.value='EX: Cambridge,MA'};" onfocus="if(this.value=='EX: Cambridge,MA'){this.value=''};" name="offerwhere" id="offerwhere" />
       
                                     <br />
                                    <p>Example-zipcode: 91110</p> 
                                </div>
                                <?php $date=date("Y-m-d",time()); ?>
                                <div class="exBox">
                                    <label>Start Date</label> <input type="text" class="inputDate" name="offerstartdate" id="offerstartdate"  />
                                    <input type="hidden" id="currentdate"  value="<?php echo $date; ?>"  />
                                </div>
                                
                                <div class="exBox">
                                    <label>Expires before</label> <input type="text" class="inputDate" name="offerexpiresbefore" id="offerexpiresbefore"  />
                                </div>
                               <div class="exBox">
                                    <label>Number of the result</label> <input type="text" name="offernumber"   <?php if($list_result->number){ ?>  value="<?php echo $list_result->number ?>" <?php }else{ echo 'value="20"';}?>  />
                               </div>
                              
                               	
                            </div>
                           
                           <div id="reviewBox" class="cityBox">
                                <div class="exBox">
                                    <label>Review Type</label>
                                    <select name="reviewtype" id="reviewtype">
                                                <option value="">none</option>
                                                <option value="editorial_review">Editorial review </option>
                                                <option value="user_review">User Review </option>
                                                <option value="external_user_review">External user review</option>
                                                
                                    </select>
                                </div>
                                <div class="exBox">
                                    <label>What</label> <input type="text" value="<?php echo $list_result->city_what ?>"  name="reviewwhat" id="reviewwhat" />
                                </div>
                                <div class="exBox">
                                    <label>Where</label>
                                    
                                    <input type="text"  <?php if($list_result->city_where){ ?>  value="<?php echo $list_result->city_where ?>" <?php }else{ echo 'value="EX: Cambridge,MA"';}?>  onblur="if(this.value==''){this.value='EX: Cambridge,MA'};" onfocus="if(this.value=='EX: Cambridge,MA'){this.value=''};" name="reviewwhere" id="reviewwhere" />
       
                                     <br />
                                    <p>Example-zipcode: 91110</p> 
                                </div>
                               
                               <div class="exBox">
                                    <label>Number of the result</label> <input type="text" name="reviewnumber"   <?php if($list_result->number){ ?>  value="<?php echo $list_result->number ?>" <?php }else{ echo 'value="20"';}?>  />
                               </div>
                              
                              <div class="exBox">
                                    <label>Review Ratings</label>  <input type="text" name="ratings" /> 
                                    <p>ratings between 1-10</p> 
                                       
                              </div>
                              
                              <div class="exBox">
                                    <label>Age of the review(in days)</label>  <input type="text" name="days" />  
                              </div>
                               	
                            </div>
                           <p><input type="button" id="cityPreview" value="Result Preview" />
                           <img id="imageloader" src="<?php echo LG_PLUGIN_URL; ?>/localgrid/images/loading.gif" />
                           </p>
                           <?php if($id!=""){ ?>
                                <p><input type="submit" name="citygridlist_update" value="Update Business List" /></p>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                            <?php }else{ ?>
                                <p><input type="submit" name="citygridlist_submit" value="Add Business List" /></p> 
                            <?php } ?>  
                           <div id="previewResult" style="position: relative;" >
                           </div>
                           
                           
                           <input type="hidden" id="ajaxurl" value="<?php echo LG_PLUGIN_URL;  ?>/localgrid/include/ajax.php" /> 
                       </form>
                    </div>
                </div>
                
                
                
                
            </div>    
        
        </div>
        
        <?php
        
    }
     /**
     *   condition check of the scheduling module 
     */
    public function condition(){
        //print_r($_POST);die;
        if(isset($_POST['citygridlist_submit']))
           $this->add();
        
        if(isset($_POST['citygridlist_update']))
            $this->update();
        
        
        if(isset($_POST['citygrid_iteam_perpage_submit'])){
          
           if($_POST['citygrid_iteam_perpage']!="" ){
              update_option("citygrid_iteam_perpage",$_POST['citygrid_iteam_perpage']); 
           }
           
             
        }
         // delete bulk comments 
        
        if($_REQUEST['bulkaction'] == __('Delete')){
            global $wpdb;
        	$citygrid_table = $wpdb->prefix . "citygrid_list"; 
            
            
            if($_REQUEST['bulkcheck']){
                    
                    $sql = "DELETE from $citygrid_table WHERE  id IN (".implode(', ', $_REQUEST['bulkcheck']).")";  
                    
                    if(FALSE === $wpdb->query($sql)) 
                        echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
                    else     		
                        echo '<div class="updated fade" id="message"><p>Citygrid list is successfully deleted</p></div>';
                    
            }
        
        }
            
            
        
    }
    public function edit(){
        $this->addCitygridListBox($_GET['id']);
    }
    
     /**
     *   add the citygrid list 
     */
    public function add(){
        global $wpdb;
       	$citygrid_table = $wpdb->prefix . "citygrid_list";
        
        //print_r($_POST);die;
        		
        $cityapitype         = htmlspecialchars(trim($_POST['cityapitype']));
        
        if($cityapitype==1){
            
            $name =  htmlspecialchars(trim($_POST['listname']));
            $search_type =  htmlspecialchars(trim($_POST['palcestype']));
            $city_what= htmlspecialchars(trim($_POST['placeswhat']));
            $city_where =  htmlspecialchars(trim($_POST['placeswhere']));
            $number= htmlspecialchars(trim($_POST['placesnumber']));
            
            $result = $wpdb->insert( $citygrid_table, 
        		  		  array('api_type' => $cityapitype, 'name' => $name,'search_type' => $search_type,"city_what"=>$city_what,'city_where' => $city_where,"number"=>$number), 
        		  		  array( '%d','%s','%s','%s' ,'%s','%s'  ) );
        }
        if($cityapitype==2){
            
            $name =  htmlspecialchars(trim($_POST['listname']));
            $search_type =  htmlspecialchars(trim($_POST['offertype']));
            $city_what= htmlspecialchars(trim($_POST['offerwhat']));
            $city_where =  htmlspecialchars(trim($_POST['offerwhere']));
            $number= htmlspecialchars(trim($_POST['offernumber']));
            $start_date =  htmlspecialchars(trim($_POST['offerstartdate']));
            $expires_before= htmlspecialchars(trim($_POST['offerexpiresbefore']));
            
            $result = $wpdb->insert( $citygrid_table, 
        		  		  array('api_type' => $cityapitype, 'name' => $name,'search_type' => $search_type,"city_what"=>$city_what,'city_where' => $city_where,"number"=>$number,'start_date' => $start_date,"expires_before"=>$expires_before), 
        		  		  array( '%d','%s','%s','%s' ,'%s','%s'  ,'%s','%s' ) );
        }
        if($cityapitype==3){
            
            $name =  htmlspecialchars(trim($_POST['listname']));
            $search_type =  htmlspecialchars(trim($_POST['reviewtype']));
            $city_what= htmlspecialchars(trim($_POST['reviewwhat']));
            $city_where =  htmlspecialchars(trim($_POST['reviewwhere']));
            $number= htmlspecialchars(trim($_POST['reviewnumber']));
            $rating=  htmlspecialchars(trim($_POST['ratings']));
            $days= htmlspecialchars(trim($_POST['days']));
            
            $result = $wpdb->insert( $citygrid_table, 
        		  		  array('api_type' => $cityapitype, 'name' => $name,'search_type' => $search_type,"city_what"=>$city_what,'city_where' => $city_where,"number"=>$number,'rating' => $rating,"days"=>$days), 
        		  		  array( '%d','%s','%s','%s' ,'%s','%s'  ,'%s','%s' ) );
        }
       
       
        
        
        if(FALSE === $result) 
            echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
        else     		
            echo '<div class="updated fade" id="message"><p>Business List is successfully added</p></div>';
        
    }
    
    /**
     *
     * update citygrid list 
     *  
     * 
    */
    
    public function update(){
        
        global $wpdb;
       	$citygrid_table = $wpdb->prefix . "citygrid_list";
        		
        $cityapitype         = htmlspecialchars(trim($_POST['cityapitype']));
        $id =  htmlspecialchars(trim($_POST['id']));
        
        if($cityapitype==1){
            
            $name =  htmlspecialchars(trim($_POST['listname']));
            $search_type =  htmlspecialchars(trim($_POST['palcestype']));
            $city_what= htmlspecialchars(trim($_POST['placeswhat']));
            $city_where =  htmlspecialchars(trim($_POST['placeswhere']));
            $number= htmlspecialchars(trim($_POST['placesnumber']));
            
                          
            $result = $wpdb->update( $citygrid_table, 
                                    array( 'api_type' => $cityapitype, 'name' => $name,'search_type' => $search_type,"city_what"=>$city_what,'city_where' => $city_where,"number"=>$number ), 
                                    array( 'id' => $id ), 
                                    array( '%d','%s','%s','%s' ,'%s','%s'  ), 
                                    array( '%d' ) );
                              
        }
        if($cityapitype==2){
            
            $name =  htmlspecialchars(trim($_POST['listname']));
            $search_type =  htmlspecialchars(trim($_POST['offertype']));
            $city_what= htmlspecialchars(trim($_POST['offerwhat']));
            $city_where =  htmlspecialchars(trim($_POST['offerwhere']));
            $number= htmlspecialchars(trim($_POST['offernumber']));
            $start_date =  htmlspecialchars(trim($_POST['offerstartdate']));
            $expires_before= htmlspecialchars(trim($_POST['offerexpiresbefore']));
            
                           
           $result = $wpdb->update( $citygrid_table, 
                            	  array('api_type' => $cityapitype, 'name' => $name,'search_type' => $search_type,"city_what"=>$city_what,'city_where' => $city_where,"number"=>$number,'start_date' => $start_date,"expires_before"=>$expires_before), 
                                array( 'id' => $id ), 
                                array( '%d','%s','%s','%s' ,'%s','%s'  ,'%s','%s' ), 
                                array( '%d' ) );
                                        
        }
        if($cityapitype==3){
            
            $name =  htmlspecialchars(trim($_POST['listname']));
            $search_type =  htmlspecialchars(trim($_POST['reviewtype']));
            $city_what= htmlspecialchars(trim($_POST['reviewwhat']));
            $city_where =  htmlspecialchars(trim($_POST['reviewwhere']));
            $number= htmlspecialchars(trim($_POST['reviewnumber']));
            $rating=  htmlspecialchars(trim($_POST['ratings']));
            $days= htmlspecialchars(trim($_POST['days']));
            
            
                             
           $result = $wpdb->update( $citygrid_table, 
        		  		  array('api_type' => $cityapitype, 'name' => $name,'search_type' => $search_type,"city_what"=>$city_what,'city_where' => $city_where,"number"=>$number,'rating' => $rating,"days"=>$days), 
                                array( 'id' => $id ), 
                                array( '%d','%s','%s','%s' ,'%s','%s'  ,'%s','%s' ), 
                                array( '%d' ) );
        
        }
       
       
        
        
        if(FALSE === $result) 
            echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
        else     		
            echo '<div class="updated fade" id="message"><p>Business List is successfully Updated</p></div>';
        
    }
    
    
    /**
    *   delete the schedule list 
    */
    public function delete(){
        global $wpdb;
    	$citygrid_table = $wpdb->prefix . "citygrid_list"; 
        
        //print_r($_GET);die;
        $id=$_GET['id'];
    	if($id){
    	   
    		$sql = "DELETE from $citygrid_table WHERE id = " . $id ;
        
            if(FALSE === $wpdb->query($sql)) 
                echo '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';		
    		else
                echo '<div class="updated fade" id="message"><p>Business List is successfully  deleted.</p></div>';
                
    		
    	} 
        
        $this->index();
    }
    
    /**
    *    bulck delete  delete the schedule list 
    */
    
    /*
    public function bulckdelete(){
        global $wpdb;
    	$citygrid_table = $wpdb->prefix . "citygrid_list"; 
        
        
        if($_REQUEST['bulkcheck']){
                
                $sql = "DELETE from $citygrid_table WHERE  id IN (".implode(', ', $_REQUEST['bulkcheck']).")";  
                
                if(FALSE === $wpdb->query($sql)) 
                    echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
                else     		
                    echo '<div class="updated fade" id="message"><p>Citygrid list is successfully deleted</p></div>';
                
        }
        
    	
        
        $this->index();
    }
    */    
 
 }?>