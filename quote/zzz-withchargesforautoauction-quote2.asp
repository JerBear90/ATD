<% pagetitle = "Direct Express Auto Transport - Shipment Details" %>
<% metadescription = "We are a nationwide car shipping company that specializes in coast-to-coast - door to door auto transporting, car shipping, trucks, cars, SUVs shipping cars within the continental U.S." %>
<% metakeywords = "automobile transport quote, truck transport quote, auto transport quote, car transport quote, national car shipping quote" %>
<% pagename="quote2" %>
<!--#include file="../includes/header.asp"-->

<%
'Get Username from Cookie
If Session("Username") = "" Then
	%>
	<!--#INCLUDE VIRTUAL="/pwprotect/config_inc.asp"-->
	<%
	CurrentUsername = RC4(Request.Cookies("PASSWORDSYSTEMCOOKIE")("COOKIE_USERNAME"), CookieEncryptionKey)

	If CurrentUsername <> "" Then
		Session("Username") = CurrentUsername
		Session("SRCUsername") = CurrentUsername
	End If
Else
	CurrentUsername = Session("Username")
End If


trackid = session("trackid")
If trackid <> "" Then
	dim conn
	call openDB()

	CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
	strSQL = "update sale_conversion set dateupdated='" & CurrentDateTime & "',sale_status = '3. Shipment Details' where trackid = '" & trackid & "'"

	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3

	if session("stopleads") <> 1 then
		strSQL = "update leads set nosend='1', quote_status = 'Step 4' where trackid = '" & trackid & "'"
		Set Rs = Server.CreateObject("ADODB.Recordset")
		    Rs.Open strSQL,conn,3,3
	end if

	call closedb()
End If

if CurrentUsername <> "" then
	adminactive=1
else
	adminactive=0
end if

if Session("SRCUsername") <> "" then
    CurrentUsername = Session("SRCUsername")
end if

%>

<div align="center">
<div class="title1" style="padding:0;margin-top:0;">It Takes Only 5 Minutes To Setup Your Shipment</div>
<div style="margin:5px 0 15px 0;width:860px;border-top:#999999 solid thin;"></div>


<%
strQuote_shippingfromstateabbr = getUserInput(request.form("strQuote_shippingfromstateabbr"),0)
strQuote_shippingtostateabbr = getUserInput(request.form("strQuote_shippingtostateabbr"),0)
strQuote_shippingfromstate = getUserInput(request.form("strQuote_shippingfromstate"),0)
strQuote_shippingtostate = getUserInput(request.form("strQuote_shippingtostate"),0)
strQuote_shippingfromcity = getUserInput(request.form("strQuote_shippingfromcity"),0)
strQuote_shippingtocity = getUserInput(request.form("strQuote_shippingtocity"),0)
strQuote_shippingfromzip = getUserInput(request.form("strQuote_shippingfromzip"),0)
strQuote_shippingtozip = getUserInput(request.form("strQuote_shippingtozip"),0)
strQuote_vehicletype = getUserInput(request.form("strQuote_vehicletype"),0)
strQuote_vehicle_operational = getUserInput(request.form("strQuote_vehicle_operational"),0)
strQuote_vehicle_trailer = getUserInput(request.form("strQuote_vehicle_trailer"),0)

shippingfrom_sales = getUserInput(Request.Form("shippingfrom_sales"),0)

auto_year = getUserInput(request.form("auto_year"),0)
auto_make = getUserInput(request.form("auto_make"),0)
auto_model = getUserInput(request.form("auto_model"),0)
auto_price = getUserInput(request.form("auto_price"),0)

howmany = getUserInput(Request.Form("howmany"),0)
numvehicles = getUserInput(Request.Form("numvehicles"),0)
auto_year2 = getUserInput(Request.Form("auto_year2"),0)
auto_make2 = getUserInput(Request.Form("auto_make2"),0)
auto_model2 = getUserInput(Request.Form("auto_model2"),0)
auto_price2 = getUserInput(request.form("auto_price2"),0)
auto_year3 = getUserInput(Request.Form("auto_year3"),0)
auto_make3 = getUserInput(Request.Form("auto_make3"),0)
auto_model3 = getUserInput(Request.Form("auto_model3"),0)
auto_price3 = getUserInput(request.form("auto_price3"),0)
auto_year4 = getUserInput(Request.Form("auto_year4"),0)
auto_make4 = getUserInput(Request.Form("auto_make4"),0)
auto_model4 = getUserInput(Request.Form("auto_model4"),0)
auto_price4 = getUserInput(request.form("auto_price4"),0)
auto_year5 = getUserInput(Request.Form("auto_year5"),0)
auto_make5 = getUserInput(Request.Form("auto_make5"),0)
auto_model5 = getUserInput(Request.Form("auto_model5"),0)
auto_price5 = getUserInput(request.form("auto_price5"),0)

customer_name = getUserInput(Request.Form("customer_name"),0)
customer_email = getUserInput(Request.Form("customer_email"),0)
customer_phone = getUserInput(Request.Form("customer_phone"),0)
customer_movedate = getUserInput(Request.Form("customer_movedate"),0)

if session("repeat_email") <> "" then
	customer_email = session("repeat_email")
end if

spacepos = InStr(customer_name," ")
if spacepos > 0 then
	first_name = left(customer_name,spacepos)
	last_name = right(customer_name,len(customer_name)-spacepos)
else
	first_name = customer_name
end if

depositpervehicle = getUserInput(request.form("depositpervehicle"),0)
carrierdiscount = getUserInput(request.form("carrierdiscount"),0)
depositdiscount = getUserInput(request.form("depositdiscount"),0)
discstatus = getUserInput(request.form("discstatus"),0)
ps = getUserInput(request.form("ps"),0)
honorquotereduction = getUserInput(request.form("honorquotereduction"),0)
militarydiscountreduction = getUserInput(request.form("militarydiscountreduction"),0)
turbochargeincrease = getUserInput(request.form("turbochargeincrease"),0)
reviewdiscountreduction = getUserInput(request.form("reviewdiscountreduction"),0)
reviewdiscountsite = getUserInput(request.form("reviewdiscountsite"),0)

helpfulhintmention = getUserInput(request.form("helpfulhintmention"),0)

DaysWaitingPickupTotalOrders = getUserInput(request.form("DaysWaitingPickupTotalOrders"),0)
DaysWaitingPickupAvg = getUserInput(request.form("DaysWaitingPickupAvg"),0)
DaysWaitingDeliverTotalOrders = getUserInput(request.form("DaysWaitingDeliverTotalOrders"),0)
DaysWaitingDeliverAvg = getUserInput(request.form("DaysWaitingDeliverAvg"),0)
DaysWaitingAvg = getUserInput(request.form("DaysWaitingAvg"),0)

rating_origin = getUserInput(request.form("rating_origin"),0)
rating_dest = getUserInput(request.form("rating_dest"),0)
rating_vehicle = getUserInput(request.form("rating_vehicle"),0)

strDeposit = getUserInput(request.form("strDeposit"),0)

pricetier = getUserInput(request.form("pricetier"),0)



if howmany = "onevehicle" then
	strTotalPrice = getUserInput(request.form("strTotalPrice"),0)
	strBalance = strTotalPrice - strDeposit
	'strDeposit = DEATDeposit
else
	strTotalPrice = getUserInput(request.form("strTotalPrice"),0)
	'strDeposit = getUserInput(request.form("strDeposit"),0)
	strBalance = strTotalPrice - strDeposit
end if


%>



