<% pagetitle = "Direct Express Auto Transport - quote Summary" %>
<% metadescription = "Auto Shipping &amp; Car Transport &amp; Shipping transport car has never been easier..." %>
<% metakeywords = "automobile transport quote, auto shipping, auto transport quote, car transport quote, door to door transport, national transport quote, sedan transport quote, sports car transport quote" %>
<% pagename="quote1" %>
<% prettyphoto=1 %>
<% gmaps="1" %>

<!--#include virtual="/includes/header.asp"-->




<%
dim conn
call openDB()

'Check Banning of IPs and GUIDs
banned = CheckBan(Request.ServerVariables("REMOTE_ADDR"),guid)
If banned = "1" Then
	response.redirect "/?error=limit"
End If



'Get Username from Cookie
If Session("Username") = "" Then
	%>
	<!--#INCLUDE VIRTUAL="/pwprotect/config_inc.asp"-->
	<%
	CurrentUsername = RC4(Request.Cookies("PASSWORDSYSTEMCOOKIE")("COOKIE_USERNAME"), CookieEncryptionKey)

	If CurrentUsername <> "" Then
		Session("Username") = CurrentUsername
	End If
Else
	CurrentUsername = Session("Username")
End If


if Session("SRCUsername") <> "" then
    CurrentUsername = Session("SRCUsername")
end if


shippingfromzip = getUserInput(Request.Form("shippingfromzip"),0)
shippingfromcity = getUserInput(Request.Form("shippingfromcity"),0)
shippingfromstate = getUserInput(Request.Form("shippingfromstate"),0)
shippingfromstateabbr = GetStateAbbr(shippingfromstate)
shippingfromstateabbr = ucase(shippingfromstateabbr)
shippingtozip = getUserInput(Request.Form("shippingtozip"),0)
shippingtocity = getUserInput(Request.Form("shippingtocity"),0)
shippingtostate = getUserInput(Request.Form("shippingtostate"),0)
shippingtostateabbr = GetStateAbbr(shippingtostate)
shippingtostateabbr = ucase(shippingtostateabbr)


shippingfromcitystate = getUserInput(Request.Form("shippingfromcitystate"),0)
shippingtocitystate = getUserInput(Request.Form("shippingtocitystate"),0)

if shippingfromcitystate <> "" then
    citystate=Split(shippingfromcitystate,",")
    shippingfromcity = citystate(0)
    shippingfromstate = trim(citystate(1))
    shippingfromstateabbr = shippingfromstate
end if

if shippingtocitystate <> "" then
    citystate=Split(shippingtocitystate,",")
    shippingtocity = citystate(0)
    shippingtostate = trim(citystate(1))
    shippingtostateabbr = shippingtostate
end if

shippingfrom_sales = getUserInput(Request.Form("shippingfrom_sales"),0)

auto_year = getUserInput(Request.Form("auto_year"),0)
auto_model = getUserInput(Request.Form("auto_model"),0)
auto_make = getUserInput(Request.Form("auto_make"),0)

vehicle_operational = getUserInput(Request.Form("vehicle_operational"),0)
vehicle_trailer = getUserInput(Request.Form("vehicle_trailer"),0)
session("vehicle_operational") = vehicle_operational
session("vehicle_trailer") = vehicle_trailer


customer_name = getUserInput(Request.Form("customer_name"),0)
customer_email = getUserInput(Request.Form("customer_email"),0)

if session("Username") = "" and session("repeat_discount")=0 then
	customer_phone = getUserInput(Request.Form("customer_phone"),0)
	customer_movedate = getUserInput(Request.Form("customer_movedate"),0)
	if customer_movedate <> "" then
    	customer_movedatedb = fncFmtDate(customer_movedate,"%Y-%m-%d")
	end if
end if

if session("repeat_email") <> "" then
	customer_email = session("repeat_email")
end if

howmany = getUserInput(Request.Form("howmany"),0)
numvehicles = getUserInput(Request.Form("numvehicles"),0)
auto_year2 = getUserInput(Request.Form("auto_year2"),0)
auto_make2 = getUserInput(Request.Form("auto_make2"),0)
auto_model2 = getUserInput(Request.Form("auto_model2"),0)
auto_year3 = getUserInput(Request.Form("auto_year3"),0)
auto_make3 = getUserInput(Request.Form("auto_make3"),0)
auto_model3 = getUserInput(Request.Form("auto_model3"),0)
auto_year4 = getUserInput(Request.Form("auto_year4"),0)
auto_make4 = getUserInput(Request.Form("auto_make4"),0)
auto_model4 = getUserInput(Request.Form("auto_model4"),0)
auto_year5 = getUserInput(Request.Form("auto_year5"),0)
auto_make5 = getUserInput(Request.Form("auto_make5"),0)
auto_model5 = getUserInput(Request.Form("auto_model5"),0)





'Check for discount from CD
'cddiscount=checkcddiscountv6(shippingfromzip,shippingtozip)
cddiscount="0|0|0-0"



'SALES CONVERSION UPDATE start
trackid = session("trackid")
If trackid <> "" Then

	startzip = shippingfromzip
	endzip = shippingtozip
	totaldistance = GetDistancePHP(startzip,endzip)
	totaldistance = cint(totaldistance)

	startzip = shippingfromzip
	endzip = shippingtozip
	PriceSource=checkpricesourcev3(startzip,endzip,totaldistance)

	zipadjustrating = GetRatingRep(startzip,endzip,totaldistance)

	if InStr(cddiscount,"|") > 0 then
		discountsplit=Split(cddiscount,"|")
		cd_ratio_perc = discountsplit(0)
		cd_ratio = discountsplit(1)
		cd_ratio_range = discountsplit(2)
	else
		cd_ratio_perc = "null"
		cd_ratio = "null"
	end if

	CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
	strSQL = "update sale_conversion set fromzip='" & shippingfromzip & "',tozip='" & shippingtozip & "',quote_distance=" & totaldistance & ",PricingSource='" & PriceSource & "',cd_ratio_perc=" & cd_ratio_perc & ",cd_ratio=" & cd_ratio & ",cd_ratio_range='" & cd_ratio_range & "',zipadjustrating='" & zipadjustrating & "',dateupdated='" & CurrentDateTime & "',sale_status = '2. Quote Summary' where trackid = '" & trackid & "'"

	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3

'	if session("stopleads") <> 1 and session("Username") = "" then
	if session("Username") = "" and session("repeat_discount")=0 then

		if customer_movedatedb <> "" then
		    strSQL = "update leads set customer_name='" & customer_name & "',customer_phone='" & customer_phone & "',customer_email='" & customer_email & "',customer_movedate='" & customer_movedatedb & "', dateupdated='" & CurrentDateTime & "',quote_status = 'Step 3' where trackid = '" & trackid & "'"
		else
		    strSQL = "update leads set customer_name='" & customer_name & "',customer_phone='" & customer_phone & "',customer_email='" & customer_email & "', dateupdated='" & CurrentDateTime & "',quote_status = 'Step 3' where trackid = '" & trackid & "'"
        end if
		Set Rs = Server.CreateObject("ADODB.Recordset")
		    Rs.Open strSQL,conn,3,3

	end if


End If
'SALES CONVERSION UPDATE end


If vehicle_trailer = "Enclosed" Then
	enclosed = 1
Else
	enclosed = 0
End If

'Repeat Customer Check
if session("repeat_discount")=1 then
	DEATDeposit = DEATDeposit - 10
end if


