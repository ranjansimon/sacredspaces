<?php
class contact extends config{
	function contact(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
	}
	function management(){
		$this->displaycontact();	
			
	}
	function displaycontact(){
		if(strlen($_POST[submit])){
			$this->upd=config::insertdb("contactus", "update"," sno=1");
			$success=1;
			echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
		}
			
		$messagearray=array("","Content Uploaded","Content Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."contactus",1);
		include("template/contact.tpl");
	}
}?>