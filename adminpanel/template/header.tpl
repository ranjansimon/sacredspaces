<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>SACRED SPACES - ADMIN PANEL</title>
<script language="JavaScript" src="js/calendar.js"></script>
<script language="JavaScript" src="js/calendar2.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/validation.js"></script>
</head><body>
<div id="maindiv">
	<?if(strlen($_SESSION[adminname])){?>
		<div id="headerDiv">
			<img src="images/logo.gif" border="0" />
			<div style="float:right;padding:20px 20px 0px 0px;">Welcome : <strong>
			<?if(strlen($_SESSION[adminname])){echo $_SESSION[adminname];?> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <a href="?pg=lgt">Logout</a><?}else{echo "Guest";}?></strong>
			<br /> <br /> 
			<a style="float:right;" href="?pg=chngpass">Change Password</a>  
			</div>
		
		</div>
		<div class="navigation">
		<br />
			<ul>
				<li><a href="?">Home</a></li>
				<li><a href="?pg=photo">Photo Gallery</a></li>
				<li><a href="?pg=home">Home Page Gallery</a></li>
				<li><a href="?pg=about">About</a></li>
				<li><a href="?pg=cameras">Cameras</a></li>
				<li><a href="?pg=prints">Prints</a></li>
				<li><a href="?pg=contact">Contact</a></li>
				<li><a href="?pg=tags">Tags</a></li>
				<!-- <li><a href="?pg=chngpass">Change Password</a></li>  --> 
			</ul>
		</div>
	<?}?>
	<div id="middlepart">