if howmany = "onevehicle" then
	shippingfromziptemp = shippingfromzip
	shippingtoziptemp = shippingtozip
	totalprice = GetQuote(auto_year,auto_make,auto_model,shippingfromziptemp,shippingtoziptemp,enclosed,auto_priceadjustment,0)
	shipprice1 = totalprice-DEATDeposit
	'Change price on vehicle condition
	If vehicle_operational = "Non-Running" Then
		totalprice = totalprice + 150
	End If

else

	shippingfromziptemp = shippingfromzip
	shippingtoziptemp = shippingtozip
	shipprice1 = GetQuote(auto_year,auto_make,auto_model,shippingfromziptemp,shippingtoziptemp,enclosed,auto_priceadjustment,0)
	shipprice1 = shipprice1-DEATDeposit


	if auto_make2<>"" and auto_model2<>"" then
		shippingfromziptemp = shippingfromzip
		shippingtoziptemp = shippingtozip
		shipprice2 = GetQuote(auto_year2,auto_make2,auto_model2,shippingfromziptemp,shippingtoziptemp,enclosed,auto_priceadjustment,0)
		shipprice2 = shipprice2-DEATDeposit
	end if

	if auto_make3<>"" and auto_model3<>"" then
		shippingfromziptemp = shippingfromzip
		shippingtoziptemp = shippingtozip
		shipprice3 = GetQuote(auto_year3,auto_make3,auto_model3,shippingfromziptemp,shippingtoziptemp,enclosed,auto_priceadjustment,0)
		shipprice3 = shipprice3-DEATDeposit
	end if

	if auto_make4<>"" and auto_model4<>"" then
		shippingfromziptemp = shippingfromzip
		shippingtoziptemp = shippingtozip
		shipprice4 = GetQuote(auto_year4,auto_make4,auto_model4,shippingfromziptemp,shippingtoziptemp,enclosed,auto_priceadjustment,0)
		shipprice4 = shipprice4-DEATDeposit
	end if

	if auto_make5<>"" and auto_model5<>"" then
		shippingfromziptemp = shippingfromzip
		shippingtoziptemp = shippingtozip
		shipprice5 = GetQuote(auto_year5,auto_make5,auto_model5,shippingfromziptemp,shippingtoziptemp,enclosed,auto_priceadjustment,0)
		shipprice5 = shipprice5-DEATDeposit
	end if

'	response.write "<b>Prices without deposits</b><br>"
' 	response.write auto_make & " - " & auto_model & ": " & shipprice1 & "<br>"
' 	response.write auto_make2 & " - " & auto_model2 & ": " & shipprice2 & "<br>"
' 	response.write auto_make3 & " - " & auto_model3 & ": " & shipprice3 & "<br>"
' 	response.write auto_make4 & " - " & auto_model4 & ": " & shipprice4 & "<br>"
' 	response.write auto_make5 & " - " & auto_model5 & ": " & shipprice5 & "<br>"
' 	response.write auto_make6 & " - " & auto_model6 & ": " & shipprice6 & "<br>"
' 	response.write auto_make7 & " - " & auto_model7 & ": " & shipprice7 & "<br>"
' 	response.write auto_make8 & " - " & auto_model8 & ": " & shipprice8 & "<br>"
' 	response.write auto_make9 & " - " & auto_model9 & ": " & shipprice9 & "<br>"
' 	response.write auto_make10 & " - " & auto_model10 & ": " & shipprice10 & "<br>"
' 	response.write "-----------------------------------------------<br>"

	numvehicles = cint(numvehicles)
	subtotaldeposits = DEATDeposit * numvehicles
	nonrunningcharge=0

	'Change price on vehicle condition
	If vehicle_operational = "Non-Running" Then
		nonrunningcharge = numvehicles * 150
	End If


	subtotalcarrier = 0
	if isnumeric(shipprice1) then
		subtotalcarrier = subtotalcarrier + shipprice1
	end if
	if isnumeric(shipprice2) then
		subtotalcarrier = subtotalcarrier + shipprice2
	end if
	if isnumeric(shipprice3) then
		subtotalcarrier = subtotalcarrier + shipprice3
	end if
	if isnumeric(shipprice4) then
		subtotalcarrier = subtotalcarrier + shipprice4
	end if
	if isnumeric(shipprice5) then
		subtotalcarrier = subtotalcarrier + shipprice5
	end if


	'response.write "subtotalcarrier: " & subtotalcarrier & "<br>"
	'response.write "subtotaldeposits: " & subtotaldeposits & "<br>"



	if cint(numvehicles)<3 then
		depositdiscount=0*numvehicles
		carrierdiscount=0*numvehicles
	elseif numvehicles>=3 and numvehicles<=6 then
		depositdiscount=25*numvehicles
		carrierdiscount=25*numvehicles
	elseif numvehicles>=7 and numvehicles<=10 then
		depositdiscount=50*numvehicles
		carrierdiscount=50*numvehicles
	end if

	'response.write "carrierdiscount: " & carrierdiscount & "<br>"
	'response.write "depositdiscount: " & depositdiscount & "<br>"


	totalcarrier = subtotalcarrier - carrierdiscount
	totaldeposit = subtotaldeposits - depositdiscount

	depositpervehicle = cint(totaldeposit) / cint(numvehicles)

	'response.write "totalcarrier: " & totalcarrier & "<br>"
	'response.write "totaldeposit: " & totaldeposit & "<br>"
	'response.write "nonrunningcharge: " & nonrunningcharge & "<br>"


	totalprice = totalcarrier+totaldeposit+nonrunningcharge
	'response.write "totalprice: " & totalprice & "<br>"

end if

'response.end



strSQL = "update sale_conversion set quote_amount='" & totalprice & "' where trackid = '" & trackid & "'"
Set Rs = Server.CreateObject("ADODB.Recordset")
    Rs.Open strSQL,conn,3,3

rating_origin = GetCancelPerc(shippingfromzip,"pickup_zip",0)
rating_dest = GetCancelPerc(shippingtozip,"deliver_zip",0)
'rating_vehicle = GetVehicleRating(auto_make,auto_model,0)
rating_vehicle = 0

If rating_vehicle <> 0 then
	rating_avg = (rating_origin+rating_dest+rating_vehicle)/3
else
	rating_avg = (rating_origin+rating_dest)/2
End if
rating_avg = FormatNumber(rating_avg,0)

If isnumeric(totalprice) Then
Else
	If totalprice = "error1" Then
		response.redirect "/?error=badfrom"
	ElseIf totaltemp = "error2" Then
		response.redirect "/?error=badto"
	Else
		response.redirect "/?error=badunknown"
	End If
End If


' response.write "end"
' response.End


strSQL=""
strSQL=strSQL&"SELECT	OrderID, DateAvailable, CarrierExpectedPickupDate, DATEDIFF(CarrierExpectedPickupDate,DateAvailable) AS DaysWaiting "
strSQL=strSQL&"from	orders  "
strSQL=strSQL&"where	DateAvailable between SUBDATE(current_date(),30) and current_date() and "
strSQL=strSQL&"		status='assigned' and  "
strSQL=strSQL&"		Pickup_State='"&shippingfromstateabbr&"' and "
strSQL=strSQL&"		DateAvailable = DateAvailable_Initial and "
strSQL=strSQL&"		(DateAvailable_Initial is not null and DateAvailable is not null and CarrierExpectedPickupDate is not null) "
strSQL=strSQL&"order by orderid"
strSQLfrom=strSQL
'response.write strSQL
Set RsPickupStats = Server.CreateObject("ADODB.Recordset")
	RsPickupStats.Open strSQL,conn
