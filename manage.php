<?php 
session_start();
include_once "includes/config.php";
include("includes/includes.php");
$bottomlinks = file_get_contents('includes/bottomlinks.txt');
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
		<h1 class="headerimg" >Manage Entries</h1>
		<?
		if (isset($_POST["submit"])) {
		$email= $_POST["email"];
			if (isset($_POST["email"])) {
			
				$qery  = "SELECT * FROM `tbl_tickets` WHERE `email`= '$email'";
				$reslt = mysql_query($qery);
				$num = mysql_num_rows($reslt);
				
				if ( $num >= 1){
				

				$query  = "SELECT * FROM `tbl_winners` WHERE `email`= '$email'";
				$result = mysql_query($query);
				$num_rows = mysql_num_rows($result);

				
				     	if ( $num_rows > 0 ) { 
						echo " <h3>Welcome ".$email."!</h3><br>
						Latest Codes Won:<br>";
						echo "<ol>";
							while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
							   echo "<li>".$row['date'].": ".$row['prize_code']." </li> ";
							    }
						echo "</ol><br><br>";
					    
					}
					if ( $num_rows == 0 ) { 
						echo " <h3>Welcome ".$email."!</h3><br>    
						Lastest Codes Won:<br>
						
						It appears that you have not yet won a prize!<br> 
						Don't give up and keep on trying! The more entries you get per day, the higher your chances!<br><br>";    
					}
				
			
				$query2  = "SELECT * FROM `tbl_tickets` WHERE `email`= '$email' AND status = '0'";
				$result2 = mysql_query($query2);
				$num_rows2 = mysql_num_rows($result2);
				
				if ( $num_rows2 == 0 ) {
					
				echo "Current Entries : <br>
				
				Hi, you have not entered for this current drawing.<br>
				Please complete an offer to claim an entry for today's giveaway.<br>";
				} 
				
				$query3  = "SELECT * FROM `tbl_tickets` WHERE `email`= '$email'";
				$result3 = mysql_query($query3);
				$num_rows3 = mysql_num_rows($result3);
				
				
				if ( $num_rows2 > 0 ) { 
					echo "Past Entries: <br><ol>";
					while($row = mysql_fetch_array($result3, MYSQL_ASSOC)) {
					echo " Raffle #".$row['id']." claimed on ".$row['date']."<br>";
					}
					echo "</ol>";
				}
				if ( $num_rows2 == 0 ) {
					echo "Past Entries: <br>
					You do not have any past entries. Feel free to get some entries in!<br> ";
				}
    
				         
		               }
		               else {
		               
		               }


				} 
			}
	 	
	 	?>
		

		
		<!-- Offer widgets here -->
		
		<div id="bottomlinks">
			<?php echo $bottomlinks;?>
		</div>
	</div>   
</div>
	
</body>
<!-- footer -->
<?php include("includes/footer.php");?> 
</html>