<?php

    

/**

 * Load the parent style.css file

 */

function total_child_enqueue_parent_theme_style() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    //wp_enqueue_script( 'main', '/wp-content/themes/atdv2/js/main.js', array(), '1.0.0', false );

/*

	wp_enqueue_script( 'fancybox', '/wp-content/themes/atdv2/js/fancybox/jquery.fancybox.pack.js', array(), '2.1.5', true );

	wp_enqueue_style(  'fancyboxcss', '/wp-content/themes/atdv2/js/fancybox/jquery.fancybox.css' );  

*/

}

add_action( 'wp_enqueue_scripts', 'total_child_enqueue_parent_theme_style' );





include('service-pricequote.php');



add_action('init', function()

{

    add_rewrite_rule('([^/]+)/([^/]+)/?$-shipping-services', 'index.php?post_type=states&name=$matches[1]', 'top');

}, 0, 0);



// ATD Constants

$DEATDepositInitial=125;

$expeditedrate=125;

$rushrate=250;



$nonrunning=200;



$expeditedratev2=50;

$rushratev2=100;





function post($var)

{

  if(isset($_POST[$var]))

  return $_POST[$var];

}



function get($var)

{

  if(isset($_GET[$var]))

  return $_GET[$var];

}



function session($var)

{

  if(isset($_SESSION[$var]))

  return $_SESSION[$var];

}



function postdb($var)

{
	
  if(isset($_POST[$var]))

  return sanitize_text_field($_POST[$var]);

}



function getdb($var)

{

  if(isset($_GET[$var]))

  return sanitize_text_field($_GET[$var]);

}





function quoteform_func() {

	  include('quote-multiple.php');

}

add_shortcode( 'quoteform', 'quoteform_func' );





function calcdeposit($carrieramount) {

    global $DEATDepositInitial;

    if (!empty($carrieramount)) {

        if ($carrieramount < 500) {

            $DEATDeposit = 175;

        } elseif ($carrieramount >= 500 && $carrieramount <= 9999) {

            $DEATDeposit = 195;

        }

        $_SESSION['DEATDeposit'] = $DEATDeposit;

        return $DEATDeposit;

    } else {

        return $DEATDepositInitial;

    }

}



//v4 starting 9/1/2021

function calcdepositv2($carrieramount) {

    global $DEATDepositInitial;

    if (!empty($carrieramount)) {

        if ($carrieramount < 199) {

            $DEATDeposit = 159;

        } elseif ($carrieramount >= 200 && $carrieramount <= 299) {

            $DEATDeposit = 169;

        } elseif ($carrieramount >= 300 && $carrieramount <= 399) {

            $DEATDeposit = 179;

        } elseif ($carrieramount >= 400 && $carrieramount <= 499) {

            $DEATDeposit = 189;

        } elseif ($carrieramount >= 500 && $carrieramount <= 599) {

            $DEATDeposit = 199;

        } elseif ($carrieramount >= 600 && $carrieramount <= 699) {

            $DEATDeposit = 209;

        } elseif ($carrieramount >= 700 && $carrieramount <= 799) {

            $DEATDeposit = 219;

        } elseif ($carrieramount >= 800 && $carrieramount <= 899) {

            $DEATDeposit = 229;

        } elseif ($carrieramount >= 900 && $carrieramount <= 999) {

            $DEATDeposit = 239;

        } elseif ($carrieramount >= 1000 && $carrieramount <= 1099) {

            $DEATDeposit = 264;

        } elseif ($carrieramount >= 1100 && $carrieramount <= 1199) {

            $DEATDeposit = 279;

        } elseif ($carrieramount >= 1200 && $carrieramount <= 1299) {

            $DEATDeposit = 294;

        } elseif ($carrieramount >= 1300 && $carrieramount <= 1399) {

            $DEATDeposit = 309;

        } elseif ($carrieramount >= 1400 && $carrieramount <= 1499) {

            $DEATDeposit = 314;

        } elseif ($carrieramount >= 1500 && $carrieramount <= 1599) {

            $DEATDeposit = 329;

        } elseif ($carrieramount >= 1600 && $carrieramount <= 1699) {

            $DEATDeposit = 344;

        } elseif ($carrieramount >= 1700 && $carrieramount <= 1799) {

            $DEATDeposit = 369;

        } elseif ($carrieramount >= 1800 && $carrieramount <= 1899) {

            $DEATDeposit = 384;

        } elseif ($carrieramount >= 1900 && $carrieramount <= 1999) {

            $DEATDeposit = 399;

        } elseif ($carrieramount >= 2000 && $carrieramount <= 2299) {

            $DEATDeposit = 439;

        } elseif ($carrieramount >= 2300 && $carrieramount <= 2499) {

            $DEATDeposit = 479;

        } elseif ($carrieramount >= 2500 && $carrieramount <= 2699) {

            $DEATDeposit = 529;

        } elseif ($carrieramount >= 2700 && $carrieramount <= 2999) {

            $DEATDeposit = 569;

        } elseif ($carrieramount >= 3000 && $carrieramount <= 3499) {

            $DEATDeposit = 699;

        } elseif ($carrieramount >= 3500 && $carrieramount <= 3999) {

            $DEATDeposit = 849;

        } elseif ($carrieramount >= 4000 && $carrieramount <= 4499) {

            $DEATDeposit = 999;

        } elseif ($carrieramount >= 4500 && $carrieramount <= 4999) {

            $DEATDeposit = 1149;

        } elseif ($carrieramount >= 5000 && $carrieramount <= 5999) {

            $DEATDeposit = 1349;

        } elseif ($carrieramount >= 6000 && $carrieramount <= 6999) {

            $DEATDeposit = 1549;

        } elseif ($carrieramount >= 7000 && $carrieramount <= 7999) {

            $DEATDeposit = 1749;

        } elseif ($carrieramount >= 8000 && $carrieramount <= 8999) {

            $DEATDeposit = 1949;

        } elseif ($carrieramount >= 9000 ) {

            $DEATDeposit = 2149;

        } 

        $_SESSION['DEATDeposit'] = $DEATDeposit;

        return $DEATDeposit;

    } else {

        return $DEATDepositInitial;

    }

}



/*



//v3 starting 3/22/2021

function calcdepositv2($carrieramount) {

    global $DEATDepositInitial;

    if (!empty($carrieramount)) {

        if ($carrieramount < 199) {

            $DEATDeposit = 179;

        } elseif ($carrieramount >= 200 && $carrieramount <= 299) {

            $DEATDeposit = 189;

        } elseif ($carrieramount >= 300 && $carrieramount <= 399) {

            $DEATDeposit = 199;

        } elseif ($carrieramount >= 400 && $carrieramount <= 499) {

            $DEATDeposit = 209;

        } elseif ($carrieramount >= 500 && $carrieramount <= 599) {

            $DEATDeposit = 219;

        } elseif ($carrieramount >= 600 && $carrieramount <= 699) {

            $DEATDeposit = 229;

        } elseif ($carrieramount >= 700 && $carrieramount <= 799) {

            $DEATDeposit = 239;

        } elseif ($carrieramount >= 800 && $carrieramount <= 899) {

            $DEATDeposit = 249;

        } elseif ($carrieramount >= 900 && $carrieramount <= 999) {

            $DEATDeposit = 269;

        } elseif ($carrieramount >= 1000 && $carrieramount <= 1099) {

            $DEATDeposit = 289;

        } elseif ($carrieramount >= 1100 && $carrieramount <= 1199) {

            $DEATDeposit = 309;

        } elseif ($carrieramount >= 1200 && $carrieramount <= 1299) {

            $DEATDeposit = 329;

        } elseif ($carrieramount >= 1300 && $carrieramount <= 1399) {

            $DEATDeposit = 349;

        } elseif ($carrieramount >= 1400 && $carrieramount <= 1499) {

            $DEATDeposit = 369;

        } elseif ($carrieramount >= 1500 && $carrieramount <= 1599) {

            $DEATDeposit = 389;

        } elseif ($carrieramount >= 1600 && $carrieramount <= 1699) {

            $DEATDeposit = 409;

        } elseif ($carrieramount >= 1700 && $carrieramount <= 1799) {

            $DEATDeposit = 429;

        } elseif ($carrieramount >= 1800 && $carrieramount <= 1899) {

            $DEATDeposit = 449;

        } elseif ($carrieramount >= 1900 && $carrieramount <= 1999) {

            $DEATDeposit = 469;

        } elseif ($carrieramount >= 2000 && $carrieramount <= 2999) {

            $DEATDeposit = 489;

        } elseif ($carrieramount >= 3000 ) {

            $DEATDeposit = 699;

        } 

        $_SESSION['DEATDeposit'] = $DEATDeposit;

        return $DEATDeposit;

    } else {

        return $DEATDepositInitial;

    }

}





//v2 starting 12/31/2020

function calcdepositv2($carrieramount) {

    global $DEATDepositInitial;

    if (!empty($carrieramount)) {

        if ($carrieramount < 499) {

            $DEATDeposit = 189;

        } elseif ($carrieramount >= 500 && $carrieramount <= 599) {

            $DEATDeposit = 199;

        } elseif ($carrieramount >= 600 && $carrieramount <= 699) {

            $DEATDeposit = 209;

        } elseif ($carrieramount >= 700 && $carrieramount <= 799) {

            $DEATDeposit = 219;

        } elseif ($carrieramount >= 800 && $carrieramount <= 899) {

            $DEATDeposit = 229;

        } elseif ($carrieramount >= 900 && $carrieramount <= 999) {

            $DEATDeposit = 239;

        } elseif ($carrieramount >= 1000 && $carrieramount <= 1099) {

            $DEATDeposit = 249;

        } elseif ($carrieramount >= 1100 && $carrieramount <= 1199) {

            $DEATDeposit = 259;

        } elseif ($carrieramount >= 1200 && $carrieramount <= 1299) {

            $DEATDeposit = 269;

        } elseif ($carrieramount >= 1300 && $carrieramount <= 1399) {

            $DEATDeposit = 279;

        } elseif ($carrieramount >= 1400 && $carrieramount <= 1499) {

            $DEATDeposit = 289;

        } elseif ($carrieramount >= 1500 && $carrieramount <= 1599) {

            $DEATDeposit = 309;

        } elseif ($carrieramount >= 1600 && $carrieramount <= 1699) {

            $DEATDeposit = 329;

        } elseif ($carrieramount >= 1700 && $carrieramount <= 1799) {

            $DEATDeposit = 349;

        } elseif ($carrieramount >= 1800 && $carrieramount <= 1899) {

            $DEATDeposit = 369;

        } elseif ($carrieramount >= 1900 && $carrieramount <= 1999) {

            $DEATDeposit = 389;

        } elseif ($carrieramount >= 2000 && $carrieramount <= 2999) {

            $DEATDeposit = 499;

        } elseif ($carrieramount >= 3000 && $carrieramount <= 3999) {

            $DEATDeposit = 599;

        } 

        $_SESSION['DEATDeposit'] = $DEATDeposit;

        return $DEATDeposit;

    } else {

        return $DEATDepositInitial;

    }

}

*/



