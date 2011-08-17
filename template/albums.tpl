<div class="contetninner">

<div class="contetninner_head">
<div class="contetninner_title Fltlt">Gallery</div>
<div class="contetninner_right_text2 FltRt">
	<div><a id="various2" href="list.html">view as list</a></div>
</div>
</div>

<div class="clear" style="padding-top:5px;"></div>


<div id="gallery">
<ul>
<?foreach($QUERY as $ROWS){
	
	$tag=config::limitchar($ROWS[albumname],42);
	$class="";
	$i++;
	if($i==1)
		$class=' class="first"';
	if($i==3)
		$i=0;
?>
	<li <?=$class;?>><a href="gallery-<?=$ROWS[sno]?>.html"><img src="photos/gallery/<?=$ROWS[sno];?>-<?=$ROWS[imagename];?>" border="0"/><span class="gallery_text"><?=$tag;?></span></a></li>
<?}?>
</ul>
</div>
<div class="FltRt pages clear"> <?=$pagepagging;?></div>
<div class="clear">&nbsp;</div>

</div>