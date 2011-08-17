<div class="breadcrumb"><a href="?">Home</a> &raquo; <span>Manage Home Gallery</span></div>
<br class="clear">
	<?if(count($QUERY) && !strlen($this->upd)){?>
		<div class="addnew"><a href="?pg=<?=$this->pg;?>&upd=0">Add New Home Photo</a> &nbsp;&nbsp;|&nbsp; <a href="<?=$GLOBALS[baseurlpath];?>" target="_blank">Preview</a></div>
		<?if(strlen($_GET[success])){?>
			<div class="successmessage"><?=$message;?></div>
		<?}?>
		<form action="" method="post" name="position"><table width="100%" border="1" cellspacing="0" cellpadding="5" class="clear tdborder">
		  <tr>
			<td width="140" align="center">Image</td>
			<td>Description</td>
		    <td width="100" align="center">Position</td>
		    <td width="100" align="center">Action</td>
		  </tr>
		  <?foreach($QUERY as $ROWS){?>
			  <tr>
				<td align="center"><img src="<?=$this->path.$ROWS[sno]."-".$ROWS[imagename];?>" border="0" height="60"></td>
				<td><?=$ROWS[name];?><br /><?=config::tagdisplay($ROWS,1);?></td>
			    <td align="center"><input name="chk_<?=$ROWS[sno];?>" type="text" size="3" value="<?=$ROWS[position];?>" style="height:20px;width:30px;"/></td>
			    <td align="center"><a href="?pg=<?=$this->pg;?>&amp;upd=<?=$ROWS[sno];?>&amp;albumid=<?=$this->albumid;?>&amp;albumtitle=<?=$this->albumtitle;?>#addalbum">Edit</a> | <a href="?pg=<?=$this->pg;?>&amp;delid=<?=$ROWS[sno];?>&amp;albumid=<?=$this->albumid;?>&amp;albumtitle=<?=$this->albumtitle;?>" onclick="javascript:return confirm('Do you really want to delete this photo?');">Delete</a></td>
			  </tr>
			  <?}?>
			  <tr>
			    <td align="center">&nbsp;</td>
			    <td align="center">&nbsp;</td>
			    <td align="center"><input type="submit" name="setposition" value="Set Position" class="button"/></td>
			    <td align="center">&nbsp;</td>
		  </tr>
		
</table>
		</form>

		<br class="clear"/><br class="clear"/>
		<hr class="linespace"/>
		<br class="clear"/><br class="clear"/>
	<?}else{?>

	<?=$errormessage;?>
	<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)" enctype="multipart/form-data">
	  <table width="592" border="0" cellpadding="5" bgcolor="#343434" class="tbborder">
        <tr class="heading">
          <td colspan="2"><?echo($this->upd==0)?"Add New":"Edit"?> Home Photo</td>
        </tr>
        <tr>
          <td width="101">Image <span class="manditory">(*)</span></td>
          <td width="307"><input name="filename" type="file" <?if(!strlen($UPDATEROWS[imagename])){?>id="req__Please upload you photo"<?}?>/>
          <?if(strlen($UPDATEROWS[imagename])){?>
				<img src="<?=$this->path.$UPDATEROWS[sno]."-".$UPDATEROWS[imagename];?>" height="50">
		  <?}?></td>
        </tr>
		<tr>
		  <td>Name <span class="manditory">(*)</span></td>
		  <td><input name="shall_name" type="text" size="50" value="<?=stripslashes($UPDATEROWS[name]);?>" id="req__Please enter photo name"/></td>
	    </tr>
		<tr>
          <td>Country <span class="manditory">(*)</span></td>
		  <td><select name="shall_country" style="width:250px;" onchange="ajax('?pg=ajax&amp;country='+this.value,'citydisplayid');" id="req__Please select country name">
              <?
			ob_start();
			include("country.txt");
			$defaultval=ob_get_contents();
			ob_clean();
			if(strlen($UPDATEROWS[country])){
				$defaultval=str_replace(' selected="selected"','',$defaultval);
				$defaultval=str_replace(">$UPDATEROWS[country]"," selected='selected'>$UPDATEROWS[country]",$defaultval);
			}
			echo $defaultval;?>
          </select></td>
	    </tr>
		<tr>
          <td>City <span class="manditory">(*)</span></td>
		  <td><span id="citydisplayid"><select name="shall_city" style="width:250px;" id="req__Please select city name">
              <option value="">==Please Select==</option>
              <?foreach($TAGQUERY as $TAGROWS){
		  	if($TAGROWS[typ]=="C" && $TAGROWS[reff]==$UPDATEROWS[country] && strlen($UPDATEROWS[city])){?>
              <option value="<?=$TAGROWS[title];?>" <?if($UPDATEROWS[city]==$TAGROWS[title]){echo "selected";}?>>
              <?=$TAGROWS[title];?>
              </option>
              <?}
		  }?>
            </select></span>
              <input name="addnewcity" type="button" onclick="window.location.href='?pg=tags&amp;typ=C&amp;upd=0&red=<?=$this->pg;?>&altid=<?=$this->upd;?>';" value="Add New +"/></td>
	    </tr>
		<tr>
          <td>Date</td>
		  <td><script>DateInput('tagdate', true, 'DD-MON-YYYY',"<?=$UPDATEROWS[tagdate];?>")</script></td>
	    </tr>
		<tr>
          <td>Religion</td>
		  <td><select name="shall_religion" style="width:250px;">
              <option value="">==Please Select==</option>
              <?foreach($TAGQUERY as $TAGROWS){
		  	if($TAGROWS[typ]=="R"){?>
              <option value="<?=$TAGROWS[title];?>" <?if($UPDATEROWS[religion]==$TAGROWS[title]){echo "selected";}?>>
              <?=$TAGROWS[title];?>
              </option>
              <?}
		  }?>
            </select>
              <input name="addnewrelegion" type="button" onclick="window.location.href='?pg=tags&amp;typ=R&amp;upd=0&red=<?=$this->pg;?>&altid=<?=$this->upd;?>';" value="Add New +"/></td>
	    </tr>
		<tr>
          <td>Camera</td>
		  <td><select name="shall_camera" style="width:250px;">
              <option value="">==Please Select==</option>
              <?foreach($TAGQUERY as $TAGROWS){
		  	if($TAGROWS[typ]=="P"){?>
              <option value="<?=$TAGROWS[title];?>" <?if($UPDATEROWS[camera]==$TAGROWS[title]){echo "selected";}?>>
              <?=$TAGROWS[title];?>
              </option>
              <?}
		  }?>
            </select>
              <input name="addnewcamera" type="button" onclick="window.location.href='?pg=tags&amp;typ=P&amp;upd=0&red=<?=$this->pg;?>&altid=<?=$this->upd;?>';" value="Add New +"/></td>
	    </tr>
		<tr>
          <td>Lens</td>
		  <td><select name="shall_lens" style="width:250px;">
              <option value="">==Please Select==</option>
              <?foreach($TAGQUERY as $TAGROWS){
		  	if($TAGROWS[typ]=="L"){?>
              <option value="<?=$TAGROWS[title];?>" <?if($UPDATEROWS[lens]==$TAGROWS[title]){echo "selected";}?>>
              <?=$TAGROWS[title];?>
              </option>
              <?}
		  }?>
            </select>
              <input name="addnewlens" type="button" onclick="window.location.href='?pg=tags&amp;typ=L&amp;upd=0&red=<?=$this->pg;?>&altid=<?=$this->upd;?>';" value="Add New +"/></td>
	    </tr>
		<tr>
          <td>Films</td>
		  <td><select name="shall_film" style="width:250px;">
              <option value="">==Please Select==</option>
              <?foreach($TAGQUERY as $TAGROWS){
		  	if($TAGROWS[typ]=="F"){?>
              <option value="<?=$TAGROWS[title];?>" <?if($UPDATEROWS[film]==$TAGROWS[title]){echo "selected";}?>>
              <?=$TAGROWS[title];?>
              </option>
              <?}
		  }?>
            </select>
              <input name="addnewfilms" type="button" onclick="window.location.href='?pg=tags&amp;typ=F&amp;upd=0&red=<?=$this->pg;?>&altid=<?=$this->upd;?>';" value="Add New +"/></td>
	    </tr>
		<tr>
          <td>Type Of Image </td>
		  <td><select name="shall_typeimg" style="width:250px;">
              <option value="">==Please Select==</option>
              <?foreach($TAGQUERY as $TAGROWS){
		  	if($TAGROWS[typ]=="I"){?>
              <option value="<?=$TAGROWS[title];?>" <?if($UPDATEROWS[typeimg]==$TAGROWS[title]){echo "selected";}?>>
              <?=$TAGROWS[title];?>
              </option>
              <?}
		  }?>
          </select></td>
	    </tr>
		
		<tr>
          <td></td>
          <td>
		  <input type="hidden" name="shall_status" value="0" />
		  <input type="submit" name="submit" value="SUBMIT"  class="button" />
&nbsp;&nbsp;&nbsp;
<input type="button" name="Button" value="Cancel" onclick="window.location.href='?pg=<?=$this->pg;?>'" class="button" /></td>
        </tr>
      </table>
	</form>
<a name="addalbum"></a>
<?}?>
<?if(strlen($_GET[success])){?>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script>
		  $(document).ready(function(){
		   setTimeout(function(){
		  $("div.successmessage").fadeOut("slow", function () {
		  $("div.successmessage").remove();
			  });
		
		}, 11000);
		 });
		 </script>
<?}?>
<div style="padding-top:150px"></div>