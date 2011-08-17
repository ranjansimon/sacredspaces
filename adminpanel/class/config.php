<?php
class config{
	function __construct(){
		if($_SERVER['SERVER_NAME']=="localhost"){
			$con=mysql_connect("localhost","root","root") or die("Invalid hosting detail <br>".mysql_error());
			mysql_select_db("sacred",$con)or die("Invalied database".mysql_error());
		}else{
			$con=mysql_connect("localhost","sacredsp_admin","password") or die("Invalid hosting detail <br>".mysql_error());
			mysql_select_db("sacredsp_trinity",$con)or die("Invalied database".mysql_error());
		}
	}
	function close() {
	    mysql_close($this->link_id);
	}
	function query($sql) {
	    $this->query_id = @mysql_query($sql);
		if (!$this->query_id) {
	        die("<b>MySQL Query fail:</b> $sql <br>".mysql_error());
	        return 0;
	    }
	    return $this->query_id;
	}
	function insertid($sql) {
		$this->query($sql);
		$id=mysql_insert_id();
		return $id;
	}
	function num_rows($sql){
		$query_id=$this->query($sql);
		$num=mysql_num_rows($query_id);
		$this->free_result($query_id);
		return $num;
	}
	
	function fetch_all_array($sql,$typ="") {
	    $query_id = $this->query($sql);
	    if(!strlen($typ)){
		    $out = array();
		    while ($row = mysql_fetch_array($query_id)){
		        $out[] = $row;
		    }
	    }else{
		    $out = mysql_fetch_array($query_id);
	    }
	
	    $this->free_result($query_id);
	    return $out;
	}
	
	function free_result() {
	    mysql_free_result($this->query_id);
	}
	function insertdb($tablename, $section, $condition="", $additional=""){
		global $tblpfx;
		if($section=="insert" || $section=="update"){
			while(list($key, $val)=each($_POST)){
				if(strstr($key, "shall_")){
					$key=str_replace("shall_", "", $key);
					if(strlen($values)>0){
						$values.=", $key ='".addslashes($val)."' ";
					}else{
						$values=" $key ='".addslashes($val)."' ";
					}
				}
			}
			if($section=="insert"){
				$id=$this->query("insert into $tblpfx$tablename SET $values $additional ");
				return mysql_insert_id();
			}elseif($section=="update"){
				$this->query("update $tblpfx$tablename  SET $values $additional where $condition");
			}
		}elseif($section=="delete"){
			if(strlen($condition)){
				$condition=" where $condition";
			}
			$this->query("delete from $tblpfx$tablename $condition ");
		}
	}
	
