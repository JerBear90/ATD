<% pagetitle = "Direct Express Auto Transport - Checkout" %>
<% metadescription = "Competitive quotes for Auto Transport Shipping Door-to-Door. The ultimate resource for vehicle shipping, auto transport, and car moving... Simple Shipping" %>
<% metakeywords = "car transport quote, truck shipping quote, auto transport quote, car shipping quote, sedan transport quote, sports car transport quote" %>
<%
pagename="quote3"
prettyphoto=1
%>
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


dim conn
call openDB()
If Instr(Request.ServerVariables("HTTP_REFERER"),"quote2") > 0 Then


strQuoteID = getUserInput(request.form("strQuoteID"),0)
strCustFirstName = getUserInput(request.form("strCustFirstName"),0)
strCustLastName = getUserInput(request.form("strCustLastName"),0)
strCustCompany = getUserInput(request.form("strCustCompany"),0)
strCustPhone1 = getUserInput(request.form("strCustPhone1"),0)
strCustEmail = getUserInput(request.form("strCustEmail"),0)


howmany = getUserInput(Request.Form("howmany"),0)
numvehicles = getUserInput(Request.Form("numvehicles"),0)
depositpervehicle = getUserInput(request.form("depositpervehicle"),0)
carrierdiscount = getUserInput(request.form("carrierdiscount"),0)
depositdiscount = getUserInput(request.form("depositdiscount"),0)

discstatus = getUserInput(request.form("discstatus"),0)
ps = getUserInput(request.form("ps"),0)
honorquotereduction = getUserInput(request.form("honorquotereduction"),0)
militarydiscountreduction = getUserInput(request.form("militarydiscountreduction"),0)
turbochargeincrease = getUserInput(request.form("turbochargeincrease"),0)
reviewdiscountreduction = getUserInput(request.form("reviewdiscountreduction"),0)
reviewdiscountsite = getUserInput(request.form("reviewdiscountsite"),0)

pricetier = getUserInput(request.form("pricetier"),0)

helpfulhintmention = getUserInput(request.form("helpfulhintmention"),0)

shippingfrom_sales = getUserInput(Request.Form("shippingfrom_sales"),0)


auto_copartauction_cost = getUserInput(Request.Form("auto_copartauction_cost"),0)

strVehicle_Year = getUserInput(request.form("strVehicle_Year"),0)
strVehicle_Make = getUserInput(request.form("strVehicle_Make"),0)
strVehicle_Model = getUserInput(request.form("strVehicle_Model"),0)
strVehicle_Color = getUserInput(request.form("strVehicle_Color"),0)
strVehicle_Convertible = getUserInput(request.form("strVehicle_Convertible"),0)
strVehicle_LiftKit = getUserInput(request.form("strVehicle_LiftKit"),0)
strVehicle_LiftKit_Quantity = getUserInput(request.form("strVehicle_LiftKit_Quantity"),0)
strVehicle_Lowered = getUserInput(request.form("strVehicle_Lowered"),0)
strVehicle_Lowered_Quantity = getUserInput(request.form("strVehicle_Lowered_Quantity"),0)
strVehicle_Oversized_Tires = getUserInput(request.form("strVehicle_Oversized_Tires"),0)
strVehicle_Oversized_Tires_Quantity = getUserInput(request.form("strVehicle_Oversized_Tires_Quantity"),0)
strVehicle_AdditionalInfo = getUserInput(request.form("strVehicle_AdditionalInfo"),0)
strVehicle_VIN = getUserInput(request.form("strVehicle_VIN"),0)
strVehicle_StockNum = getUserInput(request.form("strVehicle_StockNum"),0)


strVehicle_Year1 = getUserInput(request.form("strVehicle_Year1"),0)
strVehicle_Make1 = getUserInput(request.form("strVehicle_Make1"),0)
strVehicle_Model1 = getUserInput(request.form("strVehicle_Model1"),0)
strVehicle_Color1 = getUserInput(request.form("strVehicle_Color1"),0)
strVehicle_Convertible1 = getUserInput(request.form("strVehicle_Convertible1"),0)
strVehicle_LiftKit1 = getUserInput(request.form("strVehicle_LiftKit1"),0)
strVehicle_LiftKit_Quantity1 = getUserInput(request.form("strVehicle_LiftKit_Quantity1"),0)
strVehicle_Lowered1 = getUserInput(request.form("strVehicle_Lowered1"),0)
strVehicle_Lowered_Quantity1 = getUserInput(request.form("strVehicle_Lowered_Quantity1"),0)
strVehicle_Oversized_Tires1 = getUserInput(request.form("strVehicle_Oversized_Tires1"),0)
strVehicle_Oversized_Tires_Quantity1 = getUserInput(request.form("strVehicle_Oversized_Tires_Quantity1"),0)
strVehicle_AdditionalInfo1 = getUserInput(request.form("strVehicle_AdditionalInfo1"),0)
strVehicle_VIN1 = getUserInput(request.form("strVehicle_VIN1"),0)
strVehicle_StockNum1 = getUserInput(request.form("strVehicle_StockNum1"),0)

strVehicle_Year2 = getUserInput(request.form("strVehicle_Year2"),0)
strVehicle_Make2 = getUserInput(request.form("strVehicle_Make2"),0)
strVehicle_Model2 = getUserInput(request.form("strVehicle_Model2"),0)
strVehicle_Color2 = getUserInput(request.form("strVehicle_Color2"),0)
strVehicle_Convertible2 = getUserInput(request.form("strVehicle_Convertible2"),0)
strVehicle_LiftKit2 = getUserInput(request.form("strVehicle_LiftKit2"),0)
strVehicle_LiftKit_Quantity2 = getUserInput(request.form("strVehicle_LiftKit_Quantity2"),0)
strVehicle_Lowered2 = getUserInput(request.form("strVehicle_Lowered2"),0)
strVehicle_Lowered_Quantity2 = getUserInput(request.form("strVehicle_Lowered_Quantity2"),0)
strVehicle_Oversized_Tires2 = getUserInput(request.form("strVehicle_Oversized_Tires2"),0)
strVehicle_Oversized_Tires_Quantity2 = getUserInput(request.form("strVehicle_Oversized_Tires_Quantity2"),0)
strVehicle_AdditionalInfo2 = getUserInput(request.form("strVehicle_AdditionalInfo2"),0)
strVehicle_VIN2 = getUserInput(request.form("strVehicle_VIN2"),0)
strVehicle_StockNum2 = getUserInput(request.form("strVehicle_StockNum2"),0)

