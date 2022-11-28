<% pagetitle = "Direct Express Auto Transport - quote Summary" %>
<% metadescription = "Auto Shipping &amp; Car Transport &amp; Shipping transport car has never been easier..." %>
<% metakeywords = "automobile transport quote, auto shipping, auto transport quote, car transport quote, door to door transport, national transport quote, sedan transport quote, sports car transport quote" %>
<% pagename="quote1a-leads" %>
<% nocache = 1 %>
<!--#include virtual="/includes/header-wp.asp"-->


<%

dim conn
call openDB()


' If Session("Username") = "" and bizhours=1 Then
'     strSQL = "select count from counter2"
'     Set RsCount = Server.CreateObject("ADODB.Recordset")
'     	RsCount.Open strSQL,conn
'     count = cint(RsCount("count"))
'
'     if count=5 then
'         counttrigger=1
'         newcount=1
'     else
'         counttrigger=0
'         newcount = count + 1
'     end if
'
'     if counttrigger = 1 then
'         session("stopleads") = 0
'     end if
'
'
'     strSQL = "update counter2 set count=" & newcount
'     Set RsUpdateCount = Server.CreateObject("ADODB.Recordset")
'     	RsUpdateCount.Open strSQL,conn
' End If
'Override by CLAY - 10/30/13
session("stopleads") = 1



'Check Banning of IPs and GUIDs
banned = CheckBanv2(Request.ServerVariables("REMOTE_ADDR"),guid)
If banned = "1" Then
	response.redirect "/index-wp.asp?error=limit"
End If

DateAvailable = getUserInput(Request.Form("DateAvailable"),0)
shippingnextseven = getUserInput(Request.Form("shippingnextseven"),0)

clearsession = getUserInput(Request.Form("clearsession"),0)

shippingfromzip = getUserInput(Request.Form("shippingfromzip"),0)
shippingfromcity = getUserInput(Request.Form("shippingfromcity"),0)
shippingfromstate = getUserInput(Request.Form("shippingfromstate"),0)
shippingfromstatetemp = shippingfromstate
shippingtozip = getUserInput(Request.Form("shippingtozip"),0)
shippingtocity = getUserInput(Request.Form("shippingtocity"),0)
shippingtostate = getUserInput(Request.Form("shippingtostate"),0)
shippingtostatetemp = shippingtostate

auto_year = getUserInput(Request.Form("auto_year"),0)
auto_make = getUserInput(Request.Form("auto_make"),0)
auto_model = getUserInput(Request.Form("auto_model"),0)
vehicle_operational = getUserInput(Request.Form("vehicle_operational"),0)
vehicle_trailer = getUserInput(Request.Form("vehicle_trailer"),0)

howmany = getUserInput(Request.Form("howmany"),0)
numvehicles = getUserInput(Request.Form("numvehicles"),0)

if numvehicles="1" then
	howmany = "onevehicle"
	multi_vehicle=0
else
	multi_vehicle=1
end if

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


'Repeat Customer Code
repeat_customer = getUserInput(Request.Form("repeat_customer"),0)
repeat_email = getUserInput(Request.Form("repeat_email"),0)
if repeat_customer<>"" then
	session("repeat_customer") = repeat_customer
	session("repeat_email") = repeat_email
end if

'Repeat Customer Check
repeat_discount=0
if repeat_customer="Yes" then
	strSQL = "select count(*) as custorders from orders where custemail='" & repeat_email & "' and status in ('NEW','ASSIGNED')"
	Set RsRepeatStats = Server.CreateObject("ADODB.Recordset")
	RsRepeatStats.Open strSQL,conn
	repeatorders = cint(RsRepeatStats("custorders"))
	session("repeat_discount") = 1
	if repeatorders > 0 then
		repeat_discount=1
	end if
end if
session("repeat_discount") = repeat_discount


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

if Session("SRCUsername") = "" then
    if request("src") <> "" then
        CurrentUsername = request("src")
        Session("SRCUsername") = CurrentUsername
    end if
else
    CurrentUsername = Session("SRCUsername")
end if


