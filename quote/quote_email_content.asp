<!--#include file="../includes/init.asp"-->
<!--#include file="../includes/datefunc.asp"-->
<%
if Session("First_Name") <> "" then
	salesrep = Session("First_Name") & " at "
end if

%>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Direct Express Auto Transport Quote</title>
	<style type="text/css">
	td {font: 14px Arial;}
	.title {color:#009; font-weight:bold; font-size:18px;}
	</style>
</head>
<body bgcolor="#ededed">
<%
sendfrom = request("sendfrom")
sendto = request("sendto")
numvehicles = request("numvehicles")
vehicle = request("vehicle")
vehicle2 = request("vehicle2")
vehicle3 = request("vehicle3")
vehicle4 = request("vehicle4")
vehicle5 = request("vehicle5")
vehicle6 = request("vehicle6")
vehicle7 = request("vehicle7")
vehicle8 = request("vehicle8")
vehicle9 = request("vehicle9")
vehicle10 = request("vehicle10")
operating = request("operating")
trailer = request("trailer")
price = request("price")
deposit = request("deposit")
repname = request("repname")
rep = request("rep")

if deposit <> "" then
	DEATDeposit = deposit
end if

if IsNumeric(numvehicles) then
else
	numvehicles = 1
end if

if cint(numvehicles)<3 then
	depositdiscount=0*numvehicles
elseif numvehicles>=3 and numvehicles<=6 then
	depositdiscount=25*numvehicles
elseif numvehicles>=7 and numvehicles<=10 then
	depositdiscount=50*numvehicles
end if

subtotaldeposits = DEATDeposit * numvehicles

totaldeposit = subtotaldeposits - depositdiscount

%>
<br/>
<table cellpadding="0" cellspacing="0"  bgcolor="#ffffff" align="center" width="700">
<tr>
	<td><a href="http://www.autotransportdirect.com/?src=<%=rep%>"><img src="http://www.autotransportdirect.com/images/header-email.jpg"></a></td>


</tr>
</table>

<table cellpadding="0" cellspacing="0"  bgcolor="#ffffff" align="center" width="700" style="border:1px solid #000;">
<tr><td>

    <br>
	<table cellpadding="4" cellspacing="0" align="center">

	<tr>
	    <td rowspan="99" valign="top">
	        <img src="http://www.autotransportdirect.com/images/email-girl.jpg" style="padding-right:10px">
	    </td>
		<td>Shipping From:</td>
		<td><b><%= sendfrom %></b></td>
	</tr>
	<tr>
		<td>Shipping To:</td>
		<td><b><%= sendto %></b></td>
	</tr>
	<%if cint(numvehicles) = 1 then %>
	<tr>
		<td>Type of Vehicle:</td>
		<td><b><%= vehicle %></b></td>
	</tr>
	<% else %>
	<tr>
		<td valign="top">Type of Vehicles:</td>
		<td valign="top">
		<b>1. <%= vehicle %><br />
		<%if vehicle2<>"-" then%>2. <%= vehicle2 %><br /><%end if%>
		<%if vehicle3<>"-" then%>3. <%= vehicle3 %><br /><%end if%>
		<%if vehicle4<>"-" then%>4. <%= vehicle4 %><br /><%end if%>
		<%if vehicle5<>"-" then%>5. <%= vehicle5 %><br /><%end if%>
		<%if vehicle6<>"-" then%>6. <%= vehicle6 %><br /><%end if%>
		<%if vehicle7<>"-" then%>7. <%= vehicle7 %><br /><%end if%>
		<%if vehicle8<>"-" then%>8. <%= vehicle8 %><br /><%end if%>
		<%if vehicle9<>"-" then%>9. <%= vehicle9 %><br /><%end if%>
		<%if vehicle10<>"-" then%>10. <%= vehicle10 %><br /><%end if%></b>
		</td>
	</tr>

	<%end if%>
	<tr>
		<td nowrap="nowrap">Operating Condition:</td>
		<td nowrap="nowrap"><b><%= operating %></b></td>
	</tr>
	<tr>
		<td>Type of Trailer:</td>
		<td><b><%= trailer %></b></td>
	</tr>
	</table>

	<tr>
	    <td colspan=2>
        	<div style="font-size: 15px;" align="center">
        		<p>
        		Your Quote from <strong><%=repname%>Direct Express Auto Transport</strong><br>
        		<span style="font-size: 15px;">As of <%=fncFmtDate(now(),"%B %d, %Y")%></span>
        		<br><br>
        		The Original Car Shipping Quote Calculator says ...
        		</p>
        	</div>
	    </td>
	</tr>



	<tr>
		<td colspan="2" align="center">
		<font size="5"><b>Total Price: <font color="#008000">$<%= formatnumber(price) %></font></b></font>
		<br><br>
		</td>
	</tr>

    <tr>
		<td colspan="2" align="center">
            <div style="width:600px; margin: 0 auto; text-align:center;">
    		<font color="#000000" size="4"><strong>To setup your order go to <br><a href="http://www.autotransportdirect.com/?src=<%=rep%>">www.autotransportdirect.com</a><br><br>We can also give you good advice if you call us at<br><font size="5">800-600-3750</font><br><br><font color="#000000" size="2">We are respecting your privacy by NOT calling your cell phone, nor will we bombard your inbox with incessant emails. One is enough, don't you think?</strong></font></font>
    		</div>
    		<br>
    		<div style="width:600px;">
    		We were the first company to offer free online quotes in 2004 without the customer providing any personal information. Our car shipping quote calculator is the best and most accurate in the industry, which is why we have the lowest cancellation rates<br>and highest number of return customers.
    		</div>
    		<br>
    		<a href="http://www.autotransportdirect.com.com/video/?src=<%=rep%>"><img src="http://www.autotransportdirect.com/images/email-video.jpg"></a><br><br>


		</td>
	</tr>
	</table>



</td></tr></table>



</body>
</html>