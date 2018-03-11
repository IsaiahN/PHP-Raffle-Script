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
		<h1 class="headerimg" >Current Entries</h1>
		
		<div align="center">  
		
		<?
				$query  = "SELECT * FROM `tbl_tickets` WHERE status=1 AND DATE(date) = DATE(NOW()) LIMIT 20";
				$result = mysql_query($query);
				$num_rows = mysql_num_rows($result);
				$numcheck = mysql_query("SELECT COUNT(*) as number FROM tbl_tickets  WHERE status=1 AND DATE(date) = DATE(NOW()) LIMIT 20");
				$cnt = mysql_fetch_assoc( $numcheck );
				$total = $cnt['number'];
				
				
				if ( $total > 0) {	
					$counter = 0;
					echo '<ul style="float:left;">';
			    		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			    		$counter++;
			    		$lnameinit = substr($row['lname'], 0, 1);
			    		$lnameinit = strtoupper($lnameinit);
					echo "<li>".$row['date'].": <b>".$row['fname']." ".$lnameinit.".</b> has entered.</li>";
					
					if( is_int($counter / 10) && $total >= $counter )
					{
					        print '</ul><ul>';
					}

					}
			                echo "</ul>";
		                }
		                else {
		                echo " <b>There have been no entries yet.</b><br><br>";
		                }
		                
		    	  ?>  
		    
		</div>
		<div style="clear:both;"></div>	
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