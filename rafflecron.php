<?php
include_once "public_html/includes/config.php";
include("public_html/includes/includes.php");
$num = (int)$minentries;
$minentries = $num;


$sql = "SELECT count(*) as num FROM `tbl_tickets` WHERE status=1";
$result = mysql_query($sql);
$result = mysql_fetch_assoc( $result );
$total = $result['num'];


if ($total >= $minentries ) {

$random = rand(1, $total);


$SQL = "SELECT * FROM tbl_tickets WHERE status=1";
$result = mysql_query($SQL);
while($row = mysql_fetch_array( $result ))
{
	$i++;
	if($i == $random)
	{
		
		$query = "INSERT INTO tbl_winners(id,fname,lname,email,ip,status,raffle,reward,affiliate,date) VALUES ('','$row[1]','$row[2]','$row[3]','$row[4]','3','twenty','$row[7]','$row[8]',NOW())";
		$insertresult = mysql_query($query);
		
		// Sets winner from redeemed to winner status
		$updaterow = mysql_query("UPDATE tbl_tickets SET status=3 WHERE id='$row[0]' AND fname='$row[1]'");
		$winresult = mysql_query($updaterow);
		
		// Sets losers from redeemed to played status
		$updaterow2 = mysql_query("UPDATE tbl_tickets SET status=2 WHERE status=1");
		$loseresult = mysql_query($updaterow2);
		
		// E-mails The Winner's Information to the Administrator
		   $to = ''.$contactemail.'' ;
		   $subject = 'New Raffle Winner';
		   $headers  = 'MIME-Version: 1.0' . "\r\n";
		   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		   $message = "<table>
		      	                   <tr><td>Winner:</td><td>There has been a new raffle winner!</td></tr>
		   	                   <tr><td>Winner:</td><td>".$row[1]." ".$row[2]." </td></tr>
		                           <tr><td>E-Mail:</td><td>".$row[3]."</td></tr>
					   <tr><td>IP Address:</td><td>".$row[4]."</td></tr>
	                                   <tr><td>Prize Request:</td><td>".$row[7]."</td>
					   <tr><td>Date Of Entry:</td><td>".$row[9]."</td>
		               </tr></table>" ;
		   mail($to, $subject, $message, $headers); //E-mails The Winning Letter
		break;
	}
	
}

   exit(); // closes out the file

}
else {
    die("There Where not Enough Entries today!"); // Minimum Amount Of Entries Not Reached Today
}

?>