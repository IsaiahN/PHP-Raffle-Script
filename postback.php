<?php
require_once('includes/config.php');
require_once('includes/includes.php');

//Blvd Media Group
 
$validate = $_GET['Validate'];
$validate = mysql_real_escape_string($validate);


if($validate == $bmgpass || $validate == $bmgpass)
{
    $campid = $_GET['CampId'];
    $subid = $_GET['SubId']; 
    $earn = $_GET['Earn']; 
    
    $campid = mysql_real_escape_string($campid);
    $subid = mysql_real_escape_string($subid);
    $comm = floatval($earn);
  
	$query = "INSERT INTO tbl_tickets(id,fname,lname,email,ip,status,raffle,reward,affiliate,date) VALUES ('','','','','".$subid."','0','','','Blvd Media Group',NOW())";
	$result = mysql_query($query); 
    if (!$result){ die('Error'); }

}

?>