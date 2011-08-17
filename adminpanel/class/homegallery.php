<?php
class homegallery extends config{
	function homegallery(){
		global $tblpfx;
		$this->upd=$_GET[upd];
		$this->pg=$_GET[pg];
		$this->delid=$_GET[delid];
		$this->tblpfx=$tblpfx;
		$this->path="../photos/slide/";
		$this->path.=$albumname;	
		$this->filename_name=str_replace(' ','-',$_FILES[filename][name]);
		$this->filename=$_FILES[filename][tmp_name];
		$this->albumid=$_GET[albumid];
		$this->albumtitle=$_GET[albumtitle];
	}
	function management(){
		$this->displayhomegallery();	
			
	}
	function displayhomegallery(){
		if(strlen($_POST[setposition])){
			while(list($key, $val)=each($_POST)){
				if(strstr($key, "chk_")){
					$key=str_replace("chk_", "", $key);
					config::query("UPDATE ".$this->tblpfx."homegallery SET position='".addslashes($val)."' WHERE sno='$key'");
				}
			}
			self::filecreation();
			echo "<script>alert('Records has been updated successfully');window.location.href='?pg=".$this->pg."';</script>";
		}
		if(strlen($this->delid)){
			config::query("DELETE FROM ".$this->tblpfx."homegallery WHERE sno='".$this->delid."'");
			self::filecreation();
			echo "<script>window.location.href='?pg=".$this->pg."&success=3';</script>";
		}
		if(strlen($_POST[submit])){
			if(strlen($_FILES[filename][name])){
				$filename=$_FILES[filename][name];
				$additional.=",imagename='".addslashes($filename)."'";
			}
			$CHKQRY=config::fetch_all_array("SELECT COUNT(*) FROM ".$this->tblpfx."homegallery WHERE imagename='".addslashes($filename)."'",1);
			if($CHKQRY[0] == 0){
				if($_POST[tagdate_Month]<10)
					$_POST[tagdate_Month]="0".($_POST[tagdate_Month]+1);
				if($_POST[tagdate_Day]<10)
					$_POST[tagdate_Day]="0".$_POST[tagdate_Day];
				$additional.=",tagdate='$_POST[tagdate_Year]-$_POST[tagdate_Month]-$_POST[tagdate_Day]'";
				
				if(intval($this->upd)>0){
					config::insertdb("homegallery", "update"," sno='".$this->upd."'",$additional);
					$success=2;
				}else{
					$this->upd=config::insertdb("homegallery", "insert","",$additional);
					$success=1;
				}
				if(strlen($_FILES[filename][name])){
					$filename=$this->upd."-".$filename;
					$image = new imageresize();
					$image->load($_FILES["filename"]["tmp_name"]);
					$image->resize(698,464);
					$image->save($this->path.$filename);
					
				}
				self::filecreation();
				echo "<script>window.location.href='?pg=".$this->pg."&success=$success'</script>";
			}else{
				$errormessage="<div class='error'>Duplicate Image not allowed</div>";
				while(list($key, $val)=each($_POST)){
					if(strstr($key, "shall_")){
						$key=str_replace("shall_", "", $key);
						$UPDATEROWS[$key]=$val;
					}
				}
			}	
		}
		if($this->upd > 0){
			$UPDATEROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."homegallery WHERE sno='".$this->upd."'",1);
			//if(strlen($UPDATEROWS[imagename]))
				//$imagename="<img src='".$this->path.$UPDATEROWS[sno]."-".$UPDATEROWS[imagename]."' height='50'>";
			$UPDATEROWS[tagdate]=config::datechange($UPDATEROWS[tagdate],"-","-","1");	
		}

		if(!strlen($UPDATEROWS[tagdate]) || $UPDATEROWS[tagdate]=="00-00-0000")
			$UPDATEROWS[tagdate]=date("d-m-Y");
			
		if(strlen($this->upd))
			$TAGQUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."tags a ORDER BY title");
				
		$messagearray=array("","Photo Uploaded<br>By default the last updated will appear first. To change the order please use Set Position","Photo Updated","Photo Deleted");
		$message=$_GET[success];
		$message=$messagearray[$message];
		$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."homegallery ORDER BY position asc,sno desc");
		include("template/homegallery.tpl");
	}
	function filecreation(){
		$QUERY=config::fetch_all_array("SELECT sno,name,imagename,country,city,date_format(tagdate,'%Y')as year FROM ".$this->tblpfx."homegallery ORDER BY position asc,sno desc limit 0,5");
		foreach($QUERY as $ROWS){
			$tags="";
			
			if(strlen($ROWS[city])){
				$tags="<a href='city-$ROWS[city].html'>$ROWS[city]</a>";
			}
			if(strlen($ROWS[country])){
				if(strlen($tags))
					$tags.=", ";
				$tags.="<a href='country-$ROWS[country].html'>$ROWS[country]</a>. ";
			}
			if(strlen($ROWS[year]) && intval($ROWS[year])>0){
				$tags.="<a href='year-$ROWS[year].html'>$ROWS[year]</a>.";
			}
			
			//$tags=config::tagdisplay($ROWS);
			$content.='
			<img src="photos/slide/'.$ROWS[sno].'-'.$ROWS[imagename].'" title="<br><br><br><span class=title>'.$ROWS[name].'</span><br /><span class=address>'.$tags.'</span>" border="0" >';
		}
		$fp=fopen("../slide/slide.txt","w");
		fwrite($fp,$content);
		fclose($fp);
	}
}?>