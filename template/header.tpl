<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SACRED SPACES</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/right-click.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<!--lightbox--->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>-->
<script>
	!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
</script>
<?if($this->pg=="search"){?>
	<script type="text/javascript" src="./fancybox/search-jquery.fancybox.js"></script>
<?}else{?>
	<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.js"></script>
<?}?>	
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="./fancybox/fancy-style.js"></script>
<!--lightbox--->


<?if(!strlen($this->pg)){?>
	<script type="text/javascript" src="slide/jquery-1.js"></script>
	<script type="text/javascript" src="slide/coin-slider.js"></script>
	<link rel="stylesheet" href="slide/coin-slider-styles.css" type="text/css">
<?}?>


</head>
<body>
<div id="page">
<div class="header_title"><a href="<?=$GLOBALS[baseurl];?>"><img src="images/logo.jpg" border="0" align="Logo SACRED SPACES"></a></div>
<div id="menu">
<ul>
<li><a href="<?=$GLOBALS[baseurl];?>" <?if($this->pg==""){?> class="active"<?}?>>Home</a></li>
<li><a href="about.html" <?if($this->pg=="aboutus"){?> class="active"<?}?>>About</a></li>
<li><a href="albums.html" <?if($this->pg=="albums" or  $this->pg=="gallery"){?> class="active"<?}?>>Gallery</a></li>
<li><a href="cameras.html" <?if($this->pg=="cameras"){?> class="active"<?}?>>Cameras</a></li>
<li><a href="prints.html" <?if($this->pg=="prints"){?> class="active"<?}?>>Prints</a></li>
<li><a href="lightbox.html" <?if($this->pg=="lightbox"){?> class="active"<?}?>>Lightbox <?=$nolightbox?></a></li>
<li><a href="contactus.html" <?if($this->pg=="contact"){?> class="active"<?}?>>Contact</a></li>
<li class="<?if($this->pg=="search"){?> active<?}?>" id="searchtxt">
<a href="javascript:void(0);"  onclick="document.getElementById('searchtxt').style.display='none'; document.getElementById('searchfrm').style.display=''; document.getElementById('searchitem').focus();">Search <img src="images/search.gif" style="border:0px"/></a></li>

<li class="last" id="searchfrm" style="display:none;">
<form name="searchfrm" method="post" action="search.html" onsubmit="if(document.getElementById('searchitem').value==''){alert('Please enter search item');return false;}"><input type="text" class="search" name="searchitem" id="searchitem" value=""/>&nbsp;<input type="image" src="images/search.gif" style="border:0px"/></form></li>

</ul>
</div>
<!-- onblur="document.getElementById('searchtxt').style.display=''; document.getElementById('searchfrm').style.display='none';"-->









