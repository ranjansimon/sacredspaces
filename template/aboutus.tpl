<div class="contetninner">
	<div id="aboutus"><?=$pagecontent;?></div>
	
	<div class="linespace clear">&nbsp;</div>
	
	<div id="gallery" style="padding-top:5px;">
		<div class="othertitles flLt"><a href="albums.html">Gallery</a></div>
		<div class="contetninner_right_text FltRt"><a href="albums.html">view all albums</a></div>
	<ul class="clear">
	
	<?
	for($i = 1; $i <= 3; $i++){
		$class="";
		$j++;
		if($j==1)
			$class=' class="first"';
		$randval=$i - 1;
		$randval=$explt[$randval];
		
		$tag=config::limitchar($VALALBUMNAME[$randval],42);
	
	?>
		<li <?=$class;?>><a href="gallery-<?=$VALSNO[$randval];?>.html"><img src="photos/gallery/<?=$VALSNO[$randval];?>-<?=$VALIMAGENAME[$randval];?>" border="0"/><span class="gallery_text"><?=$tag;?></span></a></li>
		<!--<li <?=$class;?>><a href="javascript:void(0);"><img src="photos/gallery/<?=$VALSNO[$randval];?>-<?=$VALIMAGENAME[$randval];?>" border="0"/><span class="gallery_text"><?=$tag;?></span></a></li>-->
	<?}?>
	</ul>
	</div>
	<br class="clear"/>
	<div class="linespace">&nbsp;</div>
	<div class="pad5">&nbsp;</div>
<div id="showcase">
	<div class="othertitles">Showcase</div>
	<ul>
		<?foreach($QUERY as $ROWS2){?>
			<?if($ROWS2[typ]=="F"){?>
				<li><?=$ROWS2[title];?> 
				<?if(strlen($ROWS2[filename]) && stristr($ROWS2[filename],'.pdf')){?>
					<a href="photos/aboutus/showcase/<?=$ROWS2[sno]."-".$ROWS2[filename];?>" style="text-decoration:underline" target="_blank">(download pdf)</a> <img src="images/pdf-icon.gif" border="0" alt="<?=$ROWS2[title];?>"/></li>
				<?}else{?>
					<a href="photos/aboutus/showcase/<?=$ROWS2[sno]."-".$ROWS2[filename];?>" style="text-decoration:underline" target="_blank">(download Video)</a></li>
				<?}?>	
			<?}else{?>
				<li>
				<?=$ROWS2[title];?>
				<?if(strlen($ROWS2[filename]) && strstr($ROWS2[filename],'.')){?>
					<a href="<?=$ROWS2[filename];?>" style="text-decoration:underline" target="_blank">(<?=$ROWS2[filename];?>)</a></li>
				<?}?></li>		
			<?}?>	
		<?}?>
	</ul>
<iframe width="425" height="349" src="http://www.youtube.com/embed/LGxr4p_4yAE" frameborder="0" allowfullscreen></iframe>
</div>
</div>
