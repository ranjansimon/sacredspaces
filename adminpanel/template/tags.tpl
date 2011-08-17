<div class="breadcrumb flLt"><a href="?">Home</a> &raquo; <a href="#">Tags</a>  &raquo; <span><?=$tagary[$this->typ]?></span></div>
<div class="flRt decorationnone"><a href="?pg=<?=$this->pg;?>&typ=C">City</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="?pg=<?=$this->pg;?>&typ=R">Religion</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="?pg=<?=$this->pg;?>&typ=P">Camera</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="?pg=<?=$this->pg;?>&typ=L">Lens</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="?pg=<?=$this->pg;?>&typ=F">Film</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="?pg=<?=$this->pg;?>&typ=I">Type of Image</a></div>
<br class="clear">	
	<?if(count($QUERY) && !strlen($this->upd)){?>
		<div style="padding:18px 0 0 10px"><a href="?pg=<?=$this->pg;?>&upd=0&typ=<?=$this->typ;?>">Add New <?=$tagary[$this->typ]?> Tag </a></div>
		<?if(strlen($_GET[success])){?>
			<div class="successmessage"><?=$message;?></div>
		<?}?>
		<form action="" method="post" name="position" class="pad10"><table border="1" cellspacing="0" cellpadding="5" class="clear tdborder">
		  <tr>
			<td width="200"><?=$tagary[$this->typ]?> Name</td>
		    <?if($this->typ=="C"){?>
				<td width="200">Country</td>
			<?}?>
			<td width="100" align="center">Action</td>
		  </tr>
		  <?foreach($QUERY as $ROWS){?>
			  <tr>
				<td><?=stripslashes($ROWS[title]);?></td>
				<?if($this->typ=="C"){?>
					<td><?=$ROWS[reff];?></td>
				<?}?>
			    <td align="center"><a href="?pg=<?=$this->pg;?>&amp;upd=<?=$ROWS[sno];?>&amp;typ=<?=$this->typ;?>">Edit</a> | <a href="?pg=<?=$this->pg;?>&amp;delid=<?=$ROWS[sno];?>&amp;typ=<?=$this->typ;?>" onclick="javascript:return confirm('Do you really want to delete this record?');">Delete</a></td>
			  </tr>
			  <?}?>
		
</table>
		</form>

		<br class="clear"/><br class="clear"/>
		<br class="clear"/><br class="clear"/>
	<?}else{?>

	<br class="clear">
	<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)">
	  <table width="434" border="0" cellpadding="5" bgcolor="#343434" class="tbborder">
        <tr class="heading">
          <td colspan="2"><?echo($this->upd==0)?"Add New":"Edit"?> <?=$tagary[$this->typ]?> Tag </td>
        </tr>
		<?if($this->typ=="C"){?>
			<tr><td>Country <span class="manditory">(*)</span></td><td>
			<select name="shall_reff" style="width:280px;" id="req__Please select Country Name">
			<?
			ob_start();
			include("country.txt");
			$defaultval=ob_get_contents();
			ob_clean();
			if(strlen($UPDATEROWS[reff])){
				$defaultval=str_replace(' selected="selected"','',$defaultval);
				$defaultval=str_replace(">$UPDATEROWS[reff]"," selected='selected'>$UPDATEROWS[reff]",$defaultval);
			}
			echo $defaultval;?>
			</select>
			</td></tr>
		<?}?>
		<tr>
		  <td width="101"><?=$tagary[$this->typ]?> Name <span class="manditory">(*)</span></td>
		  <td width="307"><input name="shall_title" type="text" style="width:280px;" value="<?=stripslashes($UPDATEROWS[title]);?>" id="req__Please enter <?=$tagary[$this->typ]?> Name"/>
		  <input name="oldtag" type="hidden" value="<?=stripslashes($UPDATEROWS[title]);?>"/></td>
	    </tr>
		<tr>
          <td></td>
          <td>
		  <input type="submit" name="submit" value="SUBMIT"  class="button" />
		  &nbsp;&nbsp;&nbsp;
			  <input type="button" class="button" name="Button" value="Cancel" onclick="window.location.href='<?=$cancle;?>'"/>
		  </td>
        </tr>
      </table>
	</form>
<a name="addalbum"></a>
<?}?>
<?if(strlen($_GET[success])){?>
	<script src="../js/jquery-latest.js"></script>
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