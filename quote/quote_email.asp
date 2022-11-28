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
sendfrom = getUserInput(request("sendfrom"),0)
sendto = getUserInput(request("sendto"),0)
numvehicles = getUserInput(request("numvehicles"),0)
vehicle = getUserInput(request("vehicle"),0)
vehicle2 = getUserInput(request("vehicle2"),0)
vehicle3 = getUserInput(request("vehicle3"),0)
vehicle4 = getUserInput(request("vehicle4"),0)
vehicle5 = getUserInput(request("vehicle5"),0)
vehicle6 = getUserInput(request("vehicle6"),0)
vehicle7 = getUserInput(request("vehicle7"),0)
vehicle8 = getUserInput(request("vehicle8"),0)
vehicle9 = getUserInput(request("vehicle9"),0)
vehicle10 = getUserInput(request("vehicle10"),0)
operating = getUserInput(request("operating"),0)
trailer = getUserInput(request("trailer"),0)
price = getUserInput(request("price"),0)
deposit = getUserInput(request("deposit"),0)
emailto = getUserInput(request("emailto"),0)

If todo = "" Then
%>



<form action="quote_email.asp" method="post" name="mainform" onsubmit="return validateForm(this);">
<input type="hidden" name="todo" value="go">
<input type="hidden" name="sendfrom" value="<%=sendfrom%>">
<input type="hidden" name="sendto" value="<%=sendto%>">
<input type="hidden" name="numvehicles" value="<%=numvehicles%>">
<input type="hidden" name="vehicle" value="<%=vehicle%>">
<input type="hidden" name="vehicle2" value="<%=vehicle2%>">
<input type="hidden" name="vehicle3" value="<%=vehicle3%>">
<input type="hidden" name="vehicle4" value="<%=vehicle4%>">
<input type="hidden" name="vehicle5" value="<%=vehicle5%>">
<input type="hidden" name="vehicle6" value="<%=vehicle6%>">
<input type="hidden" name="vehicle7" value="<%=vehicle7%>">
<input type="hidden" name="vehicle8" value="<%=vehicle8%>">
<input type="hidden" name="vehicle9" value="<%=vehicle9%>">
<input type="hidden" name="vehicle10" value="<%=vehicle10%>">
<input type="hidden" name="operating" value="<%=operating%>">
<input type="hidden" name="trailer" value="<%=trailer%>">
<input type="hidden" name="price" value="<%=price%>">
<input type="hidden" name="deposit" value="<%=deposit%>">


<table border="0" cellspacing="0" cellpadding="3" align="center">

<tr>
	<td colspan="2" align="center">
	<br>
	<div style="font-weight:bold;line-height:25px;font-size:18px;">
	It's easy to e-mail yourself the quote you just received! Just enter your email address in the box below and click the "Send E-Mail" button.
	</div>
	<br>

	</td>
</tr>

<tr>
	<td class="formtext" align="right">Your E-Mail Address:</td>
	<td><input type="text" name="emailto" size="30" alt="email" emsg="Please enter a valid email address"></td>
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
Your quote has been successfully emailed to <%=emailto%>
<br><br>
You may close this popup and continue your order by clicking on the close button below.  Thanks!
</div>
<%
if Session("First_Name") <> "" then
	if Session("First_Name") = "Yukti" then
		repnametemp = "Jessica"
	elseif Session("First_Name") = "Jessica" then
		repnametemp = "Scarlet"
	else
		repnametemp = Session("First_Name")
	end if
	repname = "<font color=""red"">" & repnametemp & "</font> at "
	rep = Session("Username")

end if
qs = "sendfrom=" & Server.URLEncode(sendfrom) & "&sendto=" & Server.URLEncode(sendto) & "&vehicle=" & Server.URLEncode(vehicle) & "&numvehicles=" & Server.URLEncode(numvehicles) & "&vehicle2=" & Server.URLEncode(vehicle2) & "&vehicle3=" & Server.URLEncode(vehicle3) & "&vehicle4=" & Server.URLEncode(vehicle4) & "&vehicle5=" & Server.URLEncode(vehicle5) & "&vehicle6=" & Server.URLEncode(vehicle6) & "&vehicle7=" & Server.URLEncode(vehicle7) & "&vehicle8=" & Server.URLEncode(vehicle8) & "&vehicle9=" & Server.URLEncode(vehicle9) & "&vehicle10=" & Server.URLEncode(vehicle10) & "&operating=" & Server.URLEncode(operating) & "&trailer=" & Server.URLEncode(trailer) & "&price=" & Server.URLEncode(formatnumber(price)) & "&deposit=" & Server.URLEncode(deposit) & "&repname=" & Server.URLEncode(repname) & "&rep=" & Server.URLEncode(rep)

'response.write "http://www.autotransportdirect.com/quote_email_content.asp?" & qs
'Get Receipt Contents
strSendTrans = "http://www.autotransportdirect.com/quote/quote_email_content.asp?" & qs

Set GetHTML = server.createobject("Msxml2.serverXmlHttp.3.0")
GetHTML.open "GET", strSendTrans, False
GetHTML.send()
receiptresult = GetHTML.responseText
Set GetHTML = nothing

'response.write receiptresult


'Send Email to Customer
body = receiptresult
Call sendMail("Direct Express Auto Transport", "info@autotransportdirect.com", emailto, "Direct Express Auto Transport 800-600-3750 Quote", body)
Call sendMail("Direct Express Auto Transport", "info@autotransportdirect.com", "info@autotransportdirect.com", emailto & " | E-Mail Quote", body)




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