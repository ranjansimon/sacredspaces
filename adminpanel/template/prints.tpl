<div class="breadcrumb flLt"><a href="?">Home</a> &raquo; <span>Prints</span></div>
<br class="clear">
	<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)" enctype="multipart/form-data">
	  <div align="center" style="padding-left:8px">
	  <?config:: fckeditor("",stripslashes($ROWS[content]),685,400,"shall_content");?><br /><br />
	  <input type="submit" name="submit" value="SUBMIT"  class="button" /></div>
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
<div style="padding-top:50px"></div>