DaysWaitingPickup = 0
DaysWaitingPickupTotalOrders = 0
If not RsPickupStats.eof Then
	do until RsPickupStats.eof
		DaysWaitingPickup = DaysWaitingPickup + cint(RsPickupStats("DaysWaiting"))
		DaysWaitingPickupTotalOrders = DaysWaitingPickupTotalOrders + 1
	RsPickupStats.moveNext
	loop
	set RsPickupStats=nothing
End If

if DaysWaitingPickup=0 or DaysWaitingPickupTotalOrders=0 then
	DaysWaitingPickupAvg=0
else
	DaysWaitingPickupAvg = DaysWaitingPickup/DaysWaitingPickupTotalOrders
end if
DaysWaitingPickupAvg=FormatNumber(DaysWaitingPickupAvg,0)

strSQL=""
strSQL=strSQL&"SELECT	OrderID, DateAvailable, CarrierExpectedPickupDate, DATEDIFF(CarrierExpectedPickupDate,DateAvailable) AS DaysWaiting "
strSQL=strSQL&"from	orders  "
strSQL=strSQL&"where	DateAvailable between SUBDATE(current_date(),30) and current_date() and "
strSQL=strSQL&"		status='assigned' and  "
strSQL=strSQL&"		Deliver_State='"&shippingtostateabbr&"' and "
strSQL=strSQL&"		DateAvailable = DateAvailable_Initial and "
strSQL=strSQL&"		(DateAvailable_Initial is not null and DateAvailable is not null and CarrierExpectedPickupDate is not null) "
strSQL=strSQL&"order by orderid"
strSQLto=strSQL
'response.write strsql
Set RsDeliverStats = Server.CreateObject("ADODB.Recordset")
	RsDeliverStats.Open strSQL,conn
DaysWaitingDeliver = 0
DaysWaitingDeliverTotalOrders = 0
If not RsDeliverStats.eof Then
	do until RsDeliverStats.eof
		DaysWaitingDeliver = DaysWaitingDeliver + cint(RsDeliverStats("DaysWaiting"))
		DaysWaitingDeliverTotalOrders = DaysWaitingDeliverTotalOrders + 1
	RsDeliverStats.moveNext
	loop
	set RsDeliverStats=nothing
End If

if DaysWaitingDeliver=0 or DaysWaitingDeliverTotalOrders=0 then
	DaysWaitingDeliverAvg=0
else
	DaysWaitingDeliverAvg = DaysWaitingDeliver/DaysWaitingDeliverTotalOrders
end if
DaysWaitingDeliverAvg=FormatNumber(DaysWaitingDeliverAvg,0)


if DaysWaitingPickupAvg=0 or DaysWaitingDeliverAvg=0 then
	DaysWaitingAvg=0
else
	DaysWaitingAvg = (cint(DaysWaitingPickupAvg)+cint(DaysWaitingDeliverAvg))/2
end if
DaysWaitingAvg=FormatNumber(DaysWaitingAvg,0)
DaysWaitingAvg=CDbl(DaysWaitingAvg)




if howmany = "onevehicle" then
	strDeposit = DEATDeposit
	depositpervehicle = DEATDeposit
else
	strDeposit = totaldeposit
end if


' 'Get Message Text
msg_textstart = ""
startzip = shippingfromzip
endzip = shippingtozip


'Check for Zip Message Start
strSQL="select NearCity, Status from ziprateadjust where partialzip='" & left(startzip,3) & "'"
'response.write strsql
Set RsAlertZip = Server.CreateObject("ADODB.Recordset")
	RsAlertZip.Open strSQL,conn
If not RsAlertZip.eof Then
	NearCity_from = RsAlertZip("NearCity")
	MessageStatus_from = RsAlertZip("Status")
	set RsAlertZip=nothing
End If

if NearCity_from <> "" and MessageStatus_from <> "" then
	if MessageStatus_from = "2" then
		recommendstatus_from = "much"
	end if
	Message_From = "<b style='color:#000'>Helpful Hint:</b><br>It might be " & recommendstatus_from & " easier and quicker shipping from <b>" & NearCity_from & "</b>."
end if




'Check for Zip Message End
strSQL="select NearCity, Status from ziprateadjust where partialzip='" & left(endzip,3) & "'"
'response.write strsql
Set RsAlertZip = Server.CreateObject("ADODB.Recordset")
	RsAlertZip.Open strSQL,conn
If not RsAlertZip.eof Then
	NearCity_to = RsAlertZip("NearCity")
	MessageStatus_to = RsAlertZip("Status")
	set RsAlertZip=nothing
End If

if NearCity_to <> "" and MessageStatus_to <> "" then
	if MessageStatus_to = "2" then
		recommendstatus_to = "much"
	end if
	Message_To = "<b style='color:#000'>Helpful Hint:</b><br>It might be " & recommendstatus_to & " easier and quicker shipping from <b>" & NearCity_to & "</b>."
end if

'SALES CONVERSION UPDATE start
If trackid <> "" and MessageStatus_from<>"" and MessageStatus_to<>"" Then
	strSQL = "update sale_conversion set fromzipstatus='" & MessageStatus_from & "',tozipstatus='" & MessageStatus_to & "' where trackid = '" & trackid & "'"
	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3
End If
'SALES CONVERSION UPDATE end


'Alert Text END

strSQL = "select latitude,longitude from zipcodes where Zipcode = '" & shippingfromzip & "' limit 1"
Set Rsshippingfromlatlong = Server.CreateObject("ADODB.Recordset")
    Rsshippingfromlatlong.Open strSQL,conn
If not Rsshippingfromlatlong.eof Then
	fromlat = Rsshippingfromlatlong("latitude")
	fromlong = Rsshippingfromlatlong("longitude")
End If

strSQL = "select latitude,longitude from zipcodes where Zipcode = '" & shippingtozip & "' limit 1"
Set Rsshippingtolatlong = Server.CreateObject("ADODB.Recordset")
    Rsshippingtolatlong.Open strSQL,conn
If not Rsshippingtolatlong.eof Then
	tolat = Rsshippingtolatlong("latitude")
	tolong = Rsshippingtolatlong("longitude")
End If

%>

<style type="text/css">
#map1, #map2 {
	margin: 40px 0 20px 0;
	border: 1px solid #666;
	width: 187px;
	height: 240px;
}
.mapmsg {
	width: 190px;
	margin-bottom: 10px;
	color: #000099;
	font-size: 13px;
}

.ui-widget-overlay {
	opacity: 0.6;
}
</style>

<script language="Javascript">
$(function() {

	$('#map1').gmap({ 'center': '<%=fromlat%>,<%=fromlong%>' }).bind();
	$('#map1').gmap('option', 'zoom', 8);
	$('#map2').gmap({ 'center': '<%=tolat%>,<%=tolong%>' }).bind();
	$('#map2').gmap('option', 'zoom', 8);

<% If len(Session("username")) > 0 and session("emailrefer") = "" and (Message_To <> "" or Message_From <> "") Then %>

	$("#confirmLink").click(function(e) {
		e.preventDefault();
		var targetUrl = $(this).attr("href");

		$("#dialog").dialog({
		  modal: true,
		  buttons : {
		    "YES" : function() {
		    	document.mainform.helpfulhintmention.value='yes';
		    	document.mainform.submit();
		    },
		    "NO" : function() {
		    	document.mainform.helpfulhintmention.value='no';
		      	$(this).dialog("close");
		    },
		    "IGNORE" : function() {
		    	document.mainform.helpfulhintmention.value='ignore';
		    	document.mainform.submit();
		    }
		  }
		});

		$("#dialog").dialog("open");
	});

<% End If %>

});




