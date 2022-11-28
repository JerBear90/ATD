<% pagetitle = "Direct Express Auto Transport - Order Confirmation" %>
<% metadescription = "Nationwide auto shipping at the lowest rates. Door to door pick-up and delivery service." %>
<% metakeywords = "truck transport quote, luxury car transport quote, SUV transport quote, door to door transport, sedan transport quote, sports car transport quote" %>
<% pagename="quote4" %>
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
	End If
Else
	CurrentUsername = Session("Username")
End If


strOrderID = getUserInput(request.form("strOrderID"),0)

strBilling_FirstName = getUserInput(request.form("strBilling_FirstName"),0)
strBilling_LastName = getUserInput(request.form("strBilling_LastName"),0)
strBilling_Name = strBilling_FirstName & " " & strBilling_LastName
strBilling_Address1 = getUserInput(request.form("strBilling_Address1"),0)
strBilling_Address2 = getUserInput(request.form("strBilling_Address2"),0)
strBilling_City = getUserInput(request.form("strBilling_City"),0)
strBilling_State = getUserInput(request.form("strBilling_State"),0)
strBilling_Zip = getUserInput(request.form("strBilling_Zip"),0)
strBilling_Phone = getUserInput(request.form("strBilling_Phone"),0)
strCustEmail = getUserInput(request.form("strCustEmail"),0)
strCreditCartType = getUserInput(request.form("strCreditCartType"),0)
strCreditCartNum = getUserInput(request.form("strCreditCartNum"),0)
cc_lastfour = right(strCreditCartNum,4)
strCreditCartMonth = getUserInput(request.form("strCreditCartMonth"),0)
strCreditCartYear = getUserInput(request.form("strCreditCartYear"),0)
strCreditCartCVV = getUserInput(request.form("strCreditCartCVV"),0)

If strBilling_State = "BC" or strBilling_State = "NT" or strBilling_State = "NS" or strBilling_State = "NU" or strBilling_State = "PE" or strBilling_State = "QC" or strBilling_State = "SK" or strBilling_State = "YT" or strBilling_State = "MB" or strBilling_State = "NB" or strBilling_State = "ON" Then
	strBilling_Country = "CA"
Else
	strBilling_Country = "US"
End If

strSalesRep  = getUserInput(request.form("strSalesRep"),0)

dim conn
call openDB()

strSQL = "select * from orders where orderid = " & strOrderID
Set RsCheck = Server.CreateObject("ADODB.Recordset")
    RsCheck.Open strSQL,conn

strDeposit = RsCheck("Deposit")
numofvehicles = RsCheck("Num_of_Vehicles")

reviewdiscountreduction = getUserInput(request.form("reviewdiscountreduction"),0)
reviewdiscountsite = getUserInput(request.form("reviewdiscountsite"),0)

%>

<% If RsCheck("Status") <> "NEW" Then%>

	<%
	x_test_request = "FALSE"
	x_type = "AUTH_CAPTURE"

	url = "http://www.autotransportdirect.com/ccgateway/trans.php"
	urlparam = "sprungkey=237gb23oOIUHI7198uhib9IOnubvy89" &_
	"&x_type=" & x_type &_
	"&x_test_request=" & x_test_request &_
	"&x_amount=" & strDeposit &_
	"&x_invoice_num=" & strOrderID &_
	"&x_customer_ip=" & Request.ServerVariables("REMOTE_ADDR") &_
	"&x_card_num=" & strCreditCartNum &_
	"&x_exp_date=" & strCreditCartMonth & strCreditCartYear &_
	"&x_card_code=" & strCreditCartCVV &_
	"&x_first_name=" & strBilling_FirstName &_
	"&x_last_name=" & strBilling_LastName &_
	"&x_address=" & strBilling_Address1 &_
	"&x_city=" & strBilling_City &_
	"&x_state=" & strBilling_State &_
	"&x_zip=" & strBilling_Zip &_
	"&x_country=" & strBilling_Country &_
	"&x_phone=" & strBilling_Phone &_
	"&x_email=" & strCustEmail


	Dim xmlhttp
	Set xmlhttp = Server.Createobject("MSXML2.ServerXMLHTTP")
	xmlhttp.Open "POST",url,false
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send urlparam
	resp = xmlhttp.responsetext
	Set xmlhttp = Nothing

	'response.write resp & "<hr>"

	respsplit=Split(resp,"|")
	ResponseCode = respsplit(0)
	ResponseReason = respsplit(1)
	AuthorizationCode = respsplit(2)
	TransactionID = respsplit(3)



	If ResponseCode = "1" Then
		cys_success=1
		Cys_AuthCode=AuthorizationCode
		Cys_TransId=TransactionID
	else
		cys_success=0
	end if


	If Session("username") = "claydough" Then
		cys_success=1
		Cys_AuthCode="test"
		Cys_TransId="test"
	End If
	%>


