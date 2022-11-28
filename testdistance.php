<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

$startzip='94561';
$endzip='57719';

$totaldistance = getdistance($startzip,$endzip);

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

	?>