<div class="breadcrumb flLt"><a href="?">Home</a> &raquo; <a href="#">About</a> &raquo; <span>ShowCase</span></div>
<div class="flRt"><a href="?pg=about">Page Content</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <a href="?pg=showcase">Showcase</a></div>
<br class="clear">


	<?if(!strlen($this->upd)){?>
		<div class="addnew"><a href="?pg=<?=$this->pg;?>&amp;upd=0">Add New ShowCase</a></div>
		<?if(strlen($_GET[success])){?>
			<div class="successmessage"><?=$message;?></div>
		<?}?>	
		<form action="" method="post" name="position"><table width="100%" border="1" cellspacing="0" cellpadding="5" class="clear tdborder">
		  <tr>
			<td width="110" align="center">File / Link Name</td>
			<td>Title</td>
			<td width="60" align="center">Position</td>
		    <td width="160" align="center">Action</td>
		  </tr>
		<?foreach($QUERY as $ROWS){?>
			  <tr>
				<td align="center">
				<?if($ROWS[typ]=="L" && strstr($ROWS[filename],'.')){?>
					<a href="<?=$ROWS[filename];?>" target="_blank"><?=$ROWS[filename];?></a>
				<?}elseif($ROWS[typ]!="L"){?>
					<a href="<?=$this->path.$ROWS[sno]."-".$ROWS[filename];?>" target="_blank"><?=$ROWS[filename];?></a>
				<?}?>
				</td>
				<td><?=$ROWS[title];?></td>
				<td align="center"><input name="chk_<?=$ROWS[sno];?>" type="text" size="3" value="<?=$ROWS[position];?>" style="height:20px;width:30px;"/></td>
			    <td align="center"><a href="?pg=<?=$this->pg;?>&amp;upd=<?=$ROWS[sno];?>">Edit</a> | <a href="?pg=<?=$this->pg;?>&amp;delid=<?=$ROWS[sno];?>&img=<?=$ROWS[imagename];?>" onclick="javascript:return confirm('Do you really want to delete this record?');">Delete</a></td>
			  </tr>
			  <?}?>
			  <tr>
			    <td align="center">&nbsp;</td>
			    <td>&nbsp;</td>
			    <td align="center"><input type="submit" name="setposition" value="Set Position" class="button"/></td>
			    <td align="center">&nbsp;</td>
		  </tr>
		</table>
		</form>
		<br class="clear"/><br class="clear"/>
		<hr class="linespace"/>
		<br class="clear"/><br class="clear"/>
	<?}else{?>	
		<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)" enctype="multipart/form-data">
		<table width="624" border="0" cellpadding="5" bgcolor="#343434" class="tbborder">
		<tr class="heading">
		  <td colspan="2"><?echo($this->upd==0)?"Add New":"Edit"?> ShowCase</td>
		</tr>
		<tr>
		  <td width="129">Type</td>
		  <td width="469"><select name="shall_typ" onchange="showcase(this.value);">
		  <option value="F">File Upload</option>
		  <option value="L" <?if($UPDATEROWS[typ]=="L")echo "selected"?>>Website Link</option>
          </select></td>
		  </tr>
		<tr>
		  <td>Title <span class="manditory">(*)</span></td>
		  <td><input name="shall_title" type="text" class="input" id="req__Please enter Title" size="30" style="width:400px;" value="<?=stripslashes($UPDATEROWS[title]);?>"/></td>
		  </tr>
		<tr id="linkdisplay" <?=$linkdisplay?>>
		  <td>Website Link</td>
		  <td><input name="linkname" type="text" class="input" id="shall_link" size="30" style="width:400px;" value="<?=stripslashes($UPDATEROWS[filename]);?>"/></td>
		  </tr>
		<tr id="filedisplay" <?=$filedisplay?>>
		  <td>Upload File</td>
		  <td><input name="filename" id="filename" type="file"/><?=$filename;?></td>
		  </tr>
		<tr><td></td><td><input type="submit" name="submit" value="SUBMIT"  class="button">
		&nbsp;&nbsp;&nbsp;
			  <input type="button" name="Button" value="Cancel" class="button" onclick="window.location.href='?pg=<?=$this->pg;?>'"/></td></tr></table>
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