<?
include_once "includes.php";
if ( $adscendgateid !== "0"){
echo '<a href="#" onClick="javascript:initGateway(); return false;"><img src="images/imageadm.png" border="0" alt=""></a>';
} 
if ( $adworkgateid !== "0"){
echo '<a href=\'#\' onClick="javascript:gLoad(); return false;"><img src=\'images/imageawm.png\' border="0" alt=""></a>';
} 
if ( $rfngateurl !== "0"){
echo '<a href="#" onclick="javascript:ActivateUnlocker(); return false;">
<img src="images/imagerfn.png" border="0" alt=""></a>';
} 
if ( $cpagateid !== "0"){
echo '<a href="#" onclick="startGateway(\''.$cpagateid.'\');"><img src="images/imagecpa.png" border="0" alt=""></a>';
}
if ( $blmaffid !== "0"){
echo '<a href="#" onclick="javascript:Startblm();Startblms();"><img src="images/imageblam.png" border="0" alt=""></a>';
}

?>