<% pagetitle = "AutoTransportDirect.com - Order Confirmation" %>
<% metadescription = "Competitive quotes for Auto Transport Shipping Door-to-Door. The ultimate resource for vehicle shipping, auto transport, and car moving... Simple Shipping" %>
<% metakeywords = "car transport quote, truck shipping quote, auto transport quote, car shipping quote, sedan transport quote, sports car transport quote" %>
<!--#include file="../includes/header.asp"-->
<%
dim conn
call openDB()

orderid = getUserInput(request("orderid"),0)

strSQL = "update orders set vcheck_status = 'vCheck Started'"
strSQL = strSQL & "  where orderid = " & orderid
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn

strSQL = "select * from orders where orderid = " & orderid
Set Rs2 = Server.CreateObject("ADODB.Recordset")
    Rs2.Open strSQL,conn

custname = rs2("CustFirstName") & " " & rs2("CustLastName")

set rs2 = nothing
call closedb()
%>


<FORM action="https://www.securevcheck.com/?id=directexpress" method="post" name="mainform">
<input type="hidden" name="orderid" value="<%= orderid %>">
<input type="hidden" name="memo" value="Order ID #<%= orderid %>">
<input type="hidden" name="amount" value="<%=DEATDeposit%>">
<input type="hidden" name="redirecturl" value="https://www.autotransportdirect.com/quote/quote4_check.asp">
<input type="hidden" name="redirectfields" value="orderid">
<input type="hidden" name="redirectname" value="Click Here to Complete Your Order and Go Back to AutoTransportDirect.com">
<input type="hidden" name="redirectmethod" value="post">
<input type="hidden" name="email" value="<%= strCustEmail %>">
<input type="hidden" name="payer_name" value="<%= custname %>">

</form>
<script>
document.mainform.submit();
</script>





<!--#include file="../includes/footer.asp"-->
