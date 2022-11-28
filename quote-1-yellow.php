
<?php
/*
if (isset($_GET['rep'])) {
    $_SESSION['rep'] = sanitize_text_field($_GET['rep']);
    $_SESSION['admin'] = 1;
}
*/

if (isset($_GET['emailrefer'])) {
	?>
	<script>
		createCookie('emailrefer','<?php echo sanitize_text_field($_GET['emailrefer']) ?>');
	</script>
	<?php
    //$_SESSION['emailrefer'] = sanitize_text_field($_GET['emailrefer']);
}
/*
global $DEATDepositInitial;
$_SESSION['DEATDeposit'] = $DEATDepositInitial;
*/

?>
<script>
//createCookie('DEATDeposit','<?php echo $DEATDepositInitial ?>');

var getOrderInfo = jQuery.parseJSON(readCookie("OrderInfo"));	

if(!getOrderInfo) {
	initCookie();
	//console.log('make cookie!');
	var getOrderInfo = jQuery.parseJSON(readCookie("OrderInfo"));	
}
</script>
<?php


if (! is_front_page()) {
    $srctitle = get_the_title();
    $srctitle = str_ireplace(" ", "-", $srctitle);
    $srctitle = str_ireplace(" ", "&#038;-", $srctitle);
    $atdsrc = "SRC-" . $srctitle;
    
    ?>
	<script>
		createCookie('SRCUsername','<?php echo $atdsrc ?>');
	</script>
	<?php
    
    
} else {
	?>
	<script>
		eraseCookie('intquote');
		<?php
		if ($_COOKIE['rep'] == '') {
		    echo "createCookie('SRCUsername','SRC-Home-Page');";
		}	
		?>
		
	</script>
	<?php
}
//reset quote form if new quote
if (isset($_GET['quoteaction'])) {
    if ($_GET['quoteaction']=='new') {
	    ?>
		<script>
			eraseCookie('intquote');
			initCookie();
		</script>
		<?php
	    
    }
    
/*
    if ($_GET['quoteaction']=='reverse') {
        $shippingfromzip = $_SESSION["shippingfromzip"] = $shippingtozip;
        $shippingtocity = $_SESSION["shippingfromcity"] = $shippingtocity;
        $shippingtostate = $_SESSION["shippingfromstate"] = $shippingtostate;
        $shippingfromzip = $_SESSION["shippingtozip"] = $shippingfromzip;
        $shippingfromcity = $_SESSION["shippingtocity"] = $shippingfromcity;
        $shippingtostate = $_SESSION["shippingtostate"] = $shippingfromstate;

        
        
        $_SESSION["shippingfromzip"] = $shippingtozip;
        $_SESSION["shippingfromcity"] = $shippingtocity;
        $_SESSION["shippingfromstate"] = $shippingtostate;
        $_SESSION["shippingtozip"] = $shippingfromzip;
        $_SESSION["shippingtocity"] = $shippingfromcity;
        $_SESSION["shippingtostate"] = $shippingfromstate;
    }
*/
    
}

?>
  
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	init();
});

//var mainXML;
var curProgram="";
var curModel="";
function init(){
	loadXML("/vehicles.xml");
}


function loadXML(_xml){
	jQuery.ajax({
			 type: "GET",
			 url: _xml,
			 dataType: "xml",
			 success: setXML
	}) // close ajax
}



