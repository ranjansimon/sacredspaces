<?php
class popupmanagement extends config{
	function popupmanagement(){
		global $tblpfx,$dirpath;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->typ=$_GET[typ];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->view=$_GET[view];
		$this->basedir=$dirpath;
	}
	function management(){
		if($this->typ=="mailpreview")
			self::memberdetail();
		elseif($this->typ=="maillog")
			self::maillog();
	}
	function memberdetail(){
		$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."newsmail WHERE sno='".$this->upd."'",1);
		$htmlheader="";$htmlfooter="";
		if($ROWS[mailtype]==1){
			$htmlheader=self::fileread($this->basedir."template/include/meeting-header.html");
			$htmlfooter=self::fileread($this->basedir."template/include/meeting-footer.html");
		}
		$middlecontent=self::fileread($this->basedir."files/newsmail/{$ROWS[sno]}.txt");
		
		$middlecontent=$htmlheader.$middlecontent.$htmlfooter;
		
		
		include("tmpl/popup.html");
		
	}
	function fileread($path){
		if(file_exists($path)){
			ob_start();
			include($path);
			$defaultval=ob_get_contents();
			ob_clean();
		}
		return $defaultval=stripslashes($defaultval);
	}
	function maillog(){
		$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."newsletter_log WHERE mailid='$_GET[id]'");
		include("tmpl/popup.html");
	}
}?>