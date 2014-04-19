<?
$mysql_host = "mysql6.000webhost.com";
$mysql_database = "a2590979_gifter";
$mysql_user = "a2590979_gifter";
$mysql_password = "G1f73r";

$con = mysql_connect($mysql_host,$mysql_user,$mysql_password); 
mysql_select_db($mysql_database, $con);

session_start();

?>