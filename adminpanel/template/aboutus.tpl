<div class="breadcrumb flLt"><a href="?">Home</a> &raquo; <a href="#">About</a> &raquo; <span>Page Content</span></div>
<div class="flRt"><a href="?pg=about">Page Content</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <a href="?pg=showcase">Showcase</a></div>
<br class="clear">
	
	<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)" enctype="multipart/form-data">
	  <table width="100%" border="0" cellpadding="5" bgcolor="#343434" cellspacing="0" class="tbborder">
	    <tr class="heading">
	      <td colspan="2">About  Content</td>
        </tr>
		<tr>
		  <td colspan="2"><?config:: fckeditor("",stripslashes($ROWS[content]),690,400,"shall_content");?></td>
	    </tr>
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