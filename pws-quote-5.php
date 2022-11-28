<?php

$CurrentUsername = $_COOKIE['rep'];



$strQuote_shippingfromstateabbr = postdb('strQuote_shippingfromstateabbr');

$strQuote_shippingtostateabbr = postdb('strQuote_shippingtostateabbr');

$strQuote_shippingfromstate = postdb('strQuote_shippingfromstate');

$strQuote_shippingtostate = postdb('strQuote_shippingtostate');

$strQuote_shippingfromcity = postdb('strQuote_shippingfromcity');

$strQuote_shippingtocity = postdb('strQuote_shippingtocity');

$strQuote_shippingfromzip = postdb('strQuote_shippingfromzip');

$strQuote_shippingtozip = postdb('strQuote_shippingtozip');

$strQuote_vehicle_operational = postdb('strQuote_vehicle_operational');

$strQuote_vehicle_trailer = postdb('strQuote_vehicle_trailer');

$totaldistance = postdb('totaldistance');

$strDateAvailable = postdb('strDateAvailable');

$Selected_tier_name = postdb('Selected_tier_name');

$Selected_tier_price = postdb('Selected_tier_price');





$strCustFirstName = postdb('strCustFirstName');

$strCustLastName = postdb('strCustLastName');

$strCustCompany = postdb('strCustCompany');

$strCustEmail = postdb('strCustEmail');



$auto_year = postdb('auto_year');

$auto_make = postdb('auto_make');



//$auto_model = $_REQUEST['auto_model'];



$auto_model = postdb('auto_model');

$auto_price = postdb('auto_price');









$howmany = postdb('howmany');

$numvehicles = postdb('numvehicles');

$auto_year2 = postdb('auto_year2');

$auto_make2 = postdb('auto_make2');

$auto_model2 = postdb('auto_model2');

$auto_price2 = postdb('auto_price2');

$auto_year3 = postdb('auto_year3');

$auto_make3 = postdb('auto_make3');

$auto_model3 = postdb('auto_model3');

$auto_price3 = postdb('auto_price3');

$auto_year4 = postdb('auto_year4');

$auto_make4 = postdb('auto_make4');

$auto_model4 = postdb('auto_model4');

$auto_price4 = postdb('auto_price4');

$auto_year5 = postdb('auto_year5');

$auto_make5 = postdb('auto_make5');

$auto_model5 = postdb('auto_model5');

$auto_price5 = postdb('auto_price5');





$strTotalPrice = postdb('strtotalprice');

$strTotalPrice_exp = postdb('strtotalprice_exp');

$strTotalPrice_rush = postdb('strtotalprice_rush');



$strtotalprice1 = postdb('strtotalprice1');

$strtotalprice1_exp = postdb('strtotalprice1_exp');

$strtotalprice1_rush = postdb('strtotalprice1_rush');



$strtotalprice2 = postdb('strtotalprice2');

$strtotalprice2_exp = postdb('strtotalprice2_exp');

$strtotalprice2_rush = postdb('strtotalprice2_rush');



$strtotalprice3 = postdb('strtotalprice3');

$strtotalprice3_exp = postdb('strtotalprice3_exp');

$strtotalprice3_rush = postdb('strtotalprice3_rush');



$strtotalprice4 = postdb('strtotalprice4');

$strtotalprice4_exp = postdb('strtotalprice4_exp');

$strtotalprice4_rush = postdb('strtotalprice4_rush');



$strtotalprice5 = postdb('strtotalprice5');

$strtotalprice5_exp = postdb('strtotalprice5_exp');

$strtotalprice5_rush = postdb('strtotalprice5_rush');







$strdeposit1_std = postdb('strdeposit1_std');

$strdeposit1_exp = postdb('strdeposit1_exp');

$strdeposit1_rush = postdb('strdeposit1_rush');



$strdeposit2_std = postdb('strdeposit2_std');

$strdeposit2_exp = postdb('strdeposit2_exp');

$strdeposit2_rush = postdb('strdeposit2_rush');



$strdeposit3_std = postdb('strdeposit3_std');

$strdeposit3_exp = postdb('strdeposit3_exp');

$strdeposit3_rush = postdb('strdeposit3_rush');



$strdeposit4_std = postdb('strdeposit4_std');

$strdeposit4_exp = postdb('strdeposit4_exp');

$strdeposit4_rush = postdb('strdeposit4_rush');



$strdeposit5_std = postdb('strdeposit5_std');

$strdeposit5_exp = postdb('strdeposit5_exp');

$strdeposit5_rush = postdb('strdeposit5_rush');





if($howmany == "onevehicle") {

	$strtotalpriceall_std = $strtotalprice1;

	$strtotalpriceall_exp = $strtotalprice1_exp;

	$strtotalpriceall_rush = $strtotalprice1_rush;

	

	$strdepositall_std = $strdeposit1_std;

	$strdepositall_exp = $strdeposit1_exp;

	$strdepositall_rush = $strdeposit1_rush;

	

} else {

	

	$strtotalpriceall_std = $strtotalprice1;

	if(!empty($strtotalprice2)) {

		$strtotalpriceall_std = $strtotalpriceall_std + $strtotalprice2;

	}

	if(!empty($strtotalprice3)) {

		$strtotalpriceall_std = $strtotalpriceall_std + $strtotalprice3;

	}

	if(!empty($strtotalprice4)) {

		$strtotalpriceall_std = $strtotalpriceall_std + $strtotalprice4;

	}

	if(!empty($strtotalprice5)) {

		$strtotalpriceall_std = $strtotalpriceall_std + $strtotalprice5;

	}

	

	$strtotalpriceall_exp = $strtotalprice1_exp;

	if(!empty($strtotalprice2)) {

		$strtotalpriceall_exp = $strtotalpriceall_exp + $strtotalprice2_exp;

	}

	if(!empty($strtotalprice3)) {

		$strtotalpriceall_exp = $strtotalpriceall_exp + $strtotalprice3_exp;

	}

	if(!empty($strtotalprice4)) {

		$strtotalpriceall_exp = $strtotalpriceall_exp + $strtotalprice4_exp;

	}

	if(!empty($strtotalprice5)) {

		$strtotalpriceall_exp = $strtotalpriceall_exp + $strtotalprice5_exp;

	}

	

	$strtotalpriceall_rush = $strtotalprice1_rush;

	if(!empty($strtotalprice2)) {

		$strtotalpriceall_rush = $strtotalpriceall_rush + $strtotalprice2_rush;

	}

	if(!empty($strtotalprice3)) {

		$strtotalpriceall_rush = $strtotalpriceall_rush + $strtotalprice3_rush;

	}

	if(!empty($strtotalprice4)) {

		$strtotalpriceall_rush = $strtotalpriceall_rush + $strtotalprice4_rush;

	}

	if(!empty($strtotalprice5)) {

		$strtotalpriceall_rush = $strtotalpriceall_rush + $strtotalprice5_rush;

	}

	

	

	

	$strdepositall_std = $strdeposit1_std;

	if(!empty($strdeposit2_std)) {

		$strdepositall_std = $strdepositall_std + $strdeposit2_std;

	}

	if(!empty($strdeposit3_std)) {

		$strdepositall_std = $strdepositall_std + $strdeposit3_std;

	}

	if(!empty($strdeposit4_std)) {

		$strdepositall_std = $strdepositall_std + $strdeposit4_std;

	}

	if(!empty($strdeposit5_std)) {

		$strdepositall_std = $strdepositall_std + $strdeposit5_std;

	}

	

	$strdepositall_exp = $strdeposit1_exp;

	if(!empty($strdeposit2_exp)) {

		$strdepositall_exp = $strdepositall_exp + $strdeposit2_exp;

	}

	if(!empty($strdeposit3_exp)) {

		$strdepositall_exp = $strdepositall_exp + $strdeposit3_exp;

	}

	if(!empty($strdeposit4_exp)) {

		$strdepositall_exp = $strdepositall_exp + $strdeposit4_exp;

	}

	if(!empty($strdeposit5_exp)) {

		$strdepositall_exp = $strdepositall_exp + $strdeposit5_exp;

	}

	

	$strdepositall_rush = $strdeposit1_rush;

	if(!empty($strdeposit2_rush)) {

		$strdepositall_rush = $strdepositall_rush + $strdeposit2_rush;

	}

	if(!empty($strdeposit3_rush)) {

		$strdepositall_rush = $strdepositall_rush + $strdeposit3_rush;

	}

	if(!empty($strdeposit4_rush)) {

		$strdepositall_rush = $strdepositall_rush + $strdeposit4_rush;

	}

	if(!empty($strdeposit5_rush)) {

		$strdepositall_rush = $strdepositall_rush + $strdeposit5_rush;

	}

	

	

}





$depositpervehicle = postdb('depositpervehicle');

$carrierdiscount = postdb('carrierdiscount');

$depositdiscount = postdb('depositdiscount');



$discstatus = postdb('discstatus');

$ps = postdb('ps');



$pricetier = postdb('pricetier');

if ($pricetier==1) {

	$pricetiername = "Standard";

} elseif ($pricetier==2) {

	$pricetiername = "Expedited";

} else {

	$pricetiername = "Rush";

}





$helpfulhintmention = postdb('helpfulhintmention');

$shippingfrom_sales = postdb('shippingfrom_sales');

$auto_copartauction_cost = postdb('auto_copartauction_cost');



$strVehicle_ComingFrom_choice = postdb('strVehicle_ComingFrom_choice');

$strVehicle_ComingFrom = postdb('strVehicle_ComingFrom');

$strVehicle_BuyerNum = postdb('strVehicle_BuyerNum');

$strVehicle_LotNum = postdb('strVehicle_LotNum');

$strVehicle_VIN = postdb('strVehicle_VIN');

$strVehicle_StockNum = postdb('strVehicle_StockNum');



$strDeposit = postdb('strDeposit');

$strDateAvailable = postdb('strDateAvailable');





$rating_origin = postdb('rating_origin');

$rating_dest = postdb('rating_dest');

$rating_vehicle = postdb('rating_vehicle');



/*

$auto_price = postdb('auto_price');

$auto_price2 = postdb('auto_price2');

$auto_price3 = postdb('auto_price3');

$auto_price4 = postdb('auto_price4');

$auto_price5 = postdb('auto_price5');

*/



if (!is_numeric($auto_price)) {

	$auto_price = 0;

}

if (!is_numeric($auto_price2)) {

	$auto_price2 = 0;

}

if (!is_numeric($auto_price3)) {

	$auto_price3 = 0;

}

if (!is_numeric($auto_price4)) {

	$auto_price4 = 0;

}

if (!is_numeric($auto_price5)) {

	$auto_price5 = 0;

}









$strSalesRep  = postdb('strSalesRep');



$strBalance = postdb('strBalance');

$strTotalPrice = postdb('strTotalPrice');