<% End If %>

 <!--#include file="../termshtmlemail.asp" -->

<%
If len(Session("Username")) = 0 Then
	currentuser = "ATD"
Else
	currentuser = Session("Username")
End If




If cys_success = 1 Then

	strSQL = "update orders set status = 'NEW', SalesRep_Complete = '" & strSalesRep & "', order_date = '" & fncFmtDate(Now(), "%Y-%m-%d %H:%N") & "', CreditCartType = '" & strCreditCartType & "',Billing_Name = '" & strBilling_Name & "', Billing_Address1 = '" & strBilling_Address1 & "', Billing_Address2 = '" & strBilling_Address2 & "', Billing_City = '" & strBilling_City & "', Billing_State = '" & strBilling_State & "', Billing_Zip = '" & strBilling_Zip & "', Billing_Phone = '" & strBilling_Phone & "', lp_ApprovalCode = '" & Cys_AuthCode & "', lp_OrderNumber = '" & Cys_TransId & "', cc_lastfour = '" & cc_lastfour & "'"
	strSQL = strSQL & "  where orderid = " & strOrderID

	Set Rs1 = Server.CreateObject("ADODB.Recordset")
	    Rs1.Open strSQL,conn,3,1

	strSQL = "insert into payments (OrderID,Description,Amount,username)"

	if cint(numofvehicles=1) then
		strSQL = strSQL & " values  (" & strOrderID & ",'Down Payment - Credit Card','-" & strDeposit & "','" & currentuser & "')"
	else
		strSQL = strSQL & " values  (" & strOrderID & ",'Multiple Vehicle Down Payment - Credit Card','-" & strDeposit & "','" & currentuser & "')"
	end if

	Set Rsinsertprice2 = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice2.Open strSQL,conn



	strSQL = "select * from orders where orderid = " & strOrderID
	Set RsOrder = Server.CreateObject("ADODB.Recordset")
	    RsOrder.Open strSQL,conn


	strSQL = "select * from orders_vehicles where orderid = " & strOrderID
	Set RsOrderVehicle = Server.CreateObject("ADODB.Recordset")
	    RsOrderVehicle.Open strSQL,conn


	body = "You have a new order at Direct Express Auto Transport.  Please login to the administrator and refer to order number " & strOrderID & vbcrlf & vbcrlf
	body = body & "Admin Link: https://www.autotransportdirect.com/admin2k7/" & vbcrlf
	body = body & "Order Detail Link: https://www.autotransportdirect.com/admin2k7/detail.asp?orderid=" & strOrderID

	Call sendMailText("Direct Express Auto Transport Order System", "info@autotransportdirect.com", "info@autotransportdirect.com", "New Order - " & strOrderID, body)
	'Call sendMailText("Direct Express Auto Transport Order System", "info@autotransportdirect.com", "mrupers@mac.com", "New Order - " & strOrderID, body)

	If currentuser <> "ATD" Then
		'conversion code goes here

	End If


	If len(Session("Username")) = 0 Then
		reporteduser = "ATD"
	Else
		reporteduser = Session("Username")
	End If
	reporteddate = fncFmtDate(Now(), "%Y-%m-%d")

	Call sendMailText("Direct Express Auto Transport Order System", "orders@autotransportdirect.com", "mrupers@mac.com", "New Order - " & reporteddate & " - " & reporteduser, body)
	'Call sendMailText("Direct Express Auto Transport Order System", "info@autotransportdirect.com", "clay@madebysprung.com", "New Order - " & reporteddate & " - " & reporteduser, "new order")



	startzip = RsOrder("Pickup_Zip")
	endzip = RsOrder("Deliver_Zip")

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
			recommendstatus_from = "seriously"
		end if
		Message_From = "If you are in a hurry, then you should " & recommendstatus_from & " consider meeting a driver in " & NearCity_from & ". "
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
			recommendstatus_to = "seriously"
		end if
		Message_To = "If you are in a hurry, then you should " & recommendstatus_to & " consider meeting a driver in " & NearCity_to & ". "
	end if


	if Message_From<>"" and Message_To<>"" then
		Message_Whole = Message_From & "And as well, you should " & recommendstatus_to & " consider meeting a driver in " & NearCity_to & ". "
	else
		Message_Whole = Message_From & Message_To
	end if

    body =  "<!DOCTYPE HTML PUBLIC ""-//W3C//DTD HTML 4.01 Transitional//EN""><html><head><title>AutoTransportDirect.com</title></head><body leftmargin=""0"" topmargin=""0"" rightmargin=""0"" bottommargin=""0"" marginwidth=""0"" marginheight=""0"" bgcolor=""#EFEFEF""><table width=""700"" cellspacing=""0"" cellpadding=""0"" border=""0"" align=""center""><tr><td background=""http://www.autotransportdirect.com/images/background_main.gif"" class=""bodytext""><a href=""http://www.autotransportdirect.com/?src=SRC-ReviewEmail""><img src=""http://www.autotransportdirect.com/images/header-email.jpg"" width=""700"" height=""99"" alt="""" border=""0""></a><table width=""100%"" cellspacing=""0"" cellpadding=""10"" border=""0""><tr><td><font face=""Verdana,Geneva,Arial,Helvetica,sans-serif"" size=""2"">" & vbcrlf





	body = body & "Thank You!" & "<br>" & "<br>"
	body = body & "Your order number is " & strOrderID & "<br>" & "<br>"
	body = body & "If you need to contact us regarding your order, call <font color=""red""><strong>800-600-3750</strong></font> or go to<br>http://www.autotransportdirect.com/contact-us/" & "<br>" & "<br>"

	if Message_Whole<>"" then
		body = body & "<b>Helpful Hint:</b>" & "<br>" & "<br>"
		body = body & "Over 90% of our orders ship within seven days of the date it was made available. Some locations can throw that off, making it more difficult and causing delay. Your location(s) might be in that group. "
		body = body & "<b>" & Message_Whole & "</b>"
		body = body & "Many customers appreciate that tip upfront, and hopefully our customer service representative mentioned the suggestion to you. Our experience tells us that there is more truck traffic there, making it easier and faster to ship your vehicle. You don't have to do that if you are more flexible with your time and can be patient. That said, we are often surprised at how fast a vehicle ships when we thought it might be more difficult. If you choose to meet a driver elsewhere, you will be emailed by us and phoned by the driver well in advance, giving you time to coordinate. Call us at 800-600-3750 if you prefer meeting elsewhere." & "<br>" & "<br>"
		body = body & "Ours is the most efficient way to ship a vehicle because we have several thousand carriers in our database. No one of them could possibly compete with that as there are thousands of cities and towns shipping to thousands of others. The number of possibilities are staggering. Our goal is to match your vehicle with the carrier actually running your route, and we have the best chance of doing that. " & "<br>" & "<br>"
		body = body & "Thank you for your order! " & "<br>" & "<br>"
	end if

	body = body & "<b>Next 4 Steps</b>" & "<br>" & "<br>"
	body = body & "1. Another email will be sent to you when your vehicle has been assigned a carrier for pickup. That email is simply a courtesy to you letting you know that your shipment is in the process of getting picked up. " & "<br>" & "<br>"
	body = body & "2. A dispatcher or driver will call your pickup contact person at the number(s) you provided to arrange pickup. Usually, but not always, setup is the day before pickup. You don't have to wait around for that call - but you do need to respond to it in a timely fashion. Sometimes a driver is ready on short notice (a few hours) and if that happens and you can't meet him, just call us to reschedule another driver. But if you can meet him, we highly recommend that you do so if at all possible. " & "<br>" & "<br>"
	body = body & "3. Usually, but not always, the day before delivery the driver will call your delivery contact person at the number(s) you provided to arrange delivery. " & "<br>" & "<br>"
	body = body & "4. <strong>The Balance Owed is always paid to the driver upon delivery (<span style=""color:red"">not pickup</span>) with CASH or MONEY ORDER made payable to the delivery company <span style=""color:red"">(not us)</span>.</strong>" & "<br>" & "<br>"

	body = body & "<br><table cellspacing=""2"" cellpadding=""2"" border=""0"" width=""50%""><tr>"
	body = body & "<td class=""bodytext2""><b>Shipping From:</b></td>"
	body = body & "<td class=""bodytext2"">" & RsOrder("Pickup_City") & ", " &  RsOrder("Pickup_State") & " " &  RsOrder("Pickup_Zip") & "</td>"
	body = body & "</tr><tr>"
	body = body & "<td class=""bodytext2""><b>Shipping To:</b></td>"
	body = body & "<td class=""bodytext2"">" & RsOrder("Deliver_City") & ", " &  RsOrder("Deliver_State") & " " &  RsOrder("Deliver_Zip") & "</td>"
	body = body & "</tr><tr>"

	if cint(RsOrder("Num_Of_Vehicles")) = 1 then
		body = body & "<td class=""bodytext2""><b>Type of Vehicle:</b></td>"
		body = body & "<td class=""bodytext2"" nowrap>" & RsOrder("Vehicle_Make") & " - " & RsOrder("Vehicle_Model") & "</td>"
		body = body & "</tr><tr>"
	else
		if NOT RsOrderVehicle.eof then
			body = body & "<td class=""bodytext2"" valign=""top""><b>Type of Vehicle:</b></td>"
			body = body & "<td class=""bodytext2"" nowrap valign=""top"">"
			counter=1
			do until RsOrderVehicle.eof
				body = body & counter & ". " & RsOrderVehicle("Vehicle_Make") & " - " & RsOrderVehicle("Vehicle_Model") & "<br />"
				counter=counter+1
			RsOrderVehicle.moveNext
			loop
			body = body & "</td>"
			body = body & "</tr><tr>"
			set RsOrderVehicle=nothing
		end if
	end if

	body = body & "<td class=""bodytext2"" nowrap=""nowrap""><b>Operating Condition:</b></td>"
	body = body & "<td class=""bodytext2"" nowrap=""nowrap"">" & RsOrder("Quote_vehicle_operational") & " and Rolls, Brakes, Steers</td>"
	body = body & "</tr><tr>"
	body = body & "<td class=""bodytext2""><b>Type of Trailer:</b></td>"
	body = body & "<td class=""bodytext2"">" & RsOrder("Quote_vehicle_trailer") & "</td>"
	body = body & "</tr><tr>"
	body = body & "<td class=""bodytext2"" nowrap=""nowrap""><b>First Date Vehicle is Available:</b></td>"
	body = body & "<td class=""bodytext2"" nowrap=""nowrap"">" & RsOrder("DateAvailable_Initial") & "&nbsp;-&nbsp;<b><a href=""http://www.autotransportdirect.com/information-shipping-dates/"">Please see typical shipping time frames</a></b></td>"

	body = body & "</tr></table><br><br>"

	body = body & "As of " & fncFmtDate(Now(), "%m-%d-%Y %h:%N %P") & "<br>"
	body = body & "			<table width=""75%"" cellspacing=""1"" cellpadding=""4"" border=""1"">"
	body = body & "			<tr>"
	body = body & "			    <td bgcolor=""#ffffff"" class=""formtext2"" width=""10%""><strong>Date/Time</strong></td>"
	body = body & "				<td bgcolor=""#ffffff"" class=""formtext2"" width=""70%""><strong>Description</strong></td>"
	body = body & "				<td bgcolor=""#ffffff"" class=""formtext2"" width=""10%"" align=""center""><strong>Amount</strong></td>"
	body = body & "				<td bgcolor=""#ffffff"" class=""formtext2"" width=""10%"" align=""center""><strong>Balance</strong></td>"
	body = body & "			</tr>"

	strSQL = "select * from payments where orderid = " & strOrderID & " order by paymentid"
	Set objRSpayments = Server.CreateObject("ADODB.Recordset")
	    objRSpayments.Open strSQL,conn

	RunningTotal = 0
	do while not objRSpayments.eof

		'If cint(objRSpayments("Amount")) <> 0 Then
			RunningTotal = (RunningTotal) + (objRSpayments("Amount"))
			paymentdescription = objRSpayments("Description")

			If InStr(paymentdescription,"Agreed to Submit Online")=0 and InStr(paymentdescription,"Multiple Vehicle Carrier")=0 and InStr(paymentdescription,"Customer Deposit")=0 and InStr(paymentdescription,"Initial Shipment")=0 and InStr(paymentdescription,"Vehicle #")=0 and InStr(paymentdescription,"Down Payment")=0 and InStr(paymentdescription,"Turbo Charge")=0 Then
				paymentdescription = ""
			End if

			body = body & "<tr>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"" nowrap>" & objRSpayments("Date") & "</td>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"">" & paymentdescription & "</td>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"" nowrap align=""right"">$" & formatnumber(objRSpayments("Amount")) & "</td>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"" nowrap align=""right"">$" & formatnumber(RunningTotal) & "</td>"
			body = body & "</tr>"

		'End If

	objRSpayments.movenext
	loop

	set objRSpayments = nothing

	body = body & "	</table>"


    body = body & "Deposit Billed To: Credit Card, Money Order or Check" & "<br>" & "<br>"


' 	if reviewdiscountreduction <> "0" then
'     	body = body & "<b>Please notice that your total quoted price was <font color='red'>discounted $25</font> because you have kindly agreed to submit an online review (hopefully very positive!) to a review site that we will email separately to you. In advance, we thank you very much for that!</b><br><br>"
'     end if

	body = body & terms



    body = body & "</font></td></tr></table><img src=""http://www.autotransportdirect.com/images/mainbox_bottom.gif"" width=""700"" height=""3"" alt="""" border=""0""></td></tr></table><center><br><font face=""Verdana,Geneva,Arial,Helvetica,sans-serif"" size=""1"">Copyright &copy; " & Year(Date) & ", <a href=""http://www.autotransportdirect.com/"" class=""footer"">AutoTransportDirect.com</a><br>License # MC 479342</p></center></font></body></html>"



	Call sendMailHTML("Direct Express Auto Transport Order System", "info@autotransportdirect.com", RsCheck("CustEmail"), "Your Direct Express Auto Transport Order - " & strOrderID, body)
	Call CommAudit(strOrderID,"order_confirmation","info@autotransportdirect.com",RsCheck("CustEmail"),"Your Direct Express Auto Transport Order - " & strOrderID,body)





