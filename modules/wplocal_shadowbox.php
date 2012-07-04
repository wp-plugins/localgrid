<?php
/**
 *  wplocal_citygridlist CLASS FOR ADMIN
 *
 * @link http://www.mdimran.net/
 * @author Imran <imran.aspire@gmail.com>
 *
 */
 
 class wplocal_shadowbox{
    
     /**
     * Default Action of  wplocal_citygridlist
     */
    public function index(){
        
        $this->condition();
        global $wpdb;
    	$per_page = get_option('citygrid_shadobox_perpage');
        
       	$shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs";
        
        // check the codition
        
       
        
        
        $sql= "SELECT  *from $shadowbox_table ";
        
   
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
            
            
    		$elem_list .= "<tr{$alternate}>";
    		$elem_list .= "<th scope=\"row\" class=\"check-column\"><input type=\"checkbox\" name=\"bulkcheck[]\" value=\"" .  $row->id . "\" /></th>";
    		$elem_list .= "<td>". $row->id .'</td>';
            $elem_list .= "<td>". $row->name .'</td>';
            $elem_list .= "<td>". $row->date .'</td>';
            
        	$elem_list .= '<td style="text-align:center"><a href="'. $_SERVER['PHP_SELF'] . "?page=wplocal_shadowbox&amp;action=edit&amp;id=" . $row->id . '" class="delete">Edit</a></td>';
    		$elem_list .= '<td style="text-align:center"><a href="'. $_SERVER['PHP_SELF'] . "?page=wplocal_shadowbox&amp;action=delete&amp;id=" . $row->id . '" onclick="return confirm(\'Are you sure you want to delete this Shado boxes  ?\');" class="delete">Delete</a></td>';
    		$elem_list .= "</tr>";
    	}
    
?>
       
       	<div class="wrap">
		
		<?php if($msg): ?><div id="message" class="updated fade"><p><?php echo $msg; ?></p></div><?php endif; ?>
		
		<h2>Shado boxes Management</h2>
		
		<?php if($elem_list): ?>
		
		<p>Currently, you have <?php echo localgrid_get_numof_records_bysql($total_sql); ?> Shado boxes </p>
		
		<form id="record_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wplocal_shadowbox">
			<div class="tablenav">
				<div class="alignleft actions" id="toptab">
					<p>
                    <input type="submit" name="bulkaction" value="Delete" onclick="return confirm('Are you sure you want to delete these   Shado boxes     ?');" class="button-secondary" />
					Sort by:
					</p>
                    <p>
                    <select style="width: 100px;" name="criteria">
						<option value="id"<?php echo $option_selected['id']; ?>>ID</option>
                         <option value="name"<?php echo $option_selected['name']; ?>>Name</option>
                        <option value="date"<?php echo $option_selected['date']; ?>>Date</option>
                       
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
                    <p>    &nbsp;&nbsp;&nbsp; Schedule Per page <input style="width: 50px;" type="text" value="<?php echo get_option("citygrid_shadobox_perpage") ?>" name="citygrid_shadobox_perpage" />
                    <input type="submit" name="citygrid_shadobox_perpage_submit" value="update" />
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
                        
                        <th colspan="2" style="text-align:center">Action</th>
                        
					</tr></thead>
					
					<tbody id="the-list"><?php echo $elem_list; ?></tbody>
				</table>
				
			<div class="tablenav">
				<div class="alignleft actions">
					<input type="submit" name="bulkaction" value="Delete" onclick="return confirm('Are you sure you want to delete these  Shado boxes   ?');" class="button-secondary" />
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
		<?php $this->addShadowBox();?>
	   </div>
       

<?php        
    }
     /**
     *   show the add box of citygrid list
     */
    public function addShadowBox($id=0){
        global $wpdb;
        $shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs";
        
        $lable="ADD";
        if($id){
            $lable="Edit";
            $sql="Select *from $shadowbox_table where id=$id";
            $list_result=$wpdb->get_row($sql);
            //echo $list_result->api_type.">>>>>"; 
         
        }
        ?>
       
         <div class="wrap" style="padding-top: 15px;">
            <div id="poststuff" class="metabox-holder has-right-sidebar">
                <div class="postbox " style=""> 
              


                    <h3 class="hndle" ><span><?php echo $lable; ?>Shado boxes </span></h3>
                    <div class="inside" style="padding: 0px 10px 0 10px">
                       <form id="addshadowbox"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wplocal_shadowbox">
                            
                            <div class="exBox2">
                                <label>Name</label><input type="text" value="<?php echo $list_result->name; ?>" name="name" id="name" />
                            </div>
                            <div class="exBox2">
                                <label>Height</label><input type="text" value="<?php echo $list_result->height; ?>" name="height" id="height" />
                            </div>
                            <div class="exBox2">
                                <label>Width</label><input type="text" value="<?php echo $list_result->width; ?>" name="width" id="width" />
                            </div>
                            <div class="exBox2">
                                <label>Content</label>
                                     <?php
                                     $content="";
                                     if($list_result->content)
                                        $content=htmlspecialchars_decode(stripcslashes($list_result->content));
                                      the_editor("$content", "content", "", false);  ?> 
                            </div>
                            
                           <?php if($id!=""){ ?>
                                <p><input type="submit" name="shadowbox_update" value="Update Shado boxes " /></p>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                            <?php }else{ ?>
                                <p><input type="submit" name="shadowbox_submit" value="Add Shado boxes " /></p> 
                            <?php } ?>  
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
        if(isset($_POST['shadowbox_submit']))
           $this->add();
        
        if(isset($_POST['shadowbox_update']))
            $this->update();
        
        
        if(isset($_POST['citygrid_shadobox_perpage_submit'])){
          
           if($_POST['citygrid_shadobox_perpage']!="" ){
              update_option("citygrid_shadobox_perpage",$_POST['citygrid_shadobox_perpage']); 
           }
           
             
        }
         // delete bulk comments 
        
        if($_REQUEST['bulkaction'] == __('Delete')){
            global $wpdb;
        	$shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs"; 
            
            
            if($_REQUEST['bulkcheck']){
                    
                    $sql = "DELETE from $shadowbox_table WHERE  id IN (".implode(', ', $_REQUEST['bulkcheck']).")";  
                    
                    if(FALSE === $wpdb->query($sql)) 
                        echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
                    else     		
                        echo '<div class="updated fade" id="message"><p>Citygrid list is successfully deleted</p></div>';
                    
            }
        
        }
            
            
        
    }
    public function edit(){
        $this->addShadowBox($_GET['id']);
    }
    
     /**
     *   add the citygrid list 
     */
    public function add(){
       
        global $wpdb;
       	$shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs";
        
        
        $name =  htmlspecialchars(trim($_POST['name']));
        $height =  htmlspecialchars(trim($_POST['height']));
        $width= htmlspecialchars(trim($_POST['width']));
        $content =  htmlspecialchars(trim($_POST['content']));
        
        $result = $wpdb->insert( $shadowbox_table, 
    		  		  array('name' => $name, 'height' => $height,'width' => $width,"content"=>$content), 
        		  	   array( '%s','%s','%s','%s'   ) );
        
        
        
        if(FALSE === $result) 
            echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
        else     		
            echo '<div class="updated fade" id="message"><p>Shado boxes is successfully added</p></div>';
        
    }
    
    /**
     *
     * update citygrid list 
     *  
     * 
    */
    
    public function update(){
        
        
        global $wpdb;
       	$shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs";
        
        $id =  htmlspecialchars(trim($_POST['id']));
        $name =  htmlspecialchars(trim($_POST['name']));
        $height =  htmlspecialchars(trim($_POST['height']));
        $width= htmlspecialchars(trim($_POST['width']));
        $content =  htmlspecialchars(trim($_POST['content']));
        
       
         $result = $wpdb->update( $shadowbox_table, 
    		  		  array('name' => $name, 'height' => $height,'width' => $width,"content"=>$content), 
                                    array( 'id' => $id ), 
                                    array( '%s','%s','%s','%s'   ), 
                                    array( '%d' ) );
        
       
        
        
        if(FALSE === $result) 
            echo  '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';
        else     		
            echo '<div class="updated fade" id="message"><p>Shadobox is successfully Updated</p></div>';
        
    }
    
    
    /**
    *   delete the schedule list 
    */
    public function delete(){
        global $wpdb;
    	$shadowbox_table = $wpdb->prefix . "wplocal_shadoboxs";
        
        //print_r($_GET);die;
        $id=$_GET['id'];
    	if($id){
    	   
    		$sql = "DELETE from $shadowbox_table WHERE id = " . $id ;
        
            if(FALSE === $wpdb->query($sql)) 
                echo '<div class="updated fade" id="message"><p>There was an error in the MySQL query</p></div>';		
    		else
                echo '<div class="updated fade" id="message"><p>Shadobox is successfully  deleted.</p></div>';
                
    		
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