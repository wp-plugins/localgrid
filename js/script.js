jQuery(function() {
    
        // -----------------------------------
        // ------------ datepicker  ---------- 
        // -----------------------------------
        
    	jQuery('#offerstartdate').DatePicker({
			format:'Y-m-d',
			date: jQuery('#currentdate').val(),
			current: jQuery('#currentdate').val(),
			starts: 1,
			position: 'right',
			onBeforeShow: function(){
				//jQuery('#offerstartdate').DatePickerSetDate(jQuery('#offerstartdate').val(), true);
			},
			onChange: function(formated, dates){
				jQuery('#offerstartdate').val(formated);
				if (jQuery('#closeOnSelect input').attr('checked')) {
					jQuery('#offerstartdate').DatePickerHide();
				}
                
			}
		});
        
        jQuery('#offerexpiresbefore').DatePicker({
			format:'Y-m-d',
			date: jQuery('#currentdate').val(),
			current: jQuery('#currentdate').val(),
			starts: 1,
			position: 'right',
			onBeforeShow: function(){
				//jQuery('#offerexpiresbefore').DatePickerSetDate(jQuery('#offerexpiresbefore').val(), true);
			},
			onChange: function(formated, dates){
				jQuery('#offerexpiresbefore').val(formated);
				if (jQuery('#closeOnSelect input').attr('checked')) {
					jQuery('#offerexpiresbefore').DatePickerHide();
				}
                
			}
		});
       
       // onload select the api types 
       
      
       
       // select the citygrid api types 
       
       jQuery("#cityapitype").change(function(){
            if(jQuery(this).val()!=""){
                  jQuery(".cityBox").slideUp();  
                  if(jQuery(this).val()==1)
                    jQuery("#placesBox").slideDown();  
                  if(jQuery(this).val()==2)
                    jQuery("#offersBox").slideDown();  
                  if(jQuery(this).val()==3)
                    jQuery("#reviewBox").slideDown();  
                      
                      
                
            }
            else
                jQuery(".cityBox").slideUp(); 
       })
       
        
        // addcitygridlist  submit 
        
        jQuery("#cityPreview").click(function(){
            if(jQuery("#listname").val()==""){
               alert("Please Enter Citygrid List Name");
               return false; 
            }
            
            if(jQuery("#cityapitype").val()==""){
               alert("Please Enter Citygrid Search Type");
               return false; 
            }
            
            else if(jQuery("#cityapitype").val()==1){
               if(jQuery("#palcestype").val()==""){
                    if(jQuery("#placeswhat").val()==""){
                        alert("You need to enter at least places type or what type of places ");
                        return false; 
                    }
               
               } 
               
               if(jQuery("#placeswhere").val()=="" || jQuery("#placeswhere").val()=="EX: Cambridge,MA"){
                   alert("Please Enter Where you want to search the place");
                   return false; 
               }
                
            }
            else if(jQuery("#cityapitype").val()==2){
               if(jQuery("#offertype").val()==""){
                    if(jQuery("#offerwhat").val()==""){
                        alert("You need to enter at least offers type or what type of offer");
                        return false; 
                    }
               
               }
               
               if(jQuery("#offerwhere").val()=="" || jQuery("#offerwhere").val()=="EX: Cambridge,MA"){
                   alert("Please Enter Where you want to search the offer");
                   return false; 
               } 
                
            }
            else if(jQuery("#cityapitype").val()==3){
               
                if(jQuery("#reviewwhat").val()==""){
                    alert("You need to enter what review you wnat to search");
                    return false; 
                }
               
               if(jQuery("#reviewwhere").val()=="" || jQuery("#reviewwhere").val()=="EX: Cambridge,MA"){
                   alert("Please Enter Where you want to search the review");
                   return false; 
               } 
                
            }
            
           
           jQuery("#imageloader").css("visibility","visible"); 
           jQuery.post(jQuery("#ajaxurl").val(), jQuery("#addcitygridlist").serialize(),
               function(data) {
                    jQuery("#imageloader").css("visibility","hidden");
                    jQuery("#previewResult").html(data);
                    jQuery("#previewResult").slideDown("slow");
                    
               }
           );
                    
           
           
        });
        
        // submit the citygrid list 
        
        jQuery("#addcitygridlist").submit(function(){
            if(jQuery("#listname").val()==""){
               alert("Please Enter Citygrid List Name");
               return false; 
            }
            
            if(jQuery("#cityapitype").val()==""){
               alert("Please Enter Citygrid Search Type");
               return false; 
            }
            
            else if(jQuery("#cityapitype").val()==1){
               if(jQuery("#palcestype").val()==""){
                    if(jQuery("#placeswhat").val()==""){
                        alert("You need to enter at least places type or what type of places ");
                        return false; 
                    }
               
               } 
               
               if(jQuery("#placeswhere").val()=="" || jQuery("#placeswhere").val()=="EX: Cambridge,MA"){
                   alert("Please Enter Where you want to search the place");
                   return false; 
               }
                
            }
            else if(jQuery("#cityapitype").val()==2){
               if(jQuery("#offertype").val()==""){
                    if(jQuery("#offerwhat").val()==""){
                        alert("You need to enter at least offers type or what type of offer");
                        return false; 
                    }
               
               }
               
               if(jQuery("#offerwhere").val()=="" || jQuery("#offerwhere").val()=="EX: Cambridge,MA"){
                   alert("Please Enter Where you want to search the offer");
                   return false; 
               } 
                
            }
            else if(jQuery("#cityapitype").val()==3){
               
                if(jQuery("#reviewwhat").val()==""){
                    alert("You need to enter what review you wnat to search");
                    return false; 
                }
               
               if(jQuery("#reviewwhere").val()=="" || jQuery("#reviewwhere").val()=="EX: Cambridge,MA"){
                   alert("Please Enter Where you want to search the review");
                   return false; 
               } 
                
            }
            
            
                        
            return true;
        });
        
       
       
       // shadow box submission 
       
       jQuery("#addshadowbox").submit(function(){
            if(jQuery("#name").val()==""){
               alert("Please Enter Shadowbox Name");
               return false; 
            }
            
            if(jQuery("#height").val()==""){
               alert("Please Enter Shadowbox Height");
               return false; 
            }
            if(jQuery("#width").val()==""){
               alert("Please Enter Shadowbox Width");
               return false; 
            }
           
             
       })
      
      // fancy box 
       jQuery("#shadowboxlink").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
                'padding' : '20',
                'overlayColor': '#172525'
               
                 
			});
       // trigger the fancybox      
       jQuery(window).load(shadowboxClick)
       
       // fancybox  i frame 
       
       	jQuery(".readmore").fancybox({
				'width'				: '90%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
       
       // gmap3 script 
       
         
      // get the business detail for palces page by ajax 
      
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
        jQuery("#inline"+id).html('<img class="fancybox-loading2" src="'+jQuery(".baseurl").val()+'/localgrid/images/content-loader.gif" />');
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
      
      // get the business detail for best deal  page by ajax 
      
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
         
        jQuery("#inline"+id).html('<img class="fancybox-loading2" src="'+jQuery(".baseurl").val()+'/localgrid/images/content-loader.gif" />');
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
      
      //
       
    //jQuery("moredetail").fancybox();
});

function shadowboxClick(){
           jQuery("a#shadowboxlink").trigger("click");  
}
function chkNumiric($value){
			  var cell_ptrn=/^\+?\d+$/;
			  var cell_str= $value;
			  if(cell_str!=""){
				  if(cell_str.match(cell_ptrn)==null) 
					return 0;
                  else
                    return 1;
			  }
}


function emailCheck(email){
    var mail_ptrn=/^[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_+])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/;
    var mail_str= email;
    if(mail_str.match(mail_ptrn)==null)
        return 0;
    else 
      return 1;
      
}