session("DateAvailable") = DateAvailable
session("shippingnextseven") = shippingnextseven

session("shippingfromzip") = shippingfromzip
session("shippingfromcity") = shippingfromcity
session("shippingfromstate") = shippingfromstate
session("shippingtozip") = shippingtozip
session("shippingtocity") = shippingtocity
session("shippingtostate") = shippingtostate

session("auto_year") = auto_year
session("auto_make") = auto_make
session("auto_make_index") = Request.Form("auto_make_index")
session("auto_model") = auto_model
session("auto_model_index") = Request.Form("auto_model_index")

session("vehicle_operational") = vehicle_operational
session("vehicle_trailer") = vehicle_trailer


session("howmany")=howmany
session("numvehicles")=numvehicles

if howmany <> "onevehicle" then
	session("auto_year2") = auto_year2
	session("auto_make2") = auto_make2
	session("auto_model2") = auto_model2
	session("auto_year3") = auto_year3
	session("auto_make3") = auto_make3
	session("auto_model3") = auto_model3
	session("auto_year4") = auto_year4
	session("auto_make4") = auto_make4
	session("auto_model4") = auto_model4
	session("auto_year5") = auto_year5
	session("auto_make5") = auto_make5
	session("auto_model5") = auto_model5

end if


If shippingfromzip <> "" Then

	strSQL = "select count(*) as shippingfromcitycount from zipcodes where zipcode =  '" & shippingfromzip & "' order by city"
	Set Rsshippingfromcitycount = Server.CreateObject("ADODB.Recordset")
	    Rsshippingfromcitycount.Open strSQL,conn

	If cint(Rsshippingfromcitycount("shippingfromcitycount")) > 1 Then

		strSQL = "select city,statecode from zipcodes where zipcode = '" & shippingfromzip & "' order by city"
		Set Rsshippingfromcity = Server.CreateObject("ADODB.Recordset")
		    Rsshippingfromcity.Open strSQL,conn
		'response.write "<!---" & strSQL & " --->"
		shippingfromcities = ""

		If Rsshippingfromcity.eof Then
			response.redirect "/index-wp.asp?error=notfoundfrom&quoteaction=redo"
		Else
			do while not Rsshippingfromcity.eof
				shippingfromcities = shippingfromcities & Rsshippingfromcity("city") & ", " & Rsshippingfromcity("statecode") & "|"
				shippingfromstatetemp = Rsshippingfromcity("statecode")
			Rsshippingfromcity.movenext
			loop
			shippingfromcities = left(shippingfromcities,len(shippingfromcities)-1)
		End If

	Else

	strSQL = "select city,statecode from zipcodes where zipcode =  '" & shippingfromzip & "' order by city"
		Set Rsshippingfromcity = Server.CreateObject("ADODB.Recordset")
		    Rsshippingfromcity.Open strSQL,conn

		If Rsshippingfromcity.eof Then
			response.redirect "/index-wp.asp?error=notfoundfrom&quoteaction=redo"
		Else
			shippingfromcity = Rsshippingfromcity("city")
			shippingfromstate = Rsshippingfromcity("statecode")
			shippingfromstatetemp = shippingfromstate
		End If

	End If

Else
	If shippingfromcity = "" or shippingfromstate="" Then
		'Did not fill out zip code and did not full fill out city/state req.
		response.redirect "/index-wp.asp?error=from1&quoteaction=redo"
	End If
End If