<form action="https://www.autotransportdirect.com/quote/quote3.asp" method="post" name="mainform" id="mainform">
<input type="hidden" name="strquote_shippingfromstateabbr" value="<%= strQuote_shippingfromstateabbr %>">
<input type="hidden" name="strQuote_shippingtostateabbr" value="<%= strQuote_shippingtostateabbr %>">
<input type="hidden" name="strQuote_shippingfromstate" value="<%= strQuote_shippingfromstate %>">
<input type="hidden" name="strQuote_shippingtostate" value="<%= strQuote_shippingtostate %>">
<input type="hidden" name="strQuote_vehicletype" value="<%= strQuote_vehicletype %>">
<input type="hidden" name="strQuote_vehicle_operational" value="<%= strQuote_vehicle_operational %>">
<input type="hidden" name="strQuote_vehicle_trailer" value="<%= strQuote_vehicle_trailer %>">
<input type="hidden" id="strBalance_init" name="strBalance_init" value="<%= strBalance %>">
<input type="hidden" id="strBalance" name="strBalance" value="<%= strBalance %>">
<input type="hidden" id="strDeposit" name="strDeposit" value="<%= strDeposit %>">
<input type="hidden" name="depositpervehicle" value="<%= depositpervehicle %>">
<input type="hidden" id="carrierdiscount" name="carrierdiscount" value="<%= carrierdiscount %>">
<input type="hidden" name="depositdiscount" value="<%= depositdiscount %>">
<input type="hidden" name="discstatus" value="<%= discstatus %>">
<input type="hidden" name="ps" value="<%= ps %>">
<input type="hidden" name="honorquotereduction" value="<%= honorquotereduction %>">
<input type="hidden" name="militarydiscountreduction" value="<%= militarydiscountreduction %>">
<input type="hidden" name="turbochargeincrease" value="<%= turbochargeincrease %>">
<input type="hidden" name="reviewdiscountreduction" value="<%= reviewdiscountreduction %>">
<input type="hidden" name="reviewdiscountsite" value="<%= reviewdiscountsite %>">

<input type="hidden" name="helpfulhintmention" value="<%= helpfulhintmention %>">

<input type="hidden" name="shippingfrom_sales" value="<%= shippingfrom_sales %>">

<input type="hidden" id="strTotalPrice_init" name="strTotalPrice_init" value="<%= strTotalPrice %>">
<input type="hidden" id="strTotalPrice" name="strTotalPrice" value="<%= strTotalPrice %>">

<input type="hidden" id="pricetier" name="pricetier" value="<%= pricetier %>">


<input type="hidden" name="howmany" value="<%= howmany %>">
<input type="hidden" name="numvehicles" value="<%= numvehicles %>">

<input type="hidden" name="rating_origin" value="<%= rating_origin %>">
<input type="hidden" name="rating_dest" value="<%= rating_dest %>">
<input type="hidden" name="rating_vehicle" value="<%= rating_vehicle %>">

<input type="hidden" id="auto_price_init_1" name="auto_price_init_1" value="<%= auto_price%>">
<input type="hidden" id="auto_price_init_2" name="auto_price_init_2" value="<%= auto_price2%>">
<input type="hidden" id="auto_price_init_3" name="auto_price_init_3" value="<%= auto_price3%>">
<input type="hidden" id="auto_price_init_4" name="auto_price_init_4" value="<%= auto_price4%>">
<input type="hidden" id="auto_price_init_5" name="auto_price_init_5" value="<%= auto_price5%>">


<input type="hidden" id="auto_price1" name="auto_price" value="<%= auto_price%>">
<input type="hidden" id="auto_price2" name="auto_price2" value="<%= auto_price2%>">
<input type="hidden" id="auto_price3" name="auto_price3" value="<%= auto_price3%>">
<input type="hidden" id="auto_price4" name="auto_price4" value="<%= auto_price4%>">
<input type="hidden" id="auto_price5" name="auto_price5" value="<%= auto_price5%>">


<input type="hidden" id="auto_copartauction_cost" name="auto_copartauction_cost" value="0">

<input type="hidden" id="auto_liftedcost1" name="auto_liftedcost1" value="0">
<input type="hidden" id="auto_liftedcost2" name="auto_liftedcost2" value="0">
<input type="hidden" id="auto_liftedcost3" name="auto_liftedcost3" value="0">
<input type="hidden" id="auto_liftedcost4" name="auto_liftedcost4" value="0">
<input type="hidden" id="auto_liftedcost5" name="auto_liftedcost5" value="0">

<input type="hidden" id="auto_tirecost1" name="auto_tirecost1" value="0">
<input type="hidden" id="auto_tirecost2" name="auto_tirecost2" value="0">
<input type="hidden" id="auto_tirecost3" name="auto_tirecost3" value="0">
<input type="hidden" id="auto_tirecost4" name="auto_tirecost4" value="0">
<input type="hidden" id="auto_tirecost5" name="auto_tirecost5" value="0">


<input type="hidden" name="DaysWaitingPickupTotalOrders" value="<%= DaysWaitingPickupTotalOrders%>">
<input type="hidden" name="DaysWaitingPickupAvg" value="<%= DaysWaitingPickupAvg%>">
<input type="hidden" name="DaysWaitingDeliverTotalOrders" value="<%= DaysWaitingDeliverTotalOrders%>">
<input type="hidden" name="DaysWaitingDeliverAvg" value="<%= DaysWaitingDeliverAvg%>">
<input type="hidden" name="DaysWaitingAvg" value="<%= DaysWaitingAvg%>">


<div id="dialog" title="Confirmation Required" style="display:none;"></div>



<table width="860" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td width="100%" class="bodytext2">

	<div class="imagebox" style="float:left;margin: 0 75px 20px;width: 262px;">
		<img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" width="262" height="196" alt="" />
		<div>We make it easy to setup your shipment and get on the road ... door to door.</div>
	</div>



<table cellspacing="2" cellpadding="2" border="0" width="300" align="center">
<tr>
	<td class="bodytext4"><b>Shipping From:</b></td>
	<td class="bodytext4"><b><%= strQuote_shippingfromcity %>, <%= strQuote_shippingfromstateabbr %>&nbsp;&nbsp;&nbsp;<%=strQuote_shippingfromzip%></b></td>
</tr>
<tr>
	<td class="bodytext4"><b>Shipping To:</b></td>
	<td class="bodytext4"><b><%= strQuote_shippingtocity %>, <%= strQuote_shippingtostateabbr %>&nbsp;&nbsp;&nbsp;<%=strQuote_shippingtozip%></b></td>
</tr>


<% if howmany <> "onevehicle" then %>
<tr>
	<td class="bodytext4" valign="top"><b>Types of Vehicles:</b></td>
	<td class="bodytext4" nowrap>
	<%= auto_make %> - <%= auto_model %><br>
	<%if auto_make2<>"" then%><%= auto_make2 %> - <%= auto_model2 %><br><%end if%>
	<%if auto_make3<>"" then%><%= auto_make3 %> - <%= auto_model3 %><br><%end if%>
	<%if auto_make4<>"" then%><%= auto_make4 %> - <%= auto_model4 %><br><%end if%>
	<%if auto_make5<>"" then%><%= auto_make5 %> - <%= auto_model5 %><br><%end if%>
	</td>
</tr>
<% else %>
<tr>
	<td class="bodytext4"><b>Type of Vehicle:</b></td>
	<td class="bodytext4" nowrap><%= auto_make %> - <%= auto_model %></td>
</tr>
<% end if %>



<tr>
	<td class="bodytext4" nowrap="nowrap"><b>Operating Condition:&nbsp;&nbsp;&nbsp;</b></td>
	<td class="bodytext4" nowrap="nowrap"><%= strQuote_vehicle_operational %> and Rolls, Brakes, Steers</td>