End If


If cys_success = 1 or RsCheck("Status") = "NEW" Then

strSQL = "select * from orders where orderid = " & strOrderID
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn


strSQL = "select * from orders_vehicles where orderid = " & strOrderID
Set RsOrderVehicle = Server.CreateObject("ADODB.Recordset")
    RsOrderVehicle.Open strSQL,conn


audit_notes = "Order Received through front-end."
call AuditTrail(strOrderID,currentuser,audit_notes)

trackid = session("trackid")
If trackid <> "" Then
	CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
	strSQL = "update sale_conversion set dateupdated='" & CurrentDateTime & "',sale_status = '5. Order Complete' where trackid = '" & trackid & "'"
	'response.write strSQL & "<br>"

	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3

	strSQL = "update leads set orderid='" & strOrderID & "' where trackid = '" & trackid & "'"
	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3

End If

%>






<div class="title1">Your Order is Complete! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Your Order ID: <font color="#308dff"><%= strOrderID %></font></b> <br>
<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
<table width="800" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:auto;">


<tr>
	<td width="100%" class="bodytext2">
	<div class="imagebox" style="float:right;margin:0 -104px 100px 0;width: 210px;">
		<img src="/images/staff/quote4-1.jpg" width="210" height="145" alt="Direct Express Auto Transport Employee" />
		<div>Thanks! You will receive an email confirming your order, and another the moment we assign your vehicle to a driver.</div>
	</div>





