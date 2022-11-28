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

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$page_step_wb = explode("step=",$actual_link);
$_SESSION["wb_step_no"] = $page_step_wb[1];
$_SESSION["wb_step_1"] = $strtotalprice1;
$_SESSION["wb_step_2"] = $strtotalprice1_exp;
$_SESSION["wb_step_3"] = $strtotalprice1_rush;
//echo 'Selected Tier Price => '.$Selected_tier_price.'</br>';
$_SESSION["wb_selected_tier_value"] = $Selected_tier_price;
$_SESSION["wb_selected_tier_name"] = $Selected_tier_name;

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
    @import url('https://fonts.googleapis.com/css?family=Poppins');
    body{
        font-family: "Poppins";
    }
    .order_info_form .frm-group{
        margin-bottom: 10px;
    }
    .easy-autocomplete{
        width:100% !important;
    }
    .my_order #edit_icon {
        float: right;
        display: inline;
        margin-top: -3px;
    }
    .my_order #edit_icon a{
        font-size: 13px;
        display: inline;
        color: #107410;
    }
    .order_info_form{
        display:none;
    }
    .back_btn{
        text-align:center;
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

    background-color: #0057b1;

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
    
    /***************progress bar************/
    .progressbar_inner{
        display: flex;
        justify-content: space-between;
        /*width: 80%;*/
        margin: 0 auto;
    }

   .progressbar_inner span.number{
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

    .progressbar_inner span.title2{
        display: block;
        color: #283337;
        font-size: 16px;
        font-weight: 500;
        margin-left: -45px;
        width: 150px;
        text-align: center;
    }

    .progressbar_inner .wi_div{
        width:50px;
    }

    .progressbar_inner .wi_div.active .number{
        background-color: #0057b1;
    }

    /************************************/

    .ordersteps img {
        max-width: 720px!important;
    }
    .my_order{
        font-weight: 700;
        color: #333;
        /* line-height: 66px; */
        margin-bottom: 20px;
    }

    .step4inner_grid{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 30px;
    }

    .inner_step4_left{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 60px;
    }
    

    .first_dateship{
        padding-top: 50px;
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 7px !important;
    }
    .inner-container{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 40px;
    }

    .right-banner{
        text-align: center;
    }

    .right-banner img{
        width: 75%;
        border-radius: 20px;
    }

    .ui-dialog-titlebar-close{
        display: none;
    }

    .sec1{
        width: 100%;
        background-color: #f1f1f1;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .sec1 .display{
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



    .spn{
        font-size: 12px;
        letter-spacing: 3px;
        font-weight: 700;
        color: #333;
        margin: 20px 0 10px;
    }



    .head{
        font-size: 3.5vw;
        font-weight: 300;
        color: #333;
        line-height: 66px;
        margin: 0px;
    }

    .textpara{
        font-size: 18px;
        color: #333;
        font-weight: 400;
        margin-top: 20px;
        line-height: 28px;
        letter-spacing: normal;
        margin: 20px 0px 0px 0px;
    }

    .but{
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

    .but:hover{
        color: #0b9519;
        text-decoration: none;
        background-color: #fff;
        transition: inherit;
    }

    .logos-sectio{
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .logos-sectio .logos_inner{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 40px;
        align-items: center;
        width: 60%;
        margin: 55px auto 30px auto;
    }

    .logos-sectio .logos_inner .log{
        text-align: center;
    }

    .logos-sectio .logos_inner .log img{
        width: 55%;
    }    

    .logos-sectio h2{
        text-align: center;
        color: #283337;
        font-size: 42px;
        font-weight: 500;
        line-height: 45px;
        margin-bottom: 0px !important;
        padding-bottom: 0px;
    }

    .custom_bord{
        border-radius: 1rem;
        width: 15rem;
        height: 2px;
        background-color: #0057b1;
        margin: 20px auto 30px auto;
    }

    .logos_bottom{
        color: #283337;
        font-size: 18px;
        font-weight: 300;
        line-height: 45px;
        text-align: center;
        margin-bottom: 50px;
    }

    .bottom_sec_main{
        background-color: #f1f1f1;     
        padding-top: 40px;
        padding-bottom: 30px;
        margin-top: 35px;
    }

    

    .bottom_sec{
        width: 50%;
        margin: 20px auto;
    }

    .bottom_sec_inner{
        display: grid;
        /*grid-template-columns: 1fr 1fr;*/
        grid-column-gap: 50px;
    }

    .vid_sec{
        font-size: 20px;
        margin-top: 0px;
        margin-bottom: 14px;
    }

    ul.vid_secul{
        padding: 0px;
        margin-left: 20px;
    }

    .vid_secul li{
        font-size: 15px;
        margin-bottom: 2px;
    }  

    #step4_form{
        margin-top: 50px !important;
        margin-bottom: 50px;
        background-repeat: no-repeat;
        background-size: contain;
        object-fit: cover;
        background-position: right;
        padding-bottom: 40px;
    }

    .inner_step4{
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-column-gap: 40px;
        margin: 20px auto;
    }

    .step4_right{
        height: max-content;
        background-color: #fff;
        padding: 40px !important;
        border-radius: 20px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        border-top: 5px solid #107410;
    }

    .step4_right .frm-group{
        margin-bottom: 15px;
    }
    .card-container{
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }

    .goonbutton{
        color: #fff !important;
        background-color: #0062cc;
        border: 2px solid #014793;
        font-size: 14px;
        border-radius: 50px;
        letter-spacing: .5px;
        width: auto !important;
        text-transform: uppercase;
        font-weight: bold;
        padding: 11px 40px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        margin-top: 20px !important;
    }

    .goonbutton:hover{
        background-color: #e6a300;
        border: 2px solid #af7c01;
    }

    .frm-group .formlabel{
        font-size: 15px; 
        font-weight: bold;
        margin-bottom: 5px;
    }

    
    .imagebox2 img{
        border-radius: 20px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        width: 100%;
        object-fit: contain;
    }


    .imagecaption{
        font-size: 16px;
        margin-bottom: 15px;
        color: #333;
    }

    

    .quotelabel1{
        font-size: 16px;
        display: inline;
        color: #444;
        font-weight: 400;
    }

    .block1{
        color: #333;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .block1_desc{
        padding: 3px;
        line-height: 26px;
        font-weight: bold;
        text-align: right;
        font-size: 16px;
    }

    .smart-forms{
        background-color: #fff !important;
    }
    

    @media(max-width:767px){
        .progressbar_inner{
            width: 95%;
        }
        .progressbar_inner span.title2{
            margin-left: -3px;
        }
    }

    @media(max-width:480px){
        .progressbar_inner{
            width: 98%;
        }
        .progressbar_inner span.title2{
            margin-left: -3px;
            font-size:14px;
        }
        .step4inner_grid {
            grid-template-columns: 1fr;
        }
        .step4_right .frm-group{
            margin-bottom: 6px;
        }
    }
	.rout_txt
	{
		font-weight:bold !important;
	}
</style>


<form action="?step=3#pickup_delivery" method="post" name="mainform" id="mainform">
    <input type="hidden" name="strQuote_shippingfromstateabbr" id="shippingfromstateabbr" value="<?php echo $strQuote_shippingfromstateabbr ?>">
    <input type="hidden" name="strQuote_shippingtostateabbr" id="shippingtostateabbr" value="<?php echo $strQuote_shippingtostateabbr ?>">
    <input type="hidden" name="strQuote_shippingfromstate" id="shippingfromstate" value="<?php echo $strQuote_shippingfromstate ?>">
    <input type="hidden" name="strQuote_shippingtostate" id="shippingtostate" value="<?php echo $strQuote_shippingtostate ?>">
    <input type="hidden" name="strQuote_shippingfromzip" id="shippingfromzip" value="<?php echo $strQuote_shippingfromzip ?>">
    <input type="hidden" name="strQuote_shippingtozip" id="shippingtozip" value="<?php echo $strQuote_shippingtozip ?>">
    <input type="hidden" name="strQuote_shippingfromcity" id="shippingfromcity" value="<?php echo $strQuote_shippingfromcity ?>">
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
    <div class="smart-forms">
        <!----input form------->
        <div>
            <div>
                <div>
                    <div class="step4-left">
                        <div class="quotesummary1_custom">
                            <div class="card-container">
                                <div class="my_order">
                                    <h2>Shipping Details</h2>
                                </div>
                                <div class="order_info_custom">
                                    <div class="frm-row block1">
                                        <div class="colm colm6">
                                            <div class="quotelabel1">Transport Carrier Type:</div>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                <?php echo $strQuote_vehicle_trailer  ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row block1">
                                        <div class="colm colm6">
                                            <div class="quotelabel1">Shipping From:</div>
                                        </div>
                                            <div class="block1_desc colm colm6">
                                                <?php echo "$strQuote_shippingfromcity, $strQuote_shippingfromstateabbr $strQuote_shippingfromzip" ?></div>
                                    </div>
                                    <div class="frm-row block1">
                                        <div class="colm colm6">
                                            <span class="quotelabel1">Shipping To:</span>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                <strong>
                                                    <?php echo "$strQuote_shippingtocity, $strQuote_shippingtostateabbr $strQuote_shippingtozip" ?>
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row block1">
                                        <div class="colm colm6">
                                            <div class="quotelabel1 rout_txt">Route Distance:</div>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                <?php echo $totaldistance;  ?> Miles
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                      $daysonroad = $totaldistance/500;
                                      $daysonroad = ceil($daysonroad);
                                      $daysonroadmax = $daysonroad + 2;  
                                    ?>
                                    <div class="frm-row block1">
                                        <div class="colm colm6">
                                            <div class="quotelabel1 rout_txt">Usual Transit Time:</div>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                <?php echo $daysonroad ?> to
                                                <?php echo $daysonroadmax ?> Days
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm6">
                                            <div class="quotelabel1">
                                                Insurance Up to $100K
                                            </div>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                Included
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm6">
                                            <div class="quotelabel1">
                                                Service Type
                                            </div>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                Door-to-door
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-row">
                                        <div class="colm colm6">
                                            <div class="quotelabel1">
                                                Taxes
                                            </div>
                                        </div>
                                        <div class="colm colm6">
                                            <div class="block1_desc">
                                                None
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="my_order">
                                    <h2>Vehicle Details</h2>
                                </div>
                                <?php if ($howmany != "onevehicle") { ?>
                                <div class="frm-row block1">
                                    <div class="colm colm6">
                                        <div class="quotelabel1">Types of Vehicle:</div>
                                    </div>
                                    <div class="colm colm6">
                                        <div class="block1_desc">
                                            <?php echo "$auto_make - $auto_model" ?><br>
                                            <?php if ($auto_make2 != "") { echo "$auto_make2 - $auto_model2<br/>"; } ?>
                                            <?php if ($auto_make3 != "") { echo "$auto_make3 - $auto_model3<br/>"; } ?>
                                            <?php if ($auto_make4 != "") { echo "$auto_make4 - $auto_model4<br/>"; } ?>
                                            <?php if ($auto_make5 != "") { echo "$auto_make5 - $auto_model5<br/>"; } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="frm-row block1">
                                    <div class="colm colm6">
                                        <div class="quotelabel1">Types of Vehicle:</div>
                                    </div>
                                    <div class="colm colm6">
                                        <div class="block1_desc">
                                            <?php echo "$auto_make - $auto_model" ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="frm-row block1">
                                    <div class="colm colm6">
                                        <div class="quotelabel1">Vehicle Condition:</div>
                                    </div>
                                    <div class="colm colm6">
                                        <div class="block1_desc">
                                            <?php echo $strQuote_vehicle_operational;  ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="frm-row block1">
                                    <span class="quotelabel1">Selected Tier:</span>
                                    <span class="block1_desc">
                                        <?php echo $Selected_tier_name; ?>
                                    </span>
                                </div> -->
                            </div>
                            <div class="card-container">
                                <div class="frm-row">
                                    <div class="colm colm6">
                                        <div class="my_order">
                                            <h2>Pay Now</h2>
                                        </div>
                                    </div>
                                    <div class="colm colm6 block1_desc">
                                        <div class="upfront-cost">
                                            $0
                                        </div>
                                    </div>
                                </div>
                                <div class="frm-row">
                                    <div class="colm colm6">
                                        <div class="quotelabel1">
                                           <?php echo $_SESSION["wb_selected_tier_name"]; ?>
                                        </div>
                                    </div>
                                    <div class="colm colm6">
                                        <div class="block1_desc">											
                                            <?php
											//$pricetier.' -- '. $pricetiername
											echo '$'.$_SESSION["wb_selected_tier_value"]; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order_info_form">
                            <div class="frm-group">
                                <div class="formlabel">Shipping From</div>
                                <div class="field append-icon form_field">
                                    <input type="text" name="shippingfromzipentry_edit" id="shippingfromzipentry_edit" value="<?php echo " $strQuote_shippingfromcity, $strQuote_shippingfromstateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingfromzip" ?>" data-idealforms-rules="required">
                                    <input type="hidden" name="shippingfromstateabbrentry_edit" id="shippingfromstateabbrentry_edit" value="<?php echo $strQuote_shippingfromstateabbr; ?>">
                                    <input type="hidden" name="editshippingfrom_state" id="shippingfromstateentry_edit" value="<?php echo $strQuote_shippingfromstate; ?>">
                                    <input type="hidden" name="editshippingfrom_city" id="shippingfromcityentry_edit" value="<?php echo $strQuote_shippingfromcity; ?>">
                                    <input type="hidden" name="editshippingfrom2_zip" id="shippingfromzipentry2_edit" value="<?php echo $strQuote_shippingfromzip; ?>">
                                </div>
                            </div>
                            <div class="frm-group">
                                <div class="formlabel">Shipping To</div>
                                <div class="field append-icon form_field">
                                    <input type="text" name="shippingtozipentry_edit" id="shippingtozipentry_edit" value="<?php echo " $strQuote_shippingtocity, $strQuote_shippingtostateabbr &nbsp;&nbsp;&nbsp; $strQuote_shippingtozip" ?>" data-idealforms-rules="required">
                                    <input type="hidden" name="shippingtostateabbrentry_edit" id="shippingtostateabbrentry_edit" value="<?php echo $strQuote_shippingtostateabbr; ?>">
                                    <input type="hidden" name="editshippingto_state" id="editshippingto_state" value="<?php echo $strQuote_shippingtostate; ?>">
                                    <input type="hidden" name="editshippingto_city" id="editshippingto_city" value="<?php echo $strQuote_shippingtocity; ?>">
                                    <input type="hidden" name="editshippingto_zip" id="editshippingto_zip" value="<?php echo $strQuote_shippingtozip; ?>">
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
                                    <input type="text" name="vehicle_type_edit" id="vehicle_type_edit" value="<?php echo " $auto_make - $auto_model" ?>" data-idealforms-rules="required">
                                </div>
                            </div>
                            <div class="frm-group">
                                <div class="formlabel">Operating Condition</div>
                                <div class="field append-icon form_field">
                                    <div class="">
                                        <label class="field select">
                                            <select name="auto_model_operation_edit" id="auto_model_operation_edit" class="select">
                                                <option value="<?php echo $strQuote_vehicle_operational;  ?>">
                                                    <?php echo $strQuote_vehicle_operational;  ?>
                                                </option>
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
                                                <option value="Standard Rate">
                                                    <?php echo $Selected_tier_name; ?>
                                                </option>
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>


</div>
</div>