</script>

<div id="dialog" title="Confirmation Required" style="display:none;">
Did you notify the customer of the helpful hint?
</div>


<div class="title1" style="margin-left:10px">Quote Summary<br>

</div>

<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td width="100%" class="bodytext2">



<% If vehicletype = "Oversize Vehicles" or vehicletype = "Other" Then %>
<div class="bodytext2" align="center">
<blockquote>
<b><%=dictLanguage.Item(Session("lang")&"_quote_40")%></b>
</blockquote>
</div><br><br>
<% Else  %>

<div class="stateleft"><img src="//d36b03yirdy1u9.cloudfront.net/images/states/<%=shippingfromstateabbr%>.jpg" />


<div id="map1"></div>
<%If Message_From <> "" Then %>
	<div class="mapmsg">
	<%=Message_From%>
	</div>
<%End If%>



<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
	<style type="text/css">
	select#honorquoteprice,select#turbochargeprice {
		padding-top: 10px;
		font-size: 15px;
		width: 125px;
	}
	</style>
	<div style="font-size:15px;">
	<script language="JavaScript">
	function honorquote() {
		$("#turbochargeprice").val('0');
		$("#militarydiscountprice").val('0');
		$("#reviewdiscountprice").val('0');
		document.mainform.turbochargeincrease.value = 0;
		document.mainform.militarydiscountreduction.value = 0;
		document.mainform.reviewdiscountreduction.value = 0;
		document.mainform.honorquotereduction.value = document.honor.honorquoteprice.value;
		var reducedprice = <%= totalprice %>-parseInt(document.mainform.honorquotereduction.value);
		var totalprice = reducedprice+'.00';
		document.mainform.strtotalprice.value=totalprice;
		$('span#totalprice').html(totalprice);
	}
	function militarydiscount() {
		$("#turbochargeprice").val('0');
		$("#honorquoteprice").val('0');
		$("#reviewdiscountprice").val('0');
		document.mainform.turbochargeincrease.value = 0;
		document.mainform.honorquotereduction.value = 0;
		document.mainform.reviewdiscountreduction.value = 0;
		document.mainform.militarydiscountreduction.value = document.military.militarydiscountprice.value;
		var reducedprice = <%= totalprice %>-parseInt(document.mainform.militarydiscountreduction.value);
		var totalprice = reducedprice+'.00';
		document.mainform.strtotalprice.value=totalprice;
		$('span#totalprice').html(totalprice);
	}
	function reviewdiscount() {
		$("#turbochargeprice").val('0');
		$("#militarydiscountprice").val('0');
		$("#honorquoteprice").val('0');
		document.mainform.militarydiscountreduction.value = 0;
		document.mainform.turbochargeincrease.value = 0;
		document.mainform.honorquotereduction.value = 0;
		if (document.submitreview.reviewdiscountprice.value == '0') {
		    document.mainform.reviewdiscountreduction.value = 0;
	    } else {
		    document.mainform.reviewdiscountreduction.value = 25;
	    }
		document.mainform.reviewdiscountsite.value = document.submitreview.reviewdiscountprice.value;
		var reducedprice = <%= totalprice %>-parseInt(document.mainform.reviewdiscountreduction.value);
		var totalprice = reducedprice+'.00';
		document.mainform.strtotalprice.value=totalprice;
		$('span#totalprice').html(totalprice);
	}
	</script>
	<strong>Agreed To Submit Review</strong><br>
	<form name="submitreview">
	<select name="reviewdiscountprice" id="reviewdiscountprice" onchange="reviewdiscount();" style="width:100%">
		<option selected="selected" value="0">No Review</option>
        <option value="TransportReviews.com">TransportReviews.com ($-25)</option>
        <option value="Google+">Google+ Review ($-25)</option>
        <option value="Yelp">Yelp Review ($-25)</option>
	</select>
	</form>
	<br>
	<strong>Military Discount</strong><br>
	<form name="military">
	<select name="militarydiscountprice" id="militarydiscountprice" onchange="militarydiscount();"  style="width:100%">
		<option selected="selected" value="0">$0</option>
		<option value="25">$-25</option>
	</select>
	</form>
	<br>
	<strong>Honor Quote</strong><br>
	<form name="honor">
	<select name="honorquoteprice" id="honorquoteprice" onchange="honorquote();"  style="width:100%" >
		<option selected="selected" value="0">$0</option>
		<option value="25">$-25</option>
		<option value="50">$-50</option>
	</select>
	</form>
	<br><br>
	<a href="/index.asp?quoteaction=new" style="padding:5px 30px;background:blue;color:white;border: 2px solid black;font-weight:bold;font-size:12px;">New Quote</a>
	<br><br>
	<a href="/index.asp?quoteaction=redo" style="padding:5px 30px;background:#ffcf17;color:black;border: 2px solid black;font-weight:bold;font-size:12px;">Redo Quote</a>




	</div>
<%End If%>
</div>

<div class="stateright"><img src="//d36b03yirdy1u9.cloudfront.net/images/states/<%=shippingtostateabbr%>.jpg" />
<div id="map2"></div>
<%If Message_To <> "" Then %>
	<div class="mapmsg">
	<%=Message_To%>
	</div>
<%End If%>


<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
	<div style="font-size:15px;">
	<script language="JavaScript">
	function turbocharge() {
		$("#honorquoteprice").val('0');
		$("#militarydiscountprice").val('0');
		document.mainform.honorquotereduction.value = 0;
		document.mainform.militarydiscountreduction.value = 0;
		document.mainform.turbochargeincrease.value = document.turbocharged.turbochargeprice.value;
		var increasedprice = <%= totalprice %>+parseInt(document.mainform.turbochargeincrease.value);
		var totalprice = increasedprice+'.00';
		document.mainform.strtotalprice.value=totalprice;
		$('#totalprice').html(totalprice);
	}
	</script>
	<strong>Turbo Charge</strong><br>
	<form name="turbocharged">
	<select name="turbochargeprice" id="turbochargeprice" onchange="turbocharge();" style="width:100%">
		<option selected="selected" value="0">$0</option>
		<option value="50">$50</option>
		<option value="100">$100</option>
		<option value="200">$200</option>
	</select>
	</form>

	<br><br>

<script language="JavaScript">

function changetrailer() {
	var currenttrailer = $('#vehicle_trailer').val();
	if (currenttrailer=='Open') {
		$('#vehicle_trailer').val('Enclosed');
	} else {
		$('#vehicle_trailer').val('Open');
	}
	document.changequote.submit();
}

function changeoperating() {
	var currentcondition = $('#vehicle_operational').val();
	if (currentcondition=='Running') {
		$('#vehicle_operational').val('Non-Running');
	} else {
		$('#vehicle_operational').val('Running');
	}
	document.changequote.submit();
}


</script>

