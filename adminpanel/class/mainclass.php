<?php 
class mainclass {
	function mainclass(){
		$this->pg=$_GET[pg];
		$this->upd=$_GET[upd];
		$this->del=$_GET[del];
		$this->view=$_GET[view];
	}
	function management(){
		ini_set("display_errors", 1);
		
		$loginmanage = new adminlogin();
		if($this->pg!="lgn" && $this->pg!="fgt" && $this->pg!="chngpass")
			$loginmanage->management();
		
		if($this->pg=="ajax"){
			$classfunction=new ajaxmanagement();
			$classfunction->management();
			exit;
		}
			
		if($this->pg!="ajax" && $this->pg!="popup")
			include("template/header.tpl");

						
		if($this->pg=="lgn" || $this->pg=="fgt" ||  $this->pg=="chngpass")
			$loginmanage->management();
			
		if($this->pg=="home")
			$classfunction=new homegallery();
		elseif($this->pg=="about" || $this->pg=="showcase")
			$classfunction=new aboutus();
		elseif($this->pg=="cameras")
			$classfunction=new cameras();
		elseif($this->pg=="prints")
			$classfunction=new prints();
		elseif($this->pg=="tags")
			$classfunction=new tagsmanagement();
		elseif($this->pg=="contact")
			$classfunction=new contact();	
		elseif(!strlen($this->pg) || $this->pg=="photo")
			$classfunction=new photogallery();
		elseif($this->pg!="lgn" && $this->pg!="fgt" && $this->pg!="chngpass" && strlen($this->pg))
			echo "<script>window.location.href='?';</script>";
		
		if($this->pg!="lgn" && $this->pg!="fgt" && $this->pg!="chngpass")
			$classfunction->management();
			
				
		if($this->pg!="ajax" && $this->pg!="popup")
			include("template/footer.tpl");
		
		if(strlen($_GET["print"]))
			echo "<script>window.print();window.close();</script>";
	}
}

?>