$DaysWaitingPickupTotalOrders = postdb('DaysWaitingPickupTotalOrders');

if (!is_numeric($DaysWaitingPickupTotalOrders)) {

	$DaysWaitingPickupTotalOrders=0;

}



$DaysWaitingPickupAvg = postdb('DaysWaitingPickupAvg');

if (!is_numeric($DaysWaitingPickupAvg)) {

	$DaysWaitingPickupAvg=0;

}



$DaysWaitingDeliverTotalOrders = postdb('DaysWaitingDeliverTotalOrders');

if (!is_numeric($DaysWaitingDeliverTotalOrders)) {

	$DaysWaitingDeliverTotalOrders=0;

}



$DaysWaitingDeliverAvg = postdb('DaysWaitingDeliverAvg');

if (!is_numeric($DaysWaitingDeliverAvg)) {

	$DaysWaitingDeliverAvg=0;

}



$DaysWaitingAvg = postdb('DaysWaitingAvg');

if (!is_numeric($DaysWaitingAvg)) {

	$DaysWaitingAvg=0;

}





$UserIPAddress = getClientIP();



if($howmany != "onevehicle") {

	$strVehicle_Year=$strVehicle_Year1;

	$strVehicle_Make=$strVehicle_Make1;

	$strVehicle_Model=$strVehicle_Model1;

	$strVehicle_AdditionalInfo=$strVehicle_AdditionalInfo1;

}





if ($discstatus != "") {

	$CDDisc = '0';

	$CDRatio = '0';

	$CDRatio_Range = '0-0';

}



if ($_COOKIE['repeat_customer']=="Yes") {

	$repeat_customer = "Yes";

} else {

	$repeat_customer = "No";

}



$emailrefer = $_COOKIE['emailrefer'];

$ihrefer = $_COOKIE['ihrefer'];

$strDateAvailableDB = strtotime($strDateAvailable);

$strDateAvailableDB = date("Y-m-d", $strDateAvailableDB);





/*



$sql = "insert into orders (quoteid,orderversion,SiteName,EmailRefer,ReferringURL,IPNumber,repeat_customer,order_date,Total,Deposit,Balance,pricetier,PriceSource,CDDiscount,CDDisc,CDRatio,CDRatio_Range,CoPart_AutoAuction_Increase,shippingfrom_sales,Status,Quote_shippingfromstate,Quote_shippingtostate,Quote_vehicle_operational,Quote_vehicle_trailer,CustFirstName,CustLastName,CustCompany,CustPhone1,CustEmail,Num_Of_Vehicles,Original_Num_Of_Vehicles,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_ComingFrom,Vehicle_BuyerNumber,Vehicle_LotNumber,Vehicle_VIN,Vehicle_StockNum,DateAvailable,DateAvailable_Initial,distance,SalesRep,rating_origin,rating_dest,rating_vehicle,DaysWaitingPickupTotalOrders,DaysWaitingPickupAvg,DaysWaitingDeliverTotalOrders,DaysWaitingDeliverAvg,DaysWaitingAvg) values  (0,3,'AutoTransportDirect.com','$emailrefer','$ihrefer','$UserIPAddress','$repeat_customer',NOW(),'$strTotalPrice','$strDeposit','$strBalance','$pricetier','$ps','$discstatus','$CDDisc','$CDRatio','$CDRatio_Range',$auto_copartauction_cost,'$shippingfrom_sales','INCOMPLETE','$strQuote_shippingfromstate','$strQuote_shippingtostate','$strQuote_vehicle_operational','$strQuote_vehicle_trailer','$strCustFirstName','$strCustLastName','$strCustCompany','$strCustPhone1','$strCustEmail','$numvehicles','$numvehicles','$auto_year','$auto_make','$auto_model','$strVehicle_ComingFrom','$strVehicle_BuyerNum','$strVehicle_LotNum','$strVehicle_VIN','$strVehicle_StockNum','$strDateAvailableDB','$strDateAvailableDB','$totaldistance','$strSalesRep','$rating_origin','$rating_dest','$rating_vehicle','$DaysWaitingPickupTotalOrders','$DaysWaitingPickupAvg','$DaysWaitingDeliverTotalOrders','$DaysWaitingDeliverAvg','$DaysWaitingAvg')";

*/















$sql = "insert into orders (quoteid,orderversion,SiteName,EmailRefer,ReferringURL,IPNumber,repeat_customer,order_date,Total,Deposit,Balance,total_std,deposit_std,total_exp,deposit_exp,total_rush,deposit_rush,pricetier,PriceSource,CDDiscount,CDDisc,CDRatio,CDRatio_Range,CoPart_AutoAuction_Increase,shippingfrom_sales,Status,Quote_shippingfromstate,Quote_shippingtostate,Quote_vehicle_operational,Quote_vehicle_trailer,CustFirstName,CustLastName,CustCompany,CustPhone1,CustEmail,Num_Of_Vehicles,Original_Num_Of_Vehicles,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_ComingFrom,Vehicle_BuyerNumber,Vehicle_LotNumber,Vehicle_VIN,Vehicle_StockNum,DateAvailable,DateAvailable_Initial,distance,SalesRep,rating_origin,rating_dest,rating_vehicle,DaysWaitingPickupTotalOrders,DaysWaitingPickupAvg,DaysWaitingDeliverTotalOrders,DaysWaitingDeliverAvg,DaysWaitingAvg) values  (0,3,'AutoTransportDirect.com','$emailrefer','$ihrefer','$UserIPAddress','$repeat_customer',NOW(),'$strTotalPrice','$strDeposit','$strBalance','$strtotalpriceall_std','$strdepositall_std','$strtotalpriceall_exp','$strdepositall_exp','$strtotalpriceall_rush','$strdepositall_rush','$pricetier','$ps','$discstatus','$CDDisc','$CDRatio','$CDRatio_Range',$auto_copartauction_cost,'$shippingfrom_sales','INCOMPLETE','$strQuote_shippingfromstate','$strQuote_shippingtostate','$strQuote_vehicle_operational','$strQuote_vehicle_trailer','$strCustFirstName','$strCustLastName','$strCustCompany','$strCustPhone1','$strCustEmail','$numvehicles','$numvehicles','$auto_year','$auto_make','$auto_model','$strVehicle_ComingFrom','$strVehicle_BuyerNum','$strVehicle_LotNum','$strVehicle_VIN','$strVehicle_StockNum','$strDateAvailableDB','$strDateAvailableDB','$totaldistance','$strSalesRep','$rating_origin','$rating_dest','$rating_vehicle','$DaysWaitingPickupTotalOrders','$DaysWaitingPickupAvg','$DaysWaitingDeliverTotalOrders','$DaysWaitingDeliverAvg','$DaysWaitingAvg')";







$wpdb->query($sql);

$strmaxorderid = $wpdb->insert_id;

setcookie("orderid", $strmaxorderid, 0, "/");

//echo $sql.'<br><br>'.$strmaxorderid;



if ($helpfulhintmention != "") {

	if ($helpfulhintmention == "yes") {

		$audit_notes = "Helpful hint was mentioned";

        AuditTrail($strmaxorderid,$CurrentUsername,$audit_notes);

	} elseif ($helpfulhintmention == "ignore") {

		$audit_notes = "Helpful hint was ignored";

        AuditTrail($strmaxorderid,$CurrentUsername,$audit_notes);

	}

}



if ($pricetier == 1) {

    $tiermessage = " / Standard Rate";

} elseif ($pricetier == 2) {

    $tiermessage = " / Expedited Rate";

} elseif ($pricetier == 3) {

    $tiermessage = " / Rush Rate";

}











//SALES CONVERSION UPDATE start

$trackid = $_COOKIE['trackid'];

if (!empty($trackid)) {

	$sql = "update sale_conversion set dateupdated=NOW(),orderid = $strmaxorderid, sale_status = '3. Shipping Details' where trackid = '$trackid'";

    $wpdb->query($sql);

}

//SALES CONVERSION UPDATE end









?>
<script type="text/javascript">
$(document).ready(function() {



    // validate signup form on keyup and submit

    var validator = $("#mainform").validate({

        rules: {



            strPickup_Contact: "required",

            strPickup_Address1: "required",

            strPickup_City: "required",

            strPickup_Zip: "required",

            strDeliver_Contact: "required",

            strDeliver_Address1: "required",

            strDeliver_City: "required",

            strDeliver_Zip: "required",

            strPickup_Phone1: "required",

            strDeliver_Phone1: "required",

            agreetoterms: "required"







        },

        messages: {

            agreetoterms: "You must agree to the Terms & Conditions before proceeding."

        },



        // the errorPlacement has to take the table layout into account

        errorPlacement: function(error, element) {

            if (element.is(":radio"))

                error.appendTo(element.parent().next().next());

            else if (element.is(":checkbox"))

                error.appendTo(element.parent().next('.errormsg'));

            else

                error.insertAfter(element);

        },

        // specifying a submitHandler prevents the default submit, good for the demo

        submitHandler: function() {

            document.mainform.submit();

            //alert('submitted!');

        },

        // set this class to error-labels to indicate valid fields

        success: function(label) {

            // set &nbsp; as text for IE

            label.html("").addClass("checked");

        }

    });



    $(".phoneaddpickuprow1 a").click(function(e) {

        e.preventDefault();

        $(".strPickup_Phone2").show();

        $(".strPickup_Phone1num").show();

        $(".phoneaddpickuprow1").hide();

    });

    $(".phoneaddpickuprow2 a").click(function(e) {

        e.preventDefault();

        $(".strPickup_Phone3").show();

        $(".phoneaddpickuprow2").hide();

    });



    $(".phoneadddeliverrow1 a").click(function(e) {

        e.preventDefault();

        $(".strDeliver_Phone2").show();

        $(".strDeliver_Phone1num").show();

        $(".phoneadddeliverrow1").hide();

    });

    $(".phoneadddeliverrow2 a").click(function(e) {

        e.preventDefault();

        $(".strDeliver_Phone3").show();

        $(".phoneadddeliverrow2").hide();

    });



});
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Poppins');

body,
.smart-forms button,
.smart-forms input,
.smart-forms label,
.smart-forms select,
.smart-forms textarea {
    font-family: "Poppins" !important;
}

.card-container {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
}

.smart-forms {
    background-color: #eee;
}


/***************progress bar************/



 .progressbar_inner{
        display: flex;
        justify-content: space-between;
        /*width: 80%;*/
        margin: 0 auto;
        padding-top: 80px;
    }

    

   .progressbar_inner span.number 

    {

        display: block;

        text-align: center;

        background-color: #a9a8a8;

        height: 50px;

        width: 50px;

        border-radius: 100%;

        color: #fff;

        padding: 11px;

        margin-bottom: 9px;

        font-size: 19px;    

    } 

    

    .progressbar_inner .wi_div.active .number

    {

        background-color: #0057b1;

    }





