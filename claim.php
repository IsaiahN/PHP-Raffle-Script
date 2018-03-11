<?php 
session_start();
include_once "includes/config.php";
include("includes/includes.php");
$bottomlinks = file_get_contents('includes/bottomlinks.txt');
$ip = $_SERVER['REMOTE_ADDR'];
$sql  = "SELECT * FROM `tbl_tickets` WHERE `ip`= ".$ip."  AND status = '0'";
$result = mysql_query($sql);
$num_entry = mysql_num_rows($result);
$claimcheck = mysql_query("SELECT COUNT(*) as number FROM tbl_tickets WHERE ip = ".$ip." AND status = '0' ");
$result2 = mysql_fetch_assoc( $claimcheck );
$total = $result2['number'];
if ( $total == 0 ) { 
header('Location: noentries.php');
}

?> 

<?php include("includes/header.php");?>

<body>
<div id="wrapper">
        <p class="sitetitle"> <a href="/"><img src="images/logo.png" border="0" alt=""></a> <!-- <? echo $sitetitle;?> uncomment this if enabling text logo instead of image logo--></p> 
    	<div id="navigation">
		<!-- Pages HTML and content starts here --> 
		<!-- remember that you`ll need to encode users info into a md5 format ex: $adminpass=md5($adminpass); --> 
		<?php include("includes/navigation.php");?>
	</div>
	<div id="content">
 	
		 <?php if ( $cboxenable !== "0"){ 
		 include("includes/cbox.php");
		 } 
		 ?>
		<!--  main content-->
		<h1 class="headerimg" >Claim An Entry</h1>
		
		<div align="center">  
	<?php if ($total > 0) {
	
	echo"	
        <p>You have ".$total." unclaimed tickets available</h4>
        <p>You have ".$num_entry." entries for the next raffle</p>
	<p>Thank you for recently completing an offer!<br>
	Please complete the form below if you'd like to use your tickets on the current raffle.</p><br>
	<p><b>NOTE</b>: The winner of the raffle will have their code sent to the email address entered below. 
	Please use accurate information when entering our raffle or your entry may be disqualified.</p>";
	 
	
	echo'	
	<form id="form" method="POST" action="update.php">
                        <br>                   
			<label for="input-1">First Name:</label>
			<input id="input-1" name="fname" value="First Name" type="text"  onFocus="this.value=\'\'">
			<label for="input-2">Last Name:</label>
			<input id="input-2" name="lname" value="Last Name" type="text"  onFocus="this.value=\'\'">
			<label for="input-3">Email:</label>
			<input id="input-3" name="email" value="E-mail Address" type="text"  onFocus="this.value=\'\'">
			<label for="input-4">Reward Choice:</label>
			<select id="rewardselect" name="reward" onchange="if (this.selectedIndex==4){this.form[\'box\'].style.visibility=\'visible\'}else {this.form[\'box\'].style.visibility=\'hidden\'};">
			<option value="0">Choose One</option>
			<option value="1">Amazon</option>
			<option value="2">Ebay</option>
			<option value="3">Visa</option>
			<option value="4">Custom</option></span></select> <br><br>
			</select>
			<input type="hidden" name="ip_address" value="'.$ip.'">
			<textarea id="input-5" name="box" cols="43" rows="3" style="visibility:hidden;" onFocus="this.value=\'\'">Enter your custom reward here!</textarea>
			<br>';
	?>
		</div>
		
		<!-- bottom links -->
		<div id="bottomlinks">
			<?php echo $bottomlinks;?>
		</div>
	</div>   
</div>
	
</body>
<!-- footer -->
<?php include("includes/footer.php");?> 
</html>