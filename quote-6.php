<?php
$CurrentUsername = $_COOKIE['rep'];

$orderid = postdb('strOrderID');
$pricetier = postdb('pricetier');
$tiermessage = postdb('tiermessage');
$pricetiername = postdb('tiername');
$howmany = postdb('howmany');
$numvehicles = postdb('numvehicles');
$depositpervehicle = postdb('depositpervehicle');
$carrierdiscount = postdb('carrierdiscount');

$auto_price1 = postdb('auto_price1');
$auto_price2 = postdb('auto_price2');
$auto_price3 = postdb('auto_price3');
$auto_price4 = postdb('auto_price4');
$auto_price5 = postdb('auto_price5');


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


$strVehicle_Year = postdb('strVehicle_Year');
$strVehicle_Make = postdb('strVehicle_Make');
$strVehicle_Model = postdb('strVehicle_Model');
$strVehicle_Color = postdb('strVehicle_Color');
$strVehicle_Convertible = postdb('strVehicle_Convertible');
$strVehicle_LiftKit = postdb('strVehicle_LiftKit');
$strVehicle_Lowered = postdb('strVehicle_Lowered');
$strVehicle_Oversized_Tires = postdb('strVehicle_Oversized_Tires');
$strVehicle_AdditionalInfo = postdb('strVehicle_AdditionalInfo');
$strVehicle_VIN = postdb('strVehicle_VIN');
$strVehicle_StockNum = postdb('strVehicle_StockNum');

$strVehicle_Year1 = postdb('strVehicle_Year1');
$strVehicle_Make1 = postdb('strVehicle_Make1');
$strVehicle_Model1 = postdb('strVehicle_Model1');
$strVehicle_Color1 = postdb('strVehicle_Color1');
$strVehicle_Convertible1 = postdb('strVehicle_Convertible1');
$strVehicle_LiftKit1 = postdb('strVehicle_LiftKit1');
$strVehicle_Lowered1 = postdb('strVehicle_Lowered1');
$strVehicle_Oversized_Tires1 = postdb('strVehicle_Oversized_Tires1');
$strVehicle_AdditionalInfo1 = postdb('strVehicle_AdditionalInfo1');
$strVehicle_VIN1 = postdb('strVehicle_VIN1');
$strVehicle_StockNum1 = postdb('strVehicle_StockNum1');

$strVehicle_Year2 = postdb('strVehicle_Year2');
$strVehicle_Make2 = postdb('strVehicle_Make2');
$strVehicle_Model2 = postdb('strVehicle_Model2');
$strVehicle_Color2 = postdb('strVehicle_Color2');
$strVehicle_Convertible2 = postdb('strVehicle_Convertible2');
$strVehicle_LiftKit2 = postdb('strVehicle_LiftKit2');
$strVehicle_Lowered2 = postdb('strVehicle_Lowered2');
$strVehicle_Oversized_Tires2 = postdb('strVehicle_Oversized_Tires2');
$strVehicle_AdditionalInfo2 = postdb('strVehicle_AdditionalInfo2');
$strVehicle_VIN2 = postdb('strVehicle_VIN2');
$strVehicle_StockNum2 = postdb('strVehicle_StockNum2');

$strVehicle_Year3 = postdb('strVehicle_Year3');
$strVehicle_Make3 = postdb('strVehicle_Make3');
$strVehicle_Model3 = postdb('strVehicle_Model3');
$strVehicle_Color3 = postdb('strVehicle_Color3');
$strVehicle_Convertible3 = postdb('strVehicle_Convertible3');
$strVehicle_LiftKit3 = postdb('strVehicle_LiftKit3');
$strVehicle_Lowered3 = postdb('strVehicle_Lowered3');
$strVehicle_Oversized_Tires3 = postdb('strVehicle_Oversized_Tires3');
$strVehicle_AdditionalInfo3 = postdb('strVehicle_AdditionalInfo3');
$strVehicle_VIN3 = postdb('strVehicle_VIN3');
$strVehicle_StockNum3 = postdb('strVehicle_StockNum3');

$strVehicle_Year4 = postdb('strVehicle_Year4');
$strVehicle_Make4 = postdb('strVehicle_Make4');
$strVehicle_Model4 = postdb('strVehicle_Model4');
$strVehicle_Color4 = postdb('strVehicle_Color4');
$strVehicle_Convertible4 = postdb('strVehicle_Convertible4');
$strVehicle_LiftKit4 = postdb('strVehicle_LiftKit4');
$strVehicle_Lowered4 = postdb('strVehicle_Lowered4');
$strVehicle_Oversized_Tires4 = postdb('strVehicle_Oversized_Tires4');
$strVehicle_AdditionalInfo4 = postdb('strVehicle_AdditionalInfo4');
$strVehicle_VIN4 = postdb('strVehicle_VIN4');
$strVehicle_StockNum4 = postdb('strVehicle_StockNum4');

$strVehicle_Year5 = postdb('strVehicle_Year5');
$strVehicle_Make5 = postdb('strVehicle_Make5');
$strVehicle_Model5 = postdb('strVehicle_Model5');
$strVehicle_Color5 = postdb('strVehicle_Color5');
$strVehicle_Convertible5 = postdb('strVehicle_Convertible5');
$strVehicle_LiftKit5 = postdb('strVehicle_LiftKit5');
$strVehicle_Lowered5 = postdb('strVehicle_Lowered5');
$strVehicle_Oversized_Tires5 = postdb('strVehicle_Oversized_Tires5');
$strVehicle_AdditionalInfo5 = postdb('strVehicle_AdditionalInfo5');
$strVehicle_VIN5 = postdb('strVehicle_VIN5');
$strVehicle_StockNum5 = postdb('strVehicle_StockNum5');

