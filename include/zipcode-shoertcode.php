<?php
    // add zipcode seach box shortcode 
    
    add_shortcode("localgrid_zipcode","localgrid_zipcode_show");
    
    function localgrid_zipcode_show($content){
        $date=date("Y-m-d",time());
        $result_str= ' 
        
             <div class="wrap" style="padding-top: 15px;">
            <div id="poststuff" class="metabox-holder has-right-sidebar">
                <div class="postbox " style=""> 
              <div class="inside" style="padding: 0px 10px 0 10px">
                       <form id="addcitygridlist"  method="post" action="">
                            
                           
                            <div class="zipexBox">
                                    <label>Category</label>
                                    <select name="cityapitype" id="cityapitype">
                                                <option value="">Select Category</option>
                                                <option  value="1">Places</option>
                                                <option value="2">Offers</option>
                                                <option value="3">Reviews</option>
                                    </select>
                            </div>
                            <div id="placesBox" class="cityBox">
                                <div class="zipexBox">
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
                                <div class="zipexBox">
                                    <label>What</label> <input type="text" value="" name="placeswhat" id="placeswhat" />
                                </div>
                                <div class="zipexBox">
                                    <label>Where</label>
                                    
                                    <input type="text"  value="EX: Cambridge,MA" onblur="if(this.value==\'\'){this.value=\'EX: Cambridge,MA\'};" onfocus="if(this.value==\'EX: Cambridge,MA\'){this.value=\'\'};" name="placeswhere" id="placeswhere" />
       
                                    
                                    <p>Example-zipcode: 91110</p> 
                                </div>
                                
                               <div class="zipexBox">
                                    <label>Number of the result</label> <input type="text" name="placesnumber"  value="20" />
                               </div>
                            </div>
                           
                           <div id="offersBox" class="cityBox">
                                <div class="zipexBox">
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
                                <div class="zipexBox">
                                    <label>What</label> <input type="text"  value=""  name="offerwhat" id="offerwhat" />
                                </div>
                                <div class="zipexBox">
                                    <label>Where</label>
                                    
                                    <input type="text"   value="EX: Cambridge,MA" onblur="if(this.value==\'\'){this.value=\'EX: Cambridge,MA\'};" onfocus="if(this.value==\'EX: Cambridge,MA\'){this.value=\'\'};" name="offerwhere" id="offerwhere" />
                                    <p>Example-zipcode: 91110</p> 
                                </div>
                              
                                <div class="zipexBox">
                                    <label>Start Date</label> <input type="text" class="inputDate" name="offerstartdate" id="offerstartdate"  />
                                    <input type="hidden" id="currentdate"  value="'.$date.'"  />
                                </div>
                                
                                <div class="zipexBox">
                                    <label>Expires before</label> <input type="text" class="inputDate" name="offerexpiresbefore" id="offerexpiresbefore"  />
                                </div>
                               <div class="zipexBox">
                                    <label>Number of the result</label> <input type="text" name="offernumber"   value="20" />
                               </div>
                              
                               	
                            </div>
                           
                           <div id="reviewBox" class="cityBox">
                                <div class="zipexBox">
                                    <label>Review Type</label>
                                    <select name="reviewtype" id="reviewtype">
                                                <option value="">none</option>
                                                <option value="editorial_review">Editorial review </option>
                                                <option value="user_review">User Review </option>
                                                <option value="external_user_review">External user review</option>
                                                
                                    </select>
                                </div>
                                <div class="zipexBox">
                                    <label>What</label> <input type="text" value=""  name="reviewwhat" id="reviewwhat" />
                                </div>
                                <div class="zipexBox">
                                    <label>Where</label>
                                    
                                    <input type="text"  value="EX: Cambridge,MA" onblur="if(this.value==\'\'){this.value=\'EX: Cambridge,MA\'};" onfocus="if(this.value==\'EX: Cambridge,MA\'){this.value=\'\'};" name="reviewwhere" id="reviewwhere" />
       
                                    
                                    <p>Example-zipcode: 91110</p> 
                                </div>
                               
                               <div class="zipexBox">
                                    <label>Number of the result</label> <input type="text" name="reviewnumber"   value="20" />
                               </div>
                              
                              <div class="zipexBox">
                                    <label>Review Ratings</label>  <input type="text" name="ratings" /> 
                                    <p>ratings between 1-10</p> 
                                       
                              </div>
                              
                              <div class="zipexBox">
                                    <label>Age of the review(in days)</label>  <input type="text" name="days" />  
                              </div>
                               	
                            </div>
                            <div style="clear:both;"></div>
                           <p style="width:430px"><input type="button" id="cityPreview" class="cityPreview" value="Search" />
                           <img id="imageloader" class="imageloader" src="'.LG_PLUGIN_URL.'/localgrid/images/loader.gif" />
                           </p>
                        
                           <div id="previewResult" style="position: relative;" >
                           </div>
                           
                           
                           <input type="hidden" id="ajaxurl" value="'.LG_PLUGIN_URL.'/localgrid/include/ajax.php" /> 
                       </form>
                    </div>
                </div>
                
                
                
                
            </div>    
        
        </div>';
      return $content.$result_str;
    }
?>