strVehicle_Year3 = getUserInput(request.form("strVehicle_Year3"),0)
strVehicle_Make3 = getUserInput(request.form("strVehicle_Make3"),0)
strVehicle_Model3 = getUserInput(request.form("strVehicle_Model3"),0)
strVehicle_Color3 = getUserInput(request.form("strVehicle_Color3"),0)
strVehicle_Convertible3 = getUserInput(request.form("strVehicle_Convertible3"),0)
strVehicle_LiftKit3 = getUserInput(request.form("strVehicle_LiftKit3"),0)
strVehicle_LiftKit_Quantity3 = getUserInput(request.form("strVehicle_LiftKit_Quantity3"),0)
strVehicle_Lowered3 = getUserInput(request.form("strVehicle_Lowered3"),0)
strVehicle_Lowered_Quantity3 = getUserInput(request.form("strVehicle_Lowered_Quantity3"),0)
strVehicle_Oversized_Tires3 = getUserInput(request.form("strVehicle_Oversized_Tires3"),0)
strVehicle_Oversized_Tires_Quantity3 = getUserInput(request.form("strVehicle_Oversized_Tires_Quantity3"),0)
strVehicle_AdditionalInfo3 = getUserInput(request.form("strVehicle_AdditionalInfo3"),0)
strVehicle_VIN3 = getUserInput(request.form("strVehicle_VIN3"),0)
strVehicle_StockNum3 = getUserInput(request.form("strVehicle_StockNum3"),0)

strVehicle_Year4 = getUserInput(request.form("strVehicle_Year4"),0)
strVehicle_Make4 = getUserInput(request.form("strVehicle_Make4"),0)
strVehicle_Model4 = getUserInput(request.form("strVehicle_Model4"),0)
strVehicle_Color4 = getUserInput(request.form("strVehicle_Color4"),0)
strVehicle_Convertible4 = getUserInput(request.form("strVehicle_Convertible4"),0)
strVehicle_LiftKit4 = getUserInput(request.form("strVehicle_LiftKit4"),0)
strVehicle_LiftKit_Quantity4 = getUserInput(request.form("strVehicle_LiftKit_Quantity4"),0)
strVehicle_Lowered4 = getUserInput(request.form("strVehicle_Lowered4"),0)
strVehicle_Lowered_Quantity4 = getUserInput(request.form("strVehicle_Lowered_Quantity4"),0)
strVehicle_Oversized_Tires4 = getUserInput(request.form("strVehicle_Oversized_Tires4"),0)
strVehicle_Oversized_Tires_Quantity4 = getUserInput(request.form("strVehicle_Oversized_Tires_Quantity4"),0)
strVehicle_AdditionalInfo4 = getUserInput(request.form("strVehicle_AdditionalInfo4"),0)
strVehicle_VIN4 = getUserInput(request.form("strVehicle_VIN4"),0)
strVehicle_StockNum4 = getUserInput(request.form("strVehicle_StockNum4"),0)

strVehicle_Year5 = getUserInput(request.form("strVehicle_Year5"),0)
strVehicle_Make5 = getUserInput(request.form("strVehicle_Make5"),0)
strVehicle_Model5 = getUserInput(request.form("strVehicle_Model5"),0)
strVehicle_Color5 = getUserInput(request.form("strVehicle_Color5"),0)
strVehicle_Convertible5 = getUserInput(request.form("strVehicle_Convertible5"),0)
strVehicle_LiftKit5 = getUserInput(request.form("strVehicle_LiftKit5"),0)
strVehicle_LiftKit_Quantity5 = getUserInput(request.form("strVehicle_LiftKit_Quantity5"),0)
strVehicle_Lowered5 = getUserInput(request.form("strVehicle_Lowered5"),0)
strVehicle_Lowered_Quantity5 = getUserInput(request.form("strVehicle_Lowered_Quantity5"),0)
strVehicle_Oversized_Tires5 = getUserInput(request.form("strVehicle_Oversized_Tires5"),0)
strVehicle_Oversized_Tires_Quantity5 = getUserInput(request.form("strVehicle_Oversized_Tires_Quantity5"),0)
strVehicle_AdditionalInfo5 = getUserInput(request.form("strVehicle_AdditionalInfo5"),0)
strVehicle_VIN5 = getUserInput(request.form("strVehicle_VIN5"),0)
strVehicle_StockNum5 = getUserInput(request.form("strVehicle_StockNum5"),0)


strVehicle_ComingFrom_choice = getUserInput(request.form("strVehicle_ComingFrom_choice"),0)
strVehicle_ComingFrom = getUserInput(request.form("strVehicle_ComingFrom"),0)
strVehicle_BuyerNum = getUserInput(request.form("strVehicle_BuyerNum"),0)

strTotal = getUserInput(request.form("strTotal"),0)
strDeposit = getUserInput(request.form("strDeposit"),0)
strDateAvailable = getUserInput(request.form("strDateAvailable"),0)
strPickup_Contact = getUserInput(request.form("strPickup_Contact"),0)
strPickup_Company = getUserInput(request.form("strPickup_Company"),0)
strPickup_Address1 = getUserInput(request.form("strPickup_Address1"),0)
strPickup_Address2 = getUserInput(request.form("strPickup_Address2"),0)
strPickup_City = getUserInput(request.form("strPickup_City"),0)
strPickup_NearCity = getUserInput(request.form("strPickup_NearCity"),0)
strPickup_State = getUserInput(request.form("strPickup_State"),0)
strPickup_Zip = getUserInput(request.form("strPickup_Zip"),0)
strPickup_Location_Type = getUserInput(request.form("strPickup_Location_Type"),0)
strPickup_Location_Hours = getUserInput(request.form("strPickup_Location_Hours"),0)
strPickup_HomePhone = getUserInput(request.form("strPickup_HomePhone"),0)
strPickup_WorkPhone = getUserInput(request.form("strPickup_WorkPhone"),0)
strPickup_CellPhone = getUserInput(request.form("strPickup_CellPhone"),0)
strPickup_ExtraInst = getUserInput(request.form("strPickup_ExtraInst"),0)
strPickup_ExtraInst_send = getUserInput(request.form("strPickup_ExtraInst_send"),0)

