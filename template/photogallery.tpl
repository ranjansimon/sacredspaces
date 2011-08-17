<div class="contetninner">

<div class="contetninner_head"><div class="contetninner_title-1 Fltlt"><?=$ALBUMDETAIL[albumname];?></div>
<div class="contetninner_right_text FltRt">

	<div><a href="albums.html"  id="">back to gallery</a></div>
</div>

</div>

<!-- <div class="clear normalfont"><?=$ALBUMDETAIL[description];?></div>   --> 


<div  id="photogallery" class="clear">
	<?foreach($QUERY as $ROWS){
		$phototags=config::tagdisplay($ROWS);
		$i++;
		$br="";
		if($i==1)
			$br="<div class='clear'></div>";
			
		$class="";
		if($i==2)
			$class=' class="middleimg"';
		if($i==3){
			$i=0;
			$class=' class="rightimg"';
		}	
		?><?=$br;?>
		<a href="photos/gallery/<?=$albumfolder;?>/large/<?=$ROWS[sno];?>-<?=$ROWS[imagename];?>" rel="example_group" id="<table width='100%' cellpading='0' cellspacing='0' style='margin-top:-5px;margin-left: 3px;' border='0'><tr><td align='left'><span class='contetninner_text'><?=$ROWS[photoname];?></span><br/><span class='tags1'><?=$phototags?></span></td><td align='right' id='successmessage'><?if(!strstr($_SESSION[lightboxsessid],"^".$ROWS[sno]."|")){?><a href=javascript:void(0); onclick=lightboxjax('index.php?pg=lightbox&ajax=y&id=<?=$ROWS[sno];?>','lightboxadd<?=$ROWS[sno];?>');><script>ajax('lightbutton.php?sno=<?=$ROWS[sno];?>', 'successmessage')</script></a><?}else{?><img border='0' title='Added to lightbox' src='images/addedtolightbox.png'><?}?></td></tr></table><div class='clear'></div>">
		<img src="photos/gallery/<?=$albumfolder;?>/<?=$ROWS[sno];?>-<?=$ROWS[imagename];?>" border="0" alt="<?=$ROWS[imagename];?>" <?=$class;?>/>
		</a>
	<?}?>
</div>
<!--<div class="FltRt pages clear"> <?//$pagepagging;?> </div>-->
<div class="clear">&nbsp;</div>

</div>