If shippingtozip <> "" Then

	strSQL = "select count(*) as shippingtocitycount from zipcodes where zipcode =  '" & shippingtozip & "' order by city"
	Set Rsshippingtocitycount = Server.CreateObject("ADODB.Recordset")
	    Rsshippingtocitycount.Open strSQL,conn

	If cint(Rsshippingtocitycount("shippingtocitycount")) > 1 Then

		strSQL = "select city,statecode from zipcodes where zipcode = '" & shippingtozip & "' order by city"
		Set Rsshippingtocity = Server.CreateObject("ADODB.Recordset")
		    Rsshippingtocity.Open strSQL,conn

		shippingtocities = ""

		If Rsshippingtocity.eof Then
			response.redirect "/index-wp.asp?error=notfoundto&quoteaction=redo"
		Else
			do while not Rsshippingtocity.eof
				shippingtocities = shippingtocities & Rsshippingtocity("city") & ", " & Rsshippingtocity("statecode") & "|"
				shippingtostatetemp = Rsshippingtocity("statecode")
			Rsshippingtocity.movenext
			loop
			shippingtocities = left(shippingtocities,len(shippingtocities)-1)
		End If

	Else

	strSQL = "select city,statecode from zipcodes where zipcode =  '" & shippingtozip & "' order by city"
		Set Rsshippingtocity = Server.CreateObject("ADODB.Recordset")
		    Rsshippingtocity.Open strSQL,conn
		If Rsshippingtocity.eof Then
			response.redirect "/index-wp.asp?error=notfoundto&quoteaction=redo"
		Else
			shippingtocity = Rsshippingtocity("city")
			shippingtostate = Rsshippingtocity("statecode")
			shippingtostatetemp = shippingtostate
		End If

	End If
Else

	If shippingtocity = "" or shippingtostate=""Then
		'Did not fill out zip code and did not full fill out city/state req.
		response.redirect "/index-wp.asp?error=to&quoteaction=redo"
	End If

End If



If left(shippingfromcity,3) = "ft " or left(shippingfromcity,4) = "ft. " Then
	shippingfromcity = replace(shippingfromcity,"ft. ","Fort ")
	shippingfromcity = replace(shippingfromcity,"ft ","Fort ")
End If
If left(shippingfromcity,3) = "st " or left(shippingfromcity,4) = "st. " Then
	shippingfromcity = replace(shippingfromcity,"st. ","Saint ")
	shippingfromcity = replace(shippingfromcity,"st ","Saint ")
End If

If left(shippingtocity,3) = "ft " or left(shippingtocity,4) = "ft. " Then
	shippingtocity = replace(shippingtocity,"ft. ","Fort ")
	shippingtocity = replace(shippingtocity,"ft ","Fort ")
End If
If left(shippingtocity,3) = "st " or left(shippingtocity,4) = "st. " Then
	shippingtocity = replace(shippingtocity,"st. ","Saint ")
	shippingtocity = replace(shippingtocity,"st ","Saint ")
End If





If shippingfromzip = "" Then

	If shippingfromcity = "" or shippingfromstate=""Then
		'Did not fill out zip code and did not full fill out city/state req.
		response.redirect "/index-wp.asp?error=from"
	End If

	'Lookup zip code from city and state
	strSQL = "select ZipCode from zipcodes where city = '" & shippingfromcity & "' and statecode = '" & shippingfromstate & "' limit 1"
	Set Rsshippingfrom = Server.CreateObject("ADODB.Recordset")
	    Rsshippingfrom.Open strSQL,conn
	If Rsshippingfrom.eof Then
		response.redirect "/index-wp.asp?error=notfoundfrom&quoteaction=redo"
	Else
		shippingfromzip = Rsshippingfrom("ZipCode")
	End If

	strSQL = "select State,StateName  from states where state = '" & shippingfromstate & "'"
	Set Rs1 = Server.CreateObject("ADODB.Recordset")
	    Rs1.Open strSQL,conn
	shippingfromstateabbr = rs1("state")
	shippingfromstate = rs1("statename")

Else

	If shippingfromcitystate <> "" Then
		shippingfromcitystateArray=split(shippingfromcitystate,",")
		shippingfromstateabbr = trim(shippingfromcitystateArray(1))
		shippingfromcity = trim(shippingfromcitystateArray(0))

		strSQL = "select State from zipcodes where StateCode = '" & shippingfromstateabbr & "'"
		Set Rs1 = Server.CreateObject("ADODB.Recordset")
		    Rs1.Open strSQL,conn
		If Rs1.eof Then
			shippingfromstate = ""
		Else
			shippingfromstate = Rs1("State")
		End If

	Else
		strSQL = "select State,StateCode,City from zipcodes where zipcode = '" & shippingfromzip & "'"
		Set Rs1 = Server.CreateObject("ADODB.Recordset")
		    Rs1.Open strSQL,conn
		If Rs1.eof Then
			response.redirect "/index-wp.asp?error=badfrom&quoteaction=redo"
		Else
			shippingfromstateabbr = rs1("StateCode")
			shippingfromstate = rs1("State")
			shippingfromcity = rs1("City")
		End If
	End If
