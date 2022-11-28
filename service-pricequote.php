<?php
function GetQuote($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug) {
    global $wpdb;
    
    //Get Vehicle from database and apply the multiplier
	$sql = "select * from automobiles where auto_make = '$auto_make' and auto_model = '$auto_model' and display=1";
	$GetAuto = $wpdb->get_row($sql,ARRAY_A);
	if ($wpdb->num_rows == 0) {
		$auto_priceadjustment = 1;
		$auto_addon = 0;
	} else {
    	$auto_priceadjustment = $GetAuto['auto_priceadjustment'];
		$auto_addon = $GetAuto['addon'];
    }

	//Get Vehicle Year Multiplier from database
	$sql = "select multiplier,flatrate_low,flatrate_high from year_multiplier where auto_year = '$auto_year'";
	$GetYear = $wpdb->get_row($sql,ARRAY_A);
    if ($wpdb->num_rows == 0) {
		$year_multiplier = 1;
		$year_flatrate_low = 0;
		$year_flatrate_high = 0;
	} else {
    	$year_multiplier = $GetYear['multiplier'];
    	$year_flatrate_low = $GetYear['flatrate_low'];
    	$year_flatrate_high = $GetYear['flatrate_high'];
    }

	if ($_SESSION['username'] == "claydough") {
		$debug = 1;
	}

	if ($debug == 1) {
    	echo "<div class='debuginfo'>";
		echo "<b>$auto_make - $auto_model</b><br>";
	}
	
	$QuotePrice = GetQuotev12($shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$auto_addon,$year_multiplier,$year_flatrate_low,$year_flatrate_high,$debug);
	
	return $QuotePrice;
}  



