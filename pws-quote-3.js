	                            function changetrailer() {
	                            	var currenttrailer = jQuery('#vehicle_trailer').val();
	                            	if (currenttrailer=='Open') {
	                            		jQuery('#vehicle_trailer').val('Enclosed');
	                            	} else {
	                            		jQuery('#vehicle_trailer').val('Open');
	                            	}
	                            	document.getElementById("changequote").submit();
	                            }
	                        
	                            function changeoperating() {
	                            	var currentcondition = jQuery('#vehicle_operational').val();
	                            	if (currentcondition=='Running') {
	                            		jQuery('#vehicle_operational').val('Non-Running');
	                            	} else {
	                            		jQuery('#vehicle_operational').val('Running');
	                            	}
	                            	document.getElementById("changequote").submit();
	                            }
	                            
	                            function reverselocation() {
	                            	var current_shippingfromzip = jQuery('#shippingfromzip').val();
	                            	var current_shippingfromcity = jQuery('#shippingfromcity').val();
	                            	var current_shippingfromstate = jQuery('#shippingfromstate').val();
	                            	var current_shippingtozip = jQuery('#shippingtozip').val();
	                            	var current_shippingtocity = jQuery('#shippingtocity').val();
	                            	var current_shippingtostate = jQuery('#shippingtostate').val();
	                                
	                                jQuery('#shippingfromzip').val(current_shippingtozip);
	                                jQuery('#shippingfromcity').val(current_shippingtocity);
	                                jQuery('#shippingfromstate').val(current_shippingtostate);
	                                jQuery('#shippingtozip').val(current_shippingfromzip);
	                                jQuery('#shippingtocity').val(current_shippingfromcity);
	                                jQuery('#shippingtostate').val(current_shippingfromstate);
	                            	
	                            	document.getElementById("changequote").submit();
	                            }

	                            