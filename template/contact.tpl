<div class="contetninner">
	<div id="contactus">
		<div class="content">
			<?=stripslashes($ROWS[content]);?>
		</div>		
	</div>
	
	
	
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
		$tag=config::limitchar($VALALBUMNAME[$randval],42);?>
		
<!--		<li <?=$class;?>><a href="javascript:void(0);"><img src="photos/gallery/<?=$VALSNO[$randval];?>-<?=$VALIMAGENAME[$randval];?>" border="0"/><span class="gallery_text"><?=$tag;?></span></a></li>
-->		<li <?=$class;?>><a href="gallery-<?=$VALSNO[$randval];?>.html"><img src="photos/gallery/<?=$VALSNO[$randval];?>-<?=$VALIMAGENAME[$randval];?>" border="0"/><span class="gallery_text"><?=$tag;?></span></a></li>
	<?}?>
	</ul>
	</div>
	<br class="clear"/>
	<div class="linespace">&nbsp;</div>
	
	<div class="clear" style="padding-bottom:17px;">&nbsp;</div>
	
	
	<div class="clear"></div>	
</div>