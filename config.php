<?php

//Global Configuraton
define('DOMAIN',""); //domain where users are located ex: domain.local
define('DB_SERVER',""); //CampusVue database server
define('DB_CATALOG',""); //Name of CV Database
define('DB_USER',""); //only needs read access
define('DB_PASS',""); //password of above user
define('REDIRECT',""); //URL to redirect to when user logs out or login fails
define('DAYS_BEFORE',"5"); //How many days before a term quickmail is available
define('DAYS_AFTER',"10"); //How many days after a term quickmail is available
define('ENABLED',"true"); //enables or disables mail function for testing and troubleshooting
define('SUPPORT_EMAIL',""); //email address a user who supports quickmail


//DB Connection
$server = DB_SERVER;
$info = array( "Database"=>DB_CATALOG, "UID"=>DB_USER, "PWD"=>DB_PASS);
$conn = sqlsrv_connect( $server, $info);

//Session Handler
session_start();

if (!(isset($_SESSION['username']))){
	header('Location: '.REDIRECT);
}

?>
