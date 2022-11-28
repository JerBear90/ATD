

<tr>
	<td class="title3" colspan="2"><br>
	Vehicle Details - Vehicle #<%=vehiclenum%><br>
	<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
	</td>
</tr>
<tr>
	<td class="formtext" align="right">Year:</td>
	<td>
	<input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Year<%=vehiclenum%>" id="strVehicle_Year<%=vehiclenum%>" value="<%= auto_yeartemp %>" size="20" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%>
	</td>
</tr>
<tr>
	<td class="formtext" align="right">Vehicle Make:</td>
	<td><input type="text" id="strVehicle_Make<%=vehiclenum%>" name="strVehicle_Make<%=vehiclenum%>" value="<%= auto_maketemp %>" size="20" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%></td>
</tr>
<tr>
	<td class="formtext" align="right">Vehicle Model:</td>
	<td><input type="text" id="strVehicle_Model<%=vehiclenum%>" name="strVehicle_Model<%=vehiclenum%>" value="<%= auto_modeltemp %>" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%></td>
</tr>

<tr>
	<td class="formtext" align="right">Vehicle Color:</td>
	<td><input type="text" name="strVehicle_Color<%=vehiclenum%>" id="strVehicle_Color<%=vehiclenum%>" size="30" maxlength="50"></td>
</tr>

<tr id="vehicle_comingfrom_vin<%=vehiclenum%>" style="display:none;">
	<td class="formtext" align="right">LAST 6 digits of the Vehicle VIN:</td>
	<td><input type="text" name="strVehicle_VIN<%=vehiclenum%>" id="strVehicle_VIN<%=vehiclenum%>" size="8" maxlength="6"><span class="req">&nbsp;*</span></td>
</tr>

<tr id="vehicle_comingfrom_stocknum<%=vehiclenum%>" style="display:none;">
	<td class="formtext" align="right">Auto Auction Lot/Stock Number:</td>
	<td><input type="text" name="strVehicle_StockNum<%=vehiclenum%>" id="strVehicle_StockNum<%=vehiclenum%>" size="8" maxlength="6"><span class="req">&nbsp;*</span></td>
</tr>



<tr>
	<td class="formtext" align="right">Is The Vehicle Lifted?</td>
	<td>
	<input type="radio" name="strVehicle_LiftKit<%=vehiclenum%>" id="strVehicle_LiftKityes<%=vehiclenum%>" value="yes" onclick="$('#liftkit_howmuch<%=vehiclenum%>').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="strVehicle_LiftKit<%=vehiclenum%>" id="strVehicle_LiftKitno<%=vehiclenum%>" value="no" checked="checked"  onclick="notlifted(<%=vehiclenum%>);"> No
	</td>
</tr>
<tr id="liftkit_howmuch<%=vehiclenum%>" style="display:none;">
	<td class="formtext" align="right">How Many Inches Is It Lifted?</td>
	<td>
	<select name="strVehicle_LiftKit_Quantity<%=vehiclenum%>" id="strVehicle_LiftKit_Quantity<%=vehiclenum%>">
		<option value="">-- PLEASE SELECT --</option>
		<option value="1">1 inch</option>
		<option value="2">2 inches</option>
		<option value="3">3 inches</option>
		<option value="4">4 inches</option>
		<option value="5">5 inches</option>
		<option value="6">6 inches</option>
		<option value="7">7 inches</option>
		<option value="8">8 inches</option>
		<option value="9">9 inches</option>
		<option value="10">10 inches</option>
		<option value="11">11 inches</option>
		<option value="12">12 inches</option>
	</select><span class="req">&nbsp;*</span>
	
	<input type="hidden" name="strVehicle_LiftKit_Amount<%=vehiclenum%>" id="strVehicle_LiftKit_Amount<%=vehiclenum%>" value="0" />
	</td>
</tr>

