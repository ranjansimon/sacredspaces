<?php
class aboutus extends config{
	function aboutus(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->path="../photos/aboutus/showcase/";
	}
	function management(){
		if($this->pg=="showcase")
			$this->showcase();
		else
			$this->displayaboutus();
			
	}
	function displayaboutus(){
		if(strlen($_POST[submit])){
			config::insertdb("aboutus", "update"," sno='1'",$additional);
			$success=2;
			echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
		}
		if($this->upd > 0){
			$UPDATEROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."aboutus WHERE sno='".$this->upd."'",1);
			if(strlen($UPDATEROWS[filename]))
				$filename="<img src='".$this->path.$UPDATEROWS[sno]."-".$UPDATEROWS[filename]."' height='50'>";
		}
		
		$messagearray=array("","Content Uploaded<br>By default the last updated will appear first. To change the order please use Set Position","Content Updated","Content Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."aboutus",1);
		include("template/aboutus.tpl");
	}
	function showcase(){
		if(strlen($_POST[setposition])){
			while(list($key, $val)=each($_POST)){
				if(strstr($key, "chk_")){
					$key=str_replace("chk_", "", $key);
					config::query("UPDATE ".$this->tblpfx."showcase SET position='".addslashes($val)."' WHERE sno='$key'");
				}
			}
			echo "<script>window.location.href='?pg=".$this->pg."';</script>";
		}
		if(strlen($this->delid)){
			config::query("DELETE FROM ".$this->tblpfx."showcase WHERE sno='".$this->delid."'");
			unlink($this->path.$this->delid."-".$_GET[img]);
			echo "<script>window.location.href='?pg=".$this->pg."&success=3';</script>";
		}
		if(strlen($_POST[submit])){
			if(strlen($_FILES[filename][name])){
				$filename=$_FILES[filename][name];
				$additional.=",filename='".addslashes($filename)."'";
			}elseif($_POST[shall_typ]=="L"){
				if(!stristr($_POST[linkname],'http'))
					$_POST[linkname]="http://".$_POST[linkname];
				$additional.=",filename='".addslashes($_POST[linkname])."'";
			}
			if(intval($this->upd)>0){
				config::insertdb("showcase", "update"," sno='".$this->upd."'",$additional);
				$success=2;
			}else{
				$this->upd=config::insertdb("showcase", "insert","",$additional);
				$success=1;
			}
			if(strlen($_FILES[filename][name])){
				$filename=$this->upd."-".$filename;
				move_uploaded_file($_FILES["filename"]["tmp_name"],$this->path.$filename);
			}
			echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
		}
		$linkdisplay=" style='display:none;'";
		$filedisplay="";
		if($this->upd > 0){
			$UPDATEROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."showcase WHERE sno='".$this->upd."'",1);
			if(strlen($UPDATEROWS[filename]) && $UPDATEROWS[typ]=="F"){
				$filename="<a herf='".$this->path.$UPDATEROWS[sno]."-".$UPDATEROWS[filename]."' target='_blank'>{$UPDATEROWS[filename]}</a>";
				//$linkdisplay="";
			}else{
				$linkdisplay="";
				$filedisplay=" style='display:none;'";
			}
		}else
			$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."showcase ORDER BY position asc, sno desc");
		
		$messagearray=array("","ShowCase Added<br>By default the last updated will appear first. To change the order please use Set Position","ShowCase Updated","ShowCase Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		include("template/showcase.tpl");
	}
}?>