strDeliver_Contact = getUserInput(request.form("strDeliver_Contact"),0)
strDeliver_Company = getUserInput(request.form("strDeliver_Company"),0)
strDeliver_Address1 = getUserInput(request.form("strDeliver_Address1"),0)
strDeliver_Address2 = getUserInput(request.form("strDeliver_Address2"),0)
strDeliver_City = getUserInput(request.form("strDeliver_City"),0)
strDeliver_NearCity = getUserInput(request.form("strDeliver_NearCity"),0)
strDeliver_State = getUserInput(request.form("strDeliver_State"),0)
strDeliver_Zip = getUserInput(request.form("strDeliver_Zip"),0)
strDeliver_Location_Type = getUserInput(request.form("strDeliver_Location_Type"),0)
strDeliver_Location_Hours = getUserInput(request.form("strDeliver_Location_Hours"),0)
strDeliver_HomePhone = getUserInput(request.form("strDeliver_HomePhone"),0)
strDeliver_WorkPhone = getUserInput(request.form("strDeliver_WorkPhone"),0)
strDeliver_CellPhone = getUserInput(request.form("strDeliver_CellPhone"),0)
strDeliver_ExtraInst = getUserInput(request.form("strDeliver_ExtraInst"),0)
strDeliver_ExtraInst_send = getUserInput(request.form("strDeliver_ExtraInst_send"),0)

strQuote_shippingfromstate = getUserInput(request.form("strQuote_shippingfromstate"),0)
strQuote_shippingtostate = getUserInput(request.form("strQuote_shippingtostate"),0)
strQuote_vehicletype = getUserInput(request.form("strQuote_vehicletype"),0)
strQuote_vehicle_operational = getUserInput(request.form("strQuote_vehicle_operational"),0)
strQuote_vehicle_trailer = getUserInput(request.form("strQuote_vehicle_trailer"),0)

rating_origin = getUserInput(request.form("rating_origin"),0)
rating_dest = getUserInput(request.form("rating_dest"),0)
rating_vehicle = getUserInput(request.form("rating_vehicle"),0)

auto_price = getUserInput(request.form("auto_price"),0)
auto_price2 = getUserInput(request.form("auto_price2"),0)
auto_price3 = getUserInput(request.form("auto_price3"),0)
auto_price4 = getUserInput(request.form("auto_price4"),0)
auto_price5 = getUserInput(request.form("auto_price5"),0)


if not IsNumeric(auto_price) then
	auto_price = 0
end if
if not IsNumeric(auto_price2) then
	auto_price2 = 0
end if
if not IsNumeric(auto_price3) then
	auto_price3 = 0
end if
if not IsNumeric(auto_price4) then
	auto_price4 = 0
end if
if not IsNumeric(auto_price5) then
	auto_price5 = 0
end if

ReferringSite = getUserInput(request.form("ReferringSite"),0)
If ReferringSite = "1" then
	ReferringSite = ""
End If

strSalesRep  = getUserInput(request.form("strSalesRep"),0)

strBalance = getUserInput(request.form("strBalance"),0)
strTotalPrice = getUserInput(request.form("strTotalPrice"),0)

DaysWaitingPickupTotalOrders = getUserInput(request.form("DaysWaitingPickupTotalOrders"),0)
if not IsNumeric(DaysWaitingPickupTotalOrders) then
	DaysWaitingPickupTotalOrders=0
end if
DaysWaitingPickupAvg = getUserInput(request.form("DaysWaitingPickupAvg"),0)
if not IsNumeric(DaysWaitingPickupAvg) then
	DaysWaitingPickupAvg=0
end if
DaysWaitingDeliverTotalOrders = getUserInput(request.form("DaysWaitingDeliverTotalOrders"),0)
if not IsNumeric(DaysWaitingDeliverTotalOrders) then
	DaysWaitingDeliverTotalOrders=0
end if
DaysWaitingDeliverAvg = getUserInput(request.form("DaysWaitingDeliverAvg"),0)
if not IsNumeric(DaysWaitingDeliverAvg) then
	DaysWaitingDeliverAvg=0
end if
DaysWaitingAvg = getUserInput(request.form("DaysWaitingAvg"),0)
if not IsNumeric(DaysWaitingAvg) then
	DaysWaitingAvg=0
end if

If strQuoteID = "" Then
	strQuoteID = "0"
End If

startzip = strPickup_Zip
endzip = strDeliver_Zip
totaldistance = GetDistancePHP(startzip,endzip)
totaldistance = cint(totaldistance)

UserIPAddress = Request.ServerVariables("REMOTE_ADDR")

if howmany <> "onevehicle" then
	strVehicle_Year=strVehicle_Year1
	strVehicle_Make=strVehicle_Make1
	strVehicle_Model=strVehicle_Model1
	strVehicle_AdditionalInfo=strVehicle_AdditionalInfo1
end if


if discstatus <> "" then
	discarray=Split(discstatus,"|")
	CDDisc = discarray(1)
	CDRatio = discarray(0)
	CDRatio_Range = discarray(2)
end if

if session("repeat_customer")="Yes" then
	repeat_customer = "Yes"
else
	repeat_customer = "No"
end if