function GetQuotev12($shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$auto_addon,$year_multiplier,$year_flatrate_low,$year_flatrate_high,$debug) {
    global $wpdb;

	//1. Get the Distance between startzip and endzip
	$totaldistance = getdistance($shippingfromzip,$shippingtozip);

    
    $shippingfromzip3 = substr($shippingfromzip,0,3);
    $shippingtozip3 = substr($shippingtozip,0,3);
        
	//STATE: Get the state from the zip code
	$sql = "select State from zipcodesv2 where left(ZipCode,3) = '$shippingfromzip3' limit 0,1";
	$StartStateRs = $wpdb->get_row($sql,ARRAY_A);
	$startstate = $StartStateRs['State'];

	$sql = "select State from zipcodesv2 where left(ZipCode,3) = '$shippingtozip3' limit 0,1";
	$EndStateRs = $wpdb->get_row($sql,ARRAY_A);
	$endstate = $EndStateRs['State'];

    //Divide certain bigger states
    $startstatevirgin = $startstate;
    $endstatevirgin = $endstate;    
	$startstate = splitstate($startstate,$shippingfromzip);
    $endstate = splitstate($endstate,$shippingtozip);


	//2. Grab the flatrate and bymilerate from the database for the distance received
	$sql = "select flatrate,bymilerate from pricing2 where milelow <= '$totaldistance' and milehigh >= '$totaldistance'";
	$getrates = $wpdb->get_row($sql,ARRAY_A);
	$flatrate = $getrates['flatrate'];
	$bymilerate = $getrates['bymilerate'];
	


	if (empty($flatrate) || $flatrate==0) {
		$totalprice1 = $totaldistance * $bymilerate;
		$totalprice0 = $totalprice1;
		
		$totalprice1 = $totalprice1 * $auto_priceadjustment;
	    $totalprice1 = $totalprice1 + $auto_addon;
	    	
/*
		Only use multiplier if addon is zero
		if ($auto_addon==0) {
	    	$totalprice1 = $totalprice1 * $auto_priceadjustment;
	    } else {
	    	$totalprice1 = $totalprice1 + $auto_addon;
		}
*/
	} else {
		$totalprice1 = $flatrate;
		$totalprice0 = $totalprice1;
		
		$totalprice1 = $totalprice1 * $auto_priceadjustment;
	    $totalprice1 = $totalprice1 + $auto_addon;
		
/*
		Only use multiplier if addon is zero
		if ($auto_addon==0) {
	    	$totalprice1 = $totalprice1 * $auto_priceadjustment;
	    } else {
	    	$totalprice1 = $totalprice1 + $auto_addon;
		}
*/
	}
	
	
    //Year Multiplier/Flat Rate Added
    if($year_flatrate_low!=0 && $year_flatrate_high!=0) {
		if ($totaldistance<1600) {
    		$totalprice1 = $totalprice1 + $year_flatrate_low;
		} else {
    		$totalprice1 = $totalprice1 + $year_flatrate_high;
		}
	} else {
	    $totalprice1 = $totalprice1 * $year_multiplier;
	}

	//4. Check first X digits of zip code to make rate adjustments
    $shippingfromzip5 = substr($shippingfromzip,0,5);
    $shippingfromzip4 = substr($shippingfromzip,0,4); 
    $shippingfromzip3 = substr($shippingfromzip,0,3);
    $shippingtozip5 = substr($shippingtozip,0,5);
    $shippingtozip4 = substr($shippingtozip,0,4); 
    $shippingtozip3 = substr($shippingtozip,0,3);

	//Try 5 digits first
	$sql = "select addon,nearcity,addon1k from ziprateadjust where partialzip = '$shippingfromzip5'";
	$getrateadjust = $wpdb->get_row($sql,ARRAY_A);

    if ($wpdb->num_rows == 0) {
        $origin_addon = 0;
        $origin_addon1k = 0;
		$origin_match = 0;
	} else {
    	$origin_addon = $getrateadjust['addon'];
    	$origin_addon1k = $getrateadjust['addon1k'];
		$origincity = $getrateadjust['nearcity'];
		$origin_match = 1;
	}


    if ($origin_match == 0) {
    	//Try 4 digits
    	$sql = "select addon,nearcity,addon1k from ziprateadjust where partialzip = '$shippingfromzip4'";
    	$getrateadjust = $wpdb->get_row($sql,ARRAY_A);

    	if ($wpdb->num_rows == 0) {
            $origin_addon = 0;
            $origin_addon1k = 0;
    		$origin_match = 0;
    	} else {
        	$origin_addon = $getrateadjust['addon'];
        	$origin_addon1k = $getrateadjust['addon1k'];
    		$origincity = $getrateadjust['nearcity'];
    		$origin_match = 1;
    	}
    }

    if ($origin_match == 0) {
    	$sql = "select addon,nearcity,addon1k from ziprateadjust where partialzip = '$shippingfromzip3'";
    	$getrateadjust = $wpdb->get_row($sql,ARRAY_A);

    	if ($wpdb->num_rows == 0) {
            $origin_addon = 0;
            $origin_addon1k = 0;
    		$origin_match = 0;
    	} else {
        	$origin_addon = $getrateadjust['addon'];
        	$origin_addon1k = $getrateadjust['addon1k'];
    		$origincity = $getrateadjust['nearcity'];
    		$origin_match = 1;
    	}
    }


    $sql = "select addon,nearcity,addon1k from ziprateadjust where partialzip = '$shippingtozip5'";
    $getrateadjust = $wpdb->get_row($sql,ARRAY_A);
    if ($wpdb->num_rows == 0) {
        $dest_addon = 0;
        $dest_addon1k = 0;
		$dest_match = 0;
	} else {
    	$dest_addon = $getrateadjust['addon'];
    	$dest_addon1k = $getrateadjust['addon1k'];
		$destcity = $getrateadjust['nearcity'];
		$dest_match = 1;
	}


    if ($dest_match == 0) {
        $sql = "select addon,nearcity,addon1k from ziprateadjust where partialzip = '$shippingtozip4'";
    	$getrateadjust = $wpdb->get_row($sql,ARRAY_A);
        if ($wpdb->num_rows == 0) {
            $dest_addon = 0;
            $dest_addon1k = 0;
    		$dest_match = 0;
    	} else {
        	$dest_addon = $getrateadjust['addon'];
        	$dest_addon1k = $getrateadjust['addon1k'];
    		$destcity = $getrateadjust['nearcity'];
    		$dest_match = 1;
    	}
    }

    if ($dest_match == 0) {
        $sql = "select addon,nearcity,addon1k from ziprateadjust where partialzip = '$shippingtozip3'";
    	$getrateadjust = $wpdb->get_row($sql,ARRAY_A);
        if ($wpdb->num_rows == 0) {
            $dest_addon = 0;
            $dest_addon1k = 0;
    		$dest_match = 0;
    	} else {
        	$dest_addon = $getrateadjust['addon'];
        	$dest_addon1k = $getrateadjust['addon1k'];
    		$destcity = $getrateadjust['nearcity'];
    		$dest_match = 1;
    	}
    }

	//5. Figure the price based on the rate adjustments and save it as totalprice2

	if ($totaldistance >= 1000) {
    	$totalprice2 = $totalprice1 + $origin_addon1k;
    	$price_postoriginrate = $totalprice2;    	
    	$totalprice2 = $totalprice2 + $dest_addon1k;
    	$price_postdestrate = $totalprice2;
	} else {
    	$totalprice2 = $totalprice1 + $origin_addon;
    	$price_postoriginrate = $totalprice2;
    	$totalprice2 = $totalprice2 + $dest_addon;
        $price_postdestrate = $totalprice2;
	}



	//8. STATE OVERRIDE: Get the originrateperc rates for the origin and destination states
	$sql = "select originrateperc,originrateperchigh from states where state = '$startstate'";
	$getoriginstate = $wpdb->get_row($sql,ARRAY_A);
	if ($wpdb->num_rows == 0) {
        $originrateadjust2 = 0;
	} else {
    	if (is_null($getoriginstate['originrateperc'])) {
			$originrateadjust2 = 0;
		} else {
		    if ($totaldistance <= 99) {
                $staterateadjustmsg="Override Not Eligible";
                $originrateadjust2 = 0;
            } else {
    			if ($totaldistance <= 1600) {
    				$originrateadjust2 = $getoriginstate['originrateperc'];
    			} else {
    				$originrateadjust2 = $getoriginstate['originrateperchigh'];
    			}
            }
		}
	}
    	
    	

	$sql = "select destrateperc,destrateperchigh from states where state = '$endstate'";
	$getdeststate = $wpdb->get_row($sql,ARRAY_A);
	if ($wpdb->num_rows == 0) {
        $destrateadjust2 = 0;
	} else {
    	if (is_null($getdeststate['destrateperc'])) {
			$destrateadjust2 = 0;
		} else {
		    if ($totaldistance <= 99) {
                $staterateadjustmsg="Override Not Eligible";
                $destrateadjust2 = 0;
            } else {
    			if ($totaldistance <= 1600) {
    				$destrateadjust2 = $getdeststate['destrateperc'];
    			} else {
    				$destrateadjust2 = $getdeststate['destrateperchigh'];
    			}
            }
		}
	}
	
	//Prevent double discounts
	if ($originrateadjust2 < 0 && $destrateadjust2 < 0) {
    	if($originrateadjust2 < $destrateadjust2) {
        	$destrateadjust2 = $destrateadjust2 / 2;
    	} else {
        	$originrateadjust2 = $originrateadjust2 / 2;
    	}
	}

  	//Apply State Override Rate
	$totalprice2 = $totalprice2 * (1+($originrateadjust2/100));
	$price_postoriginstate = $totalprice2;
	$totalprice2 = $totalprice2 * (1+($destrateadjust2/100));
	$price_postdeststate = $totalprice2;
	
	

    //SPECIAL CICRUMSTANCES - special routes
	$sql = "select adjustment from states_specialcircumstance where state_orig = '$startstate' and state_dest = '$endstate'";
	$getspecialcirc = $wpdb->get_row($sql,ARRAY_A);
	if ($wpdb->num_rows == 0) {
        $specialcircumstance_adjust = 0;
	} else {
    	$specialcircumstance_adjust = $getspecialcirc['adjustment'];
    }
	  
    //Apply Special Circumstances
	$totalprice2 = $totalprice2 * (1+($specialcircumstance_adjust/100));
	$price_poststatecirc = $totalprice2;



	//Add enclosure rates if applicable
	$enclosurerate = 0;
	if ($enclosed == "1") {
		$enclosurerate = $totalprice2 * .65;
		if($enclosurerate<300) {
			$enclosurerate=300;
		}
		$totalprice2 = $totalprice2 + $enclosurerate;
	}


	//10. Round the rate to the next $25 increment
	$totalprice2 = roundUpToAny($totalprice2);
	$roundedtotal = $totalprice2;



	//12. Setup session variables for the "near" origin and destination cities.
	if (empty($origincity)) {
		$_SESSION['nearorigincity'] = "";
	} else {
		$_SESSION['nearorigincity'] = $origincity;
	}
	if (empty($destcity)) {
		$_SESSION['neardestcity'] = "";
	} else {
		$_SESSION['neardestcity'] = $destcity;
	}


    //redefine deposit
    $DEATDeposit = calcdeposit($totalprice2);



	//13. Add the deposit to the quote
	$totalprice2 = $totalprice2 + $DEATDeposit;


    //debug="1"
	//15 Print debug info to the screen
	if ($debug == "1") {

		$url = "http://www.centraldispatch.com/protected/listing-search/result?pickupAreas%5B%5D=state_USA_$startstatevirgin&pickupRadius=25&pickupCity=&pickupState=&pickupZip=&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$endstatevirgin&deliveryRadius=25&deliveryCity=&deliveryState=&deliveryZip=&Destination_valid=1&vehicleTypeIds%5B%5D=4&trailerType=Open&vehiclesRun=1&minVehicles=1&maxVehicles=1&shipWithin=60&paymentType=&minPayPrice=&minPayPerMile=&highlightPeriod=0&listingsPerPage=500&postedBy=&primarySort=1&secondarySort=4";

        
		echo "<hr>start zip: $shippingfromzip<br>";
		echo "end zip: $shippingtozip<br><br>";
		echo "startstate: $startstate<br>";
		echo "endstate: $endstate<br><br>";

		echo "<a href='$url' target='_new'><b>CD LINK</b></a><br><br>";

		echo "Total Distance: $totaldistance Miles<br>";
		echo "flat rate: $flatrate<br>";
		echo "by mile rate: $bymilerate<br>";
		echo "<b>totalprice0: $totalprice0(before multiplier)</b><br><br>";

		echo "auto multiplier: $auto_priceadjustment<br>";
		echo "auto addon: $auto_addon<br>";
		echo "year multiplier: $year_multiplier<br>";
		echo "year flat rate low: $year_flatrate_low<br>";
		echo "year flat rate high: $year_flatrate_high<br>";
		echo "<b>totalprice1: $totalprice1</b>(after multipliers, before zip code adjustment)<br><br>";


		echo "origincity: " . $_SESSION['nearorigincity'] . "<br>";
		echo "origin_addon: $origin_addon<br>";
        echo "Origin Zip 1k_over Bump: " . $origin_addon1k . "<br>";
		echo "<b>price_postoriginaddon: $price_postoriginrate</b>(after origin zip code add on)<br><br>";

		echo "destcity: " . $_SESSION['neardestcity'] . "<br>";
		echo "dest_addon: $dest_addon<br>";
		echo "Destination Zip_over 1k Bump:  $dest_addon1k<br><br>";
		echo "<b>price_postdestaddon: $price_postdestrate</b>(after destination zip code add on)<br><br>";





 		echo "originrateadjust2 (state override): $originrateadjust2";
 		if (!empty($staterateadjustmsg)) {
 		   echo " / (Override Not Eligible)";
 		}
 		echo "<br>";
		echo "<b>price_postoriginstate: $price_postoriginstate</b>(after origin state adjustment)<br><br>";
		
		echo "destrateadjust2 (state override): $destrateadjust2";
		if (!empty($staterateadjustmsg)) {
 		   echo " / (Override Not Eligible)";
 		}
 		echo "<br>";
		echo "<b>price_postdeststate: $price_postdeststate</b>(after destination state adjustment)<br><br>";


 
        echo "specialcircumstance_adjust: $specialcircumstance_adjust<br>";
		echo "<b>price_poststatecirc: $price_poststatecirc</b>(after special circumstance add on)<br><br>";

 
		echo "Add-on for enclosed trailer (enclosurerate): $enclosurerate<br><br>";

		echo "<b>roundedtotal: $roundedtotal</b> (Round UP to the next $25)<br><br>";
		echo "DEATDeposit: $DEATDeposit<br><br>";
		echo "<b>totalprice2: $totalprice2</b> (after origin/dest adjustment and $" . $DEATDeposit . " deposit)<br><hr>";
		echo "</div>";
	}

    //Return total price.
	return $totalprice2;
}
    
?>