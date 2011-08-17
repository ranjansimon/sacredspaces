<?php
class tagsmanagement extends config{
	function tagsmanagement(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->typ=$_GET[typ];
	}
	function management(){
		$this->displaytags();	
	}
	function displaytags(){
		$tagary=array("C"=>"City","R"=>"Religion","P"=>"Camera","L"=>"Lens","F"=>"Film","I"=>"Type of Image");
		$fieldarray=array("C"=>"city","R"=>"religion","P"=>"camera","L"=>"lens","F"=>"film","I"=>"typeimg");
		if(!strlen($this->typ))
			$this->typ="C";
		$fieldname=$fieldarray[$this->typ];
		if(strlen($this->delid)){
			config::query("DELETE FROM ".$this->tblpfx."tags WHERE sno='".$this->delid."' AND typ='".$this->typ."'");
			config::query("update ".$this->tblpfx."album SET $fieldname='' WHERE $fieldname='".stripslashes($_POST[oldtag])."'");
			config::query("update ".$this->tblpfx."photogallery SET $fieldname='' WHERE $fieldname='".stripslashes($_POST[oldtag])."'");
			config::query("update ".$this->tblpfx."homegallery SET $fieldname='' WHERE $fieldname='".stripslashes($_POST[oldtag])."'");
			echo "<script>window.location.href='?pg=".$this->pg."&typ=".$this->typ."&success=3';</script>";
		}
		if(strlen($_POST[submit])){
			$additional=",typ='".$this->typ."'";
			
			$CHKDUB=config::fetch_all_array("SELECT count(*) from ".$this->tblpfx."tags WHERE sno!='".$this->upd."' AND title='".addslashes($_POST["shall_title"])."' and typ='".$this->typ."'",1);
			if($CHKDUB[0]==0){
				if(intval($this->upd)>0){
					config::insertdb("tags", "update"," sno='".$this->upd."'",$additional);
					$success=2;
				}else{
					$this->upd=config::insertdb("tags", "insert","",$additional);
					$success=1;
				}
				if($_POST[oldtag]!=$_POST[shall_title] && strlen($_POST[shall_title])){
					config::query("update ".$this->tblpfx."album SET $fieldname='".stripslashes($_POST[shall_title])."' WHERE $fieldname='".stripslashes($_POST[oldtag])."' and $fieldname!=''");
					config::query("update ".$this->tblpfx."photogallery SET $fieldname='".stripslashes($_POST[shall_title])."' WHERE $fieldname='".stripslashes($_POST[oldtag])."' and $fieldname!=''");
					config::query("update ".$this->tblpfx."homegallery SET $fieldname='".stripslashes($_POST[shall_title])."' WHERE $fieldname='".stripslashes($_POST[oldtag])."' and $fieldname!=''");
				}
				if(strlen($_GET[red])){
					if(stristr($_GET[red],'photo-')){
						$expld=explode("-",$_GET[red]);
						$redval="?pg=$expld[0]&upd={$_GET[altid]}&albumid=$expld[1]&albumtitle=$expld[2]";
					}else{
						$redval="?pg={$_GET[red]}&upd={$_GET[altid]}";
					}
					echo "<script>window.location.href='$redval'</script>";	
				}else	
					echo "<script>window.location.href='?pg=".$this->pg."&typ=".$this->typ."&success=$success'</script>";
			}else{
				echo "<script>alert('Duplicate Entry not allowed.');</script>";
				$UPDATEROWS[title]=$_POST[shall_title];
				$UPDATEROWS[reff]=$_POST[shall_reff];
			}
		}
		if($this->upd > 0){
			$UPDATEROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."tags WHERE sno='".$this->upd."' AND typ='".$this->typ."'",1);
		}
		
		$messagearray=array("","Tag Created","Tag Updated","Tag Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."tags WHERE typ='".$this->typ."' ORDER BY title");
		if(strlen($this->upd)){
			if(strlen($_GET[red])){
				if(stristr($_GET[red],'photo-')){
					$expld=explode("-",$_GET[red]);
					$cancle="?pg=$expld[0]&upd={$_GET[altid]}&albumid=$expld[1]&albumtitle=$expld[2]";
				}else{
					$cancle="?pg={$_GET[red]}&upd={$_GET[altid]}";
				}
			}else
				$cancle="?pg=".$this->pg."&amp;typ=".$this->typ;
		}
		include("template/tags.tpl");
	}
}?>