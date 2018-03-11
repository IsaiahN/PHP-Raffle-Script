<?
$hostname = "localhost"; //your hostname [usually 'localhost']
$db_username = "freesygn_db"; //database username
$db_password = ";W%l;Kk@ON}}"; //database password
$db_name = "freesygn_db"; //database name

$conn = mysql_connect("".$hostname."","".$db_username."","".$db_password."");
mysql_select_db("".$db_name."") or die(mysql_error());
?>