<% pagetitle = "Direct Express Auto Transport - Order Confirmation" %>
<% metadescription = "Nationwide auto shipping at the lowest rates. Door to door pick-up and delivery service." %>
<% metakeywords = "truck transport quote, luxury car transport quote, SUV transport quote, door to door transport, sedan transport quote, sports car transport quote" %>
<!--#include file="../includes/header.asp"-->

<%
strOrderID = session("strOrderID")


%>


<% If strOrderID = "" Then %>

<% response.redirect "index.asp" %>


<% Else  %>
<%
dim conn
call openDB()

strSQL = "select * from orders where orderid = " & strOrderID
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn

guid = session("guid")
If guid <> "" Then
	CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
	strSQL = "update sale_conversion set dateupdated='" & CurrentDateTime & "',sale_status = '5. Order Complete' where guid = '" & guid & "'"
	'response.write strSQL & "<br>"

	Set Rs = Server.CreateObject("ADODB.Recordset")
	    Rs.Open strSQL,conn,3,3
End If

 %>
<div class="title1">Your Order is Complete!<br>
<div class="Sep5"></div><table bgcolor="#999999" width="650" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div></div>





<table width="100%" cellspacing="0" cellpadding="0" border="0">


<tr>
	<td width="30"><img src="images/spacer.gif" width="30" height="1" alt="" border="0"></td>
	<td width="100%" class="bodytext2">



<div class="bodytext2" align="center">
<font color="#990000"><br>
<b>Thanks for your letting us know how you heard about us.</b></font>
</div><br>
<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>




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
		Billing Details<div class="smalltext">A deposit of $<%=DEATDeposit%> to be billed to your credit card.</div>
		<div class="Sep5"></div><table bgcolor="#999999" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td></tr></table><div class="Sep5"></div>
		</td>
	</tr>

	<tr>
		<td class="formtext" align="right">Name:&nbsp;<div class="smalltext">(As it appears on your card)</div></td>
		<td class="bodytext2" valign="top"><%= rs2("Billing_Name") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Billing Address:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Address1") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Address2") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">City:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_City") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">State:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_State") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Zip:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Zip") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Phone:&nbsp;</td>
		<td class="bodytext2"><%= rs2("Billing_Phone") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Credit Card:&nbsp;</td>
		<td class="bodytext2"><%= rs2("CreditCartType") %></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Credit Card Number:&nbsp;</td>
		<td class="bodytext2">XXXXXXXXXXXX<%= right(strCreditCartNum,4) %></td>
	</tr>
	<tr>
		<td class="formtext" align="right" valign="top">Expiration:&nbsp;</td>
		<td class="bodytext2"><%= strCreditCartMonth %> / <%= strCreditCartYear %></td>
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
session("strOrderID") = ""
set rs2 = nothing
call closedb()
%>

<% End If %>
<!--#include file="../includes/footer.asp"-->
