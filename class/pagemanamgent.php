<?php 
class pagemanamgent extends config{
	function pagemanamgent(){
		global $tblpfx;
		$this->tblpfx=$tblpfx;
		$this->pg=$_GET[pg];
	}
	function management(){
		if($this->pg=="search")
			self::search();
		else
			self::pagecontent();
	}
	function pagecontent(){
		if($this->pg=="list"){
			$QUERY=config::fetch_all_array("SELECT sno,albumname FROM ".$this->tblpfx."album ORDER BY albumname");
		}elseif($this->pg=="aboutus"){
			$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."aboutus",1);
			$QUERY=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."showcase order by position,sno");
		}elseif($this->pg=="cameras"){
			$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."cameras",1);
		}elseif($this->pg=="prints")
			$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."prints",1);
		elseif($this->pg=="contact")
			$ROWS=config::fetch_all_array("SELECT * FROM ".$this->tblpfx."contactus",1);
		
		
		if($this->pg=="contact" || $this->pg=="aboutus"){
			$ALBUMQRY=config::fetch_all_array("SELECT *,date_format(tagdate,'%Y')as year FROM ".$this->tblpfx."album");
			
			$startno=rand(1,count($ALBUMQRY));
			config::rendomquestion(4,count($ALBUMQRY),$startno);
			$randgallery=$_SESSION[RANDSESSION];
			unset($_SESSION[RANDSESSION]);

			
			foreach($ALBUMQRY as $ALBUMROWS){
				$i++;
				$VALSNO[$i]=$ALBUMROWS[sno];
				$VALIMAGENAME[$i]=$ALBUMROWS[imagename];
				$VALALBUMNAME[$i]=$ALBUMROWS[albumname];
				$VALCITYNAME[$i]=$ALBUMROWS[city];
				$VALCOUNTRYNAME[$i]=$ALBUMROWS[country];
				$VALYEAR[$i]=$ALBUMROWS[year];
				
			}
			$explt=explode('~',$randgallery);
		}
		if($this->pg=="prints" || $this->pg=="cameras" || $this->pg=="aboutus"){
			if($this->pg=="cameras")
				$ROWS[content]=$ROWS[block1];
			
			$pagecontent=stripslashes($ROWS[content]);
			preg_match_all('/<img[^>]+>/i',$pagecontent, $result);
			foreach( $result[0] as $img_tag) {
				$replacestring="";
				if(stristr($img_tag,'align="right"') || stristr($img_tag,"align='right'"))
					$replacestring=preg_replace('/<img/i', '<img style="padding : 20px 0px 20px 20px;"', $img_tag);
				elseif(stristr($img_tag,'align="left"') || stristr($img_tag,"align='left'"))
					$replacestring=preg_replace('/<img/i', '<img style="padding : 20px 20px 20px 0px;"', $img_tag);
				else
					$replacestring=preg_replace('/<img/i', '<img style="padding : 20px 20px 20px 0px;"', $img_tag);	
				
				if(strlen($replacestring))	
					$pagecontent=str_replace($img_tag,$replacestring,$pagecontent);	
			}
		}		
		
		include("template/".$this->pg.".tpl");
	}
	function search(){
		$_GET[val]=str_replace('^','/',$_GET[val]);
		if(strlen($_GET[tag])){
			$tag=$_GET[val];
			$querystring="&val=".$_GET[val]."&tag=".$_GET[tag];
			/*if($_GET[tag]=="W"){
				$condition="p.country='".addslashes($_GET[val])."'";
			}
			if($_GET[tag]=="C"){
				if(strlen($condition))
					$condition.=" AND ";
				$condition.="p.city='".addslashes($_GET[val])."'";
			}
			
			
			
			if($_GET[tag]=="R"){
				if(strlen($condition))
					$condition.=" AND ";
				$condition.="p.religion='".addslashes($_GET[val])."'";
			}
			if($_GET[tag]=="P"){
				if(strlen($condition))
					$condition.=" AND ";
				$condition.="p.camera='".addslashes($_GET[val])."'";
			}
			if($_GET[tag]=="L"){
				if(strlen($condition))
					$condition.=" AND ";
				$condition.="p.lens='".addslashes($_GET[val])."'";
			}
			if($_GET[tag]=="F"){
				if(strlen($condition))
					$condition.=" AND ";
				$condition.="p.film='".addslashes($_GET[val])."'";
			}
			if($_GET[tag]=="I"){
				if(strlen($condition))
					$condition.=" AND ";
				$condition.="p.typeimg='".addslashes($_GET[val])."'";
			}*/
			if($_GET[tag]=="D"){
				//if(strlen($condition))
				//	$condition.=" AND ";
				$date=config::datechange(addslashes($_GET[val]),"-","-","1");
				$condition.="(p.tagdate='$date' OR a.tagdate='$date')";
			}elseif($_GET[tag]=="Y"){
				//if(strlen($condition))
					//$condition.=" AND ";
				$condition.="(date_format(p.tagdate,'%Y')='".addslashes($_GET[val])."' OR date_format(a.tagdate,'%Y')='".addslashes($_GET[val])."')";
			}else
				$condition.=" (p.typeimg='".addslashes($_GET[val])."' OR p.film='".addslashes($_GET[val])."' OR p.lens='".addslashes($_GET[val])."' OR p.camera='".addslashes($_GET[val])."' OR p.religion='".addslashes($_GET[val])."' OR p.city='".addslashes($_GET[val])."' OR a.typeimg='".addslashes($_GET[val])."' OR a.film='".addslashes($_GET[val])."' OR a.lens='".addslashes($_GET[val])."' OR a.camera='".addslashes($_GET[val])."' OR a.religion='".addslashes($_GET[val])."' OR a.city='".addslashes($_GET[val])."' OR p.country='".addslashes($_GET[val])."' OR p.city='".addslashes($_GET[val])."' OR a.city='".addslashes($_GET[val])."' OR a.city='".addslashes($_GET[val])."')";
				
				
		}elseif(strlen($_REQUEST[searchitem])>=3){
			$tag=$_REQUEST[searchitem];
			$querystring="&searchitem=".$_REQUEST[searchitem];
			$_REQUEST[searchitem]=strtolower($_REQUEST[searchitem]);
			$condition="LCASE(p.photoname) LIKE '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.shortdescription) LIKE '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.typeimg) like '%".addslashes($_REQUEST[searchitem])."%'  OR LCASE(p.film) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.lens) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.camera) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.religion) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.tagdate) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.city) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(p.country) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.albumname) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.shortdescription) LIKE '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.typeimg) like '%".addslashes($_REQUEST[searchitem])."%'  OR LCASE(a.film) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.lens) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.camera) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.religion) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.tagdate) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.city) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.country) like '%".addslashes($_REQUEST[searchitem])."%' OR LCASE(a.albumname) like '%".addslashes($_REQUEST[searchitem])."%'";
		}
		if(strlen($condition)){
			$no_record=20;
			if(strlen($_REQUEST[perpage])){
				$no_record=$_REQUEST[perpage];
			}
			if($_REQUEST[slimit]>0){
				$startrecord=($_REQUEST[slimit]-1)*$no_record;
				//$qrylink.="&slimit=$_REQUEST[slimit]";
			}else
				$startrecord=0;
			
			$MAINQUERY="SELECT p.*,a.albumname FROM ".$this->tblpfx."photogallery p,".$this->tblpfx."album a WHERE a.sno=p.albumid and  ($condition) ORDER BY p.position asc, sno desc";
			$QUERY=config::fetch_all_array("$MAINQUERY limit $startrecord, $no_record");
			$pagepagging=config::paging($MAINQUERY,"index.php?pg=".$this->pg.$querystring."&",$no_record);
		}
		include("template/search.tpl");
	}
	function tagdisplay($ROWS){
		if(strlen($ROWS[country])){
			$phototags="<a href='country-$ROWS[country].html'>$ROWS[country]</a>";
		}
		if(strlen($ROWS[city])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='city-$ROWS[city].html'>$ROWS[city]</a>";
		}
		if(strlen($ROWS[tagdate])){
			if(strlen($phototags))
				$phototags.=", ";
			$ROWS[tagdate]=config::datechange($ROWS[tagdate],"-","-","1");
			$phototags.="<a href='date-$ROWS[tagdate].html'>$ROWS[tagdate]</a>";
		}
		if(strlen($ROWS[religion])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='religion-$ROWS[religion].html'>$ROWS[religion]</a>";
		}
		if(strlen($ROWS[camera])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='camera-$ROWS[camera].html'>$ROWS[camera]</a>";
		}
		if(strlen($ROWS[lens])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='lens-$ROWS[lens].html'>$ROWS[lens]</a>";
		}
		if(strlen($ROWS[film])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='film-$ROWS[film].html'>$ROWS[film]</a>";
		}
		if(strlen($ROWS[typeimg])){
			if(strlen($phototags))
				$phototags.=", ";
			$phototags.="<a href='typeimage-$ROWS[typeimg].html'>$ROWS[typeimg]</a>";
		}
		return $phototags;
	}
}


?>