End If

If shippingtozip = "" Then

	If shippingtocity = "" or shippingtostate=""Then
		'Did not fill out zip code and did not full fill out city/state req.
		response.redirect "/index-wp.asp?error=to"
	End If

	'Lookup zip code to city and state
	strSQL = "select ZipCode from zipcodes where city = '" & shippingtocity & "' and statecode = '" & shippingtostate & "' limit 1"
	Set Rsshippingto = Server.CreateObject("ADODB.Recordset")
	    Rsshippingto.Open strSQL,conn
	If Rsshippingto.eof Then
		response.redirect "/index-wp.asp?error=notfoundto&quoteaction=redo"
	Else
		shippingtozip = Rsshippingto("ZipCode")
	End If

	strSQL = "select State,StateName from states where state = '" & shippingtostate & "'"
	Set Rs1 = Server.CreateObject("ADODB.Recordset")
	    Rs1.Open strSQL,conn
	shippingtostateabbr = rs1("state")
	shippingtostate = rs1("statename")

Else

	If shippingtocitystate <> "" Then
		shippingtocitystateArray=split(shippingtocitystate,",")
		shippingtostateabbr = trim(shippingtocitystateArray(1))
		shippingtocity = trim(shippingtocitystateArray(0))

		strSQL = "select State from zipcodes where StateCode = '" & shippingtostateabbr & "'"
		Set Rs1 = Server.CreateObject("ADODB.Recordset")
		    Rs1.Open strSQL,conn
		If Rs1.eof Then
			shippingtostate = ""
		Else
			shippingtostate = Rs1("State")
		End If

	Else

		strSQL = "select State,StateCode,City from zipcodes where zipcode = '" & shippingtozip & "'"
		Set Rs1 = Server.CreateObject("ADODB.Recordset")
		    Rs1.Open strSQL,conn
		If Rs1.eof Then
			response.redirect "/index-wp.asp?error=badto&quoteaction=redo"
		Else
			shippingtostateabbr = rs1("StateCode")
			shippingtostate = rs1("State")
			shippingtocity = rs1("City")
		End If
	End If

End If




If shippingtostatetemp = "HI" and shippingfromstate = "HI" Then
	response.redirect "/index-wp.asp?error=insidehi&quoteaction=redo"
ElseIf shippingfromstatetemp = "HI" Then
'	response.redirect "/indexv3.asp?error=notfoundfrom"
	response.redirect "hawaii.asp?dir=from"
ElseIf shippingtostatetemp = "HI" Then
'	response.redirect "/indexv3.asp?error=notfoundto"
	response.redirect "hawaii.asp?dir=to"
End If


'Get zip codes if we don't have them
if shippingfromzip = "" then
	startzip = GetZip(shippingfromcity,shippingfromstate)
	shippingfromzip = startzip
else
	startzip = shippingfromzip
end if

if shippingtozip = "" then
	endzip = GetZip(shippingtocity,shippingtostate)
	shippingtozip = endzip
else
	endzip = shippingtozip
end if

startziptemp = startzip
endziptemp = endzip


'Figure out distance
totaldistance = GetDistancePHP(startzip,endzip)
totaldistance = cint(totaldistance)

'This function looks at the distance and redefines the deposit
DepositDistance(1)


'response.write CurrentUsername & "!<br>"

'SALES CONVERSION UPDATE start

CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
If CurrentUsername <> "" Then
	'Grab this user's last session time and guid
	strSQL = "SELECT dateupdated,trackid from sale_conversion where username='" & CurrentUsername & "' order by dateupdated desc limit 0,1"
	Set RsGetTime = Server.CreateObject("ADODB.Recordset")
	    RsGetTime.Open strSQL,conn,3,3

	'If we couldn't find a session for this user, start a new one
	If RsGetTime.eof Then
		newsession = 1
	'If we found a session, calculate the time difference and if it is less than or equal to 30 seconds, update the record and set the session guid.
	Else
		timediff = DateDiff("s", RsGetTime("dateupdated"), now())
		'timediff = DateDiff("n", RsGetTime("dateupdated"), now())
		'response.write timediff & "!<br>"
		'response.write RsGetTime("trackid") & "!<br>"

		If clng(timediff) <= 180 and clearsession<>1 Then
			'response.write "update<br>"
			trackid = RsGetTime("trackid")
			session("trackid") = trackid
			strSQL = "update sale_conversion set dateupdated='" & CurrentDateTime & "',sale_status = '1. Quote' where trackid = '" & trackid & "'"
			Set Rs = Server.CreateObject("ADODB.Recordset")
	   			Rs.Open strSQL,conn,3,3
	   	Else
			'response.write "new<br>"
	   		newsession = 1
		End If
	End If
Else
	newsession = 1
End If

If newsession = 1 Then
	'response.write "-"
	trackid = GetGuid()
	session("trackid") = trackid
	ipnumber = Request.ServerVariables("REMOTE_ADDR")



	if shippingfromstate = "0" Then
		strSQL = "select statecode from zipcodes where zipcode = '" & shippingfromzip & "' limit 0,1"
		Set RsZip = Server.CreateObject("ADODB.Recordset")
			RsZip.Open strSQL,conn,3,3
		if not RsZip.eof Then
			shippingfromstatetemp = RsZip("statecode")
		end if
		set RsZip = nothing
	end if

	if shippingtostate = "0" Then
		strSQL = "select statecode from zipcodes where zipcode = '" & shippingtozip & "' limit 0,1"
		Set RsZip = Server.CreateObject("ADODB.Recordset")
			RsZip.Open strSQL,conn,3,3
		if not RsZip.eof Then
			shippingtostatetemp = RsZip("statecode")
		end if
		set RsZip = nothing
	end if

	user_agent = Request.ServerVariables("HTTP_USER_AGENT")

	mobile_browser = 0

	Set Regex = New RegExp
	With Regex
	   .Pattern = "(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|windows ce|pda|mobile|mini|palm|symbian|series|nokia|mot-|motorola|lg-|lge|nec-|lg/|samsung|sie-|sec-|sgh-|sonyericsson|sharp|windows ce|portalmmm|o2-|docomo|philips|panasonic|sagem|smartphone|up.browser|up.link|googlebot-mobile|googlebot|slurp|spring|alcatel|sendo|blackberry|opera mini|opera 2|netfront|mobilephone mm|vodafone|avantgo|palmsource|siemens|toshiba|i-mobile|asus|kwc|htc|softbank|mozilla/5\.0 \(x11; u; linux i686; en-us; rv:1\.8\.0\.7\) gecko\/20060909 firefox/1\.5\.0\.7|playstation|nitro|iphone|ipad|ipod|google wireless transcoder|t-mobile|obigo|brew|yahooseeker|msmobot|novarra|skp|openweb)"
	   .IgnoreCase = True
	   .Global = True
	End With

	match = Regex.Test(user_agent)

	If match Then mobile_browser = mobile_browser+1

	If (InStr(Request.ServerVariables("HTTP_ACCEPT"), "text/vnd.wap.wml")) OR (InStr(Request.ServerVariables("HTTP_ACCEPT"), "application/vnd.wap.xhtml+xml")) OR (Not IsEmpty(Request.ServerVariables("HTTP_X_PROFILE"))) OR (Not IsEmpty(Request.ServerVariables("HTTP_PROFILE"))) Then
	   mobile_browser = mobile_browser+1
	end If

	mobile_agents = Array("w3c ", "acs-", "alav", "alca", "amoi", "audi", "avan", "benq", "bird", "blac", "blaz", "brew", "cell", "cldc", "cmd-", "dang", "doco", "eric", "hipt", "inno", "ipaq", "java", "jigs", "kddi", "keji", "leno", "lg-c", "lg-d", "lg-g", "lge-", "maui", "maxo", "midp", "mits", "mmef", "mobi", "mot-", "moto", "mwbp", "nec-", "newt", "noki", "operamini", "palm", "pana", "pant", "phil", "play", "port", "prox", "qwap", "sage", "sams", "sany", "sch-", "sec-", "send", "seri", "sgh-", "shar", "sie-", "siem", "smal", "smar", "sony", "sph-", "symb", "t-mo", "teli", "tim-", "tosh", "tsm-", "upg1", "upsi", "vk-v", "voda", "wap-", "wapa", "wapi", "wapp", "wapr", "webc", "winw", "winw", "xda", "xda-")
	size = Ubound(mobile_agents)
	mobile_ua = LCase(Left(user_agent, 4))

	For i=0 To size
	   If mobile_agents(i) = mobile_ua Then
	      mobile_browser = mobile_browser+1
	      Exit For
	   End If
	Next

	If InStr(Request.ServerVariables("HTTP_USER_AGENT"), "Novarra") > 0 Then mobile_browser = mobile_browser+1

	mobile_device=""
	if mobile_browser > 0 Then
		if InStr(user_agent,"iPhone") then
			mobile_device = "iPhone"
		elseif InStr(user_agent,"iPad") then
			mobile_device = "iPad"
		elseif InStr(user_agent,"Android") then
			mobile_device = "Android"
		else
			mobile_device = "Other"
		end if
	end if

	if repeat_customer="Yes" and repeat_discount=1 Then
		repeat_customer_db = "Yes"
	Else
		repeat_customer_db = "No"
	End If

	strSQL = "insert into sale_conversion (sitename,trackid,guid,username,dateadded,dateupdated,sale_status,ipnumber,quote_distance,fromzip,fromstate,tozip,tostate,num_of_vehicles,auto_year,auto_make,auto_model,user_agent,mobile_device,repeat_customer) values ('autotransportdirect.com','" & trackid & "','" & guid & "','" & CurrentUsername & "','" & CurrentDateTime & "','" & CurrentDateTime & "','1. Quote','" & ipnumber & "'," & totaldistance & ",'" & shippingfromzip & "','" & shippingfromstatetemp & "','" & shippingtozip & "','" & shippingtostatetemp & "'," & numvehicles & ",'" & auto_year & "','" & auto_make & "','" & auto_model & "','" & user_agent & "','" & mobile_device & "','" & repeat_customer_db & "')"
	'response.write strSQL
	Set Rs = Server.CreateObject("ADODB.Recordset")
		Rs.Open strSQL,conn,3,3