/*

//v1 from 11/24/20 - 12/31/2020

function calcdepositv2($carrieramount) {

    global $DEATDepositInitial;

    if (!empty($carrieramount)) {

        if ($carrieramount < 499) {

            $DEATDeposit = 179;

        } elseif ($carrieramount >= 500 && $carrieramount <= 599) {

            $DEATDeposit = 199;

        } elseif ($carrieramount >= 600 && $carrieramount <= 699) {

            $DEATDeposit = 209;

        } elseif ($carrieramount >= 700 && $carrieramount <= 799) {

            $DEATDeposit = 229;

        } elseif ($carrieramount >= 800 && $carrieramount <= 899) {

            $DEATDeposit = 249;

        } elseif ($carrieramount >= 900 && $carrieramount <= 999) {

            $DEATDeposit = 269;

        } elseif ($carrieramount >= 1000 && $carrieramount <= 1099) {

            $DEATDeposit = 289;

        } elseif ($carrieramount >= 1100 && $carrieramount <= 1199) {

            $DEATDeposit = 309;

        } elseif ($carrieramount >= 1200 && $carrieramount <= 1299) {

            $DEATDeposit = 329;

        } elseif ($carrieramount >= 1300 && $carrieramount <= 1399) {

            $DEATDeposit = 349;

        } elseif ($carrieramount >= 1400 && $carrieramount <= 1499) {

            $DEATDeposit = 369;

        } elseif ($carrieramount >= 1500 && $carrieramount <= 1599) {

            $DEATDeposit = 389;

        } elseif ($carrieramount >= 1600 && $carrieramount <= 1699) {

            $DEATDeposit = 409;

        } elseif ($carrieramount >= 1700 && $carrieramount <= 1799) {

            $DEATDeposit = 429;

        } elseif ($carrieramount >= 1800 && $carrieramount <= 1899) {

            $DEATDeposit = 449;

        } elseif ($carrieramount >= 1900 && $carrieramount <= 1999) {

            $DEATDeposit = 469;

        } elseif ($carrieramount >= 2000 && $carrieramount <= 2999) {

            $DEATDeposit = 489;

        } elseif ($carrieramount >= 3000 && $carrieramount <= 3999) {

            $DEATDeposit = 689;

        } 

        $_SESSION['DEATDeposit'] = $DEATDeposit;

        return $DEATDeposit;

    } else {

        return $DEATDepositInitial;

    }

}

*/





function redirect($url) {

    

    if(headers_sent()) {

        $string = '<script type="text/javascript">';

        $string .= 'window.location = "' .$url . '"';

        $string .= '</script>';

    

        echo $string;

    } else {

        if (isset($_SERVER['HTTP_REFERER']) AND ($url == $_SERVER['HTTP_REFERER']))

            header('Location: '.$_SERVER['HTTP_REFERER']);

        else

            header('Location: '.$url);

    }

    exit;

}



function getdistancev1($startzip,$endzip) {

    if (!empty($startzip) && !empty($endzip)) {

        $q = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=$startzip&destinations=$endzip&mode=driving&units=imperial&sensor=false";

        $json = file_get_contents($q);

        $details = json_decode($json, TRUE);

        

        $totalmeters = $details['rows'][0]['elements'][0]['distance']['value'];

        $totalmiles = $totalmeters * 0.000621371;

        $totalmiles = floor($totalmiles);

        return $totalmiles;

    }

}



function getdistancev2($startzip,$endzip) {

    global $wpdb;

    if (!empty($startzip) && !empty($endzip)) {

        $q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$startzip&destinations=$endzip&mode=driving&units=imperial&sensor=false&key=AIzaSyCN-MRUypklNqBY0cU1-MLqdnCzAlleEKs";

        $json = file_get_contents($q);

        $details = json_decode($json, TRUE);

        

        $totalmeters = $details['rows'][0]['elements'][0]['distance']['value'];

        $totalmiles = $totalmeters * 0.000621371;

        $totalmiles = floor($totalmiles);

        

        if ($totalmiles==0) {

            $sql = "select Latitude,Longitude from zipcodesv2 where ZipCode = '$startzip' limit 0,1";

        	$getorigin = $wpdb->get_row($sql,ARRAY_A);

        	if ($wpdb->num_rows == 0) {

        		$orgin_lat = 0;

        		$orgin_long = 0;

        	} else {

                $orgin_lat = $getorigin['Latitude'];

        		$orgin_long = $getorigin['Longitude'];

            }

            

            $sql = "select Latitude,Longitude from zipcodesv2 where ZipCode = '$endzip' limit 0,1";

        	$getdest = $wpdb->get_row($sql,ARRAY_A);

        	if ($wpdb->num_rows == 0) {

        		$dest_lat = 0;

        		$dest_long = 0;

        	} else {

                $dest_lat = $getdest['Latitude'];

        		$dest_long = $getdest['Longitude'];

            }

            

            if ($orgin_lat!=0 && $orgin_long!=0 && $dest_lat!=0 && $dest_long!=0) {

                $q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$orgin_lat,$orgin_long&destinations=$dest_lat,$dest_long&mode=driving&units=imperial&sensor=false&key=AIzaSyCN-MRUypklNqBY0cU1-MLqdnCzAlleEKs";

                $json = file_get_contents($q);

                $details = json_decode($json, TRUE);

                

                $totalmeters = $details['rows'][0]['elements'][0]['distance']['value'];

                $totalmiles = $totalmeters * 0.000621371;

                $totalmiles = floor($totalmiles);

            }

	    }

    

        return $totalmiles;

        

    }

}



function getdistance($startzip,$endzip) {

    global $wpdb;

    if (!empty($startzip) && !empty($endzip)) {

        $q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$startzip&destinations=$endzip&mode=driving&units=imperial&sensor=false&key=AIzaSyCN-MRUypklNqBY0cU1-MLqdnCzAlleEKs";

		$ch = curl_init(); 

		curl_setopt($ch, CURLOPT_URL, $q); 

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		$output = curl_exec($ch); 

		curl_close($ch);  



		$details = json_decode($output, TRUE);

        

        $totalmeters = $details['rows'][0]['elements'][0]['distance']['value'];

        $totalmiles = $totalmeters * 0.000621371;

        $totalmiles = floor($totalmiles);

        

        if ($totalmiles==0) {

            $sql = "select Latitude,Longitude from zipcodesv2 where ZipCode = '$startzip' limit 0,1";

        	$getorigin = $wpdb->get_row($sql,ARRAY_A);

        	if ($wpdb->num_rows == 0) {

        		$orgin_lat = 0;

        		$orgin_long = 0;

        	} else {

                $orgin_lat = $getorigin['Latitude'];

        		$orgin_long = $getorigin['Longitude'];

            }

            

            $sql = "select Latitude,Longitude from zipcodesv2 where ZipCode = '$endzip' limit 0,1";

        	$getdest = $wpdb->get_row($sql,ARRAY_A);

        	if ($wpdb->num_rows == 0) {

        		$dest_lat = 0;

        		$dest_long = 0;

        	} else {

                $dest_lat = $getdest['Latitude'];

        		$dest_long = $getdest['Longitude'];

            }

            

            if ($orgin_lat!=0 && $orgin_long!=0 && $dest_lat!=0 && $dest_long!=0) {

                $q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$orgin_lat,$orgin_long&destinations=$dest_lat,$dest_long&mode=driving&units=imperial&sensor=false&key=AIzaSyCN-MRUypklNqBY0cU1-MLqdnCzAlleEKs";

                $ch = curl_init(); 

				curl_setopt($ch, CURLOPT_URL, $q); 

				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

				$output = curl_exec($ch); 

				curl_close($ch);  

				

				$details = json_decode($output, TRUE);

                

                $totalmeters = $details['rows'][0]['elements'][0]['distance']['value'];

                $totalmiles = $totalmeters * 0.000621371;

                $totalmiles = floor($totalmiles);

            }

	    }

    

        return $totalmiles;

        

    }

}





