<?php 
class adminlogin extends config{
	function adminlogin(){
		global $tblpfx;
		$this->tblpfx=$tblpfx;
		$this->pg=$_GET[pg];
		$this->upd=$_GET[upd];
		$this->del=$_GET[del];
		$this->view=$_GET[view];
	}
	function management(){
		if($this->pg=="lgn")
			$this->login();
		elseif($this->pg=="chngpass")
			$error=$this->changepassword();
		elseif($this->pg=="fgt")
			$this->forgotpassword();	
		elseif($this->pg=="lgt")
			$this->logout();
			
		if($this->pg!="lgn" && $this->pg!="fgt")
			$this->loginchk();
		if($this->pg=="lgn" || $this->pg=="fgt" || $this->pg=="chngpass")
			include("template/adminlogin.tpl");
	}
	function changepassword(){
		if(strlen($_POST[submit])){
			if($_POST[cpassword]==$_POST[newpassword]){
				$chkrows=config::fetch_all_array("SELECT COUNT(*) FROM ".$this->tblpfx."user WHERE sno='$_SESSION[adminid]' AND pwd='".addslashes($_POST[oldpass])."'",1);
				if($chkrows[0]>0){
					config::query("update ".$this->tblpfx."user SET pwd='".addslashes($_POST[newpassword])."' where sno='$_SESSION[adminid]'");
					echo "<script>window.location.href='?pg=".$this->pg."&success=y';</script>";
					exit;
				}else{
					$error="<div align='center'>Invalid Old Password.</div>"; 
				}
			}else{
				$error="<div align='center'>Confirm Password not matched.</div>"; 
			}
		}
		
		if(!strlen($error) && strlen($_GET["success"])){
			$error="<div align='center'>Password has been changed successfully.</div>"; 
		}
		return $error;
	}
	function login(){
		if(strlen($_POST[username]) &&  strlen($_POST[password])){
			$ROWS=config::fetch_all_array("SELECT  sno,name,ip,date_format(lastlogin,'%d-%M-%Y %h:%i:%s')as lastlogin FROM ".$this->tblpfx."user WHERE userid='".addslashes($_POST[username])."' AND pwd='".addslashes($_POST[password])."'",1);
			if(strlen($ROWS[sno])>0){
				$_SESSION[adminid]=$ROWS[sno];
				$_SESSION[adminname]=$ROWS[name];
				$_SESSION[adminrights]=$ROWS[rightoptions];
				$_SESSION[adminlasttime]=$ROWS[lastlogin];
				$_SESSION[adminlastip]=$ROWS[ip];
				$_SESSION[sessid]=session_id();
				config::query("update ".$this->tblpfx."user SET ip='".$_SERVER['REMOTE_ADDR']."',lastlogin=now() where sno='$_SESSION[adminid]'");
				
				if(strlen($_GET[red]))
					echo "<script>window.location.href='?pg=".$_GET[red]."';</script>";
				else
					echo "<script>window.location.href='?success=y';</script>";	
				exit;
			}else{
				echo "<script>alert('Invalid Login Detail..');window.location.href='?pg=lgn';</script>";
				exit;
			}	
		}
		if(strlen($username) &&  strlen($password))
			echo '
			<div align="center" style="color:red;font-weight:bold;">Invalid Login Detail.</div>';
		
		if(isset($_SESSION[adminid])){
			echo "<script>alert('Invalid Login Detail.');window.location.href='?';</script>";
			exit;
		}
		
	}
	function logout(){
		session_destroy();
		echo "<script>window.location.href='?pg=lgn';</script>";
		exit;
	}
	function loginchk(){
		if(!strlen($_SESSION[adminid]) || !strlen($_SESSION[adminname]) || ($_SESSION[sessid]!=session_id())){
			session_destroy();
			//$redirect=$_SERVER['SCRIPT_NAME'];
			echo "<script>window.location.href='?pg=lgn&red=".$_GET[pg]."';</script>";
			exit;
		}
	}
	function forgotpassword(){
		if(strlen($_POST[fgtemailid])){
			$ROWS=config::fetch_all_array("SELECT name,userid,pwd from ".$this->tblpfx."user where email='".addslashes($_POST[fgtemailid])."' limit 1",1);
			if(strlen($ROWS[userid])){
				$message="Dear {$ROWS[name]},<br><br>
				Your SACRED SPACES Admin panel login details are as follow:<br><br>
				User Name : <b>$ROWS[userid]</b><br>
				Password : <b>$ROWS[pwd]</b><br><br><br>
				Regards,<br>
				SACRED SPACES Team";
				
				$result=config::mailfunction($_POST[fgtemailid],"support@sacredspaces.com","SACRED SPACES Admin Login Details",$message);
				if($result==1){
					echo "<script>alert('Your login details has been sent to you on your registered email id.');window.location.href='?pg=fgt';</script>";
					exit;
				}else{
					echo "<script>alert('Due to technical reason your query is not submited. Please try again later.');window.location.href='?pg=fgt';</script>";
					exit;
				}
					
			}else{
				echo "<script>alert('Invalid Email ID');</script>";
			}
		}
	}
}

?>