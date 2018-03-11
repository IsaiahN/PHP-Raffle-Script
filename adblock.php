<?php 
session_start();
include_once "includes/config.php";
include("includes/includes.php");
$bottomlinks = file_get_contents('includes/bottomlinks.txt');
?> 



<?php include("includes/header.php");?>

<body>
    <div id="wrapper">
        <p class="sitetitle"> <a href="/" target="_blank"><img src="images/logo.png" border="0"/></a> <!-- <? echo $sitetitle;?> uncomment this if enabling text logo instead of image logo--></p> 
    	<div id="navigation">
		<!-- Pages HTML and content starts here -->  
		<?php include("includes/navigation.php");?>
	</div>
	<div id="content">
	<h1 class="headerimg"> You Must Disable Adblock To Proceed!</h1><br>
	<div align="center"><img src="images/adblock.png" alt="0"></div>
	<p>
	It has been detected that AdBlock Plus is currently enabled. For the website to function properly,
	you must cooperate with our advertisers so that we in turn can reward you. Please disable your
	AdBlock to maintain unhindered access on our website.</p>

	<p>To disable AdBlock for our website, click on the ABP icon on your webbrowser, and check:
	Disable Everywhere. When you have finished, <b><a href="/" style=" color:#2f2f2f; text-decoration:none;">Click Here.</a></b></p><br>
	
	<div align="center"><img src="images/adblock2.png" alt="0"></div><br>
	<? if ( $cboxenable !== "0"){
	include("includes/cbox.php");
	}
	?>

		<!-- Offer widgets here -->
		<div id="bottomlinks">
			<? echo $bottomlinks;?>
		</div>   
	</div>
	
	
		
</body>
		
<?php include("includes/footer.php");?> 
</html>