function getdistance_dbonly($startzip,$endzip) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"http://www.autotransportdirect.com/services/distance/dbdistance.php");

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS,"startzip=".$startzip."&endzip=".$endzip);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $totalmiles = curl_exec ($ch);

    $totalmiles = floor($totalmiles);

    curl_close ($ch);    

    return $totalmiles;

}



function getClientIP() {



    if (isset($_SERVER)) {



        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))

            return $_SERVER["HTTP_X_FORWARDED_FOR"];



        if (isset($_SERVER["HTTP_CLIENT_IP"]))

            return $_SERVER["HTTP_CLIENT_IP"];



        return $_SERVER["REMOTE_ADDR"];

    }



    if (getenv('HTTP_X_FORWARDED_FOR'))

        return getenv('HTTP_X_FORWARDED_FOR');



    if (getenv('HTTP_CLIENT_IP'))

        return getenv('HTTP_CLIENT_IP');



    return getenv('REMOTE_ADDR');

}





Function GetStateAbbr($statename) {

	$statename = strtolower($statename);

	switch ($statename) {

		case "alabama": $stateabbr = "AL"; break;

		case "arkansas": $stateabbr = "AR"; break;

		case "arizona": $stateabbr = "AZ"; break;

		case "california": $stateabbr = "CA"; break;

		case "colorado": $stateabbr = "CO"; break;

		case "connecticut": $stateabbr = "CT"; break;

		case "washington dc": $stateabbr = "DC"; break;

		case "delaware": $stateabbr = "DE"; break;

		case "florida": $stateabbr = "FL"; break;

		case "georgia": $stateabbr = "GA"; break;

		case "iowa": $stateabbr = "IA"; break;

		case "idaho": $stateabbr = "ID"; break;

		case "illinois": $stateabbr = "IL"; break;

		case "indiana": $stateabbr = "IN"; break;

		case "kansas": $stateabbr = "KS"; break;

		case "kentucky": $stateabbr = "KY"; break;

		case "louisiana": $stateabbr = "LA"; break;

		case "massachusetts": $stateabbr = "MA"; break;

		case "maryland": $stateabbr = "MD"; break;

		case "maine": $stateabbr = "ME"; break;

		case "michigan": $stateabbr = "MI"; break;

		case "minnesota": $stateabbr = "MN"; break;

		case "missouri": $stateabbr = "MO"; break;

		case "mississippi": $stateabbr = "MS"; break;

		case "montana": $stateabbr = "MT"; break;

		case "north carolina": $stateabbr = "NC"; break;

		case "north dakota": $stateabbr = "ND"; break;

		case "nebraska": $stateabbr = "NE"; break;

		case "new hampshire": $stateabbr = "NH"; break;

		case "new jersey": $stateabbr = "NJ"; break;

		case "new mexico": $stateabbr = "NM"; break;

		case "nevada": $stateabbr = "NV"; break;

		case "new york": $stateabbr = "NY"; break;

		case "ohio": $stateabbr = "OH"; break;

		case "oklahoma": $stateabbr = "OK"; break;

		case "oregon": $stateabbr = "OR"; break;

		case "pennsylvania": $stateabbr = "PA"; break;

		case "rhode island": $stateabbr = "RI"; break;

		case "south carolina": $stateabbr = "SC"; break;

		case "south dakota": $stateabbr = "SD"; break;

		case "tennessee": $stateabbr = "TN"; break;

		case "texas": $stateabbr = "TX"; break;

		case "utah": $stateabbr = "UT"; break;

		case "virginia": $stateabbr = "VA"; break;

		case "vermont": $stateabbr = "VT"; break;

		case "washington": $stateabbr = "WA"; break;

		case "wisconsin": $stateabbr = "WI"; break;

		case "west Virginia": $stateabbr = "WV"; break;

		case "wyoming": $stateabbr = "WY"; break;

		default: $stateabbr = $statename;

	}

	return $stateabbr;

}



Function GetStateName($stateabbr) {

	$stateabbr = strtoupper($stateabbr);

	switch ($stateabbr) {

            case "AL": $statename = "Alabama"; break;   

            case "AR": $statename = "Arkansas"; break;

            case "AZ": $statename = "Arizona"; break;

            case "CA": $statename = "California"; break;

            case "CO": $statename = "Colorado"; break;

            case "CT": $statename = "Connecticut"; break;

            case "DC": $statename = "Washington DC"; break;

            case "DE": $statename = "Delaware"; break;

            case "FL": $statename = "Florida"; break;

            case "GA": $statename = "Georgia"; break;

            case "IA": $statename = "Iowa"; break;

            case "ID": $statename = "Idaho"; break;

            case "IL": $statename = "Illinois"; break;

            case "IN": $statename = "Indiana"; break;

            case "KS": $statename = "Kansas"; break;

            case "KY": $statename = "Kentucky"; break;

            case "LA": $statename = "Louisiana"; break;

            case "MA": $statename = "Massachusetts"; break;

            case "MD": $statename = "Maryland"; break;

            case "ME": $statename = "Maine"; break;

            case "MI": $statename = "Michigan"; break;

            case "MN": $statename = "Minnesota"; break;

            case "MO": $statename = "Missouri"; break;

            case "MS": $statename = "Mississippi"; break;

            case "MT": $statename = "Montana"; break;

            case "NC": $statename = "North Carolina"; break;

            case "ND": $statename = "North Dakota"; break;

            case "NE": $statename = "Nebraska"; break;

            case "NH": $statename = "New Hampshire"; break;

            case "NJ": $statename = "New Jersey"; break;

            case "NM": $statename = "New Mexico"; break;

            case "NV": $statename = "Nevada"; break;

            case "NY": $statename = "New York"; break;

            case "OH": $statename = "Ohio"; break;

            case "OK": $statename = "Oklahoma"; break;

            case "OR": $statename = "Oregon"; break;

            case "PA": $statename = "Pennsylvania"; break;

            case "RI": $statename = "Rhode Island"; break;

            case "SC": $statename = "South Carolina"; break;

            case "SD": $statename = "South Dakota"; break;

            case "TN": $statename = "Tennessee"; break;

            case "TX": $statename = "Texas"; break;

            case "UT": $statename = "Utah"; break;

            case "VA": $statename = "Virginia"; break;

            case "VT": $statename = "Vermont"; break;

            case "WA": $statename = "Washington"; break;

            case "WI": $statename = "Wisconsin"; break;

            case "WV": $statename = "West Virginia"; break;

            case "WY": $statename = "Wyoming"; break;

		default: $statename = $stateabbr;

	}

	return $statename;

}





Function GetRatingRep($startzip,$endzip,$distance) {

    global $wpdb;

    $startzip3 = substr($startzip, 0, 3);

    $endzip3 = substr($endzip, 0, 3);



	$sql = "select originrateperc_low,originrateperc from ziprateadjust where partialzip = '$startzip3'";

	$getorigin = $wpdb->get_row($sql,ARRAY_A);

	if ($wpdb->num_rows == 0) {

		$originrateadjust_low = 0;

		$originrateadjust = 0;

	} else {

        if (empty($getstart['originrateperc_low'])) {

			$originrateadjust_low = 0;

		} else {

			$originrateadjust_low = $getorigin['originrateperc_low'];

		}

		

		if (empty($getstart['originrateperc'])) {

			$originrateadjust = 0;

		} else {

			$originrateadjust = $getorigin['originrateperc'];

		}  	

    }

	



	$sql = "select destrateperc_low,destrateperc from ziprateadjust where partialzip = '$endzip3'";

	$getdest = $wpdb->get_row($sql,ARRAY_A);

	if ($wpdb->num_rows == 0) {

		$destrateadjust_low = 0;

		$destrateadjust = 0;

	} else {

        if (empty($getstart['destrateperc_low'])) {

			$destrateadjust_low = 0;

		} else {

			$destrateadjust_low = $getdest['destrateperc_low'];

		}

		

		if (empty($getstart['destrateperc'])) {

			$destrateadjust = 0;

		} else {

			$destrateadjust = $getdest['destrateperc'];

		}  	

    }





	if ($distance <= 1400) {

		$GetRatingRep = $originrateadjust_low + $destrateadjust_low;

    } else {

		$GetRatingRep = $originrateadjust + $destrateadjust;

	}

    return $GetRatingRep;

}



