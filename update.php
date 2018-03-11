<?php
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// MySQL Injection protection

$fname = check_input($_POST['fname']);
$lname = check_input($_POST['lname']);
$email = check_input($_POST['email']);
$reward = check_input($_POST['reward']);
$ip_address = $_POST['ip_address'];
$box = check_input($_POST['box']);


if(isset($_POST['submit'])) {

$email = htmlspecialchars($_POST['email']);
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
{
    die("E-mail address not valid");
}
$fname = htmlspecialchars($_POST['fname']);
if (preg_match("/[^a-zA-Z]/",$fname))
{
    die("Please enter letters a-z and A-Z only!");
}

$lname = htmlspecialchars($_POST['lname']);
if (preg_match("/[^a-zA-Z]/",$lname))
{
    die("Please enter letters a-z and A-Z only!");
}

if ($reward ==0) {
die("You Must Select A Reward Option!");
}
elseif ($reward ==1) {
$reward = "Amazon";
}
elseif ($reward ==2) {
$reward = "Ebay";
}
elseif ($reward ==3) {
$reward = "Visa";
}
elseif ($reward ==4) {
$reward = $box;
}
else {
die("Either there has been an error or you haven't selected a value.");
}
require_once('includes/config.php');

$claimcheck2 = mysql_query("SELECT COUNT(*) as number FROM tbl_tickets WHERE ip = ".$ip_address." AND status = 1 AND DATE(date) = DATE(NOW())" );

if ( $number <= 10 ) {
	// Test to see if these three post variables have data and only then update.
	if (!empty($fname) && !empty($lname) && !empty($email)) {
	
		$sql = "UPDATE tbl_tickets SET fname = '".$fname."', lname = '".$lname."', email = '".$email."', reward = '".$reward."', status = '1' WHERE ip = '".$ip_address."' AND status = '0' LIMIT 1";
		$result = mysql_query($sql);

		if (!$result){ die('<br>Error: the update command did not work. Perhaps because you have not completed an offer!'); }
		
		   header('Location: thanks.php');
		   exit();
	}
	else {
	die("You have left a value empty.");
	}

}
else {
die("You Have Entered More Than 10 Entries into Today`s Raffle.");
}
}

?>