/************************************/





#vehicle_details {

    display: none;

}



.hidden_back_block .backblock {

    margin-bottom: 15px;

}

.shipping_form_main {
    margin-bottom: 50px;
    background-repeat: no-repeat;
    background-size: contain;
    object-fit: cover;
    background-position: right;
}



.inner-radio-grid {

    display: grid;

    grid-template-columns: 1fr 1fr 1fr;

}



.inner-contact-grid {

    display: grid;

    grid-template-columns: 1fr 1fr;

    width: 30%;

}



.inner-phone-grid {

    display: grid;

    grid-template-columns: 2fr 1fr;

    grid-column-gap: 25px;

}



.left_pickup .frm-group .inner-grid {

    display: inline-flex;

    grid-template-columns: 1fr 1fr 1fr;

    grid-column-gap: 20px;

}



.left_pickup .frm-group {

    margin-bottom: 15px;

}



.frm-group .form-label {


    font-size: 15px;

    font-weight: bold;

    margin-bottom: 5px;

}


.left_pickup {
    height: max-content;
    background-color: #fff;

    padding: 29px;

    border-radius: 20px;

    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;

    border-top: 5px solid #F1661E;
    margin-bottom: 40px;
    padding-left:  40px;
    padding-right: 40px;
    padding-bottom: 60px;
}

.right_form {
    display: inline-block;
}

.form_heading {

    margin-bottom: 30px;

}



#step5_form {

    margin-top: 50px;



}



.block1_desc {

    text-align: right;

    padding: 3px;

    line-height: 26px;

    font-weight: 600;

}



.quotelabel1 {

    /*font-size: 20px;

        display: inline;

        line-height: 28px;

        color: #095bc2;

        font-weight: 700;*/



    font-size: 18px;

    display: inline;

    line-height: 30px;

    color: #444;

    font-weight: 400;

}





.block1 {

    color: #333;


    font-size: 16px;

    margin-bottom: 10px;

}



.step5_form_inner {

    display: grid;

    grid-template-columns: 1fr 1fr;

    grid-column-gap: 40px;

}



.imagebox2 img {

    border-radius: 20px;

    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;

    width: 100%;

    object-fit: contain;

}



.inner-section-video {

    display: grid;

    grid-template-columns: 1fr 1fr;

    grid-column-gap: 20px;

}



.sec2 {

    background-image: url(https://www.autotransportdirect.com/wp-content/uploads/2022/07/banner3.jpg);

    width: 50%;

    background-size: cover;

    background-repeat: no-repeat;

    display: none;

}



.banner {

    width: 100%;

    display: flex;

    height: 370px;

    font-family: 'Montserrat', sans-serif;

}



.sec1 {

    width: 100%;

    /*background-color: #1B73E7;*/

    background-color: #f1f1f1;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    display: flex;

}





.sec1 .display {

    padding: 0 17%;

}



.point1 {

    background-color: orange;

    border-radius: 50px;

    padding: 8px 29px;

    text-align: center;

    color: #fff;

    font-weight: 400;

    font-size: 18px;

    margin-bottom: 20px;

    display: inline;

}


input {
    margin-bottom: 10px !important;
}

.smart-forms .option>input {

    left: 4px;

    top: 5px;

    z-index: 1;

}



.spn {

    font-size: 12px;

    letter-spacing: 3px;

    font-weight: 700;

    color: #333;

    margin: 20px 0 10px;

}



.my_order {


    font-weight: 700;

    color: #333;


    margin-bottom: 20px;


}



.head {

    font-size: 2.5vw;

    font-weight: 300;

    color: #333;

    line-height: 66px;

    margin: 0px;

}



.textpara {

    font-size: 18px;

    color: #333;

    font-weight: 400;

    margin-top: 20px;

    line-height: 28px;

    letter-spacing: normal;

    margin: 20px 0px 0px 0px;

}



.but {

    font-size: 15px;

    border: 1px solid rgb(255 255 255);

    font-weight: 700;

    color: rgb(255 255 255);

    padding: 18px 57px;

    text-decoration: none;

    display: inline-block;

    margin-top: 35px;

    border-radius: 43px;

}



.but:hover {

    color: #0b9519;

    text-decoration: none;

    background-color: #fff;

    transition: inherit;

}


.wpex-has-primary-bottom-spacing #primary{
	padding-bottom: 0px !important;
}


.logos-sectio h2 {

    text-align: center;

    color: #283337;


    font-size: 42px;

    font-weight: 500;

    line-height: 45px;

    margin-bottom: 0px !important;

    padding-bottom: 0px;

}



.custom_bord {

    border-radius: 1rem;

    width: 15rem;

    height: 2px;

    background-color: #487BCA;

    margin: 20px auto 30px auto;

}



.logos-sectio .logos_inner {

    display: grid;

    grid-template-columns: 1fr 1fr 1fr;

    grid-column-gap: 40px;

    align-items: center;

    width: 60%;

    margin: 55px auto 30px auto;

}



.logos-sectio .logos_inner .log {

    text-align: center;

}



.logos-sectio .logos_inner .log img {

    width: 55%;

}



.logos_bottom {

    text-align: center;


    font-size: 18px;

    font-weight: 300;

    line-height: 45px;

    text-align: center;

    margin-bottom: 50px;

}



.inner-container {

    display: grid;



    grid-template-columns: 1fr 1fr;

    grid-column-gap: 40px;

}



.right-banner {

    text-align: center;

}



.right-banner img {

    width: 75%;

    border-radius: 20px;

}



#delivery_details_banner,
#vehicle_details_banner {

    display: none;

}



.ordersteps img {

    max-width: 720px !important;

}



#process_steps2,

#process_steps3 {

    display: none;

}


#process_steps{
	margin-top: 0px;
}





@media(max-width:767px) {

    .progressbar_inner {

        width: 95%;

    }



    .progressbar_inner span.title2 {

        margin-left: -3px;

    }

}





