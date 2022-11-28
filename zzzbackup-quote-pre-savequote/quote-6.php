<?php

/*
echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/

$orderid = postdb('strOrderID');
$strDeposit = postdb('strDeposit');

$Pickup_Contact = postdb('strPickup_Contact');
$Pickup_Company = postdb('strPickup_Company');
$Pickup_Address1 = postdb('strPickup_Address1');
$Pickup_Address2 = postdb('strPickup_Address2');
$Pickup_City = postdb('strPickup_City');
$Pickup_NearCity = postdb('strPickup_NearCity');
$Pickup_State = postdb('strPickup_State');
$Pickup_Zip = postdb('strPickup_Zip');
$Pickup_Location_Type = postdb('strPickup_Location_Type');
$Pickup_Location_Hours = postdb('strPickup_Location_Hours');
$Pickup_HomePhone = postdb('strPickup_HomePhone');
$Pickup_WorkPhone = postdb('strPickup_WorkPhone');
$Pickup_CellPhone = postdb('strPickup_CellPhone');
$Pickup_ExtraInst = postdb('strPickup_ExtraInst');
$Pickup_ExtraInst_send = postdb('strPickup_ExtraInst_send');

$Deliver_Contact = postdb('strDeliver_Contact');
$Deliver_Company = postdb('strDeliver_Company');
$Deliver_Address1 = postdb('strDeliver_Address1');
$Deliver_Address2 = postdb('strDeliver_Address2');
$Deliver_City = postdb('strDeliver_City');
$Deliver_NearCity = postdb('strDeliver_NearCity');
$Deliver_State = postdb('strDeliver_State');
$Deliver_Zip = postdb('strDeliver_Zip');
$Deliver_Location_Type = postdb('strDeliver_Location_Type');
$Deliver_Location_Hours = postdb('strDeliver_Location_Hours');
$Deliver_HomePhone = postdb('strDeliver_HomePhone');
$Deliver_WorkPhone = postdb('strDeliver_WorkPhone');
$Deliver_CellPhone = postdb('strDeliver_CellPhone');
$Deliver_ExtraInst = postdb('strDeliver_ExtraInst');
$Deliver_ExtraInst_send = postdb('strDeliver_ExtraInst_send');


$sql = "update orders set 
        Pickup_Contact = '$Pickup_Contact',
        Pickup_Company = '$Pickup_Company',
        Pickup_Address1 = '$Pickup_Address1',
        Pickup_Address2 = '$Pickup_Address2',
        Pickup_City = '$Pickup_City',
        Pickup_NearCity = '$Pickup_NearCity',
        Pickup_State = '$Pickup_State',
        Pickup_Zip = '$Pickup_Zip',
        Pickup_Location_Type = '$Pickup_Location_Type',
        Pickup_Location_Hours = '$Pickup_Location_Hours',
        Pickup_HomePhone = '$Pickup_HomePhone',
        Pickup_WorkPhone = '$Pickup_WorkPhone',
        Pickup_CellPhone = '$Pickup_CellPhone',
        Pickup_ExtraInst = '$Pickup_ExtraInst',
        Pickup_ExtraInst_send = '$Pickup_ExtraInst_send',
        Deliver_Contact = '$Deliver_Contact',
        Deliver_Company = '$Deliver_Company',
        Deliver_Address1 = '$Deliver_Address1',
        Deliver_Address2 = '$Deliver_Address2',
        Deliver_City = '$Deliver_City',
        Deliver_NearCity = '$Deliver_NearCity',
        Deliver_State = '$Deliver_State',
        Deliver_Zip = '$Deliver_Zip',
        Deliver_Location_Type = '$Deliver_Location_Type',
        Deliver_Location_Hours = '$Deliver_Location_Hours',
        Deliver_HomePhone = '$Deliver_HomePhone',
        Deliver_WorkPhone = '$Deliver_WorkPhone',
        Deliver_CellPhone = '$Deliver_CellPhone',
        Deliver_ExtraInst = '$Deliver_ExtraInst',
        Deliver_ExtraInst_send = '$Deliver_ExtraInst_send'
        where orderid = $orderid";
$wpdb->query($sql);
    
    
//SALES CONVERSION UPDATE start
$trackid = $_SESSION['trackid'];
if (!empty($trackid)) {
	$sql = "update sale_conversion set dateupdated=NOW(),orderid = $orderid, sale_status = '6. Billing Details' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end


$sql = "select * from orders where orderid = $orderid";
$getorder = $wpdb->get_row($sql,ARRAY_A);

?>



<script>
function useshipfrom()
{
document.mainform.strBilling_Address1.value = '<?php echo $getorder['Pickup_Address1'] ?>';
document.mainform.strBilling_Address2.value = '<?php echo $getorder['Pickup_Address2'] ?>';
document.mainform.strBilling_City.value = '<?php echo $getorder['Pickup_City'] ?>';
document.mainform.strBilling_State.value = '<?php echo $getorder['Pickup_State'] ?>';
document.mainform.strBilling_Zip.value = '<?php echo $getorder['Pickup_Zip'] ?>';
document.mainform.strBilling_Phone.value = '<?php echo $getorder['Pickup_CellPhone'] ?>';
}

function useshipto()
{
document.mainform.strBilling_Address1.value = '<?php echo $getorder['Deliver_Address1'] ?>';
document.mainform.strBilling_Address2.value = '<?php echo $getorder['Deliver_Address2'] ?>';
document.mainform.strBilling_City.value = '<?php echo $getorder['Deliver_City'] ?>';
document.mainform.strBilling_State.value = '<?php echo $getorder['Deliver_State'] ?>';
document.mainform.strBilling_Zip.value = '<?php echo $getorder['Deliver_Zip'] ?>';
document.mainform.strBilling_Phone.value = '<?php echo $getorder['Deliver_CellPhone'] ?>';
}
</script>


<div class="smart-forms">
    
    <form action="?step=7" method="post" name="mainform" id="mainform">
    <input type="hidden" name="orderid" value="<?php echo $orderid ?>">
    <input type="hidden" name="strCustEmail" value="<?php echo $strCustEmail ?>">
    
    
    <?php if(get('fromincompleteemail')=="1") { ?>
    	<b>Shipping From:</b> 
    	<?php echo $getorder['Pickup_City'] ?>, <?php echo $getorder['Pickup_State'] ?>&nbsp;&nbsp;<?php echo $getorder['Pickup_Zip'] ?>
        	
        <b>Shipping To:</b>
        <?php echo $getorder['Deliver_City'] ?>, <?php echo $getorder['Deliver_State'] ?>&nbsp;&nbsp;<?php echo $getorder['Deliver_Zip'] ?>
    	
    	
    	<?php if($getorder['Num_Of_Vehicles']==1) { ?>
    		<b>Type of Vehicle:</b>
    		<?php echo $getorder['Vehicle_Make'] ?> - <?php echo $getorder['Vehicle_Model'] ?>
    	<?php } else {
    		$sql = "select * from orders_vehicles where orderid = $orderid";
    		$OrderVehicle = $wpdb->get_results($sql,ARRAY_A);
    		?>
            <b>Types of Vehicles:</b>
    		<?php
    		$counter=1;
    		foreach ($OrderVehicle as $OrderVehicle_field) {
    		    echo $OrderVehicle_field['Vehicle_Make'] ?> - <?php echo $OrderVehicle_field['Vehicle_Model'] . "<br>";
                $counter++;
            }
    		?>
    
        <?php } ?>
    
    	<b>Operating Condition:</b> 
    	<?php echo $getorder['Quote_vehicle_operational'] ?> and Rolls, Brakes, Steers
        	
        <b>Type of Trailer:</b>
        <?php echo $getorder['Quote_vehicle_trailer'] ?>
    <?php } ?>
    
    
    <div class="section fieldentry">

        <div class="frm-row">
            <div class="colm colm12">
                <strong>Billing Details</strong><br>
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>

        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm3">
            	<div class="imagebox">
                	<img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" style="width:262px;" />
                	<div>Pay a nominal deposit by credit card or checking account and you're setup!</div>
                </div>
            </div>
            <div class="colm colm7">
                <strong>
                Pay The Deposit Using <img src="//d36b03yirdy1u9.cloudfront.net/images/Credit-Card-Logos.jpg" style="vertical-align:baseline;height: 29px; display: inline-block; margin-left: 7px; top: 3px; position: relative;" /><br>
                via Our Secure Merchant Gateway.<br>Your information is protected.
                <br><br>
                Also Works With Your Debit Card.
                <br><br>
                (fill out the form below)
                </strong>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm12">
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm11">
                <strong>Use as Billing Address:</strong><br>
                <a href="javascript:useshipfrom();">Pickup Address</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:useshipto();">Deliver Address</a><br><br>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm5">
                
                <div class="frm-row">
                    <div class="colm colm12">
                        First Name: <span class="smalltext">(As it appears on your card)</span><br>
                        <label class="field append-icon">
                            <input type="text" name="strBilling_FirstName" id="strBilling_FirstName" size="40" value="<?php echo $getorder['CustFirstName'] ?>"><label for="strBilling_FirstName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Last Name: <span class="smalltext">(As it appears on your card)</span><br>
                        <label class="field append-icon">
                            <input type="text" name="strBilling_LastName" id="strBilling_LastName" size="40" value="<?php echo $getorder['CustLastName'] ?>"><label for="strBilling_LastName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Billing Address:<br>
                        <label class="field append-icon">
                            <input type="text" name="strBilling_Address1" id="strBilling_Address1" size="40"><label for="strBilling_Address1" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label><br>
                        <input type="text" name="strBilling_Address2" id="strBilling_Address2" style="margin-top: 10px;">
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        City:<br>
                        <label class="field append-icon">
                            <input type="text" name="strBilling_City" id="strBilling_City" size="30"><label for="strBilling_City" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        State:<br>
                        <label for="strBilling_State" class="field select">
                            <select name="strBilling_State" id="strBilling_State">
                            	<option value="0" SELECTED>-- SELECT STATE --</option>
                            	<option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AL">Alberta (Canada)</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="BC">British Columbia (Canada)</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MB">Manitoba (Canada)</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NB">New Brunswick (Canada)</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="NT">Northwest Territories (Canada)</option>
                                <option value="NS">Nova Scotia (Canada)</option>
                                <option value="NU">Nunavut (Canada)</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="ON">Ontario (Canada)</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="PE">Prince Edward Island (Canada)</option>
                                <option value="QC">Quebec (Canada)</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SK">Saskatchewan (Canada)
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                                <option value="YT">Yukon Territory (Canada)</option>
                            </select>
                            <i class="arrow"></i>
                        </label><span class="req">&nbsp;*</span>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Zip:<br>
                        <label class="field append-icon">
                            <input type="text" name="strBilling_Zip" id="strBilling_Zip" size="10"><label for="strBilling_FirstName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Phone Number:<br>
                        <label class="field append-icon">
                            <input type="text" name="strBilling_Phone" id="strBilling_Phone" size="25" value="<?php echo $getorder['CustPhone1'] ?>"><label for="strBilling_FirstName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                
                <div class="frm-row">
                    <div class="colm colm12">
                        Credit Card Number:<br>
                        <label class="field append-icon">
                            <input type="text" name="strCreditCartNum" id="strCreditCartNum" size="40"><label for="strBilling_FirstName" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label> 
                        </label>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm12">
                        Expiration:<br>
                        <div class="frm-row">
                            <div class="colm colm6">
                                <label for="strCreditCartType" class="field select">
                                    <select name="strCreditCartMonth" id="strCreditCartMonth">
                                        <option value="0" SELECTED>-- MONTH --</option><option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
                                    </select>
                                    <i class="arrow"></i>
                                </label>
                            </div>

                            <div class="colm colm6">
                                <label for="strCreditCartType" class="field select">
                                    <select name="strCreditCartYear" id="strCreditCartYear"><option value="0" SELECTED>-- YEAR --</option>
                                        <?php
                                        $currentyear = date('Y');
                                        $endyear = $currentyear + 15;
                                        for ($y=$currentyear; $y <= $endyear; $y++) {
                                        ?>
                                        <option value="<?php echo substr($y,-2) ?>"><?php echo $y ?></option>
                                        <?php } ?>
                                    </select>
                                    <i class="arrow"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="frm-row">
                    <div class="colm colm12">
                        Security Code Number:&nbsp;&nbsp;<span class="smalltext"><a href="#" onclick="window.open('/wp-content/themes/atdv2/explaincvv.html','popup','toolbar=no,status=no,location=no,menubar=no,height=410,width=400,scrollbars=no'); return false;">What is CVV?</a></span><br>
                        <label class="field append-icon">
                            <input type="text" name="strCreditCartCVV" id="strCreditCartCVV" ><label for="strCreditCartCVV" class="field-icon"><i class="fa fa-asterisk" style="color:#DB3232;"></i></label>
                        </label>

                        &nbsp;&nbsp;
                        
                        
                    </div>
                </div>
                        
                        
                        
            </div>
            <div class="colm colm5" style="margin-top:22px;">
                <div class="imagebox">
                	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote1a-1-v3.jpg" style="width:275px" />
                	<div>Your billing address is where your credit card statements are mailed. The pickup or deliver addresses will autofill if you select either.</div>
                </div>
            </div>
        </div>
         
        <div class="frm-row">
            <div class="colm colm12">
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>
        
        <div class="frm-row">
            <div class="colm colm1"></div>
            <div class="colm colm7">
                
                <div class="frm-row">
                    <div class="colm colm5">
                        Charging to Credit Card:
                    </div>
                    <div class="colm colm7">
                        $<?php echo $strDeposit ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                        Balance Due:
                    </div>
                    <div class="colm colm7">
                        $<?php echo $getorder['Balance'] ?>
                    </div>
                </div>
                <div class="frm-row">
                    <div class="colm colm5">
                    </div>
                    <div class="colm colm7">
                        Payable upon delivery by cash or money order made payable to delivery company.
                        <br><br>
                        <button type="submit" class="goonbutton">
                            Submit Order&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                        </button>
                        <div style="font-size: 13px; text-align: center;">Step 3 of 3&nbsp;&nbsp;&nbsp;</div>
                        <br><br>
                        <div class="AuthorizeNetSeal"> <script type="text/javascript" language="javascript">var ANS_customer_id="7e60afc8-ee4e-47e6-bb36-a60288eaa5ac";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Transaction Processing</a> </div>
                    </div>
                </div>
            </div>
            <div class="colm colm4" style="margin-top:22px;">
                <div class="imagebox">
                	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote3-3.jpg" style="width:275px" />
                	<div>Our credit card merchant gateway is secure and there are no taxes, fuel surcharges or hidden fees.</div>
                </div>
            </div>
        </div>
        


    </form>

</div>