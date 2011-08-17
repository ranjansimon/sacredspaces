<?php 
class adminuser extends config{
	function adminuser(){
		global $tblpfx;
		$this->tblpfx=$tblpfx;
		$this->pg=$_GET[pg];
		$this->upd=$_GET[upd];
		$this->del=$_GET[del];
		$this->view=$_GET[view];
		$this->submit=$_POST["Submit"];
	}
	function management(){
		config::rightscheck(1);
		self::usermanamgent();
	}
	
	function usermanamgent(){
		if(strlen($this->del)){
			if($this->del==1){
				echo "<script>alert('You are not able to delete this record');window.location.href='?pg=".$this->pg."';</script>";
				exit;
			}else{
				config::query("delete from ".$this->tblpfx."user where sno='".$this->del."'");
				echo "<script>alert('Record has been deleted successfully');window.location.href='?pg=".$this->pg."';</script>";
				exit;
			}
		}
		
		if(!strlen($this->upd)){
			$QUERY=config::fetch_all_array("select * from ".$this->tblpfx."user");
		}else{
			if(strlen($this->submit)){
				$rightsopt=$_POST[chk];
				while(list($key,$val) = each($rightsopt)){
					$rghtopt.="#".$val."^";
				}
				$additional=",rightoptions='$rghtopt'";
				if(intval($this->upd)==0){
					config::insertdb("user","insert","",$additional);
					echo "<script>alert('Record has been submitted successfully.');window.location.href='?pg=".$this->pg."';</script>";
				}else{
					config::insertdb("user","update"," sno='".$this->upd."'",$additional);
					if($this->upd==$_SESSION[adminid])
						session_destroy();
					echo "<script>alert('Record has been submitted successfully.');window.location.href='?pg=".$this->pg."';</script>";
				}
				
				exit;
			}
			if(intval($this->upd)>0){
				$ROWS=config::fetch_all_array("select * from ".$this->tblpfx."user where sno='".$this->upd."'",1);
			}
			${"chk".intval($ROWS[status])}="checked";
			
			
			$RIGHTQRY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."rights ORDER BY sno");
			$i=0;$td=0;
			foreach($RIGHTQRY as $RIGHTROWS){
				$checked="";
				$td++;
				if(strstr($ROWS[rightoptions],"#".$RIGHTROWS[sno]."^"))
					$checked="checked";
				if($td==1)	
					$RIGHTSMESSAGE.="<tr>";	
				$RIGHTSMESSAGE.="
				<td><input type='checkbox' name='chk[$i]' value='$RIGHTROWS[sno]' id='chk_$i' $checked> $RIGHTROWS[rightname]</td>";
				$i++;
				if($td==2){
					$RIGHTSMESSAGE.="</tr>";
					$td=0;
				}
				
			}
			if($td>0)
				$RIGHTSMESSAGE.="<td></td></tr>";
			
		}
		include("tmpl/adminuser.html");
	}
}


?>