strSQL = "insert into orders (quoteid,SiteName,EmailRefer,ReferringURL,IPNumber,repeat_customer,order_date,Total,Deposit,Balance,pricetier,PriceSource,CDDiscount,CDDisc,CDRatio,CDRatio_Range,CoPart_AutoAuction_Increase,Honor_Quote_Reduction,Military_Reduction,Review_Reduction,Review_Reduction_Site,Turbo_Charge_Increase,shippingfrom_sales,Status,Quote_shippingfromstate,Quote_shippingtostate,Quote_vehicletype,Quote_vehicle_operational,Quote_vehicle_trailer,CustFirstName,CustLastName,CustCompany,CustPhone1,CustEmail,Num_Of_Vehicles,Original_Num_Of_Vehicles,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_AdditionalInfo,Vehicle_ComingFrom,Vehicle_VIN,Vehicle_BuyerNumber,DateAvailable,DateAvailable_Initial,Pickup_Contact,Pickup_Company,Pickup_Address1,Pickup_Address2,Pickup_City,Pickup_NearCity,Pickup_State,Pickup_Zip,Pickup_Location_Type,Pickup_Location_Hours,Pickup_HomePhone,Pickup_WorkPhone,Pickup_CellPhone,Pickup_ExtraInst,Pickup_ExtraInst_send,Deliver_Contact,Deliver_Company,Deliver_Address1,Deliver_Address2,Deliver_City,Deliver_NearCity,Deliver_State,Deliver_Zip,Deliver_Location_Type,Deliver_Location_Hours,Deliver_HomePhone,Deliver_WorkPhone,Deliver_CellPhone,Deliver_ExtraInst,Deliver_ExtraInst_send,distance,SalesRep,ReferringSite,rating_origin,rating_dest,rating_vehicle,DaysWaitingPickupTotalOrders,DaysWaitingPickupAvg,DaysWaitingDeliverTotalOrders,DaysWaitingDeliverAvg,DaysWaitingAvg)"
strSQL = strSQL & " values  (" & strQuoteID & ",'AutoTransportDirect.com','" & session("emailrefer") & "','" & session("ihrefer") & "','" & UserIPAddress & "','" & repeat_customer & "','" & fncFmtDate(Now(), "%Y-%m-%d %H:%N") & "','" & strTotalPrice & "','" & strDeposit & "','" & strBalance & "','" & pricetier & "','" & ps & "','" & discstatus & "','" & CDDisc & "','" & CDRatio & "','" & CDRatio_Range & "'," & auto_copartauction_cost & "," & honorquotereduction & "," & militarydiscountreduction & "," & reviewdiscountreduction & ",'" & reviewdiscountsite & "'," & turbochargeincrease & ",'" & shippingfrom_sales & "','INCOMPLETE','" & strQuote_shippingfromstate & "','" & strQuote_shippingtostate & "','" & strQuote_vehicletype & "','" & strQuote_vehicle_operational & "','" & strQuote_vehicle_trailer & "','" & strCustFirstName & "','" & strCustLastName & "','" & strCustCompany & "','" & strCustPhone1 & "','" & strCustEmail & "','" & numvehicles & "','" & numvehicles & "','" & strVehicle_Year & "','" & strVehicle_Make & "','" & strVehicle_Model & "','" & strVehicle_AdditionalInfo & "','" & strVehicle_ComingFrom & "','" & strVehicle_VIN & "','" & strVehicle_BuyerNum & "','" & fncFmtDate(strDateAvailable, "%Y-%m-%d") & "','" & fncFmtDate(strDateAvailable, "%Y-%m-%d") & "','" & strPickup_Contact & "','" & strPickup_Company & "','" & strPickup_Address1 & "','" & strPickup_Address2 & "','" & strPickup_City & "','" & strPickup_NearCity & "','" & strPickup_State & "','" & strPickup_Zip & "','" & strPickup_Location_Type & "','" & strPickup_Location_Hours & "','" & strPickup_HomePhone & "','" & strPickup_WorkPhone & "','" & strPickup_CellPhone & "','" & strPickup_ExtraInst & "','" & strPickup_ExtraInst_send & "','" & strDeliver_Contact & "','" & strDeliver_Company & "','" & strDeliver_Address1 & "','" & strDeliver_Address2 & "','" & strDeliver_City & "','" & strDeliver_NearCity & "','" & strDeliver_State & "','" & strDeliver_Zip & "','" & strDeliver_Location_Type & "','" & strDeliver_Location_Hours & "','" & strDeliver_HomePhone & "','" & strDeliver_WorkPhone & "','" & strDeliver_CellPhone & "','" & strDeliver_ExtraInst & "','" & strDeliver_ExtraInst_send & "'," & totaldistance & ",'" & strSalesRep & "','" & ReferringSite & "'," & rating_origin & "," & rating_dest & "," & rating_vehicle & "," & DaysWaitingPickupTotalOrders & "," & DaysWaitingPickupAvg & "," & DaysWaitingDeliverTotalOrders & "," & DaysWaitingDeliverAvg & "," & DaysWaitingAvg & ")"
strSQL = strSQL & "; SELECT LAST_INSERT_ID() as orderid;"
Set Rs1 = Server.CreateObject("ADODB.Recordset")
    Rs1.Open strSQL,conn

Set RsGetID=Rs1.NextRecordset()
strmaxorderid = RsGetID("orderid")

'strSQL = "select max(orderid) as orderid from orders"
' strSQL = "SELECT LAST_INSERT_ID() as orderid;"
' Set RSMax = Server.CreateObject("ADODB.Recordset")
'     RSMax.Open strSQL,conn
'
' strmaxorderid = RSMax("orderid")
' set RsMax = nothing

if honorquotereduction <> "0" then
	audit_notes = "Honored previous quote. Initial quote reduced -$" & honorquotereduction
	call AuditTrail(strmaxorderid,CurrentUsername,audit_notes)
end if

if militarydiscountreduction <> "0" then
	audit_notes = "Military Discount Applied. Initial quote reduced -$" & militarydiscountreduction
	call AuditTrail(strmaxorderid,CurrentUsername,audit_notes)
end if


if reviewdiscountreduction <> "0" then
	audit_notes = "Customer Agreed to Submit Online Review. Initial quote reduced -$25"
	call AuditTrail(strmaxorderid,CurrentUsername,audit_notes)
