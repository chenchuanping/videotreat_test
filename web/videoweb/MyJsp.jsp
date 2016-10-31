<%@ page language="java" import="java.util.*" pageEncoding="ISO-8859-1"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <base href="<%=basePath%>">
    
    <title>My JSP 'MyJsp.jsp' starting page</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<!--
	<link rel="stylesheet" type="text/css" href="styles.css">
	-->

  </head>
  

  <body>
    <script src="https://static.opentok.com/v2/js/opentok.js" charset="utf-8"></script>
    <script charset="utf-8">
      var apiKey = '45542302';
      var sessionId = '2_MX40NTU0MjMwMn5-MTQ1OTA4MTU4NzMwMH4ydk9oUktpeW4xQ2VJTlE4R2hualhyL0F-UH4';
      var token = 'T1==cGFydG5lcl9pZD00NTU0MjMwMiZzaWc9NWE3ZmI1MDQyMWIzOTc2NTg0YTBmNjg5ZTkzOTY0YTI5YmRlNzM3OTpyb2xlPXB1Ymxpc2hlciZzZXNzaW9uX2lkPTJfTVg0ME5UVTBNak13TW41LU1UUTFPVEE0TVRjMk56UTJOWDVyTTFSM2FGTm9URzV4YTJScFJFUmFjbVUzTUdWdmJtRi1VSDQmY3JlYXRlX3RpbWU9MTQ1OTA4MTc3MyZub25jZT0wLjQzODk0NDgzMTIzODIwNzYmZXhwaXJlX3RpbWU9MTQ1OTA4NTM0OSZjb25uZWN0aW9uX2RhdGE9';
      var session = OT.initSession(apiKey, sessionId)
        .on('streamCreated', function(event) {
          session.subscribe(event.stream);
        })
        .connect(token, function(error) {
          var publisher = OT.initPublisher();
          session.publish(publisher);
        });
    </script>

  </body>
</html>
