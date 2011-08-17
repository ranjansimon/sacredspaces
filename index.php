<?php session_start();
$tblpfx="gns_";
if($_SERVER['SERVER_NAME']=="localhost")
	$dirpath=$_SERVER[DOCUMENT_ROOT]."/sunali/";
else
	$dirpath=$_SERVER[DOCUMENT_ROOT]."/";

#$baseurl="http://nexzenlocal.com/projects/";
$baseurl="http://" . $_SERVER['HTTP_HOST'] . "/";	
function __autoload($clasname) {
	if(file_exists($GLOBALS[dirpath]."class/".$clasname.".php"))
	    include $GLOBALS[dirpath]."class/".$clasname . '.php';
	else
		echo $GLOBALS[dirpath]."class/".$clasname.".php   Invalid class and file";	
}
$config = new config();
$mainclass = new mainclass();
$mainclass->management();
?>
