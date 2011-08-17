<?php
class photogallery extends config{
	function photogallery(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->typ=$_GET[typ];
		$this->tblpfx=$tblpfx;
		$this->path="../photos/gallery/";
		$albumname="";
		if(strlen($_GET[albumtitle]))	
			$albumname=config::filename($_GET[albumtitle])."/";	
		$this->path.=$albumname;	
		$this->filename_name=str_replace(' ','-',$_FILES[filename][name]);
		$this->filename=$_FILES[filename][tmp_name];
		$this->albumid=$_GET[albumid];
		$this->albumtitle=$_GET[albumtitle];
	}
	function management(){
		if(strlen($this->albumid) && strlen($this->albumtitle))
			$this->photodisplay();
		else
			$this->displayalbum();	
			
	}
	function displayalbum(){
		if(strlen($_POST[setposition])){
			while(list($key, $val)=each($_POST)){
				if(strstr($key, "chk_")){
					$key=str_replace("chk_", "", $key);
					config::query("UPDATE ".$this->tblpfx."album SET position='".addslashes($val)."' WHERE sno='$key'");
				}
			}
			echo "<script>window.location.href='?pg=".$this->pg."';</script>";
		}
		if(strlen($this->delid)){
			//$ROWS=config::fetch_all_array("SELECT COUNT(*) FROM ".$this->tblpfx."photogallery WHERE albumid='".$this->delid."'",1);
			//if($ROWS[0]==0){
				config::query("DELETE FROM ".$this->tblpfx."album WHERE sno='".$this->delid."'");
				config::query("DELETE FROM ".$this->tblpfx."photogallery WHERE albumid='".$this->delid."'");
				unlink($this->path.$this->delid."-".$_GET[img]);
				echo "<script>window.location.href='?pg=".$this->pg."&success=3';</script>";
			//}else{
			//	echo "<script>alert('You can\'t delete this record.');window.location.href='?pg=".$this->pg."';</script>";
			//}
			
		}
		if(strlen($_POST[submit])){
			if(strlen($_FILES[filename][name])){
				$filename=$_FILES[filename][name];
				$additional.=",imagename='".addslashes($filename)."'";
			}
			$CHKQRY=config::fetch_all_array("SELECT COUNT(*) FROM ".$this->tblpfx."album WHERE imagename='".addslashes($filename)."'",1);
			if($CHKQRY[0] == 0){
				if($_POST[tagdate_Month]<10)
					$_POST[tagdate_Month]="0".($_POST[tagdate_Month]+1);
				if($_POST[tagdate_Day]<10)
					$_POST[tagdate_Day]="0".$_POST[tagdate_Day];		
				$additional.=",tagdate='$_POST[tagdate_Year]-$_POST[tagdate_Month]-$_POST[tagdate_Day]'";
				
				$newfolder=$this->path;
				$newfolder.=config::filename($_POST[shall_albumname])."/";
				if(intval($this->upd)>0){
					config::insertdb("album", "update"," sno='".$this->upd."'",$additional);
					$success=2;
					if($_POST[oldalbumname]!=$_POST[shall_albumname]){
						$oldfolder=$this->path;
						$oldfolder.=config::filename($_POST[oldalbumname])."/";
						rename($oldfolder,$newfolder);
					}
				}else{
					$this->upd=config::insertdb("album", "insert","",$additional);
					$success=1;
					if(!is_dir($newfolder)){
						mkdir($newfolder);
						chmod($newfolder,0777);
						mkdir($newfolder."large/");
						chmod($newfolder."large/",0777);
					}
				}
				if(strlen($_FILES[filename][name])){
					$filename=$this->upd."-".$filename;
					$image = new imageresize();
					$image->load($_FILES["filename"]["tmp_name"]);
					$image->resize(158,104);
					$image->save($this->path.$filename);
				}
				echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
			}else{
				$errormessage="<div class='error'>Duplicate Image not allowed</div>";
				while(list($key, $val)=each($_POST)){
					if(strstr($key, "shall_")){
						$key=str_replace("shall_", "", $key);
						$UPDATEROWS[$key]=$val;
					}
				}
			}
		}
		if($this->upd > 0){
			$UPDATEROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."album WHERE sno='".$this->upd."'",1);
			//if(strlen($UPDATEROWS[imagename]))
			//	$imagename="<img src='".$this->path.$UPDATEROWS[sno]."-".$UPDATEROWS[imagename]."' height='50'>";
			$UPDATEROWS[tagdate]=config::datechange($UPDATEROWS[tagdate],"-","-","1");		
			if($UPDATEROWS[tagdate]=="00-00-0000")
				$UPDATEROWS[tagdate]="";
		}
		$QUERY=config::fetch_all_array("SELECT *,(SELECT COUNT(*) FROM ".$this->tblpfx."photogallery WHERE albumid=a.sno)as counter FROM ".$this->tblpfx."album a ORDER BY position asc, sno desc");
		