<form action="quote1.asp" method="post" name="changequote">
<input type="hidden" name="shippingfromzip" value="<%= shippingfromzip %>">
<input type="hidden" name="shippingfromcity" value="<%= shippingfromcity %>">
<input type="hidden" name="shippingfromstate" value="<%= shippingfromstate %>">
<input type="hidden" name="shippingtozip" value="<%= shippingtozip %>">
<input type="hidden" name="shippingtocity" value="<%= shippingtocity %>">
<input type="hidden" name="shippingtostate" value="<%= shippingtostate %>">
<input type="hidden" name="shippingfrom_sales" value="<%= shippingfrom_sales %>">
<input type="hidden" name="auto_year" value="<%= auto_year %>">
<input type="hidden" name="auto_model" value="<%= auto_model %>">
<input type="hidden" name="auto_make" value="<%= auto_make %>">
<input type="hidden" name="vehicle_operational" id="vehicle_operational" value="<%= vehicle_operational %>">
<input type="hidden" name="vehicle_trailer" id="vehicle_trailer" value="<%= vehicle_trailer %>">

<input type="hidden" name="howmany" value="<%= howmany %>">
<input type="hidden" name="numvehicles" value="<%= numvehicles %>">

<%if howmany <> "onevehicle" then %>
<input type="hidden" name="auto_year2" value="<%= auto_year2 %>">
<input type="hidden" name="auto_make2" value="<%= auto_make2 %>">
<input type="hidden" name="auto_model2" value="<%= auto_model2 %>">
<input type="hidden" name="auto_year3" value="<%= auto_year3 %>">
<input type="hidden" name="auto_make3" value="<%= auto_make3 %>">
<input type="hidden" name="auto_model3" value="<%= auto_model3 %>">
<input type="hidden" name="auto_year4" value="<%= auto_year4 %>">
<input type="hidden" name="auto_make4" value="<%= auto_make4 %>">
<input type="hidden" name="auto_model4" value="<%= auto_model4 %>">
<input type="hidden" name="auto_year5" value="<%= auto_year5 %>">
<input type="hidden" name="auto_make5" value="<%= auto_make5 %>">
<input type="hidden" name="auto_model5" value="<%= auto_model5 %>">
<%end if%>

<% if session("stopleads") <> 1 and session("Username") = "" then %>
	<input type="hidden" name="customer_name" value="<%= customer_name %>">
	<input type="hidden" name="customer_email" value="<%= customer_email %>">
	<input type="hidden" name="customer_phone" value="<%= customer_phone %>">
	<input type="hidden" name="customer_movedate" value="<%= customer_movedate %>">
<% end if %>



<br>
<a href="#" onclick="changetrailer();"><div style="padding:5px 30px;background:orange;color:black;border: 2px solid black;font-weight:bold;font-size:12px;">Change Type of Trailer</div></a>
<br>
<a href="#" onclick="changeoperating();"><div  style="padding:5px 30px;background:purple;color:white;border: 2px solid black;font-weight:bold;font-size:12px;">Change Operating Condition</div></a>

</form>

	</div>
<%End If%>
</div>
<div align="center">
<table cellspacing="2" cellpadding="2" border="0" align="center">
<form action="https://www.autotransportdirect.com/quote/quote2.asp" method="post" name="mainform">
<input type="hidden" name="strQuote_shippingfromstateabbr" value="<%= shippingfromstateabbr %>">
<input type="hidden" name="strQuote_shippingtostateabbr" value="<%= shippingtostateabbr %>">
<input type="hidden" name="strQuote_shippingfromstate" value="<%= shippingfromstate %>">
<input type="hidden" name="strQuote_shippingtostate" value="<%= shippingtostate %>">
<input type="hidden" name="strQuote_shippingfromcity" value="<%= shippingfromcity %>">
<input type="hidden" name="strQuote_shippingtocity" value="<%= shippingtocity %>">
<input type="hidden" name="strQuote_shippingfromzip" value="<%= shippingfromzip %>">
<input type="hidden" name="strQuote_shippingtozip" value="<%= shippingtozip %>">

<input type="hidden" name="shippingfrom_sales" value="<%= shippingfrom_sales %>">

<input type="hidden" name="auto_year" value="<%= auto_year %>">
<input type="hidden" name="auto_make" value="<%= auto_make %>">
<input type="hidden" name="auto_model" value="<%= auto_model %>">
<input type="hidden" name="auto_price" value="<%= shipprice1%>">

<% if session("stopleads") <> 1 and session("Username") = "" then %>
	<input type="hidden" name="customer_name" value="<%= customer_name %>">
	<input type="hidden" name="customer_email" value="<%= customer_email %>">
	<input type="hidden" name="customer_phone" value="<%= customer_phone %>">
	<input type="hidden" name="customer_movedate" value="<%= customer_movedate %>">
<% End If %>

<input type="hidden" name="DaysWaitingPickupTotalOrders" value="<%= DaysWaitingPickupTotalOrders%>">
<input type="hidden" name="DaysWaitingPickupAvg" value="<%= DaysWaitingPickupAvg%>">
<input type="hidden" name="DaysWaitingDeliverTotalOrders" value="<%= DaysWaitingDeliverTotalOrders%>">
<input type="hidden" name="DaysWaitingDeliverAvg" value="<%= DaysWaitingDeliverAvg%>">
<input type="hidden" name="DaysWaitingAvg" value="<%= DaysWaitingAvg%>">

<% If len(Session("username")) > 0 and session("emailrefer") = "" and (Message_To <> "" or Message_From <> "") Then %>
	<input type="hidden" name="helpfulhintmention" value="">
<% End If %>


<input type="hidden" name="howmany" value="<%= howmany %>">
<input type="hidden" name="numvehicles" value="<%= numvehicles %>">
<input type="hidden" name="depositpervehicle" value="<%= depositpervehicle %>">
<input type="hidden" name="carrierdiscount" value="<%= carrierdiscount %>">
<input type="hidden" name="depositdiscount" value="<%= depositdiscount %>">
<input type="hidden" name="discstatus" value="<%= cddiscount %>">
<input type="hidden" name="ps" value="<%= PriceSource %>">


<%if howmany <> "onevehicle" then %>
<input type="hidden" name="auto_year2" value="<%= auto_year2 %>">
<input type="hidden" name="auto_make2" value="<%= auto_make2 %>">
<input type="hidden" name="auto_model2" value="<%= auto_model2 %>">
<input type="hidden" name="auto_price2" value="<%= shipprice2 %>">
<input type="hidden" name="auto_year3" value="<%= auto_year3 %>">
<input type="hidden" name="auto_make3" value="<%= auto_make3 %>">
<input type="hidden" name="auto_model3" value="<%= auto_model3 %>">
<input type="hidden" name="auto_price3" value="<%= shipprice3 %>">
<input type="hidden" name="auto_year4" value="<%= auto_year4 %>">
<input type="hidden" name="auto_make4" value="<%= auto_make4 %>">
<input type="hidden" name="auto_model4" value="<%= auto_model4 %>">
<input type="hidden" name="auto_price4" value="<%= shipprice4 %>">
<input type="hidden" name="auto_year5" value="<%= auto_year5 %>">
<input type="hidden" name="auto_make5" value="<%= auto_make5 %>">
<input type="hidden" name="auto_model5" value="<%= auto_model5 %>">
<input type="hidden" name="auto_price5" value="<%= shipprice6 %>">

<%end if%>

<input type="hidden" name="strQuote_vehicle_operational" value="<%= vehicle_operational %>">
<input type="hidden" name="strQuote_vehicle_trailer" value="<%= vehicle_trailer %>">

<input type="hidden" name="nearorigincity" value="<%= session("nearorigincity") %>">
<input type="hidden" name="neardestcity" value="<%= session("neardestcity") %>">

