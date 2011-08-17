<?php session_start();
if(!strstr($_SESSION[lightboxsessid],"^".$_GET[sno]."|")){
	$path="images/lightboxadd.gif";
}else{
	$path="images/addedtolightbox.gif";
}
echo "
<a href=javascript:void(0); onclick=lightboxjax('index.php?pg=lightbox&ajax=y&id=".$_GET[sno]."','lightboxadd".$_GET[sno]."');><img src='$path' border='0' id=lightboxadd".$ROWS[sno]."></a>";
?>