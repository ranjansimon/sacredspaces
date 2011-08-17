<?php
class cameras extends config{
	function cameras(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->path="../photos/cameras/";
	}
	function management(){
		$this->displaycameras();	
			
	}
	function displaycameras(){
		if(strlen($_POST[submit])){
			$this->upd=config::insertdb("cameras", "update"," sno=1");
			$success=1;
			echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
		}
			
		$messagearray=array("","Content Uploaded<br>By default the last updated will appear first. To change the order please use Set Position","Content Updated","Content Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."cameras",1);
		include("template/cameras.tpl");
	}
}?>