<input type="hidden" name="rating_origin" value="<%= rating_origin %>">
<input type="hidden" name="rating_dest" value="<%= rating_dest %>">
<input type="hidden" name="rating_vehicle" value="<%= rating_vehicle %>">

<input type="hidden" name="strtotalprice" value="<%= totalprice %>">
<input type="hidden" name="strDeposit" value="<%= strDeposit %>">

<input type="hidden" name="honorquotereduction" value="0">
<input type="hidden" name="turbochargeincrease" value="0">
<input type="hidden" name="militarydiscountreduction" value="0">
<input type="hidden" name="reviewdiscountreduction" value="0">
<input type="hidden" name="reviewdiscountsite" value="">




<tr>
	<td class="bodytext4" valign="top"><b><%=dictLanguage.Item(Session("lang")&"_quote_32")%>:</b></td>
	<td class="bodytext4" valign="top"><b><%= shippingfromcity %>, <%= shippingfromstateabbr %>&nbsp;&nbsp;&nbsp;<%=shippingfromzip%></b>
	<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
	<br>
	<a href="http://www.mapquest.com/maps/map.adp?city=<%= server.htmlencode(shippingfromcity) %>&state=<%= server.htmlencode(shippingfromstateabbr) %>&address=&zip=<%= server.htmlencode(shippingfromzip) %>&country=us&zoom=6" target="_new">MapQuest</a>
			&nbsp;&nbsp;
			<a href="http://maps.google.com/maps?q=<%= server.htmlencode(shippingfromcity) %>,+<%= server.htmlencode(shippingfromstate) %>+<%= server.htmlencode(shippingfromzip) %>" target="_new">Google Maps</a>
    	<%
    	cdpickup = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=" & shippingfromcity & "&pickupState=" & shippingfromstateabbr & "&pickupZip=" & shippingfromzip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity=" &  shippingtocity & "&deliveryState=" & shippingtostateabbr & "&deliveryZip=" & shippingtozip & "&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=1&secondarySort=4&listingsPerPage=100"
    	cdpickup = Server.URLEncode(cdpickup)
    	cdpickupstate = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupAreas%5B%5D=state_USA_" & shippingfromstateabbr & "&pickupRadius=25&pickupCity=&pickupState=" & shippingfromstateabbr & "&pickupZip=60048&Origination_valid=1&deliveryAreas%5B%5D=state_USA_" & shippingtostateabbr & "&deliveryRadius=25&deliveryCity=&deliveryState=" & shippingtostateabbr & "&deliveryZip=29118&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=1&secondarySort=4&listingsPerPage=100"
    	cdpickupstate = Server.URLEncode(cdpickupstate)
    	%>
    	<br>
    		<a href="/admin2k7/redir.asp?url=<%= cdpickup %>&orderid=0&type=centraldispatchsearch" target="_new">CD-City</a>
    		&nbsp;&nbsp;
    		<a href="/admin2k7/redir.asp?url=<%= cdpickupstate %>&orderid=0&type=centraldispatchsearch" target="_new">CD-State</a>
	<%end If %>





	</td>
</tr>



<tr>
	<td class="bodytext4" valign="top"><b><%=dictLanguage.Item(Session("lang")&"_quote_33")%>:</b></td>
	<td class="bodytext4" valign="top"><b><%= shippingtocity %>, <%= shippingtostateabbr %>&nbsp;&nbsp;&nbsp;<%=shippingtozip%></b>
	<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
	<br>
	<a href="http://www.mapquest.com/maps/map.adp?city=<%= server.htmlencode(shippingtocity) %>&state=<%= server.htmlencode(shippingtostateabbr) %>&address=&zip=<%= server.htmlencode(shippingtozip) %>&country=us&zoom=6" target="_new">MapQuest</a>
			&nbsp;&nbsp;

			<a href="http://maps.google.com/maps?q=<%= server.htmlencode(shippingtocity) %>,+<%= server.htmlencode(shippingtostate) %>+<%= server.htmlencode(shippingtozip) %>" target="_new">Google Maps</a>
        <%


		cddeliver = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=25&pickupCity=" & shippingtocity & "&pickupState=" & shippingtostateabbr & "&pickupZip=" & shippingtozip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=25&deliveryCity=" &  shippingfromcity & "&deliveryState=" & shippingfromstateabbr & "&deliveryZip=" & shippingfromzip & "&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=1&secondarySort=4&listingsPerPage=100"
		cddeliver = Server.URLEncode(cddeliver)
		cddeliverstate = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupAreas%5B%5D=state_USA_" & shippingtostateabbr & "&pickupRadius=25&pickupCity=&pickupState=" & shippingtostateabbr & "&pickupZip=60048&Origination_valid=1&deliveryAreas%5B%5D=state_USA_" & shippingfromstateabbr & "&deliveryRadius=25&deliveryCity=&deliveryState=" & shippingfromstateabbr & "&deliveryZip=29118&Destination_valid=1&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=1&secondarySort=4&listingsPerPage=100"
		cddeliverstate = Server.URLEncode(cddeliverstate)
		%>
		<br>
			<a href="/admin2k7/redir.asp?url=<%= cddeliver %>&orderid=0&type=centraldispatchsearch" target="_new">CD-City</a>
			&nbsp;&nbsp;
			<a href="/admin2k7/redir.asp?url=<%= cddeliverstate %>&orderid=0&type=centraldispatchsearch" target="_new">CD-State</a>


	<%end If %>
	</td>
</tr>





<%if howmany <> "onevehicle" then %>
<tr>
	<td class="bodytext4" valign="top"><b>Types of Vehicles:</b></td>
	<td class="bodytext4" nowrap>
	<div class="numbutton1">1</div><div class="makemodel"><%= auto_year %> - <%= auto_make %> - <%= auto_model %></div><div style="clear:both"></div>
	<%if auto_make2<>"" then%><div class="numbutton1">2</div><div class="makemodel"><%= auto_year2 %> - <%= auto_make2 %> - <%= auto_model2 %></div><div style="clear:both"></div><%end if%>
	<%if auto_make3<>"" then%><div class="numbutton1">3</div><div class="makemodel"><%= auto_year3 %> - <%= auto_make3 %> - <%= auto_model3 %></div><div style="clear:both"></div><%end if%>
	<%if auto_make4<>"" then%><div class="numbutton1">4</div><div class="makemodel"><%= auto_year4 %> - <%= auto_make4 %> - <%= auto_model4 %></div><div style="clear:both"></div><%end if%>
	<%if auto_make5<>"" then%><div class="numbutton1">5</div><div class="makemodel"><%= auto_year5 %> - <%= auto_make5 %> - <%= auto_model5 %></div><div style="clear:both"></div><%end if%>
	</td>
</tr>
<%else%>
<tr>
	<td class="bodytext4"><b>Type of Vehicle:</b></td>
	<td class="bodytext4" nowrap><%= auto_year %> - <%= auto_make %> - <%= auto_model %></td>
</tr>
<%end if%>

<tr>
	<td class="bodytext4" nowrap="nowrap"><b>Operating Condition:&nbsp;&nbsp;</b></td>
	<td class="bodytext4" nowrap="nowrap"><%= vehicle_operational %> and Rolls, Brakes, Steers</td>
</tr>
<tr>
	<td class="bodytext4"><b>Type of Trailer:</b></td>
	<td class="bodytext4"><%= vehicle_trailer %></td>
