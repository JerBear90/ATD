<% pagetitle = "AutoTransportDirect.com - Order Confirmation" %>
<% metadescription = "Nationwide auto shipping at the lowest rates. Door to door pick-up and delivery service." %>
<% metakeywords = "truck transport quote, luxury car transport quote, SUV transport quote, door to door transport, sedan transport quote, sports car transport quote" %>
<!--#include file="../includes/header.asp"-->

<%
strOrderID = getUserInput(request.form("strOrderID"),0)
strTurbo = getUserInput(request.form("turbo"),0)
strSalesRep  = getUserInput(request.form("strSalesRep"),0)

If strTurbo = "level1" then
	turbochargeamt = "50"
ElseIf strTurbo = "level2" then
	turbochargeamt = "100"
ElseIf strTurbo = "level3" then
	turbochargeamt = "200"
End If


dim conn
call openDB()

strSQL = "select * from orders where orderid = " & strOrderID
Set RsCheck = Server.CreateObject("ADODB.Recordset")
    RsCheck.Open strSQL,conn


newbalance = cint(RsCheck("Balance")) + cint(turbochargeamt)
newtotal = cint(RsCheck("Total")) + cint(turbochargeamt)
turbocharge = RsCheck("turbocharge")

If len(turbocharge) > 0 then
	donotcharge = 1
End If

'response.write "turbochargeamt: " & turbochargeamt & "<br>"
'response.write "newbalance: " & newbalance
'response.end


If donotcharge = 1 and Session("username") <> "claydough" Then
%>
<div align="center"><br><br>
Your order has already been turbo-charged.  If you would like to speak to a representative about this, please<br>call 1-800-600-3750 and refer to order number <%= strOrderID %>.</div><br><br><br>
<%

Else



	If len(Session("Username")) = 0 Then
		currentuser = "ATD"
	Else
		currentuser = Session("Username")
	End If



		strSQL = "update orders set total = '" & newtotal & "', balance = '" & newbalance & "', turbocharge = '" & strTurbo & "' where orderid = " & strOrderID
		Set Rs1 = Server.CreateObject("ADODB.Recordset")
			Rs1.Open strSQL,conn,3,1


		strSQL = "insert into payments (OrderID,Description,Amount,username)"
		strSQL = strSQL & " values  (" & strOrderID & ",'Turbo Charge - " & strTurbo & "','" & turbochargeamt & "','" & currentuser & "')"
		Set Rsinsertprice2 = Server.CreateObject("ADODB.Recordset")
			Rsinsertprice2.Open strSQL,conn


		strSQL = "select * from orders where orderid = " & strOrderID
		Set Rs2 = Server.CreateObject("ADODB.Recordset")
			Rs2.Open strSQL,conn

		audit_notes = "Order Turbo Charged through front-end - " & strTurbo & " ($" & turbochargeamt & ")"
		call AuditTrail(strOrderID,currentuser,audit_notes)
	%>
	<!--#include file="../termshtmlemail.asp" -->

	<%

	strSQL = "select * from orders where orderid = " & strOrderID
	Set RsOrder = Server.CreateObject("ADODB.Recordset")
	    RsOrder.Open strSQL,conn


	strSQL = "select * from orders_vehicles where orderid = " & strOrderID
	Set RsOrderVehicle = Server.CreateObject("ADODB.Recordset")
	    RsOrderVehicle.Open strSQL,conn

	body = ""

	body = "<div align=""center""><a href=""http://www.autotransportdirect.com""><img src=""http://media.autotransportdirect.com/images/email_header.jpg""></a></div><br><br>"
	body = body & "Thank You for Turbo Charging Your Order!" & "<br>" & "<br>"
	body = body & "Your order number is " & strOrderID & "<br>" & "<br>"
	body = body & "If you need to contact us regarding your order, call <font color=""red""><strong>800-600-3750</strong></font> or go to http://www.autotransportdirect.com/contact_us.asp" & "<br>" & "<br>"



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
	body = body & "<td class=""bodytext2"" nowrap=""nowrap"">" & RsOrder("DateAvailable_Initial") & "&nbsp;-&nbsp;<b><a href=""http://www.autotransportdirect.com/shipping_dates.asp"">Please see typical shipping time frames</a></b></td>"

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

		If cint(objRSpayments("Amount")) <> 0 Then
			RunningTotal = (RunningTotal) + (objRSpayments("Amount"))
			paymentdescription = objRSpayments("Description")

			If InStr(paymentdescription,"Multiple Vehicle Carrier")=0 and InStr(paymentdescription,"Customer Deposit")=0 and InStr(paymentdescription,"Initial Shipment")=0 and InStr(paymentdescription,"Vehicle #")=0 and InStr(paymentdescription,"Down Payment")=0 and InStr(paymentdescription,"Turbo Charge")=0 Then
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
	body = body & "<br><strong>Turbo Charging your order sometimes speeds things up. Even with the extra for the carrier, there are still no guarantees regarding pickup and delivery dates.</strong><br><br>"