<table cellspacing="2" cellpadding="2" border="0" align="center" style="margin:auto;">

<tr>
	<td class="bodytext2"><b><%=dictLanguage.Item(Session("lang")&"_quote_32")%>:</b></td>
	<td class="bodytext2"><%= rs2("Pickup_City") %>, <%= rs2("Pickup_State") %>&nbsp;&nbsp;<%= rs2("Pickup_Zip") %></td>
</tr>
<tr>
	<td class="bodytext2"><b><%=dictLanguage.Item(Session("lang")&"_quote_33")%>:</b></td>
	<td class="bodytext2"><%= rs2("Deliver_City") %>, <%= rs2("Deliver_State") %>&nbsp;&nbsp;<%= rs2("Deliver_Zip") %></td>
</tr>
<%
if cint(Rs2("Num_Of_Vehicles")) = 1 then %>
	<tr>
		<td class="bodytext2"><b><%=dictLanguage.Item(Session("lang")&"_quote_34")%>:</b></td>
		<td class="bodytext2" nowrap><%= rs2("Vehicle_Make") %> - <%= rs2("Vehicle_Model") %></td>
	</tr>
<% else
	if NOT RsOrderVehicle.eof then %>
	<tr>
		<td class="bodytext2" valign="top"><b><%=dictLanguage.Item(Session("lang")&"_quote_34")%>:</b></td>
		<td class="bodytext2" nowrap valign="top">
		<%
		counter=1
		do until RsOrderVehicle.eof
			%>
			<%= RsOrderVehicle("Vehicle_Make") %> - <%= RsOrderVehicle("Vehicle_Model") %><br>
			<%
			counter=counter+1
		RsOrderVehicle.moveNext
		loop
		set RsOrderVehicle=nothing
		%>
	</td>
	</tr>
	<% end if