		if(strlen($this->upd))
			$TAGQUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."tags a ORDER BY title");
		
		if(!strlen($UPDATEROWS[tagdate]))
			$UPDATEROWS[tagdate]=date("d-m-Y");	
		$messagearray=array("","Album Created<br>By default the last updated will appear first. To change the order please use Set Position","Album Updated","Album Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		include("template/photogallery.tpl");
	}
	
	
	function photodisplay(){
		if(strlen($_POST[setposition])){
			while(list($key, $val)=each($_POST)){
				if(strstr($key, "chk_")){
					$key=str_replace("chk_", "", $key);
					config::query("UPDATE ".$this->tblpfx."photogallery SET position='".addslashes($val)."' WHERE sno='$key'");
				}
			}
			echo "<script>window.location.href='?pg=".$this->pg."&albumid=".$this->albumid."&albumtitle=".$this->albumtitle."&success=3';</script>";
		}
		if(strlen($this->delid)){
			config::query("DELETE FROM ".$this->tblpfx."photogallery WHERE sno='".$this->delid."'");
			unlink($this->path.$this->delid."-".$_GET[img]);
			echo "<script>window.location.href='?pg=".$this->pg."&albumid=".$this->albumid."&albumtitle=".$this->albumtitle."&success=3';</script>";
		}
		if(strlen($_POST[submit])){
			if(strlen($_FILES[filename][name])){
				$filename=$_FILES[filename][name];
				$additional.=",imagename='".addslashes($filename)."'";
			}
			$CHKQRY=config::fetch_all_array("SELECT COUNT(*) FROM ".$this->tblpfx."photogallery WHERE imagename='".addslashes($filename)."'",1);
			if($CHKQRY[0] == 0){
				if($_POST[tagdate_Month]<10)
					$_POST[tagdate_Month]="0".($_POST[tagdate_Month]+1);
				if($_POST[tagdate_Day]<10)
					$_POST[tagdate_Day]="0".$_POST[tagdate_Day];
				$additional.=",tagdate='$_POST[tagdate_Year]-$_POST[tagdate_Month]-$_POST[tagdate_Day]',albumid='".addslashes($this->albumid)."'";
				
				if(intval($this->upd)>0){
					config::insertdb("photogallery", "update"," sno='".$this->upd."'",$additional);
					$success=2;
				}else{
					$this->upd=config::insertdb("photogallery", "insert","",$additional);
					$success=1;
				}
				if(strlen($_FILES[filename][name])){
					$filename=$this->upd."-".$filename;
					
					//copy($_FILES[filename][tmp_name],$this->path."large/".$filename);
					
					if(!is_dir($this->path)){
						mkdir($this->path);
						chmod($this->path,0777);
						mkdir($this->path."large/");
						chmod($this->path."large/",0777);
					}
					list($width,$height)=getimagesize($_FILES["filename"]["tmp_name"]);
					
					
					$newheight=145;
					$newwidth=($width/$height)*$newheight;
					
					if($newwidth > 218)
						$newwidth=218;
					$image = new imageresize();
					$image->load($_FILES["filename"]["tmp_name"]);
					$image->resize($newwidth,145);
					$image->save($this->path.$filename);
					
					
					///large image
					if($height > 470){
						$newheight=470;
						$newwidth=($width/$height)*$newheight;
					}elseif($width > 700){
						$newwidth=700;
						$newheight=($height/$width)*$newwidth;
					}else{
						$newheight=$height;
						$newwidth=$width;
					}
					
					$image->load($_FILES["filename"]["tmp_name"]);
					$image->resize($newwidth,$newheight);
					$image->save($this->path."large/".$filename);
					
				}
				echo "<script>window.location.href='?pg=".$this->pg."&albumid=".$this->albumid."&albumtitle=".$this->albumtitle."&success=$success'</script>";
			}else{
				$errormessage="<div class='error'>Duplicate Image not allowed</div>";
				while(list($key, $val)=each($_POST)){
					if(strstr($key, "shall_")){
						$key=str_replace("shall_", "", $key);
						$UPDATEROWS[$key]=$val;
					}
				}
			}
		}
		
		//if($UPDATEROWS[tagdate]=='' && $UPDATEROWS[city]=='' && $UPDATEROWS[religion]=='' && $UPDATEROWS[film]=='' && $UPDATEROWS[camera]=='' && $UPDATEROWS[lens]=='' && $UPDATEROWS[typeimg]=='')
		
		if($this->upd > 0){
			$UPDATEROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."photogallery WHERE sno='".$this->upd."'",1);
			$UPDATEROWS[tagdate]=config::datechange($UPDATEROWS[tagdate],"-","-","1");	
			if($UPDATEROWS[tagdate]=="00-00-0000")
				$UPDATEROWS[tagdate]="";
				if(!strlen($UPDATEROWS[tagdate]))
					$UPDATEROWS[tagdate]=date("d-m-Y");
		}elseif(strlen($this->upd)){
			$ALBUMROWS=config::fetch_all_array("SELECT tagdate,city,religion,typeimg,lens,film,camera FROM ".$this->tblpfx."album WHERE sno='".$this->albumid."'",1);
			$UPDATEROWS[tagdate]=config::datechange($ALBUMROWS[tagdate],"-","-","1");
			$UPDATEROWS[country]=$ALBUMROWS[country];
			$UPDATEROWS[city]=$ALBUMROWS[city];
			$UPDATEROWS[religion]=$ALBUMROWS[religion];
			$UPDATEROWS[film]=$ALBUMROWS[film];
			$UPDATEROWS[camera]=$ALBUMROWS[camera];
			$UPDATEROWS[lens]=$ALBUMROWS[lens];
			$UPDATEROWS[typeimg]=$ALBUMROWS[typeimg];
			if($UPDATEROWS[tagdate]=="00-00-0000")
				$UPDATEROWS[tagdate]="";
		}
		$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."photogallery a where albumid='".$this->albumid."' ORDER BY position asc, sno desc");
	
		if(strlen($this->upd))
			$TAGQUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."tags a ORDER BY title");	
		$messagearray=array("","Images uploaded<br>By default the last updated will appear first. To change the order please use Set Position","Images Updated","Images Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		
		if(!strlen($UPDATEROWS[tagdate]))
			$UPDATEROWS[tagdate]=date("d-m-Y");
		include("template/photogallery.tpl");
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