<div class="breadcrumb flLt"><a href="?">Home</a> &raquo; <span>Cameras</span></div>
<br class="clear">
	
	<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)" enctype="multipart/form-data">
	  <table width="100%" border="0" cellpadding="5" bgcolor="#343434" cellspacing="0" class="tbborder">
	    <tr class="heading">
	      <td colspan="2">Cameras</td>
        </tr>
		<tr>
		  <td colspan="2">Block 1 Content </td>
	    </tr>
		<tr>
		  <td colspan="2"><?config:: fckeditor("",stripslashes($ROWS[block1]),690,400,"shall_block1");?></td>
	    </tr>
		<tr>
		  <td colspan="2">Block 2 Content </td>
	    </tr>
		<tr>
		  <td colspan="2"><?config::fckeditor("",stripslashes($ROWS[block2]),690,250,"shall_block2","1");?></td>
	    </tr>
		<!--tr>
		  <td colspan="2">Block 3 Content </td>
	    </tr>
		<tr>
		  <td colspan="2"><?//config::fckeditor("",stripslashes($ROWS[block3]),690,250,"shall_block3","1");?></td>
	    </tr>
		<tr>
          <td colspan="2">Block 4 Content </td>
	    </tr>
		<tr>
          <td colspan="2"><?//config::fckeditor("",stripslashes($ROWS[block4]),690,250,"shall_block4","1");?></td>
	    </tr-->
		<tr>
          <td width="101"></td>
          <td width="307">
		  <input type="submit" name="submit" value="SUBMIT"  class="button" /></td>
        </tr>
      </table>
	</form>

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