end if

if turbochargeincrease <> "0" then
	audit_notes = "Order Turbo Charged upon initial entry. Increased original quote by $" & turbochargeincrease
	call AuditTrail(strmaxorderid,CurrentUsername,audit_notes)

	turbocharge=""
	if cint(turbochargeincrease) = 50 then
		turbocharge="level1"
	elseif cint(turbochargeincrease) = 100 then
		turbocharge="level2"
	elseif cint(turbochargeincrease) = 200 then
		turbocharge="level3"
	end if

	if turbocharge<>"" then
		strSQL = "update orders set turbocharge = '" & turbocharge & "' where orderid = " & strmaxorderid
		Set RsTurbo = Server.CreateObject("ADODB.Recordset")
		    RsTurbo.Open strSQL,conn,3,3
	end if

end if


If helpfulhintmention <> "" Then
	if helpfulhintmention = "yes" then
		audit_notes = "Helpful hint was mentioned"
		call AuditTrail(strmaxorderid,CurrentUsername,audit_notes)
	elseif helpfulhintmention = "ignore" then
		audit_notes = "Helpful hint was ignored"
		call AuditTrail(strmaxorderid,CurrentUsername,audit_notes)
	end if
End If

if cint(pricetier) = 1 then
    tiermessage = " / Standard Rate"
elseif cint(pricetier) = 2 then
    tiermessage = " / Expedited Rate"
elseif cint(pricetier) = 3 then
    tiermessage = " / Rush Rate"
end if

if howmany = "onevehicle" then
	strSQL = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'" & strVehicle_Year & "','" & strVehicle_Make & "','" & strVehicle_Model & "','" & strVehicle_Color & "','" & strVehicle_VIN & "','" & strVehicle_StockNum & "','" & strVehicle_Convertible & "','" & strVehicle_LiftKit & "','" & strVehicle_LiftKit_Quantity & "','" & strVehicle_Lowered & "','" & strVehicle_Lowered_Quantity & "','" & strVehicle_Oversized_Tires & "','" & strVehicle_Oversized_Tires_Quantity & "','" & strVehicle_AdditionalInfo & "'," & auto_price & ")"
	Set Rsinsertvehicle = Server.CreateObject("ADODB.Recordset")
	    Rsinsertvehicle.Open strSQL,conn
else
	strSQL = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'" & strVehicle_Year1 & "','" & strVehicle_Make1 & "','" & strVehicle_Model1 & "','" & strVehicle_Color1 & "','" & strVehicle_VIN1 & "','" & strVehicle_StockNum1 & "','" & strVehicle_Convertible1 & "','" & strVehicle_LiftKit1 & "','" & strVehicle_LiftKit_Quantity1 & "','" & strVehicle_Lowered1 & "','" & strVehicle_Lowered_Quantity1 & "','" & strVehicle_Oversized_Tires1 & "','" & strVehicle_Oversized_Tires_Quantity1 & "','" & strVehicle_AdditionalInfo1 & "'," & auto_price & ")"
	Set Rsinsertvehicle = Server.CreateObject("ADODB.Recordset")
	    Rsinsertvehicle.Open strSQL,conn

	strSQL = "insert into payments (OrderID,Description,Amount)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'Vehicle #1: " & strVehicle_Year1 & " " & strVehicle_Make1 & " " & strVehicle_Model1 & tiermessage & "','" & auto_price & "')"
	Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice.Open strSQL,conn


	if strVehicle_Make2<>"" Then
		strSQL = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'" & strVehicle_Year2 & "','" & strVehicle_Make2 & "','" & strVehicle_Model2 & "','" & strVehicle_Color2 & "','" & strVehicle_VIN2 & "','" & strVehicle_StockNum2 & "','" & strVehicle_Convertible2 & "','" & strVehicle_LiftKit2 & "','" & strVehicle_LiftKit_Quantity2 & "','" & strVehicle_Lowered2 & "','" & strVehicle_Lowered_Quantity2 & "','" & strVehicle_Oversized_Tires2 & "','" & strVehicle_Oversized_Tires_Quantity2 & "','" & strVehicle_AdditionalInfo2 & "'," & auto_price2 & ")"
		Set Rsinsertvehicle = Server.CreateObject("ADODB.Recordset")
		    Rsinsertvehicle.Open strSQL,conn

		strSQL = "insert into payments (OrderID,Description,Amount)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'Vehicle #2: " & strVehicle_Year2 & " " & strVehicle_Make2 & " " & strVehicle_Model2 & tiermessage & "','" & auto_price2 & "')"
		Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
		    Rsinsertprice.Open strSQL,conn

	end if

	if strVehicle_Make3<>"" Then
		strSQL = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'" & strVehicle_Year3 & "','" & strVehicle_Make3 & "','" & strVehicle_Model3 & "','" & strVehicle_Color3 & "','" & strVehicle_VIN3 & "','" & strVehicle_StockNum3 & "','" & strVehicle_Convertible3 & "','" & strVehicle_LiftKit3 & "','" & strVehicle_LiftKit_Quantity3 & "','" & strVehicle_Lowered3 & "','" & strVehicle_Lowered_Quantity3 & "','" & strVehicle_Oversized_Tires3 & "','" & strVehicle_Oversized_Tires_Quantity3 & "','" & strVehicle_AdditionalInfo3 & "'," & auto_price3 & ")"
		Set Rsinsertvehicle = Server.CreateObject("ADODB.Recordset")
		    Rsinsertvehicle.Open strSQL,conn

		strSQL = "insert into payments (OrderID,Description,Amount)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'Vehicle #3: " & strVehicle_Year3 & " " & strVehicle_Make3 & " " & strVehicle_Model3 & tiermessage & "','" & auto_price3 & "')"
		Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
		    Rsinsertprice.Open strSQL,conn

	end if

	if strVehicle_Make4<>"" Then
		strSQL = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'" & strVehicle_Year4 & "','" & strVehicle_Make4 & "','" & strVehicle_Model4 & "','" & strVehicle_Color4 & "','" & strVehicle_VIN4 & "','" & strVehicle_StockNum4& "','" & strVehicle_Convertible4 & "','" & strVehicle_LiftKit4 & "','" & strVehicle_LiftKit_Quantity4 & "','" & strVehicle_Lowered4 & "','" & strVehicle_Lowered_Quantity4 & "','" & strVehicle_Oversized_Tires4 & "','" & strVehicle_Oversized_Tires_Quantity4 & "','" & strVehicle_AdditionalInfo4 & "'," & auto_price4 & ")"
		Set Rsinsertvehicle = Server.CreateObject("ADODB.Recordset")
		    Rsinsertvehicle.Open strSQL,conn

		strSQL = "insert into payments (OrderID,Description,Amount)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'Vehicle #4: " & strVehicle_Year4 & " " & strVehicle_Make4 & " " & strVehicle_Model4 & tiermessage & "','" & auto_price4 & "')"
		Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
		    Rsinsertprice.Open strSQL,conn

	end if

	if strVehicle_Make5<>"" Then
		strSQL = "insert into orders_vehicles (orderid,Vehicle_Year,Vehicle_Make,Vehicle_Model,Vehicle_Color,Vehicle_VIN,Vehicle_StockNum,Vehicle_Convertible,Vehicle_LiftKit,Vehicle_LiftKit_Quantity,Vehicle_Lowered,Vehicle_Lowered_Quantity,Vehicle_Oversized_Tires,Vehicle_Oversized_Tires_Quantity,Vehicle_AdditionalInfo,Vehicle_QuotedPrice)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'" & strVehicle_Year5 & "','" & strVehicle_Make5 & "','" & strVehicle_Model5 & "','" & strVehicle_Color5 & "','" & strVehicle_VIN5 & "','" & strVehicle_StockNum5& "','" & strVehicle_Convertible5 & "','" & strVehicle_LiftKit5 & "','" & strVehicle_LiftKit_Quantity5 & "','" & strVehicle_Lowered5 & "','" & strVehicle_Lowered_Quantity5 & "','" & strVehicle_Oversized_Tires5 & "','" & strVehicle_Oversized_Tires_Quantity5 & "','" & strVehicle_AdditionalInfo5 & "'," & auto_price5 & ")"
		Set Rsinsertvehicle = Server.CreateObject("ADODB.Recordset")
		    Rsinsertvehicle.Open strSQL,conn

		strSQL = "insert into payments (OrderID,Description,Amount)"
		strSQL = strSQL & " values  (" & strmaxorderid & ",'Vehicle #5: " & strVehicle_Year5 & " " & strVehicle_Make5 & " " & strVehicle_Model5 & tiermessage & "','" & auto_price5 & "')"
		Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
		    Rsinsertprice.Open strSQL,conn

	end if



