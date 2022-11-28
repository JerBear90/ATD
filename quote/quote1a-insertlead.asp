<%
if session("stopleads") <> 1 then

' 	If session("stopleads") = 1 and Session("Username") = "" Then
' 		leaduser = "exclusive"
' 		'Check to see if we have already sent 100 exlusive leads out.
' 		leadthreshhold = 100
' 		CurrentDate = fncFmtDate(date(),"%Y-%m-%d")
' 		strSQL = "select count(*) as leadcount from leads_send where username='exclusive' and dateupdated > '" & CurrentDate & " 05:00:00' order by dateupdated DESC"
' 		'strSQL = "select count(*) as leadcount from leads_send where username='exclusive' and dateupdated > '2013-10-02 00:00:00' order by dateupdated DESC"
' 		Set RsLeadCount = Server.CreateObject("ADODB.Recordset")
' 		    RsLeadCount.Open strSQL,conn
' 		leadcount = cint(RsLeadCount("leadcount"))
' 		If leadcount > leadthreshhold then
' 			leaduser = CurrentUsername
'
' 		end if
' 	Else
' 		leaduser = CurrentUsername
' 	End If

	leaduser = CurrentUsername

	if repeat_customer="Yes" and repeat_discount=1 Then
		repeat_customer_db = "Yes"
		nosend=1
	Else
		repeat_customer_db = "No"
		nosend=0
	End If
	strSQL = "insert into leads (sitename,trackid,guid,username,dateadded,dateupdated,quote_status,multi_vehicle,ipnumber,quote_distance,fromzip,fromstate,tozip,tostate,auto_year,auto_make,auto_model,auto_condition,auto_trailer,user_agent,mobile_device,repeat_customer,nosend) values ('autotransportdirect.com','" & trackid & "','" & guid & "','" & leaduser & "','" & CurrentDateTime & "','" & CurrentDateTime & "','Step 2','" & multi_vehicle & "', '" & ipnumber & "'," & totaldistance & ",'" & startziptemp & "','" & shippingfromstatetemp & "','" & endziptemp & "','" & shippingtostatetemp & "','" & auto_year_temp & "','" & auto_make_temp & "','" & auto_model_temp & "','" & vehicle_operational & "','" & vehicle_trailer & "','" & user_agent & "','" & mobile_device & "','" & repeat_customer_db & "','" & nosend & "')"

	Set Rs = Server.CreateObject("ADODB.Recordset")
		Rs.Open strSQL,conn,3,3
end if
%>