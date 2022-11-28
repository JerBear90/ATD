<% pagetitle = "Direct Express Auto Transport - Order Confirmation" %>
<% metadescription = "Nationwide auto shipping at the lowest rates. Door to door pick-up and delivery service." %>
<% metakeywords = "truck transport quote, luxury car transport quote, SUV transport quote, door to door transport, sedan transport quote, sports car transport quote" %>
<!--#include file="../includes/header.asp"-->


<%
dim conn
call openDB()

strOrderID = getUserInput(request.form("orderid"),0)

strSQL = "select * from orders where orderid = " & strOrderID
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn
%>

 <!--#include file="../termshtmlemail.asp" -->

<%

	strSQL = "update orders set status = 'NEW', order_date = '" & fncFmtDate(Date(), "%Y-%m-%d") & "', vcheck_status = 'vCheck Complete'"
	strSQL = strSQL & "  where orderid = " & strOrderID


	Set Rs1 = Server.CreateObject("ADODB.Recordset")
	    Rs1.Open strSQL,conn,3,1

	strSQL = "insert into payments (OrderID,Description,Amount)"
	strSQL = strSQL & " values  (" & strOrderID & ",'Down Payment - vCheck','-" & DEATDeposit & "')"
	Set Rsinsertprice2 = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice2.Open strSQL,conn

	body = "You have a new order at AutoTransportDirect.com.  Please login to the administrator and refer to order number " & strOrderID
	Call sendMail("AutoTransportDirect.com Order System", "info@autotransportdirect.com", "info@autotransportdirect.com", "New Order - " & strOrderID, body)
	Call sendMail("AutoTransportDirect.com Order System", "info@autotransportdirect.com", "mrupers@mac.com", "New Order - " & strOrderID, body)




	body = ""
	body = body & "Thank You!" & "<br>" & "<br>"
	body = body & "Your order number is " & strOrderID & "<br>" & "<br>"
	body = body & "If you need to contact us regarding your order, call 800-600-3750 or go to http://www.autotransportdirect.com/contact_us.asp" & "<br>" & "<br>"
	body = body & "Next 3 Steps" & "<br>" & "<br>"
	body = body & "1. Another email will be sent to you when your vehicle has been assigned a carrier for pickup. That email is simply a courtesy to you letting you know that your shipment is in the process of getting picked up. " & "<br>" & "<br>"
	body = body & "2. A dispatcher or driver will call your pickup contact person at the number(s) you provided to arrange pickup. Usually, but not always, setup is the day before pickup. You don't have to wait around for that call - but you do need to respond to it in a timely fashion. Sometimes a driver is ready on short notice (a few hours) and if that happens and you can't meet him, just call us to reschedule another driver. But if you can meet him, we highly recommend that you do so if at all possible. " & "<br>" & "<br>"
	body = body & "3. Usually, but not always, the day before delivery the driver will call your delivery contact person at the number(s) you provided to arrange delivery. " & "<br>" & "<br>"
	body = body & "4. <strong>The Balance Owed is always paid to the driver upon delivery (<span style=""color:red"">not pickup</span>) with CASH or MONEY ORDER made payable to the delivery company <span style=""color:red"">(not us)</span>.</strong>" & "<br>" & "<br>"
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

		If cint(objRSpayments("Amount")) <> 0 Then
			RunningTotal = (RunningTotal) + (objRSpayments("Amount"))
			paymentdescription = objRSpayments("Description")

			If InStr(paymentdescription,"Initial Shipment")=0 and InStr(paymentdescription,"Down Payment")=0 Then
				paymentdescription = ""
			End if

			body = body & "<tr>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"" nowrap>" & objRSpayments("Date") & "</td>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"">" & paymentdescription & "</td>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"" nowrap align=""right"">$" & formatnumber(objRSpayments("Amount")) & "</td>"
			body = body & "		<td bgcolor=""#ffffff"" class=""bodytext3"" nowrap align=""right"">$" & formatnumber(RunningTotal) & "</td>"
			body = body & "</tr>"

		End If

	objRSpayments.movenext
	loop

	set objRSpayments = nothing

	body = body & "	</table>"
	body = body & "	</td>"
	body = body & "</tr>"
	body = body & "</table>"

	body = body & terms





	Call sendMailHTML("Direct Express Auto Transport Order System", "info@autotransportdirect.com", Rs2("CustEmail"), "Your Direct Express Auto Transport Order - " & strOrderID, body)
	Call CommAudit(strOrderID,"order_confirmation","info@autotransportdirect.com",Rs2("CustEmail"),"Your Direct Express Auto Transport Order - " & strOrderID,body)








guid = session("guid")
If guid <> "" Then
	CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
	strSQL = "update sale_conversion set dateupdated='" & CurrentDateTime & "',sale_status = '5. Order Complete' where guid = '" & guid & "'"
	'response.write strSQL & "<br>"

	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3
End If


%>




