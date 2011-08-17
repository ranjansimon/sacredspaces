<?php 
class mainclass {
	function mainclass(){
		$this->pg=$_GET[pg];
		$this->upd=$_GET[upd];
		$this->del=$_GET[del];
		$this->view=$_GET[view];
	}
	function management(){
		//session_destroy();
		if(strlen($_SESSION[lightboxsessid])){
			$sessxpld=explode("|",$_SESSION[lightboxsessid]);
			$nolightbox=" (".(count($sessxpld) - 1).")";
		}
		if(!strlen($_GET["ajax"]) && $this->pg!="popup" && $this->pg!="list")
			include("template/header.tpl");

		if($this->pg=="aboutus" || $this->pg=="cameras" || $this->pg=="contact" || $this->pg=="search" || $this->pg=="prints" || $this->pg=="list")
			$classfunction=new pagemanamgent();
		elseif($this->pg=="gallery" || $this->pg=="albums")
			$classfunction=new photogallery();
		elseif($this->pg=="lightbox")
			$classfunction=new lightbox();
		elseif(!strlen($this->pg))
			$classfunction=new homepage();
		else
			echo "<script>window.location.href='?';</script>";
		
		$classfunction->management();
				
		if(!strlen($_GET["ajax"]) && $this->pg!="popup" && $this->pg!="list")
			include("template/footer.tpl");
	}
}

?>