</tr>
<tr>
	<td class="bodytext4"><b>Type of Trailer:</b></td>
	<td class="bodytext4"><%= strQuote_vehicle_trailer %></td>
</tr>
<tr>
	<td class="bodytext4" colspan="2">
	<div class="title2" style="font-size: 25px;" align="center">
	<div style="margin:5px 0 15px 0;width:400px;border-top:#999999 solid thin;"></div>
	<b>Total Price:</b> <span style="color:#308dff">$<div id="totalprice" style="display:inline;"><%= formatnumber(strTotalPrice)  %></div></span></div>

	<div align="center" style="font-size: 12px; margin-top:7px;">
		<b>
			Only the deposit of $<%= strDeposit %> is required to setup your order.<br/>
			The balance of $<%= strBalance %> is paid to the driver upon delivery.<br/>
			There is no tax.

		</b>
	</div>
	</td>
</tr>
</table>
<br>
<div style="clear:both;"></div>
<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
</div>
<div class="bodytext" align="left">
<strong>Please fill out the detail below.</strong>
<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
</div>

	<br/>
	<table border="0" cellspacing="0" cellpadding="3" align="center" width="100%" id="ordertable">

	<tr>
		<td class="formtext" align="right" width="300">First Name:</td>
		<td><input type="text" name="strCustFirstName" id="strCustFirstName" size="30" value="<%=first_name%>"><span class="req">&nbsp;*</span></td>
		<td rowspan="5" valign="top">
			<div class="imagebox" style="float:right;">
				<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-6.jpg" width="210" height="162" alt="Direct Express Auto Transport Employee" />
				<div>We will send you an Order Confirmation and Notice of Assignment once we have arranged your driver. </div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Last Name:</td>
		<td><input type="text" name="strCustLastName" id="strCustLastName" size="30" value="<%=last_name%>"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Company:</td>
		<td><input type="text" name="strCustCompany" id="strCustCompany" size="30"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Phone Number:</td>
		<td><input type="text" name="strCustPhone1" id="strCustPhone1" size="30" value="<%=customer_phone%>"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">E-Mail Address:</td>
		<td><input type="text" name="strCustEmail" id="strCustEmail" size="30" value="<%=customer_email%>"><span class="req">&nbsp;*</span></td>
	</tr>

	<tr>
		<td class="title3" colspan="3"><br>
		Vehicle Source<br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>

	<tr>
		<td class="formtext" align="right">
			<% if howmany <> "onevehicle" then %>
				Are these vehicles coming from<br />a dealer, auto auction or Copart?
			<% else %>
				Is this vehicle coming from<br />a dealer, auto auction or Copart?
			<% end if %>
		</td>
		<td>

		<input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_yes" value="yes" onclick="$('#vehicle_comingfrom_spec').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;

		<%if howmany <> "onevehicle" then %>
			<input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="comingfromno();"> No
		<% else %>
		<input type="radio" name="strVehicle_ComingFrom_choice" id="strVehicle_ComingFrom_no" value="no" checked="checked" onclick="$('#vehicle_comingfrom_spec').hide();$('#vehicle_comingfrom_stocknum').hide();<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %><% else %>$('#vehicle_comingfrom_vin').hide();<% end if %>$('#strVehicle_VIN').val('');$('#vehicle_comingfrom_buyernum').hide();$('#strVehicle_BuyerNum').val('');$('#strVehicle_ComingFrom option')[0].selected = true;"> No
		<% end if %>
		</td>
	</tr>

	<%if howmany <> "onevehicle" then %>
		<script type="text/javascript">

		function comingfromno() {

			<%
			counter=1
			for counter = 1 to numvehiclestemp
			%>
			$('#vehicle_comingfrom_spec').hide();
			$('#vehicle_comingfrom_stocknum<%=counter%>').hide();
			<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
			<% else %>
			$('#vehicle_comingfrom_vin<%=counter%>').hide();
			<% end if %>
			$('#strVehicle_VIN<%=counter%>').val('');
			$('#vehicle_comingfrom_buyernum').hide();
			$('#strVehicle_BuyerNum').val('');
			$('#strVehicle_ComingFrom option')[0].selected = true;
			<% next %>
		}


		function choosevehiclefrom() {
			if($('#strVehicle_ComingFrom').val()=='') {

				<%
				counter=1
				for counter = 1 to numvehiclestemp
				%>
				<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
				<% else %>
				$('#vehicle_comingfrom_vin<%=counter%>').hide();
				<% end if %>
				$('#strVehicle_VIN<%=counter%>').val('');
				<% next %>

				$('#vehicle_comingfrom_buyernum').hide();
				$('#strVehicle_BuyerNum').val('');

			} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {

				//Cleanup other fields
				$('#vehicle_comingfrom_buyernum').hide();
				$('#strVehicle_BuyerNum').val('');

				//Show VIN for Each Vehicle
				<%
				counter=1
				for counter = 1 to numvehiclestemp
				%>
				$('#vehicle_comingfrom_vin<%=counter%>').show();
				<% next %>

			} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {

				//Cleanup other fields
				<%
				counter=1
				for counter = 1 to numvehiclestemp
				%>
				<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
				<% else %>
				$('#vehicle_comingfrom_vin<%=counter%>').hide();
				<% end if %>
				$('#strVehicle_VIN<%=counter%>').val('');
				<% next %>

				//Show Buyer Number
				$('#vehicle_comingfrom_buyernum').show();

				//Show Stock Number for Each Vehicle
				<%
				counter=1
				for counter = 1 to numvehiclestemp
				%>
				$('#vehicle_comingfrom_stocknum<%=counter%>').show();
				<% next %>



			} else if ($('#strVehicle_ComingFrom').val()=='Copart') {

				//Cleanup other fields
				<%
				counter=1
				for counter = 1 to numvehiclestemp
				%>
				$('#vehicle_comingfrom_stocknum<%=counter%>').hide();
				$('#strVehicle_StockNum<%=counter%>').val('');
				<% next %>

				//Show Buyer Number
				$('#vehicle_comingfrom_buyernum').show();

				//Show VIN for Each Vehicle
				<%
				counter=1
				for counter = 1 to numvehiclestemp
				%>
				$('#vehicle_comingfrom_vin<%=counter%>').show();
				<% next %>



			}

			liftedlowered(1);

		}



		function lowered(vehiclenum) {
			var loweredamount = $('#strVehicle_Lowered_Quantity' + vehiclenum).val();
			var trailer = document.mainform.strQuote_vehicle_trailer.value;
			alert(loweredamount);
			if ((loweredamount >=1 && loweredamount <= 4) && trailer=='Open' ) {
				$("#dialog").dialog({
				  modal: true,
				  closeOnEscape: false,
				  dialogClass: 'no-close',
				  buttons : {
				    "BACK TO HOME PAGE" : function() {
				    	window.location = "/";
				    }
				  }
				});

				$("#dialog").html("I'm sorry, in order to ship a vehicle with a clearance of " + loweredamount + " inches, it must be shipped in an enclosed trailer.  Please go to our home page and re-quote using an enclosed trailer.");
				$("#dialog").dialog("open");
			}

		}



		function liftedlowered(showdialog) {
			//Get all lift amounts
			var liftamount1 = $('#strVehicle_LiftKit_Quantity1').val();
			var liftamount2 = $('#strVehicle_LiftKit_Quantity2').val();
			var liftamount3 = $('#strVehicle_LiftKit_Quantity3').val();
			var liftamount4 = $('#strVehicle_LiftKit_Quantity4').val();
			var liftamount5 = $('#strVehicle_LiftKit_Quantity5').val();


			//Get all tire amounts
			var tireamount1 = $('#strVehicle_Oversized_Tires_Quantity1').val();
			var tireamount2 = $('#strVehicle_Oversized_Tires_Quantity2').val();
			var tireamount3 = $('#strVehicle_Oversized_Tires_Quantity3').val();
			var tireamount4 = $('#strVehicle_Oversized_Tires_Quantity4').val();
			var tireamount5 = $('#strVehicle_Oversized_Tires_Quantity5').val();


			//Get initial auto prices
			var auto_price_init_1 = $('#auto_price_init_1').val();
			var auto_price_init_2 = $('#auto_price_init_2').val();
			var auto_price_init_3 = $('#auto_price_init_3').val();
			var auto_price_init_4 = $('#auto_price_init_4').val();
			var auto_price_init_5 = $('#auto_price_init_5').val();

			//Convert to integers
			auto_price_init_1 = MakeInt(auto_price_init_1);
			auto_price_init_2 = MakeInt(auto_price_init_2);
			auto_price_init_3 = MakeInt(auto_price_init_3);
			auto_price_init_4 = MakeInt(auto_price_init_4);
			auto_price_init_5 = MakeInt(auto_price_init_5);

			//Get initial total price
			var totalprice = $('#strTotalPrice_init').val();
			totalprice = parseInt(totalprice);

			//Get carrier discount amount
			var carrierdiscount = $('#carrierdiscount').val();
			carrierdiscount = parseInt(carrierdiscount);

			//Deposit amount
			var deposit = <%=strDeposit%>;

			var message = '';
			var liftadditional=0;
			var usernotify=0;

			liftcost1 = checkliftamount(liftamount1);
			liftcost2 = checkliftamount(liftamount2);
			liftcost3 = checkliftamount(liftamount3);
			liftcost4 = checkliftamount(liftamount4);
			liftcost5 = checkliftamount(liftamount5);


			tirecost1 = checktireamount(tireamount1);
			tirecost2 = checktireamount(tireamount2);
			tirecost3 = checktireamount(tireamount3);
			tirecost4 = checktireamount(tireamount4);
			tirecost5 = checktireamount(tireamount5);


			if ($('#strVehicle_ComingFrom').val()=='Auto Auction' || $('#strVehicle_ComingFrom').val()=='Copart') {
				copartauction_total = 50;
			} else {
				copartauction_total = 0;
			}

			//Add up additional fees for lifted and tires
			auto_price1 = auto_price_init_1 + liftcost1 + tirecost1;
			auto_price2 = auto_price_init_2 + liftcost2 + tirecost2;
			auto_price3 = auto_price_init_3 + liftcost3 + tirecost3;
			auto_price4 = auto_price_init_4 + liftcost4 + tirecost4;
			auto_price5 = auto_price_init_5 + liftcost5 + tirecost5;

			var lifttotal = liftcost1 + liftcost2 + liftcost3 + liftcost4 + liftcost5;
			var tiretotal = tirecost1 + tirecost2 + tirecost3 + tirecost4 + tirecost5;

			$('#strVehicle_LiftKit_Amount1').val(liftcost1);
			$('#strVehicle_LiftKit_Amount2').val(liftcost2);
			$('#strVehicle_LiftKit_Amount3').val(liftcost3);
			$('#strVehicle_LiftKit_Amount4').val(liftcost4);
			$('#strVehicle_LiftKit_Amount5').val(liftcost5);


			$('#strVehicle_Oversized_Tires_Amount1').val(tirecost1);
			$('#strVehicle_Oversized_Tires_Amount2').val(tirecost2);
			$('#strVehicle_Oversized_Tires_Amount3').val(tirecost3);
			$('#strVehicle_Oversized_Tires_Amount4').val(tirecost4);
			$('#strVehicle_Oversized_Tires_Amount5').val(tirecost5);


			//Place new amounts back into fields
			$('#auto_price1').val(auto_price1);
			$('#auto_price2').val(auto_price2);
			$('#auto_price3').val(auto_price3);
			$('#auto_price4').val(auto_price4);
			$('#auto_price5').val(auto_price5);


			$('#auto_copartauction_cost').val(copartauction_total);


			var autototal = auto_price1 + auto_price2 + auto_price3 + auto_price4 + auto_price5;
			var newtotal = (parseInt(deposit) + autototal + copartauction_total) - carrierdiscount;
			var newbalance = (autototal + copartauction_total) - carrierdiscount;


			$('#strTotalPrice').val(newtotal);
			$('#strBalance').val(newbalance);
			$("#totalprice").html(newtotal+'.00');


			if (lifttotal!=0) {
				message = message + 'Because at least one of your vehicles have been lifted, the total amount we must add to your quote is $' + lifttotal + '<hr>';
			}

			if (tiretotal!=0) {
				message = message + 'Because at least one of your vehicles have oversized tires, the total amount we must add to your quote is $' + tiretotal + '<hr>';
			}

			if (copartauction_total!=0) {
				message = message + 'Because your vehicle is being picked up at an auto auction or from CoPart, the total amount we must add to your quote is $' + copartauction_total + '<hr>';
			}


			if (message != '' && showdialog==1) {
				message = message + 'The new total will be $' + newtotal + '.00';

				$("#dialog").dialog({
				  modal: true,
				  buttons : {
				    "CONFIRM" : function() {
				      	$(this).dialog("close");
				    }
				  }
				});

				$("#dialog").html(message);
				$("#dialog").dialog("open");
			}

		}

		function checkliftamount (liftamount) {
			liftadditional=0;
			liftamount = MakeInt(liftamount);

			if (liftamount >=4 && liftamount <= 6 ) {
				liftadditional=50;
			} else if(liftamount >=7 && liftamount <= 9 ) {
				liftadditional=100;
			} else if(liftamount >=10 && liftamount <= 12 ) {
				liftadditional=200;
			}
			return liftadditional;

		}

		function checktireamount (tireamount) {
			tireadditional=0;
			tireamount = MakeInt(tireamount);

			if (tireamount >=30 && tireamount <= 32 ) {
				tireadditional=50;
			} else if(tireamount >=33 && tireamount <= 35 ) {
				tireadditional=100;
			} else if(tireamount >=36 && tireamount <= 40 ) {
				tireadditional=200;
			}
			return tireadditional;

		}

		function MakeInt(n) {
			if (isNaN(parseInt(n))) {
				return 0;
			} else {
				return parseInt(n)
			}
		}


		function notlifted(vehiclenum) {
			$('#liftkit_howmuch' + vehiclenum).hide();
			$('#strVehicle_LiftKit_Quantity' + vehiclenum + ' option')[0].selected = true;
			liftedlowered(0);
		}

		function notires(vehiclenum) {
			$('#oversizedtires_howmuch' + vehiclenum).hide();
			$('#strVehicle_Oversized_Tires_Quantity' + vehiclenum + ' option')[0].selected = true;
			liftedlowered(0);
		}

		</script>



	<% else %>
		<script type="text/javascript">
		function choosevehiclefrom() {
			if($('#strVehicle_ComingFrom').val()=='') {

				<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
				<% else %>
				$('#vehicle_comingfrom_vin').hide();
				<% end if %>

				$('#strVehicle_VIN').val('');

				$('#vehicle_comingfrom_buyernum').hide();
				$('#strVehicle_BuyerNum').val('');

			} else if ($('#strVehicle_ComingFrom').val()=='Dealer') {

				//Cleanup other fields
				$('#vehicle_comingfrom_buyernum').hide();
				$('#strVehicle_BuyerNum').val('');

				//Show VIN for Each Vehicle
				$('#vehicle_comingfrom_vin').show();

			} else if ($('#strVehicle_ComingFrom').val()=='Auto Auction') {

				//Cleanup other fields
				<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
				<% else %>
				$('#vehicle_comingfrom_vin').hide();
				<% end if %>
				$('#strVehicle_VIN').val('');

				//Show Buyer Number
				$('#vehicle_comingfrom_buyernum').show();

				//Show Stock Number for Each Vehicle
				$('#vehicle_comingfrom_stocknum').show();

			} else if ($('#strVehicle_ComingFrom').val()=='Copart') {

				//Cleanup other fields
				$('#vehicle_comingfrom_stocknum').hide();
				$('#strVehicle_StockNum').val('');

				//Show Buyer Number
				$('#vehicle_comingfrom_buyernum').show();

				//Show VIN for Each Vehicle
				$('#vehicle_comingfrom_vin').show();
			}
			liftedtires(1);

		}
		</script>
	<%end if%>
	<tr id="vehicle_comingfrom_spec" style="display:none;">
		<td class="formtext" align="right">
			<%if howmany <> "onevehicle" then %>
				Where are they coming from?
			<%else%>
				Where is it coming from?
			<%end if%>
		</td>
		<td>
		<select name="strVehicle_ComingFrom" id="strVehicle_ComingFrom" onchange="choosevehiclefrom();">
		<option value="">-- PLEASE SELECT --</option>
		<option value="Dealer">Dealer</option>
		<option value="Auto Auction">Auto Auction</option>
		<option value="Copart">Copart</option>
		</select><span class="req">&nbsp;*</span>
		</td>
	</tr>

	<tr id="vehicle_comingfrom_buyernum" style="display:none;">
		<td class="formtext" align="right">Your buyer number:</td>
		<td><input type="text" name="strVehicle_BuyerNum" id="strVehicle_BuyerNum" size="20" maxlength="99"></td>
	</tr>
	<%if howmany <> "onevehicle" then %>
		<%
		if auto_make<>"" and auto_model <>"" then
			vehiclenum=1
			auto_yeartemp=auto_year
			auto_maketemp=auto_make
			auto_modeltemp=auto_model
		%>
		<!--#include file="quote2-vehicleinput.asp"-->
		<%end if%>

		<%
		if auto_make2<>"" and auto_model2 <>"" then
			vehiclenum=2
			auto_yeartemp=auto_year2
			auto_maketemp=auto_make2
			auto_modeltemp=auto_model2
		%>
		<!--#include file="quote2-vehicleinput.asp"-->
		<%end if%>

		<%
		if auto_make3<>"" and auto_model3 <>"" then
			vehiclenum=3
			auto_yeartemp=auto_year3
			auto_maketemp=auto_make3
			auto_modeltemp=auto_model3
		%>
		<!--#include file="quote2-vehicleinput.asp"-->
		<%end if%>

		<%
		if auto_make4<>"" and auto_model4 <>"" then
			vehiclenum=4
			auto_yeartemp=auto_year4
			auto_maketemp=auto_make4
			auto_modeltemp=auto_model4
		%>
		<!--#include file="quote2-vehicleinput.asp"-->
		<%end if%>

		<%
		if auto_make5<>"" and auto_model5 <>"" then
			vehiclenum=5
			auto_yeartemp=auto_year5
			auto_maketemp=auto_make5
			auto_modeltemp=auto_model5
		%>
		<!--#include file="quote2-vehicleinput.asp"-->
		<%end if%>






	<% else %>
		<tr>
			<td class="title3" colspan="3"><br>
			Vehicle Details<br>
			<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
			</td>

		</tr>
		<tr>
			<td class="formtext" align="right">Year:</td>
			<td>


			<input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Year" id="strVehicle_Year" value="<%= auto_year %>" size="20" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%>


			</td>
			<td rowspan="9" valign="top">
				<div class="imagebox" style="float:right;">
					<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-2.jpg" width="210" height="162" alt="Direct Express Auto Transport Employee" />
					<div>Shipments go smoother if there are no surprises. Please note any vehicle modifications here.</div>
				</div>
			</td>
		</tr>
		<tr>
			<td class="formtext" align="right">Vehicle Make:</td>
			<td><input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Make" id="strVehicle_Make" value="<%= auto_make %>" size="20" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%></td>
		</tr>
		<tr>
			<td class="formtext" align="right">Vehicle Model:</td>
			<td><input style="box-shadow: none;background: white;border: 0;" type="text" name="strVehicle_Model" id="strVehicle_Model" value="<%= auto_model %>" size="20" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%></td>
		</tr>


		<tr>
			<td class="formtext" align="right">Vehicle Color:</td>
			<td><input type="text" name="strVehicle_Color" id="strVehicle_Color" size="30" maxlength="50"></td>
		</tr>

		<tr id="vehicle_comingfrom_vin" style="display:none;">
			<td class="formtext" align="right">LAST 6 digits of the Vehicle VIN:</td>
			<td><input type="text" name="strVehicle_VIN" id="strVehicle_VIN" size="8" maxlength="6"></td>
		</tr>

		<tr id="vehicle_comingfrom_stocknum" style="display:none;">
			<td class="formtext" align="right">Auto Auction Lot/Stock Number:</td>
			<td><input type="text" name="strVehicle_StockNum" id="strVehicle_StockNum" size="8"><span class="req">&nbsp;*</span></td>
		</tr>

		<tr>
			<td class="formtext" align="right">Is The Vehicle a Convertible?</td>
			<td>
			<input type="radio" name="strVehicle_Convertible" id="strVehicle_Convertibleyes" value="yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="strVehicle_Convertible" id="strVehicle_Convertibleno" value="no" checked="checked"> No
			</td>
		</tr>
		<script type="text/javascript">
		function lowered() {
			var loweredamount = document.mainform.strVehicle_Lowered_Quantity.value;
			var trailer = document.mainform.strQuote_vehicle_trailer.value;
			if ((loweredamount >=1 && loweredamount <= 4) && trailer=='Open' ) {
				$("#dialog").dialog({
				  modal: true,
				  closeOnEscape: false,
				  dialogClass: 'no-close',
				  buttons : {
				    "BACK TO HOME PAGE" : function() {
				    	window.location = "/";
				    }
				  }
				});

				$("#dialog").html("I'm sorry, in order to ship a vehicle with a clearance of " + loweredamount + " inches, it must be shipped in an enclosed trailer.  Please go to our home page and re-quote using an enclosed trailer.");
				$("#dialog").dialog("open");
			}

		}




		function liftedtires(showdialog) {
			var liftamount = $('#strVehicle_LiftKit_Quantity').val();
			var tireamount = $('#strVehicle_Oversized_Tires_Quantity').val();
			var totalprice = <%= strTotalPrice %>;
			var deposit = <%= DEATDeposit %>;
			var message = '';
			var liftadditional=0;
			var tireadditional=0;
			var usernotify=0;

			if (liftamount >=4 && liftamount <= 6 ) {
				liftadditional=50;
				usernotify=1;
			} else if(liftamount >=7 && liftamount <= 9 ) {
				liftadditional=100;
				usernotify=1;
			} else if(liftamount >=10 && liftamount <= 12 ) {
				liftadditional=200;
				usernotify=1;
			}

			if (tireamount >=30 && tireamount <= 32 ) {
				tireadditional=50;
				usernotify=1;
			} else if(tireamount >=33 && tireamount <= 35 ) {
				tireadditional=100;
				usernotify=1;
			} else if(tireamount >=36 && tireamount <= 40 ) {
				tireadditional=200;
				usernotify=1;
			}

			var auto_price_init_1 = $('#auto_price_init_1').val();
			auto_price_init_1 = parseInt(auto_price_init_1);
			auto_price1 = auto_price_init_1 + liftadditional + tireadditional;

			if ($('#strVehicle_ComingFrom').val()=='Auto Auction' || $('#strVehicle_ComingFrom').val()=='Copart') {
				copartauction_total = 50;
				usernotify=1;
			} else {
				copartauction_total = 0;
			}
			$('#auto_copartauction_cost').val(copartauction_total);

			$('#strVehicle_LiftKit_Amount').val(liftadditional);
			$('#strVehicle_Oversized_Tires_Amount').val(tireadditional);

			$('#auto_price1').val(auto_price1);

			newtotal = totalprice + liftadditional + tireadditional + copartauction_total;
			newbalance = newtotal - <%=DEATDeposit%>


			document.mainform.strTotalPrice.value=newtotal;
			document.mainform.strBalance.value=newbalance;
			$("#totalprice").html(newtotal+'.00');

			if (liftadditional!=0 && usernotify) {
				message = message + 'Because your vehicle has been lifted ' + liftamount + ' inches, we must add $' + liftadditional + ' to your quote.<hr>';
			}
			if (tireadditional!=0 && usernotify) {
				message = message + 'Because you have oversized tires, we must add $' + tireadditional + ' to your quote.<hr>';
			}
			if (copartauction_total!=0 && usernotify) {
				message = message + 'Because your vehicle is being picked up at an auto auction or from CoPart, the total amount we must add to your quote is $' + copartauction_total + '<hr>';
			}

			if (message != '' && showdialog==1) {
				message = message + 'The new total will be $' + newtotal + '.00';

				$("#dialog").dialog({
				  modal: true,
				  buttons : {
				    "CONFIRM" : function() {
				      	$(this).dialog("close");
				    }
				  }
				});

				$("#dialog").html(message);
				$("#dialog").dialog("open");
			}
		}



		function notlifted() {
			$('#liftkit_howmuch').hide();
			$('#strVehicle_LiftKit_Quantity option')[0].selected = true;
			liftedtires(0);
		}

		function notires() {
			$('#oversizedtires_howmuch').hide();
			$('#strVehicle_Oversized_Tires_Quantity option')[0].selected = true;
			liftedtires(0);
		}

		</script>
		<tr>
			<td class="formtext" align="right">Is The Vehicle Lifted?</td>
			<td>
			<input type="radio" name="strVehicle_LiftKit" id="strVehicle_LiftKityes" value="yes" onclick="$('#liftkit_howmuch').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="strVehicle_LiftKit" id="strVehicle_LiftKitno" value="no" checked="checked" onclick="notlifted();"> No
			</td>
		</tr>
		<tr id="liftkit_howmuch" style="display:none;">
			<td class="formtext" align="right">How Many Inches Is It Lifted?</td>
			<td>
			<select name="strVehicle_LiftKit_Quantity" id="strVehicle_LiftKit_Quantity" onchange="liftedtires(1);">
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
			<input type="hidden" name="strVehicle_LiftKit_Amount" id="strVehicle_LiftKit_Amount" value="0" />
			</td>
		</tr>

		<tr>
			<td class="formtext" align="right">Does The Vehicle Have Low Clearance?</td>
			<td>
			<input type="radio" name="strVehicle_Lowered" id="strVehicle_Loweredyes" value="yes" onclick="$('#lowered_howmuch').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="strVehicle_Lowered" id="strVehicle_Loweredno" value="no" checked="checked" onclick="$('#lowered_howmuch').hide();$('#strVehicle_Lowered_Quantity option')[0].selected = true;"> No
			</td>
		</tr>
		<tr id="lowered_howmuch" style="display:none;">
			<td class="formtext" align="right">How Many Inches From The Ground?</td>
			<td>
			<select name="strVehicle_Lowered_Quantity" id="strVehicle_Lowered_Quantity" onchange="lowered();">
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
			<input type="radio" name="strVehicle_Oversized_Tires" id="strVehicle_Oversized_Tiresyes" value="yes" onclick="$('#oversizedtires_howmuch').show();"> Yes &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="strVehicle_Oversized_Tires" id="strVehicle_Oversized_Tiresno" value="no" checked="checked" onclick="notires();"> No
			</td>
		</tr>
		<tr id="oversizedtires_howmuch" style="display:none;">
			<td class="formtext" align="right">What Size Are The Tires?</td>
			<td>
			<select name="strVehicle_Oversized_Tires_Quantity" id="strVehicle_Oversized_Tires_Quantity" onchange="liftedtires(1);">
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
			<input type="hidden" name="strVehicle_Oversized_Tires_Amount" id="strVehicle_Oversized_Tires_Amount" value="0" />
			</td>
		</tr>

		<tr>
			<td class="formtext" align="right">Additional Vehicle Information:</td>
			<td><input type="text" name="strVehicle_AdditionalInfo" id="strVehicle_AdditionalInfo" size="60" maxlength="60"></td>
		</tr>

	<%end if%>




	<tr>
		<td class="title3" colspan="3"><br>
		Dates<br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>

	<tr>
		<td class="bodytext" colspan="2">
			<div style="font-size: 16px; margin-left: 140px; margin-bottom: 25px; line-height: 30px;">
			Pick the very first date your vehicle is available to be shipped.<br/>
			That date must be within 30 days of today.<br/>
			It typically takes one to several days to assign your vehicle.<br/>
			</div>
		</td>
		<td valign="top" rowspan="2">
			<div class="imagebox" style="float:right;">
				<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-3.jpg" width="210" height="162" alt="Direct Express Auto Transport Employee" />
				<div>Once assigned, the transit time typically takes about one day for every 500 miles, plus a day or two on either end for pickups and deliveries. </div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right" valign="top">First Date Available To Ship:</td>
		<td valign="top"><input id="strDateAvailable" name="strDateAvailable" type="text" style="cursor:pointer;background: #fff url('../images/icon_calendar.png') no-repeat 194px 6px;" readonly="readonly" value="<%=customer_movedate%>"><span class="req">&nbsp;*<br></span></td>
	</tr>

	<tr>
		<td class="title3" colspan="3"><br>
		Pickup From<br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Contact Name:&nbsp;</td>
		<td><input type="text" name="strPickup_Contact" id="strPickup_Contact" size="40"><span class="req">&nbsp;*</span></td>
		<td valign="top" <% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>rowspan="16"<% Else %>rowspan="13"<% End If %>>
			<div class="imagebox" style="float:right;">
				<% stateimage = "//d36b03yirdy1u9.cloudfront.net/images/states-home/" & strQuote_shippingfromstateabbr & ".jpg" %>
				<img src="<%=stateimage%>" width="210"  alt="Direct Express Auto Transport Employee" />
				<div>Please do not ship a vehicle from yourself to yourself. Take the stress out of it and have alternate contacts that can meet the driver in case you cannot. Fill out vehicle condition upon pickup.</div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Company:&nbsp;</td>
		<td><input type="text" name="strPickup_Company" id="strPickup_Company" size="40"></td>
	</tr>

	<tr>
		<td class="formtext" align="right">Address:&nbsp;</td>
		<td><input type="text" name="strPickup_Address1" id="strPickup_Address1" size="40"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext"> </td>
		<td><input type="text" name="strPickup_Address2" id="strPickup_Address2" size="40"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">City:&nbsp;</td>
		<td><input type="text" name="strPickup_City" id="strPickup_City" size="30" value="<%= strQuote_shippingfromcity %>"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">State:&nbsp;</td>
		<td class="bodytext2"><%= strQuote_shippingfromstate %>
		<input type="hidden" name="strPickup_State" id="strPickup_State" value="<%= strQuote_shippingfromstateabbr %>">
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Zip:&nbsp;</td>
		<td><input type="text" name="strPickup_Zip" id="strPickup_Zip" size="10" value="<%= strQuote_shippingfromzip %>" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Pickup&nbsp;Location&nbsp;Is:&nbsp;</td>
		<td class="bodytext2">
		<input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_res" value="Residential" onclick="$('#Pickup_Location_Hours').hide();$('#strPickup_Location_Hours').val('');"> Residential&nbsp;&nbsp;&nbsp;
		<input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_bus" value="Business" onclick="$('#Pickup_Location_Hours').show();"> Business&nbsp;&nbsp;&nbsp;
		<input type="radio" name="strPickup_Location_Type" id="strPickup_Location_Type_port" value="Port" onclick="$('#Pickup_Location_Hours').hide();$('#strPickup_Location_Hours').val('');"> Port

		</td>
	</tr>
	<tr id="Pickup_Location_Hours" style="display:none;">
		<td class="formtext" align="right">Business Hours:</td>
		<td><input type="text" name="strPickup_Location_Hours" id="strPickup_Location_Hours" size="40" maxlength="99"></td>
	</tr>

	<tr>
		<td class="formtext" align="right">Home Phone:&nbsp;</td>
		<td><input type="text" name="strPickup_HomePhone" id="strPickup_HomePhone" size="25"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Work Phone:&nbsp;</td>
		<td><input type="text" name="strPickup_WorkPhone" id="strPickup_WorkPhone" size="25"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Cell Phone:&nbsp;</td>
		<td><input type="text" name="strPickup_CellPhone" id="strPickup_CellPhone" size="25"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">&nbsp;</td>
		<td><div class="Sep5"></div>At least one phone number is required</td>
	</tr>
	<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
		<tr>
			<td class="formtext" align="right">Extra Instructions:</td>
			<td><input type="text" name="strPickup_ExtraInst" id="strPickup_ExtraInst" size="40" maxlength="200"></td>
		</tr>
		<tr>
			<td class="formtext" align="right"></td>
			<td><input type="checkbox" name="strPickup_ExtraInst_Send" id="strPickup_ExtraInst_Send" value="yes" /> Put Extra Instructions on B.O.L.</td>
		</tr>

		<%
		cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=" & strQuote_shippingfromcity & "&pickupState=" & strQuote_shippingfromstateabbr & "&pickupZip=" & strQuote_shippingfromzip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=" &  strQuote_shippingtocity & "&deliveryState=" & strQuote_shippingtostateabbr & "&deliveryZip=" & strQuote_shippingtozip & "&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=9&secondarySort=4&listingsPerPage=100"
		cd50 = Server.URLEncode(cd50)
		cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=" & strQuote_shippingfromcity & "&pickupState=" & strQuote_shippingfromstateabbr & "&pickupZip=" & strQuote_shippingfromzip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=" &  strQuote_shippingtocity & "&deliveryState=" & strQuote_shippingtostateabbr & "&deliveryZip=" & strQuote_shippingtozip & "&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=9&secondarySort=4&listingsPerPage=100"
		cd100 = Server.URLEncode(cd100)

		%>
		<tr>
			<td class="formtext" align="right"></td>
			<td>
			<a href="/admin2k7/redir.asp?url=<%= cd50 %>&orderid=0&type=centraldispatchsearch" target="_new">CD 50</a>
			&nbsp;&nbsp;
			<a href="/admin2k7/redir.asp?url=<%= cd100 %>&orderid=0&type=centraldispatchsearch" target="_new">CD 100</a>

			</td>
		</tr>



	<% End If %>


	<tr>
		<td class="title3" colspan="3"><br>
		Deliver To<br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Contact Name:&nbsp;</td>
		<td><input type="text" name="strDeliver_Contact" id="strDeliver_Contact" size="40"><span class="req">&nbsp;*</span></td>
		<td valign="top" <% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>rowspan="16"<% Else %>rowspan="13"<% End If %>>
			<div class="imagebox" style="float:right;">
				<% stateimage = "//d36b03yirdy1u9.cloudfront.net/images/states-home/" & strQuote_shippingtostateabbr & ".jpg" %>
				<img src="<%=stateimage%>" width="210"  alt="Direct Express Auto Transport Employee" />
				<div>The driver will have a vehicle condition report for you to sign. Please go over it carefully and pay the carrier the balance owed with a money order or cash upon delivery.</div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Company:&nbsp;</td>
		<td><input type="text" name="strDeliver_Company" id="strDeliver_Company" size="40"></td>
	</tr>

	<tr>
		<td class="formtext" align="right">Address:&nbsp;</td>
		<td><input type="text" name="strDeliver_Address1" id="strDeliver_Address1" size="40"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext"> </td>
		<td><input type="text" name="strDeliver_Address2" id="strDeliver_Address2" size="40"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">City:&nbsp;</td>
		<td><input type="text" name="strDeliver_City" id="strDeliver_City" size="30" value="<%= strQuote_shippingtocity %>"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">State:&nbsp;</td>
		<td class="bodytext2"><%= strQuote_shippingtostate %>
		<input type="hidden" name="strDeliver_State" id="strDeliver_State" value="<%= strQuote_shippingtostateabbr %>">
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Zip:&nbsp;</td>
		<td><input type="text" name="strDeliver_Zip" id="strDeliver_Zip" size="10" value="<%= strQuote_shippingtozip %>" <%if adminactive=0 then%>readonly="readonly" style="border:0;"<%end if%>><%if adminactive=1 then%><span class="req">&nbsp;*</span><%end if%></td>
	</tr>

	<tr>
		<td class="formtext" align="right">Deliver&nbsp;Location&nbsp;Is:&nbsp;</td>
		<td class="bodytext2">
		<input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_res" value="Residential" onclick="$('#Deliver_Location_Hours').hide();$('#strDeliver_Location_Hours').val('');"> Residential&nbsp;&nbsp;&nbsp;
		<input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_bus" value="Business" onclick="$('#Deliver_Location_Hours').show();"> Business&nbsp;&nbsp;&nbsp;
		<input type="radio" name="strDeliver_Location_Type" id="strDeliver_Location_Type_port" value="Port" onclick="$('#Deliver_Location_Hours').hide();$('#strDeliver_Location_Hours').val('');"> Port

		</td>
	</tr>
	<tr id="Deliver_Location_Hours" style="display:none;">
		<td class="formtext" align="right">Business Hours:</td>
		<td><input type="text" name="strDeliver_Location_Hours" id="strDeliver_Location_Hours" size="40" maxlength="99"></td>
	</tr>



	<tr>
		<td class="formtext" align="right">Home Phone:&nbsp;</td>
		<td><input type="text" name="strDeliver_HomePhone" id="strDeliver_HomePhone" size="25"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Work Phone:&nbsp;</td>
		<td><input type="text" name="strDeliver_WorkPhone" id="strDeliver_WorkPhone" size="25"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Cell Phone:&nbsp;</td>
		<td><input type="text" name="strDeliver_CellPhone" id="strDeliver_CellPhone" size="25"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">&nbsp;</td>
		<td><div class="Sep5"></div>At least one phone number is required</td>
	</tr>

	<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
		<tr>
			<td class="formtext" align="right">Extra Instructions:</td>
			<td><input type="text" name="strDeliver_ExtraInst" id="strDeliver_ExtraInst" size="40" maxlength="200"></td>
		</tr>
		<tr>
			<td class="formtext" align="right"></td>
			<td><input type="checkbox" name="strDeliver_ExtraInst_Send" id="strDeliver_ExtraInst_Send" value="yes" /> Put Extra Instructions on B.O.L.</td>
		</tr>


		<%
		cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=" & strQuote_shippingtocity & "&pickupState=" & strQuote_shippingtostateabbr & "&pickupZip=" & strQuote_shippingtozip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=" &  strQuote_shippingfromcity & "&deliveryState=" & strQuote_shippingfromstateabbr & "&deliveryZip=" & strQuote_shippingfromzip & "&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=9&secondarySort=4&listingsPerPage=100"
		cd50 = Server.URLEncode(cd50)
		cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=" & strQuote_shippingtocity & "&pickupState=" & strQuote_shippingtostateabbr & "&pickupZip=" & strQuote_shippingtozip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=" &  strQuote_shippingfromcity & "&deliveryState=" & strQuote_shippingfromstateabbr & "&deliveryZip=" & strQuote_shippingfromzip & "&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=9&secondarySort=4&listingsPerPage=100"
		cd100 = Server.URLEncode(cd100)

		%>
		<tr>
			<td class="formtext" align="right"></td>
			<td>
			<a href="/admin2k7/redir.asp?url=<%= cd50 %>&orderid=0&type=centraldispatchsearch" target="_new">CD 50</a>
			&nbsp;&nbsp;
			<a href="/admin2k7/redir.asp?url=<%= cd100 %>&orderid=0&type=centraldispatchsearch" target="_new">CD 100</a>

			</td>
		</tr>


	<% End If %>