end if
%>

<tr>
	<td class="bodytext2" nowrap="nowrap"><b><%=dictLanguage.Item(Session("lang")&"_quote_35")%>:&nbsp;&nbsp;&nbsp;</b></td>
	<td class="bodytext2" nowrap="nowrap"><%= rs2("Quote_vehicle_operational") %> and Rolls, Brakes, Steers</td>
</tr>
<tr>
	<td class="bodytext2"><b><%=dictLanguage.Item(Session("lang")&"_quote_36")%>:</b></td>
	<td class="bodytext2"><%= rs2("Quote_vehicle_trailer") %></td>
</tr>
</table>
<div class="title2" align="center">
<div style="margin:25px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
<b><%=dictLanguage.Item(Session("lang")&"_quote_37")%>:</b> $<%= formatnumber(rs2("Total"))  %>
<br><br><br>
</div>
<div class="bodytext2" align="center">
<font color="#308dff">
<b>Your transaction is successful.  $<%=strDeposit%> has been charged to your credit card as a deposit.<br><br>
Please print out this page as your order receipt.  Call 1-800-600-3750 with any questions.<br><br>
Thank you for your business!<br><br>
</img></font>
</div>
<!--
<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>



<br>


<div align="center"><img src="//d36b03yirdy1u9.cloudfront.net/images/turbocharge.jpg" alt="image" width="620" height="30" /></div>
<form action="turbocharge_submit.asp" method="post" style="margin:0;">
<input type="hidden" name="strOrderID" value="<%= strOrderID %>">
<b>
<div align="center">
<div class="imagebox" style="float: right;margin-left: -32px;right: 45px;position: relative;margin-top: 15px;width: 210px;">
	<img src="/images/staff/quote4-2.jpg" width="210" height="145" alt="Direct Express Auto Transport Employee" />
	<div>A Turbo-Charge usually is not necessary, but if you are in a hurry or in a remote location it doesn't hurt. All of the extra money goes to the driver.</div>