@media(max-width:480px) {

    .progressbar_inner {

        width: 98%;

    }



    .progressbar_inner span.title2 {

        margin-left: -3px;

        font-size: 14px;

    }





}
</style>
<!------Vehicle details-------->
<div class="smart-forms">
    <div class="section fieldentry" id="process_steps">
        <div class="container">
            <div class="progressbar_inner">
                <div class="text_div_des active wi_div active"><span class="number">1</span><span class="title2 mar">Customer</span></div>
                <div class="line_bar line1 active"></div>
                <div class="text_div_veh wi_div active"><span class="number">2</span><span class="title2 mar big">Pickup / Delivery</span></div>
                <div class="line_bar line2"></div>
                <div class="text_div_dat wi_div"><span class="number">3</span><span class="title2">Vehicle(s)</span></div>
                <div class="line_bar line3"></div>
                <div class="text_div_dat wi_div"><span class="number">4</span><span class="title2">Checkout</span></div>
            </div>
        </div>
    </div>
    <div class="section fieldentry" style="margin: 50px 0 -20px;" id="process_steps2">
        <div class="container">
            <div class="progressbar_inner">
                <div class="text_div_des active wi_div active"><span class="number">1</span><span class="title2 mar">Customer</span></div>
                <div class="line_bar line1 active"></div>
                <div class="text_div_veh wi_div active"><span class="number">2</span><span class="title2 mar big">Pickup / Delivery</span></div>
                <div class="line_bar line2 active"></div>
                <div class="text_div_dat wi_div active"><span class="number">3</span><span class="title2">Vehicle(s)</span></div>
                <div class="line_bar line3"></div>
                <div class="text_div_dat wi_div"><span class="number">4</span><span class="title2">Checkout</span></div>
            </div>
        </div>
        <!--<div class="back_btn" style="text-align:center;">

		 	<button class="next_btn" id="shipping_bt">&larr; Go Back</button>

		 </div>-->
    </div>
    <div class="section fieldentry"id="process_steps3">
        <div class="container">
            <div class="progressbar_inner">
                <div class="text_div_des active wi_div active"><span class="number">1</span><span class="title2 mar">Customer</span></div>
                <div class="line_bar line1 active"></div>
                <div class="text_div_veh wi_div active"><span class="number">2</span><span class="title2 mar big">Pickup / Delivery</span></div>
                <div class="line_bar line2 active"></div>
                <div class="text_div_dat wi_div active"><span class="number">3</span><span class="title2">Vehicle(s)</span></div>
                <div class="line_bar line3 active"></div>
                <div class="text_div_dat wi_div"><span class="number">4</span><span class="title2">Checkout</span></div>
            </div>
        </div>
    </div>
    
    <form action="?step=4#checkout" method="post" name="mainform" id="mainform">
        <input type="hidden" name="strDateAvailable" value="<?php echo $strDateAvailable ?>">
        <input type="hidden" name="strOrderID" value="<?php echo $strmaxorderid ?>">
        <input type="hidden" name="strDeposit" value="<?php echo $strDeposit ?>">
        <input type="hidden" name="pricetier" value="<?php echo $pricetier ?>">
        <input type="hidden" name="tiermessage" value="<?php echo $tiermessage ?>">
        <input type="hidden" name="tiername" value="<?php echo $pricetiername ?>">
        <input type="hidden" name="originalbalance" id="originalbalance" value="<?php echo $strBalance ?>">
        <input type="hidden" name="balance" id="balance" value="<?php echo $strBalance ?>">
        <input type="hidden" name="howmany" value="<?php echo $howmany ?>">
        <input type="hidden" name="depositpervehicle" value="<?php echo $depositpervehicle ?>">
        <input type="hidden" id="carrierdiscount" name="carrierdiscount" value="<?php echo $carrierdiscount ?>">
        <input type="hidden" name="numvehicles" value="<?php echo $numvehicles ?>">
        <input type="hidden" id="strTotalPrice" name="strTotalPrice" value="<?php echo $strTotalPrice ?>">
        <input type="hidden" id="strVehicle_VIN" name="strVehicle_VIN" value="<?php echo $strVehicle_VIN ?>">
        <input type="hidden" id="strVehicle_StockNum" name="strVehicle_StockNum" value="<?php echo $strVehicle_StockNum ?>">
        <input type="hidden" id="strVehicle_VIN" name="strVehicle_VIN" value="<?php echo $strVehicle_VIN ?>">
        <input type="hidden" name="strtotalprice1" id="totalprice1" value="<?php echo $strtotalprice1 ?>">
        <input type="hidden" name="strtotalprice1_exp" id="totalprice1_exp" value="<?php echo $strtotalprice1_exp ?>">
        <input type="hidden" name="strtotalprice1_rush" id="strtotalprice1_rush" value="<?php echo $strtotalprice1_rush ?>">
        <input type="hidden" name="strtotalprice2" id="totalprice2" value="<?php echo $strtotalprice2 ?>">
        <input type="hidden" name="strtotalprice2_exp" id="totalprice2_exp" value="<?php echo $strtotalprice2_exp ?>">
        <input type="hidden" name="strtotalprice2_rush" id="strtotalprice2_rush" value="<?php echo $strtotalprice2_rush ?>">
        <input type="hidden" name="strtotalprice3" id="totalprice3" value="<?php echo $strtotalprice3 ?>">
        <input type="hidden" name="strtotalprice3_exp" id="totalprice3_exp" value="<?php echo $strtotalprice3_exp ?>">
        <input type="hidden" name="strtotalprice3_rush" id="strtotalprice3_rush" value="<?php echo $strtotalprice3_rush ?>">
        <input type="hidden" name="strtotalprice4" id="totalprice4" value="<?php echo $strtotalprice4 ?>">
        <input type="hidden" name="strtotalprice4_exp" id="totalprice4_exp" value="<?php echo $strtotalprice4_exp ?>">
        <input type="hidden" name="strtotalprice4_rush" id="strtotalprice4_rush" value="<?php echo $strtotalprice4_rush ?>">
        <input type="hidden" name="strtotalprice5" id="totalprice5" value="<?php echo $strtotalprice5 ?>">
        <input type="hidden" name="strtotalprice5_exp" id="totalprice5_exp" value="<?php echo $strtotalprice5_exp ?>">
        <input type="hidden" name="strtotalprice5_rush" id="strtotalprice5_rush" value="<?php echo $strtotalprice5_rush ?>">
        <input type="hidden" name="strdeposit1_std" id="strdeposit1_std" value="<?php echo $strdeposit1_std ?>">
        <input type="hidden" name="strdeposit1_exp" id="strdeposit1_exp" value="<?php echo $strdeposit1_exp ?>">
        <input type="hidden" name="strdeposit1_rush" id="strdeposit1_rush" value="<?php echo $strdeposit1_rush ?>">
        <input type="hidden" name="strdeposit2_std" id="strdeposit2_std" value="<?php echo $strdeposit2_std ?>">
        <input type="hidden" name="strdeposit2_exp" id="strdeposit2_exp" value="<?php echo $strdeposit2_exp ?>">
        <input type="hidden" name="strdeposit2_rush" id="strdeposit2_rush" value="<?php echo $strdeposit2_rush ?>">
        <input type="hidden" name="strdeposit3_std" id="strdeposit3_std" value="<?php echo $strdeposit3_std ?>">
        <input type="hidden" name="strdeposit3_exp" id="strdeposit3_exp" value="<?php echo $strdeposit3_exp ?>">
        <input type="hidden" name="strdeposit3_rush" id="strdeposit3_rush" value="<?php echo $strdeposit3_rush ?>">
        <input type="hidden" name="strdeposit4_std" id="strdeposit4_std" value="<?php echo $strdeposit4_std ?>">
        <input type="hidden" name="strdeposit4_exp" id="strdeposit4_exp" value="<?php echo $strdeposit4_exp ?>">
        <input type="hidden" name="strdeposit4_rush" id="strdeposit4_rush" value="<?php echo $strdeposit4_rush ?>">
        <input type="hidden" name="strdeposit5_std" id="strdeposit5_std" value="<?php echo $strdeposit5_std ?>">
        <input type="hidden" name="strdeposit5_exp" id="strdeposit5_exp" value="<?php echo $strdeposit5_exp ?>">
        <input type="hidden" name="strdeposit5_rush" id="strdeposit5_rush" value="<?php echo $strdeposit5_rush ?>">
        <input type="hidden" name="Selected_tier_name" id="Selected_tier_name" value="<?php echo $Selected_tier_name ?>">
        <input type="hidden" name="Selected_tier_price" id="Selected_tier_price" value="<?php echo $Selected_tier_price ?>">
        <!-------pickup form------->
        <div class="section fieldentry" style="margin-top: 50px;">
            <div class="shipping_form_main">
                <div class="container">
                    
                </div>
            </div>
        </div>
        <!-----vehicle details----->
        <div class="section fieldentry smart-forms">
            <div class="shipping_form_main">
                <div class="container">
                	<div class="frm-row">
                		<div class="pick_up_form colm colm8" id="pickup_form_main">
                        <div>
                            <div class="left_pickup">
                                <div class="form_heading">
                                    <strong style="font-size: 25px; color: #2f69c3;">Pickup From</strong><br>
                                    <div style="margin:5px 0 5px 0;width:100%;border-top:#2f69c3 solid thin;"></div>
                                </div>
                                <div class="frm-group">
                                    <div class="form-label"> Contact Name:</div>
                                    <div class="field append-icon">
                                        <input type="text" class="valid" name="strPickup_Contact" id="strPickup_Contact" size="40" required>
                                    </div>
                                </div>
                                <div class="frm-group">
                                    <div class="form-label">Street Address:</div>
                                    <div class="field append-icon">
                                        <input type="text" class="valid" name="strPickup_Address1" id="strPickup_Address1" size="40" required>
                                    </div>
                                </div>
                                <style>
                                    .readonlyfield {

								border: 1px solid #333!important;

								background: #fff;

								padding: 10px 0;

								box-shadow: 0 2px 2px rgba(0,0,0,0.05) inset;

								padding: 5px 10px !important;

								border-radius: 3px;
								font-weight: normal;
								height:  35px;
								color: #000;

							}

						</style>
                                <div class="frm-group">
                                    <div class="frm-row">
                                        <div class="colm colm4">
                                            <div class="inner-block1">
                                                <div class="form-label"> City:</div>
                                                <div style="font-weight: normal;" class="readonlyfield">
                                                    <?php echo $strQuote_shippingfromcity  ?>
                                                </div>
                                                <input type="hidden" name="strPickup_City" id="strPickup_City" value="<?php echo $strQuote_shippingfromcity  ?>">
                                            </div>
                                        </div>
                                        <div class="colm colm4">
                                            <div class="inner-block1">
                                                <div class="form-label">State:</div>
                                                <div style="font-weight: normal;" class="readonlyfield">
                                                    <?php echo $strQuote_shippingfromstate  ?>
                                                </div>
                                                <input type="hidden" name="strPickup_State" id="strPickup_State" value="<?php echo $strQuote_shippingfromstateabbr  ?>">
                                            </div>
                                        </div>
                                        <div class="colm colm4">
                                            <div class="inner-block1">
                                                <div class="form-label">Zip:</div>
                                                <?php if($_COOKIE['admin']=="") { ?>
                                                <div style="font-weight: normal;" class="readonlyfield">
                                                    <?php echo $strQuote_shippingfromzip  ?>
                                                </div>
                                                <input type="hidden" name="strPickup_Zip" id="strPickup_Zip" value="<?php echo $strQuote_shippingfromzip  ?>">
                                                <?php } else { ?>
                                                <div class="field append-icon">
                                                    <input type="text" name="strPickup_Zip" id="strPickup_Zip" size="10" value="<?php echo $strQuote_shippingfromzip  ?>">
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($_COOKIE['admin']!="") { ?>
                                    <div class="frm-group">
                                        <div class="colm colm12">
                                            Extra Instructions:<br>
                                            <input type="text" name="strPickup_ExtraInst" id="strPickup_ExtraInst" size="40" maxlength="200"><br>
                                            <br>
                                            <input type="checkbox" name="strPickup_ExtraInst_Send" id="strPickup_ExtraInst_Send" value="yes" style="width: 25px;" /> Put Extra Instructions on B.O.L.<br>
                                            <?php

								$cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=$strQuote_shippingfromcity&pickupState=$strQuote_shippingfromstateabbr&pickupZip=$strQuote_shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=$ strQuote_shippingtocity&deliveryState=$strQuote_shippingtostateabbr&deliveryZip=$strQuote_shippingtozip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";

								$cd50 = urlencode($cd50);

								$cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=$strQuote_shippingfromcity&pickupState=$strQuote_shippingfromstateabbr&pickupZip=$strQuote_shippingfromzip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=$ strQuote_shippingtocity&deliveryState=$strQuote_shippingtostateabbr&deliveryZip=$strQuote_shippingtozip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";

								$cd100 = urlencode($cd100);

								

								?>
                                            <a href="/admin2k7/redir.asp?url=<?php echo $cd50  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 50</a>
                                            &nbsp;&nbsp;
                                            <a href="/admin2k7/redir.asp?url=<?php echo $cd100  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 100</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="frm-group">
                                        <div class="form-label">Pickup&nbsp;Location&nbsp;Is:&nbsp;</div>
                                        <div class="inner-radio-grid">
                                            <div class="option">
                                                <input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_res" value="Residential" onclick="$('#Pickup_Location_Hours').hide();$('#strPickup_Location_Hours').val('');" checked="checked">
                                                <span class="radio"></span> Residential
                                            </div>
                                            <div class="option">
                                                <input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_bus" value="Business" onclick="$('#Pickup_Location_Hours').show();">
                                                <span class="radio"></span> Business
                                            </div>
                                            <div class="option">
                                                <input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_port" value="Port" onclick="$('#Pickup_Location_Hours').hide();$('#strPickup_Location_Hours').val('');">
                                                <span class="radio"></span> Port
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Pickup_Location_Hours" style="display:none;">
                                        <div class="frm-row">
                                            <div class="colm colm12">
                                                Business Hours:<br>
                                                <input type="text" name="strPickup_Location_Hours" id="strPickup_Location_Hours" size="40" maxlength="99">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-group strPickup_Phone1">
                                        <div class="inner-phone-grid">
                                            <div class="phone-block">
                                                <div class="form-label">Phone <span class="strPickup_Phone1num" style="display: none;">1</span>:</div>
                                                <input type="tel" name="strPickup_Phone1" id="strPickup_Phone1">
                                            </div>
                                            <div class="type-block">
                                                <div class="form-label">Type:</div>
                                                <div for="strPickup_Phone1Type" class="field select">
                                                    <select name="strPickup_Phone1Type" id="strPickup_Phone1Type">
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Home">Home</option>
                                                        <option value="Work">Work</option>
                                                    </select><i class="arrow"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colm colm12 phoneaddpickuprow1">
                                            <a href="#" style="font-size: 12px;">+ Add Another Phone Number</a>
                                        </div>
                                    </div>
                                    <div class="frm-group strPickup_Phone2" style="display: none;">
                                        <div class="inner-phone-grid">
                                            <div class="phone-block">
                                                <div class="form-label"> Phone 2:</div>
                                                <input type="tel" name="strPickup_Phone2" id="strPickup_Phone2">
                                            </div>
                                            <div class="type-block">
                                                <div class="form-label">Type:</div>
                                                <div for="strPickup_Phone2Type" class="field select">
                                                    <select name="strPickup_Phone2Type" id="strPickup_Phone2Type">
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Home">Home</option>
                                                        <option value="Work">Work</option>
                                                    </select><i class="arrow"></i>
                                                </div>
                                            </div>
                                            <div class="colm colm12 phoneaddpickuprow2">
                                                <a href="#" style="font-size: 12px;">+ Add Another Phone Number</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-group strPickup_Phone3" style="display: none;">
                                        <div class="inner-phone-grid">
                                            <div class="phone-block">
                                                <div class="form-label">Phone 3:</div>
                                                <input type="tel" name="strPickup_Phone3" id="strPickup_Phone3">
                                            </div>
                                            <div class="type-block">
                                                <div class="form-label">Type:</div>
                                                <div for="strPickup_Phone3Type" class="field select">
                                                    <select name="strPickup_Phone3Type" id="strPickup_Phone3Type">
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Home">Home</option>
                                                        <option value="Work">Work</option>
                                                    </select><i class="arrow"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-group">
                                        <div class="form-label">Do You Have a Backup Contact?&nbsp;</div>
                                        <div class="inner-contact-grid">
                                            <div class="inner-contact-block1">
                                                <div class="option" style="display:inline; font-weight: normal;">
                                                    <input type="radio" name="strPickup_BackupContact" id="strPickup_BackupContact_yes" value="Yes" onclick="$('.strPickup_BackupPhonerow').show();$('#strPickup_BackupPhone').val('');"><span class="radio"></span> Yes
                                                </div>
                                            </div>
                                            <div class="inner-contact-block1">
                                                <div class="option" style="display:inline; font-weight: normal;">
                                                    <input type="radio" name="strPickup_BackupContact" id="strPickup_BackupContact_no" value="No" onclick="$('.strPickup_BackupPhonerow').hide();$('#strPickup_BackupPhone').val('');" checked="checked"><span class="radio"></span> No
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-group strPickup_BackupPhonerow" style="display: none;">
                                        <div class="hidden_back_block">
                                            <div class="backblock">
                                                <div class="form-label">Backup Contact Name:</div>
                                                <input type="text" class="valid" name="strPickup_BackupName" id="strPickup_BackupName" size="25">
                                            </div>
                                            <div class="backblock">
                                                <div class="form-label">Backup Contact Phone:</div>
                                                <input type="text" name="strPickup_BackupPhone" id="strPickup_BackupPhone" size="25">
                                            </div>
                                            <div class="backblock">
                                                <div class="form-label">Type:</div>
                                                <div for="strPickup_BackupPhoneType" class="field select">
                                                    <select name="strPickup_BackupPhoneType" id="strPickup_BackupPhoneType">
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Home">Home</option>
                                                        <option value="Work">Work</option>
                                                    </select><i class="arrow"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-----Hpw many vehicles---->
                                    <div class="frm-group">
                                        <div class="form-label">
                                            <?php if ($howmany != "onevehicle") { ?>
                                            Are these vehicles coming from a dealer, auto auction or Copart?
                                            <?php } else { ?>
                                            Is this vehicle coming from a dealer, auto auction or Copart?
                                            <?php } ?>
                                        </div>
                                        <div class="field append-icon form_field">
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_yes" value="yes" onclick="$('#vehicle_comingfrom_spec').show();">
                                                <span class="radio"></span> Yes
                                            </label>
                                            <label class="option" style="display:inline;">
                                                <?php if($howmany != "onevehicle") { ?>
                                                <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="comingfromno();">
                                                <?php } else { ?>
                                                <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="$('#vehicle_comingfrom_spec').hide();$('#vehicle_comingfrom_stocknum').hide();<?php if($_COOKIE['admin']=="") { ?>$('#vehicle_comingfrom_vin').hide();<?php } ?>$('#strVehicle_VIN').val('');$('#vehicle_comingfrom_buyernum').hide();$('#strVehicle_BuyerNum').val('');$('#vehicle_comingfrom_lotnum').hide();$('#strVehicle_LotNum').val('');$('#strVehicle_ComingFrom option')[0].selected = true;">
                                                <?php } ?>
                                                <span class="radio"></span> No
                                            </label>
                                            <?php if ($howmany != "onevehicle") { ?>
                                            <script type="text/javascript">
                                            function comingfromno() {



                                                <?php

			                		for ($counter=1; $counter<=$numvehicles; $counter++) {

			                		?>

                                                $('#vehicle_comingfrom_spec').hide();

                                                $('#vehicle_comingfrom_stocknum<?php echo $counter ?>').hide();

                                                <?php if($_COOKIE['admin']=="") { ?>

                                                $('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();

                                                <?php } ?>

                                                $('#strVehicle_VIN<?php echo $counter ?>').val('');

                                                $('#vehicle_comingfrom_buyernum').hide();

                                                $('#strVehicle_BuyerNum').val('');

                                                $('#vehicle_comingfrom_lotnum').hide();

                                                $('#strVehicle_LotNum').val('');



                                                $('#strVehicle_ComingFrom option')[0].selected = true;

                                                <?php } ?>

                                            }





                                            function choosevehiclefrom() {

                                                if ($('#strVehicle_ComingFrom').val() == '') {



                                                    <?php

			                			for ($counter=1; $counter<=$numvehicles; $counter++) {

			                			?>

                                                    <?php if($_COOKIE['admin']=="") { ?>

                                                    $('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();

                                                    <?php } ?>

                                                    $('#strVehicle_VIN<?php echo $counter ?>').val('');

                                                    <?php } ?>



                                                    $('#vehicle_comingfrom_buyernum').hide();

                                                    $('#strVehicle_BuyerNum').val('');

                                                    $('#vehicle_comingfrom_lotnum').hide();

                                                    $('#strVehicle_LotNum').val('');



                                                } else if ($('#strVehicle_ComingFrom').val() == 'Dealer') {



                                                    //Cleanup other fields

                                                    $('#vehicle_comingfrom_buyernum').hide();

                                                    $('#strVehicle_BuyerNum').val('');

                                                    $('#vehicle_comingfrom_lotnum').hide();

                                                    $('#strVehicle_LotNum').val('');



                                                    //Show VIN for Each Vehicle

                                                    <?php

			                			for ($counter=1; $counter<=$numvehicles; $counter++) {

			                			?>

                                                    $('#vehicle_comingfrom_vin<?php echo $counter ?>').show();

                                                    <?php } ?>



                                                } else if ($('#strVehicle_ComingFrom').val() == 'Auto Auction') {



                                                    //Cleanup other fields

                                                    <?php

			                			for ($counter=1; $counter<=$numvehicles; $counter++) {

			                			?>

                                                    <?php if($_COOKIE['admin']=="") { ?>

                                                    $('#vehicle_comingfrom_vin<?php echo $counter ?>').hide();

                                                    <?php } ?>

                                                    $('#strVehicle_VIN<?php echo $counter ?>').val('');

                                                    <?php } ?>

                                                    $('#vehicle_comingfrom_lotnum').hide();

                                                    $('#strVehicle_LotNum').val('');



                                                    //Show Buyer Number



                                                    $('#vehicle_comingfrom_buyernum').show();



                                                    //Show Stock Number for Each Vehicle

                                                    <?php

			                			for ($counter=1; $counter<=$numvehicles; $counter++) {

			                			?>

                                                    $('#vehicle_comingfrom_stocknum<?php echo $counter ?>').show();

                                                    <?php } ?>







                                                } else if ($('#strVehicle_ComingFrom').val() == 'Copart') {



                                                    //Cleanup other fields

                                                    <?php

			                			for ($counter=1; $counter<=$numvehicles; $counter++) {



			                			?>

                                                    $('#vehicle_comingfrom_stocknum<?php echo $counter ?>').hide();

                                                    $('#strVehicle_StockNum<?php echo $counter ?>').val('');

                                                    <?php } ?>



                                                    //Show Buyer Number

                                                    $('#vehicle_comingfrom_buyernum').show();

                                                    //Show Buyer Number

                                                    $('#vehicle_comingfrom_lotnum').show();



                                                    //Show VIN for Each Vehicle

                                                    <?php

			                			for ($counter=1; $counter<=$numvehicles; $counter++) {

			                			?>

                                                    $('#vehicle_comingfrom_vin<?php echo $counter ?>').show();

                                                    <?php } ?>







                                                }





                                            }
                                            </script>
                                            <?php } else { ?>
                                            <script type="text/javascript">
                                            function choosevehiclefrom() {

                                                if ($('#strVehicle_ComingFrom').val() == '') {



                                                    <?php if($_COOKIE['admin']=="") { ?>

                                                    $('#vehicle_comingfrom_vin').hide();

                                                    <?php } ?>





                                                    $('#strVehicle_VIN').val('');



                                                    $('#vehicle_comingfrom_buyernum').hide();

                                                    $('#strVehicle_BuyerNum').val('');

                                                    $('#vehicle_comingfrom_lotnum').hide();

                                                    $('#strVehicle_LotNum').val('');



                                                } else if ($('#strVehicle_ComingFrom').val() == 'Dealer') {



                                                    //Cleanup other fields



                                                    $('#vehicle_comingfrom_buyernum').hide();

                                                    $('#strVehicle_BuyerNum').val('');

                                                    $('#vehicle_comingfrom_lotnum').hide();

                                                    $('#strVehicle_LotNum').val('');



                                                    //Show VIN for Each Vehicle

                                                    $('#vehicle_comingfrom_vin').show();



                                                } else if ($('#strVehicle_ComingFrom').val() == 'Auto Auction') {



                                                    //Cleanup other fields

                                                    <?php if($_COOKIE['admin']=="") { ?>

                                                    $('#vehicle_comingfrom_vin').hide();

                                                    <?php } ?>

                                                    $('#strVehicle_VIN').val('');



                                                    //Show Buyer Number

                                                    $('#vehicle_comingfrom_buyernum').show();

                                                    $('#vehicle_comingfrom_lotnum').hide();

                                                    $('#strVehicle_LotNum').val('');



                                                    //Show Stock Number for Each Vehicle

                                                    $('#vehicle_comingfrom_stocknum').show();



                                                } else if ($('#strVehicle_ComingFrom').val() == 'Copart') {



                                                    //Cleanup other fields

                                                    $('#vehicle_comingfrom_stocknum').hide();

                                                    $('#strVehicle_StockNum').val('');



                                                    //Show Buyer Number

                                                    $('#vehicle_comingfrom_buyernum').show();

                                                    $('#vehicle_comingfrom_lotnum').show();



                                                    //Show VIN for Each Vehicle

                                                    $('#vehicle_comingfrom_vin').show();

                                                }



                                            }
                                            </script>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="frm-group" id="vehicle_comingfrom_spec" style="display:none;">
                                        <div class="form-label">
                                            <?php if ($howmany != "onevehicle") { ?>
                                            Where are they coming from?
                                            <?php } else { ?>
                                            Where is it coming from?
                                            <?php } ?>
                                        </div>
                                        <div class="field select">
                                            <select name="strVehicle_ComingFrom" id="strVehicle_ComingFrom" onchange="choosevehiclefrom();">
                                                <option value="">-- PLEASE SELECT --</option>
                                                <option value="Dealer">Dealer</option>
                                                <option value="Auto Auction">Auto Auction</option>
                                                <option value="Copart">Copart</option>
                                            </select>
                                            <i class="arrow"></i>
                                        </div>
                                    </div>
                                    <div class="frm-group" id="vehicle_comingfrom_buyernum" style="display:none;">
                                        <div class="form-label">
                                            Your buyer number:
                                        </div>
                                        <div class="field">
                                            <input type="text" name="strVehicle_BuyerNum" id="strVehicle_BuyerNum" size="20" maxlength="99">
                                        </div>
                                    </div>
                                    <div class="frm-group" id="vehicle_comingfrom_lotnum" style="display:none;">
                                        <div class="form-label">
                                            Your lot number:
                                        </div>
                                        <div class="field">
                                            <input type="text" name="strVehicle_LotNum" id="strVehicle_LotNum" size="20" maxlength="99">
                                        </div>
                                    </div>
                                    <div class="frm-group" id="vehicle_comingfrom_vin" style="display:none;">
                                        <div class="form-label">
                                            LAST 6 digits of the Vehicle VIN:
                                        </div>
                                        <div class="field">
                                            <input type="text" name="strVehicle_VIN" id="strVehicle_VIN" size="8" maxlength="6">
                                        </div>
                                    </div>
                                    <div class="frm-group" id="vehicle_comingfrom_stocknum" style="display:none;">
                                        <div class="form-label">
                                            Auto Auction Lot/Stock Number:
                                        </div>
                                        <div class="field">
                                            <input type="text" name="strVehicle_StockNum" id="strVehicle_StockNum" size="8">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="left_pickup" style="margin-bottom:60px;">
                                <div class="frm-row">
                                    <div class="form-heading">
                                        <strong style="font-size: 25px;color: #2f69c3; ">Deliver To</strong><br>
                                        <div style="margin:5px 0 5px 0;width:100%;border-top:#2f69c3 solid thin;"></div>
                                    </div>
                                </div>
                                <div class="colm colm12">
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Contact Name:
                                            <label class="field append-icon">
                                                <input type="text" name="strDeliver_Contact" id="strDeliver_Contact" size="40">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Street Address:<br>
                                            <label class="field append-icon">
                                                <input type="text" name="strDeliver_Address1" id="strDeliver_Address1" size="40">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm5">
                                            City: <br>
                                            <div style="font-weight: normal;" class="readonlyfield">
                                                <?php echo $strQuote_shippingtocity  ?>
                                            </div>
                                            <input type="hidden" name="strDeliver_City" id="strDeliver_City" value="<?php echo $strQuote_shippingtocity  ?>">
                                        </div>
                                        <div class="colm colm3">
                                            State: <div style="font-weight: normal;" class="readonlyfield">
                                                <?php echo $strQuote_shippingtostate  ?>
                                            </div>
                                            <input type="hidden" name="strDeliver_State" id="strDeliver_State" value="<?php echo $strQuote_shippingtostateabbr  ?>">
                                        </div>
                                        <div class="colm colm4">
                                            Zip:<br>
                                            <?php if($_COOKIE['admin']=="") { ?>
                                            <div style="font-weight: normal;" class="readonlyfield">
                                                <?php echo $strQuote_shippingtozip  ?>
                                            </div>
                                            <input type="hidden" name="strDeliver_Zip" id="strDeliver_Zip" value="<?php echo $strQuote_shippingtozip  ?>">
                                            <?php } else { ?>
                                            <label class="field append-icon">
                                                <input type="text" name="strDeliver_Zip" id="strDeliver_Zip" size="10" value="<?php echo $strQuote_shippingtozip  ?>">
                                            </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if($_COOKIE['admin']!="") { ?>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Extra Instructions:<br>
                                            <input type="text" name="strDeliver_ExtraInst" id="strDeliver_ExtraInst" size="40" maxlength="200"><br><br>
                                            <input type="checkbox" name="strDeliver_ExtraInst_Send" id="strDeliver_ExtraInst_Send" value="yes" style="width: 25px;" /> Put Extra Instructions on B.O.L.<br>
                                            <?php

										$cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=$strQuote_shippingtocity&pickupState=$strQuote_shippingtostateabbr&pickupZip=$strQuote_shippingtozip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=$ strQuote_shippingfromcity&deliveryState=$strQuote_shippingfromstateabbr&deliveryZip=$strQuote_shippingfromzip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";

										$cd50 = urlencode($cd50);

										$cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=$strQuote_shippingtocity&pickupState=$strQuote_shippingtostateabbr&pickupZip=$strQuote_shippingtozip&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=$ strQuote_shippingfromcity&deliveryState=$strQuote_shippingfromstateabbr&deliveryZip=$strQuote_shippingfromzip&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=5&primarySort=9&secondarySort=4&listingsPerPage=100";

										$cd100 = urlencode($cd100);

										

										?>
                                            <a href="/admin2k7/redir.asp?url=<?php echo $cd50  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 50</a>
                                            &nbsp;&nbsp;
                                            <a href="/admin2k7/redir.asp?url=<?php echo $cd100  ?>&orderid=0&type=centraldispatchsearch" target="_new">CD 100</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Deliver&nbsp;Location&nbsp;Is:&nbsp;<br>
                                            <label class="option" style="display:inline; font-weight: normal;">
                                                <input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_res" value="Residential" onclick="$('#Deliver_Location_Hours').hide();$('#strDeliver_Location_Hours').val('');" checked="checked"><span class="radio"></span> Residential
                                            </label>
                                            <label class="option" style="display:inline; font-weight: normal;">
                                                <input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_bus" value="Business" onclick="$('#Deliver_Location_Hours').show();"><span class="radio"></span> Business
                                            </label>
                                            <label class="option" style="display:inline; font-weight: normal;">
                                                <input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_port" value="Port" onclick="$('#Deliver_Location_Hours').hide();$('#strDeliver_Location_Hours').val('');"><span class="radio"></span> Port
                                            </label>
                                        </div>
                                    </div>
                                    <div id="Deliver_Location_Hours" style="display:none;">
                                        <div class="frm-row">
                                            <div class="colm colm12">
                                                Business Hours:<br>
                                                <input type="text" name="strDeliver_Location_Hours" id="strDeliver_Location_Hours" size="40" maxlength="99">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row strDeliver_Phone1">
                                        <div class="colm colm8">
                                            Phone <span class="strDeliver_Phone1num" style="display: none;">1</span>: <br>
                                            <input type="tel" name="strDeliver_Phone1" id="strDeliver_Phone1">
                                        </div>
                                        <div class="colm colm4">
                                            Type:<br>
                                            <label for="strDeliver_Phone1Type" class="field select">
                                                <select name="strDeliver_Phone1Type" id="strDeliver_Phone1Type">
                                                    <option value="Mobile">Mobile</option>
                                                    <option value="Home">Home</option>
                                                    <option value="Work">Work</option>
                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                        <div class="colm colm12 phoneadddeliverrow1">
                                            <a href="#" style="font-size: 12px;">+ Add Another Phone Number</a>
                                        </div>
                                    </div>
                                    <div class="frm-row strDeliver_Phone2" style="display: none;">
                                        <div class="colm colm8">
                                            Phone 2:<br>
                                            <input type="tel" name="strDeliver_Phone2" id="strDeliver_Phone2">
                                        </div>
                                        <div class="colm colm4">
                                            Type:<br>
                                            <label for="strDeliver_Phone2Type" class="field select">
                                                <select name="strDeliver_Phone2Type" id="strDeliver_Phone2Type">
                                                    <option value="Mobile">Mobile</option>
                                                    <option value="Home">Home</option>
                                                    <option value="Work">Work</option>
                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                        <div class="colm colm12 phoneadddeliverrow2">
                                            <a href="#" style="font-size: 12px;">+ Add Another Phone Number</a>
                                        </div>
                                    </div>
                                    <div class="frm-row strDeliver_Phone3" style="display: none;">
                                        <div class="colm colm8">
                                            Phone 3:<br>
                                            <input type="tel" name="strDeliver_Phone3" id="strDeliver_Phone3">
                                        </div>
                                        <div class="colm colm4">
                                            Type:<br>
                                            <label for="strDeliver_Phone3Type" class="field select">
                                                <select name="strDeliver_Phone3Type" id="strDeliver_Phone3Type">
                                                    <option value="Mobile">Mobile</option>
                                                    <option value="Home">Home</option>
                                                    <option value="Work">Work</option>
                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Do You Have a Backup Contact?&nbsp;<br>
                                            <label class="option" style="display:inline; font-weight: normal;">
                                                <input type="radio" name="strDeliver_BackupContact" id="strDeliver_BackupContact_yes" value="Yes" onclick="$('.strDeliver_BackupPhonerow').show();$('#strDeliver_BackupPhone').val('');"><span class="radio"></span> Yes
                                            </label>
                                            <label class="option" style="display:inline; font-weight: normal;">
                                                <input type="radio" name="strDeliver_BackupContact" id="strDeliver_BackupContact_no" value="No" onclick="$('.strDeliver_BackupPhonerow').hide();$('#strDeliver_BackupPhone').val('');" checked="checked"><span class="radio"></span> No
                                            </label>
                                            <div style="margin-bottom: 15px;"></div>
                                        </div>
                                    </div>
                                    <div class="frm-row strDeliver_BackupPhonerow" style="display: none;">
                                        <div class="colm colm8">
                                            Backup Contact Name:<br>
                                            <input type="text" name="strDeliver_BackupName" id="strDeliver_BackupName" size="25">
                                        </div>
                                        <div class="colm colm4"></div>
                                        <div class="colm colm8">
                                            Backup Contact Phone:<br>
                                            <input type="text" name="strDeliver_BackupPhone" id="strDeliver_BackupPhone" size="25">
                                        </div>
                                        <div class="colm colm4">
                                            Type:<br>
                                            <label for="strDeliver_BackupPhoneType" class="field select">
                                                <select name="strDeliver_BackupPhoneType" id="strDeliver_BackupPhoneType">
                                                    <option value="Mobile">Mobile</option>
                                                    <option value="Home">Home</option>
                                                    <option value="Work">Work</option>
                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="frm-group" style="margin-top: 40px;margin-bottom: 20px;">
                                    <a class="next_btn form-button" id="vehicle_details_btn">Continue →</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="pick_up_form colm colm8" id="vehicle_details">
                        <div class="left_pickup">
                            <?php if($howmany == "onevehicle") { ?>
                            <div class="frm-row">
                                <div class="colm colm12">
                                    <strong style="font-size: 25px;color: #2f69c3;">Vehicle Details</strong><br>
                                    <div style="margin:5px 0 5px 0;width:100%;border-top:#2f69c3 solid thin;"></div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="frm-row">
                                <?php

						

		

					if ($howmany != "onevehicle") { 

						

						if ($auto_make != "" && $auto_model !="") {

							$vehiclenum=1;

							$auto_pricetemp=$auto_price;

							$auto_yeartemp=$auto_year;

							$auto_maketemp=$auto_make;

							$auto_modeltemp=$auto_model;

							include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5-vehicleinput.php');

						}

					

						if ($auto_make2 != "" && $auto_model2 !="") {

							$vehiclenum=2;

							$auto_pricetemp=$auto_price2;

							$auto_yeartemp=$auto_year2;

							$auto_maketemp=$auto_make2;

							$auto_modeltemp=$auto_model2;

							include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5-vehicleinput.php');

						}

					

						if ($auto_make3 != "" && $auto_model3 !="") {

							$vehiclenum=3;

							$auto_pricetemp=$auto_price3;



							$auto_yeartemp=$auto_year3;

							$auto_maketemp=$auto_make3;

							$auto_modeltemp=$auto_model3;

							include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5-vehicleinput.php');

						}

					

						if ($auto_make4 != "" && $auto_model4 !="") {

							$vehiclenum=4;

							$auto_pricetemp=$auto_price4;

							$auto_yeartemp=$auto_year4;

							$auto_maketemp=$auto_make4;

							$auto_modeltemp=$auto_model4;

							include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5-vehicleinput.php');

						}

					

						if ($auto_make5 != "" && $auto_model5 !="") {

							$vehiclenum=5;

							$auto_pricetemp=$auto_price5;

							$auto_yeartemp=$auto_year5;

							$auto_maketemp=$auto_make5;

							$auto_modeltemp=$auto_model5;

							include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5-vehicleinput.php');

						}

		

					} else { ?>
                                <div class="">
                                    <input type="hidden" name="auto_price1" value="<?php echo $auto_price ?>">
                                    <div class="frm-row">
                                        <div class="colm colm4">
                                            Year:
                                            <label class="field append-icon">
                                                <input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Year" id="strVehicle_Year" value="<?php echo $auto_year ?>" size="20" <?php if($_COOKIE['admin']=="" ) { ?>readonly="readonly" style="border:0;"
                                                <?php } ?><br>
                                            </label>
                                        </div>
                                    
                                        <div class="colm colm4">
                                            Vehicle Make:
                                            <label class="field append-icon">
                                                <input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Make" id="strVehicle_Make" value="<?php echo $auto_make ?>" size="20" <?php if($_COOKIE['admin']=="" ) { ?>readonly="readonly" style="border:0;"
                                                <?php } ?>>
                                            </label>
                                        </div>
                                        <div class="colm colm4">
                                            Vehicle Model:
                                            <label class="field append-icon">
                                                <input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Model" id="strVehicle_Model" value="<?php echo $auto_model ?>" size="20" <?php if($_COOKIE['admin']=="" ) { ?>readonly="readonly" style="border:0;"
                                                <?php } ?>>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Additional Vehicle Information:<br>
                                            <input type="text" name="strVehicle_AdditionalInfo" id="strVehicle_AdditionalInfo" size="60" maxlength="60">
                                        </div>
                                    </div>
                                    <?php 

						if ($howmany == "onevehicle") {  ?>
                                    <script>
                                        $(function() {
									$( "#strVehicle_LiftKityes" ).click(function() {
										$("#dialog-liftkit").dialog('open');
									});

									$( "#dialog-liftkit" ).dialog({
									  modal: true,
									  width: 'auto',
									  autoOpen: false,
									  fluid: true,
									  resizable: false,
									  buttons: {
										Ok: function() {
										  $( this ).dialog( "close" );
										  $('#strVehicle_LiftKitno').prop("checked", true);
										}	
									  }
									});   
									
									$( "#strVehicle_Loweredyes" ).click(function() {
										$("#dialog-lowered").dialog('open');
									});							

									$( "#dialog-lowered" ).dialog({
									  modal: true,
									  width: 'auto',
									  autoOpen: false,
									  fluid: true,
									  resizable: false,
									  buttons: {
										Ok: function() {
										  $( this ).dialog( "close" );
										  $('#strVehicle_Loweredno').prop("checked", true);
										}
									  }
									});  							

									$( "#strVehicle_Oversized_Tiresyes" ).click(function() {
										$("#dialog-tires").dialog('open');
									});				

									$( "#dialog-tires" ).dialog({

									  modal: true,
									  width: 'auto',
									  autoOpen: false,
									  fluid: true,
									  resizable: false,
									  buttons: {
										Ok: function() {
										  $( this ).dialog( "close" );
										  $('#strVehicle_Oversized_Tiresno').prop("checked", true);
										}
									  }
									});       	
								});

								</script>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            We can advise you still better if we know about any special circumstances regarding your vehicle. Please tell us whether yours is a convertible, has oversized tires, low ground clearance or lifted?
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Is The Vehicle a Convertible?<br>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_Convertible" id="strVehicle_Convertibleyes" value="yes">
                                                <span class="radio"></span> Yes
                                            </label>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_Convertible" id="strVehicle_Convertibleno" value="no" checked="checked">
                                                <span class="radio"></span> No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Is The Vehicle Lifted?<br>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_LiftKit" id="strVehicle_LiftKityes" value="yes">
                                                <span class="radio"></span> Yes
                                            </label>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_LiftKit" id="strVehicle_LiftKitno" value="no" checked="checked">
                                                <span class="radio"></span> No
                                            </label>
                                            <div id="dialog-liftkit" title="Sorry..." style="display:none;">
                                                To place an order for a lifted vehicle,<br>please call us at 800-600-3750.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Does the vehicle have less than 5 inch ground clearance?<br>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_Lowered" id="strVehicle_Loweredyes" value="yes">
                                                <span class="radio"></span> Yes
                                            </label>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_Lowered" id="strVehicle_Loweredno" value="no" checked="checked">
                                                <span class="radio"></span> No
                                            </label>
                                            <div id="dialog-lowered" title="Sorry..." style="display:none;">
                                                To place an order for a lowered vehicle,<br>please call us at 800-600-3750.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm12">
                                            Does The Vehicle Have Oversized Tires?<br>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_Oversized_Tires" id="strVehicle_Oversized_Tiresyes" value="yes">
                                                <span class="radio"></span> Yes
                                            </label>
                                            <label class="option" style="display:inline;">
                                                <input type="radio" name="strVehicle_Oversized_Tires" id="strVehicle_Oversized_Tiresno" value="no" checked="checked">
                                                <span class="radio"></span> No
                                            </label>
                                            <div id="dialog-tires" title="Sorry..." style="display:none;">
                                                To place an order for a vehicle with oversized tires,<br>please call us at 800-600-3750.
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <div class="frm-group" style="margin-top: 0px;margin-bottom: 20px;float: left;width: 100%;">
                                    <button type="submit" class="next_btn form-button">
                                        Continue <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                </div>
                <div class="pick_up_form colm colm4">
                	<?php include 'shipping_details.php' ?>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">



$(function() {





    $('#vehicle_details_btn').click(function() {



        $('#deleiver_form').css("display", "block");

        $('#pickup_form_main').css("display", "none");



        $('#delivery_details_banner').css("display", "flex");




        $('#process_steps2').css("display", "block");



        $('#process_steps').css("display", "none");

        $('#deleiver_form').css("display", "none");

        $('#pickup_form_main').css("display", "none");

        $('#vehicle_details').css("display", "block");





        $('#vehicle_details_banner').css("display", "flex");




        $('#delivery_details_banner').css("display", "none");



        $('#process_steps2').css("display", "none");



        $('#process_steps3').css("display", "block");


        window.location = '#pickup_delivery';



    });











    $('#shipping_bt').click(function() {



        $('#deleiver_form').css("display", "none");

        $('#pickup_form_main').css("display", "block");

        $('#vehicle_details').css("display", "none");





        $('#vehicle_details_banner').css("display", "none");



        $('#origination_pickup_banner').css("display", "flex");



        $('#delivery_details_banner').css("display", "none");



        $('#process_steps').css("display", "block");



        $('#process_steps2').css("display", "none");



        $('#process_steps3').css("display", "none");



    });









    $('#vehicle_bt').click(function() {



        $('#deleiver_form').css("display", "block");

        $('#pickup_form_main').css("display", "none");

        $('#vehicle_details').css("display", "none");





        $('#vehicle_details_banner').css("display", "none");



        $('#origination_pickup_banner').css("display", "none");



        $('#delivery_details_banner').css("display", "flex");



        $('#process_steps2').css("display", "block");



        $('#process_steps3').css("display", "none");



    });











});
</script>
<?php if($_COOKIE['admin']!="") { ?>
<div class="section fieldentry">
    <div class="frm-row">
        <div class="colm colm12">
            <div style="width:620px;border:2px solid #000;background:#eee;padding:5px;margin: 0 auto; margin-bottom:15px; text-align: center">
                <strong>OFFICE USE ONLY</strong><br>
                <?php if($howmany == "onevehicle") { ?>
                <table style="margin:0 auto;">
                    <tr>
                        <td nowrap="nowrap"><strong>Shipping From:</td>
                        <td nowrap="nowrap">
                            <?php echo $strQuote_shippingfromcity . ", " . $strQuote_shippingfromstateabbr . " " . $strQuote_shippingfromzip ?>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><strong>Shipping To:</td>
                        <td nowrap="nowrap">
                            <?php echo $strQuote_shippingtocity . ", " . $strQuote_shippingtostateabbr . " " . $strQuote_shippingtozip ?>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><strong>Name:</td>
                        <td nowrap="nowrap">
                            <?php echo $strCustFirstName . " " . $strCustLastName ?>
                        </td>
                    </tr>
                    <?php if(!empty($strCustCompany)) { ?>
                    <tr>
                        <td nowrap="nowrap"><strong>Company:</td>
                        <td nowrap="nowrap">
                            <?php echo $strCustCompany ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td nowrap="nowrap"><strong>Phone:</td>
                        <td nowrap="nowrap">
                            <?php echo $strCustPhone1 ?>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><strong>E-Mail Address:</td>
                        <td nowrap="nowrap">
                            <?php echo $strCustEmail ?>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><strong>Ship Date:</td>
                        <td nowrap="nowrap">
                            <?php echo $strDateAvailable ?>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><strong>
                                <?php echo $strVehicle_Year ?> -
                                <?php echo $strVehicle_Make ?> -
                                <?php echo $strVehicle_Model ?>:</strong>&nbsp;&nbsp;</td>
                        <td nowrap="nowrap">$
                            <?php echo $auto_price ?>
                        </td>
                    </tr>
                    <?php if(!empty($strVehicle_AdditionalInfo)) { ?>
                    <tr>
                        <td nowrap="nowrap"><strong>Additional Vehicle Info:&nbsp;&nbsp;&nbsp;</strong></td>
                        <td nowrap="nowrap">
                            <?php echo $strVehicle_AdditionalInfo ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($strQuote_vehicle_operational == "Non-Running") { ?>
                    <tr>
                        <td nowrap="nowrap"><strong>Operating Condition (Non-Running):</strong></td>
                        <td nowrap="nowrap">$150</td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td nowrap="nowrap"><strong>Deposit:</strong></td>
                        <td nowrap="nowrap">$
                            <?php echo $strDeposit ?>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><strong>Total:</strong></td>
                        <td nowrap="nowrap"><strong>$
                                <?php echo $strTotalPrice ?></strong></td>
                    </tr>
                </table><br>
                <?php } ?>
                <strong>Shipping Distance:</strong>
                <?php echo $totaldistance ?> miles<br>
                <?php

                

                			$deposittotal = $numvehicles * $depositpervehicle;

                			$duecarrier = $strTotalPrice - $deposittotal;

                			$pricepermile = ($strTotalPrice-$strDeposit) / $totaldistance;

                			$pricepermile = number_format($pricepermile,2);

                

                

                		if ($howmany != "onevehicle") {

                

                		?>
                <br>
                <strong>Types & Prices of Vehicles WITHOUT Deposit</strong>
                <br>
                <div class="numbutton1">1</div>
                <div class="makemodel">
                    <?php echo $auto_year ?> -
                    <?php echo $auto_make ?> -
                    <?php echo $auto_model ?> - $
                    <?php echo $auto_price ?>
                </div>
                <div style="clear:both"></div>
                <?php if (!empty($auto_make2)) { ?>
                <div class="numbutton1">2</div>
                <div class="makemodel">
                    <?php echo $auto_year2 ?> -
                    <?php echo $auto_make2 ?> -
                    <?php echo $auto_model2 ?> - $
                    <?php echo $auto_price2 ?>
                </div>
                <div style="clear:both"></div>
                <?php } ?>
                <?php if (!empty($auto_make3)) { ?>
                <div class="numbutton1">3</div>
                <div class="makemodel">
                    <?php echo $auto_year3 ?> -
                    <?php echo $auto_make3 ?> -
                    <?php echo $auto_model3 ?> - $
                    <?php echo $auto_price3 ?>
                </div>
                <div style="clear:both"></div>
                <?php } ?>
                <?php if (!empty($auto_make4)) { ?>
                <div class="numbutton1">4</div>
                <div class="makemodel">
                    <?php echo $auto_year4 ?> -
                    <?php echo $auto_make4 ?> -
                    <?php echo $auto_model4 ?> - $
                    <?php echo $auto_price4 ?>
                </div>
                <div style="clear:both"></div>
                <?php } ?>
                <?php if (!empty($auto_make5)) { ?>
                <div class="numbutton1">5</div>
                <div class="makemodel">
                    <?php echo $auto_year5 ?> -
                    <?php echo $auto_make5 ?> -
                    <?php echo $auto_model5 ?> - $
                    <?php echo $auto_price5 ?>
                </div>
                <div style="clear:both"></div>
                <?php } ?>
                <br>
                <strong>Deposit:</strong> $
                <?php echo $deposittotal ?><br>
                <strong>Due Carrier:</strong> $
                <?php echo $duecarrier ?><br>
                <strong>Price Per Carrier Mile:</strong> $
                <?php echo $pricepermile ?><br>
                <?php } else { ?>
                <strong>Price Per Mile:</strong> $
                <?php echo $pricepermile ?> <br>
                <?php

                		}

                        echo "<hr style='margin: 10px 0;'>" . DisplayRatingInfo($zipadjustrating);

                		?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--<div class="section fieldentry" style="margin-top: 50px;" id="agree_section">

		

		<div class="container">



        <div class="frm-row">

            <div class="colm colm12" style="margin-top: 50px;">

                <strong style="font-size: 20px;">Terms & Conditions</strong><br>

                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>

            </div>

        </div>

        <div class="frm-row">

            <div class="colm colm12">





                        <textarea cols="70" rows="8" name="termsconditions" id="termsconditions" readonly class="bodytext" style="font-size: 12px;">

Shipper and Direct Express Auto Transport Agree To The Following:



1. Pick up and delivery is from your door to your door unless residential area restrictions apply. If your vehicle is inoperable or oversize (dual or oversize wheels, extra-large, racks, lifted, limo, etc.), please inquire as to extra charges. If carrier is not advised of inoperable or oversized vehicles prior to pick-up, all extra charges must be paid in cash or money order made payable to delivery company upon delivery.



2. The carrier and driver jointly and separately are authorized to operate and transport his/her or their motor vehicle between its pick up location and the destination set forth on this shipping order-bill of lading.



3. Direct Express agrees to provide a carrier to transport your vehicle as promptly as possible in accordance with your instructions but cannot guarantee pick-up or delivery on a specified date or time. If the customer cancels an order his deposit will be refunded in full. Direct Express reserves the right to reject any order and will refund the deposit in full.



4. If a shipping rate was chosen greater than the Standard Rate, it cannot be changed once a carrier has been assigned, regardless of estimated shipping dates or date of assignment. All changes to the shipping price, whether greater or lesser in amount, must occur prior to vehicle assignment and acknowledged by Direct Express via email. The carrier accepted your vehicle for shipping and reserved space for it based upon the amount offered and is not responsible for how long it took to have it assigned, picked up or delivered.



5. Shipper shall remove all non-permanent outside mounted luggage and other racks prior to shipment. Vehicles must be tendered to carrier in good running condition (unless otherwise noted) with no more than a half tank of fuel (prefer 1/4 tank).



6. Luggage and personal property must be confined to trunk, with no heavy articles, and not to exceed 100 lbs.. Carrier is not liable for personal items left in vehicle, nor for damage caused to vehicle from excessive or improper loading of personal items. Direct Express does not agree to pay for your rental of a vehicle, nor shall it be liable for failure of mechanical or operating parts of your vehicle.



7. Trucking damage claims are covered by a minimum of 3/4 of a million dollars public liability and property damage. All claims must be noted and signed for at time of delivery, and submitted in writing within 15 days of delivery. Direct Express will share the carrier insurance policy upon request.



8. No electronic equipment, valuables, plants, live pets, alcohol, drugs or firearms, may be left in the vehicle.



9. International orders,the car must be empty except for factory installed equipment. Indicate serial #, and give car's approximate value in U.S. dollars. Shipper is responsible for the proper customs paperwork. (ask the assigned carrier for help with these documents)



10. Shipper warrants that he will pay the price quoted due Direct Express Auto Transport, Inc. for delivered vehicles, and will not seek to charge back a credit card or stop a check to offset any dispute for damage claims. Department of Transportation regulations require that all claims be filed in writing and all tariffs be paid in full before claim can be processed.



This agreement and any shipment here under is subject to all terms and conditions of the carrier's tariff and the uniform straight bill of lading, copies of which are available at the office of the carrier.



This supersedes all prior written or oral representation of Direct Express and constitutes the entire agreement between shipper and Direct Express and may not be changed except in writing signed by an officer of Direct Express.



Direct Express' U.S. Department of Transportation Broker's license number is 479342.

                

                        </textarea>



                        <label class="option">

                            <input type="checkbox" name="agreetoterms" id="agreetoterms" value="1">

                            <span class="checkbox"></span> Click here to agree to terms and conditions.

                        </label>

                        <div class="errormsg"></div>



            </div>

            

        </div>



        <div class="frm-row">

            <div class="colm colm4">

                <button type="submit" class="next_btn">

                    Continue&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>

                </button>

            </div>

        </div>

      

	    </div>

     

        

      </div>-->
</form>
</div>

<!---logos----->
<div class="frm-row" style="margin: 50px 0 50px;">
    <div class="logos-sectio">
        <h2>People Love Direct Express Auto Transport</h2>
        <div class="custom_bord"></div>
        <div class="logos_inner">
            <div class="log">
                <img alt="" data-src="/wp-content/uploads/2022/07/download.png" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/2022/07/download.png">
            </div>
            <div class="log">
                <img alt="" data-src="/wp-content/uploads/2022/07/5-star-google-reviews-google-review-5-stars-11563138345tqaiumovcm.png" class="ls-is-cached lazyloaded " src="/wp-content/uploads/2022/07/5-star-google-reviews-google-review-5-stars-11563138345tqaiumovcm.png"><noscript><img alt="" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/2022/07/5-star-google-reviews-google-review-5-stars-11563138345tqaiumovcm.png"></noscript>
            </div>
            <div class="log">
                <img alt="" data-src="/wp-content/uploads/2022/07/trustpilot-energy-reviews.png" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/2022/07/trustpilot-energy-reviews.png">
            </div>
        </div>
    </div>
    <div class="logos_bottom">
        Direct Express Auto Transport is the highest rated and most reliable car shipper! Going strong since 2004.
    </div>
    <div class="colm colm12">
        <?php echo do_shortcode('[elementor-template id="76526"]') ?>
    </div>
</div>
<div class="bottom_sec_main">
    <div class="bottom_sec">
        <div class="bottom_sec_inner">
            <div class="colm colm12">
                <style>
                .smart-forms .section{
                    margin:  0px !important;
                }
                .smart-forms{
                    background-color: #eee;
                }    
                .text-right{
                    text-align: right;
                }
                .embed-container {
                    border: 1px solid #ccc;
                    position: relative;
                    padding-bottom: 56.25%;
                    height: 0;
                    overflow: hidden;
                    max-width: 100%;
                }

                .embed-container iframe,
                .embed-container object,
                .embed-container embed {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
                </style>
                <div class='embed-container'><iframe src='https://player.vimeo.com/video/460362004' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                <div style="text-align:center; font-size: 16px; line-height: 22px; font-weight: 600 !important;margin-top: 15px;">What to Expect at Pickup<div style="margin-top:10px;"></div>
                </div>
            </div>
            <!--<div class="colm colm16">

                <h3 class="vid_sec">First Date Your Vehicle Is Available To Ship (Cond)</h3>

                <div class="custom_bord2"></div>

                

                <ul class="vid_secul">

                   <li>You are selecting the first day your vehicle is available.</li>

                   <li>It might get picked up sometime after the first date.</li>

                   <li>We alert you to your carrier assignment by email.</li>

                   <li>A typical on the road transit time is 500 miles per day.</li>

                   <li>The route you selected in this order is <?php //echo number_format($totaldistance) ?> miles.</li>

                   <li>Do not select a first available date more than 21 days out.</li>

                   <li>Because market pricing may change significantly after 21 days.</li>

                </ul>

                

            </div>-->
        </div>
    </div>
</div>