<tr>
		<td class="title3" colspan="3"><br>
		Referred From<br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">How Did You Hear About Us?:&nbsp;</td>
		<td>
		<select name="ReferringSite" id="ReferringSite">
		<option value="1" SELECTED>-- Please Select --</option>
		<%
		'referringsites="Google Search,Yahoo Search,Bing Search,Other Search,Review Site,Directory Site,E-Mail Quote,Referral,Facebook,BBB,Return Customer,Other"
		referringsites="Google Search,Yahoo Search,Bing Search,Other Search,Review Site,Directory Site,E-Mail Quote,Referral,Facebook,Return Customer,Other"
		keywordArray=split(referringsites,",")
		for L=0 to UBound(keywordArray)
			response.write "<option value=""" & keywordArray(L) & """>" & keywordArray(L) & "</option>" & vbcrlf
		next
		 %>
		</select>
		</td>
	</tr>


	<tr>
		<td class="title3" colspan="3"><br>
		Terms & Conditions
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" colspan="2" align="center">
<textarea cols="70" rows="10" name="termsconditions" id="termsconditions" readonly class="bodytext" style="width:500px;">
Shipper and Direct Express Auto Transport Agree To The Following:

1. Pick up and delivery is from your door to your door unless residential area restrictions apply. If your vehicle is inoperable or oversize (dual or oversize wheels, extra-large, racks, lifted, limo, etc.), please inquire as to extra charges. If carrier is not advised of inoperable or oversized vehicles prior to pick-up, all extra charges must be paid in cash or money order made payable to delivery company upon delivery.

2. The carrier and driver jointly and separately are authorized to operate and transport his/her or their motor vehicle between its pick up location and the destination set forth on this shipping order-bill of lading.

3. Direct Express agrees to provide a carrier to transport your vehicle as promptly as possible in accordance with your instructions but cannot guarantee pick-up or delivery on a specified date or time. If the customer cancels an order his deposit will be refunded in full. Direct Express reserves the right to reject any order and will refund the deposit in full.

4. If a shipping rate was chosen greater than the Standard Rate, it cannot be changed once a carrier has been assigned, regardless of estimated shipping dates or date of assignment. All changes to the shipping price, whether greater or lesser in amount, must occur prior to vehicle assignment and acknowledged by Direct Express via email. The carrier accepted your vehicle for shipping and reserved space for it based upon the amount offered and is not responsible for how long it took to have it assigned, picked up or delivered.

5. Shipper shall remove all non-permanent outside mounted luggage and other racks prior to shipment. Vehicles must be tendered to carrier in good running condition (unless otherwise noted) with no more than a half tank of fuel (prefer 1/4 tank).

6. Luggage and personal property must be confined to trunk, with no heavy articles, and not to exceed 100 lbs.. Carrier is not liable for personal items left in vehicle, nor for damage caused to vehicle from excessive or improper loading of personal items. Direct Express does not agree to pay for your rental of a vehicle, nor shall it be liable for failure of mechanical or operating parts of your vehicle.

7. Trucking damage claims are covered by a minimum of 3/4 of a million dollars public liability and property damage. All claims must be noted and signed for at time of delivery, and submitted in writing within 15 days of delivery. Direct Express will share the carrier insurance policy upon request.

8. No electronic equipment, valuables, plants, live pets, alcohol, drugs or firearms, may be left in the vehicle.

9. International orders,the car must be empty except for factory installed equipment. Indicate serial #, and give car's approximate value in U.S. dollars. Shipper is responsible for the proper customs paperwork. (ask the assigned carrier for help with these documents)

10. Shipper warrants that he will pay the price quoted due Direct Express Auto Transport, Inc. for delivered vehicles, and will not seek to charge back a credit card or stop a check to offset any dispute for damage claims. Department of Transportation regulations require that all claims be filed in writing and all tariffs be paid in full before claim can be processed.

This agreement and any shipment here under is subject to all terms and conditions of the carrier's tariff and the uniform straight bill of lading, copies of which are available at the office of the carrier.

This supersedes all prior written or oral representation of Direct Express and constitutes the entire agreement between shipper and Direct Express and may not be changed except in writing signed by an officer of Direct Express.

Direct Express' U.S. Department of Transportation Broker's license number is 479342.

</textarea><br><br>
		<input type="checkbox" name="agreetoterms" id="agreetoterms" value="1">&nbsp;Click here to agree to terms and conditions.
		<div class="req"></div>
		</td>
		<td valign="top">
			<div class="imagebox" style="float:right;">
				<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote2-6.jpg" width="210" height="162" alt="Direct Express Auto Transport Employee" />
				<div>Go On ... just one more step and you're done!</div>
			</div>
		</td>
	</tr>



	<tr>
		<td colspan="2" align="center">
		<br>

		<input type="submit" id="Submit" value="Go On &raquo;"  class="submitbutton2" />


		<%If Session("lang") = "esp" Then%>
		<input type="hidden" value="ESP" name="strSalesRep">
		<%
		Else
		'CurrentUsername = Session("Username")
		%>
		<input type="hidden" name="strSalesRep" value="<%=CurrentUsername%>">
		<%End If%>
		</td>
	</tr>

		<tr>
		<td class="req" colspan="3"><br>
		* = required
		</td>
	</tr>

	</table>
	</form>


	</td>
</tr>
</table>





<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
<script type="text/javascript">
$(document).ready(function() {
	<% if howmany <> "onevehicle" then %>
		<%
		counter=1
		for counter = 1 to numvehiclestemp
		%>

		$('#vehicle_comingfrom_vin<%=counter%>').show();

		<% next %>
	<% else %>
		$('#vehicle_comingfrom_vin').show();
	<% end if %>
});
</script>

<% end if %>


<!--#include file="../includes/footer.asp"-->
