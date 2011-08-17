<?php session_start();
$tblpfx="gns_";
if($_SERVER['SERVER_NAME']=="localhost"){
	$dirpath=$_SERVER[DOCUMENT_ROOT]."/sunali/adminpanel/";
	$baseurlpath="/sunali/";
}else{
	$dirpath=$_SERVER[DOCUMENT_ROOT]."/adminpanel/";
	$baseurlpath="/";
}
function __autoload($clasname) {
	if($clasname!="FCKeditor"){
		if(file_exists($GLOBALS[dirpath]."class/".$clasname.".php"))
		    include $GLOBALS[dirpath]."class/".$clasname . '.php';
		else
			echo $GLOBALS[dirpath]."class/".$clasname.".php   Invalid class and file";
	}
}
$config = new config();
$mainclass = new mainclass();
$mainclass->management();
?>