$strTotalPrice = postdb('strTotalPrice');
$strDeposit = postdb('strDeposit');

$Pickup_Contact = postdb('strPickup_Contact');
$Pickup_Company = postdb('strPickup_Company');
$Pickup_Address1 = postdb('strPickup_Address1');
$Pickup_City = postdb('strPickup_City');
$Pickup_NearCity = postdb('strPickup_NearCity');
$Pickup_State = postdb('strPickup_State');
$Pickup_Zip = postdb('strPickup_Zip');
$Pickup_Location_Type = postdb('strPickup_Location_Type');
$Pickup_Location_Hours = postdb('strPickup_Location_Hours');
$Pickup_Phone1 = postdb('strPickup_Phone1');
$Pickup_Phone1Type = postdb('strPickup_Phone1Type');
$Pickup_Phone2 = postdb('strPickup_Phone2');
$Pickup_Phone2Type = postdb('strPickup_Phone2Type');
$Pickup_Phone3 = postdb('strPickup_Phone3');
$Pickup_Phone3Type = postdb('strPickup_Phone3Type');
$Pickup_ExtraInst = postdb('strPickup_ExtraInst');
$Pickup_ExtraInst_send = postdb('strPickup_ExtraInst_send');
$Pickup_BackupContact = postdb('strPickup_BackupContact');
$Pickup_BackupName = postdb('strPickup_BackupName');
$Pickup_BackupPhone = postdb('strPickup_BackupPhone');
$Pickup_BackupPhoneType = postdb('strPickup_BackupPhoneType');


$Deliver_Contact = postdb('strDeliver_Contact');
$Deliver_Company = postdb('strDeliver_Company');
$Deliver_Address1 = postdb('strDeliver_Address1');
$Deliver_City = postdb('strDeliver_City');
$Deliver_NearCity = postdb('strDeliver_NearCity');
$Deliver_State = postdb('strDeliver_State');
$Deliver_Zip = postdb('strDeliver_Zip');
$Deliver_Location_Type = postdb('strDeliver_Location_Type');
$Deliver_Location_Hours = postdb('strDeliver_Location_Hours');
$Deliver_Phone1 = postdb('strDeliver_Phone1');
$Deliver_Phone1Type = postdb('strDeliver_Phone1Type');
$Deliver_Phone2 = postdb('strDeliver_Phone2');
$Deliver_Phone2Type = postdb('strDeliver_Phone2Type');
$Deliver_Phone3 = postdb('strDeliver_Phone3');
$Deliver_Phone3Type = postdb('strDeliver_Phone3Type');
$Deliver_ExtraInst = postdb('strDeliver_ExtraInst');
$Deliver_ExtraInst_send = postdb('strDeliver_ExtraInst_send');
$Deliver_BackupContact = postdb('strDeliver_BackupContact');
$Deliver_BackupName = postdb('strDeliver_BackupName');
$Deliver_BackupPhone = postdb('strDeliver_BackupPhone');
$Deliver_BackupPhoneType = postdb('strDeliver_BackupPhoneType');



$CarrierTip = postdb('CarrierTip');


$sql = "update orders set 
        Pickup_Contact = '$Pickup_Contact',
        Pickup_Company = '$Pickup_Company',
        Pickup_Address1 = '$Pickup_Address1',
        Pickup_City = '$Pickup_City',
        Pickup_NearCity = '$Pickup_NearCity',
        Pickup_State = '$Pickup_State',
        Pickup_Zip = '$Pickup_Zip',
        Pickup_Location_Type = '$Pickup_Location_Type',
        Pickup_Location_Hours = '$Pickup_Location_Hours',
        Pickup_Phone1 = '$Pickup_Phone1',
        Pickup_Phone1Type = '$Pickup_Phone1Type',
        Pickup_Phone2 = '$Pickup_Phone2',
        Pickup_Phone2Type = '$Pickup_Phone2Type',
        Pickup_Phone3 = '$Pickup_Phone3',
        Pickup_Phone3Type = '$Pickup_Phone3Type',
        Pickup_ExtraInst = '$Pickup_ExtraInst',
        Pickup_ExtraInst_send = '$Pickup_ExtraInst_send',
        Pickup_BackupName = '$Pickup_BackupName',
        Pickup_BackupPhone = '$Pickup_BackupPhone',
        Pickup_BackupPhoneType = '$Pickup_BackupPhoneType',
        Deliver_Contact = '$Deliver_Contact',
        Deliver_Company = '$Deliver_Company',
        Deliver_Address1 = '$Deliver_Address1',
        Deliver_City = '$Deliver_City',
        Deliver_NearCity = '$Deliver_NearCity',
        Deliver_State = '$Deliver_State',
        Deliver_Zip = '$Deliver_Zip',
        Deliver_Location_Type = '$Deliver_Location_Type',
        Deliver_Location_Hours = '$Deliver_Location_Hours',
        Deliver_Phone1 = '$Deliver_Phone1',
        Deliver_Phone1Type = '$Deliver_Phone1Type',
        Deliver_Phone2 = '$Deliver_Phone2',
        Deliver_Phone2Type = '$Deliver_Phone2Type',
        Deliver_Phone3 = '$Deliver_Phone3',
        Deliver_Phone3Type = '$Deliver_Phone3Type',
        Deliver_ExtraInst = '$Deliver_ExtraInst',
        Deliver_ExtraInst_send = '$Deliver_ExtraInst_send',
        Deliver_BackupName = '$Deliver_BackupName',
        Deliver_BackupPhone = '$Deliver_BackupPhone',
        Deliver_BackupPhoneType = '$Deliver_BackupPhoneType'
        where orderid = $orderid";
