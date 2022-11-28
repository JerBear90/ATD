<?php
$CurrentUsername = $_COOKIE['rep'];

//SALES CONVERSION UPDATE start
$trackid = $_COOKIE['trackid'];
if (!empty($trackid)) {
	$zipadjustrating = GetRatingRep($shippingfromzip,$shippingtozip,$totaldistance);
	$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '3. Shipment Details' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end

    
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

$Selected_tier_name = postdb('Selected_tier_name');
$Selected_tier_price = postdb('Selected_tier_price');


$shippingfrom_sales = postdb('shippingfrom_sales');

$auto_year = postdb('auto_year');
$auto_make = postdb('auto_make');
$auto_model = postdb('auto_model');
$auto_price = postdb('auto_price');
$auto_price_exp = postdb('auto_price_exp');
$auto_price_rush = postdb('auto_price_rush');

$howmany = postdb('howmany');
$numvehicles = postdb('numvehicles');

$auto_year2 = postdb('auto_year2');
$auto_make2 = postdb('auto_make2');
$auto_model2 = postdb('auto_model2');
$auto_price2 = postdb('auto_price2');
$auto_price2_exp = postdb('auto_price2_exp');
$auto_price2_rush = postdb('auto_price2_rush');

$auto_year3 = postdb('auto_year3');
$auto_make3 = postdb('auto_make3');
$auto_model3 = postdb('auto_model3');
$auto_price3 = postdb('auto_price3');
$auto_price3_exp = postdb('auto_price3_exp');
$auto_price3_rush = postdb('auto_price3_rush');

$auto_year4 = postdb('auto_year4');
$auto_make4 = postdb('auto_make4');
$auto_model4 = postdb('auto_model4');
$auto_price4 = postdb('auto_price4');
$auto_price4_exp = postdb('auto_price4_exp');
$auto_price4_rush = postdb('auto_price4_rush');

$auto_year5 = postdb('auto_year5');
$auto_make5 = postdb('auto_make5');
$auto_model5 = postdb('auto_model5');
$auto_price5 = postdb('auto_price5');
$auto_price5_exp = postdb('auto_price5_exp');
$auto_price5_rush = postdb('auto_price5_rush');

$customer_name = postdb('customer_name');
$customer_email = postdb('customer_email');
$customer_phone = postdb('customer_phone');
$customer_movedate = postdb('customer_movedate');

if ($_COOKIE['repeat_email'] != "") {
	$customer_email = $_COOKIE['repeat_email'];
}

$customer_namearr = explode(" ", $customer_name);

if (sizeof($customer_namearr) > 1) {
	$first_name =  $customer_namearr[0];
	$last_name = $customer_namearr[0];
} else {
	$first_name = $customer_name;
}

$depositpervehicle = postdb('depositpervehicle');
$depositpervehicle_exp = postdb('depositpervehicle_exp');
$depositpervehicle_rush = postdb('depositpervehicle_rush');
$carrierdiscount = postdb('carrierdiscount');
$depositdiscount = postdb('depositdiscount');
$discstatus = postdb('discstatus');
$ps = postdb('ps');

$helpfulhintmention = postdb('helpfulhintmention');

$DaysWaitingPickupTotalOrders = postdb('DaysWaitingPickupTotalOrders');
$DaysWaitingPickupAvg = postdb('DaysWaitingPickupAvg');
$DaysWaitingDeliverTotalOrders = postdb('DaysWaitingDeliverTotalOrders');
$DaysWaitingDeliverAvg = postdb('DaysWaitingDeliverAvg');
$DaysWaitingAvg = postdb('DaysWaitingAvg');

$rating_origin = postdb('rating_origin');
$rating_dest = postdb('rating_dest');
$rating_vehicle = postdb('rating_vehicle');


$pricetier = postdb('pricetier');


$strDeposit = postdb('strDeposit');
$strDeposit_exp = postdb('strDeposit_exp');
$strDeposit_rush = postdb('strDeposit_rush');



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







$strBalance = $strTotalPrice - $strDeposit;
$strBalance_exp = $strTotalPrice_exp - $strDeposit_exp;
$strBalance_rush = $strTotalPrice_rush - $strDeposit_rush;


if ($pricetier==1) {
	$pricetiername = "Standard";
} elseif ($pricetier==2) {
	$pricetiername = "Expedited";
	$strDeposit = $strDeposit_exp;
	$depositpervehicle = $depositpervehicle_exp;
	$auto_price=$auto_price_exp;
	$auto_price2=$auto_price2_exp;
	$auto_price3=$auto_price3_exp;
	$auto_price4=$auto_price4_exp;
	$auto_price5=$auto_price5_exp;
	$strBalance = $strBalance_exp;
	
	
} else {
	$pricetiername = "Rush";
	$strDeposit = $strDeposit_rush;
	$depositpervehicle = $depositpervehicle_rush;
	$auto_price=$auto_price_rush;
	$auto_price2=$auto_price2_rush;
	$auto_price3=$auto_price3_rush;
	$auto_price4=$auto_price4_rush;
	$auto_price5=$auto_price5_rush;
	$strBalance = $strBalance_rush;
}



//SALES CONVERSION UPDATE start
$trackid = $_COOKIE['trackid'];
if (!empty($trackid)) {
	$sql = "update sale_conversion set dateupdated=NOW(),sale_status = '2. Customer Info' where trackid = '$trackid'";
    $wpdb->query($sql);
}
//SALES CONVERSION UPDATE end

?>

<script src="/wp-content/themes/atdv2/js/easyautocomplete/jquery.easy-autocomplete.min.js"></script> 

<link rel="stylesheet" href="/wp-content/themes/atdv2/js/easyautocomplete/easy-autocomplete.min.css"> 
	
<style>

.order_info_form .frm-group
{
	margin-bottom: 10px;
}

.easy-autocomplete
{
    width:100% !important;
}

.my_order #edit_icon 
{
    float: right;
    display: inline;
    margin-top: -3px;
}

.my_order #edit_icon a
{
    font-size: 13px;
    /* line-height: 44px; */
    display: inline;
    color: #F1661E;
    /* text-decoration: underline; */
}

.order_info_form
{
    display:none;
}


.back_btn
{
    text-align:center;
}
    
    /***************progress bar************/
    
    .progressbar_inner
    {
        display: flex;
        justify-content: space-between;
        width: 80%;
        margin: 0 auto;
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
    
    .progressbar_inner span.title2 
    {
        display: block;
        text-align: center;
        color: #283337;
        font-family: "Helvetica", Sans-serif;
        font-size: 20px;
        font-weight: 500;
        margin-left: -10px;
    }
    
    .progressbar_inner .wi_div
    {
        width:50px;
    }
    
    .line_bar 
    {
        border-bottom: 1px solid #c1bcbc;
        height: 25px;
        width: 100%;
    }
    
    .progressbar_inner .wi_div.active .number
    {
        background-color: #487BCA;
    }
    
    
    /************************************/
    
    .ordersteps img {
    max-width: 720px!important;
}
    
    .my_order
    {
           font-size: 20px;
    font-weight: 700;
            color: #333;
            /* line-height: 66px; */
            margin-bottom: 20px;
            border-bottom: 1px solid #333;
    }

    .step4inner_grid
    {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 30px;
    }
    
    .inner_step4_left
    {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 60px;
    }
    
    .step4_left
    {
       /* margin-top:60px;*/
    }
    
    .first_dateship
    {
        font-family: "Helvetica", Sans-serif;
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 7px !important;
    }
	
	.inner-container
	{
		display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 40px;
	}
	
	.right-banner 
	{
        text-align: center;
    }
    
    .right-banner img 
    {
        width: 75%;
        border-radius: 20px;
    }

    .ui-dialog-titlebar-close {
        display: none;
    }
    
    .sec2 {
        background-image: url(https://www.autotransportdirect.com/wp-content/uploads/2022/07/banner-step-2.jpg);
        width: 50%;
        background-size: cover;
        background-repeat: no-repeat;
        display:none;
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

.spn {
    font-size: 12px;
    letter-spacing: 3px;
    font-weight: 700;
    color: #333;
    margin: 20px 0 10px;
}

.head {
    font-size: 3.5vw;
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
	
	.logos-sectio 
	{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    
    .logos-sectio .logos_inner 
    {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 40px;
        align-items: center;
        width: 60%;
        margin: 55px auto 30px auto;
    }
    
    .logos-sectio .logos_inner .log 
    {
        text-align: center;
    }
    
    .logos-sectio .logos_inner .log img 
    {
        width: 55%;
    }
    
    .logos-sectio h2 
    {
       text-align: center;
        color: #283337;
        font-family: "Helvetica", Sans-serif;
        font-size: 42px;
        font-weight: 500;
        line-height: 45px;
        margin-bottom: 0px !important;
        padding-bottom: 0px;
    }
    
    .custom_bord 
    {
        border-radius: 1rem;
        width: 15rem;
        height: 2px;
        background-color: #487BCA;
        margin: 20px auto 30px auto;
    }
    
    .logos_bottom
    {
        color: #283337;
        font-family: "Helvetica", Sans-serif;
        font-size: 18px;
        font-weight: 300;
        line-height: 45px;
        text-align: center;
        margin-bottom: 50px;
    }
	
	
	.bottom_sec_main 
	{
	       background-color: #f1f1f1;     
    	padding-top: 40px;
    	padding-bottom: 30px;
    	margin-top: 35px;
	}
	
	.bottom_sec 
	{
    	width: 50%;
    	margin: 20px auto;
	}
	
	.bottom_sec_inner 
	{
    	display: grid;
    	/*grid-template-columns: 1fr 1fr;*/
    	grid-column-gap: 50px;
	}
	
	
	.vid_sec
	{
        font-family: "Helvetica", Sans-serif;
        font-size: 20px;
        margin-top: 0px;
        margin-bottom: 14px;
    }
    
    
    ul.vid_secul 
    {
        padding: 0px;
        margin-left: 20px;
    }
    
    
    .vid_secul li 
    {
        font-size: 15px;
        margin-bottom: 2px;
    }
    
    #step4_form
    {
              padding: 3% 0;
                margin-bottom: 50px;
                background-image: url(https://www.autotransportdirect.com/wp-content/uploads/2022/07/map-location.jpg);
                background-repeat: no-repeat;
                background-size: contain;
                object-fit: cover;
                background-position: right;
    }
    
    .inner_step4
    {
           display: grid;
            grid-template-columns: 2fr 1fr;
            grid-column-gap: 40px;
            /* width: 65%; */
            margin: 20px auto;
    
    }
    
    .step4_right
    {
       background-color: #fff;
        padding: 40px 29px;
        border-radius: 20px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        border-top: 5px solid #F1661E;
    }
    
    .step4_right .frm-group
    {
        margin-bottom: 15px;
    }
    
    
    .step4_btn
    {
        text-align:center;
    }



    
    .goonbutton
    {
        color: #fff !important;
        background-color: #0062cc;
        border: 2px solid #014793;
        font-size: 14px;
        font-family: "Helvetica", Sans-serif !important;
        border-radius: 50px;
        letter-spacing: .5px;
        width: auto !important;
        text-transform: uppercase;
        font-weight: bold;
        padding: 11px 40px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        margin-top: 20px !important;
    }
    
    .goonbutton:hover 
    {
        background-color: #e6a300;
        border: 2px solid #af7c01;
    }
    
    
    .frm-group .formlabel
	{
	    font-family: "Helvetica", Sans-serif;
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 5px;
	}
	
	.imagebox2 img
	{
        border-radius: 20px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        width: 100%;
        object-fit: contain;

    }
    
    .imagecaption
    {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
            font-family: "Helvetica", Sans-serif;
    }
    
    .quotelabel1 
    {
        /*font-size: 18px;
        display: inline;
        line-height: 30px;
        color: #095bc2;
        font-weight: 700;*/
        
        
        font-size: 18px;
        display: inline;
        line-height: 30px;
        color: #444;
        font-weight: 400;
        
    }
    
    .block1
    {
        color: #333;
        font-family: "Helvetica", Sans-serif;
        font-size: 16px;
        margin-bottom: 15px;
    }
	
	.block1_desc
	{
	    /*border-bottom: 1px solid #BEBEBE;
        padding: 3px;
        line-height: 26px;*/
        border-bottom: 1px solid #BEBEBE;
        padding: 3px;
        line-height: 26px;
        font-weight: 600;
            color: #487BCA;
	}
	
	@media(max-width:767px)
	{
	    .progressbar_inner
	    {
		    width: 95%;
	    }
	    
	    .progressbar_inner span.title2
	    {
	        margin-left: -3px;
	    }
	}
	
	
	@media(max-width:480px)
	{
	    .progressbar_inner
	    {
		    width: 98%;
	    }
	    
	    .progressbar_inner span.title2
	    {
	        margin-left: -3px;
	        font-size:14px;
	    }
	    
	    .step4inner_grid 
	    {
            grid-template-columns: 1fr;
	    }
	    
	    .step4_right .frm-group {
            margin-bottom: 6px;
        }
	}



	
</style>


<script id="demo" type="text/javascript">


jQuery(document).ready(function() {
	
	jQuery(".my_order").click(function(e){
		e.preventDefault();
		jQuery(".order_info_custom").toggle();
		jQuery(".order_info_form").toggle();
	});

});


$(document).ready(function() {



	// validate signup form on keyup and submit
	var validator = $("#mainform").validate({
		rules: {
			strCustFirstName: "required",
			strCustLastName: "required",
			strCustEmail: "required",


			strVehicle_ComingFrom: {
				required: function(element) {return $("#strVehicle_ComingFrom_yes:unchecked").length == 0;}
			},


			<?php if($numvehicles == 1) { ?>



				strVehicle_StockNum: {
					required: function(element) {return $("#strVehicle_ComingFrom").val()=='Auto Auction'}
				},




			<?php } else {
    			for ($counter=1; $counter<=$numvehicles; $counter++) {
			?>


				strVehicle_StockNum<?php echo $counter ?>: {
					required: function(element) {return $("#strVehicle_ComingFrom").val()=='Auto Auction'}
				},




			<?php
                }
			}
			?>

			strDateAvailable: {
				date: true,
				required: true
			}



		},
		messages: {
			strDateAvailable: {
				required: "Please enter a Pickup Date",
				date: "Please enter a valid Pickup Date"
			},
			agreetoterms: "You must agree to the Terms & Conditions before proceeding."
		},

		// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
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
			label.html(" ").addClass("checked");
		}
	});


    $( "#strDateAvailable" ).datepicker({
		minDate: '0d',
		maxDate: '+42d'
		/*prevText: '<i class="ticon ticon-chevron-left"></i>',
		nextText: '<i class="ticon ticon-chevron-right"></i>'*/	});
				

});

</script>





<form action="?step=5#pickup_deleivery" method="post" name="mainform" id="mainform">    
<input type="hidden" name="strQuote_shippingfromstateabbr" id="shippingfromstateabbr" value="<?php echo $strQuote_shippingfromstateabbr ?>">
<input type="hidden" name="strQuote_shippingtostateabbr" id="shippingtostateabbr" value="<?php echo $strQuote_shippingtostateabbr ?>">
<input type="hidden" name="strQuote_shippingfromstate" id="shippingfromstate" value="<?php echo $strQuote_shippingfromstate ?>">
<input type="hidden" name="strQuote_shippingtostate" id="shippingtostate" value="<?php echo $strQuote_shippingtostate ?>">
<input type="hidden" name="strQuote_shippingfromzip" id="shippingfromzip" value="<?php echo $strQuote_shippingfromzip ?>">
<input type="hidden" name="strQuote_shippingtozip" id="shippingtozip" value="<?php echo $strQuote_shippingtozip ?>">

<input type="hidden" name="strQuote_shippingfromcity"  id="shippingfromcity" value="<?php echo $strQuote_shippingfromcity ?>">
<input type="hidden" name="strQuote_shippingtocity" id="shippingtocity" value="<?php echo $strQuote_shippingtocity ?>">



<input type="hidden" name="strQuote_vehicle_operational" id="vehicle_operational" value="<?php echo $strQuote_vehicle_operational ?>">
<input type="hidden" name="strQuote_vehicle_trailer" id="vehicle_trailer" value="<?php echo $strQuote_vehicle_trailer ?>">
<input type="hidden" name="totaldistance" value="<?php echo $totaldistance ?>">

<input type="hidden" id="strBalance_init" name="strBalance_init" value="<?php echo $strBalance ?>">
<input type="hidden" id="strBalance" name="strBalance" value="<?php echo $strBalance ?>">
<input type="hidden" id="strDeposit" name="strDeposit" value="<?php echo $strDeposit ?>">
<input type="hidden" name="depositpervehicle" value="<?php echo $depositpervehicle ?>">
<input type="hidden" id="carrierdiscount" name="carrierdiscount" value="<?php echo $carrierdiscount ?>">
<input type="hidden" name="depositdiscount" value="<?php echo $depositdiscount ?>">
<input type="hidden" name="discstatus" value="<?php echo $discstatus ?>">
<input type="hidden" name="ps" value="<?php echo $ps ?>">


<input type="hidden" name="helpfulhintmention" value="<?php echo $helpfulhintmention ?>">

<input type="hidden" name="shippingfrom_sales" value="<?php echo $shippingfrom_sales ?>">

<input type="hidden" id="strTotalPrice_init" name="strTotalPrice_init" value="<?php echo $strTotalPrice ?>">
<input type="hidden" id="strTotalPrice" name="strTotalPrice" value="<?php echo $strTotalPrice ?>">

<input type="hidden" id="pricetier" name="pricetier" value="<?php echo $pricetier ?>">


<input type="hidden" name="howmany" value="<?php echo $howmany ?>">
<input type="hidden" name="numvehicles" value="<?php echo $numvehicles ?>">

<input type="hidden" name="rating_origin" value="<?php echo $rating_origin ?>">
<input type="hidden" name="rating_dest" value="<?php echo $rating_dest ?>">
<input type="hidden" name="rating_vehicle" value="<?php echo $rating_vehicle ?>">

<input type="hidden" id="auto_price_init_1" name="auto_price_init_1" value="<?php echo $auto_price ?>">
<input type="hidden" id="auto_price_init_2" name="auto_price_init_2" value="<?php echo $auto_price2 ?>">
<input type="hidden" id="auto_price_init_3" name="auto_price_init_3" value="<?php echo $auto_price3 ?>">
<input type="hidden" id="auto_price_init_4" name="auto_price_init_4" value="<?php echo $auto_price4 ?>">
<input type="hidden" id="auto_price_init_5" name="auto_price_init_5" value="<?php echo $auto_price5 ?>">


<input type="hidden" id="auto_price1" name="auto_price" value="<?php echo $auto_price ?>">
<input type="hidden" id="auto_price2" name="auto_price2" value="<?php echo $auto_price2 ?>">
<input type="hidden" id="auto_price3" name="auto_price3" value="<?php echo $auto_price3 ?>">
<input type="hidden" id="auto_price4" name="auto_price4" value="<?php echo $auto_price4 ?>">
<input type="hidden" id="auto_price5" name="auto_price5" value="<?php echo $auto_price5 ?>">

<input type="hidden" name="auto_year" value="<?php echo $auto_year ?>">
<input type="hidden" name="auto_model" value="<?php echo $auto_model ?>">
<input type="hidden" name="auto_make" value="<?php echo $auto_make ?>">

<?php if($howmany != "onevehicle") { ?>
<input type="hidden" name="auto_year2" value="<?php echo $auto_year2 ?>">
<input type="hidden" name="auto_make2" value="<?php echo $auto_make2 ?>">
<input type="hidden" name="auto_model2" value="<?php echo $auto_model2 ?>">
<input type="hidden" name="auto_year3" value="<?php echo $auto_year3 ?>">
<input type="hidden" name="auto_make3" value="<?php echo $auto_make3 ?>">
<input type="hidden" name="auto_model3" value="<?php echo $auto_model3 ?>">
<input type="hidden" name="auto_year4" value="<?php echo $auto_year4 ?>">
<input type="hidden" name="auto_make4" value="<?php echo $auto_make4 ?>">
<input type="hidden" name="auto_model4" value="<?php echo $auto_model4 ?>">
<input type="hidden" name="auto_year5" value="<?php echo $auto_year5 ?>">
<input type="hidden" name="auto_make5" value="<?php echo $auto_make5 ?>">
<input type="hidden" name="auto_model5" value="<?php echo $auto_model5 ?>">
<?php } ?>



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


<input type="hidden" id="auto_copartauction_cost" name="auto_copartauction_cost" value="0">

<input type="hidden" name="DaysWaitingPickupTotalOrders" value="<?php echo $DaysWaitingPickupTotalOrders ?>">
<input type="hidden" name="DaysWaitingPickupAvg" value="<?php echo $DaysWaitingPickupAvg ?>">
<input type="hidden" name="DaysWaitingDeliverTotalOrders" value="<?php echo $DaysWaitingDeliverTotalOrders ?>">
<input type="hidden" name="DaysWaitingDeliverAvg" value="<?php echo $DaysWaitingDeliverAvg ?>">
<input type="hidden" name="DaysWaitingAvg" value="<?php echo $DaysWaitingAvg ?>">

<input type="hidden" name="strSalesRep" value="<?php echo $CurrentUsername ?>">

<input type="hidden" name="Selected_tier_price" value="<?php echo $Selected_tier_price; ?>" />
<input type="hidden" name="Selected_tier_name" value="<?php echo $Selected_tier_name; ?>" />

<div id="dialog" title="Confirmation Required" style="display:none;"></div>

<div class="banner">
<div class="sec1">
<div class="container">
<div class="inner-container">

<div class="left-banner">
<p class="spn">The Car Shipping Experts</p>
<h1 class="head">Our Customer</h1>
<p class="textpara">Direct Express Auto Transport’s no personal information car shipping cost calculator has been the best since 2004.</p>
</div>

<div class="right-banner">
<img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/Image-from-iOS-2.jpg" alt="our customers" />
</div>

</div>
</div>
</div>
<div class="sec2">

</div>
</div>

<div id="customer_process" style="height:60px">&nbsp;</div>

<div class="smart-forms">

<div class="section fieldentry" style="margin: 50px 0 10px;">
<!--<div class="frm-row">
<div class="colm ipad colm12 ordersteps" style="text-align: center">
<img alt="Step 2 - Our Customer" data-src="/wp-content/uploads/2022/07/customer.png" class=" lazyloaded" src="/wp-content/uploads/2022/07/customer.png"><noscript><img src="/wp-content/uploads/2022/07/customer.png" alt="Step 2 - Our Customer" /></noscript>
</div>
</div>-->

	<div class="container">
	
		<div class="progressbar_inner">
		   	
			<div class="text_div_des active wi_div active"><span class="number">1</span><span class="title2 mar">Customer</span></div>
			
			<div class="line_bar line1 active"></div>
		    
			<div class="text_div_veh wi_div"><span class="number">2</span><span class="title2 mar big">Pickup</span></div>
			
			<div class="line_bar line2"></div>
		    
			<div class="text_div_dat wi_div"><span class="number">3</span><span class="title2">Delivery</span></div>
			
			<div class="line_bar line3"></div>
		    
			<div class="text_div_dat wi_div"><span class="number">4</span><span class="title2">Vehicle</span></div>
			
			<div class="line_bar line4"></div>
		    
			<div class="text_div_dat wi_div"><span class="number">5</span><span class="title2">Billing</span></div>
			
			<div class="line_bar line5"></div>
		    
			<div class="text_div_dat wi_div"><span class="number">6</span><span class="title2">Checkout</span></div>
		
		 </div>
		
	</div>

</div>

<!--<div class="back_btn">
    <button class="goonbutton" onclick="history.back()">&larr; Go Back</button>
</div>-->


 <!----input form------->
	
 	<div class="section fieldentry" id="step4_form">
 
 		<div class="container">
            
            <div class="inner_step4">
				
				
			    
				<div class="step4_right">	
				
				<div class="step4inner_grid">
				
                <div class="frm-group">
                   
                        <div class="formlabel">First Name</div>
                        <div class="field append-icon form_field">
                            <input type="text" name="strCustFirstName" id="strCustFirstName" size="30" value="<?php echo $first_name ?>" data-idealforms-rules="required">
                        </div>
       
                </div>

                <div class="frm-group">
                   
                         <div class="formlabel">Last Name</div>
                        <div class="field append-icon form_field">
                            <input type="text" name="strCustLastName" id="strCustLastName" size="30" value="<?php echo $last_name ?>"  data-idealforms-rules="required">
                        </div>
                 
                </div>
                
				<div class="frm-group">
                
                         <div class="formlabel">Company <span class="optional1">(optional)</span></div>
                         <div class="field append-icon form_field">
							<input type="text" name="strCustCompany" id="strCustCompany" size="30">
						 </div>
  
                </div>

                <div class="frm-group">
                               
                         <div class="formlabel">E-Mail Address</div>
                        <div class="field append-icon form_field">
                            <input type="email" name="strCustEmail" id="strCustEmail" size="30" value="<?php echo $customer_email ?>" required  data-idealforms-rules="required email">
                        </div>
                  
                </div>
                				
				</div>
								
				<!--<div class="frm-group">
                               
                        <div class="formlabel">
							<?php //if ($howmany != "onevehicle") { ?>
			                	Are these vehicles coming from a dealer, auto auction or Copart?
			                <?php //} else { ?>
			                	Is this vehicle coming from a dealer, auto auction or Copart?
			                <?php //} ?>
						</div>
                        <div class="field append-icon form_field">
                             <label class="option" style="display:inline;">
			    			    <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_yes" value="yes" onclick="$('#vehicle_comingfrom_spec').show();">
			                    <span class="radio"></span> Yes
			                </label>
			
			    			<label class="option" style="display:inline;">
			    			    <?php //if($howmany != "onevehicle") { ?>
			                    	<input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="comingfromno();">
			                    <?php //} else { ?>
			                    <input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="$('#vehicle_comingfrom_spec').hide();$('#vehicle_comingfrom_stocknum').hide();<?php //if($_COOKIE['admin']=="") { ?>$('#vehicle_comingfrom_vin').hide();<?php //} ?>$('#strVehicle_VIN').val('');$('#vehicle_comingfrom_buyernum').hide();$('#strVehicle_BuyerNum').val('');$('#vehicle_comingfrom_lotnum').hide();$('#strVehicle_LotNum').val('');$('#strVehicle_ComingFrom option')[0].selected = true;">
			                    <?php //} ?>
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
			                		if($('#strVehicle_ComingFrom').val()=='') {
			                
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
			                
			                		} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {
			                
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
			                
			                		} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {
			                
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
			                
			                
			                
			                		} else if ($('#strVehicle_ComingFrom').val()=='Copart') {
			                
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
			                		if($('#strVehicle_ComingFrom').val()=='') {
			                
			                			<?php if($_COOKIE['admin']=="") { ?>
			                			$('#vehicle_comingfrom_vin').hide();
			                			<?php } ?>

			                
			                			$('#strVehicle_VIN').val('');
			                
			                			$('#vehicle_comingfrom_buyernum').hide();
			                			$('#strVehicle_BuyerNum').val('');
			                			$('#vehicle_comingfrom_lotnum').hide();
			                			$('#strVehicle_LotNum').val('');
			                
			                		} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {
			                
			                			//Cleanup other fields

			                			$('#vehicle_comingfrom_buyernum').hide();
			                			$('#strVehicle_BuyerNum').val('');
			                			$('#vehicle_comingfrom_lotnum').hide();
			                			$('#strVehicle_LotNum').val('');
			                
			                			//Show VIN for Each Vehicle
			                			$('#vehicle_comingfrom_vin').show();
			                
			                		} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {
			                
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
			                
			                		} else if ($('#strVehicle_ComingFrom').val()=='Copart') {
			                
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
                  
                </div>-->
                				
				<div class="frm-group" id="vehicle_comingfrom_spec" style="display:none;">
                               
                         <div class="formlabel">
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
                               
                         <div class="formlabel">
						 		 Your buyer number:
						 </div>
                        <div class="field">
                            <input type="text" name="strVehicle_BuyerNum" id="strVehicle_BuyerNum" size="20" maxlength="99">
                            
                        </div>
                  
                </div>
				
				<div class="frm-group" id="vehicle_comingfrom_lotnum" style="display:none;">
                               
                         <div class="formlabel">
						 		 Your lot number:
						 </div>
                        <div class="field">
                             <input type="text" name="strVehicle_LotNum" id="strVehicle_LotNum" size="20" maxlength="99">
                              
                        </div>
                  
                </div>
				
				<div class="frm-group" id="vehicle_comingfrom_vin" style="display:none;">
                               
                         <div class="formlabel">
						 		LAST 6 digits of the Vehicle VIN:
						 </div>
                        <div class="field">
                             <input type="text" name="strVehicle_VIN" id="strVehicle_VIN" size="8" maxlength="6">
                             
                        </div>
                  
                </div>
				
				<div class="frm-group" id="vehicle_comingfrom_stocknum" style="display:none;">
                               
                         <div class="formlabel">
						 		Auto Auction Lot/Stock Number:
						 </div>
                        <div class="field">
                              <input type="text" name="strVehicle_StockNum" id="strVehicle_StockNum" size="8">
                        </div>
                  
                </div>
				
				<div class="frm-group">
                               
                         <div class="formlabel">
						 		Select My First Date Available To Ship
						 </div>
                        <div class="field">
                              <label class="field append-icon">
		                	<input type="text" id="strDateAvailable" name="strDateAvailable" placeholder="mm/dd/yyyy" readonly="readonly">
		                    <label for="strDateAvailable" class="field-icon"><i class="fa fa-calendar"></i></label>  
		                </label>
                        </div>
                  
                </div>
				
				<div class="frm-group">
				    
				    <h3 class="first_dateship">First Date Your Vehicle Is Available To Ship.</h3>
				    
					<ul class="vid_secul">
					   <li>You are selecting the first day your vehicle is available to ship. </li>
					   <li>The tier rate you selected (Standard, Expedited or Rush), may affect how fast you are assigned a carrier.</li>
					   <li>The route you selected is <?php echo number_format($totaldistance) ?> miles.</li>
					   <li>Once your vehicle is picked up, the carrier transit time is about 500 miles per day. Please think ahead about your shipping contacts that may help on either end.</li>
					   
					</ul>
				</div>
				
				<div class="step4_btn">
				<button type="submit" class="goonbutton">
                    Continue&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
                </button>
				</div>
			</div>
				
				
				<div class="step4-left">
				
					
						<div class="quotesummary1_custom">
				
							<div class="my_order">My Order Details <!--<span id="edit_icon"><a href="#">Edit Information</a></span>--></div>
							
							<div class="order_info_custom">
							
							<div class="block1"><span class="quotelabel1">Shipping From:</span>  
								<span class="block1_desc"><?php echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?></span>
							</div>
							
							<div class="block1"><span class="quotelabel1">Shipping To:</span> 
								<span class="block1_desc"><?php echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr  &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?></span>
							</div>
							
							
							<?php if ($howmany != "onevehicle") { ?>
							<div class="block1"><span class="quotelabel1">Types of Vehicle:</span>
							  
							  <span class="block1_desc">	
								<?php echo "$auto_make - $auto_model" ?><br>
								<?php if ($auto_make2 != "") { echo "$auto_make2 - $auto_model2<br/>"; } ?>
								<?php if ($auto_make3 != "") { echo "$auto_make3 - $auto_model3<br/>"; } ?>
								<?php if ($auto_make4 != "") { echo "$auto_make4 - $auto_model4<br/>"; } ?>
								<?php if ($auto_make5 != "") { echo "$auto_make5 - $auto_model5<br/>"; } ?>
							  </span>
								
							</div>	
							<?php } else { ?>
							<div class="block1"><span class="quotelabel1">Types of Vehicle:</span>
							  
							  <span class="block1_desc">
								<?php echo "$auto_make - $auto_model" ?>
							  </span>
							   
							</div>	
							<?php } ?>
							
							<div class="block1"><span class="quotelabel1">Operating Condition:</span>
								<span class="block1_desc">
								<?php echo $strQuote_vehicle_operational;  ?> and Rolls, Brakes, Steers
								</span>
							</div>
							
							<div class="block1"><span class="quotelabel1">Type of Trailer:</span>
							   <span class="block1_desc">
								<?php echo $strQuote_vehicle_trailer  ?>
								</span>
							 </div>
							 
							 <div class="block1"><span class="quotelabel1">Route Distance:</span>
							   <span class="block1_desc">
								<?php echo $totaldistance;  ?> Miles
								</span>
							 </div>
							 
							 <?php
								  $daysonroad = $totaldistance/500;
								  $daysonroad = ceil($daysonroad);
								  $daysonroadmax = $daysonroad + 2;  
							 ?>
							 
							 <div class="block1"><span class="quotelabel1">Typical Transit Time On The Road:</span>
							   <span class="block1_desc">
								<?php echo $daysonroad ?> to <?php echo $daysonroadmax ?> Days
								</span>
							 </div>
							 
							 <div class="block1"><span class="quotelabel1">Selected Tier:</span>
							   <span class="block1_desc">
								<?php echo $Selected_tier_name; ?>
								</span>
							 </div>
							 
			
						</div>
						
							<div class="order_info_form">
						
								<div class="frm-group">
							   
									<div class="formlabel">Shipping From</div>
									<div class="field append-icon form_field">
										<input type="text" name="shippingfromzipentry_edit" id="shippingfromzipentry_edit" value="<?php echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?>" data-idealforms-rules="required">
										<input type="hidden" name="shippingfromstateabbrentry_edit" id="shippingfromstateabbrentry_edit" value="<?php echo $strQuote_shippingfromstateabbr; ?>">
										<input type="hidden" name="editshippingfrom_state" id="shippingfromstateentry_edit" value="<?php echo $strQuote_shippingfromstate; ?>">
										<input type="hidden" name="editshippingfrom_city" id="shippingfromcityentry_edit" value="<?php echo $strQuote_shippingfromcity; ?>" >
										<input type="hidden" name="editshippingfrom2_zip" id="shippingfromzipentry2_edit" value="<?php echo $strQuote_shippingfromzip; ?>" >
									</div>
				   
								</div>
								
								<div class="frm-group">
							   
									<div class="formlabel">Shipping To</div>
									<div class="field append-icon form_field">
										<input type="text" name="shippingtozipentry_edit" id="shippingtozipentry_edit" value="<?php echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr  &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?>" data-idealforms-rules="required">
										
										<input type="hidden" name="shippingtostateabbrentry_edit" id="shippingtostateabbrentry_edit" value="<?php echo $strQuote_shippingtostateabbr; ?>">
										<input type="hidden" name="editshippingto_state" id="editshippingto_state" value="<?php echo $strQuote_shippingtostate; ?>">
										<input type="hidden" name="editshippingto_city" id="editshippingto_city" value="<?php echo $strQuote_shippingtocity; ?>" >
										<input type="hidden" name="editshippingto_zip" id="editshippingto_zip" value="<?php echo $strQuote_shippingtozip; ?>" >
									</div>
				   
								</div>
								
								<div class="frm-group">
							   
									<div class="formlabel">Transport Carrier Type</div>
									<div class="field append-icon form_field">
										<div class="">
										<select name="vehicle_trailer_edit" id="vehicle_trailer_edit" class="select">
													<option value="Open Transport">Open Transport</option>
													<option vlaue="Enclosed Transport">Enclosed Transport</option>
												</select><i class="arrow"></i>
									</div>
								  </div>
								</div>
								
								<div class="frm-group">
							   
									<div class="formlabel">Types of Vehicle</div>
									<div class="field append-icon form_field">
										<input type="text" name="vehicle_type_edit" id="vehicle_type_edit" value="<?php echo "$auto_make - $auto_model" ?>" data-idealforms-rules="required">
									</div>
				   
								</div>
								
								<div class="frm-group">
							   
									<div class="formlabel">Operating Condition</div>
									<div class="field append-icon form_field">
										<div class="">
											<label class="field select">
												<select name="auto_model_operation_edit" id="auto_model_operation_edit" class="select">
													<option value="<?php echo $strQuote_vehicle_operational;  ?>"><?php echo $strQuote_vehicle_operational;  ?></option>
													<option value="Non-Running Condition">Non-Running Condition</option>
												</select><i class="arrow"></i>
											</label>
										</div>
									</div>
				   
								</div>
								
								<div class="frm-group">
							   
									<div class="formlabel">Selected Tier</div>
									<div class="field append-icon form_field">
										<div class="">
											<label class="field select">
												<select name="auto_model_edit" id="auto_model_edit" class="select">
													<option value="Standard Rate" ><?php echo $Selected_tier_name; ?></option>
													<option value="Expedited Rate">Expedited Rate</option>
													<option value="Rush Rate">Rush Rate</option>
												</select><i class="arrow"></i>
											</label>
										</div>
									</div>
				   
								</div>
								
								<button type="submit" class="goonbutton" id="saveourcusotmers">
									Save Informations <i class="fa fa-arrow-right"></i>
								</button>				
						
							</div>
							
							
							<!-----zipcode api------>
							<script type="text/javascript">
							
							//save edit information
							$(document).ready(function() {
							
								$('#saveourcusotmers').click(function() {
									
									var edit_shippingfrom_state = jQuery("#shippingfromstateentry_edit").val();
									jQuery("#shippingfromstate").val(edit_shippingfrom_state);
									
									var edit_shippingfrom_city = jQuery("#shippingfromcityentry_edit").val();
									jQuery("#shippingfromcity").val(edit_shippingfrom_city);
									
									var edit_shippingfrom_zip = jQuery("#shippingfromzipentry2_edit").val();
									jQuery("#shippingfromzip").val(edit_shippingfrom_zip);
									
									
									
									var edit_shippingto_state = jQuery("#editshippingto_state").val();
									jQuery("#shippingtostate").val(edit_shippingto_state);
									
									var edit_shippingto_city = jQuery("#editshippingto_city").val();
									jQuery("#shippingtocity").val(edit_shippingto_city);
									
									var edit_shippingto_zip = jQuery("#editshippingto_zip").val();
									jQuery("#shippingtozip").val(edit_shippingto_zip);
									
								});
							});
							
							
							
							// api call for edit fields
							
									$(document).ready(function() {
									
									
										var optionsfrom = {
											url: function(zipcode) {
												return "https://api.autotransportdirect.com/zipcode/?zipcode=" + zipcode;
											},
											getValue: "zipcode",
									
											list: {
												maxNumberOfElements: 10,
												match: {
													enabled: true
												},
									
												onSelectItemEvent: function() {
													var zipcode = $("#shippingfromzipentry_edit").getSelectedItemData().zipcode;
													//console.log("Shipping zip= " + zipcode);
													$("#shippingfromzipentry2_edit").val(zipcode);
													
													var city = $("#shippingfromzipentry_edit").getSelectedItemData().city;
													$("#shippingfromcityentry_edit").val(city);
													
													var state = $("#shippingfromzipentry_edit").getSelectedItemData().state;
													//$("#shippingfromstateentry_edit").val(state);
													$("#shippingfromstateabbrentry_edit").val(state);
													

													
													$("#shippingfromzipentry_edit").val(zipcode + ' (' + city + ', ' + state + ')').trigger("change");
										
													$("#shippingfromzip").val(zipcode).trigger("change");
													$("#shippingfromcity").val(city).trigger("change");
													$("#shippingfromstate").val(state).trigger("change");
												}
											},
											
											highlightPhrase: false,
											minCharNumber: 5,
											template: {
												type: "custom",
												method: function(value, item) {
													return item.zipcode + ' (' + item.city + ', ' + item.state + ')';
												}
											}
										};
										
										var optionsto = {
											url: function(zipcode) {
												return "https://api.autotransportdirect.com/zipcode/?zipcode=" + zipcode;
											},
											getValue: "zipcode",
									
											list: {
												maxNumberOfElements: 10,
												match: {
													enabled: true
												},
												
												onSelectItemEvent: function() {
													var zipcode = $("#shippingtozipentry_edit").getSelectedItemData().zipcode;
													$("#editshippingto_zip").val(zipcode);
													
													var city = $("#shippingtozipentry_edit").getSelectedItemData().city;
													$("#editshippingto_city").val(city);
													
													var state = $("#shippingtozipentry_edit").getSelectedItemData().state;
													//$("#editshippingto_state").val(state);
													$("#shippingtostateabbrentry_edit").val(state);
													
													$("#shippingtozipentry_edit").val(zipcode + ' (' + city + ', ' + state + ')').trigger("change");
													
													$("#shippingtozip").val(zipcode).trigger("change");
													$("#shippingtocity").val(city).trigger("change");
													$("#shippingtostate").val(state).trigger("change");
												}
											},
											
											highlightPhrase: false,
											minCharNumber: 5,
											template: {
												type: "custom",
												method: function(value, item) {
													return item.zipcode + ' (' + item.city + ', ' + item.state + ')';
												}
											}
											
										};
										
									
										$("#shippingfromzipentry_edit").easyAutocomplete(optionsfrom);	
										$("#shippingtozipentry_edit").easyAutocomplete(optionsto);
									
										$(document).ready(function() {
											$("#shippingfromzipentry_edit,#shippingtozipentry_edit").keydown(function (e) {
												// Allow: backspace, delete, tab, escape, enter and .
												if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
													 // Allow: Ctrl/cmd+A
													(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
													 // Allow: Ctrl/cmd+C
													(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
													 // Allow: Ctrl/cmd+X
													(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
													 // Allow: home, end, left, right
													(e.keyCode >= 35 && e.keyCode <= 39)) {
														 // let it happen, don't do anything
														 return;
												}
												// Ensure that it is a number and stop the keypress
												if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
													e.preventDefault()
												}
											});
										});
										
									});
							</script>
						</div>
					
					
				
				</div>
			
				
			  </div>
			    
           </div>
		
	</div>


    <!--<div class="section fieldentry" style="margin: 50px 0 50px;">
        <div class="frm-row">
            <div class="colm colm12 ordersteps" style="text-align: center">
                <img src="/wp-content/themes/atdv2/images/checkout-prog-2.png" alt="Step 2 - Customer" />

            </div>
        </div>
    </div>-->

   <!----hidden section---->
    <div class="section fieldentry">
        <div class="frm-row">
          <!--  <div class="colm colm3">
                <div class="imagebox">
            		<img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" />
            		<div>We make it easy to setup your shipment and get on the road ... door to door.</div>
            	</div>
            </div>
            <div class="colm colm3 quotesummary1">
	            <p><span class="quotelabel1">From</span>
                <?php //echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?></p>
                
                <p><span class="quotelabel1">To</span>
                <?php //echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr  &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?></p>
                
                
                <?php //if ($howmany != "onevehicle") { ?>
                <p><span class="quotelabel1">Vehicles</span>
                	<?php //echo "$auto_make - $auto_model" ?><br>
                	<?php //if ($auto_make2 != "") { echo "$auto_make2 - $auto_model2<br/>"; } ?>
                	<?php //if ($auto_make3 != "") { echo "$auto_make3 - $auto_model3<br/>"; } ?>
                	<?php //if ($auto_make4 != "") { echo "$auto_make4 - $auto_model4<br/>"; } ?>
                	<?php //if ($auto_make5 != "") { echo "$auto_make5 - $auto_model5<br/>"; } ?>
				<?php //} else { ?>
				<p><span class="quotelabel1">Vehicle</span>

                    <?php //echo "$auto_make - $auto_model" ?>
				<?php //} ?></p>
				
				<p><span class="quotelabel1">Condition</span>
				<?php //echo $strQuote_vehicle_operational  ?> and Rolls, Brakes, Steers</p>
				
				<p><span class="quotelabel1">Trailer</span>
				<?php //echo $strQuote_vehicle_trailer  ?></p>


            </div>-->
			
			
            <!--<div class="topbanner_sec">
	            <div class="quotelistbox1"><br>
		            <div class="quotelistboxicon"><i class="ticon ticon-thumbs-o-up" aria-hidden="true"></i></div>
		            <ul class="quotelist1" style="font-size: 15px;">
		            	<li>Total Door-to-Door <?php //echo $pricetiername ?> Price:<br>$<?php //echo $strTotalPrice ?></li>
			            <li>A Partial Credit Card Payment After Your Scheduled Pickup</li>
			            <li>Balance Paid To The Carrier With Money Order or Cash Upon Delivery</li>
			            <li>There are no taxes or hidden fees</li>
			            <li>Insurance Up To 150,000 USD Included</li>
		            </ul>
	            </div>
	            
            </div>-->

			
			
        </div>  
    </div> 
	
	<!----top row---->
	
	<!--<div class="step4_left">	
	
		<div class="container">	
		
			<div class="inner_step4_left">
					
			<div class="top_image">
                	
					<div class="imagebox2"><img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/Image-from-iOS-2.jpg" /></div>
            		
					<div class="imagecaption">We make it easy to setup your shipment and get on the road ... door to door.</div>
            	
            	</div>
            	
			<div class="quotesummary1_custom">
				
	            <div class="block1"><span class="quotelabel1">From</span>  
					<span class="block1_desc"><?php //echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?></span>
				</div>
                
                <div class="block1"><span class="quotelabel1">To</span> 
					<span class="block1_desc"><?php //echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr  &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?></span>
				</div>
                
                
                <?php //if ($howmany != "onevehicle") { ?>
                <div class="block1"><span class="quotelabel1">Vehicles</span>
                  
				  <span class="block1_desc">	
					<?php //echo "$auto_make - $auto_model" ?><br>
                	<?php //if ($auto_make2 != "") { echo "$auto_make2 - $auto_model2<br/>"; } ?>
                	<?php //if ($auto_make3 != "") { echo "$auto_make3 - $auto_model3<br/>"; } ?>
                	<?php //if ($auto_make4 != "") { echo "$auto_make4 - $auto_model4<br/>"; } ?>
                	<?php //if ($auto_make5 != "") { echo "$auto_make5 - $auto_model5<br/>"; } ?>
				  </span>
				   	
				</div>	
				<?php //} else { ?>
				<div class="block1"><span class="quotelabel1">Vehicle</span>
				  
				  <span class="block1_desc">
                    <?php //echo "$auto_make - $auto_model" ?>
				  </span>
				   
				</div>	
				<?php //} ?>
				
				<div class="block1"><span class="quotelabel1">Condition</span>
					<span class="block1_desc">
					<?php //echo $strQuote_vehicle_operational  ?> and Rolls, Brakes, Steers
					</span>
				</div>
				
				<div class="block1"><span class="quotelabel1">Trailer</span>
				   <span class="block1_desc">
					<?php //echo $strQuote_vehicle_trailer  ?>
					</span>
                 </div>

            </div>
		
			</div>
			
		</div>
					
	</div>-->

   
 

    

</form>
</div>


<div class="bottom_sec_main">
	
	<div class="bottom_sec">
	
		<div class="bottom_sec_inner">
		
			<div class="colm colm12">
			
			
			
				<style>.embed-container { border:1px solid #ccc; position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
				
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


<!-----bottom logos------>

<div class="frm-row" style="margin: 65px 0 50px;">
	
	<div class="logos-sectio">

		<h2>People Love Direct Express Auto Transport</h2>
		
		<div class="custom_bord"></div>
		
		<div class="logos_inner">
			
			<div class="log">
				<img alt="" data-src="/wp-content/upseleloads/2022/07/download.png" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/2022/07/download.png">
			</div>
			
			<div class="log">
				<img alt="" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/2022/07/5-star-google-reviews-google-review-5-stars-11563138345tqaiumovcm.png">
			</div>
			
			<div class="log">
				<img alt="" data-src="/wp-content/uploads/2022/07/trustpilot-energy-reviews.png" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/2022/07/trustpilot-energy-reviews.png">
			</div>
			
		</div>
	
	</div>
	
	<div class="logos_bottom">
		Direct Express Auto Transport is the highest rated and most reliable car shipper! Going strong since 2004.
	</div>

					    
</div>


</div>
</div>