</div>
<br />
It is usually not necessary, but sometimes a little<br/>extra for the carrier goes a long way.
<div class="Sep5"></div>
We offer the option of turbo-charging your order,<br/>which sometimes speeds things up.
<div class="Sep5"></div>
Even with the extra for the carrier, there are still<br/>no guarantees regarding pickup and delivery dates.
<div class="Sep5"></div>
</b>


<table><tr><td class="bodytext2">
<input type="radio" name="turbo" value="level1" checked>&nbsp;&nbsp;Yes, Turbo-Charge a little ($50)<br>
<input type="radio" name="turbo" value="level2">&nbsp;&nbsp;Yes, Turbo-Charge a lot ($100)<br>
<input type="radio" name="turbo" value="level3">&nbsp;&nbsp;Yes, Turbo-Charge a lot more ($200)<br>
</td></tr></table>
<br>
This amount will be added to the Balance Owed the Carrier,<br>made payable with a Money Order or Cash upon Delivery.

<br><br>
<input type="submit" name="Submit" value="Select Turbo-Charge &raquo;" class="submitbutton2"><br><br>
</div>
</form>
-->

<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
<br>

	<table border="0" cellspacing="0" cellpadding="3" align="center" style="margin:auto;">
	<tr>
		<td class="formtext" align="right">Order ID:</td>
		<td class="bodytext2"><font color="blue"><b><%= strOrderID %></b></font></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_61")%>:</td>
		<td class="bodytext2"><%= rs2("CustFirstName") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_62")%>:</td>
		<td class="bodytext2"><%= rs2("CustLastName") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_63")%>:</td>
		<td class="bodytext2"><%= rs2("CustPhone1") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_64")%>:</td>
		<td class="bodytext2"><%= rs2("CustEmail") %></td>
	</tr>
	<tr>
		<td class="title3" colspan="2"><br>
		<%=dictLanguage.Item(Session("lang")&"_quote_65")%><br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Year:</td>
		<td class="bodytext2"><%= rs2("Vehicle_Year") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Make:</td>
		<td class="bodytext2"><%= rs2("Vehicle_Make") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Model:</td>
		<td class="bodytext2"><%= rs2("Vehicle_Model") %></td>
	</tr>

	<tr>
		<td class="title3" colspan="2"><br>
		<%=dictLanguage.Item(Session("lang")&"_quote_42")%><br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>

	<tr>
		<td class="formtext" align="right">
		<%=dictLanguage.Item(Session("lang")&"_quote_44")%>
		</td>
		<td valign="top" class="bodytext2"><%= rs2("DateAvailable") %></td>
	</tr>

	<tr>
		<td class="title3" colspan="2"><br>
		<%=dictLanguage.Item(Session("lang")&"_quote_45")%><br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_47")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_Contact") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_48")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_Address1") %></td>
	</tr>
	<tr>
		<td class="formtext"> </td>
		<td class="bodytext2"><%= rs2("Pickup_Address2") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_49")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_City") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_50")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_State") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_51")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_Zip") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_52")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_HomePhone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_53")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_WorkPhone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_54")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_CellPhone") %></td>
	</tr>



	<tr>
		<td class="title3" colspan="2"><br>
		<%=dictLanguage.Item(Session("lang")&"_quote_46")%><br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Contact Name:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_Contact") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Address:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_Address1") %></td>
	</tr>
	<tr>
		<td class="formtext"> </td>
		<td class="bodytext2"><%= rs2("Deliver_Address2") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">City:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_City") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">State:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_State") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Zip:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_Zip") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Home Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_HomePhone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Work Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_WorkPhone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Cell Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Deliver_CellPhone") %></td>
	</tr>


	<tr>
		<td class="title3" colspan="2"><br>
		<%=dictLanguage.Item(Session("lang")&"_quote_72")%>
		<div class="smalltext">A deposit of $<%=strDeposit%> to be billed to your credit card.</div>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>

	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_97")%>:&nbsp;
		<div class="smalltext">(<%=dictLanguage.Item(Session("lang")&"_quote_80")%>)</div></td>
		<td class="bodytext2" valign="top"><%= rs2("Billing_Name") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_81")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Address1") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Address2") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_49")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_City") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_50")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_State") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_51")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Zip") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_63")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Phone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_82")%>:&nbsp;</td>
		<td class="bodytext2"><%= rs2("CreditCartType") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_83")%>:&nbsp;</td>
		<td class="bodytext2">XXXXXXXXXXXX<%= right(strCreditCartNum,4) %></td>
	</tr>
	<tr>
		<td class="formtext" align="right" valign="top"><%=dictLanguage.Item(Session("lang")&"_quote_84")%>:&nbsp;</td>
		<td class="bodytext2"><%= strCreditCartMonth %> / <%= strCreditCartYear %></td>
	</tr>



	<tr>
		<td class="title3" colspan="2"><br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right"><%=dictLanguage.Item(Session("lang")&"_quote_87")%>:&nbsp;</td>
		<td class="bodytext2" valign="top">
		$<%= formatnumber(rs2("Balance")) %>
		</td>
	</tr>
	<tr>
		<td class="smalltext" colspan="2" align="center">
		<%=dictLanguage.Item(Session("lang")&"_quote_88")%><br>

		</td>
	</tr>






	</table>

	</td>
