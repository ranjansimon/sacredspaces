<?php
$con=mysql_connect("localhost","root","root") or die("Invalid hosting detail <br>".mysql_error());
mysql_select_db("gnstechn_properties",$con)or die("Invalied database".mysql_error());
include("imageresize.php");

	$dir="prop_images/";

	/*$image = new SimpleImage();
	$image->load($dir."1136_2.jpg");
	$image->resize(100,100);
	$image->save("test.jpg");
	
	exit;*/
	
	if ($folder = opendir($dir)) {
		while (($file = readdir($folder)) !== false) {
			$source_file=$dir.$file;
			if(stristr($source_file,".jpg") || stristr($source_file,".gif")){
					$i++;
					if($i<=10){
						$xpld="";
						$xpld=explode('_',$file);
						if(strlen($xpld[0])){
							mysql_query("update gns_propdetail SET images=concat(images,'~','".str_replace($xpld[0]."_","",$file)."','~') WHERE propid='$xpld[0]'");
							$file=str_replace('_','-',$file);
							$image = new SimpleImage();
							$image->load($source_file);
							$image->resize(100,100);
							$image->save("../../propertyphoto/thumb/".$file);
							
							list($width,$height)=getimagesize($source_file);
							if($height>600 || $width > 800){
								$image->load($source_file);
								$image->resize(800,600);
								$image->save("../../propertyphoto/".$file);
							}
							
							//copy($source_file,"../../propertyphoto/".$file);
							echo $source_file."<br>";
							unlink($source_file);
							
							//exit;
						}
				}else{
					echo "<script>window.location.href='?';</script>";
				}	
			}
		}
	}
	
	mysql_query("update gns_propdetail SET images=replace(replace(images,'~~','^'),'~','')");
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>