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
	<h1 class="headerimg"> You Have Been Flagged</h1><br>
	
	<p>

				Some Fraudulent activity has been found to have taken place under your IP address.<br>
				All entries made from this IP address have been removed from the current raffle and you <br>
				will no longer be eligable for our future raffles.<br><br>
				If you feel that this suspension has been placed in error, <a href="mailto:rafflesupport@kicksgpt.com?Subject=Help, I've been banned" >Contact the Admin.</a></p>

	
	
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
	       