end if


if howmany = "onevehicle" then



	strSQL = "insert into payments (OrderID,Description,Amount)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'Initial Shipment Total" & tiermessage & "','" & strTotalPrice & "')"
	Set Rsinsertprice1 = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice1.Open strSQL,conn
else

	strSQL = "insert into payments (OrderID,Description,Amount)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'Multiple Vehicle Carrier Discount','-" & carrierdiscount & "')"
	Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice.Open strSQL,conn

	strSQL = "insert into payments (OrderID,Description,Amount)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'Multiple Vehicle Discounted Customer Deposit ($" & DepositPerVehicle & " x " & numvehicles & ")','" & strDeposit & "')"
	Set Rsinsertprice = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice.Open strSQL,conn

end if


if reviewdiscountreduction <> "0" then
	strSQL = "insert into payments (OrderID,Description,Amount)"
	strSQL = strSQL & " values  (" & strmaxorderid & ",'Customer Agreed to Submit Online Review. Initial quote reduced -$25',0)"
	Set Rsinsertprice1 = Server.CreateObject("ADODB.Recordset")
	    Rsinsertprice1.Open strSQL,conn
end if



strSQL = "select * from orders where orderid = " & strmaxorderid
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn


trackid = session("trackid")
If trackid <> "" Then
	CurrentDateTime = fncFmtDate(date(),"%Y-%m-%d") & " " & fncFmtDate(now(),"%H:%N:%S")
	strSQL = "update sale_conversion set dateupdated='" & CurrentDateTime & "',orderid = " & strmaxorderid & ", sale_status = '4. Billing Details' where trackid = '" & trackid & "'"
	'response.write strSQL & "<br>"

	Set RsConv = Server.CreateObject("ADODB.Recordset")
	    RsConv.Open strSQL,conn,3,3
End If

%>

<form action="https://www.autotransportdirect.com/quote/quote3.asp" method="post" name="mainform">
<input type="hidden" name="strOrderID" value="<%= rs2("orderid") %>">
<input type="hidden" name="strCustPhone1" value="<%= strCustPhone1 %>">
<input type="hidden" name="strCustEmail" value="<%= strCustEmail %>">
<input type="hidden" name="strSalesRep" value="<%= strSalesRep %>">

</form>
<script>
document.mainform.submit();
</script>


<% Else

strOrderID = getUserInput(request.form("strOrderID"),0)
strCustEmail = getUserInput(request.form("strCustEmail"),0)
'strOrderID = 5

If request.querystring("orderid") <> "" Then
	strOrderID = getUserInput(request.querystring("orderid"),0)
End If

strSQL = "select * from orders where orderid = " & strOrderID
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn

If request.querystring("orderid") <> "" Then
	strCustEmail = Rs2("CustEmail")

End If
strDeposit = Rs2("Deposit")

%>


<script>
function useshipfrom()
{
document.mainform.strBilling_Address1.value = '<%= Rs2("Pickup_Address1") %>';
document.mainform.strBilling_Address2.value = '<%= Rs2("Pickup_Address2") %>';
document.mainform.strBilling_City.value = '<%= Rs2("Pickup_City") %>';
document.mainform.strBilling_State.value = '<%= Rs2("Pickup_State") %>';
document.mainform.strBilling_Zip.value = '<%= Rs2("Pickup_Zip") %>';
document.mainform.strBilling_Phone.value = '<%= Rs2("Pickup_CellPhone") %>';
}