function setXML(_xml){
	var _idx=0;
	var curOption;
	var curmake = jQuery(_xml).find('make');
	
	//var getOrderInfo = jQuery.parseJSON(readCookie("orderinfo"));
	
	var preselectedmake = decodeParameter(getOrderInfo.auto_make);
	var preselectedmake2 = decodeParameter(getOrderInfo.auto_make2);
	var preselectedmake3 = decodeParameter(getOrderInfo.auto_make3);
	var preselectedmake4 = decodeParameter(getOrderInfo.auto_make4);
	var preselectedmake5 = decodeParameter(getOrderInfo.auto_make5);

	jQuery(curmake).each(function(i){
		var make = jQuery(this);

		if (preselectedmake == make.children('label').text()) {
			selectedchoice = ' selected';
		} else {
			selectedchoice = '';
		}

		curOption=jQuery("<option value='" + make.children('label').text() + "' " + selectedchoice + ">" + make.children('label').text() + "</option>");
		curOption.data("make",make); // bind the make node data from the XML to the option of the dropdown
		jQuery(curOption).appendTo(jQuery('#auto_make'));
	})

	for(j = 2; j < 6; j++){
		jQuery(curmake).each(function(i){
			var make = jQuery(this);

			var preselectedmaketemp = eval('preselectedmake'+j)

			if (preselectedmaketemp == make.children('label').text()) {
				selectedchoice = ' selected';
			} else {
				selectedchoice = '';
			}


			curOption=jQuery("<option value='" + make.children('label').text() + "' " + selectedchoice + ">" + make.children('label').text() + "</option>");
			curOption.data("make",make); // bind the make node data from the XML to the option of the dropdown
			jQuery(curOption).appendTo(jQuery('#auto_make' + j));
		})
	}

	
	if (getOrderInfo.auto_year) {
		setModel(1);
		jQuery("#auto_year").val(decodeParameter(getOrderInfo.auto_year));
		jQuery("#auto_model").val(decodeParameter(getOrderInfo.auto_model));
	}


	if (getOrderInfo.howmany == "multiplevehicles") {
		if (getOrderInfo.auto_make2) {
			setModel(2);
			jQuery("#auto_year2").val(decodeParameter(getOrderInfo.auto_year2));
			jQuery("#auto_model2").val(decodeParameter(getOrderInfo.auto_model2));
		}
		
		if (getOrderInfo.auto_make3) {
			setModel(3);
			jQuery("#auto_year3").val(decodeParameter(getOrderInfo.auto_year3));
			jQuery("#auto_model3").val(decodeParameter(getOrderInfo.auto_model3));
		}
		
		if (getOrderInfo.auto_make4) {
			setModel(4);
			jQuery("#auto_year4").val(decodeParameter(getOrderInfo.auto_year4));
			jQuery("#auto_model4").val(decodeParameter(getOrderInfo.auto_model4));
		}
		
		if (getOrderInfo.auto_make5) {
			setModel(5);
			jQuery("#auto_year5").val(decodeParameter(getOrderInfo.auto_year5));
			jQuery("#auto_model5").val(decodeParameter(getOrderInfo.auto_model5));
		}
	}

}

function setModel(vehiclenum){
	if (vehiclenum==1) {
		vehiclenum='';
	}
	var curmake = jQuery('#auto_make'+vehiclenum).children(':selected').data('make')
	jQuery('#auto_model'+vehiclenum).html(""); // reset the models list
	var curLang = jQuery(curmake).find('model');
	if (curLang.length>0){
		curLang.each(function(i){
			var lang = jQuery(this);
			if (i==0){
				curOption="<option value='null'>Model</option><option value='" + lang.text() + "'>" + lang.text() + "</option>";
			}else{
				curOption+="<option value='" + lang.text() + "'>" + lang.text() + "</option>"
			}
		});
		jQuery(curOption).appendTo(jQuery('#auto_model'+vehiclenum));
		jQuery('#auto_model'+vehiclenum).show('fast')
	}else{
		jQuery('#auto_model'+vehiclenum).hide('fast');
	}
}


function showVehicles(currentval){
	for(i = currentval; i <= 5; i++) {
		if (i != currentval) {
			modelid = "#auto_model" + i;
			document.getElementById('auto_make'+i).selectedIndex=0;
			document.getElementById('auto_model'+i).selectedIndex=0;
			//jQuery(modelid).hide();
		}
	}

	for(i = 2; i <= 5; i++) {
		vehicleid = "#vehicle" + i;
		jQuery(vehicleid).hide();
	}
	for(i = 2; i <= currentval; i++) {
		vehicleid = "#vehicle" + i;
		modelid = "#auto_model" + i;
		jQuery(vehicleid).show('fast');
		jQuery(modelid).show();
	}
	
	if (currentval > 1) {
		jQuery('.vehicleyear1').attr('style','margin-left: 0px;');
	}
}

jQuery(document).ready(function() {

	jQuery("#numvehicles").change( function() {
		currentval = jQuery(this).val();
		//clear out previous selections
		for(i = currentval; i <= 5; i++) {
			if (i != currentval) {
				modelid = "#auto_model" + i;
				document.getElementById('auto_make'+i).selectedIndex=0;
				document.getElementById('auto_model'+i).selectedIndex=0;
				//jQuery(modelid).hide();
			}
		}

		for(i = 2; i <= 5; i++) {
			vehicleid = "#vehicle" + i;
			jQuery(vehicleid).hide();
		}
		for(i = 2; i <= currentval; i++) {
			vehicleid = "#vehicle" + i;
			modelid = "#auto_model" + i;
			jQuery(vehicleid).show('fast');
			jQuery(modelid).show();

		}
	});
	
	

});