$wpdb->query($sql);

// //echo $sql.'<hr>';

$sql = "select * from orders where orderid = $orderid";
$getorder = $wpdb->get_row($sql,ARRAY_A);
// //echo $sql.'<hr>';

$numofvehicles = $getorder['Num_Of_Vehicles'];
$strCustEmail = $getorder['CustEmail'];

$strBalance = $getorder['Balance'];



//SALES CONVERSION UPDATE start
$trackid = $_COOKIE['trackid'];
if (!empty($trackid)) {
	$sql = "update sale_conversion set dateupdated=NOW(),orderid = $orderid, sale_status = '4. Checkout' where trackid = '$trackid'";
    $wpdb->query($sql);
    // //echo $sql.'<hr>';
}
//SALES CONVERSION UPDATE end


$sql = "delete from payments where orderid=$orderid";
$wpdb->query($sql);

$sql = "delete from orders_vehicles where orderid=$orderid";
$wpdb->query($sql);

	
if ($howmany == "onevehicle") {
	$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($orderid,'$strVehicle_Year','$strVehicle_Make','$strVehicle_Model','$strVehicle_Color','$strVehicle_VIN','$strVehicle_StockNum','$strVehicle_Convertible','$strVehicle_LiftKit','$strVehicle_LiftKit_Quantity','$strVehicle_Lowered','$strVehicle_Lowered_Quantity','$strVehicle_Oversized_Tires','$strVehicle_Oversized_Tires_Quantity','$strVehicle_AdditionalInfo',$auto_price1)";
	$wpdb->query($sql);
	// //echo $sql.'<hr>';
} else {
	$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($orderid,'$strVehicle_Year1','$strVehicle_Make1','$strVehicle_Model1','$strVehicle_Color1','$strVehicle_VIN1','$strVehicle_StockNum1','$strVehicle_Convertible1','$strVehicle_LiftKit1','$strVehicle_LiftKit_Quantity1','$strVehicle_Lowered1','$strVehicle_Lowered_Quantity1','$strVehicle_Oversized_Tires1','$strVehicle_Oversized_Tires_Quantity1','$strVehicle_AdditionalInfo1',$auto_price1)";
	$wpdb->query($sql);
	//echo $sql.'<hr>';
	
	
	if ($pricetier==1) {
		$auto_price1_withdep = $strtotalprice1;
	} elseif ($pricetier==2) {
		$auto_price1_withdep = $strtotalprice1_exp;
	} else {
		$auto_price1_withdep = $strtotalprice1_rush;
	}
	

	$sql = "insert into payments (OrderID,Description,Amount) values ($orderid,'Vehicle #1: $strVehicle_Year1 $strVehicle_Make1 $strVehicle_Model1 $tiermessage','$auto_price1_withdep')";
	$wpdb->query($sql);
	//echo $sql.'<hr>';

	if ($strVehicle_Make2!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($orderid,'$strVehicle_Year2','$strVehicle_Make2','$strVehicle_Model2','$strVehicle_Color2','$strVehicle_VIN2','$strVehicle_StockNum2','$strVehicle_Convertible2','$strVehicle_LiftKit2','$strVehicle_LiftKit_Quantity2','$strVehicle_Lowered2','$strVehicle_Lowered_Quantity2','$strVehicle_Oversized_Tires2','$strVehicle_Oversized_Tires_Quantity2','$strVehicle_AdditionalInfo2',$auto_price2)";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
		
		if ($pricetier==1) {
			$auto_price2_withdep = $strtotalprice2;
		} elseif ($pricetier==2) {
			$auto_price2_withdep = $strtotalprice2_exp;
		} else {
			$auto_price2_withdep = $strtotalprice2_rush;
		}
		
		$sql = "insert into payments (OrderID,Description,Amount) values ($orderid,'Vehicle #2: $strVehicle_Year2 $strVehicle_Make2 $strVehicle_Model2 $tiermessage','$auto_price2_withdep')";;
		$wpdb->query($sql);
		//echo $sql.'<hr>';

	}

	if ($strVehicle_Make3!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($orderid,'$strVehicle_Year3','$strVehicle_Make3','$strVehicle_Model3','$strVehicle_Color3','$strVehicle_VIN3','$strVehicle_StockNum3','$strVehicle_Convertible3','$strVehicle_LiftKit3','$strVehicle_LiftKit_Quantity3','$strVehicle_Lowered3','$strVehicle_Lowered_Quantity3','$strVehicle_Oversized_Tires3','$strVehicle_Oversized_Tires_Quantity3','$strVehicle_AdditionalInfo3',$auto_price3)";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
		
		if ($pricetier==1) {
			$auto_price3_withdep = $strtotalprice3;
		} elseif ($pricetier==2) {
			$auto_price3_withdep = $strtotalprice3_exp;
		} else {
			$auto_price3_withdep = $strtotalprice3_rush;
		}
		
		$sql = "insert into payments (OrderID,Description,Amount) values ($orderid,'Vehicle #3: $strVehicle_Year3 $strVehicle_Make3 $strVehicle_Model3 $tiermessage','$auto_price3_withdep')";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
	}
	
	if ($strVehicle_Make4!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($orderid,'$strVehicle_Year4','$strVehicle_Make4','$strVehicle_Model4','$strVehicle_Color4','$strVehicle_VIN4','$strVehicle_StockNum4','$strVehicle_Convertible4','$strVehicle_LiftKit4','$strVehicle_LiftKit_Quantity4','$strVehicle_Lowered4','$strVehicle_Lowered_Quantity4','$strVehicle_Oversized_Tires4','$strVehicle_Oversized_Tires_Quantity4','$strVehicle_AdditionalInfo4',$auto_price4)";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
		
		if ($pricetier==1) {
			$auto_price4_withdep = $strtotalprice4;
		} elseif ($pricetier==2) {
			$auto_price4_withdep = $strtotalprice4_exp;
		} else {
			$auto_price4_withdep = $strtotalprice4_rush;
		}
		
		$sql = "insert into payments (OrderID,Description,Amount) values ($orderid,'Vehicle #4: $strVehicle_Year4 $strVehicle_Make4 $strVehicle_Model4 $tiermessage','$auto_price4_withdep')";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
	}
	
    if ($strVehicle_Make5!="") {
		$sql = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice) values  ($orderid,'$strVehicle_Year5','$strVehicle_Make5','$strVehicle_Model5','$strVehicle_Color5','$strVehicle_VIN5','$strVehicle_StockNum5','$strVehicle_Convertible5','$strVehicle_LiftKit5','$strVehicle_LiftKit_Quantity5','$strVehicle_Lowered5','$strVehicle_Lowered_Quantity5','$strVehicle_Oversized_Tires5','$strVehicle_Oversized_Tires_Quantity5','$strVehicle_AdditionalInfo5',$auto_price5)";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
		
		if ($pricetier==1) {
			$auto_price5_withdep = $strtotalprice5;
		} elseif ($pricetier==2) {
			$auto_price5_withdep = $strtotalprice5_exp;
		} else {
			$auto_price5_withdep = $strtotalprice5_rush;
		}
		
		$sql = "insert into payments (OrderID,Description,Amount) values ($orderid,'Vehicle #5: $strVehicle_Year5 $strVehicle_Make5 $strVehicle_Model5 $tiermessage','$auto_price5_withdep')";
		$wpdb->query($sql);
		//echo $sql.'<hr>';
	}
}




