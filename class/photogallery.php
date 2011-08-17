<?php
class photogallery extends config{
	function photogallery(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->tblpfx=$tblpfx;
		$this->path="../photos/gallery/";
		$this->albumid=$_GET[albumid];
	}
	function management(){
		if($this->pg=="gallery")
			$this->photodisplay();
		else
			$this->displayalbum();	
			
	}
	function displayalbum(){
		$no_record=9;
		if(strlen($_REQUEST[perpage])){
			$no_record=$_REQUEST[perpage];
		}
		if($_REQUEST[slimit]>0){
			$startrecord=($_REQUEST[slimit]-1)*$no_record;
			//$qrylink.="&slimit=$_REQUEST[slimit]";
		}else
			$startrecord=0;
			
		$MAINQUERY="SELECT sno,albumname,imagename,country,city,date_format(tagdate,'%Y')as year FROM ".$this->tblpfx."album ORDER BY position asc, sno desc";
		$QUERY=config::fetch_all_array("$MAINQUERY limit $startrecord, $no_record");
		
		$pagepagging=config::paging($MAINQUERY,"index.php?pg=".$this->pg."&",$no_record);
		include("template/albums.tpl");
	}
	
	
	function photodisplay(){
		$ALBUMDETAIL=config::fetch_all_array("SELECT albumname,description FROM ".$this->tblpfx."album where sno='".$this->albumid."'",1);
		$albumfolder=config::filename($ALBUMDETAIL[albumname]);	
		
		$MAINQUERY="SELECT *,date_format(tagdate,'%Y')as year FROM ".$this->tblpfx."photogallery a where albumid='".$this->albumid."' ORDER BY position asc, sno desc";	
		$QUERY=config::fetch_all_array("$MAINQUERY");
		include("template/photogallery.tpl");
	}
}?>