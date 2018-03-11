<?php 
session_start();
include_once "includes/config.php";
include("includes/includes.php");
$bottomlinks = file_get_contents('includes/bottomlinks.txt');
$homehtml = file_get_contents('includes/homehtml.txt');
?> 

<?php include("includes/header.php");?>


<!-- custom style for Admin Panel -->
<style type="text/css">
body{background-image:url('images/stripe14.png');}
p{text-align:left; }
#content p{padding-bottom: 2px;}
#subtitle { color: #2f2f2f;}
#navigation a { color: #2f2f2f;}
#navigation a:hover,a:active { background-color:#444444; color:#ffffff;}
a#select { background-color:#676767; color: #ffffff;}
a { color: #2f2f2f;}
#content { border: 3px solid #444444;}
#footer {color:#2f2f2f;}
#content a, a:hover, a:visited { color: #3179ab;}
label{float:left; width:175px;}
#subtitle {color: #000000; font-size: 13px;}
p.navigation {text-align:center;}
#admnlbl {width: 70px;}
</style>
<!-- end custom style -->

<body>
<div id="wrapper">
        <p class="sitetitle"> <a href="/"><img src="images/logo.png" border="0" alt=""></a> <!-- <? echo $sitetitle;?> uncomment this if enabling text logo instead of image logo--></p> 
    	<div id="navigation">
		
			<?php include("includes/navigation.php");?>
	</div>
	<div id="content">
	<h1 class="headerimg">Administration Panel</h1><br>
 	
		<!--  main content -->

<!-- Login -->
<?
if (!$_SESSION["valid_user"]) 
{
    
  if ($_GET["op"] == "login")
  {
  if (!$_POST["username"] || !$_POST["password"])
        {
        die("You need to provide a username and password.");
        }
  
  // Create query
  $q = "SELECT * FROM `tbl_admin` "
        ."WHERE `username`='".$_POST["username"]."' "
        ."AND `password`=md5('".$_POST["password"]."') "
        ."LIMIT 1";
  // Run query
  $r = mysql_query($q);

  if ( $obj = @mysql_fetch_object($r) )
        {
        // Login good, create session variables
        $_SESSION["valid_id"] = $obj->id;
        $_SESSION["valid_user"] = $_POST["username"];
        $_SESSION["valid_time"] = time();


        }
  else
        {
        // Login not successful
        die("<div align='center'>Sorry, could not log you in. Wrong login information.</div>");
        }
  }
        else
  {
//If all went right the Web form appears and users can log in

  echo "<form action=\"?op=login\" method=\"POST\"> \n";
  echo "<p> \n";
  echo "<label id=\"admnlbl\">Username:</label> <input name=\"username\" size=\"15\"><br> \n";
  echo "</p> \n";
  echo "<p> \n";
  echo "<label id=\"admnlbl\">Password:</label> <input type=\"password\" name=\"password\" size=\"15\"><br> \n";
  echo "</p> \n";
  echo "<p> \n";
  echo "<input type=\"submit\" value=\"Login\"> \n";
  echo "</p> \n";
  echo "</form>";
  }
  }
?>




<!-- form info -->

<?php if ($_SESSION["valid_user"]) {  ?>

<?
if (isset($_POST["SubmitForm"])) {


	if (isset($_POST["adminpass"])) {
		$username = $_POST["username"];
		$adminpass=md5($_POST["adminpass"]);
		$qry = "UPDATE `tbl_admin` SET `password` = '$adminpass' WHERE `username` = '$username'";
                mysql_query($qry) or die(mysql_error());
                
                if ( ($_POST["adminpass"] !== " ") && ($string !== " ") ){
                 echo '<div align="center">Your Settings Have Been Saved.</div>';
                 echo "<script>window.location = 'admin'</script>";
                }
                elseif ($_POST["adminpass"] !== " "){
                echo '<div align="center">Your Admin password,<b style="color: red;"> '.$_POST["adminpass"].' </b> was saved.</div><br>';
		}
	 }



	  if (isset($_POST["homehtml"])) {
		 $homehtml = $_POST["homehtml"];
		 $homehtml = stripslashes($homehtml);
		 $myFile = "includes/homehtml.txt";
		 $fh = fopen($myFile, 'w') or die("can't open file");
		 fwrite($fh, $homehtml);
		 fclose($fh);
	  }
	  if (isset($_POST["bottomlinks"])) {
		 $bottomlinks = $_POST["bottomlinks"];
		 $bottomlinks = stripslashes($bottomlinks);
		 $myFile = "includes/bottomlinks.txt";
		 $fh = fopen($myFile, 'w') or die("can't open file");
		 fwrite($fh, $bottomlinks);
		 fclose($fh);	 
	  }

$string = '<?
// --Page Settings
$metadescription = "'. $_POST["metadescription"]. '";
$metakeywords = "'. $_POST["metakeywords"]. '";
$subtitle = "'. $_POST["subtitle"]. '";
$sitetitle = "'. $_POST["sitetitle"]. '";
$domainurl = "'.$_SERVER['HTTP_HOST']. '"; // example: sitename.com

// --Misc Settings
$minentries = "'. $_POST["minentries"]. '"; // minimum leads needed for raffle
$contactemail = "'. $_POST["contactemail"]. '"; // example: email@email.com

// --Blvd Media
$bmgid = "'. $_POST['bmgid']. '"; 
$bmgpass = "'. $_POST['bmgpass']. '";

// --Cbox Settings
$cboxenable = "'. $_POST["cboxenable"]. '"; // type "1" to enable, "0" to disable
$cboxid2 = "'. $_POST["cboxid2"]. '"; // cbox.ws cbox boxid (found in source code)
$cboxtag2 = "'. $_POST["cboxtag2"]. '"; // cbox.ws cbox boxtag  (found in source code)

?>';

$fp = fopen("includes/includes.php", "w");

fwrite($fp, $string);

fclose($fp);

}


?>
<?
//Check for operation requests
if(isset($_GET['del'])) {

$delid=mysql_real_escape_string($_GET['del']);

$result=mysql_query("SELECT * FROM tbl_tickets WHERE id='".$delid."'") or die(mysql_error());
if(mysql_num_rows($result)!=0) { 
   mysql_query("DELETE from tbl_tickets WHERE id='".$delid."'") or die(mysql_error());
   echo" <span style='color:#C00000'>[ Entrant ID ".$delid." deleted ]</span>";
   }
   else
   {
   echo" <span style='color:#C00000'>[ Entrant ID ".$delid." doesn't exist ]</span>";
   }
}


if(isset($_GET['banip'])) {

$banip=mysql_real_escape_string($_GET['banip']);

$result2 = mysql_query("SELECT * FROM tbl_banned WHERE ip='".$banip."' ") or die(mysql_error());
$rowcount = mysql_num_rows($result2);
if($rowcount == 0) { 
   mysql_query("DELETE from tbl_tickets WHERE ip='".$banip."' ") or die(mysql_error());
   mysql_query("INSERT INTO tbl_banned(id,ip) VALUES ('','".$banip."')") or die(mysql_error());
   echo" <span style='color:#C00000'>[ IP: ".$banip." banned ]<br>And their tickets have been deleted.</span>";
   }
   else
   {
   echo" <span style='color:#C00000'>[ IP ".$banip." already banned ]</span>";
   }
}

if(isset($_GET['unbanip'])) {

$unbanip=mysql_real_escape_string($_GET['unbanip']);

$result3 = mysql_query("SELECT * FROM tbl_banned WHERE ip='".$unbanip."' ") or die(mysql_error());
$rowcount2 = mysql_num_rows($result3);
if($rowcount2 >= 1) { 
   mysql_query("DELETE from tbl_banned WHERE ip='".$unbanip."' ") or die(mysql_error());
   echo" <span style='color:#C00000'>[ IP ".$unbanip." Has Been Un-banned ]</span>";
   }
   else
   {
   echo" <span style='color:#C00000'>[ IP ".$unbanip." already Un-banned ]</span>";
   }
}
?>
<form action="" method="post" name="saveform" id="saveform">

<strong>Account Settings</strong><br>
<p>
	<label>Contact Email</label>
    <input name="contactemail" type="text" id="contactemail" value="<? echo $contactemail;?>"> 

</p>
<p>
	<label>Admin Password</label>
    <input name="adminpass" type="text" id="adminpass" value=""> 

</p>

<strong>Website Settings</strong><br>
  <p>
	<label>Site Name / Title</label>
    <input name="sitetitle" type="text" id="sitetitle" value="<? echo $sitetitle;?>"> 

</p>
	
  <p>
	<label>Site Subtitle</label>
    <input name="subtitle" type="text" id="subtitle" value="<? echo $subtitle;?>"> 

</p>
	
  <p>
    	<label>Meta Description</label>
    <input name="metadescription" type="text" id="metadescription" value="<? echo $metadescription;?>"> 

</p>

  <p>
    	<label>Meta Keywords</label>
    <input name="metakeywords" type="text" id="metakeywords" value="<? echo $metakeywords;?>"> 

</p>

	
<strong>Raffle/Lead Settings</strong><br>
  <p>
	<label>Minimum Entrants</label>
    <input name="minentries" type="text" id="minentries" value="<? echo $minentries;?>"> 

</p>
Postback URL: 	http://<? echo $domainurl;?>/postback.php<br>
Redirect URL:   http://<? echo $domainurl;?>/claim <br><br>

<strong>Blvd Media (<a href="https://www.blvd-media.com/Administration/Publishers.aspx?action=signup"target="_blank">Signup</a>)</strong><br>

  <p>
    	<label>BMG Reward Tool Publisher ID</label> 
    <input name="bmgid" type="text" id="bmgid" value="<? echo $bmgid;?>"> 

</p>
  <p>
    	<label>BMG Reward tool Validate Password</label> 
    <input name="bmgpass" type="text" id="bmgpass" value="<? echo $bmgpass;?>"> 

</p>
 
<strong>Cbox Settings (<a href="http://www.cbox.ws" target="_blank">Signup</a>)</strong><br>

<p>
	<label>Enable Cbox</label>
<input name="cboxenable" type="text" id="cboxenable" value="<? echo $cboxenable;?>"> 
0 to disable / 1 to enable
</p>

<p>
	<label>Cbox Boxid</label>
<input name="cboxid2" type="text" id="cboxid2" value="<? echo $cboxid2;?>"> 
Ex: "1231234" (found in Cbox script code)
</p>

<p>
	<label>Cbox Boxtag</label>
<input name="cboxtag2" type="text" id="cboxtag2" value="<? echo $cboxtag2;?>"> 
Ex: "abc1de" (found in Cbox script code)
</p>

<strong>Customize Pages</strong><br>
<p>
Home HTML:<br>

<textarea name="homehtml" rows="6" cols="50"><? echo $homehtml;?></textarea>
</p>

<p>
Bottom Links:<br>
<textarea name="bottomlinks" rows="3" cols="50"><? echo $bottomlinks;?></textarea>
</p>

<p>
<input type="submit" name="SubmitForm" value="Save Settings!">
</p>
<strong>Current Entries</strong><br>

<table border="1" width="100%" style="font-size:12px">
<tr>
<br/>
<td width="25%">Operations</td><td width="5%">ID</td><td width="20%">Full Name</td><td width="10%">E-mail</td><td width="10%">IP</td><td width="10%">Request</td></tr>

<?php

//Show current entries
$result=mysql_query("SELECT * FROM tbl_tickets WHERE DATE(date) = DATE(NOW()) ORDER BY date ASC") or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) { 

echo "<tr>";
echo "<td width='25%'><a href='admin.php?del=".$row['id']."'>Delete</a> | <a href='admin.php?banip=".$row['ip']."'>Ban IP</a></td>";
echo "<td width='5%'>".$row['id']."</td>";
echo "<td width='20%'>".$row['fname']." ".$row['lname']."</td>";
echo "<td width='10%'>".$row['email']."</td>";
echo "<td width='10%'>".$row['ip']."</td>";
echo "<td width='10%'>".$row['reward']."</td>";
echo "</tr>";
}
?>

</table>
<p>
<input type="submit" name="SubmitForm" value="Save Settings!">
</p>
<br>


<strong>Banned IP Addresses</strong><br>
<table border="1" width="40%" style="font-size:12px">
<tr>

<td width="10%">Operations</td><td width="15%">ID</td><td width="15%">IP Address</td></tr>

<?php

//Show current entries
$result=mysql_query("SELECT * FROM tbl_banned ") or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) { 

echo "<tr>";
echo "<td width='10%'><a href='admin.php?unbanip=".$row['ip']."'>Remove Ban</a></td>";
echo "<td width='15%'>".$row['id']."</td>";
echo "<td width='15%'>".$row['ip']."</td>";
echo "</tr>";
}
?>
</table>
<p>
<input type="submit" name="SubmitForm" value="Save Settings!">
</p>

</form>			
<?php } ?>



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