End If
'SALES CONVERSION UPDATE end

auto_year_temp = auto_year
auto_make_temp = auto_make
auto_model_temp = auto_model

%>
<!--#include virtual="/quote/quote1a-insertlead.asp"-->
<%

if howmany <> "onevehicle" then
	if auto_year2<>"" and auto_make2<>"" and auto_model2<>"" then
		auto_year_temp = auto_year2
		auto_make_temp = auto_make2
		auto_model_temp = auto_model2
	%>
		<!--#include virtual="/quote/quote1a-insertlead.asp"-->
	<%
	end if

	if auto_year3<>"" and auto_make3<>"" and auto_model3<>"" then
		auto_year_temp = auto_year3
		auto_make_temp = auto_make3
		auto_model_temp = auto_model3
	%>
		<!--#include virtual="/quote/quote1a-insertlead.asp"-->
	<%
	end if

	if auto_year4<>"" and auto_make<>"" and auto_model4<>"" then
		auto_year_temp = auto_year4
		auto_make_temp = auto_make4
		auto_model_temp = auto_model4
	%>
		<!--#include virtual="/quote/quote1a-insertlead.asp"-->
	<%
	end if

	if auto_year5<>"" and auto_make5<>"" and auto_model5<>"" then
		auto_year_temp = auto_year5
		auto_make_temp = auto_make5
		auto_model_temp = auto_model5
	%>
		<!--#include virtual="/quote/quote1a-insertlead.asp"-->
	<%
	end if


end if
%>

