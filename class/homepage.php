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
		include("template/homepage.tpl");
	}
}


?>