<link href="swfupload/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="swfupload/swfupload.js"></script>
<script type="text/javascript" src="swfupload/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "upload.php?gallery=<?=$this->albumtitle;?>&albumid=<?=$this->albumid;?>",
				post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

				// File Upload Settings
				file_size_limit : "2 MB",	// 2MB
				file_types : "*.jpg",
				file_types_description : "JPG Images",
				file_upload_limit : "0",

				// Event Handler Settings - these functions as defined in Handlers.js
				//  The handlers are not part of SWFUpload but are part of my website and control how
				//  my website reacts to the SWFUpload events.
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : "images/SmallSpyGlassWithTransperancy_17x18.png",
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 180,
				button_height: 18,
				button_text : '<span class="button">Upload Images <span class="buttonSmall">(2 MB Max)</span></span>',
				button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
				button_text_top_padding: 0,
				button_text_left_padding: 18,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,
				
				// Flash Settings
				flash_url : "swfupload/swfupload.swf",

				custom_settings : {
					upload_target : "divFileProgressContainer"
				},
				
				// Debug Settings
				debug: false
			});
		};
	</script>

	<?php
	if( !function_exists("imagecopyresampled") ){
		?>
	<div class="message">
		<h4><strong>Error:</strong> </h4>
		<p>Application Demo requires GD Library to be installed on your system.</p>
		<p>Usually you only have to uncomment <code>;extension=php_gd2.dll</code> by removing the semicolon <code>extension=php_gd2.dll</code> and making sure your extension_dir is pointing in the right place. <code>extension_dir = "c:\php\extensions"</code> in your php.ini file. For further reading please consult the <a href="http://ca3.php.net/manual/en/image.setup.php">PHP manual</a></p>
	</div>
	<?php
	} else {
	?>
		<table width="624" border="0" cellpadding="5" bgcolor="#343434" class="tbborder">
			<tr class="heading">
			  <td colspan="2">Upload Multiple Photo</td>
			</tr>
	
			<tr>
			  <td width="142">Select Multi Images </td>
			  <td width="456"><form>
			<div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
				<span id="spanButtonPlaceholder"></span></div>
		</form></td>
			</tr>
			
		  </table>
		  <div id="divFileProgressContainer" style="height: 75px;"></div>
		<div id="thumbnails"></div>	<?php
	}
	?>