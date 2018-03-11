<?
$innercbox = '<iframe frameborder="0" width="200" height="305" src="http://www4.cbox.ws/box/?boxid='.$cboxid2.'&boxtag='.$cboxtag2.'&sec=main" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="cboxmain" style="border:#ababab 1px solid;border-bottom:0px" id="cboxmain"></iframe><iframe frameborder="0" width="200" height="75" src="http://www4.cbox.ws/box/?boxid='.$cboxid2.'&boxtag='.$cboxtag2.'&sec=form" marginheight="2" marginwidth="2" scrolling="no" allowtransparency="yes" name="cboxform" style="border:#ababab 1px solid;border-top:0px" id="cboxform"></iframe>';
?>			

<script type="text/javascript">

var cbvis = false;
var cbload = false;

function togglecbox () {
	var cbdiv = document.getElementById("cboxdiv");
	var cbbut = document.getElementById("cboxbutton");
        var innercb = '<? echo $innercbox ?>';

	if (!cbvis) {
		if (!cbload) {
			cbdiv.innerHTML = innercb; 
			cbload = true;
		}
		cbdiv.style.display = "block";
		cbbut.innerHTML = "Close Cbox";
	}
	else {
		cbdiv.style.display = "none";
		cbbut.innerHTML = "Open Cbox";
	}
	cbvis = !cbvis;
	

}
</script>

<div id="cboxbutton" style="position: fixed; bottom: 8px; right: 16px; width: 200px; padding: 3px; text-align: center; cursor: pointer; background-color: #EDF3F7; border:#C3D7E5 1px solid;border-radius: 3px; font-family: Tahoma, sans-serif; font-size: 14px;" onclick="togglecbox()"><b><center>Open Cbox</center></b></div>


<div id="cboxdiv" style="display: none; position: fixed; bottom: 48px; right: 16px; width: 200px; background: #EDF3F7; padding: 3px; line-height: 0;border:#C3D7E5 1px solid;border-radius: 3px;"></div>