function splitstate($state,$zipcode) {

    if (is_numeric($zipcode)) {

        $zipcode3 = substr($zipcode,0,3);

        $zipcode4 = substr($zipcode,0,4);

        if ($state=="CA") {



			

			

            if (($zipcode >= 90000 && $zipcode <= 91800) || ($zipcode >= 92600 && $zipcode <= 92800)) {

                //900,901,902,903,904,905,906,907,908,909,910,911,912,913,914,915,916,917,918,926,927,928

                $state = "CA-LABASIN";

            } elseif ($zipcode3 == 919 || $zipcode3 == 920 || $zipcode3 == 921 || $zipcode3 == 924 || $zipcode3 == 925) {

	            //919,920,921,924,925

                $state = "CA-SDPS";

            } elseif ($zipcode3 == 922 || $zipcode3 == 923 || $zipcode3 == 935) {

	            //922,923,935

                $state = "CA-DES";

            } elseif ($zipcode3 == 930 || $zipcode3 == 931 || $zipcode3 == 934 || $zipcode3 == 939 || $zipcode3 == 950) {

	            //930,931,934,939,950

                $state = "CA-PC";

            } elseif (($zipcode >= 94000 && $zipcode <= 94999) || $zipcode3 == 954 || $zipcode3 == 951) {

	            //940,941,942,943,944,945,946,947,948,949,951,954

                $state = "CA-BAY";

            } elseif ($zipcode3 == 932 || $zipcode3 == 933 || $zipcode3 == 936 || $zipcode3 == 937 || $zipcode3 == 938 || $zipcode3 == 952 || $zipcode3 == 953 || $zipcode3 == 956 || $zipcode3 == 957 || $zipcode3 == 958) {

	            //932,933,936,937,938,952,953,956,957,958

                $state = "CA-CENVAL";

            } elseif ($zipcode3 == 955 || $zipcode3 == 959 || $zipcode3 == 960 || $zipcode3 == 961) {

	            //955,959,960,961

                $state = "CA-NORTHERN";

            } else {

                $state = "CA";

            }

            

            

        } elseif ($state=="TX") {

            if (

                $zipcode3 == 750 || 

                $zipcode3 == 751 ||

                $zipcode3 == 752 ||

                $zipcode3 == 753 ||

                $zipcode3 == 760 ||

                $zipcode3 == 761

                ) {

	                

	            //750,751,752,753,760,761

                $state = "TX-E";

            } elseif ($zipcode3 == 763 || $zipcode3 == 764 || $zipcode3 == 768 || $zipcode3 == 769 || $zipcode3 == 780 || $zipcode3 == 783 || $zipcode3 == 784 || $zipcode3 == 785 || $zipcode3 == 788 || $zipcode3 == 790 || $zipcode3 == 791 || $zipcode3 == 792 || $zipcode3 == 793 || $zipcode3 == 794 || $zipcode3 == 795 || $zipcode3 == 796 || $zipcode3 == 797 || $zipcode3 == 798 || $zipcode3 == 799 || $zipcode3 == 885) {

	            //763,764,768,769,780,783,784,785,788,790,791,792,793,794,795,796,797,798,799,885

                $state = "TX-W";

            } else {

                $state = "TX";

            }

        } elseif ($state=="FL") {

            if ($zipcode3 == 320 || ($zipcode >= 32300 && $zipcode <= 32699)) {

	            //320,323,324,325,326

                $state = "FL-PAN";

            } else {

                $state = "FL";

            }

        } elseif ($state=="GA") {

            if ($zipcode3 == 300 || $zipcode3 == 301 || $zipcode3 == 302 || $zipcode3 == 303) {

	            //300,301,302,303

                $state = "GA-ATL";

            } else {

                $state = "GA";

            }

        } elseif ($state=="IL") {

            if ($zipcode3 == 600 || $zipcode3 == 601 || $zipcode3 == 602 || $zipcode3 == 603 || $zipcode3 == 604 || $zipcode3 == 605 || $zipcode3 == 606 || $zipcode3 == 607 || $zipcode3 == 608) {

	            //600,601,602,603,604,605,606,607,608

                $state = "IL-CHI";

            } else {

                $state = "IL";

            }

        } elseif ($state=="AZ") {

            if ($zipcode3 == 850 || $zipcode3 == 852 || $zipcode3 == 853 || $zipcode3 == 857) {

	            //850,852,853,857

                $state = "AZ-PHXTUC";

            } else {

                $state = "AZ";

            }

        } elseif ($state=="MI") {

            if ($zipcode3 == 486 || $zipcode3 == 487 || $zipcode3 == 496 || $zipcode3 == 497 || $zipcode3 == 498 || $zipcode3 == 499) {

	            //486,487,496,497,498,499

                $state = "MI-UP";

            } else {

                $state = "MI";

            }

        } elseif ($state=="MN") {

            if ($zipcode3 == 556 || $zipcode3 == 557 || $zipcode3 == 558 || $zipcode3 == 561 || $zipcode3 == 562 || $zipcode3 == 563 || $zipcode3 == 564 || $zipcode3 == 565 || $zipcode3 == 566 || $zipcode3 == 567) {

	            //556,557,558,561,562,563,564,565,566,567

                $state = "MN-UP";

            } else {

                $state = "MN";

            }

        } elseif ($state=="WI") {

            if ($zipcode3 == 541 || $zipcode3 == 542 || $zipcode3 == 543 || $zipcode3 == 544 || $zipcode3 == 545 || $zipcode3 == 547 || $zipcode3 == 548 || $zipcode3 == 549) {

	            //541,542,543,544,545,547,548,549

                $state = "WI-UP";

            } else {

                $state = "WI";

            }

        } elseif ($state=="OH") {

            if ($zipcode3 == 437 || $zipcode3 == 439 || $zipcode3 == 456 || $zipcode3 == 457) {

	            //437,439,456,457

                $state = "OH-SE";

            } else {

                $state = "OH";

            }

        } elseif ($state=="NV") {

            if ($zipcode3 == 890 || $zipcode3 == 891) {

	            //890,891

                $state = "NV-LAS";

            } else {

                $state = "NV";

            }

        } elseif ($state=="NY") {

            if ($zipcode >= 12800 && $zipcode <= 14999) {

	            //128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149

                $state = "NY-UP";

            } elseif ($zipcode3 == 100 || $zipcode3 == 101 || $zipcode3 == 102 || $zipcode3 == 104 || $zipcode3 == 110 || $zipcode3 == 111 || $zipcode3 == 112 || $zipcode3 == 113 || $zipcode3 == 114 || $zipcode3 == 115 || $zipcode3 == 116 || $zipcode3 == 117 || $zipcode3 == 118 || $zipcode3 == 119) {

	            //100,101,102,104,110,111,112,113,114,115,116,117,118,119

                $state = "NY-LI";

            } else {

                $state = "NY";

            }

        } elseif ($state=="PA") {

            if (($zipcode >= 15500 && $zipcode <= 17099) || $zipcode3 == 172 || $zipcode3 == 177 || $zipcode3 == 178 || $zipcode3 == 179 || $zipcode3 == 186 || $zipcode3 == 188) {

	            //155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,172,177,178,179,186,188

                $state = "PA-UP";

            } else {

                $state = "PA";

            }

        } elseif ($state=="CO") {

            if ($zipcode3 == 800 || $zipcode3 == 801 || $zipcode3 == 802 || $zipcode3 == 805 || $zipcode3 == 809) {

	            //800,801,802,805,809

                $state = "CO-DEN";

            } else {

                $state = "CO";

            }

        } elseif ($state=="UT") {

            if ($zipcode3 == 840 || $zipcode3 == 841) {

	            //840,841

                $state = "UT-SLC";

            } else {

                $state = "UT";

            }

        } elseif ($state=="OR") {

            if ($zipcode3 == 970 || $zipcode3 == 972) {

	            //970,972

                $state = "OR-PORT";

            } else {

                $state = "OR";

            }

        } elseif ($state=="WA") {

            if ($zipcode3 == 980 || $zipcode3 == 981 || $zipcode3 == 984) {

	            //980,981,984

                $state = "WA-SEA";

            } else {

                $state = "WA";

            }

        }

    }

    return $state;

}



function roundUpToAny($n,$x=25) {

    return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;

}



function GetIP() {

    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)

    {

        if (array_key_exists($key, $_SERVER) === true)

        {

            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip)

            {

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)

                {

                    return $ip;

                }

            }

        }

    }

}



