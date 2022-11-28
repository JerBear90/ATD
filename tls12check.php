<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);


		$ch = curl_init('https://www.howsmyssl.com/a/check');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$data = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($data);
		echo "TLS info: " . $json->tls_version;
		echo "<br>";
		$curl_info = curl_version();
		echo "Curl info: " . $curl_info['ssl_version'];	
		echo "<br>";
		//var_dump($data);
	?>