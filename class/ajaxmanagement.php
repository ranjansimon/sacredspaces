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
		self::memberlist();
	}
	function memberlist(){
		$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."registration ORDER BY email");
		$QUERY2=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."subscriber ORDER BY email");
		$total=(count($QUERY) + count($QUERY2));
		echo "
		<div align='right'><input type='checkbox' name='checkall' value='1' onclick='checkallbox($total,this);'> Check All</div>
		<div class='clearboth pad10' style='background-color:#cccccc;width:630px;'><b>Register User</b></div><br class='clearboth'>";
		
		
		$k=0;
		foreach($QUERY as $ROWS){
			echo "
			<div class='selecteduser'><input type='checkbox' name='mailids[]' value='R{$ROWS[sno]}' id='chk_{$k}'>{$ROWS[email]}</div>";
			$k++;
		}
		echo "<div class='clearboth pad10' style='background-color:#cccccc;width:630px;'><b>Newsletter Subscriber</b></div><br class='clearboth'>";
		
		
		foreach($QUERY2 as $ROWS2){
			echo "
			<div class='selecteduser'><input type='checkbox' name='mailids[]' value='S{$ROWS2[sno]}' id='chk_{$k}'>{$ROWS2[email]}</div>";
			$k++;
		}
	}
}?>