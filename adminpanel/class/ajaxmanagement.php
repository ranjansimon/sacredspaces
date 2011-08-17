<?php
class ajaxmanagement extends config{
	function ajaxmanagement(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->path="files/chapter/";
	}
	function management(){
		self::citylist();
	}
	function citylist(){
		//echo "SELECT title FROM ".$this->tblpfx."tags where reff='".addslashes($_GET[country])."' AND typ='C' ORDER BY title<br>";
		$QUERY=config::fetch_all_array("SELECT title FROM ".$this->tblpfx."tags where reff='".addslashes($_GET[country])."' AND typ='C' ORDER BY title");
		echo '<select name="shall_city" style="width:250px;" id="req__Please select your city name">
		<option value="">Please Select</option>';
		foreach($QUERY as $ROWS){
				echo "
				<option value='$ROWS[title]'>$ROWS[title]</option>";
		}
		echo '</select>';
	}
}?>