function is_int(value){ 
  if ((parseFloat(value) == parseInt(value)) && !isNaN(value)) {
    return true;
  } else { 
    return false;
  } 
}

function hideall() {
	jQuery('.howmany').hide();
	jQuery('.howmanyq').hide();
	jQuery('#num1').hide();
	jQuery('.vehiclelabel1').hide();
	jQuery('.vehicleyear1').attr('style','margin-left: 32px;');
	for(i = 2; i <= 5; i++) {
		vehicleid = "#vehicle" + i;
		jQuery(vehicleid).hide();
	};
	document.getElementById('numvehicles').selectedIndex=0;
}

function parseDate(str) {
    var mdy = str.split('/')
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function daydiff(first, second) {
    return (second-first)/(1000*60*60*24)
}

jQuery('form').each(function() {
    jQuery(this).find('input').keypress(function(e) {
        // Enter pressed?
        if(e.which == 10 || e.which == 13) {
            submitquote('');
        }
    });

    jQuery(this).find('input[type=submit]').hide();
});



function submitquote() {
	var badform=0;
	var numvehicles = document.autotransportquoteform.numvehicles.value;
	

	if (document.getElementById('auto_year').selectedIndex == 0 || document.getElementById('auto_make').selectedIndex == 0 || document.getElementById('auto_model').selectedIndex == 0) {
		badform=1;
	}

	if (numvehicles>1) {
		for(i = 2; i <= numvehicles; i++) {
			//alert (i + ' - ' + document.getElementById('auto_make'+i).selectedIndex + ' - ' + document.getElementById('auto_model'+i).selectedIndex)
			if (document.getElementById('auto_year'+i).selectedIndex == 0 || document.getElementById('auto_make'+i).selectedIndex == 0 || document.getElementById('auto_model'+i).selectedIndex == 0) {
				badform=1;
			}
		}
	}



	if (badform==1) {
		var title='I\'m Sorry';
		var message='You must select a year, make and model.';
		ShowMessage(title,message);
	} else {
		document.autotransportquoteform.submit();
	}


}



function ShowMessage(title,message) {
	var $link = jQuery(this);
	var $dialog = jQuery('<div></div>')
		.html(message)
		.dialog({
			autoOpen: true,
			title: title,
			width: 400,
			height: 150,
			modal: true,
			position: ['center',250],
			zIndex: 9999,
			closeOnEscape: false,
			buttons : {
		    "Close" : function() {
		    	jQuery(this).dialog("close");
		    }
		  }
		});
}
</script>




<div class="homeform">
	<?php
		
	if (is_front_page() || is_page(472)) {
/*
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "http://api.autotransportdirect.com/count/",
		    CURLOPT_POST           => false,
		    CURLOPT_RETURNTRANSFER => true);
		curl_setopt_array($ch, $curlConfig);
		$randimgnum = curl_exec($ch);
		curl_close($ch);
		
*/
//		$randimgnum = rand(3, 7);
		$randimgnum = 3;
		?>
		<style>
/*
		

		.homeform {
			background: url(//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-comp-<?php echo $randimgnum ?>.jpg?nocache=13) no-repeat top right;
		}
*/



		</style>
		
		<script type="text/javascript">
		function randomIntFromInterval(min,max) {
		    return Math.floor(Math.random()*(max-min+1)+min);
		}
		jQuery(function() {
			var randnum = randomIntFromInterval(3,7);
			jQuery('.homeform').css('background','url(//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-' + randnum + '.jpg?nocache=13) no-repeat top right')
/*	
			function preload(arrayOfImages) {
			    jQuery(arrayOfImages).each(function(){
			        jQuery('<img/>')[0].src = this;
			        // Alternatively you could use:
			        // (new Image()).src = this;
			    });
			}

			
			preload([
			    'https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-3.jpg', 
				'https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-7.jpg',
				'https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-6.jpg',
				'https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-5.jpg',
				'https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-4.jpg'
			]);
			
			
			var homeform = jQuery('.homeform');
			var backgrounds = [
				'url(https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-3.jpg)', 
				'url(https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-7.jpg)',
				'url(https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-6.jpg)',
				'url(https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-5.jpg)',
				'url(https://d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/images/home-slider-4.jpg)'
				];
			var current = 0;
			
			function nextBackground() {
				
				$('.homeform').fadeTo('fast', 0.3, function(){
				    $(this).css('background-image', backgrounds[current = ++current % backgrounds.length]);
				}).fadeTo('fast', 1);

				setTimeout(nextBackground, 10000);
			}
			
			setTimeout(nextBackground, 10000);
			
			homeform.css('background-image', backgrounds[0]);
*/
		});
		</script>  
	<?php		
	}
	?>
	
    <style>
	
    .quotemessage {
        background: rgba(255,255,255,.8);
        position: relative;
        width: 380px;
        float: right;
        min-height: 50px;
        bottom: -384px;
    }
    
    .quotemessagetext {
        padding: 1px 41px 20px 35px;
        color: #000;
        font-size: 26px;
        line-height: 32px;
    }
    
    .quoteimage {
        text-align: center;
        margin-top: 10px;
    }
    
    .quoteformhead {
	    font-size: 1.5em; font-weight:600; color: #000; padding-top:10px; line-height:23px; margin:0
    }
    
    .quoteformlabel {
	    font-size: 1.313em; font-weight:600; color: #000; line-height:1.5; margin:0;
    }
        
    </style>

	<script src="/wp-content/themes/atdv2/js/easyautocomplete/jquery.easy-autocomplete.min.js"></script> 
	<link rel="stylesheet" href="/wp-content/themes/atdv2/js/easyautocomplete/easy-autocomplete.min.css"> 





    <div class="quoteform" style="float:left;">
        <div class="title">
            <div class="quoteformhead">Auto Transport Quote Calculator</div>
            <div class="subtitle" style="display: none;"><h2 style="padding-top:10px;line-height:23px; margin:0; font-size: 1.3em;"><a href="tel:800-600-3750" style="color:#1135B5;text-decoration: underline;">800-600-3750</a></h2></div>
        </div>
       

        <div class="smart-forms">
        
            <form action="/quote/?step=2" method="post" name="autotransportquoteform" id="autotransportquoteform">
            <input type="hidden" name="clearsession" value="<?php echo $clearsession ?>">
            <input type="hidden" name="auto_make_index">
            <input type="hidden" name="auto_model_index">
                <div class="section">
                    <section>
            		<?php 

                    if(isset($_GET['quoteerror'])) {
                        
            			$errormsg = $_GET['quoteerror'] ?>
            				<div class="errormsg" align="center">
            					<div class="Sep5"></div>
            					<?php if($errormsg == "from") { ?>
            						If you choose not to fill out the "shipping from" zip code, you must fill out the "shipping from" city and state.
            					<?php } elseif($errormsg == "notfoundfrom") { ?>
            						I'm afraid we could not locate the zip code for the city and state you specified in the "shipping from" step.
            					<?php } elseif($errormsg == "to") { ?>
            						If you choose not to fill out the "shipping to" zip code, you must fill out the "shipping to" city and state.
            					<?php } elseif($errormsg == "notfoundto") { ?>
            						I'm afraid we could not locate the zip code for the city and state you specified in the "shipping to" step.
            					<?php } elseif($errormsg == "badfrom") { ?>
            						The "shipping from" zip code you entered if not valid.
            					<?php } elseif($errormsg == "badto") { ?>
            						The "shipping to" zip code you entered if not valid.
            					<?php } elseif($errormsg == "badunknown") { ?>
            						The error we have received is unknown.
            					<?php } elseif($errormsg == "limit") { ?>
            						Sorry, you have reached the maximum allowable number of free quotes.
            					<?php } elseif($errormsg == "HI") { ?>
            						Sorry, we do not ship to or from Hawaii.
            					<?php } elseif($errormsg == "AK") { ?>
            						Sorry, we do not ship to or from Alaska.
            					<?php } elseif($errormsg == "distance") { ?>
            						Sorry, we are having problems calculating this quote.
            					<?php } ?>
            						Please try again, or if you need further assistance, please call us at 1-800-600-3750.  Thank You.
            					<div class="Sep5"></div>
            				</div>
            		<?php } ?>
                    </section>
                </div>
<script type="text/javascript">
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
				var zipcode = $("#shippingfromzipentry").getSelectedItemData().zipcode;
				var city = $("#shippingfromzipentry").getSelectedItemData().city;
				var state = $("#shippingfromzipentry").getSelectedItemData().state;
				
				$("#shippingfromzipentry").val(zipcode + ' (' + city + ', ' + state + ')').trigger("change");
	
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
				var zipcode = $("#shippingtozipentry").getSelectedItemData().zipcode;
				var city = $("#shippingtozipentry").getSelectedItemData().city;
				var state = $("#shippingtozipentry").getSelectedItemData().state;
				$("#shippingtozipentry").val(zipcode + ' (' + city + ', ' + state + ')').trigger("change");
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
	
	$("#shippingfromzipentry").easyAutocomplete(optionsfrom);	
	$("#shippingtozipentry").easyAutocomplete(optionsto);

	$(document).ready(function() {
	    $("#shippingfromzipentry,#shippingtozipentry").keydown(function (e) {
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
                
                <div class="section" style="margin-bottom: 0;">
                    <div class="frm-row">
                        <div class="colm colm5">
                            <label for="shippingfromzip" class="field-label"><div class="quoteformlabel">1.&nbsp;&nbsp; Ship Car From</div></label>
                        </div>

                        <div class="colm colm6">
                            <label for="shippingfromzip" class="field">
                                <input type="text" id="shippingfromzipentry" class="zipentry" name="shippingfromzipentry" value="" placeholder="Zip Code" maxlength="5" />
                                
                                <input type="hidden" id="shippingfromzip" name="shippingfromzip">
                                <input type="hidden" id="shippingfromcity" name="shippingfromcity">
                                <input type="hidden" id="shippingfromstate" name="shippingfromstate">
                            </label>
                        </div>
                    </div>
                </div>
           
				<div class="section" style="margin-bottom: 5px;">
                    <div class="frm-row">
                        <div class="colm colm5">
                            
                        </div>

                        <div class="colm colm6" style="font-size: 12px; text-align: right;">
                            <a href="/wp-content/themes/atdv2/zipcodelookup.php" class="wpex-lightbox" data-type="iframe" data-options="width:350,height:350">Zip Code Lookup</a>
                        </div>
                        
                    </div>
                </div>

            
                <div class="section">
                    <div class="frm-row">
                        <div class="colm colm5">
                            <label for="shippingtozip" class="field-label"><div class="quoteformlabel">2.&nbsp;&nbsp; Ship Car To</div></label>
                        </div>

                        <div class="colm colm6">
                            <label for="shippingtozip" class="field">
                                <input type="text" id="shippingtozipentry" class="zipentry" name="shippingtozipentry" value="" placeholder="Zip Code" maxlength="5" />
                                
                                <input type="hidden" id="shippingtozip" name="shippingtozip">
                                <input type="hidden" id="shippingtocity" name="shippingtocity">
                                <input type="hidden" id="shippingtostate" name="shippingtostate">
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                            
                <div class="section">
                	<div class="frm-row">
                        <div class="colm colm12">
                            <div class="option-group field">
                                <div class="quoteformlabel" style="display:inline;">3.</div>
                    			<label class="option" style="display:inline;top:-3px;margin-left:10px;">
                    			    <input id="onevehicle" name="howmany" type="radio" checked="checked" value="onevehicle" onclick="hideall();" />
                                    <span class="radio"></span> One Vehicle
                                </label>
                
                    			<label class="option secondoption" style="display:inline;top:-3px;">
                    			    <input id="multiplevehicles" name="howmany" type="radio" value="multiplevehicles" onclick="jQuery('.howmany').show('fast');jQuery('.howmanyq').show('fast');jQuery('.vehicleyear1').attr('style','');jQuery('.vehiclelabel1').show('fast');jQuery('#num1').show()" />
                    			    <span class="radio"></span> Multiple Vehicles
                                </label>
                    			
                            </div>
                		</div>
                	</div>
                	
                	<div class="frm-row howmany" style="display:none; margin-top: 10px;">
                    	<div class="colm colm4" style="margin-top:4px;">
                        	How Many Vehicles?
                    	</div>
                        <div class="colm colm3">
                        	<label for="numvehicles" class="field select">
                        	    
                        	    <select name="numvehicles" id="numvehicles">
                        			<option value="1">1</option>
                        			<?php for ($i=2; $i <= 5; $i++) { ?>
                        			<option value="<?php echo $i ?>"><?php echo $i ?></option>
                        			<?php } ?>
                        	    </select>
                        	    <i class="arrow"></i>
                        	</label>
                    	</div>
                    	<div class="colm colm5">
                        	
                    	</div>
                	</div>
                
                	<div class="frm-row vehicles"  id="vehicle1" style="margin-top:10px;">
                    	<div class="colm colm2 vehiclelabel1" style="display:none; margin-top:5px;font-size: 0.9em;">
                    		Vehicle #1
                    	</div>
                    	<div class="colm colm3 vehicleyear1" style="margin-left: 32px;">
                            <label class="field select">
                        		<select name="auto_year" id="auto_year" class="auto_year">
                        			<option value="">Year</option>
                        			<?php
                        			$currentyear = date('Y')+1;
                        			for ($y=$currentyear; $y >= 1910; $y--) {
                        			?>
                        			<option value="<?php echo $y ?>"><?php echo $y ?></option>
                        			<?php } ?>
                        		</select><i class="arrow"></i>
                            </label>
                    	</div>
                    	<div class="colm colm3">
                        	<label class="field select">
                        		<select name="auto_make" onchange="setModel(1)" id="auto_make" class="select auto_make">
                        			<option value="">Make</option>
                        		</select><i class="arrow"></i>
                        	</label>
                    	</div>
                    	<div class="colm colm4">
                        	<label class="field select">
                        		<select name="auto_model" id="auto_model" class="select">
                        			<option value="">Model</option>
                        		</select><i class="arrow"></i>
                        	</label>
                    	</div>
                	</div>
                
                
                    <?php for ($i=2; $i <= 5; $i++) { ?>
                    <div class="frm-row vehicles" id="vehicle<?php echo $i ?>" style="margin-top:10px;">
                    	<div class="colm colm2 vehiclelabel<?php echo $i ?>" style="margin-top:5px;font-size: 0.9em;">
                    		Vehicle #<?php echo $i ?>
                    	</div>
                        <div class="colm colm3">
                            <label class="field select">
                    			<select name="auto_year<?php echo $i ?>" id="auto_year<?php echo $i ?>" class="auto_year">
                    				<option value="">Year</option>
                    				<?php
                    				$currentyear = date('Y');
                    				for ($y=$currentyear; $y >= 1910; $y--) {
                    				?>
                    				<option value="<?php echo $y ?>"><?php echo $y ?></option>
                    				<?php } ?>
                    			</select><i class="arrow"></i>
                            </label>
                        </div>
                        <div class="colm colm3">
                            <label class="field select">
                    			<select name="auto_make<?php echo $i ?>" onchange="setModel(<?php echo $i ?>)" id="auto_make<?php echo $i ?>" class="select auto_make">
                    				<option value="">Make</option>
                    			</select><i class="arrow"></i>
                            </label>
                        </div>
                        <div class="colm colm4">
                            <label class="field select">
                    			<select name="auto_model<?php echo $i ?>" id="auto_model<?php echo $i ?>" class="select">
                    				<option value="">Model</option>
                    			</select><i class="arrow"></i>
                            </label>
                        </div>
                	</div>
                	<?php } ?>
            
                </div>
            	
            	<div class="section">
                    <div class="frm-row">
                        <div class="colm colm12">
                            <div class="option-group field">
                                <div class="quoteformlabel" style="display:inline;">4.</div>
                    			<label class="option" style="display:inline;top:-3px;margin-left:10px;">
                    			    <input id="vehicle_operational_running" name="vehicle_operational" type="radio" value="Running" checked="checked" />
                                    <span class="radio"></span> Running Condition
                                </label>
                
                    			<label class="option secondoption" style="display:inline;top:-3px;">
                    			    <input id="vehicle_operational_nonrunning" name="vehicle_operational" type="radio" value="Non-Running" <?php if($_SESSION['vehicle_operational'] == 'Non-Running') { echo 'checked="checked"'; } ?> />
                    			    <span class="radio"></span> Non-Running Condition
                                </label>
                    			
                            </div>
                		</div>
                	</div>
            	</div>
            	
            	<div class="section">
                    <div class="frm-row">
                        <div class="colm colm12">
                            <div class="option-group field">
                                <div class="quoteformlabel" style="display:inline;">5.</div>
                    			<label class="option" style="display:inline;top:-3px;margin-left:10px;">
                    			    <input id="vehicle_trailer_open" name="vehicle_trailer" type="radio" value="Open" checked="checked" />
                                    <span class="radio"></span> Open Transport
                                </label>
                
                    			<label class="option secondoption" style="display:inline;top:-3px;margin-left: 17px;">
                    			    <input id="vehicle_trailer_enclosed" name="vehicle_trailer" type="radio" value="Enclosed" <?php if($_SESSION['vehicle_trailer'] == 'Enclosed') { echo 'checked="checked"'; } ?> />
                    			    <span class="radio"></span> Enclosed Transport
                                </label>
                    			
                            </div>
                		</div>
                	</div>
            	</div>
            	
            	<div class="frm-row">
                    <div class="colm colm12">
            		    <input type="button" onclick="submitquote();" value="Get My Auto Shipping Quote Now &#9658;" class="submitquote"/>
            		    <input type="submit" style="display:none;"/>
                    </div>
            	</div>
            	
            	<div class="frm-row">
                    <div class="colm colm12" style="color:#666666;padding-top: 15px;padding-left: 40px;">
            		    <strong style="color:#3d85c6">Google+ Plus</strong> members give us <strong style="color:#ff9900">4.5 STARS</strong> (432 Reviews)<br/>
            		    <strong style="color:#6aa84f">BBB</strong> members give us <strong style="color:#ff9900">4.9 STARS</strong> (190 Reviews)<br/>
            		    <strong style="color:#cc0000">Facebook</strong> members give us <strong style="color:#ff9900">4.4 STARS</strong> (73 Reviews)<br/>
            		    <strong style="color:#9900ff">TrustPilot</strong> members give us <strong style="color:#ff9900">4.9 STARS</strong> (321 Reviews)<br/>
                    </div>
            	</div>
            </form>
        </div>
    </div>
    
</div>
<div class="subtitle" style="display: none; text-align: center;margin: 15px 0;"><h2 style="padding-top:10px;line-height:23px; margin:0; font-size: 1.3em;"><a href="tel:800-600-3750" style="color:#1135B5;text-decoration: underline;">800-600-3750</a></h2></div>

<script type="text/javascript">
$(document).ready(function() {
	//console.log(getOrderInfo);
	if(getOrderInfo.shippingfromzip!='') {
		var shippingfromcitydecoded = decodeParameter(getOrderInfo.shippingfromcity);
		
		$('#shippingfromzipentry').val(getOrderInfo.shippingfromzip + ' (' + shippingfromcitydecoded + ', ' + getOrderInfo.shippingfromstate + ')');
		$('#shippingfromzip').val(getOrderInfo.shippingfromzip);
		$('#shippingfromcity').val(shippingfromcitydecoded);
		$('#shippingfromstate').val(getOrderInfo.shippingfromstate);
	}

	if(getOrderInfo.shippingtozip!='') {
		var shippingtocitydecoded = decodeParameter(getOrderInfo.shippingtocity);
		
		$('#shippingtozipentry').val(getOrderInfo.shippingtozip + ' (' + shippingtocitydecoded + ', ' + getOrderInfo.shippingtostate + ')');
		$('#shippingtozip').val(getOrderInfo.shippingtozip);
		$('#shippingtocity').val(shippingtocitydecoded);
		$('#shippingtostate').val(getOrderInfo.shippingtostate);
	}
	
	if (getOrderInfo.howmany=='' || getOrderInfo.howmany=='onevehicle') {
		hideall();
		$('#onevehicle').prop("checked", true);
		$('#multiplevehicles').prop("checked", false);
	} else {
		jQuery('.howmany').show();
		jQuery('.howmanyq').show();
		jQuery('.vehiclelabel1').show()
		$('#multiplevehicles').prop("checked", true);
		$('#onevehicle').prop("checked", false);
	}
	
	if (getOrderInfo.numvehicles!='') {
		$('#numvehicles').val(getOrderInfo.numvehicles);
	}
	
	
	if (getOrderInfo.numvehicles!='') {
		showVehicles(getOrderInfo.numvehicles);
	}
	
	
	
});
</script>  



