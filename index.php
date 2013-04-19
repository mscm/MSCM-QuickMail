
<html>
<head>
	<link href="css/qmail.css" rel="stylesheet" type="text/css" />
</head>
<form action=login.php method=post name=Auth> 
Please log in using your user name and your password:<p>
	
<table cellspacing=5 cellpadding=5 class=ContentBodyTable> 
   <tr> 
      <td>Username: </td> 
      <td><input type=text name=login size=30 maxlength=40 class=textInput></td> 
   </tr> 
   <tr> 
      <td>Password: </td> 
      <td><input type=password name=password size=30 maxlength=15 class=textInput></td> 
   </tr> 
   <tr> 
      <td colspan=2><input type=submit value=Login class=SubmitInput style='width:100'></td> 
   </tr> 
</table> 
</form>
<p>You will need to re-enter your login credentials in order to access Quick Mail. Please use your CampusVue login.</P>

<p>Upon entering Quick Mail you agree that sending electronic messages to your students and advisees is not recorded into CampusVue. Each message you send will CC to your email account for your personal record, should you choose.</p>
</html>


<!-- Set the focus to the login text field onload. --> 
<script language="JavaScript" type="text/javascript"> 
   document.Auth.login.focus(); 
</script>