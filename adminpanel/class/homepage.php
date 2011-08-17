<?php 
class homepage extends config{
	function homepage(){
		global $tblpfx;
		$this->tblpfx=$tblpfx;
	}
	function management(){
		self::homepagemanamgent();
	}
	function homepagemanamgent(){
		$ROWS=config::fetch_all_array("SELECT COUNT(*)as ctn,SUM((SELECT count(*) FROM ".$this->tblpfx."photogallery WHERE albumid=a.sno))as totalgallery FROM ".$this->tblpfx."album a WHERE typ='P' GROUP BY typ",1);
		$ROWS2=config::fetch_all_array("SELECT COUNT(*)as ctn,SUM((SELECT count(*) FROM ".$this->tblpfx."photogallery WHERE albumid=a.sno))as totalgallery FROM ".$this->tblpfx."album a WHERE typ='L' GROUP BY typ",1);
		include("template/homepage.tpl");
	}
}


?>