function useshipto()
{
document.mainform.strBilling_Address1.value = '<%= Rs2("Deliver_Address1") %>';
document.mainform.strBilling_Address2.value = '<%= Rs2("Deliver_Address2") %>';
document.mainform.strBilling_City.value = '<%= Rs2("Deliver_City") %>';
document.mainform.strBilling_State.value = '<%= Rs2("Deliver_State") %>';
document.mainform.strBilling_Zip.value = '<%= Rs2("Deliver_Zip") %>';
document.mainform.strBilling_Phone.value = '<%= Rs2("Deliver_CellPhone") %>';
}
</script>


<form action="quote4.asp" method="post" name="mainform" id="mainform">
<input type="hidden" name="strOrderID" value="<%= rs2("orderid") %>">
<input type="hidden" name="strCustEmail" value="<%= strCustEmail %>">
<input type="hidden" name="reviewdiscountreduction" value="<%= reviewdiscountreduction %>">
<input type="hidden" name="reviewdiscountsite" value="<%= reviewdiscountsite %>">


<table width="750" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:auto;">


<tr>
	<td width="100%" class="bodytext2">


<% if request("fromincompleteemail") = "1" then %>

	<table cellspacing="2" cellpadding="2" border="0" width="50%" align="center">
	<tr>
		<td class="bodytext2"><b>Shipping From:</b></td>
		<td class="bodytext2"><%= rs2("Pickup_City") %>, <%= rs2("Pickup_State") %>&nbsp;&nbsp;<%= rs2("Pickup_Zip") %></td>
	</tr>
	<tr>
		<td class="bodytext2"><b>Shipping To:</b></td>
		<td class="bodytext2"><%= rs2("Deliver_City") %>, <%= rs2("Deliver_State") %>&nbsp;&nbsp;<%= rs2("Deliver_Zip") %></td>
	</tr>
	<%
	if cint(Rs2("Num_Of_Vehicles")) = 1 then %>
		<tr>
			<td class="bodytext2"><b>Type of Vehicle:</b></td>
			<td class="bodytext2" nowrap><%= rs2("Vehicle_Make") %> - <%= rs2("Vehicle_Model") %></td>
		</tr>
	<% else


		strSQL = "select * from orders_vehicles where orderid = " & rs2("orderid")
		Set RsOrderVehicle = Server.CreateObject("ADODB.Recordset")
		    RsOrderVehicle.Open strSQL,conn

		if NOT RsOrderVehicle.eof then %>
		<tr>
			<td class="bodytext2" valign="top"><b>Type of Vehicle:</b></td>
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
		<td class="bodytext2" nowrap="nowrap"><b>Operating Condition:</b></td>
		<td class="bodytext2" nowrap="nowrap"><%= rs2("Quote_vehicle_operational") %> and Rolls, Brakes, Steers</td>
	</tr>
	<tr>
		<td class="bodytext2"><b>Type of Trailer:</b></td>
		<td class="bodytext2"><%= rs2("Quote_vehicle_trailer") %></td>
	</tr>
	</table>
	<br>
	<div align="center">
	<a href="/quote/quote3_orderdetails.asp?orderid=<%= rs2("orderid") %>&id=<%=request("tokenid")%>" rel="shadowbox;width=830;" style="text-decoration:none;"><div style="width:130px; text-align:center; height:30px; padding:7px 7px 0 7px; border: 1px solid #000; color:#fff; background-color: #009933; font-size:13px; font-weight: bold; text-decoration:none;">View Order Details</div></a>
	</div>
	<br>

<% end if %>



	<table border="0" cellspacing="0" cellpadding="3" align="center" width="100%" style="margin:auto;">


	<tr>
		<td class="title3" colspan="3">
		<br>
		Billing Details
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>


      	<br>
      	<div class="imagebox" style="width:262px;float:left;margin-bottom:15px; margin-right:40px; margin-left:60px;">
			<img src="//d36b03yirdy1u9.cloudfront.net/images-v3/img8.jpg" width="262" height="196" alt="Direct Express Auto Transport Employee" />
			<div>Pay a nominal deposit by credit card or checking account and you're setup!</div>
		</div>


		<div class="title3"><br>
		Pay The Deposit Using <img src="//d36b03yirdy1u9.cloudfront.net/images/Credit-Card-Logos.jpg" style="vertical-align:baseline;height: 29px; display: inline-block; margin-left: 7px; top: 3px; position: relative;" /><br>
		via Our Secure Merchant Gateway.<br>Your information is protected.
        <br><br>
        Also Works With Your Debit Card.
		<br><br>
		(fill out the form below)
		<br><br>
		<% if cint(Rs2("Num_Of_Vehicles")) = 1 then %>
		<!--
or...
		<br><br>
		<a href="quote3_check.asp?orderid=<%= rs2("orderid") %>">Click here to pay with your checking account</a>.<br><br>