<SCRIPT LANGUAGE="JavaScript">
<!-- Overture Services Inc. 07/15/2003
var cc_tagVersion = "1.0";
var cc_accountID = "6924336740";
var cc_marketID =  "0";
var cc_protocol="http";
var cc_subdomain = "convctr";
if(location.protocol == "https:")
{
    cc_protocol="https";
     cc_subdomain="convctrs";
}
var cc_queryStr = "?" + "ver=" + cc_tagVersion + "&aID=" + cc_accountID + "&mkt=" + cc_marketID +"&ref=" + escape(document.referrer);
var cc_imageUrl = cc_protocol + "://" + cc_subdomain + ".overture.com/images/cc/cc.gif" + cc_queryStr;
var cc_imageObject = new Image();
cc_imageObject.src = cc_imageUrl;
// -->
</SCRIPT>


<div class="title1">Your Order is Complete!<br>
<div class="Sep5"></div><table bgcolor="#999999" width="650" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div></div>
<table width="100%" cellspacing="0" cellpadding="0" border="0">


<tr>
	<td width="30"><img src="images/spacer.gif" width="30" height="1" alt="" border="0"></td>
	<td width="100%" class="bodytext2">

<table cellspacing="2" cellpadding="2" border="0" width="50%" align="center">
<tr>
	<td class="bodytext2"><b>Shipping From:</b></td>
	<td class="bodytext2"><%= rs2("Quote_shippingfromstate") %></td>
</tr>
<tr>
	<td class="bodytext2"><b>Shipping To:</b></td>
	<td class="bodytext2"><%= rs2("Quote_shippingtostate") %></td>
</tr>
<tr>
	<td class="bodytext2"><b>Type of Vehicle:</b></td>
	<td class="bodytext2" nowrap><%= rs2("Vehicle_Make") %> - <%= rs2("Vehicle_Model") %></td>
</tr>
<tr>
	<td class="bodytext2"><b>Operating Condition:</b></td>
	<td class="bodytext2"><%= rs2("Quote_vehicle_operational") %></td>
</tr>
<tr>
	<td class="bodytext2"><b>Type of Trailer:</b></td>
	<td class="bodytext2"><%= rs2("Quote_vehicle_trailer") %></td>
</tr>
</table>
<div class="title2" align="center">
<div class="Sep5"></div><table bgcolor="#999999" width="400" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
<b>Total Price:</b> $<%= formatnumber(rs2("Total"))  %>
<br>
<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
<br>
</div>
<div class="bodytext2" align="center">
<font color="#990000">
Your transaction is successful.  $<%=DEATDeposit%> has been charged to your checking account as a deposit.<br><br>
Please print out this page as your order receipt.  Call 1-800-600-3750 with any questions.<br><br>Thank you for your business!<br><br>
</font>
</div>
<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>



	<table border="0" cellspacing="0" cellpadding="3" align="center">
	<tr>
		<td class="formtext" align="right">Order ID:</td>
		<td class="bodytext2"><%= strOrderID %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">First Name:</td>
		<td class="bodytext2"><%= rs2("CustFirstName") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Last Name:</td>
		<td class="bodytext2"><%= rs2("CustLastName") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Phone Number:</td>
		<td class="bodytext2"><%= rs2("CustPhone1") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">E-Mail Address:</td>
		<td class="bodytext2"><%= rs2("CustEmail") %></td>
	</tr>
	<tr>
		<td class="title3" colspan="2"><br>
		Vehicle Details<br>
		<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
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
		<td class="formtext" align="right">VIN # (Last 6 Digits):</td>
		<td class="bodytext2"><%= rs2("Vehicle_VIN") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">License Plate State:</td>
		<td class="bodytext2">
		<%= rs2("Vehicle_PlateState") %>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">License Plate Number:</td>
		<td class="bodytext2"><%= rs2("Vehicle_PlateNumber") %></td>
	</tr>

	<tr>
		<td class="title3" colspan="2"><br>
		Dates<br>
		<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
		</td>
	</tr>

	<tr>
		<td class="formtext" align="right">Date Available To Ship<div class="smalltext">(please allow 7 day window)</div></td>
		<td valign="top" class="bodytext2"><%= rs2("DateAvailable") %></td>
	</tr>

	<tr>
		<td class="title3" colspan="2"><br>
		Pickup From<br>
		<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Contact Name:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_Contact") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Address:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_Address1") %></td>
	</tr>
	<tr>
		<td class="formtext"> </td>
		<td class="bodytext2"><%= rs2("Pickup_Address2") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">City:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_City") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">State:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_State") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Zip:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_Zip") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Home Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_HomePhone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Work Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_WorkPhone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Cell Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Pickup_CellPhone") %></td>
	</tr>



	<tr>
		<td class="title3" colspan="2"><br>
		Deliver To<br>
		<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
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
		<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Balance Due:&nbsp;</td>
		<td class="bodytext2" valign="top">
		$<%= formatnumber(rs2("Balance")) %>
		</td>
	</tr>
	<tr>
		<td class="smalltext" colspan="2" align="center">Payable upon delivery by cash or money order made payable to delivery company.</td>
	</tr>






	</table>

	</td>
	<td width="50"><img src="images/spacer.gif" width="50" height="1" alt="" border="0"></td>
</tr>
</table>
<br>





<%
set rs2 = nothing



set Rs2 = nothing
set rs2 = nothing
call closedb()

%>
<!--#include file="../includes/footer.asp"-->