function CheckBan($ip_number,$guid) {

    global $wpdb;

	$CheckBan = "0";



	//BANNED GUID CHECK begin

	$sql = "SELECT count(guid) as guidcount from banlist where active = 1 and guid = '$guid'";

	$RsGUIDBan = $wpdb->get_row($sql,ARRAY_A);

	$guidcount = $RsGUIDBan['guidcount'];



	if ($guidcount > 0) {

		$CheckBan = "1";

	}

	//BANNED GUID CHECK end if



	//BANNED IP CHECK begin

	$foundbannedip = 0;



	//Try to find an IP in the ban list that starts with the same 5 characters

	$sql = "SELECT ipnumber from ip_ban where active = 1 and left(ipnumber,5) = '" . substr($ip_number,0,5) . "' order by ipnumber";

	$RsIPBan = $wpdb->get_results($sql,ARRAY_A);



    foreach ($RsIPBan as $RsIPBan_field) {

		$currentip = $RsIPBan_field['ipnumber'];

		$lencurrentip = strlen($RsIPBan_field['ipnumber']);





		if ($currentip == $ip_number) {

			$foundbannedip = 1;

			$foundbannedipnumber = $currentip;

		} else {

			//Split up the IP from the database

			$foundiplist=explode(".", $currentip);

			$foundip1=$foundiplist[0];

			$foundip2=$foundiplist[1];

			$foundip3=$foundiplist[2];

			$foundip4=$foundiplist[3];



			//Split up the user's IP

			$currentiplist=explode(".", $ip_number);

			$currentip1=$currentiplist[0];

			$currentip2=$currentiplist[1];

			$currentip3=$currentiplist[2];

			$currentip4=$currentiplist[3];



			//Find the number difference in the 3rd section of the IP

			$ip3diff = $currentip3 - $foundip3;



			//See if the first and second section match.  Also, see if there is more than a 5 number difference in the 3rd section.

			if ($foundip1 == $currentip1 && $foundip2 == $currentip2 && ($ip3diff >= -3 && $ip3diff <= 3)) {

				$sql = "SELECT count(ipnumber) as ipcount from ip_ban where active = 1 and ipnumber = '$currentip' and dateupdated BETWEEN CURDATE() - INTERVAL 3 DAY AND NOW()";

				$RsIPBan2 = $wpdb->get_row($sql,ARRAY_A);

				$ipcount = $RsIPBan2['ipcount'];



				//echo "ipcount: $ipcount & "<hr>"



				if ($ipcount > 0) {

					$foundbannedip = 1;

					$pang_secondary = 1;

					$foundbannedipnumber = $currentip;

				}

			}

		}





	}





	if ($foundbannedip == 1) {

		$CheckBan = "1";

	}

	//BANNED IP CHECK End











	//See if your IP and/or GUID is protected.  If it is, All is Good

	if ($CheckBan == "1") {



		$sql = "SELECT count(guid) as guidcount from deat_guids where guid='$guid'";

		$RsCheckProtected = $wpdb->get_row($sql,ARRAY_A);

	    $guidcount = $RsCheckProtected['guidcount'];

		if ($guidcount > 0) {

			$CheckBan = "0";

		} else {

			$sql = "UPDATE banlist SET pangs = pangs + 1 WHERE guid = '$guid'";

			$wpdb->query($sql);

		}



		$sql = "SELECT count(ipnumber) as ipcount from deat_ips where ipnumber='$ip_number'";

        $RsCheckProtected = $wpdb->get_row($sql,ARRAY_A);

	    $ipcount = $RsCheckProtected['ipcount'];



		if ($ipcount > 0) {

			$CheckBan = "0";

		} else {

			if ($pang_secondary == 1) {

				$sql = "UPDATE ip_ban SET pang_secondary = pang_secondary + 1 WHERE ipnumber = '$foundbannedipnumber'";

			} else {

				$sql = "UPDATE ip_ban SET pangs = pangs + 1 WHERE ipnumber = '$foundbannedipnumber'";

			}

			$wpdb->query($sql);

		}





	}

	

	return $CheckBan;

}



function GetCancelPerc($zipcode,$zipfield,$debug) {

	global $wpdb;

	

	$zipcode3 = substr($zipcode,0,3);

	

	$sql = "select orderid from orders where left($zipfield,3) = '$zipcode3' and (status = 'CANCELLED'  or status = 'ASSIGNED') order by orderid desc limit 0,100";

	$GetIDs = $wpdb->get_results($sql,ARRAY_A);

    $orderids = "";

    

    $orderids = array();

    foreach ($GetIDs as $GetID) {

    	array_push($orderids, $GetID['orderid']);

    }



	if (count($orderids) > 0) {

    	

    	$orderids_csv = implode(",", $orderids);

		

		$sql = "select count(orderid) as numrec from orders where status='ASSIGNED' and orderid IN ($orderids_csv)";

		$GetAssigned = $wpdb->get_row($sql,ARRAY_A);

        $assigned = $GetAssigned['numrec'];

		

	   	$sql = "select count(orderid) as numrec from orders where status='CANCELLED' and orderid IN ($orderids_csv)";

	   	$GetCancelled = $wpdb->get_row($sql,ARRAY_A);

	   	$cancelled = $GetCancelled['numrec'];



	} else {

		$assigned = 0;

		$cancelled = 0;

	}



	$totalorders = $assigned + $cancelled;



	$cancelavg = 0;

	$assignedavg = 0;



	if ($totalorders != 0) {

		$cancelavg = ($cancelled / $totalorders) * 100;

		$assignedavg = ($assigned / $totalorders) * 100;



		$cancelavg = floor($cancelavg);

		$assignedavg = floor($assignedavg);

	}





	if ($debug == 1) {

		echo "Zip: $zipcode<br>";

		echo "ZipField: $zipfield<br>";

		echo "Assigned: $assigned<br>";

		echo "Cancelled: $cancelled<br>";

		echo "Total Orders: $totalorders<br>";

		echo "Cancel Perc: $cancelavg %<br>";

		echo "Assigned Perc: $assignedavg %<br>";

	}



	return $assignedavg;

}





function avgDaysWaiting($pickupdel,$stateabbr) {

    global $wpdb;

    

    $sql = "SELECT	OrderID, DateAvailable, CarrierExpectedPickupDate, DATEDIFF(CarrierExpectedPickupDate,DateAvailable) AS DaysWaiting

        from	orders  

        where	DateAvailable between SUBDATE(current_date(),30) and current_date() and 

        		status='assigned' and 

        		$pickupdel='$stateabbr' and 

        		DateAvailable = DateAvailable_Initial and 

        		(DateAvailable_Initial is not null and DateAvailable is not null and CarrierExpectedPickupDate is not null) 

        order by orderid";

    $PickupDelStats = $wpdb->get_results($sql,ARRAY_A);

    

    $DaysWaitingPickupDel = 0;

    $DaysWaitingPickupDelTotalOrders = 0;

    foreach ($PickupDelStats as $PickupDelStats_field) {

        $DaysWaitingPickupDel = $DaysWaitingPickupDel + $PickupDelStats_field['DaysWaiting'];

        $DaysWaitingPickupDelTotalOrders ++;

    }

    

    

    if ($DaysWaitingPickupDel==0 || $DaysWaitingPickupDelTotalOrders==0) {

    	$DaysWaitingPickupDelAvg=0;

    } else {

    	$DaysWaitingPickupDelAvg = $DaysWaitingPickupDel/$DaysWaitingPickupDelTotalOrders;

    }

    

    return $DaysWaitingPickupDelAvg . '|' . $DaysWaitingPickupDelTotalOrders;

    

}





function AuditTrail($orderid,$username,$notes) {

    global $wpdb;

	$sql = "insert into audittrail (orderid,username,notes) values ($orderid,'$username','$notes')";

	$wpdb->query($sql);

}



Function CommAudit($orderid,$audit_category,$emailfrom,$emailto,$emailsubject,$emailbody) {

    global $wpdb;

    $sql = "insert into orders_comm_audit (orderid,audit_category,emailfrom,emailto,emailsubject,emailbody) values ($orderid,'$audit_category','$emailfrom','$emailto','$emailsubject','" . str_ireplace("'", "''", $emailbody) . "')";

	$wpdb->query($sql);

}





function DisplayRatingInfo ($zipadjustrating) {



	switch ($zipadjustrating) {

		case 0:

			$class0 = "ratingactive";

			break;

		case 3:

			$class3 = "ratingactive";

			break;

		case 6:

			$class6 = "ratingactive";

			break;

		case 9:

			$class9 = "ratingactive";

			break;

		case 12:

			$class12 = "ratingactive";

			break;

		case 15:

			$class15 = "ratingactive";

			break;

		case 18:

			$class18 = "ratingactive";

			break;

		case 21:

			$class21 = "ratingactive";

			break;

		case 24:

			$class24 = "ratingactive";

			break;

		case 27:

			$class27 = "ratingactive";

			break;

		case 30:

			$class30 = "ratingactive";

			break;

	}



	if ($zipadjustrating >= 33) {

		$class33 = "ratingactive";

		$activeratingverbose = $rating33;

	}

	$resptemp = "

	<style>.ratingactive {color:red; font-weight:bold}</style>

	Judging only this route (not vehicle type, weather, seasonal fluctuation or non-runners), the likelihood this order will ship in 1-7 days is ...<br><br>

	<span class='$class0'>Excellent</span> ... <span class='$class3'>Good</span> ... <span class='$class6'>Okay</span> ... <span class='$class9'>A Little Iffy</span> ... <span class='$class12'>Probably Will Take Longer</span> ... <span class='$class15'>Most Likely Will Take Longer</span> ... <span class='$class18'>Not Good</span> ... <span class='$class21'>Really Not Good</span> ... <span class='$class24'>Very Difficult</span> ... <span class='$class27'>Extremely Difficult</span> ... <span class='$class30'>Horrible</span> ... <span class='$class33'>Really Stinks</span>

	";

	return $resptemp;

	



}





function atdmail_old($type,$fromname,$fromemail,$toemail,$subject,$message) {

    // In case any of our lines are larger than 70 characters, we should use wordwrap()

    

    if ($type=='' || $type=='text') {

        $headers = 'From: ' . $fromname. ' <' . $fromemail . '>';

    } else {

        $headers  = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: ' . $fromname. ' <' . $fromemail . '>' . '\r\n';

    }



    // Send

    if (mail($toemail, $subject, $message, $headers)) {

        return true;

    } else {

        return false;

    }

}





function wpdocs_set_html_mail_content_type() {

    return 'text/html';

}



