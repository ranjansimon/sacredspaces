<div class="contetninner">

<?
if(strlen($condition)){
	if(count($QUERY) > 0){?>

	<div class="contetninner_head">
	<div class="searchhead">Search '<?=$tag;?>'</div>
	</div>

	<?	foreach($QUERY as $ROWS){
			$phototags=config::tagdisplay($ROWS);
			$albumbane=config::filename($ROWS[albumname]);
			list($width,$height)=getimagesize("photos/gallery/".$albumbane."/".$ROWS[sno]."-".$ROWS[imagename]);
			if($width > 161)
				$width=' width="161"';
		?>
			<div class="pad10 clear"></div>
			
			<div class="contetninner_lightbox">
			<div class="Fltlt padR20" style="width:161px;">
			
			<a href="photos/gallery/<?=$albumbane;?>/large/<?=$ROWS[sno];?>-<?=$ROWS[imagename];?>" rel="example_group" id="<table width='100%' cellpading='5' cellspacing='0' style='margin-top:-5px; margin-left:4px;'><tr><td align='left' valign='top'><span class='contetninner_text'><?=$ROWS[photoname];?></span><br/><span class='tags1'><?=$phototags;?></span></td><td align='right' id='successmessage' valign='top'><?if(!strstr($_SESSION[lightboxsessid],"^".$ROWS[sno]."|")){?><a href=javascript:void(0); onclick=lightboxjax('index.php?pg=lightbox&ajax=y&id=<?=$ROWS[sno];?>','lightboxadd<?=$ROWS[sno];?>');><script>ajax('lightbutton.php?sno=<?=$ROWS[sno];?>', 'successmessage')</script></a><?}else{?><img border='0' title='Added to lightbox' src='images/addedtolightbox.png'><?}?></td></tr></table><div class='clear'></div>">
			<img src="photos/gallery/<?=$albumbane;?>/<?=$ROWS[sno];?>-<?=$ROWS[imagename];?>" alt="<?=$ROWS[imagename];?>" <?=$width;?>/></a></div>
			<div class="Fltlt">
			<div class="title_lightbox"><?=$ROWS[photoname];?></div>
			<div class="contentinner_text11"><?=$ROWS[shortdescription];?><br/>
			<span class="tags1"><?=$phototags;?></span></div>
			</div>
			</div>
		<?}
	}else{?>
		<div class="contetninner_head">
		<div class="searchhead">Search '<?=$tag;?>'</div>
		<div class="contetninner_text">There are no results for '<?=$tag;?>'.<br />
		Please try the Search again or visit the <a href="albums.html">Gallery</a> section to browse the photographs.</div>
		</div>

		<div class="pad10 clear"></div>
	<?}
}else{?>
	<div class="pad10 clear"></div>
	<div align="center" style="color:#ccc">Please enter search item.</div>
	<div class="pad10 clear"></div>
<?}?>


<div class="clear">&nbsp;</div>
<div class="FltRt pages clear"> <?=$pagepagging;?></div>
<div class="clear">&nbsp;</div>
</div>