</tr>
<tr>
	<td colspan="2"><br />
	<div class="title2" style="color: #308dff; font-size: 25px;" align="center"><b>Total Price:</b> $<span id="totalprice"><%= formatnumber(totalprice)  %></span></div>
	</td>
</tr>

</table>
</div>
<div align="center">
<b><font style="color:#308dff; font-size:14px;">
<br/>
<% If len(Session("username")) > 0 and session("emailrefer") = "" and (Message_To <> "" or Message_From <> "") Then %>
	Click<br /><input type="button" id="confirmLink" value="Go On &raquo;" class="submitbutton2"><br />to set-up shipment.
<% Else %>
	Click<br /><input type="submit" value="Go On &raquo;" class="submitbutton2"><br />to set-up shipment.
<% End If %>
</font></b></div>
<br>
<div align="center">


<%
If len(Session("username")) > 0 and session("emailrefer") = "" Then
	qs = "sendfrom=" & Server.URLEncode(shippingfromcity) & ",&nbsp;" & Server.URLEncode(shippingfromstate) & "&nbsp;&nbsp;" & Server.URLEncode(shippingfromzip) & "&sendto=" & Server.URLEncode(shippingtocity) & ",&nbsp;" & Server.URLEncode(shippingtostate) & "&nbsp;&nbsp;" & Server.URLEncode(shippingtozip) & "&numvehicles=" & Server.URLEncode(numvehicles) & "&vehicle=" & Server.URLEncode(auto_make) & " - " & Server.URLEncode(auto_model) & "&vehicle2=" & Server.URLEncode(auto_make2) & " - " & Server.URLEncode(auto_model2) & "&vehicle3=" & Server.URLEncode(auto_make3) & " - " & Server.URLEncode(auto_model3) & "&vehicle4=" & Server.URLEncode(auto_make4) & " - " & Server.URLEncode(auto_model4) & "&vehicle5=" & Server.URLEncode(auto_make5) & " - " & Server.URLEncode(auto_model5) & "&vehicle6=" & Server.URLEncode(auto_make6) & " - " & Server.URLEncode(auto_model6) & "&vehicle7=" & Server.URLEncode(auto_make7) & " - " & Server.URLEncode(auto_model7) & "&vehicle8=" & Server.URLEncode(auto_make8) & " - " & Server.URLEncode(auto_model8) & "&vehicle9=" & Server.URLEncode(auto_make9) & " - " & Server.URLEncode(auto_model9) & "&vehicle10=" & Server.URLEncode(auto_make10) & " - " & Server.URLEncode(auto_model10) & "&operating=" & Server.URLEncode(vehicle_operational) & Server.URLEncode(" and Rolls, Brakes, Steers") & "&trailer=" & Server.URLEncode(vehicle_trailer) & "&deposit=" & Server.URLEncode(DEATDeposit) & "&price=" & Server.URLEncode(formatnumber(totalprice))
	%>
	<a href="quote_email.asp?<%= qs %>" rel="shadowbox;width=700;height=200" style="text-decoration:none;"><div style="width:130px; height:27px; padding:7px 7px 0 7px; border: 1px solid #000; color:#fff; background-color: #009933; font-size:13px; font-weight: bold; text-decoration:none;">E-Mail This Quote</div></a>
	<br>
<% end if %>



<div style="width:680px;">
<div style="font-weight:bold;font-size:18px;">Door to Door Service.</div>

<br>
<font style="font-size:14px;">
Only a nominal deposit of $<%=strDeposit%> <%if session("repeat_discount")=1 then%><span style="color:#308dff"> (includes your $10 discount)</span> <%end if%> is needed to set up your shipment.
<div class="Sep5"></div>
Allow typically one to several days to pick up your vehicle, sometimes takes longer.
<div class="Sep5"></div>
Your vehicle is fully insured while on the transport carrier.
<div class="Sep5"></div>
The balance due is made payable to the carrier with either Cash or Money Order upon delivery.
<br><br>
</font>

</div>


<% If len(Session("username")) > 0 and session("emailrefer") = "" Then %>
	<div style="width:420px;border:2px solid #000;background:#eee;padding:5px;margin: 0 auto; margin-bottom:15px;">
		<b>OFFICE USE ONLY</b><br>


        <%
        cd50 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=50&pickupCity=" & shippingfromcity & "&pickupState=" & shippingfromstateabbr & "&pickupZip=" & shippingfromzip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=50&deliveryCity=" &  shippingtocity & "&deliveryState=" & shippingtostateabbr & "&deliveryZip=" & shippingtozip & "&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=8&secondarySort=4&listingsPerPage=100"
        cd50 = Server.URLEncode(cd50)
        cd100 = "http://www.centraldispatch.com/protected/listing-search/result?highlightPeriod=0&pickupCitySearch=1&pickupRadius=100&pickupCity=" & shippingfromcity & "&pickupState=" & shippingfromstateabbr & "&pickupZip=" & shippingfromzip & "&Origination_valid=1&deliveryCitySearch=1&deliveryRadius=100&deliveryCity=" &  shippingtocity & "&deliveryState=" & shippingtostateabbr & "&deliveryZip=" & shippingtozip & "&Destination_valid=1&vehicleTypeIds%5B%5D=4&vehicleTypeIds%5B%5D=6&vehicleTypeIds%5B%5D=8&vehicleTypeIds%5B%5D=10&postedBy=&minVehicles=1&maxVehicles=&minPay=&minPayType=M&vehiclesRun=&trailerType=&paymentType=&shipWithin=60&primarySort=8&secondarySort=4&listingsPerPage=100"
        cd100 = Server.URLEncode(cd100)
        %>

        <a href="/admin2k7/redir.asp?url=<%= cd50 %>&orderid=0&type=centraldispatchsearch" target="_new">CD-50</a>
		&nbsp;&nbsp;
		<a href="/admin2k7/redir.asp?url=<%= cd100 %>&orderid=0&type=centraldispatchsearch" target="_new">CD-100</a>
        <br>

		<%if howmany = "onevehicle" then %>
		<table>
		<tr>
			<td nowrap="nowrap"><b><%= auto_year %> - <%= auto_make %> - <%= auto_model %>:</b></td>
			<td nowrap="nowrap">$<%=shipprice1%></td>
		</tr>
		<% If vehicle_operational = "Non-Running" Then %>
		<tr>
			<td nowrap="nowrap"><b>Operating Condition (Non-Running):</b></td>
			<td nowrap="nowrap">$150</td>
		</tr>
		<% End If %>
		<tr>
			<td nowrap="nowrap"><b>Deposit:</b></td>
			<td nowrap="nowrap">$<%=strDeposit%></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><b>Total:</b></td>
			<td nowrap="nowrap"><b>$<%=totalprice%></b></td>
		</tr>
		</table><br>
		<%end If %>

		<b>Shipping Distance:</b> <%= totaldistance %> miles<br>
		<%

			deposittotal = numvehicles * depositpervehicle
			duecarrier = totalprice - deposittotal
			pricepermile = (totalprice-strDeposit) / totaldistance
			pricepermile = FormatNumber(pricepermile,2)


		if howmany <> "onevehicle" then

		%>
			<br>
			<b>Types & Prices of Vehicles WITHOUT Deposit</b><div style="clear:both"></div>
			<table><tr><td nowrap="nowrap">
			<div class="numbutton1">1</div><div class="makemodel"><%= auto_year %> - <%= auto_make %> - <%= auto_model %> - $<%=shipprice1%></div><div style="clear:both"></div>
			<%if auto_make2<>"" then%><div class="numbutton1">2</div><div class="makemodel"><%= auto_year2 %> - <%= auto_make2 %> - <%= auto_model2 %> - $<%=shipprice2%></div><div style="clear:both"></div><%end if%>
			<%if auto_make3<>"" then%><div class="numbutton1">3</div><div class="makemodel"><%= auto_year3 %> - <%= auto_make3 %> - <%= auto_model3 %> - $<%=shipprice3%></div><div style="clear:both"></div><%end if%>
			<%if auto_make4<>"" then%><div class="numbutton1">4</div><div class="makemodel"><%= auto_year4 %> - <%= auto_make4 %> - <%= auto_model4 %> - $<%=shipprice4%></div><div style="clear:both"></div><%end if%>
			<%if auto_make5<>"" then%><div class="numbutton1">5</div><div class="makemodel"><%= auto_year5 %> - <%= auto_make5 %> - <%= auto_model5 %> - $<%=shipprice5%></div><div style="clear:both"></div><%end if%>
			<br>
			<strong>Deposit:</strong> $<%=deposittotal%><br>
			<strong>Due Carrier:</strong> $<%=duecarrier%><br>
			<strong>Price Per Carrier Mile:</strong> $<%= pricepermile %><br>

			</td></tr></table>

		<% else %>

		<b>Price Per Mile:</b> $<%= pricepermile %> <br>

		<%
		end If

		response.write "<hr>" &  DisplayRatingInfo(zipadjustrating)
		%>



	</div>

