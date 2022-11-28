<% pagetitle = "Direct Express Auto Transport - Shipment Details" %>
<% metadescription = "We are a nationwide car shipping company that specializes in coast-to-coast - door to door auto transporting, car shipping, trucks, cars, SUVs shipping cars within the continental U.S." %>
<% metakeywords = "automobile transport quote, truck transport quote, auto transport quote, car transport quote, national car shipping quote" %>
<!--#include file="../includes/init.asp"-->
<!--#include file="../includes/currencyformatinc.asp"-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="/fvalidate/fValidate.config.js"></script>
    <script type="text/javascript" src="/fvalidate/fValidate.core.js"></script>
    <script type="text/javascript" src="/fvalidate/fValidate.lang-enUS.js"></script>
    <script type="text/javascript" src="/fvalidate/fValidate.logical.js"></script>
	<script type="text/javascript" src="/fvalidate/fValidate.basic.js"></script>
	<script type="text/javascript" src="/fvalidate/fValidate.web.js"></script>
	<script type="text/javascript" src="/fvalidate/fValidate.datetime.js"></script>
	<script type="text/javascript" src="/fvalidate/fValidate.controls.js"></script>


	<link rel="stylesheet" type="text/css" href="/css/all.css" media="all"/>

	<!--[if lt IE 8]><link type="text/css" rel="stylesheet" href="/css/ie.css" /><![endif]-->
	<style>
	body {min-width: 100px !important;}
	</style>
</head>
<body>


<%

todo = getUserInput(request("todo"),0)
cd50url = getUserInput(request("cd50url"),0)
cd100url = getUserInput(request("cd100url"),0)
comments = getUserInput(request("comments"),0)
sendfrom = getUserInput(request("sendfrom"),0)
sendto = getUserInput(request("sendto"),0)
numvehicles = getUserInput(request("numvehicles"),0)
vehicle = getUserInput(request("vehicle"),0)
vehicle2 = getUserInput(request("vehicle2"),0)
vehicle3 = getUserInput(request("vehicle3"),0)
vehicle4 = getUserInput(request("vehicle4"),0)
vehicle5 = getUserInput(request("vehicle5"),0)
operating = getUserInput(request("operating"),0)
trailer = getUserInput(request("trailer"),0)
price = getUserInput(request("price"),0)
deposit = getUserInput(request("deposit"),0)

If todo = "" Then
%>

<form action="priceissue_email.asp" method="post" name="mainform" onsubmit="return validateForm(this);">
<input type="hidden" name="todo" value="go">
<input type="hidden" name="cd50url" value="<%=cd50url%>">
<input type="hidden" name="cd100url" value="<%=cd100url%>">
<input type="hidden" name="sendfrom" value="<%=sendfrom%>">
<input type="hidden" name="sendto" value="<%=sendto%>">
<input type="hidden" name="numvehicles" value="<%=numvehicles%>">
<input type="hidden" name="vehicle" value="<%=vehicle%>">
<input type="hidden" name="vehicle2" value="<%=vehicle2%>">
<input type="hidden" name="vehicle3" value="<%=vehicle3%>">
<input type="hidden" name="vehicle4" value="<%=vehicle4%>">
<input type="hidden" name="vehicle5" value="<%=vehicle5%>">
<input type="hidden" name="operating" value="<%=operating%>">
<input type="hidden" name="trailer" value="<%=trailer%>">
<input type="hidden" name="price" value="<%=price%>">
<input type="hidden" name="deposit" value="<%=deposit%>">

<br><br>
<table border="0" cellspacing="0" cellpadding="3" align="center">


<tr>
	<td class="formtext" align="right" valign="top"><div class="Sep5"></div>Comment to Mike:</td>
	<td>
	<textarea cols="80" rows="4" name="comments"></textarea>
	</td>
</tr>

<tr>
	<td></td>
	<td>

	<input type="submit" name="Submit" value="Send E-Mail &raquo;" onMouseOver="this.style.backgroundColor='#009933';this.style.color='#ffffff'"
onMouseOut="this.style.backgroundColor='#FFCC00';this.style.color='#000000'" class="quotebuttonsmall">

	</td>
</tr>

</form>
</table>

<% Else %>
<br><br>
<div align="center">
The info has been successfully emailed to Mike
<br><br>
You may close this popup and continue your order by clicking on the close button below.  Thanks!
</div>
<%




'Send Email to Customer
body = Session("Username") & " has reported a pricing issue.<br><br>Message: " & comments & "<br><br><a href='" & cd50url & "'>CD-50</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='" & cd100url & "'>CD-100</a><hr>"

body = body & "From: " & sendfrom & "<br>"
body = body & "To: " & sendto & "<br>"
body = body & "Total Price: " & price & "<br>"
body = body & "Vehicle 1: " & vehicle & "<br>"
if vehicle2 <> "-" then
    body = body & "Vehicle 2: " & vehicle2 & "<br>"
end if
if vehicle3 <> "-" then
    body = body & "Vehicle 3: " & vehicle3 & "<br>"
end if
if vehicle4 <> "-" then
    body = body & "Vehicle 4: " & vehicle4 & "<br>"
end if
if vehicle5 <> "-" then
    body = body & "Vehicle 5: " & vehicle5 & "<br>"
end if
body = body & "Running: " & operating & "<br>"
body = body & "Trailer: " & trailer & "<br>"


Call sendMail("Direct Express Auto Transport", "info@autotransportdirect.com", "mrupers@gmail.com", "Price Issue Reported", body)
'Call sendMail("Direct Express Auto Transport", "info@autotransportdirect.com", "clay@madebysprung.com", "Price Issue Reported", body)



%>


<% End If %>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script src="/scripts/ga_keyword2.js" type="text/javascript"></script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-678634-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>


<!-- Woopra Code Start -->
<script type="text/javascript" src="//static.woopra.com/js/woopra.v2.js"></script>
<script type="text/javascript">
woopraTracker.addVisitorProperty("GUID", "<%=guid%>");
woopraTracker.track();
</script>
<!-- Woopra Code End -->
<%
call closedb()
call closedb2()
%>
</body>
</html>