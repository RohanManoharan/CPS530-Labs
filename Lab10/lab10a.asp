<%
Dim bgColor, lastVisit, isFirstVisit

bgColor = Request.QueryString("color")
If bgColor = "" Then
    bgColor = "white" ' 
End If

If Request.Cookies("LastVisit") <> "" Then
    lastVisit = Request.Cookies("LastVisit")
    isFirstVisit = False
Else
    lastVisit = "This is your first visit!"
    isFirstVisit = True
End If

Response.Cookies("LastVisit") = Now()
Response.Cookies("LastVisit").Expires = DateAdd("m", 1, Now()) 
%>

<!DOCTYPE html>
<html>
<head>
    <title>lab10a</title>
</head>

<body style="background-color:<%= response.write(bgColor) %>;text-align: center;">
    <h1>Dynamic Background</h1>
    <p>The background color has been set to: <b><%= response.write(bgColor) %></b></p>

    <h2>Your Last Visit:</h2>
    <p>
        <% If isFirstVisit Then %>
            <%= lastVisit %>
        <% Else %>
            You last visited this page on: <%= lastVisit %>
        <% End If %>
    </p>

    <h3>Change Background Color</h3>
    <p>Use the URL query string to change the background color. For example:</p>
    <a href="http://www.rohanmanoharancps530lab10.somee.com?color=blue">http://www.rohanmanoharancps530lab10.somee.com?color=blue</a> <br> <br>
    <a href="http://www.rohanmanoharancps530lab10.somee.com?color=red">http://www.rohanmanoharancps530lab10.somee.com?color=red</a> <br> <br>
    <a href="http://www.rohanmanoharancps530lab10.somee.com?color=white">http://www.rohanmanoharancps530lab10.somee.com?color=white</a> <br> <br>


</body>
</html>