<%
If shippingfromcities <> "" or shippingtocities <> "" or session("stopleads") = 0 then
%>


	<div class="title1">Choose City<br>
	<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="30"><img src="//d36b03yirdy1u9.cloudfront.net/images/spacer.gif" width="30" height="1" alt="" border="0"></td>
		<td width="100%" class="bodytext2">
		<br/>





	<div class="imagebox" style="float:left;margin-left:160px;margin-right:30px;">
		<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote1a-1-v4.jpg" width="210" height="155" alt="Direct Express Auto Transport Employee" />
		<div>We are celebrating 10 years in business! Thank you for your support.</div>
	</div>


	<form action="quote1.asp" method="post" name="mainform" id="mainform" target="_top">
	<input type="hidden" name="shippingfromzip" value="<%= shippingfromzip %>">
	<input type="hidden" name="shippingfromcity" value="<%= shippingfromcity %>">
	<input type="hidden" name="shippingfromstate" value="<%= shippingfromstate %>">
	<input type="hidden" name="shippingtozip" value="<%= shippingtozip %>">
	<input type="hidden" name="shippingtocity" value="<%= shippingtocity %>">
	<input type="hidden" name="shippingtostate" value="<%= shippingtostate %>">

	<input type="hidden" name="shippingfrom_sales" value="<%= shippingfrom_sales %>">

	<input type="hidden" name="auto_year" value="<%= auto_year %>">
	<input type="hidden" name="auto_make" value="<%= auto_make %>">
	<input type="hidden" name="auto_model" value="<%= auto_model %>">
	<input type="hidden" name="vehicle_operational" value="<%= vehicle_operational %>">
	<input type="hidden" name="vehicle_trailer" value="<%= vehicle_trailer %>">

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

	<% if repeat_customer="Yes" and repeat_discount=0 then %>
		<span style="color:#308dff;font-weight:bold">I'm sorry, we couldn't find your e-mail address "<%=repeat_email%>" in our past orders and can not offer you a discount.  If you used a different e-mail address, <a href="index.asp?quoteaction=redo">click here to go back</a> and try a different address.<hr style="border-top: 1px solid #ccc;"/>
	<% end if %>

	<table cellspacing="2" cellpadding="2" border="0" width="50%">

	<% If shippingfromcities <> "" Then %>
	<tr>
		<td class="bodytext2" height="30"><b>Shipping From:</b></td>
		<td class="bodytext2">
		<select name="shippingfromcitystate" class="bodytext">
		<%
		shippingfromcitiesArray=split(shippingfromcities,"|")
		for L=0 to UBound(shippingfromcitiesArray)
			response.write "<option value=""" & shippingfromcitiesArray(L) & """>" & shippingfromcitiesArray(L) & "</option>" & vbcrlf
		next
		 %>
		</select>
		</td>
	</tr>
	<% Else  %>
	<tr>
		<td class="bodytext2" height="30"><b>Shipping From:</b></td>
		<td class="bodytext2"><%= shippingfromcity %>, <%= shippingfromstate %>&nbsp;&nbsp;&nbsp;<%= shippingfromzip %></td>
	</tr>
	<% End If %>

	<% If shippingtocities <> "" Then %>
	<tr>
		<td class="bodytext2" height="30"><b>Shipping To::</b></td>
		<td class="bodytext2">
		<select name="shippingtocitystate" class="bodytext">
		<%
		shippingtocitiesArray=split(shippingtocities,"|")
		for L=0 to UBound(shippingtocitiesArray)
			response.write "<option value=""" & shippingtocitiesArray(L) & """>" & shippingtocitiesArray(L) & "</option>" & vbcrlf
		next
		 %>
		</select>
		</td>
	</tr>
	<% Else  %>
	<tr>
		<td class="bodytext2" height="30"><b>Shipping To:</b></td>
		<td class="bodytext2"><%= shippingtocity %>, <%= shippingtostate %>&nbsp;&nbsp;&nbsp;<%= shippingtozip %></td>
	</tr>
	<% End If %>


	<tr>
		<td class="bodytext2" height="30"><b>Type of Vehicle:</b></td>
		<td class="bodytext2" nowrap><%= auto_year %>&nbsp;<%= auto_make %> - <%= auto_model %></td>
	</tr>
	<tr>
		<td class="bodytext2" height="30"><b>Operating Condition:&nbsp;&nbsp;&nbsp;</b></td>
		<td class="bodytext2"><%= vehicle_operational %> and Rolls, Brakes, Steers</td>
	</tr>
	<tr>
		<td class="bodytext2" height="30"><b>Type of Trailer:</b></td>
		<td class="bodytext2"><%= vehicle_trailer %></td>
	</tr>
	<% if session("stopleads") <> 1 then %>
		<tr>
			<td class="bodytext2" colspan="2" style="color:#308dff; font-weight:bold; font-size:13px; line-height:14px;">
			<hr style="border-top: 1px solid #ccc;"/>
			Your quote will appear in a few seconds right here online.
			<br/><br/>
			But first we need to know to whom we gave the quote and kindly request the following additional basic information so that we can track your quote.
			<br/><br/>
			In advance, thank you for considering us.<br/><br/>
			</td>
		</tr>

		<tr>
			<td class="bodytext2" valign="top"><div class="Sep8"></div><b>Your Name:</b></td>
			<td class="bodytext2" valign="top"><input type="text" name="customer_name" id="customer_name" width="90" maxlength="150" class="required text" style="width:230px;" /> <span class="req">*</span></td>
		</tr>

		<tr>
			<td class="bodytext2" valign="top"><div class="Sep8"></div><b>Your Email:</b></td>
			<td class="bodytext2" valign="top"><input type="text" name="customer_email" id="customer_email" width="90" maxlength="80" class="required text" style="width:230px;" /> <span class="req">*</span></td>
		</tr>

		<tr>
			<td class="bodytext2" valign="top"><div class="Sep8"></div><b>Your Phone:</b></td>
			<td class="bodytext2" valign="top"><input type="text" name="customer_phone" id="customer_phone" width="90" maxlength="80" class="text" style="width:230px;" /> <% if Session("Username") = "" then %><span class="req">*</span><% end if %></td>
		</tr>

		<tr>
			<td class="bodytext2" valign="top"><div class="Sep8"></div><b>Preferred Move Date:</b></td>
			<td class="bodytext2" valign="top"><input type="text" name="customer_movedate" id="customer_movedate" width="90" maxlength="50" class="required text" style="width:230px;" /> <span class="req">*</span></td>
		</tr>
	<% end if %>

	<tr>
		<td class="bodytext2" valign="top"></td>
		<td class="bodytext2" valign="top"  style="color:#308dff; font-weight:bold; font-size:13px; line-height:14px;">
		Your quote will appear in a few seconds<br/>right here online.
		<br/><br/>
		<input type="submit" value="Go On " class="submitbutton"></td>
	</tr>

	<% if session("stopleads") <> 1 then %>
	<tr>
        <td colspan="2">
            <br>
    		<div style="clear:both;font-size:11px;">Your privacy is important to us! By typing your name and clicking 'Get My Quotes Now' you give express written consent to be quoted by our network of transporters which may be through an automated dialer, even if you are on a DNC list.</div>
        </td>
    </tr>
	<% end if %>


	</table>


	</form>



		</td>
		<td width="50"><img src="//d36b03yirdy1u9.cloudfront.net/images/spacer.gif" width="50" height="1" alt="" border="0"></td>
	</tr>

	</table>


<% Else  %>

	<br><br><br>

	<div align="center"><b>Please Wait....We are calculating your quote.</b></div>
	<br><br><br><br><br><br><br><br><br>
	<!--#include virtual="/includes/footer-wp.asp"-->

	<form action="quote1.asp" method="post" name="mainform" target="_top">
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
	<input type="hidden" name="vehicle_operational" value="<%= vehicle_operational %>">
	<input type="hidden" name="vehicle_trailer" value="<%= vehicle_trailer %>">

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

	</form>
	<script language="JavaScript">
	document.mainform.submit();
	</script>



<% End If %>





<% call closedb() %>
<!--#include virtual="/includes/footer-wp.asp"-->
