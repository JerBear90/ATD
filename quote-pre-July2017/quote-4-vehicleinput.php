<br>
	Vehicle Details - Vehicle #<?php echo $vehiclenum ?><br>
	<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>

Year:<br>
<input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Year<?php echo $vehiclenum ?>" id="strVehicle_Year<?php echo $vehiclenum ?>" value="<?php echo $auto_yeartemp  ?>" size="20" <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>><?php if(session('admin')!="") { ?><span class="req">&nbsp;*</span><?php } ?>
<br><br>

Vehicle Make:<br>
<input type="text" id="strVehicle_Make<?php echo $vehiclenum ?>" name="strVehicle_Make<?php echo $vehiclenum ?>" value="<?php echo $auto_maketemp  ?>" size="20"  <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>><?php if(session('admin')!="") { ?><span class="req">&nbsp;*</span><?php } ?>
<br><br>    

Vehicle Model:<br>
<input type="text" id="strVehicle_Model<?php echo $vehiclenum ?>" name="strVehicle_Model<?php echo $vehiclenum ?>" value="<?php echo $auto_modeltemp  ?>"  <?php if(session('admin')=="") { ?>readonly="readonly" style="border:0;"<?php } ?>><?php if(session('admin')!="") { ?><span class="req">&nbsp;*</span><?php } ?>
<br><br>
    
Vehicle Color:<br>
<input type="text" name="strVehicle_Color<?php echo $vehiclenum ?>" id="strVehicle_Color<?php echo $vehiclenum ?>" size="30" maxlength="50">

<div id="vehicle_comingfrom_vin<?php echo $vehiclenum ?>" style="display:none;">
    <br><br>
    LAST 6 digits of the Vehicle VIN:<br>
    <input type="text" name="strVehicle_VIN<?php echo $vehiclenum ?>" id="strVehicle_VIN<?php echo $vehiclenum ?>" size="8" maxlength="6"><span class="req">&nbsp;*</span>
</div>

<div id="vehicle_comingfrom_stocknum<?php echo $vehiclenum ?>" style="display:none;">
	<br><br>
	Auto Auction Lot/Stock Number:<br>
    <input type="text" name="strVehicle_StockNum<?php echo $vehiclenum ?>" id="strVehicle_StockNum<?php echo $vehiclenum ?>" size="8" maxlength="6"><span class="req">&nbsp;*</span>
</div>


<script>

jQuery(function() {
    jQuery( "#strVehicle_LiftKityes<?php echo $vehiclenum ?>" ).click(function() {
        jQuery("#dialog-liftkit<?php echo $vehiclenum ?>").dialog('open');
    });

    jQuery( "#dialog-liftkit<?php echo $vehiclenum ?>" ).dialog({
      modal: true,
      width: 'auto',
      autoOpen: false,
      fluid: true,
      resizable: false,
      buttons: {
        Ok: function() {
          jQuery( this ).dialog( "close" );
          jQuery('#strVehicle_LiftKitnot<?php echo $vehiclenum ?>').prop("checked", true);
        }
      }
    });   
    
    jQuery( "#strVehicle_Loweredyes<?php echo $vehiclenum ?>" ).click(function() {
        jQuery("#dialog-lowered<?php echo $vehiclenum ?>").dialog('open');
    });

    jQuery( "#dialog-lowered<?php echo $vehiclenum ?>" ).dialog({
      modal: true,
      width: 'auto',
      autoOpen: false,
      fluid: true,
      resizable: false,
      buttons: {
        Ok: function() {
          jQuery( this ).dialog( "close" );
          jQuery('#strVehicle_Loweredno<?php echo $vehiclenum ?>').prop("checked", true);
        }
      }
    });  
    
    jQuery( "#strVehicle_Oversized_Tiresyes<?php echo $vehiclenum ?>" ).click(function() {
        jQuery("#dialog-tires<?php echo $vehiclenum ?>").dialog('open');
    });

    jQuery( "#dialog-tires<?php echo $vehiclenum ?>" ).dialog({
      modal: true,
      width: 'auto',
      autoOpen: false,
      fluid: true,
      resizable: false,
      buttons: {
        Ok: function() {
          jQuery( this ).dialog( "close" );
          jQuery('#strVehicle_Oversized_Tiresno<?php echo $vehiclenum ?>').prop("checked", true);
        }
      }
    });       
    
    
});
</script>

<br><br>
Is The Vehicle a Convertible?<br>
<input type="radio" name="strVehicle_Convertible<?php echo $vehiclenum ?>" id="strVehicle_Convertibleyes<?php echo $vehiclenum ?>" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="strVehicle_Convertible<?php echo $vehiclenum ?>" id="strVehicle_Convertibleno<?php echo $vehiclenum ?>" value="no" checked="checked"> No
<br><br>

Is The Vehicle Lifted?<br>
<input type="radio" name="strVehicle_LiftKit<?php echo $vehiclenum ?>" id="strVehicle_LiftKityes<?php echo $vehiclenum ?>" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="strVehicle_LiftKit<?php echo $vehiclenum ?>" id="strVehicle_LiftKitno<?php echo $vehiclenum ?>" value="no" checked="checked"> No
<div id="dialog-liftkit<?php echo $vehiclenum ?>" title="Sorry..." style="display:none;">
    To place an order for a lifted vehicle,<br>please call us at 800-600-3750.
</div>
<br><br>

Does The Vehicle Have Low Clearance?<br>
	<input type="radio" name="strVehicle_Lowered<?php echo $vehiclenum ?>" id="strVehicle_Loweredyes<?php echo $vehiclenum ?>" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="strVehicle_Lowered<?php echo $vehiclenum ?>" id="strVehicle_Loweredno<?php echo $vehiclenum ?>" value="no" checked="checked"> No
<div id="dialog-lowered<?php echo $vehiclenum ?>" title="Sorry..." style="display:none;">
    To place an order for a lowered vehicle,<br>please call us at 800-600-3750.
</div>
<br><br>

Does The Vehicle Have Oversized Tires?<br>
<input type="radio" name="strVehicle_Oversized_Tires<?php echo $vehiclenum ?>" id="strVehicle_Oversized_Tiresyes<?php echo $vehiclenum ?>" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="strVehicle_Oversized_Tires<?php echo $vehiclenum ?>" id="strVehicle_Oversized_Tiresno<?php echo $vehiclenum ?>" value="no" checked="checked"> No
<div id="dialog-tires<?php echo $vehiclenum ?>" title="Sorry..." style="display:none;">
    To place an order for a vehicle with oversized tires,<br>please call us at 800-600-3750.
</div>
<br><br>

Additional Vehicle Information:<br>
<input type="text" name="strVehicle_AdditionalInfo<?php echo $vehiclenum ?>" id="strVehicle_AdditionalInfo<?php echo $vehiclenum ?>" size="60" maxlength="60"><br>



