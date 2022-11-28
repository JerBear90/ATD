<?php
ini_set ('display_errors', 1); // Let me learn from my mistakes!
error_reporting (E_ALL | E_STRICT); // Show all possible problems!


function redirect($location)
{
  if (!headers_sent())
      header('Location: ' . $location);
  else {
      echo '<script type="text/javascript">';
      echo 'window.location.href="' . $location . '";';
      echo '</script>';
      echo '<noscript>';
      echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
      echo '</noscript>';
  }
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

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

if (isset($_GET['todo'])) {
	$process=1;
} else {
	$process=0;
}

if (isset($_GET['error'])) {
	$error=$_GET['error'];
} else {
	$error='';
}


?>

<!DOCTYPE html>   
<html>
<head>
	<meta charset="utf-8">
	<title>Zip Code Lookup</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' id='parent-style-css'  href='/wp-content/themes/Total/style.css?ver=4.8' type='text/css' media='all' />
	<link rel='stylesheet' id='wpex-style-css'  href='/wp-content/themes/atdv2/style.css?ver=4.2.1' type='text/css' media='all' />
	<link rel="stylesheet" type="text/css"  href="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/css/smart-forms.css">
    <link rel="stylesheet" type="text/css"  href="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/css/smart-themes/blue.css">

</head>
<body>
	
<?php

if($process==1) {

	
	$city = $_POST['city'];
	$_SESSION['city'] = $city;
	$state = $_POST['state'];
	$_SESSION['state'] = $state;
		
	if ($city != '' && $state != '' && strlen($city<20) && strlen($state<20)){
		$query = "select ZipCode from zipcodesv2 where (City = '" . mysqli_real_escape_string($link,$city) . "' or CityAliasName = '" . mysqli_real_escape_string($link,$city) . "') and State = '" . mysqli_real_escape_string($link,$state) . "' limit 1";
		
		
		$zips = mysqli_query($link, $query);

		
		
		$zipcode='';
		while($zip_row = mysqli_fetch_array($zips)) {
			$zipcode = $zip_row['ZipCode'];
		}
		
		if ($zipcode=='') {
			redirect('/wp-content/themes/atdv2/zipcodelookup.php?error=noresult');
			exit;
		}
		
		
		
		?>
		<div style="text-align: center; margin-top:40px; font-size: 20px;">
			The Zip Code for<br><?php echo $city ?>, <?php echo $state ?> is:
			<div style="font-size: 30px; margin-top: 15px; font-weight: bold;"><?php echo $zipcode ?></div>
		</div>
		
		<?php

		unset($_SESSION["city"]);
		unset($_SESSION["state"]);

	  
	} else {
		redirect('/wp-content/themes/atdv2/zipcodelookup.php?error=nocitystate');	
		exit;
	}


} else { ?>
	
		
	<?php
	$states = "AL,AR,AZ,CA,CO,CT,DE,FL,GA,IA,ID,IL,IN,KS,KY,LA,MA,MD,ME,MI,MN,MO,MS,MT,NC,ND,NE,NH,NJ,NM,NV,NY,OH,OK,OR,PA,RI,SC,SD,TN,TX,UT,VA,VT,WA,DC,WI,WV,WY";
	?>
	
	
	<div class="smart-forms">
	        
	    <form action="zipcodelookup.php?todo=go" method="post" name="zipcodelookup" id="zipcodelookup">
			<div class="section">
				<?php if($error!='') { ?>
		        	<div class="frm-row">
			        	<div class="colm colm12" style="color: red; text-align: center; margin-bottom: 10px;">
		                <?php 
			            
			            if($error=='nocitystate') {
				            echo "I'm sorry, you must specify a city and state.";
			            }
		                
		                if($error=='noresult') {
				            echo "I'm sorry, we could not find a zip code for that city and state.  Please try again.";
			            }

		                
		                ?>
	                	</div>
		        	</div>
	            <?php } ?>

				
				<?php
				if (isset($_SESSION['city'])) {
					$cityval = $_SESSION['city'];
				} else {
					$cityval = '';
				}
				
				if (isset($_SESSION['state'])) {
					$stateval = $_SESSION['state'];
				} else {
					$stateval = '';
				}
					
				?>
	            <div class="frm-row">
	                <div class="colm colm5">
		                City:
	            		<label for="shippingfromcity" class="field">
	            			
	            			<input type="text" id="city" name="city" style="padding: 9px 8px !important;" value="<?php echo $cityval; ?>" />
	            		</label>
	                </div>
	                
	                <div class="colm colm3">
		                State:
	            		<label for="shippingfromstate" class="field select" style="height: 46px !important;">
	            			
	            			<select name="state" id="state" style="height: 46px !important;">
	            				<option value="0" SELECTED>-- PLEASE SELECT --</option>
	            				<?php
	            				$stateslistarray = explode(',', $states);
	            				foreach($stateslistarray as $state) {
	                            ?>
	            					<option value="<?php echo $state ?>" <?php if($stateval == $state) { echo 'selected'; } ?>><?php echo GetStateName($state) ?></option>
	            				<?php } ?>
	            			</select>
	            			<i class="arrow" style="top: 12px !important;"></i>
	            		</label>
	                </div>
		            <div class="colm colm4"><br>
		                <button type="submit" class="goonbutton">
		                    Lookup&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>
		                </button>
		            </div>
	        
	            </div>
	            
	            
	            	            
	        </div>
	        
	    </form>
	            
	</div>
	
<?php } ?>	

</body>
</html>