'	body = body & "-----------------------------------------------------------------------" & vbcrlf
' 	body = body & "Total Amount: $" & formatnumber(newtotal) & vbcrlf
' 	body = body & "Less Deposit Paid: $-" & DEATDeposit & vbcrlf
' 	body = body & "Balance Due Carrier COD: $" & formatnumber(newbalance) & vbcrlf
' 	body = body & "(The Balance Due Carrier includes your Turbo-Charged addition of $" & turbochargeamt & ")" & vbcrlf
' 	body = body & "As of " & fncFmtDate(Now(), "%m-%d-%Y %h:%N %P") & vbcrlf
' 	body = body & "-----------------------------------------------------------------------" & vbcrlf & vbcrlf

	body = body & terms



	Call sendMailHTML("AutoTransportDirect.com Order System", "info@autotransportdirect.com", RsCheck("CustEmail"), "Your Turbo-Charged Direct Express Auto Transport Order - " & strOrderID, body)

	Call CommAudit(strOrderID,"order_turbocharge","info@autotransportdirect.com",RsCheck("CustEmail"),"Your Turbo-Charged Direct Express Auto Transport Order - " & strOrderID,body)





	%>



		<div class="title1">Your Order has been Turbo-Charged!<br>
		<div class="Sep5"></div>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>

		<table width="950" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:auto;">


		<tr>
			<td width="100%" class="bodytext2">


			<div class="imagebox" style="float: right;width: 210px;">
				<img src="/images/staff/turbo-1.jpg" width="210" height="145" alt="Direct Express Auto Transport Employee" />
				<div>I'm sure that extra will be appreciated. Thanks!</div>
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
		<b>Updated Total Price:</b> $<%= formatnumber(rs2("Total"))  %>
		<br><br><br>
		</div>

		<div class="clear"></div><br/>
		<div class="bodytext2" align="center">
		<font color="#308dff">
		<b>Your transaction is successful. Only $<%=DEATDeposit%> was charged to your credit card as a deposit and the $<%=turbochargeamt%> Turbo-Charge has been added to the balance owed to the carrier. Again, the Turbo-Charge amount is included in the balance owed to the carrier/driver and IS NOT charged to your credit card. The additional amount does not guarantee faster service.
		<br><br>
		We appreciate your business and look forward to providing excellent service.</img>

		</font>
		</div>
		<div class="Sep5"></div>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		<div class="Sep5"></div>
			<div class="imagebox" style="float: right;width: 210px;">
				<img src="/images/staff/turbo-2.jpg" width="210" height="145" alt="Direct Express Auto Transport Employee" />
				<div>Only the original deposit was charged to your credit card. The extra turbo-charge is added to the balance due the driver upon delivery. Thanks again!</div>
			</div>

			<table border="0" cellspacing="0" cellpadding="3" align="center" width="75%" style="float:left; margin:auto;">
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
				<div class="Sep5"></div><div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div><div class="Sep5"></div>
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
				<div class="Sep5"></div><div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div><div class="Sep5"></div>
				</td>
			</tr>

			<tr>
				<td class="formtext" align="right">Date Available To Ship<div class="smalltext">(please allow 7 day window)</div></td>
				<td valign="top" class="bodytext2"><%= rs2("DateAvailable") %></td>
			</tr>

			<tr>
				<td class="title3" colspan="2"><br>
				Pickup From<br>
				<div class="Sep5"></div><div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div><div class="Sep5"></div>
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
				<div class="Sep5"></div><div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div><div class="Sep5"></div>
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
				Billing Details<div class="smalltext">$<%=DEATDeposit%> has been charged to your credit card.</div>
				<div class="Sep5"></div><div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div><div class="Sep5"></div>
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
				<div class="Sep5"></div><div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div><div class="Sep5"></div>
				</td>
			</tr>


			<tr>
				<td class="formtext" align="right">Balance Due:&nbsp;</td>
				<td class="bodytext2" valign="top">
				$<%= formatnumber(rs2("Balance")) %>
				</td>
			</tr>
			<tr>
				<td class="smalltext" colspan="2" align="center">Payable upon delivery by certified check, money order or cash.</td>
			</tr>






			</table>

			</td>
		</tr>
		</table>
		<br>





	<%
	set rs2 = nothing

End If
set rsCheck = nothing

call closedb()

%>
<!--#include file="../includes/footer.asp"-->
