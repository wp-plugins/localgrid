<?php
// short code for all city search page 

add_shortcode("allcity","localgrid_allcity");

function localgrid_allcity($content){
    
    global $post;
    $publisher=get_option('localgrid_citygrid_publisher_key');
  
    
    
        
    if(empty($_GET['action'])){
    
    if(get_option('permalink_structure')=="")
        $pageLink=get_permalink($post->ID)."&action=allcategory";
    else 
        $pageLink=get_permalink($post->ID)."?action=allcategory";  

        
      $allcity_content='<table id="allcitytable" style="width: 100%">
        <tbody><tr>
          <td colspan="3">
            <p class="section-header">USA</p>
          </td>
          
        </tr>
        <tr>
          
            <td width="33%" style="vertical-align: top">
              
                <p class="city"><a href="'.$pageLink.'&location=Albuquerque,NM">Albuquerque</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Anchorage,AK">Anchorage</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Atlanta,GA"><b>Atlanta</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Austin,PA">Austin</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Baltimore,MD">Baltimore</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Baton Rouge,LA">Baton Rouge</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Birmingham,AL">Birmingham</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Boston,MA"><b>Boston</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Buffalo,NY">Buffalo</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Charleston,WV">Charleston</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Charlotte,VT">Charlotte</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Chicago,IL"><b>Chicago</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Cincinnati,OH">Cincinnati</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Cleveland,TN">Cleveland</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Columbus,GA">Columbus</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Dallas,TX"><b>Dallas</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Denver,CO">Denver</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Des-Moines,IA">Des Moines</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Detroit,MI">Detroit</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Fort Worth,TX">Fort Worth</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Fresno,CA">Fresno</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Green Bay,WI">Green Bay</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Hartford,CT">Hartford</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Hawaii,HI">Hawaii</a></p>
              
            </td>
          
            <td width="33%" style="vertical-align: top">
              
                <p class="city"><a href="'.$pageLink.'&location=Houston,TX">Houston</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Indianapolis,IN">Indianapolis</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Jacksonville,FL">Jacksonville</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Kansas City,MO">Kansas City</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Knoxville,TN">Knoxville</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Las Vegas,NV"><b>Las Vegas</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Lexington,KY">Lexington</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Los Angeles,CA"><b>Los Angeles</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Louisville,KY">Louisville</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Memphis,TN">Memphis</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Miami,FL"><b>Miami</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Milwaukee,WI">Milwaukee</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Twin Cities,MN">Minneapolis</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Nashville,TN">Nashville</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=New Orleans,LA">New Orleans</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=New York,NY"><b>New York</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Norfolk,VA">Norfolk</a></p>
              
              
                <p class="city"><a href="'.$pageLink.'&location=Oakland,FL">Oakland</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Oklahoma City,OK">Oklahoma City</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Omaha,NE">Omaha</a></p>
              
               
                <p class="city"><a href="'.$pageLink.'&location=Orlando,FL">Orlando</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Philadelphia,PA">Philadelphia</a></p>
              
            </td>
          
            <td width="33%" style="vertical-align: top">
              
                <p class="city"><a href="'.$pageLink.'&location=Phoenix,AZ">Phoenix</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Pittsburgh,PA">Pittsburgh</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Portland,OR"><b>Portland</b></a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Providence,RI">Providence</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Raleigh,NC">Raleigh</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Research Triangle,NC">Research Triangle</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Richmond,VA">Richmond</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Rochester,NY">Rochester</a></p>
              
               
                <p class="city"><a href="'.$pageLink.'&location=Sacramento,CA">Sacramento</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Salt Lake City,UT">Salt Lake City</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=San-Antonio,TX">San Antonio</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=San-Diego,CA">San Diego</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=San Francisco,CA">San Francisco</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=San Jose,CA">San Jose</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Santa Barbara,CA">Santa Barbara</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Seattle,WA"><b>Seattle</b></a></p>
              
               
                <p class="city"><a href="'.$pageLink.'&location=Stamford,CT">Stamford</a></p>
              
              
                <p class="city"><a href="'.$pageLink.'&location=Tucson,AZ">Tucson</a></p>
              
                <p class="city"><a href="'.$pageLink.'&location=Tulsa,OK">Tulsa</a></p>
              
               
                <p class="city"><a href="'.$pageLink.'&location=Washington DC,DC"><b>Washington DC</b></a></p>
              
            </td>
          
    
        </tr>
      </tbody></table>';
        return $content.$allcity_content;
  
      }
     else if($_GET['action']=="allcategory"){
        
        
        if(get_option('permalink_structure')=="")
            $pageLink=get_permalink($post->ID)."&action=result";
        else 
            $pageLink=get_permalink($post->ID)."?action=result";  

        //print_r($_GET);die;
        $location=$_GET['location'];
        $state=$_GET['state'];
        $pageLink .="&location=$location";
       // echo $pageLink;die;
        $allcity_content ='<h2>'.$location.'</h2><br/><table width="100%">
        <tr>
            <td width="33.3333333333%" valign="top">
                <b>Legal Financial</b>
                <ul>
                    <li><a title="Bail Bonds" href="'.$pageLink.'&btype=Bail Bonds">Bail Bonds</a></li>
                    <li><a title="Banks" href="'.$pageLink.'&btype=Banks">Banks</a></li>
                    <li><a title="Car Insurance" href="'.$pageLink.'&btype=Car Insurance">Car Insurance</a></li>
                    <li><a title="Cash Advances" href="'.$pageLink.'&btype=Cash Advances">Cash Advances</a></li>
                    <li><a title="Criminal Defense Lawyer" href="'.$pageLink.'&btype=Criminal Defense Lawyer">Criminal Defense Lawyer</a></li>
                    <li><a title="Debt Consolidation" href="'.$pageLink.'&btype=Debt Consolidation">Debt Consolidation</a></li>
                    <li><a title="Divorce Lawyers" href="'.$pageLink.'&btype=Divorce Lawyers">Divorce Lawyers</a></li>
                    <li><a title="Family Law" href="'.$pageLink.'&btype=Family Law">Family Law</a></li>
                    <li><a title="Health Insurance" href="'.$pageLink.'&btype=Health Insurance">Health Insurance</a></li>
                    <li><a title="Insurance" href="'.$pageLink.'&btype=Insurance">Insurance</a></li>
                    <li><a title="Insurance Agents" href="'.$pageLink.'&btype=Insurance Agents">Insurance Agents</a></li>
                    <li><a title="Lawyers" href="'.$pageLink.'&btype=Lawyers">Lawyers</a></li>
                    <li><a title="Life Insurance" href="'.$pageLink.'&btype=Life Insurance">Life Insurance</a></li>
                    <li><a title="Personal Injury Lawyers" href="'.$pageLink.'&btype=Personal Injury Lawyers">Personal Injury Lawyers</a></li>
                    <li><a title="Personal Loans" href="'.$pageLink.'&btype=Personal Loans">Personal Loans</a></li>
                    <li><a title="Legal &amp; Financial" href="'.$pageLink.'&btype=Legal %26 Financial">Legal and Financial</a></li>
                    <br>
                </ul>
                <b>Home &amp; Garden</b>
                <ul>
                    <li><a title="Air Conditioning Repair" href="'.$pageLink.'&btype=Air Conditioning Repair">Air Conditioning Repair</a></li>
                    <li><a title="Air Conditioning Units" href="'.$pageLink.'&btype=Air Conditioning Units">Air Conditioning Units</a></li>
                    <li><a title="Carpet Cleaners" href="'.$pageLink.'&btype=Carpet Cleaners">Carpet Cleaners</a></li>
                    <li><a title="Carpet Stores" href="'.$pageLink.'&btype=Carpet Stores">Carpet Stores</a></li>
                    <li><a title="Fencing Contractors" href="'.$pageLink.'&btype=Fencing Contractors">Fencing Contractors</a></li>
                    <li><a title="Flooring" href="'.$pageLink.'&btype=Flooring">Flooring</a></li>
                    <li><a title="Furniture Stores" href="'.$pageLink.'&btype=Furniture Stores">Furniture Stores</a></li>
                    <li><a title="Home Improvement" href="'.$pageLink.'&btype=Home Improvement">Home Improvement</a></li>
                    <li><a title="Home Security Systems" href="'.$pageLink.'&btype=Home Security Systems">Home Security Systems</a></li>
                    <li><a title="House Cleaning" href="'.$pageLink.'&btype=House Cleaning">House Cleaning</a></li>
                    <li><a title="Laminate Flooring" href="'.$pageLink.'&btype=Laminate Flooring">Laminate Flooring</a></li>
                    <li><a title="Locksmiths" href="Locksmiths">Locksmiths</a></li>
                    <li><a title="Pest Control" href="'.$pageLink.'&btype=Pest Control">Pest Control</a></li>
                    <li><a title="Plumbers" href="'.$pageLink.'&btype=Plumbers">Plumbers</a></li>
                    <li><a title="Swimming Pool Contractors" href="'.$pageLink.'&btype=Swimming Pool Contractors">Swimming Pool Contractors</a></li>
                    <li><a title="Home &amp; Garden" href="'.$pageLink.'&btype=Home %26 Garden">Home and Garden</a></li>
                    <br>
                </ul>
                <b>Construction &amp; Contractors</b>
                <ul>
                    <li><a title="Air Conditioning Contractors" href="'.$pageLink.'&btype=Air Conditioning Contractors">Air Conditioning Contractors</a></li>
                    <li><a title="Concrete Contractors" href="'.$pageLink.'&btype=Concrete Contractors">Concrete Contractors</a></li>
                    <li><a title="Construction Equipment Rental" href="'.$pageLink.'&btype=Construction Equipment Rental">Construction Equipment Rental</a></li>
                    <li><a title="Contractors" href="'.$pageLink.'&btype=Contractors">Contractors</a></li>
                    <li><a title="Electricians" href="'.$pageLink.'&btype=Electricians">Electricians</a></li>
                    <li><a title="Heating Contractors" href="'.$pageLink.'&btype=Heating Contractors">Heating Contractors</a></li>
                    <li><a title="Heating Repair" href="'.$pageLink.'&btype=Heating Repair">Heating Repair</a></li>
                    <li><a title="Mold Inspection" href="'.$pageLink.'&btype=Mold Inspection">Mold Inspection</a></li>
                    <li><a title="Painting Contractors" href="'.$pageLink.'&btype=Painting Contractors">Painting Contractors</a></li>
                    <li><a title="Plumbing" href="'.$pageLink.'&btype=Plumbing">Plumbing</a></li>
                    <li><a title="Replacement Windows" href="'.$pageLink.'&btype=Replacement Windows">Replacement Windows</a></li>
                    <li><a title="Roofers" href="'.$pageLink.'&btype=Roofers">Roofers</a></li>
                    <li><a title="Roofing" href="'.$pageLink.'&btype=Roofing">Roofing</a></li>
                    <li><a title="Siding Contractors" href="'.$pageLink.'&btype=Siding Contractors">Siding Contractors</a></li>
                    <li><a title="Storage Containers" href="'.$pageLink.'&btype=Storage Containers">Storage Containers</a></li>
                    <li><a title="Construction &amp; Contractors" href="'.$pageLink.'&btype=Construction %26 Contractors">Construction and Contractors</a></li>
                    <br>
                </ul>
                <b>Automotive</b>
                <ul>
                    <li><a title="Auto Parts" href="'.$pageLink.'&btype=Auto Parts">Auto Parts</a></li>
                    <li><a title="Auto Repair Shops" href="'.$pageLink.'&btype=Auto Repair Shops">Auto Repair Shops</a></li>
                    <li><a title="Car Sales" href="'.$pageLink.'&btype=Car Sales">Car Sales</a></li>
                    <li><a title="Junk Car Removal" href="'.$pageLink.'&btype=Junk Car Removal">Junk Car Removal</a></li>
                    <li><a title="Junk Yards" href="'.$pageLink.'&btype=Junk Yards">Junk Yards</a></li>
                    <li><a title="Rental Cars" href="'.$pageLink.'&btype=Rental Cars">Rental Cars</a></li>
                    <li><a title="Tires For Sale" href="'.$pageLink.'&btype=Tires For Sale">Tires For Sale</a></li>
                    <li><a title="Transmission Repair" href="'.$pageLink.'&btype=Transmission Repair">Transmission Repair</a></li>
                    <li><a title="Used Cars" href="'.$pageLink.'&btype=Used Cars">Used Cars</a></li>
                    <li><a title="Windshield Replacement" href="'.$pageLink.'&btype=Windshield Replacement">Windshield Replacement</a></li>
                    <li><a title="Automotive" href="'.$pageLink.'&btype=Automotive">Automotive</a></li>
                    <br>
                </ul>
            </td>
            <td width="33.3333333333%" valign="top">
                <b>Business &amp; Professional Services</b>
                <ul>
                    <li><a title="Employment" href="'.$pageLink.'&btype=Employment">Employment</a></li>
                    <li><a title="Employment Agencies" href="'.$pageLink.'&btype=Employment Agencies">Employment Agencies</a></li>
                    <li><a title="Home Security Systems" href="'.$pageLink.'&btype=Home Security Systems">Home Security Systems</a></li>
                    <li><a title="Janitorial Services" href="'.$pageLink.'&btype=Janitorial Services">Janitorial Services</a></li>
                    <li><a title="Office Furniture" href="'.$pageLink.'&btype=Office Furniture">Office Furniture</a></li>
                    <li><a title="Paper Shredding" href="'.$pageLink.'&btype=Paper Shredding">Paper Shredding</a></li>
                    <li><a title="Private Investigators" href="'.$pageLink.'&btype=Private Investigators">Private Investigators</a></li>
                    <li><a title="Screen Printing" href="'.$pageLink.'&btype=Screen Printing">Screen Printing</a></li>
                    <li><a title="Security Guards" href="'.$pageLink.'&btype=Security Guards">Security Guards</a></li>
                    <li><a title="Temp Agencies" href="'.$pageLink.'&btype=Temp Agencies">Temp Agencies</a></li>
                    <li><a title="Business &amp; Professional Services" href="'.$pageLink.'&btype=Business %26 Professional Services">Business And Professional Services</a></li>
                    <br>
                </ul>
                <b>Health &amp; Medicine</b>
                <ul>
                    <li><a title="Chiropractors" href="'.$pageLink.'&btype=Chiropractors">Chiropractors</a></li>
                    <li><a title="Dental Insurance" href="'.$pageLink.'&btype=Dental Insurance">Dental Insurance</a></li>
                    <li><a title="Dentists" href="'.$pageLink.'&btype=Dentists">Dentists</a></li>
                    <li><a title="Doctors" href="'.$pageLink.'&btype=Doctors">Doctors</a></li>
                    <li><a title="Drug Treatment Centers" href="'.$pageLink.'&btype=Drug Treatment Centers">Drug Treatment Centers</a></li>
                    <li><a title="Paternity Testing" href="'.$pageLink.'&btype=Paternity Testing">Paternity Testing</a></li>
                    <li><a title="Pharmacies" href="'.$pageLink.'&btype=Pharmacies">Pharmacies</a></li>
                    <li><a title="Health &amp; Medicine" href="'.$pageLink.'&btype=Health %26 Medicine">Health and Medicine</a></li>
                    <br>
                </ul>
                <b>Travel &amp; Transportation</b>
                <ul>
                    <li><a title="Bus Charter" href="'.$pageLink.'&btype=Bus Charter">Bus Charter</a></li>
                    <li><a title="Hotel Reservations" href="'.$pageLink.'&btype=Hotel Reservations">Hotel Reservations</a></li>
                    <li><a title="Hotels" href="'.$pageLink.'&btype=Hotels">Hotels</a></li>
                    <li><a title="Limo Services" href="'.$pageLink.'&btype=Limo Services">Limo Services</a></li>
                    <li><a title="Motels" href="'.$pageLink.'&btype=Motels">Motels</a></li>
                    <li><a title="Movers" href="'.$pageLink.'&btype=Movers">Movers</a></li>
                    <li><a title="Moving Companies" href="'.$pageLink.'&btype=Moving Companies">Moving Companies</a></li>
                    <li><a title="Self Storage" href="'.$pageLink.'&btype=Self Storage">Self Storage</a></li>
                    <li><a title="Travel Agents" href="'.$pageLink.'&btype=Travel Agents">Travel Agents</a></li>
                    <li><a title="Trucking Companies" href="'.$pageLink.'&btype=Trucking Companies">Trucking Companies</a></li>
                    <li><a title="Travel &amp; Transportation" href="'.$pageLink.'&btype=Travel %26 Transportation">Travel and Transportation</a></li>
                    <br>
                </ul>
                <b>Shopping</b>
                <ul>
                    <li><a title="Balloons" href="'.$pageLink.'&btype=Balloons">Balloons</a></li>
                    <li><a title="Florists" href="'.$pageLink.'&btype=Florists">Florists</a></li>
                    <li><a title="Funeral Flowers" href="'.$pageLink.'&btype=Funeral Flowers">Funeral Flowers</a></li>
                    <li><a title="Wedding Flowers" href="'.$pageLink.'&btype=Wedding Flowers">Wedding Flowers</a></li>
                    <li><a title="Shopping" href="'.$pageLink.'&btype=Shopping">Shopping</a></li>
                    <br>
                </ul>
                <b>Education</b>
                <ul>
                    <li><a title="Colleges" href="'.$pageLink.'&btype=Colleges">Colleges</a></li>
                    <li><a title="Dance Studios" href="'.$pageLink.'&btype=Dance Studios">Dance Studios</a></li>
                    <li><a title="Driving Schools" href="'.$pageLink.'&btype=Driving Schools">Driving Schools</a></li>
                    <li><a title="Elementary Schools" href="'.$pageLink.'&btype=Elementary Schools">Elementary Schools</a></li>
                    <li><a title="High Schools" href="'.$pageLink.'&btype=High Schools">High Schools</a></li>
                    <li><a title="Nursing Schools" href="'.$pageLink.'&btype=Nursing Schools">Nursing Schools</a></li>
                    <li><a title="Preschools" href="'.$pageLink.'&btype=Preschools">Preschools</a></li>
                    <li><a title="Schools" href="'.$pageLink.'&btype=Schools">Schools</a></li>
                    <li><a title="Education" href="'.$pageLink.'&btype=Education">Education</a></li>
                    <br>
                </ul>
                <b>Real Estate</b>
                <ul>
                    <li><a title="Apartments" href="'.$pageLink.'&btype=Apartments">Apartments</a></li>
                    <li><a title="Home Inspectors" href="'.$pageLink.'&btype=Home Inspectors">Home Inspectors</a></li>
                    <li><a title="Homeowners Insurance" href="'.$pageLink.'&btype=Homeowners Insurance">Homeowners Insurance</a></li>
                    <li><a title="Mortgage Brokers" href="'.$pageLink.'&btype=Mortgage Brokers">Mortgage Brokers</a></li>
                    <li><a title="Mortgages" href="'.$pageLink.'&btype=Mortgages">Mortgages</a></li>
                    <li><a title="Office Space For Rent" href="'.$pageLink.'&btype=Office Space For Rent">Office Space For Rent</a></li>
                    <li><a title="Real Estate Agents" href="'.$pageLink.'&btype=Real Estate Agents">Real Estate Agents</a></li>
                    <li><a title="Real Estate" href="'.$pageLink.'&btype=Real Estate">Real Estate</a></li>
                    <br>
                </ul>
                <b>Computers &amp; Electronics</b>
                <ul>
                    <li><a title="Computer Repair" href="'.$pageLink.'&btype=Computer Repair">Computer Repair</a></li>
                    <li><a title="Computer Stores" href="'.$pageLink.'&btype=Computer Stores">Computer Stores</a></li>
                    <li><a title="Internet Service Providers" href="'.$pageLink.'&btype=Internet Service Providers">Internet Service Providers</a></li>
                    <li><a title="Internet Services" href="'.$pageLink.'&btype=Internet Services">Internet Services</a></li>
                    <li><a title="Computers &amp; Electronics" href="'.$pageLink.'&btype=Computers %26 Electronics">Computers and Electronics</li>
                    <br>
                </ul>
            </td>
            <td width="33.3333333333%" valign="top">
                        <b>Personal Care Services</b>
                        <ul>
                            <li><a title="Beauty Salons" href="'.$pageLink.'&btype=Beauty Salons">Beauty Salons</a></li>
                            <li><a title="Day Spas" href="'.$pageLink.'&btype=Day Spas">Day Spas</a></li>
                            <li><a title="Health Clubs" href="'.$pageLink.'&btype=Health Clubs">Health Clubs</a></li>
                            <li><a title="Manicures" href="'.$pageLink.'&btype=Manicures">Manicures</a></li>
                            <li><a title="Tanning Salons" href="'.$pageLink.'&btype=Tanning Salons">Tanning Salons</a></li>
                            <li><a title="Personal Care &amp; Services" href="'.$pageLink.'&btype=Personal Care %26 Services">Personal Care and  Services</a></li>
                            <br></ul>
                        <b>Arts &amp; Entertainment</b>
                        <ul>
                            <li><a title="Bars" href="'.$pageLink.'&btype=Bars">Bars</a></li>
                            <li><a title="Concert Tickets" href="'.$pageLink.'&btype=Concert Tickets">Concert Tickets</a></li>
                            <li><a title="Movie Theaters" href="'.$pageLink.'&btype=Movie Theaters">Movie Theaters</a></li>
                            <li><a title="Night Clubs" href="'.$pageLink.'&btype=Night Clubs">Night Clubs</a></li>
                            <li><a title="Sports Tickets" href="'.$pageLink.'&btype=Sports Tickets">Sports Tickets</a></li>
                            <li><a title="Video Game Rentals" href="'.$pageLink.'&btype=Video Game Rentals">Video Game Rentals</a></li>
                            <li><a title="Video Rentals" href="'.$pageLink.'&btype=Video Rentals">Video Rentals</a></li>
                            <li><a title="Arts &amp; Entertainment" href="'.$pageLink.'&btype=Arts %26 Entertainment">Arts and Entertainment</a></li>
                            <br>
                        </ul>
                        <b>Community &amp; Government</b>
                        <ul>
                            <li><a title="Adoption Agencies" href="'.$pageLink.'&btype=Adoption Agencies">Adoption Agencies</a></li>
                            <li><a title="Child Care Centers" href="'.$pageLink.'&btype=Child Care Centers">Child Care Centers</a></li>
                            <li><a title="Child Care Services" href="'.$pageLink.'&btype=Child Care Services">Child Care Services</a></li>
                            <li><a title="Churches" href="'.$pageLink.'&btype=Churches">Churches</a></li>
                            <li><a title="Community Organizations" href="'.$pageLink.'&btype=Community Organizations">Community Organizations</a></li>
                            <li><a title="County Government Offices" href="'.$pageLink.'&btype=County Government Offices">County Government Offices</a></li>
                            <li><a title="Garbage Disposal" href="'.$pageLink.'&btype=Garbage Disposal">Garbage Disposal</a></li>
                            <li><a title="Government Offices" href="'.$pageLink.'&btype=Government Offices">Government Offices</a></li>
                            <li><a title="Post Offices" href="'.$pageLink.'&btype=Post Offices">Post Offices</a></li>
                            <li><a title="Community &amp; Government" href="'.$pageLink.'&btype=Community %26 Government">Community and Government</a></li>
                            <br>
                        </ul>
                        <b>Media &amp; Communications</b>
                        <ul>
                            <li><a title="Answering Services" href="'.$pageLink.'&btype=Answering Services">Answering Services</a></li>
                            <li><a title="Cable TV" href="'.$pageLink.'&btype=Cable TV">Cable TV</a></li>
                            <li><a title="Cell Phones" href="'.$pageLink.'&btype=Cell Phones">Cell Phones</a></li>
                            <li><a title="Custom Signs" href="'.$pageLink.'&btype=Custom Signs">Custom Signs</a></li>
                            <li><a title="Printers" href="'.$pageLink.'&btype=Printers">Printers</a></li>
                            <li><a title="Media &amp; Communications" href="'.$pageLink.'&btype=Media %26 Communications">Media andCommunications</a></li>
                            <br>
                        </ul>
                        <b>Clothing &amp; Accessories</b>
                        <ul>
                            <li><a title="Clothing Stores" href="'.$pageLink.'&btype=Clothing Stores">Clothing Stores</a></li>
                            <li><a title="Custom T-Shirts" href="'.$pageLink.'&btype=Custom T-Shirts">Custom T-Shirts</a></li>
                            <li><a title="Maternity Stores" href="'.$pageLink.'&btype=Maternity Stores">Maternity Stores</a></li>
                            <li><a title="Shoe Stores" href="'.$pageLink.'&btype=Shoe Stores">Shoe Stores</a></li>
                            <li><a title="Wedding Dresses" href="'.$pageLink.'&btype=Wedding Dresses">Wedding Dresses</a></li>
                            <li><a title="Womens Clothing" href="'.$pageLink.'&btype=Women%27s Clothing">Womenns Clothing</a></li>
                            <li><a title="Clothing &amp; Accessories" href="'.$pageLink.'&btype=Clothing %26 Accessories">Clothing and Accessories</a></li><br></ul><b>Food &amp; Dining</b><ul><li><a title="Bbq Restaurants" href="'.$pageLink.'&btype=Bbq Restaurants">Bbq Restaurants</a></li><li><a title="Chinese Food" href="'.$pageLink.'&btype=Chinese Food">Chinese Food</a></li><li><a title="Italian Food" href="'.$pageLink.'&btype=Italian Food">Italian Food</a></li><li><a title="Pizza Delivery" href="'.$pageLink.'&btype=Pizza Delivery">Pizza Delivery</a></li><li><a title="Restaurants" href="'.$pageLink.'&btype=Restaurants">Restaurants</a></li><li><a title="Seafood Restaurants" href="'.$pageLink.'&btype=Seafood Restaurants">Seafood Restaurants</a></li><li><a title="Steak Houses" href="'.$pageLink.'&btype=Steak Houses">Steak Houses</a></li><li><a title="Food &amp; Dining" href="'.$pageLink.'&btype=Food %26 Dining">Food and Dining</a></li><br></ul><b>Industry &amp; Agriculture</b><ul><li><a title="Farm Equipment" href="'.$pageLink.'&btype=Farm Equipment">Farm Equipment</a></li><li><a title="Farm Equipment Rental" href="'.$pageLink.'&btype=Farm Equipment Rental">Farm Equipment Rental</a></li><li><a title="Fence Dealers" href="'.$pageLink.'&btype=Fence Dealers">Fence Dealers</a></li><li><a title="Lumber Dealers" href="'.$pageLink.'&btype=Lumber Dealers">Lumber Dealers</a></li><li><a title="Machine Shops" href="'.$pageLink.'&btype=Machine Shops">Machine Shops</a></li><li><a title="Tree Stump Removal" href="'.$pageLink.'&btype=Tree Stump Removal">Tree Stump Removal</a></li><li><a title="Industry &amp; Agriculture" href="'.$pageLink.'&btype=Industry %26 Agriculture">Industry and Agriculture</a></li><br></ul><b>Sports &amp; Recreation</b><ul><li><a title="Campgrounds" href="'.$pageLink.'&btype=Campgrounds">Campgrounds</a></li><li><a title="Golf Courses" href="'.$pageLink.'&btype=Golf Courses">Golf Courses</a></li><li><a title="Public Golf Courses" href="'.$pageLink.'&btype=Public Golf Courses">Public Golf Courses</a></li><li><a title="RV Dealers" href="'.$pageLink.'&btype=RV Dealers">RV Dealers</a></li><li><a title="Sports Equipment" href="'.$pageLink.'&btype=Sports Equipment">Sports Equipment</a></li><li><a title="Theme Parks" href="'.$pageLink.'&btype=Theme Parks">Theme Parks</a></li>
                            <li><a title="Sports &amp; Recreation" href="'.$pageLink.'&btype=Sports and Recreation">Sports  Recreation</a></li><br></ul></td>
            
            </tr>
            
        </table>';
        return $content.$allcity_content;
     }   
     else if($_GET['action']="result"){
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
    
            
            
			$whatstr="what=".$_GET['btype']."&";
		
			$wherestr="where=".$_GET['location']."&";
		
			$rppstr="rpp=20&";
			
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
			$placesString=$str.$whatstr.$wherestr.$rppstr.$sort_str.$radius_str."publisher=$publisher";
			
		  // echo $placesString;die;
			$locationResult = simplexml_load_file($placesString);
			 
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
            //  print_r($gdata);die;
             $map= make_googlemap($gdata);
             $qstring="<input type='hidden' id='citystring' value='$placesString' />"; 
             $head="<h2>".$_GET['btype']." in ".$_GET['location']."</h2>";
		     $star=1; 
			 if($places->location){
				$result_string=$qstring.$head."<div id='gmap3'></div>".$map.$filtering_str;
				foreach($places->location as $row){
			
					       if($row->rating=="")
                                $row->rating=0;
                            
        					$imgstr="";
        					if($row->image!="")
        						$imgstr='<img width="100" height="90"  src="'.$row->image.'"/>';           
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
            return $content.$style.$result_string;    
     }     
    
        
        //return $content.$allcity_category_content;    
}

?>