<%end If %>






<div class="clear"></div>
<!--
<div class="imagebox" style="float:left;margin-left:8px;margin-top:22px;width: 225px;">
	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote1-1.jpg" width="225" height="152" alt="Direct Express Auto Transport Employee" />
	<div>We uniquely offer a full deposit refund upon request at any time prior to pickup. That's confidence!</div>
</div>


<div class="imagebox" style="float:right;margin-right:8px;margin-top:22px;width: 225px;">
	<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote1-2.jpg" width="225" height="152" alt="Direct Express Auto Transport Employee" />
	<div>We are a five star rated company because most of the time<br/>we get it done!</div>
</div>

-->



<div style="margin:5px 0 5px 0;width:1075px;border-top:#999999 solid thin;"></div>
<br>





<div class="title2">

Now that you have your quote ...<br>you probably have questions. Please call us at<br />
<div style="font-size:40px;color:#308dff;position:relative;margin-top:15px; font-weight:bold;">

800-600-3750
</div>

</div><br>
<table align="center">
<tr>
	<td align="center">
	<font style="font-size:14px;">
	We accept major Credit Cards<br>
	</font>
	<img src="//d36b03yirdy1u9.cloudfront.net/images/creditcards.jpg">

	<br><br>
	<div class="title2">
        Celebrating 10 years in business!
    </div>
	</td>
	<!--
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<a target="_blank" id="bbblink" class="ruhzbum" href="http://www.bbb.org/greater-san-francisco/business-reviews/auto-transporters-and-drive-away-companies/direct-express-auto-transport-in-san-anselmo-ca-59879#bbblogo" title="Direct Express Auto Transport, Auto Transporters & Drive-Away Companies, San Rafael, CA" style="display: block;position: relative;overflow: hidden; width: 150px; height: 69px; margin: 0px; padding: 0px;"><img style="padding: 0px; border: none;" id="bbblinkimg" src="https://seal-goldengate.bbb.org/logo/ruhzbum/direct-express-auto-transport-59879.png" width="300" height="69" alt="Direct Express Auto Transport, Auto Transporters & Drive-Away Companies, San Rafael, CA" /></a><script type="text/javascript">var bbbprotocol = ( ("https:" == document.location.protocol) ? "https://" : "http://" ); document.write(unescape("%3Cscript src='" + bbbprotocol + 'seal-goldengate.bbb.org' + unescape('%2Flogo%2Fdirect-express-auto-transport-59879.js') + "' type='text/javascript'%3E%3C/script%3E"));</script>
	</td>
-->
	</tr></table>

</form>

<% End If %>


	</td>
</tr>

</table>


<%
if customer_email <> "" then

    if Session("First_Name") <> "" then
    	if Session("First_Name") = "Yukti" then
    		repnametemp = "Jessica"
    	elseif Session("First_Name") = "Jessica" then
    		repnametemp = "Scarlet"
    	else
    		repnametemp = Session("First_Name")
    	end if
    	repname = repnametemp
    	rep = Session("Username")

    end if

	'Email Quote
	strSendTrans = "http://www.directexpressautotransport.com/quote_email.asp"
	DataToSend = "todo=go&emailto=" & Server.URLEncode(customer_email) & "&sendfrom=" & Server.URLEncode(shippingfromcity) & ",%20" & Server.URLEncode(shippingfromstate) & "%20%20" & Server.URLEncode(shippingfromzip) & "&sendto=" & Server.URLEncode(shippingtocity) & ",%20" & Server.URLEncode(shippingtostate) & "%20%20" & Server.URLEncode(shippingtozip) & "&numvehicles=" & Server.URLEncode(numvehicles) & "&vehicle=" & Server.URLEncode(auto_make) & " - " & Server.URLEncode(auto_model) & "&vehicle2=" & Server.URLEncode(auto_make2) & " - " & Server.URLEncode(auto_model2) & "&vehicle3=" & Server.URLEncode(auto_make3) & " - " & Server.URLEncode(auto_model3) & "&vehicle4=" & Server.URLEncode(auto_make4) & " - " & Server.URLEncode(auto_model4) & "&vehicle5=" & Server.URLEncode(auto_make5) & " - " & Server.URLEncode(auto_model5) & "&vehicle6=" & Server.URLEncode(auto_make6) & " - " & Server.URLEncode(auto_model6) & "&vehicle7=" & Server.URLEncode(auto_make7) & " - " & Server.URLEncode(auto_model7) & "&vehicle8=" & Server.URLEncode(auto_make8) & " - " & Server.URLEncode(auto_model8) & "&vehicle9=" & Server.URLEncode(auto_make9) & " - " & Server.URLEncode(auto_model9) & "&vehicle10=" & Server.URLEncode(auto_make10) & " - " & Server.URLEncode(auto_model10) & "&operating=" & Server.URLEncode(vehicle_operational) & Server.URLEncode(" and Rolls, Brakes, Steers") & "&trailer=" & Server.URLEncode(vehicle_trailer) & "&deposit=" & Server.URLEncode(DEATDeposit) & "&price=" & Server.URLEncode(formatnumber(totalprice)) & "&repname="

	if rep <> "" then
    	DataToSend = DataToSend & Server.URLEncode(repname) & "&rep=" & Server.URLEncode(rep)
    end if


	Set GetHTML = server.createobject("Msxml2.serverXmlHttp.3.0")
	GetHTML.open "POST", strSendTrans, False
	GetHTML.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	GetHTML.setRequestHeader "Content-Length", Len(DataToSend)
	GetHTML.send(DataToSend)
	receiptresult = GetHTML.responseText
	receiptresult = Replace(receiptresult,"'","''")
	Set GetHTML = nothing
end if


%>




<br>

<!-- Google Code for 1. Quote Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1070891707;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "2ANICMOaQxC7hdL-Aw";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1070891707/?value=0&amp;label=2ANICMOaQxC7hdL-Aw&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<% call closedb()

showratings = 1
%>
<!--#include virtual="/includes/footer.asp"-->
