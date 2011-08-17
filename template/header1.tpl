<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SACRED SPACES</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

<?if(!strlen($this->pg)){?>
	<link rel="stylesheet" href="slide/themes/default/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="slide/nivo-slider.css" type="text/css" media="screen" />
<?}?>


</head>
<body>
<div id="page">
<div class="header_title">Sacred Spaces</div>
<div id="menu">
<ul>
<li><a href="<?=$GLOBALS[baseurl];?>" <?if($this->pg==""){?> class="active"<?}?>>Home</a></li>
<li><a href="aboutus.html" <?if($this->pg=="aboutus"){?> class="active"<?}?>>About</a></li>
<li><a href="albums.html" <?if($this->pg=="albums"){?> class="active"<?}?>>Gallery</a></li>
<li><a href="cameras.html" <?if($this->pg=="cameras"){?> class="active"<?}?>>Cameras</a></li>
<li><a href="prints.html" <?if($this->pg=="prints"){?> class="active"<?}?>>Prints</a></li>
<li><a href="lightbox.html" <?if($this->pg=="lightbox"){?> class="active"<?}?>>Lighbox<sup><?=$nolightbox?></sup></a></li>
<li><div><a href="images/contact.gif" rel="lightbox">Contact</a></li>
<li class="last<?if($this->pg=="search"){?> active<?}?>"><form name="searchfrm" method="post" action="search.html" onsubmit="return dynamic_form_validation(this);"><input type="text" class="search" name="searchitem" id="req__Please enter your search item" value="" /></form></li>
</ul>
</div>