	function mailfunction($to,$from,$subject,$message,$cc){
		global $baseurl;	
		if(!strlen($from))
			$from="info@aiconsult.ca";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= "From: <$from>" . "\r\n";
		if(strlen($cc))
			$headers .= "Cc: <$cc>" . "\r\n";
		$headers .= 'Reply-To: info@sacredspaces.com' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
	    
		if(mail($to,$subject,$message,$headers,"-f info@sacredspaces.com")){
			return "1";
		}
		return "0";
	}
	function getExtension($str){
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	function filehandle($content,$path,$mode){
		$fp=fopen($path,$mode);
		fwrite($fp,$content);
		fclose($fp);
		
	}
	function datechange2($date){
		$expld1=explode(" ",$date);
		$expld=explode("-",$expld1[0]);
		return $expld[1]."-".$expld[2]."-".$expld[0]." ".$expld1[1];
	}
	function datechange($date,$seprator="/",$seprator2="-",$typ="1"){
		if($typ==1){
			$expld=explode($seprator,$date);
			return $expld[2].$seprator2.$expld[1].$seprator2.$expld[0];
		}elseif($typ==2){
			$expld=explode($seprator,$date);
			return $expld[2].$seprator2.$expld[0].$seprator2.$expld[1];
		}elseif($typ==3){
			$expld=explode($seprator,$date);
			return $expld[1].$seprator2.$expld[2].$seprator2.$expld[0];
		}elseif($typ==4){
			$expld=explode($seprator,$date);
			return $expld[2].$seprator2.$expld[1].$seprator2.$expld[0];
		}elseif($typ==5){
			$expld=explode($seprator,$date);
			return $expld[1].$seprator2.$expld[0].$seprator2.$expld[2];	
		}
	}
	function paging($query, $page_name, $no_record, $link_qry=""){
		$slimit=$_REQUEST[slimit];
		$elimit=20;
		if(strlen($slimit) && $slimit>0){
			$currno=$slimit;
			$slimit=($slimit-1)*$no_record;
			$spage=$currno-5;
			$epage=$currno+5;
			if($spage<5){
				$spage=1;
				$epage=10;
			}	
			if($spage==2){
				$spage=$currno-1;
				$epage=$currno+3;
			}
		}else{
			$slimit=0;
			$spage=$slimit;
			$epage=$slimit+9;
			$spage=1;
			$currno=1;	
		}
		$query1=mysql_query($query);
		$nume=mysql_num_rows($query1);
		$num_row=$nume/$no_record;
		if($currno>$num_row){
			$spage=$currno-3;
			$epage=$currno+1;
		}
		if(($num_row+1)<$epage){
			$spage=intval($num_row+1)-10;
			$epage=$num_row+1;
		}
		
	 	if(($currno-1)>0){
			$body='<a href="'.$page_name.'slimit='.($currno-1).$link_qry.'"><img src="images/prev.gif" border="0" title="Previous"></a>&nbsp;&nbsp;';
		}
	
		$j=0;
		for($j=$spage;$j<=$epage; $j++){
			if($j<$num_row+1 && $j>0 && $epage >= 2){
				$l=$l+1;
				if(strlen($bodypart))
					$bodypart.="/";
				if($currno<>$j){
					$bodypart.=" <a href='".$page_name."slimit=$j".$link_qry."' class='paging'>".$j."</a> ";
				}else{
					$bodypart.=" <font class='selected'><strong>".$j."</strong></font> ";
				}
			}
		}
		//if(($currno+1)<($num_row+1)){
	 	//	 $bodypart.='  <a href="'.$page_name.'slimit='.($currno+1).$link_qry.'"><img src="images/next.gif" border="0" title="Next"></a>';
		//}
		return $bodypart;
	}
	function random_gen($length){
	  $random= "";
	  srand((double)microtime()*1000000);
	  $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	  $char_list .= "abcdefghijklmnopqrstuvwxyz";
	  $char_list .= "1234567890";
	  // Add the special characters to $char_list if needed
	
	  for($i = 0; $i < $length; $i++)
	  {
	    $random .= substr($char_list,(rand()%(strlen($char_list))), 1);
	  }
	  return $random;
	}
	function rendomquestion($minquestion,$noquestion,$startno,$j="",$k="",$incrementval="",$returnval=""){
		if(!strlen($j)){
			$j=$startno;
			$k=$startno;
		}
		if($noquestion<=$k){
			$startno=ceil($j/2);
			$this->rendomquestion($minquestion,$noquestion,$startno,"","",$incrementval,$returnval);
		}elseif($j<=0){
			$startno=$noquestion-$k;
			$startno=$noquestion-ceil($startno/2);
			$this->rendomquestion($minquestion,$noquestion,$startno,"","",$incrementval,$returnval);
		}else{
			if(($minquestion/2)>=$incrementval){
				$incrementval++;
				if(strlen($returnval) && $j!=$k)
					$returnval.="$j~$k~";
				else
					$returnval.="$j~";	
				$j--;
				$k++;
				$this->rendomquestion($minquestion,$noquestion,$startno,$j,$k,$incrementval,$returnval);
			}else{
				$_SESSION[RANDSESSION]=$returnval;
			}
		}
	}
	function fckeditor($path="",$defaultval="",$width=860,$height=250,$editorname="",$include=""){
		if(strlen($path)){
			$defaultval="";
			if(file_exists($path)){
				ob_start();
				include($path);
				$defaultval=ob_get_contents();
				ob_clean();
			}else{
				$defaultval="UPDATE YOUR CONTENT";
			}
		}
		$defaultval=stripslashes($defaultval);
		if(!strlen($editorname))
			 $editorname="page_editor";
			 
		$Config['UserFilesPath']=$GLOBALS[baseurlpath];
		$sBasePath = $GLOBALS[baseurlpath]."adminpanel/fckeditor/";
		//include("/home/gnstechn/public_html/fckeditor/fckeditor.php");
		//$sBasePath = "/development/admin/fckeditor/" ;
		if(!strlen($include))
			include("fckeditor/fckeditor.php");
		
		$oFCKeditor = new FCKeditor($editorname) ;
		$oFCKeditor->Height =$height.'px';
		$oFCKeditor->Width =$width.'px';
		$oFCKeditor->BasePath = $sBasePath ;
		$oFCKeditor->Value = $defaultval;
		$oFCKeditor->Create() ;
	}
	function filename($fielname){
		return $fielname = preg_replace("![^a-z0-9]+!i", "-", trim($fielname));
	}
	function tagdisplay($ROWS,$linkdisplay=""){
		if(!strlen($linkdisplay)){
			if(strlen($ROWS[city])){
				$phototags="<a href='city-".str_replace('/','^',$ROWS[city]).".html'>$ROWS[city]</a>";
			}
			if(strlen($ROWS[country])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='country-".str_replace('/','^',$ROWS[country]).".html'>$ROWS[country]</a>";
			}
			/*if(strlen($ROWS[tagdate])){
				if(strlen($phototags))
					$phototags.=", ";
				$ROWS[tagdate]=config::datechange($ROWS[tagdate],"-","-","1");
				$phototags.="<a href='date-$ROWS[tagdate].html'>$ROWS[tagdate]</a>";
			}*/
			if(strlen($ROWS[year]) && intval($ROWS[year])>0){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='year-".str_replace('/','^',$ROWS[year]).".html'>$ROWS[year]</a>";
			}
			if(strlen($ROWS[religion])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='religion-".str_replace('/','^',$ROWS[religion]).".html'>$ROWS[religion]</a>";
			}
			if(strlen($ROWS[camera])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='camera-".str_replace('/','^',$ROWS[camera]).".html'>$ROWS[camera]</a>";
			}
			if(strlen($ROWS[lens])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='lens-".str_replace('/','^',$ROWS[lens]).".html'>$ROWS[lens]</a>";
			}
			if(strlen($ROWS[film])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='film-".str_replace('/','^',$ROWS[film]).".html'>$ROWS[film]</a>";
			}
			if(strlen($ROWS[typeimg])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="<a href='typeimage-".str_replace('/','^',$ROWS[typeimg]).".html'>$ROWS[typeimg]</a>";
			}
		}else{
			if(strlen($ROWS[city])){
				$phototags="$ROWS[city]";
			}
			if(strlen($ROWS[country])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[country]";
			}
			/*if(strlen($ROWS[tagdate])){
				if(strlen($phototags))
					$phototags.=", ";
				$ROWS[tagdate]=config::datechange($ROWS[tagdate],"-","-","1");
				$phototags.="<a href='date-$ROWS[tagdate].html'>$ROWS[tagdate]</a>";
			}*/
			if(strlen($ROWS[year]) && intval($ROWS[year])>0){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[year]";
			}
			if(strlen($ROWS[religion])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[religion]";
			}
			if(strlen($ROWS[camera])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[camera]";
			}
			if(strlen($ROWS[lens])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[lens]";
			}
			if(strlen($ROWS[film])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[film]";
			}
			if(strlen($ROWS[typeimg])){
				if(strlen($phototags))
					$phototags.=", ";
				$phototags.="$ROWS[typeimg]";
			}
		}
		return $phototags;
	}
	function limitchar($text,$limit){
		if(strlen($text) > $limit){
			$newchar=substr($text,0,($limit - 2));
			return $newchar=$newchar."..";
		}else{
			return $text;
		}	
	}
}?>