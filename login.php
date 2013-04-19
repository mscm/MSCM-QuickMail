<?php


include("config.php");

echo "<head><link href='css/qmail.css' rel='stylesheet' type='text/css' /></head>";

//LDAP connectioin stuff
$ldaprdn = $_POST['login'];
$ldappass = $_POST['password']; 
$ldapconn = ldap_connect(DOMAIN)or die("Could not connect to LDAP server.");

//Doing LDAP stuff
if ($ldapconn) {

	// binding to ldap server
	$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

		// verify binding
		if ($ldapbind) {
			$_SESSION['username'] = $ldaprdn;
			return header('Location: compose.php');
	}
		 
		else {
			echo "Aw Snap!...Somethin's boofunk'd!! It's possible your username and/or password was incorrect. You will be redirected back to the login page in 10 seconds.";
			header('Refresh: 10; URL='.REDIRECT);
	}
}

?>