if ($howmany == "onevehicle") {
	$sql = "insert into payments (OrderID,Description,Amount,username) values ($orderid,'Initial Shipment Total $tiermessage','$strTotalPrice','$CurrentUsername')";
	$wpdb->query($sql);
}

?>


<style type="text/css">

.banner {
    width: 100%;
    display: flex;
    /* height: 657px; */
    height: 370px;
    font-family: 'Montserrat', sans-serif;
}

.sec1 {
    width: 100%;
    background-color: #f1f1f1;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    display: flex;
}

.inner-container
{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 40px;
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
    display: none;
}

.spn {
    font-size: 12px;
    letter-spacing: 3px;
    font-weight: 700;
    color: #333;
    margin: 20px 0 10px;
}

.right-banner {
    text-align: center;
}

.right-banner img {
    width: 75%;
    border-radius: 20px;
}

.shipping_form_main {
    padding: 3% 0;
    margin-bottom: 50px;
    background-image: url(https://www.autotransportdirect.com/wp-content/uploads/2022/07/map-location.jpg);
    background-repeat: no-repeat;
    background-size: contain;
    object-fit: cover;
    background-position: right;
}

.pick_up_form {
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-column-gap: 65px;
}

.left_pickup {
    background-color: #fff;
    padding: 29px;
    border-radius: 20px;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    border-top: 5px solid #F1661E;
}

.form_heading {
    text-align: center;
    margin-bottom: 30px;
}








.next_btn {
    color: #fff !important;
    background-color: #0062cc;
    border-color: #005cbf;
    font-size: 14px;
    font-family: "Helvetica", Sans-serif !important;
    border-radius: 50px;
    letter-spacing: .5px;
    width: auto !important;
    text-transform: uppercase;
    font-weight: bold;
    padding: 13px 40px;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    margin-top: 20px !important;
    text-decoration: none;
}

.next_btn:hover {
    text-decoration: none;
    outline: none;
    cursor: pointer;
    background-color: orange;
}

#checkout_main_pay
{
	display:none;
}

#thanks_message , #payment_info
{
	display:none;
}

.my_order {
    font-size: 1.5vw;
    font-weight: 500;
    color: #333;
    /* line-height: 66px; */
    margin-bottom: 20px;
    border-bottom: 1px solid #333;
}

.block1 {
    color: #333;
    font-family: "Helvetica", Sans-serif;
    font-size: 16px;
    margin-bottom: 15px;
}

.quotelabel1 {
    font-size: 18px;
    display: inline;
    line-height: 30px;
    color: #095bc2;
    font-weight: 700;
}

.block1_desc {
    border-bottom: 1px solid #BEBEBE;
    padding: 3px;
    line-height: 26px;
}

</style>


<div class="banner" id="billing_info">
	<div class="sec1">
		<div class="container">
			<div class="inner-container">
					<div class="left-banner">
						<!--<div class="point">
						<div class="point1"><i class="fa fa-arrow-right" style="font-weight: 700;font-size: 14px;margin-right: 10px;"></i> Step Four</div>
						</div>-->
						<p class="spn">The Car Shipping Experts</p>
						<h1 class="head">Billing Info</h1>
						<p class="textpara">Direct Express Auto Transport’s no personal information car shipping cost calculator has been the best since 2004.</p>
				</div>
				<div class="right-banner">
				<img alt="billing info" data-src="/images/staff/order-checkout.jpg" class=" lazyloaded" src="/images/staff/order-checkout.jpg"><noscript><img src="/images/staff/order-checkout.jpg" alt="billing info" /></noscript>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="banner" id="payment_info">
	<div class="sec1">
		<div class="container">
			<div class="inner-container">
					<div class="left-banner">
						<!--<div class="point">
						<div class="point1"><i class="fa fa-arrow-right" style="font-weight: 700;font-size: 14px;margin-right: 10px;"></i> Step Four</div>
						</div>-->
						<p class="spn">The Car Shipping Experts</p>
						<h1 class="head">Checkout</h1>
						<p class="textpara">Direct Express Auto Transport’s no personal information car shipping cost calculator has been the best since 2004.</p>
				</div>
				<div class="right-banner">
				<img alt="our customers" data-src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/car-hauler-2-1280x852-1-clr.jpg" class=" lazyloaded" src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/car-hauler-2-1280x852-1-clr.jpg"><noscript><img src="https://www.autotransportdirect.com/wp-content/uploads/2022/07/car-hauler-2-1280x852-1-clr.jpg" alt="our customers" /></noscript>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="smart-forms">
    <div class="section fieldentry" style="margin: 20px 0;">
        <!--<div class="frm-row">
            <div class="colm colm12 ordersteps" style="text-align: center">
                <img src="/wp-content/themes/atdv2/images/checkout-prog-4.png" alt="Step 4 - Checkout" />
            </div>
        </div>-->
   
    <form action="?step=7" method="post" name="mainform" id="mainform">
	    <input type="hidden" name="orderid" value="<?php echo $orderid ?>">
	    <input type="hidden" name="howmany" value="<?php echo $howmany ?>">
	    <input type="hidden" name="pricetier" value="<?php echo $pricetier?>">
	    <input type="hidden" name="pricetiername" value="<?php echo $pricetiername ?>">
	    
		    
	    <input type="hidden" name="strVehicle_Make" value="<?php echo $strVehicle_Make ?>">
	    <input type="hidden" name="strVehicle_Make1" value="<?php echo $strVehicle_Make1 ?>">
	    <input type="hidden" name="strVehicle_Make2" value="<?php echo $strVehicle_Make2 ?>">
	    <input type="hidden" name="strVehicle_Make3" value="<?php echo $strVehicle_Make3 ?>">
	    <input type="hidden" name="strVehicle_Make4" value="<?php echo $strVehicle_Make4 ?>">
	    <input type="hidden" name="strVehicle_Make5" value="<?php echo $strVehicle_Make5 ?>">
	    
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
	    
	    
	    
	    
	    <input type="hidden" name="strCustEmail" value="<?php echo $strCustEmail ?>">
	    <input type="hidden" name="originalbalance" id="originalbalance" value="<?php echo $getorder['Balance'] ?>">
	    <input type="hidden" name="balance" id="balance" value="<?php echo $getorder['Balance'] ?>">
	    <input type="hidden" name="deposit" id="deposit" value="<?php echo $strDeposit ?>">
	    
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

		
		<script>
		function useshipfrom()
		{
			$('#strBilling_Address1').val('<?php echo $getorder['Pickup_Address1'] ?>');
			$('#strBilling_City').val('<?php echo $getorder['Pickup_City'] ?>');
			$('#strBilling_State').val('<?php echo $getorder['Pickup_State'] ?>');
			$('#strBilling_Zip').val('<?php echo $getorder['Pickup_Zip'] ?>');
			$('#strBilling_Phone').val('<?php echo $getorder['Pickup_Phone1'] ?>');
		
		}
		
		function useshipto()
		{
			$('#strBilling_Address1').val('<?php echo $getorder['Deliver_Address1'] ?>');
			$('#strBilling_City').val('<?php echo $getorder['Deliver_City'] ?>');
			$('#strBilling_State').val('<?php echo $getorder['Deliver_State'] ?>');
			$('#strBilling_Zip').val('<?php echo $getorder['Deliver_Zip'] ?>');
			$('#strBilling_Phone').val('<?php echo $getorder['Deliver_Phone1'] ?>');
		}
		
		function calctip() {
		    var tipVal = parseInt(document.mainform.CarrierTip.value);
		    var originalbalance = parseInt(document.mainform.originalbalance.value);
		    var newbalance = originalbalance + tipVal;
		    
		    console.log(newbalance);
		    
		    $('#balance').val(newbalance);
		    $('.balanceduedisp').html('$' + newbalance);
		}
		</script> 



		
		
			<div class="section fieldentry" style="margin-top: 30px;" id="checkout_main">
		
			<div class="shipping_form_main">
		
			<div class="container">
			
			<div class="pick_up_form" id="pickup_form">
			
				<div class="left_pickup">
				
		
				<div class="frm-row">
					
						<strong>Billing Details</strong><br>
						<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
				  
				</div>
				
				<div class="frm-row">
					<div class="colm colm11">
						<strong>Use as Billing Address:</strong>&nbsp;&nbsp;&nbsp;
						<a href="javascript:useshipfrom();">Pickup Address</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:useshipto();">Deliver Address</a><br><br>
					</div>
				</div>
				
				<div class="frm-row">
					
					<div class="colm colm12">
						
						<div class="frm-row">
							<div class="colm colm12">
								First Name: <span class="smalltext">(As it appears on your card)</span><br>
								<label class="field append-icon">
									<input type="text" name="strBilling_FirstName" id="strBilling_FirstName" size="40" value="<?php echo $getorder['CustFirstName'] ?>">
								</label>
							</div>
						</div>
						<div class="frm-row">
							<div class="colm colm12">
								Last Name: <span class="smalltext">(As it appears on your card)</span><br>
								<label class="field append-icon">
									<input type="text" name="strBilling_LastName" id="strBilling_LastName" size="40" value="<?php echo $getorder['CustLastName'] ?>"><label for="strBilling_LastName" class="field-icon">
							</div>
						</div>
						<div class="frm-row">
							<div class="colm colm12">
								Billing Address:<br>
								<label class="field append-icon">
									<input type="text" name="strBilling_Address1" id="strBilling_Address1" size="40"> 
								</label><br>
							</div>
						</div>
						<div class="frm-row">
							<div class="colm colm5">
								City:<br>
								<label class="field append-icon">
									<input type="text" name="strBilling_City" id="strBilling_City" size="30"> 
								</label>
							</div>
		
							<div class="colm colm4">
								State:<br>
								<label for="strBilling_State" class="field select">
									<select name="strBilling_State" id="strBilling_State">
										<option value="0" SELECTED>- STATE -</option>
										<option value="AA">Armed Forces (AA)</option>
										<option value="AE">Armed Forces (AE)</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AL">Alberta (Canada)</option>
										<option value="AP">Armed Forces (AP)</option>
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
									</select><i class="arrow"></i>
								</label>
							</div>
		
							<div class="colm colm3">
								Zip:<br>
								<label class="field append-icon">
									<input type="text" name="strBilling_Zip" id="strBilling_Zip" size="10"> 
								</label>
							</div>
						</div>
						<div class="frm-row">
							<div class="colm colm12">
								Phone Number:<br>
								<label class="field append-icon">
									<input type="text" name="strBilling_Phone" id="strBilling_Phone" size="25" value="<?php echo $getorder['CustPhone1'] ?>">
								</label>
							</div>
						</div>
						
						
						<div class="frm-row">
								<div class="colm colm12">
									Terms & Conditions&nbsp;<br>
									<label class="option" style="display:inline; font-weight: normal;">
										<input type="radio" name="strDeliver_terms" id="strDeliver_terms_yes" value="Yes" checked="checked"><span class="radio"></span> Yes
									</label>
									
									<label class="option" style="display:inline; font-weight: normal;">
										<input type="radio" name="strDeliver_terms" id="strDeliver_terms_no" value="No"><span class="radio"></span> No
									</label>
									
									<div style="margin-top: 15px;"><a id="strDeliver_terms_read">Read Terms & Conditions</a></div>
									
									
									
								</div>
							</div>
						
					   
						</div>
					   
					</div>
					
				<div class="frm-group" style="text-align: center;margin-top: 40px;margin-bottom: 20px;">
					<a class="next_btn" id="pick_payment">Proceed to Checkout →</a>
				</div>	
				
				
				</div>
				
				<div class="right_form">
					<!--<img src="/images/staff/order-checkout.jpg" style="border-radius: 5px; margin-top: 24px;"/>-->
					
					<div class="quotesummary1">
						
						<div class="my_order">My Order Details</div>
						
	            <div class="block1">
					<span class="quotelabel1">Shipping From:</span>  
					<span class="block1_desc"><?php echo $getorder['Pickup_City'] ?>, <?php echo $getorder['Pickup_State'] ?>&nbsp;&nbsp;<?php echo $getorder['Pickup_Zip'] ?></span>
				</div>
                
                <div class="block1">
					<span class="quotelabel1">Shipping To:</span>
					<span class="block1_desc"><?php echo $getorder['Deliver_City'] ?>, <?php echo $getorder['Deliver_State'] ?>&nbsp;&nbsp;<?php echo $getorder['Deliver_Zip'] ?></span>
				</div>
                
                
              
				
				<?php if($getorder['Num_Of_Vehicles']==1) { ?>
	    		 <div class="block1">
				 <span class="quotelabel1">Types of Vehicle:</span>
	    		 <span class="block1_desc"><?php echo $getorder['Vehicle_Make'] ?> - <?php echo $getorder['Vehicle_Model'] ?></span>
				 </div>
	    	<?php } else {
	    		$sql = "select * from orders_vehicles where orderid = $orderid";
	    		$OrderVehicle = $wpdb->get_results($sql,ARRAY_A);
	    		?>
	            <div class="block1">
				 <span class="quotelabel1">Types of Vehicles:</span>
	    		<?php
	    		$counter=1;
	    		foreach ($OrderVehicle as $OrderVehicle_field) {
	    		    echo '<span class="block1_desc">'.$OrderVehicle_field['Vehicle_Make'] ?> - <?php echo $OrderVehicle_field['Vehicle_Model'] . "</span></div>";
	                $counter++;
	            }
	    		?>
	    
	        <?php } ?>
				
				
				
				
				
				<div class="block1">
					<span class="quotelabel1">Operating Condition:</span>
					<span class="block1_desc"><?php echo $getorder['Quote_vehicle_operational'] ?> and Rolls, Brakes, Steers</span>
				</div>
				
				<div class="block1">
					<span class="quotelabel1">Type of Trailer:</span>
					<span class="block1_desc"> <?php echo $getorder['Quote_vehicle_trailer'] ?></span>
				</div>
				
				<div class="block1"><span class="quotelabel1">Route Distance:</span>
				   <span class="block1_desc" id="route_dist2">
					
					</span>
                 </div>
				 
				  <?php
				      //$daysonroad = $totaldistance/500;
				     // $daysonroad = ceil($daysonroad);
				     // $daysonroadmax = $daysonroad + 2;  
				 ?>
				 
				 
				 <div class="block1"><span class="quotelabel1">Typical Transit Time On The Road:</span>
				   <span class="block1_desc" id="tt_time">
					
					</span>
                 </div>


            </div>
					
				</div>
			
			</div>
			
			</div>
			
		</div>
		
		</div>    

        </div>
        

         
        <!--<div class="frm-row">
            <div class="colm colm12">
                <div style="margin:0px 0 25px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>-->
        	
		<div class="section fieldentry" style="margin-top: 30px;" id="checkout_main_pay">
		
		<div style="font-weight: bold;font-size: 28px;text-align: center;margin-top: 30px;">Almost Done!</div>
		
	<div class="shipping_form_main">
		
		<div class="container">
			
			<div class="pick_up_form" id="pickup_form">
        
				<div class="left_pickup">
		
					<div class="frm-row">
						<div class="colm colm8">
							
							<div style="font-weight: bold;font-size: 25px;color:#1a73e8; margin-bottom: 16px;">$0 Due Now</div>
							<div style="font-weight:600;">Your credit card will not be charged until the order is assigned to a carrier.<br><br></div>
							
							
						</div>
						
					</div>			
			
					<div class="frm-row">
						<div class="colm colm12">
							<div style="font-weight:600;">Credit Card Number:</div>
							<label class="field append-icon">
								<input type="text" name="strCreditCartNum" id="strCreditCartNum" size="40"> 
							</label>
						</div>
					</div>
					
					<div class="frm-row">
						<div class="colm colm12">
							
							<div class="frm-row">
								<div class="colm colm4">
									<div style="font-weight:600;">Expiration:</div>
									<label for="strCreditCartMonth" class="field select">
										<select name="strCreditCartMonth" id="strCreditCartMonth">
											<option value="0" SELECTED>-MONTH-</option><option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
										</select><i class="arrow"></i>
									</label>
								</div>
			
								<div class="colm colm4">
									&nbsp;<br>
									<label for="strCreditCartYear" class="field select">
										<select name="strCreditCartYear" id="strCreditCartYear"><option value="0" SELECTED>-YEAR-</option>
											<?php
											$currentyear = date('Y');
											$endyear = $currentyear + 15;
											for ($y=$currentyear; $y <= $endyear; $y++) {
											?>
											<option value="<?php echo substr($y,-2) ?>"><?php echo $y ?></option>
											<?php } ?>
										</select><i class="arrow"></i>
									</label>
								</div>
								<div class="colm colm4">
									<span style="font-weight:600;">Code:</span>&nbsp;&nbsp;<span class="smalltext"><a href="#" onclick="window.open('/wp-content/themes/atdv2/explaincvv.html','popup','toolbar=no,status=no,location=no,menubar=no,height=410,width=400,scrollbars=no'); return false;">What is CVV?</a></span><br>
										<input type="text" name="strCreditCartCVV" id="strCreditCartCVV" >
								</div>
							</div>
							
							<div class="frm-row">
								<div class="colm colm12" style="margin-top: 10px;">
									<div style="font-weight:600;">Would you like to add more to the Money Order or Cash carrier fee, which oftentimes makes it go faster?<br>
									<label class="option" style="display:inline;">
										<input type="radio" name="CarrierTip" id="CarrierTip0" value="0" onclick="calctip();" checked="checked"><span class="radio"></span> $0
									</label>
									
									<!--<label class="option" style="display:inline;">
										<input type="radio" name="CarrierTip" id="CarrierTip25" value="25" onclick="calctip();"><span class="radio"></span> $25
									</label>-->
									
									<label class="option" style="display:inline;">
										<input type="radio" name="CarrierTip" id="CarrierTip50" value="50" onclick="calctip();"><span class="radio"></span> $50
									</label>
									
									<!--<label class="option" style="display:inline;">
										<input type="radio" name="CarrierTip" id="CarrierTip75" value="75" onclick="calctip();"><span class="radio"></span> $75
									</label>-->
									
									<label class="option" style="display:inline;">
										<input type="radio" name="CarrierTip" id="CarrierTip100" value="100" onclick="calctip();"><span class="radio"></span> $100
									</label>
			
									<label class="option" style="display:inline;">
										<input type="radio" name="CarrierTip" id="CarrierTip200" value="200" onclick="calctip();"><span class="radio"></span> $200
									</label>
									</div>
								</div>
							</div>
							
						</div>
						
					
					</div>
					
					<div class="frm-row">
						<div class="colm colm6">
							<br>
							<ul>
								<li>Total Door-to-Door <?php echo $pricetiername ?> Price: $<?php echo $strTotalPrice ?></li>
								<li>A Partial Credit Card Payment After Your Scheduled Pickup</li>
								<li>Balance Paid To The Carrier With Money Order or Cash Upon Delivery</li>
							</ul>
							
							
							
						</div>
						
					</div>
			
					<div class="frm-row">
						<div class="colm colm12">
							<button type="submit" class="next_btn">
								Book My Shipment&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
							</button><br><br>
						</div>
					</div>
				
				</div>
				
				<div class="right_form">
					
					<img src="/wp-content/themes/atdv2/images/authorize-net.png" alt="Authorize.net" style="border-radius: 5px; margin-top: 24px;"/>
					
					<div class="quotesummary1">
						
						<div class="my_order">My Order Details</div>
						
	            <div class="block1">
					<span class="quotelabel1">Shipping From:</span>  
					<span class="block1_desc"><?php echo $getorder['Pickup_City'] ?>, <?php echo $getorder['Pickup_State'] ?>&nbsp;&nbsp;<?php echo $getorder['Pickup_Zip'] ?></span>
				</div>
                
                <div class="block1">
					<span class="quotelabel1">Shipping To:</span>
					<span class="block1_desc"><?php echo $getorder['Deliver_City'] ?>, <?php echo $getorder['Deliver_State'] ?>&nbsp;&nbsp;<?php echo $getorder['Deliver_Zip'] ?></span>
				</div>
                
                
              
				
				<?php if($getorder['Num_Of_Vehicles']==1) { ?>
	    		 <div class="block1">
				 <span class="quotelabel1">Types of Vehicle:</span>
	    		 <span class="block1_desc"><?php echo $getorder['Vehicle_Make'] ?> - <?php echo $getorder['Vehicle_Model'] ?></span>
				 </div>
	    	<?php } else {
	    		$sql = "select * from orders_vehicles where orderid = $orderid";
	    		$OrderVehicle = $wpdb->get_results($sql,ARRAY_A);
	    		?>
	            <div class="block1">
				 <span class="quotelabel1">Types of Vehicles:</span>
	    		<?php
	    		$counter=1;
	    		foreach ($OrderVehicle as $OrderVehicle_field) {
	    		    echo '<span class="block1_desc">'.$OrderVehicle_field['Vehicle_Make'] ?> - <?php echo $OrderVehicle_field['Vehicle_Model'] . "</span></div>";
	                $counter++;
	            }
	    		?>
	    
	        <?php } ?>
				
				
				
				
				
				<div class="block1">
					<span class="quotelabel1">Operating Condition:</span>
					<span class="block1_desc"><?php echo $getorder['Quote_vehicle_operational'] ?> and Rolls, Brakes, Steers</span>
				</div>
				
				<div class="block1">
					<span class="quotelabel1">Type of Trailer:</span>
					<span class="block1_desc"> <?php echo $getorder['Quote_vehicle_trailer'] ?></span>
				</div>
				
				<div class="block1"><span class="quotelabel1">Route Distance:</span>
				   <span class="block1_desc" id="routedistance">
					
					</span>
                 </div>
				 
				  <?php
				      //$daysonroad = $totaldistance/500;
				     // $daysonroad = ceil($daysonroad);
				     // $daysonroadmax = $daysonroad + 2;  
				 ?>
				 
				 
				 <div class="block1"><span class="quotelabel1">Typical Transit Time On The Road:</span>
				   <span class="block1_desc" id="transittime">
					
					</span>
                 </div>
					
					
				<script>
				
					// Retrieve
					document.getElementById("routedistance").innerHTML = localStorage.getItem("routedistance") + " Miles";
					
					// Retrieve
					document.getElementById("transittime").innerHTML = localStorage.getItem("transittime") + " Days";
					
					
					
					// Retrieve
					document.getElementById("route_dist2").innerHTML = localStorage.getItem("routedistance") + " Miles";
					
					// Retrieve
					document.getElementById("tt_time").innerHTML = localStorage.getItem("transittime") + " Days";
				</script>	

            </div>
					
				</div>
					
				</div>			
				
        	
			</div>
		
		</div>
	
	</div>

</div>

		
		<div class="section fieldentry" style="margin-top: 30px;margin-bottom: 30px;" id="thanks_message">
		
		<div class="container">
        
        	<!--<div class="frm-row">
        	<div class="colm colm12">
                <div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
            </div>
        </div>-->
        
        
        	<div class="frm-row">
        
            
	            <div class="colm colm12">
	                <br>
	                	
					Our credit card merchant gateway is secure and there are no taxes, fuel surcharges or hidden fees.<br><br>
					<ul style="margin-left: 20px;">
						<li>Your credit card will not be charged until the order is assigned to a carrier.</li>
						<li>Upon checkout you will receive an instant email order confirmation.</li>
						<li>Upon carrier assignment you will receive another email notification.</li>
						<li>The carrier will call your pickup contact first before going there.</li>
						<li>The carrier will call your destination contact from the road before delivery.</li>
					</ul>
					Thank you for honoring us with your business!    
	                        
	            </div>
        </div>
        
        </div>
		
		</div>
        
        
    </form>
	</div>
</div>

<script>
jQuery('#mainform').submit(function(e) {
	e.preventDefault();
	jQuery(this).find("button[type='submit']").prop('disabled',true);
	jQuery(this).find("button[type='submit']").text('Please Wait...');
	document.getElementById("mainform").submit();
});




jQuery("#pick_payment").click(function() {
   jQuery('#checkout_main_pay').css("display","block");
   jQuery('#checkout_main').css("display","none");
   jQuery('#thanks_message').css("display","block"); 
   
   jQuery('#billing_info').css("display","none"); 
   jQuery('#payment_info').css("display","flex"); 
   
   window.location='#payment_info';
   
});
</script>