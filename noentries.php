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
	<h1 class="headerimg">You Have No Entries!</h1><br>
	
				<p>It seems that you have no entries currently available.</p>
				<p>If you would like to earn a new entry, click the link below.</p>

	<p> When you have finished, <b><a href="/" style=" color:#2f2f2f; text-decoration:none;">Click Here.</a></b></p><br>
	
	
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