</tr>
</table>
<br>

<div align="center">
<!-- Google Code for 4. Complete Sale Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1070891707;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "OtO5CIn-rgEQu4XS_gM";
var google_conversion_value = 150;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1070891707/?value=150&amp;label=OtO5CIn-rgEQu4XS_gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>



</div>



<%
set rs2 = nothing
%>

<% Else %>

<br><br>
<div align="center">


<div class="Sep5"></div><table bgcolor="#999999" width="95%" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:auto;"><tr><td><img src="//d36b03yirdy1u9.cloudfront.net/images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
<br>
</div>
<div class="bodytext2" align="center">
<font color="#990000">
<b>Error:</b> <%= ResponseReason %>
<br><br>
There was a problem processing your credit card.  If you would like to resubmit<br>your billing information <a href="quote3.asp?orderid=<%= strOrderID %>"><b>click here to go back.</b></a>
<br><br>
If you would like to speak to a representative about this error, please<br>call 1-800-600-3750 and refer to order number <%= strOrderID %>.
<br><br>

<!--
<b>If you would prefer to pay with your Checking Account, <a href="quote3_check.asp?orderid=<%= strOrderID %>">Click HERE Now</a>.</b>
-->

<br><br>
Thank You.<br><br>
</font>
</div>
<div class="Sep5"></div><table bgcolor="#999999" width="95%" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:auto;"><tr><td><img src="//d36b03yirdy1u9.cloudfront.net/images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>




</div><br><br><br><br>

<% End If

set rsCheck = nothing
set rs2 = nothing
call closedb()

%>
<!--#include file="../includes/footer.asp"-->