function atdmail($type,$fromname,$fromemail,$toemail,$subject,$message) {

	$headers = 'From: '.$fromname.' <'.$fromemail.'>' . "\r\n";

	

	if ($type!='text') {

		add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

	}

	

	wp_mail( $toemail, $subject, $message, $headers, $attachments );

}



// This is your function, you can name it anything you want

function quotebox() { 

	global $post;

	$show_quote_box = get_field('show_quote_box',$post->ID);

    if (! is_front_page()) {        

        if(is_page(26703) || is_page(26213) || is_page(472) || is_page(22906) || is_page(23785) || is_page(23827) || is_page(22712) || is_page(20342) || is_single()) {

	        // do nothing

        } else {

	        echo '<div class="subpagequotebox">';

            include('quote-multiple.php'); 

			echo '</div>';

			?>

			<script type="text/javascript">

			jQuery(document).ready(function() {

				if(jQuery(".entry-content .wpb_wrapper").length){

					jQuery(".subpagequotebox").prependTo(".entry-content .wpb_wrapper:first");

				} else {

					jQuery(".subpagequotebox").prependTo(".entry-content");

				}

			});

			</script>  

			

			

			<?php

			

			

        }

    } 

}









// This is the action function that outputs the function above into the theme hook

add_action( 'wpex_hook_content_bottom', 'quotebox', 999 );

add_shortcode( 'quotebox', 'quotebox' );







// This is your function, you can name it anything you want

function quotebox_page() { 

	global $post;

	$show_quote_box = get_field('show_quote_box',$post->ID);

        

	        echo '<div class="subpagequotebox" style="width:100%; float:none">';

            include('quote-multiple.php'); 

			echo '</div>';







}

add_shortcode( 'quotebox_page', 'quotebox_page' );





function quoteboxdev() { 

  include('quote-multiple-dev.php'); 

}

add_shortcode( 'quoteboxdev', 'quoteboxdev' );





function quotebox_v2() { 

  include('quote-1b.php'); 

}

add_shortcode( 'quotebox-v2', 'quotebox_v2' );



function quotebox_v3() { 

  include('quote-1b-dev.php'); 

}

add_shortcode( 'quotebox-v3', 'quotebox_v3' );





function quoteboxint() { 

    include('quote-multiple.php'); 

}

add_shortcode( 'quoteboxint', 'quoteboxint' );

function homepromo() { 

    include('homepromo.php'); 

}

add_shortcode( 'homepromo', 'homepromo' );

function quotehero() { 

    include('quotehero.php'); 

}

add_shortcode( 'quotehero', 'quotehero' );

function quotehero2021() { 

    include('quotehero2021.php'); 

}

add_shortcode( 'quotehero2021', 'quotehero2021' );

function quotehero2021_v2() { 

    include('quotehero2021-v2.php'); 

}

add_shortcode( 'quotehero2021-v2', 'quotehero2021_v2' );

function quotehero2021_v3() { 

    include('quotehero2021-v3.php'); 

}

add_shortcode( 'quotehero2021-v3', 'quotehero2021_v3' );


function quotehero2021_v4() { 

    include('quotehero2021-v4.php'); 

}

add_shortcode( 'quotehero2021-v4', 'quotehero2021_v4' );


