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

		<?php include("includes/navigation.php");?>
	</div>
	<div id="content">
 	
		 <?php if ( $cboxenable !== "0"){ 
		 include("includes/cbox.php");
		 } 
		 ?>
		<!--  main content-->
		<h1 class="headerimg" >Winners Showcase</h1>
		
		<div align="center">  
		<img src="images/image.png" alt="0"><br><br> 
		
		<?
		$query  = "SELECT * FROM `tbl_winners` ORDER BY `date` DESC LIMIT 10";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		if ( $num_rows > 0) {
		echo "Last ".$num_rows." winners of raffle<br><ol>";
		
    		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    		$lnameinit = substr($row['lname'], 0, 1);
    		$lnameinit = strtoupper($lnameinit);
		echo "<li>".$row['date'].": ".$row['fname']." ".$lnameinit.". won the raffle.</li><br>";
		}
                echo "</ol>";
                
                }
                else {
                echo " <b>There have been no raffles yet.</b><br><br>";
                }
                
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