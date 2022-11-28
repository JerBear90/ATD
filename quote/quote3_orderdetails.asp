<!--#include file="../includes/init.asp"-->
<!--#include file="../includes/languages.asp"-->



<%
dim conn
call openDB()

orderid = Request("orderid")
incomplete_key = Request("id")


strSQL = "select o.* from orders o, orders_meta om where o.orderid=" & orderid & " and om.incomplete_key='" & incomplete_key & "' and o.status='INCOMPLETE'"
'response.write strsql

Set objRS = Server.CreateObject("ADODB.Recordset")
    objRS.Open strSQL,conn

if objRS.eof then
	%>
	<br><br><br><br>
	<div align="center" style="font-size:15px; font-weight:bold;">
	I'm sorry, we could not find your order information.  Please call us at 800-600-3750 and refer to order # <%=orderid%>

	</div>
	<%
else

	strSQL = "select * from orders where orderid = " & orderid
	Set Rs2 = Server.CreateObject("ADODB.Recordset")
	    Rs2.Open strSQL,conn


	strSQL = "select * from orders_vehicles where orderid = " & orderid
	Set RsOrderVehicle = Server.CreateObject("ADODB.Recordset")
	    RsOrderVehicle.Open strSQL,conn
	%>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="//media.autotransportdirect.com/css/all.css" media="all"/>
		<!--[if lt IE 8]><link type="text/css" rel="stylesheet" href="//media.autotransportdirect.com/css/ie.css" /><![endif]-->
		<style type="text/css">
		body {
			padding: 20px;
            background: white;

		}

		#zwrapper {
			width: 700px;
			background: white;
		}
		</style>
	</head>
	<body>
	<div id="zwrapper">



		<table width="650" cellspacing="0" cellpadding="0" border="0" align="center">


		<tr>
			<td width="100%" class="bodytext2">

		<div class="title2" align="center">
			<b>Order Detail - Order ID: <%=orderid%></b>
		</div>

		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>


		<table cellspacing="2" cellpadding="2" border="0" width="50%" align="center">
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
			<td class="bodytext2" nowrap="nowrap"><b><%=dictLanguage.Item(Session("lang")&"_quote_35")%>:</b></td>
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
		<br>
		</div>

		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>



		<br>



			<table width="650" border="0" cellspacing="0" cellpadding="3" align="center">

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
				<br>

				</td>
			</tr>






			</table>

			</td>
		</tr>
		</table>
		<br>






	</div>


<%
end if

call closedb()
call closedb2()
%>
</body>
</html>