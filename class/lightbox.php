<?php
class lightbox extends config{
	function lightbox(){
		global $tblpfx;
		$this->lightbox=$_SESSION[lightboxsessid];
		$this->id=$_GET[id];
		$this->tblpfx=$tblpfx;
		$this->pg=$_GET[pg];
		$this->del=$_GET[del];
		$this->path="../photos/gallery/";
	}
	function management(){
		if(strlen($this->del))
			self::removeitem();
		if(strlen($_POST[sendrequest]))
			self::maling();
		elseif(strlen($_GET[ajax]))
			self::additem();
		else	
			self::displaylightbox();	
			
	}
	function displaylightbox(){
		if(intval($this->id)>0)
			self::additem();
		$ids=str_replace("|","','",str_replace("^","",$this->lightbox));
		
		$QUERY=config::fetch_all_array("SELECT *,(SELECT albumname FROM ".$this->tblpfx."album WHERE sno=p.albumid)as albumname FROM ".$this->tblpfx."photogallery p WHERE sno in ('$ids') order by position");
		
		include("template/lightbox.tpl");
	}
	function additem(){
		if(!strstr($this->lightbox,"^".$this->id."|")){
			$this->lightbox .="^".$this->id."|";
			$_SESSION[lightboxsessid]=$this->lightbox;
		}
		if(strlen($_GET[ajax]))
			echo "<img src='images/addedtolightbox.png' title='Added to lightbox' border='0'>";
	}
	function removeitem(){
		if(strstr($this->lightbox,"^".$this->del."|")){
			$_SESSION[lightboxsessid]=str_replace("^".$this->del."|","",$this->lightbox);
			echo "<script>window.location.href='lightbox.html';</script>";
		}else
			echo "<script>window.location.href='lightbox.html';</script>";
		if(strlen($_GET[ajax]))
			echo "<img src='images/addedtolightbox.png' title='Added to lightbox' border='0'>";
	}
	
	function maling(){
		if(strstr($_POST[email],"@") || strstr($_POST[email],".")){
			$ids=str_replace("|","','",str_replace("^","",$this->lightbox));
			
			$QUERY=config::fetch_all_array("SELECT *,(SELECT albumname FROM ".$this->tblpfx."album WHERE sno=p.albumid)as albumname FROM ".$this->tblpfx."photogallery p WHERE sno in ('$ids') order by position");
			
			$mailcontent.='
			<table width="500" border="0" cellspacing="0" cellpadding="5">
			<tr><td>Name</td><td>'.$_POST[name].'</td></tr>
			<tr><td>Email</td><td>'.$_POST[email].'</td></tr>
			<tr><td>Message</td><td>'.$_POST[message].'<td></tr>
			</table>
			
			<table width="500" border="1" cellspacing="0" cellpadding="5">
			<tr><td colspan="2">LightBox Item</td></tr>';
			
			$gallerypath=$GLOBALS[baseurl]."photos/gallery/";
			foreach($QUERY as $ROWS){
				$albumname=config::filename($ROWS[albumname]);
				$mailcontent.='
				<tr><td width="185"><img src="'.$gallerypath.$albumname.'/'.$ROWS[sno]."-".$ROWS[imagename].'" border="0" alt="'.$ROWS[photoname].'"></td><td width="295" valign="top">'.$ROWS[albumname].'<br/>'.$ROWS[shortdescription].'</td></tr>';
			}
			$mailcontent.='
			</table>';
			
			config::mailfunction("mehar@lopezdesign.com",$_POST[email],"New Light Box Enquiry",$mailcontent,"sunali@eastvillage.co.in");
			unset($_SESSION[lightboxsessid]);
			echo "<script>window.location.href='success.html';</script>";
		}else
			echo "<script>alert('Please fill Complete form with proper foramt');window.location.href='lightbox.html';</script>";
		
	}
	function tagdisplay($ROWS){
		if(strlen($ROWS[country])){
			$phototags="<a href='country-$ROWS[country].html'>$ROWS[country]</a>";
		}
		if(strlen($ROWS[city])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='city-$ROWS[city].html'>$ROWS[city]</a>";
		}
		if(strlen($ROWS[tagdate])){
			if(strlen($phototags))
				$phototags.=", ";
			$ROWS[tagdate]=config::datechange($ROWS[tagdate],"-","-","1");
			$phototags.="<a href='date-$ROWS[tagdate].html'>$ROWS[tagdate]</a>";
		}
		if(strlen($ROWS[religion])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='religion-$ROWS[religion].html'>$ROWS[religion]</a>";
		}
		if(strlen($ROWS[camera])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='camera-$ROWS[camera].html'>$ROWS[camera]</a>";
		}
		if(strlen($ROWS[lens])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='lens-$ROWS[lens].html'>$ROWS[lens]</a>";
		}
		if(strlen($ROWS[film])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='film-$ROWS[film].html'>$ROWS[film]</a>";
		}
		if(strlen($ROWS[typeimg])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='typeimage-$ROWS[typeimg].html'>$ROWS[typeimg]</a>";
		}
		return $phototags;
		
	}
}?>