<?php 
session_start();
include_once "includes/config.php";
include("includes/includes.php");
$homehtml = file_get_contents('includes/homehtml.txt');
$bottomlinks = file_get_contents('includes/bottomlinks.txt');
$ip_address = $_SERVER['REMOTE_ADDR'];
$claimcheck = mysql_query("SELECT COUNT(*) as number FROM tbl_banned WHERE ip = '".$ip_address."'");
$ban = mysql_fetch_assoc( $claimcheck );
$total = $ban['number'];
if ($total > 0 ) {
header('Location: banned.php');
}
?> 

<?php include("includes/header.php");?>

<body>
<div id="wrapper">
        <p class="sitetitle"> <a href="/" ><img src="images/logo.png" border="0" alt=""></a> <!-- <? echo $sitetitle;?> uncomment this if enabling text logo instead of image logo--></p> 
    	<div id="navigation">
		<!-- Pages HTML and content starts here -->  
		<?php include("includes/navigation.php");?>
	</div>
	<div id="content">

 	
		 <?php if ( $cboxenable !== "0"){ 
		 include("includes/cbox.php");
		 } 
		 ?>
		<!--  customizable home page variable here (customizable from admin panel)-->
		<? echo $homehtml;?>
		<!-- Offer widgets here -->
		<div id="widget">

			<?php 
			if ( $bmgid !== "0"){
			include_once "includes.php";?>
			<IFRAME SRC =  "http://www.blvd-media.com/RewardsMax.html?pubid=<?php echo $bmgid ?>&subid=<?php echo $_SERVER['REMOTE_ADDR']; ?>"	  WIDTH="640px" HEIGHT="450px" FRAMEBORDER="0" -if "0" no border,	  otherwise "1" with border MARGINWIDTH ="0px" MARGINHEIGHT="0px"	  SCROLLING="no" -"no" no scrolling bar, "yes" show always, "auto" 	  showed when need>  Your browser does not support IFRAME 
			</IFRAME>
			<?php } else { ?>
			echo '<p style="font-size: 18px;color: red;text-align: center;">All Widgets Are Currently Disabled.</p>';
			<?php } ?>
		</div>
		<div id="bottomlinks">
			<? echo $bottomlinks;?>
		</div>
	</div>   
</div>
	
</body>
<!-- footer -->
<?php include("includes/footer.php");?> 
</html>