<tr>
	<td class="formtext" align="right">Does The Vehicle Have Low Clearance?</td>
	<td>
	<input type="radio" name="strVehicle_Lowered<%=vehiclenum%>" id="strVehicle_Loweredyes<%=vehiclenum%>" value="yes" onclick="$('#lowered_howmuch<%=vehiclenum%>').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="strVehicle_Lowered<%=vehiclenum%>" id="strVehicle_Loweredno<%=vehiclenum%>" value="no" checked="checked" onclick="$('#lowered_howmuch<%=vehiclenum%>').hide();$('#strVehicle_Lowered_Quantity<%=vehiclenum%> option')[0].selected = true;"> No
	</td>
</tr>
<tr id="lowered_howmuch<%=vehiclenum%>" style="display:none;">
	<td class="formtext" align="right">How Many Inches From The Ground?</td>
	<td>
	<select name="strVehicle_Lowered_Quantity<%=vehiclenum%>" id="strVehicle_Lowered_Quantity<%=vehiclenum%>">
	<option value="">-- PLEASE SELECT --</option>
	<option value="1">1 inch</option>
	<option value="2">2 inches</option>
	<option value="3">3 inches</option>
	<option value="4">4 inches</option>
	<option value="5">5 inches</option>
	<option value="6">6 inches</option>
	</select><span class="req">&nbsp;*</span>
	</td>
</tr>

<tr>
	<td class="formtext" align="right">Does The Vehicle Have Oversized Tires?</td>
	<td>
	<input type="radio" name="strVehicle_Oversized_Tires<%=vehiclenum%>" id="strVehicle_Oversized_Tiresyes<%=vehiclenum%>" value="yes" onclick="$('#oversizedtires_howmuch<%=vehiclenum%>').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="strVehicle_Oversized_Tires<%=vehiclenum%>" id="strVehicle_Oversized_Tiresno<%=vehiclenum%>" value="no" checked="checked" onclick="notires(<%=vehiclenum%>);"> No
	</td>
</tr>
<tr id="oversizedtires_howmuch<%=vehiclenum%>" style="display:none;">
	<td class="formtext" align="right">What Size Are The Tires?</td>
	<td>
	<select name="strVehicle_Oversized_Tires_Quantity<%=vehiclenum%>" id="strVehicle_Oversized_Tires_Quantity<%=vehiclenum%>">
	<option value="">-- PLEASE SELECT --</option>
	<option value="30">30 inches</option>
	<option value="31">31 inches</option>
	<option value="32">32 inches</option>
	<option value="33">33 inches</option>
	<option value="34">34 inches</option>
	<option value="35">35 inches</option>
	<option value="36">36 inches</option>
	<option value="37">37 inches</option>
	<option value="38">38 inches</option>
	<option value="39">39 inches</option>
	<option value="40">40 inches</option>
	</select><span class="req">&nbsp;*</span>
	
	<input type="hidden" name="strVehicle_Oversized_Tires_Amount<%=vehiclenum%>" id="strVehicle_Oversized_Tires_Amount<%=vehiclenum%>" value="0" />
	</td>
</tr>
<tr>
	<td class="formtext" align="right">Is The Vehicle a Convertible?</td>
	<td>
	<input type="radio" name="strVehicle_Convertible<%=vehiclenum%>" id="strVehicle_Convertibleyes<%=vehiclenum%>" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="strVehicle_Convertible<%=vehiclenum%>" id="strVehicle_Convertibleno<%=vehiclenum%>" value="no" checked="checked"> No
	</td>
</tr>

<tr>
	<td class="formtext" align="right">Is The Vehicle a Coupe?</td>
	<td>
	<input type="radio" name="strVehicle_Coupe<%=vehiclenum%>" id="strVehicle_Coupeyes<%=vehiclenum%>" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="strVehicle_Coupe<%=vehiclenum%>" id="strVehicle_Coupeno<%=vehiclenum%>" value="no" checked="checked"> No
	</td>
</tr>

<tr>
	<td class="formtext" align="right">Additional Vehicle Information:</td>
	<td><input type="text" id="strVehicle_AdditionalInfo<%=vehiclenum%>" name="strVehicle_AdditionalInfo<%=vehiclenum%>" size="60" maxlength="60"></td>
</tr>

<script>
	//$('#strVehicle_Year<%=vehiclenum%>').val('');
</script>
