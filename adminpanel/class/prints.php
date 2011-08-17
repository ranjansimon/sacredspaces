<?php
class prints extends config{
	function prints(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->path="../photos/prints/";
	}
	function management(){
		$this->displayprints();	
			
	}
	function displayprints(){
		if(strlen($_POST[submit])){
			config::insertdb("prints", "update"," sno='1'",$additional);
			$success=2;
			echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
		}
		$messagearray=array("","Content Uploaded<br>By default the last updated will appear first. To change the order please use Set Position","Content Updated","Content Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."prints",1);
		include("template/prints.tpl");
	}
}?>