<div class="contetninner">
<div id="aboutus">
	<div class="contetninner_head">
		<div class="contetninner_title">LightBox</div>
	</div>
	
	
	<?foreach($QUERY as $ROWS){
		$albumbane=config::filename($ROWS[albumname]);
		list($width,$height)=getimagesize("photos/gallery/".$albumbane."/".$ROWS[sno]."-".$ROWS[imagename]);
		if($width > 161)
			$width=' width="161"';
	?>
		<div class="pad10 clear"></div>
		<div id="lightbox" class="contetninner_lightbox">
			<div class="Fltlt padR20" style="width:161px;">
				<img src="photos/gallery/<?=$albumbane;?>/<?=$ROWS[sno];?>-<?=$ROWS[imagename];?>" alt="<?=$ROWS[imagename];?>" <?=$width;?>/>
			</div>
			<div class="Fltlt" style="width:410px;">
				<div class="title_lightbox"><?=$ROWS[albumname];?></div>
				<div class="contentinner_text1"><?=$ROWS[photoname];?></div>
				<div class="tags1"><?=config::tagdisplay($ROWS);?></div>
			</div>
			<div class="Fltlt">	
				<a href="#" title="remove from lightbox" onclick="displayHideBox('1','index.php?pg=<?=$this->pg?>&del=<?=$ROWS[sno];?>'); return false;"><img src="images/btn_cross.png" border="0" alt="remove from lightbox" /></a>
			</div>
		</div>
	<?}?>
	
	<?if(strlen($_GET[success])){?>
		<br/><br/><br/><br/>
		<div align="center" style="color:#cccccc"> Thank you for your interest. Please allow me 3 working days to revert on your order.</div>
		<br/><br/><br/><br/>
	<?}elseif(!strlen($this->lightbox)){?>
	 <div class="clear" style="padding-top:11px;"></div>
	<div class="contetninner_text">
		There are no images added to your Lightbox. <br />You can choose images that you would like to order as prints:
		<ol>
			<li>Go to the 'Gallery' section on this website.</li>
			<li>Open the Gallery that you wish to choose an image from.</li>
			<li>Click on the selected photograph, it will open in a larger size.</li>
			<li>Click the '+ Lighbox' button at the bottom right of the photograph. Click outside the image area to close this photograph.</li>
			<li>Click the 'Lightbox' link in the main navigation menu to see your selected photographs list.</li>
			<li>Go to the bottom of this page, and fill in your contact details as required, and press the 'Send' button.</li>
		</ol>
		<div class="pad20 clear"></div>
		<div class="pad20 clear"></div>
		<div class="pad20 clear"></div>
	</div>
	
	
	
	<br/><br/><br/>
	<?}?>
	<div class="pad20 clear"></div>
	<?if(strlen($this->lightbox)){?>
		<div class="pad10 borderbottom"></div>
		<div class="pad10 clear"></div>
	
		<div class="normalfnt">
			Please fill in your details and I will revert with the delivery schedule, shipping costs, and payment method.
		</div>
	
	<div class="pad10 clear">&nbsp;</div>
	
	<form name="sendform1" method="post" action="" onsubmit="return dynamic_form_validation(this);">
	<span class="sec"><label class="Lsec">Name:</label> <input class="nml" name="name" id="req__Please enter your name" type="text" value="<?=$_POST[name];?>"/></span>
	<div class="clear pad5"></div>
	<span class="sec"><label class="Lsec">Email:</label> <input class="nml" name="email" id="req_Email-id_Please enter you email id" type="text" value="<?=$_POST[email];?>"/></span>
	<div class="clear pad5"></div>
	<span class="sec"><label class="Lsec">Message:</label> <textarea class="field" id="req__Please enter your message" name="message"><?=$_POST[message];?></textarea></span>
	<div class="clear pad10"></div>
	<span class="sec"><label class="Lsec">&nbsp;</label><input type="submit" class="submit" value="Send Request" name="sendrequest"/></span>
	<div class="clear"></div>                              
	</form>
	<?}?>
	</div>
	
	<!--Cancle Popup-->
	<div id="grayBG" class="grayBox" style="display:none;"></div>
	<div id="LightBox1" class="box_content" style="display:none;">
		<div id="lightbox">
			<div onclick="displayHideBox('1'); return false;" style="cursor:pointer;" align="right"><img src="images/btn_cross1.png" border="0" title="close" /></div>
			<div class="box_txtcontent" align="center">Do you want to remove this photograph from the Lightbox?</div>
			<div class="clear btn" align="center">
				<form name="deletelightboxfrm" id="deletelightboxfrm" action="" method="post">
					<input type="image" src="images/btn_ok.gif" style="border:0px" />&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="images/btn_cancel.gif" style="border:0px" onclick="displayHideBox('1'); return false;"/>
				</form>
			</div>
		</div>
	</div>
</div>	