-->
		<% end if %>
		</div>

		<div style="clear:both;"></div>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>

		</td>
	</tr>

	<tr>
		<td></td>
		<td class="bodytext2">
		<strong>Use as Billing Address:</strong><br>
		<a href="javascript:useshipfrom();">Pickup Address</a><br>
		<a href="javascript:useshipto();">Deliver Address</a><br><br>
		</td>

	</tr>

	<tr>
		<td class="formtext" align="right" width="200">First Name:&nbsp;<div class="smalltext">(As it appears on your card)</div></td>
		<td class="bodytext2" ><input type="text" name="strBilling_FirstName" id="strBilling_FirstName" size="40" value="<%= rs2("CustFirstName") %>"><span class="req">&nbsp;*</span></td>
		<td valign="top" rowspan="6">
			<div class="imagebox" style="float:right;">
				<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote3-2.jpg" width="210" height="145" alt="Direct Express Auto Transport Employee" />
				<div>Your billing address is where your credit card statements are mailed. The pickup or deliver addresses will autofill if you select either.</div>
			</div>
		</td>
	</tr>

	<tr>
		<td class="formtext" align="right">Last Name:&nbsp;<div class="smalltext">(As it appears on your card)</div></td>
		<td class="bodytext2" ><input type="text" name="strBilling_LastName" id="strBilling_LastName" size="40" value="<%= rs2("CustLastName") %>"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Billing Address:&nbsp;</td>
		<td class="bodytext2"><input type="text" name="strBilling_Address1" id="strBilling_Address1" size="40"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">&nbsp;</td>
		<td class="bodytext2"><input type="text" name="strBilling_Address2" id="strBilling_Address2" size="40"></td>
	</tr>
	<tr>
		<td class="formtext" align="right">City:&nbsp;</td>
		<td class="bodytext2"><input type="text" name="strBilling_City" id="strBilling_City" size="30"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">State:&nbsp;</td>
		<td class="bodytext2">
		<select name="strBilling_State" id="strBilling_State">
			<option value="0" SELECTED>-- SELECT STATE --</option>
			<!--#include file="../includes/states.asp"-->
		</select><span class="req">&nbsp;*</span>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Zip:&nbsp;</td>
		<td class="bodytext2"><input type="text" name="strBilling_Zip" id="strBilling_Zip" size="10"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Phone Number:&nbsp;</td>
		<td class="bodytext2"><input type="text" name="strBilling_Phone" id="strBilling_Phone" size="25" value="<%= RS2("CustPhone1") %>"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right">Credit Card:&nbsp;</td>
		<td class="bodytext2">
		<select name="strCreditCartType" id="strCreditCartType">
			<option value="Visa">Visa</option>
			<option value="Mastercard">Mastercard</option>
			<option value="American Express">American Express</option>
			<option value="Discover">Discover</option>
		</select>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Credit Card Number:&nbsp;</td>
		<td class="bodytext2"><input type="text" name="strCreditCartNum" id="strCreditCartNum" size="40"><span class="req">&nbsp;*</span></td>
	</tr>
	<tr>
		<td class="formtext" align="right" >Expiration:&nbsp;</td>
		<td class="bodytext2" colspan="2">
		<select name="strCreditCartMonth" id="strCreditCartMonth" style="width:175px;">
	        <option value="0" SELECTED>-- SELECT MONTH --</option><option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
	    </select>
		<select name="strCreditCartYear" id="strCreditCartYear" style="width:175px;"><option value="0" SELECTED>-- SELECT YEAR --</option>
		<%
		countyears = 15
		currentyear = fncFmtDate(Now(),"%Y")
		For i = 1 To countyears
		%>
		<option value="<%= right(currentyear,2) %>"><%= currentyear %></option>
		<% currentyear = currentyear + 1 %>
		<%	Next %>
		</select><span class="req">&nbsp;*</span>
		</td>
	</tr>
 	<tr>
		<td class="formtext" align="right" valign="top" style="padding-top:7px;">Security Code Number:&nbsp;</td>
		<td class="bodytext2">
		<input type="text" name="strCreditCartCVV" id="strCreditCartCVV" size="5" style="width:40px;"><span class="req">&nbsp;*</span>
		&nbsp;&nbsp;
		<span class="smalltext"><a href="#" onclick="window.open('explaincvv.html','popup','toolbar=no,status=no,location=no,menubar=no,height=410,width=400,scrollbars=no'); return false;">What is CVV?</a></span>

		<br><br><span class="req">*</span> = required
		</td>
	</tr>


	<tr>
		<td class="title3" colspan="3"><br>
		<div style="margin:5px 0 5px 0;width:100%;border-top:#999999 solid thin;"></div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Charging to Credit Card:&nbsp;</td>
		<td class="bodytext2" >$<%=strDeposit%></td>
		<td valign="top" rowspan="6">
			<div class="imagebox" style="float:right;">
				<img src="//d36b03yirdy1u9.cloudfront.net/images/staff/quote3-3.jpg" width="210" height="145" alt="Direct Express Auto Transport Employee" />
				<div>Our credit card merchant gateway is secure and there are no taxes, fuel surcharges or hidden fees.</div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="formtext" align="right">Balance Due:&nbsp;</td>
		<td class="bodytext2" >
		$<%= rs2("Balance") %>
		</td>
	</tr>
	<tr>
		<td></td>
		<td class="smalltext">Payable upon delivery by cash or<br/>money order made payable to delivery company.</td>
	</tr>




	<tr>
		<td align="center">
			<!-- (c) 2005, 2013. Authorize.Net is a registered trademark of CyberSource Corporation --> <div class="AuthorizeNetSeal"> <script type="text/javascript" language="javascript">var ANS_customer_id="7e60afc8-ee4e-47e6-bb36-a60288eaa5ac";</script> <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> <a href="http://www.authorize.net/" id="AuthorizeNetText" target="_blank">Transaction Processing</a> </div>

		</td>
		<td class="bodytext2" style="padding-top:20px;" valign="top">


		<input type="submit" name="Submit"  class="submitbutton2">
		<br><br>

		</td>

	</tr>

	</table>

	</td>
</tr>
</table>
</form>





<% End If %>

<%
set rs2 = nothing
call closedb()
%>

<%
session("shippingfromzip") = ""
session("shippingfromcity") = ""
session("shippingfromstate") = ""
session("shippingtozip") = ""
session("shippingtocity") = ""
session("shippingtostate") = ""
session("vehicletype") = ""
session("vehicle_operational") = ""
session("vehicle_trailer") = ""
session("howmany")=""
session("numvehicles")=""
session("shippingnextseven")=""
session("auto_make")=""
session("auto_model") = ""
session("auto_make2")=""
session("auto_model2") = ""
session("auto_make3") = ""
session("auto_model3") = ""
session("auto_make4") = ""
session("auto_model4") = ""
session("auto_make5") = ""
session("auto_model5") = ""
session("DateAvailable") = ""
session("CustName") = ""
%>

<!--#include file="../includes/footer.asp"-->