function quotehero2021_v4_1() { 
    ob_start();
    require_once('quotehero2021-v4-2.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}

add_shortcode( 'quotehero2021-v4-1', 'quotehero2021_v4_1' );


function quotehero2021_v4_dev() { 

    include('quotehero2021-v4-dev.php'); 

}

add_shortcode( 'quotehero2021-v4-dev', 'quotehero2021_v4_dev' );





function quotemultiple() { 

    include('quote-multiple.php'); 

}

add_shortcode( 'quotemultiple', 'quotemultiple' );













function GetQuote16($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug) {

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





/*

  if ($_SESSION['rep'] == "claydough") {

    $debug = 1;

  }

*/

  

  //$debug = 1;



  if ($debug == 1) {

      echo "<div class='debuginfo'>";

    echo "<b>$auto_make - $auto_model</b><br>";

  }

  

  

  

  $response = QuoteCalc16($shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$auto_addon,$year_multiplier,$year_flatrate_low,$year_flatrate_high,$debug);

  

  

  return $response;

}  







function QuoteCalc16($shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$auto_addon,$year_multiplier,$year_flatrate_low,$year_flatrate_high,$debug) {

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

  $sql = "select * from pricing2 where milelow <= '$totaldistance' and milehigh >= '$totaldistance'";

  $getrates = $wpdb->get_row($sql,ARRAY_A);
var_dump($getrates);
  $flatrate = $getrates['flatrate'];

  $bymilerate = $getrates['bymilerate'];

  





  if (empty($flatrate) || $flatrate==0) {

    $totalprice1 = $totaldistance * $bymilerate;

    $totalprice0 = $totalprice1;

    

    $totalprice1 = $totalprice1 * $auto_priceadjustment;

      $totalprice1 = $totalprice1 + $auto_addon;

        



  } else {

    $totalprice1 = $flatrate;

    $totalprice0 = $totalprice1;

    

    $totalprice1 = $totalprice1 * $auto_priceadjustment;

      $totalprice1 = $totalprice1 + $auto_addon;



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

  

  $totalprice0 = number_format($totalprice0,2, '.', '');

  $totalprice1 = number_format($totalprice1,2, '.', '');

  



  //4. Check first X digits of zip code to make rate adjustments

    $shippingfromzip5 = substr($shippingfromzip,0,5);

    $shippingfromzip4 = substr($shippingfromzip,0,4); 

    $shippingfromzip3 = substr($shippingfromzip,0,3);

    $shippingtozip5 = substr($shippingtozip,0,5);

    $shippingtozip4 = substr($shippingtozip,0,4); 

    $shippingtozip3 = substr($shippingtozip,0,3);



  





  if($totaldistance > 0 && $totaldistance <= 499) {

    $currdistance = "Low";

  } elseif ($totaldistance >= 500 && $totaldistance <= 1199) {

    $currdistance = "Med";

  } elseif ($totaldistance >= 1200 && $totaldistance <= 1799) {

    $currdistance = "Reg";

  } elseif ($totaldistance >= 1800) {

    $currdistance = "High";

  }



  //Try 5 digits first

  $sql = "select addon,nearcity,RatePerc_$currdistance as RatePerc from ziprateadjust where partialzip = '$shippingfromzip5'";

  //echo $sql;

  $getrateadjust = $wpdb->get_row($sql,ARRAY_A);



    if ($wpdb->num_rows == 0) {

        $origin_rateperc = 0;

    $origin_match = 0;

  } else {

      $origin_rateperc = $getrateadjust['RatePerc'];

    $origincity = $getrateadjust['nearcity'];

    $origin_match = 1;

  }





    if ($origin_match == 0) {

      //Try 4 digits

      $sql = "select addon,nearcity,RatePerc_$currdistance as RatePerc from ziprateadjust where partialzip = '$shippingfromzip4'";

      $getrateadjust = $wpdb->get_row($sql,ARRAY_A);



      if ($wpdb->num_rows == 0) {

          $origin_rateperc = 0;

      $origin_match = 0;

    } else {

        $origin_rateperc = $getrateadjust['RatePerc'];

      $origincity = $getrateadjust['nearcity'];

      $origin_match = 1;

    }

    }



    if ($origin_match == 0) {

      $sql = "select addon,nearcity,RatePerc_$currdistance as RatePerc from ziprateadjust where partialzip = '$shippingfromzip3'";

      $getrateadjust = $wpdb->get_row($sql,ARRAY_A);



      if ($wpdb->num_rows == 0) {

          $origin_rateperc = 0;

      $origin_match = 0;

    } else {

        $origin_rateperc = $getrateadjust['RatePerc'];

      $origincity = $getrateadjust['nearcity'];

      $origin_match = 1;

    }

    }





    $sql = "select addon,nearcity,RatePerc_$currdistance as RatePerc from ziprateadjust where partialzip = '$shippingtozip5'";

    $getrateadjust = $wpdb->get_row($sql,ARRAY_A);

    if ($wpdb->num_rows == 0) {

        $dest_rateperc = 0;

    $dest_match = 0;

  } else {

      $dest_rateperc = $getrateadjust['RatePerc'];

    $destcity = $getrateadjust['nearcity'];

    $dest_match = 1;

  }





    if ($dest_match == 0) {

        $sql = "select addon,nearcity,RatePerc_$currdistance as RatePerc from ziprateadjust where partialzip = '$shippingtozip4'";

      $getrateadjust = $wpdb->get_row($sql,ARRAY_A);

        if ($wpdb->num_rows == 0) {

          $dest_rateperc = 0;

      $dest_match = 0;

    } else {

        $dest_rateperc = $getrateadjust['RatePerc'];

      $destcity = $getrateadjust['nearcity'];

      $dest_match = 1;

    }

    }



    if ($dest_match == 0) {

        $sql = "select addon,nearcity,RatePerc_$currdistance as RatePerc from ziprateadjust where partialzip = '$shippingtozip3'";

      $getrateadjust = $wpdb->get_row($sql,ARRAY_A);

        if ($wpdb->num_rows == 0) {

          $dest_rateperc = 0;

      $dest_match = 0;

    } else {

        $dest_rateperc = $getrateadjust['RatePerc'];

      $destcity = $getrateadjust['nearcity'];

      $dest_match = 1;

    }

    }



  //5. Figure the price based on the rate adjustments and save it as totalprice2





  $totalprice2 = $totalprice1 + ($totalprice1 * ($origin_rateperc/100));

  $price_postoriginrate = $totalprice2;

  $totalprice2 = $totalprice2 + ($totalprice2 * ($dest_rateperc/100));

    $price_postdestrate = $totalprice2;

  







  //8. STATE OVERRIDE: Get the originrateperc rates for the origin and destination states

  $sql = "select OriginRatePerc_$currdistance as OriginRatePerc from states where state = '$startstate'";

  $getoriginstate = $wpdb->get_row($sql,ARRAY_A);

  if ($wpdb->num_rows == 0) {

        $originrateadjust2 = 0;

  } else {

      if (is_null($getoriginstate['OriginRatePerc'])) {

      $originrateadjust2 = 0;

    } else {

        $originrateadjust2 = $getoriginstate['OriginRatePerc'];

    }

  }

      



  $sql = "select DestRatePerc_$currdistance as DestRatePerc from states where state = '$endstate'";

  $getdeststate = $wpdb->get_row($sql,ARRAY_A);

  if ($wpdb->num_rows == 0) {

        $destrateadjust2 = 0;

  } else {

      if (is_null($getdeststate['DestRatePerc'])) {

      $destrateadjust2 = 0;

    } else {

        $destrateadjust2 = $getdeststate['DestRatePerc'];

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

  $totalprice2 = $totalprice2 + ($totalprice2 * ($originrateadjust2/100));

  $price_postoriginstate = $totalprice2;

  $totalprice2 = $totalprice2 + ($totalprice2 * ($destrateadjust2/100));

  $price_postdeststate = $totalprice2;

  

  $price_postoriginstate = number_format($price_postoriginstate,2, '.', '');

  $price_postdeststate = number_format($price_postdeststate,2, '.', '');

  



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

  $price_poststatecirc = number_format($price_poststatecirc,2, '.', '');



  //Apply the tier multiplier

  $tierrate_std = 0;

  $tierrate_exp = 1.18;

  $tierrate_rush = 1.29;



  $totalprice2_std = $totalprice2 + $tierrate_std;

  $totalprice2_exp = ($totalprice2 * $tierrate_exp)+50;

  $totalprice2_rush = ($totalprice2 * $tierrate_rush)+75;

  

  

  $price_posttierrate_std = $totalprice2_std;

  $price_posttierrate_exp = $totalprice2_exp;

  $price_posttierrate_rush = $totalprice2_rush;



  $price_posttierrate_std = number_format($price_posttierrate_std,2, '.', '');

  $price_posttierrate_exp = number_format($price_posttierrate_exp,2, '.', '');

  $price_posttierrate_rush = number_format($price_posttierrate_rush,2, '.', '');





  //Add enclosure rates if applicable

  $enclosurerate = 0;

  if ($enclosed == "1") {

    $enclosurerate_std = $totalprice2_std * .60;

    $enclosurerate_exp = $totalprice2_exp * .60;

    $enclosurerate_rush = $totalprice2_rush * .60;

    $totalprice2_std = $totalprice2_std + $enclosurerate_std;

    $totalprice2_exp = $totalprice2_exp + $enclosurerate_exp;

    $totalprice2_rush = $totalprice2_rush + $enclosurerate_rush;

  }





  //10. Round the rate to the next $25 increment

  $totalprice2_std = roundUpToAny($totalprice2_std);

  $totalprice2_exp = roundUpToAny($totalprice2_exp);

  $totalprice2_rush = roundUpToAny($totalprice2_rush);

  $roundedtotal_std = $totalprice2_std;

  $roundedtotal_exp = $totalprice2_exp;

  $roundedtotal_rush = $totalprice2_rush;







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

    $DEATDeposit_std = calcdepositv2($totalprice2_std);

    $DEATDeposit_exp = calcdepositv2($totalprice2_exp);

    $DEATDeposit_rush = calcdepositv2($totalprice2_rush);







  //13. Add the deposit to the quote

  $totalprice2_std = $totalprice2_std + $DEATDeposit_std;

  $totalprice2_exp = $totalprice2_exp + $DEATDeposit_exp;

  $totalprice2_rush = $totalprice2_rush + $DEATDeposit_rush;





    //$debug="1";

  //15 Print debug info to the screen

  if ($debug == "1") {



    $url = "http://www.centraldispatch.com/protected/listing-search/result?pickupAreas%5B%5D=state_USA_$startstatevirgin&pickupRadius=25&pickupCity=&pickupState=&pickupZip=&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$endstatevirgin&deliveryRadius=25&deliveryCity=&deliveryState=&deliveryZip=&Destination_valid=1&vehicleTypeIds%5B%5D=4&trailerType=Open&vehiclesRun=1&minVehicles=1&maxVehicles=1&shipWithin=60&paymentType=&minPayPrice=&minPayPerMile=&highlightPeriod=0&listingsPerPage=500&postedBy=&primarySort=1&secondarySort=4";





    

    echo "<hr style='margin:0;'>start zip: $shippingfromzip<br>";

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

    echo "<b>totalprice1: $totalprice1</b> (after multipliers, before zip code adjustment)<br><br>";



    echo "<b>currdistance: " . $currdistance . "</b><br><br>";

    

    echo "origin_rateperc: $origin_rateperc<br>";

    echo "<b>price_postoriginaddon: $price_postoriginrate</b> (after origin zip code add on)<br><br>";



    echo "dest_rateperc: $dest_rateperc<br>";

    echo "<b>price_postdestaddon: $price_postdestrate</b> (after destination zip code add on)<br><br>";



     echo "originrateadjust2 (state override): $originrateadjust2";

     if (!empty($staterateadjustmsg)) {

        echo " / (Override Not Eligible)";

     }

     echo "<br>";

    echo "<b>price_postoriginstate: $price_postoriginstate</b> (after origin state adjustment)<br><br>";

    

    echo "destrateadjust2 (state override): $destrateadjust2";

    if (!empty($staterateadjustmsg)) {

        echo " / (Override Not Eligible)";

     }

     echo "<br>";

    echo "<b>price_postdeststate: $price_postdeststate</b> (after destination state adjustment)<br><br>";





        echo "specialcircumstance_adjust: $specialcircumstance_adjust<br>";

    echo "<b>price_poststatecirc: $price_poststatecirc</b> (after special circumstance add on)<br><br>";

    

  

    $tiername="Standard";

    $tiercolor="#ead1db";

        echo "<div style='display:inline-block;background-color:$tiercolor'><strong>Tier: $tiername</strong></div><br>";

    echo "tierrate_std: $tierrate_std<br>";

    echo "<b>price_posttierrate_std: $price_posttierrate_std</b> (after tier rate add on)<br>";



    echo "Add-on for enclosed trailer (enclosurerate_std): $enclosurerate_std<br>";

    echo "<b>roundedtotal_std: $roundedtotal_std</b> (Round UP to the next $25)<br>";

    echo "DEATDeposit_std: $DEATDeposit_std<br>";

    echo "<div style='display:inline-block;background-color:$tiercolor'><b>totalprice2_std: $totalprice2_std</b> (after origin/dest adjustment and $" . $DEATDeposit_std . " deposit)</div><br><br>";





    $tiername="Expedited";

    $tiercolor="#01ff00";	

    echo "<div style='display:inline-block;background-color:$tiercolor'><strong>Tier: $tiername</strong></div><br>";

    echo "tierrate_exp: $tierrate_exp<br>";

    echo "<b>price_posttierrate_exp: $price_posttierrate_exp</b> (after tier rate add on)<br>";

    

    echo "Add-on for enclosed trailer (enclosurerate_exp): $enclosurerate_exp<br>";

    echo "<b>roundedtotal_exp: $roundedtotal_exp</b> (Round UP to the next $25)<br>";

    echo "DEATDeposit_exp: $DEATDeposit_exp<br>";

    echo "<div style='display:inline-block;background-color:$tiercolor'><b>totalprice2_exp: $totalprice2_exp</b> (after origin/dest adjustment and $" . $DEATDeposit_exp . " deposit)</div><br><br>";

  

  

    $tiername="Rush";

    $tiercolor="#ffff00";

    echo "<div style='display:inline-block;background-color:$tiercolor'><strong>Tier: $tiername</strong></div><br>";

    echo "tierrate_rush: $tierrate_rush<br>";

    echo "<b>price_posttierrate_rush: $price_posttierrate_rush</b> (after tier rate add on)<br>";

    

    echo "Add-on for enclosed trailer (enclosurerate_rush): $enclosurerate_rush<br>";

    echo "<b>roundedtotal_rush: $roundedtotal_rush</b> (Round UP to the next $25)<br>";

    echo "DEATDeposit_rush: $DEATDeposit_rush<br>";

    echo "<div style='display:inline-block;background-color:$tiercolor'><b>totalprice2_rush: $totalprice2_rush</b> (after origin/dest adjustment and $" . $DEATDeposit_rush . " deposit)</div><hr>";









    echo "</div>";

  }



    //Return total price.

  return "$roundedtotal_std|$DEATDeposit_std|$totalprice2_std|$roundedtotal_exp|$DEATDeposit_exp|$totalprice2_exp|$roundedtotal_rush|$DEATDeposit_rush|$totalprice2_rush";

}


    























function GetQuote4($auto_year,$auto_make,$auto_model,$shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$debug) {

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

	

	//$debug = 1;



	if ($debug == 1) {

    	echo "<div class='debuginfo'>";

		echo "<b>$auto_make - $auto_model</b><br>";

	}

	

	

	

	$response = GetQuotev15($shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$auto_addon,$year_multiplier,$year_flatrate_low,$year_flatrate_high,$debug);

	

	

	

	return $response;

}  







function GetQuotev15($shippingfromzip,$shippingtozip,$enclosed,$auto_priceadjustment,$auto_addon,$year_multiplier,$year_flatrate_low,$year_flatrate_high,$debug) {

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





	//Apply the tier multiplier

	$tierrate_std = 0;

	$tierrate_exp = 1.20;

	$tierrate_rush = 1.35;



	$totalprice2_std = $totalprice2 + $tierrate_std;

	$totalprice2_exp = $totalprice2 * $tierrate_exp;

	$totalprice2_rush = $totalprice2 * $tierrate_rush;

	

	$price_posttierrate_std = $totalprice2_std;

	$price_posttierrate_exp = $totalprice2_exp;

	$price_posttierrate_rush = $totalprice2_rush;







	//Add enclosure rates if applicable

	$enclosurerate = 0;

	if ($enclosed == "1") {

		$enclosurerate_std = $totalprice2_std * .60;

		$enclosurerate_exp = $totalprice2_exp * .60;

		$enclosurerate_rush = $totalprice2_rush * .60;

		$totalprice2_std = $totalprice2_std + $enclosurerate_std;

		$totalprice2_exp = $totalprice2_exp + $enclosurerate_exp;

		$totalprice2_rush = $totalprice2_rush + $enclosurerate_rush;

	}





	//10. Round the rate to the next $25 increment

	$totalprice2_std = roundUpToAny($totalprice2_std);

	$totalprice2_exp = roundUpToAny($totalprice2_exp);

	$totalprice2_rush = roundUpToAny($totalprice2_rush);

	$roundedtotal_std = $totalprice2_std;

	$roundedtotal_exp = $totalprice2_exp;

	$roundedtotal_rush = $totalprice2_rush;







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

    $DEATDeposit_std = calcdepositv2($totalprice2_std);

    $DEATDeposit_exp = calcdepositv2($totalprice2_exp);

    $DEATDeposit_rush = calcdepositv2($totalprice2_rush);







	//13. Add the deposit to the quote

	$totalprice2_std = $totalprice2_std + $DEATDeposit_std;

	$totalprice2_exp = $totalprice2_exp + $DEATDeposit_exp;

	$totalprice2_rush = $totalprice2_rush + $DEATDeposit_rush;





    //$debug="1";

	//15 Print debug info to the screen

	if ($debug == "1") {



		$url = "http://www.centraldispatch.com/protected/listing-search/result?pickupAreas%5B%5D=state_USA_$startstatevirgin&pickupRadius=25&pickupCity=&pickupState=&pickupZip=&Origination_valid=1&deliveryAreas%5B%5D=state_USA_$endstatevirgin&deliveryRadius=25&deliveryCity=&deliveryState=&deliveryZip=&Destination_valid=1&vehicleTypeIds%5B%5D=4&trailerType=Open&vehiclesRun=1&minVehicles=1&maxVehicles=1&shipWithin=60&paymentType=&minPayPrice=&minPayPerMile=&highlightPeriod=0&listingsPerPage=500&postedBy=&primarySort=1&secondarySort=4";





		

		echo "<hr style='margin:0;'>start zip: $shippingfromzip<br>";

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

		

		

		

		

	

		$tiername="Standard";

		$tiercolor="#ead1db";

        echo "<div style='display:inline-block;background-color:$tiercolor'><strong>Tier: $tiername</strong></div><br>";

		echo "tierrate_std: $tierrate_std<br>";

		echo "<b>price_posttierrate_std: $price_posttierrate_std</b>(after tier rate add on)<br>";



		echo "Add-on for enclosed trailer (enclosurerate_std): $enclosurerate_std<br>";

		echo "<b>roundedtotal_std: $roundedtotal_std</b> (Round UP to the next $25)<br>";

		echo "DEATDeposit_std: $DEATDeposit_std<br>";

		echo "<div style='display:inline-block;background-color:$tiercolor'><b>totalprice2_std: $totalprice2_std</b> (after origin/dest adjustment and $" . $DEATDeposit_std . " deposit)</div><br><br>";





		$tiername="Expedited";

		$tiercolor="#01ff00";	

		echo "<div style='display:inline-block;background-color:$tiercolor'><strong>Tier: $tiername</strong></div><br>";

		echo "tierrate_exp: $tierrate_exp<br>";

		echo "<b>price_posttierrate_exp: $price_posttierrate_exp</b>(after tier rate add on)<br>";

		

		echo "Add-on for enclosed trailer (enclosurerate_exp): $enclosurerate_exp<br>";

		echo "<b>roundedtotal_exp: $roundedtotal_exp</b> (Round UP to the next $25)<br>";

		echo "DEATDeposit_exp: $DEATDeposit_exp<br>";

		echo "<div style='display:inline-block;background-color:$tiercolor'><b>totalprice2_exp: $totalprice2_exp</b> (after origin/dest adjustment and $" . $DEATDeposit_exp . " deposit)</div><br><br>";

	

	

		$tiername="Rush";

		$tiercolor="#ffff00";

		echo "<div style='display:inline-block;background-color:$tiercolor'><strong>Tier: $tiername</strong></div><br>";

		echo "tierrate_rush: $tierrate_rush<br>";

		echo "<b>price_posttierrate_rush: $price_posttierrate_rush</b>(after tier rate add on)<br>";

		

		echo "Add-on for enclosed trailer (enclosurerate_rush): $enclosurerate_rush<br>";

		echo "<b>roundedtotal_rush: $roundedtotal_rush</b> (Round UP to the next $25)<br>";

		echo "DEATDeposit_rush: $DEATDeposit_rush<br>";

		echo "<div style='display:inline-block;background-color:$tiercolor'><b>totalprice2_rush: $totalprice2_rush</b> (after origin/dest adjustment and $" . $DEATDeposit_rush . " deposit)</div><hr>";









		echo "</div>";

	}



    //Return total price.

	return "$roundedtotal_std|$DEATDeposit_std|$totalprice2_std|$roundedtotal_exp|$DEATDeposit_exp|$totalprice2_exp|$roundedtotal_rush|$DEATDeposit_rush|$totalprice2_rush";

}



























/******get cities data usa api*********/

function get_cities_description()

{



	$post_id = get_the_ID();

	$post_type = get_post_type($post_id);

	$post_title = get_the_title($post_id);



	if($post_type === 'city')

	{

	

		$datausa = get_post_meta( $post_id, 'datousa', true );

		

		if(!empty($datausa))

		{

			echo wpautop($datausa);

		}

		else

		{

			echo "<p>The most common employment industries in " . $post_title . " affect car shipping services. And the most common interstate trade partners have a direct correlation to auto transport carrier routes from and to" . $post_title . ". 

The median housing property value and household income in" . $post_title . " is also noteworthy to car transportation companies. As of 2019, the percentage of residents in" . $post_title . " who were US citizens, was not much different than the national average of 93.4%.</p>



<p>The average commute time in ".$post_title." may affect how many miles they drive per year, and how often they may buy a new or used car, which in turn affects car shipping services. It is also interesting to note the percentage of people who work from home in" . $post_title . ".</p>



<p>We also see how " . $post_title . " compares to the rest of the country in regards to car ownership. " . $post_title . " has approximately the same as the national average, with an average of 2 cars per household. More cars means more auto transport carriers to and from " . $post_title . ".</p>";



		}

		

	

	}





}



add_shortcode("get_cities_description", "get_cities_description"); 





/******get cities data usa api image for cities*********/



function get_cities_image_final()

{



	$post_id = get_the_ID();

	$post_type = get_post_type($post_id);

	$post_title = get_the_title($post_id);



	$post_title1 = explode(",",$post_title);



	

	$final_state = strtolower(trim($post_title1[1])); 

	

	//$final_image_url = "https://www.autotransportdirect.com/wp-content/uploads/2022/03/".$final_state."_County_Map_Direct_Express_Auto_Transport.png";

	$final_image_url = "https://www.autotransportdirect.com/states_maps/".$final_state."_County_Map_Direct_Express_Auto_Transport.png";

	

	if( $post_type == 'city' )

	{

		if(!empty($final_state)) 

		{

			echo '<img src="'.$final_image_url.'" alt="'.$post_title.'" class="citeis_description_image">';

		}

		else

		{

			echo '<img src="https://www.autotransportdirect.com/states_maps/wa_County_Map_Direct_Express_Auto_Transport.png" alt="'.$post_title.'" class="citeis_description_image">';

		}

	}	

}

add_shortcode("get_cities_image_final", "get_cities_image_final");


/******get cities data usa api image for cities*********/

function get_pages_titles()

{
    if(is_page('PWS landing page home'))

    {
        $title = '';
    }

    else

    {

        $title = get_the_title();

    }

    return $title;
}

add_shortcode("page_title","get_pages_titles");
