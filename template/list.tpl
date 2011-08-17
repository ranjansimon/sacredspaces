<div class="contetninner">
	<div id="list">
		<div class="mainblock">
			<?foreach($QUERY as $ROWS){?>
				<div class="block">
					<a href="gallery-<?=$ROWS[sno];?>.html"><?=$ROWS[albumname];?></a>
				</div>	
			<?}?>
			<div class="clear"></div>		
		</div>
	</div>
</div>