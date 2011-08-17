<?if($this->pg=="chngpass"){?>
<div class="breadcrumb"><a href="?">Home</a> &raquo; <span>Change Password</span></div><br/><br/><br/><br/>
<?}?>
<form name="form1" method="post" action="" onsubmit="return dynamic_form_validation(this)">
<?if($this->pg=="lgn"){?>
<div style="padding:150px 0px 240px 0px" align="center">
	<img src="images/logo.gif" border="0" /><br/><br/><br/><br/>

<table width="360" border="0" align="center" cellpadding="5" bgcolor="#343434" class="tbborder">
<tr><td colspan="2" class="heading"><b>Login Your Account</b></td></tr>
<tr><td width="127" align="left" valign="top">User Name </td>
<td width="232"><input name="username" class="input" type="text" id="req__Please enter username" size="30"></td></tr>
<tr><td align="left" valign="top">Password</td>
<td><input name="password" type="password" class="input" id="req__Please enter login password" size="30"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="login" value="Submit" class="button"></td></tr>
<tr><td colspan="2" align="right"><a href="?pg=fgt">Forgot Password ?</a></td></tr></table>
</div>


<?}elseif($this->pg=="fgt"){?>
<div style="padding:150px 0px 240px 0px" align="center">
	<img src="images/logo.gif" border="0" /><br/><br/><br/><br/>
	<table width="444" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#343434" class="tbborder">
	  <tr class="heading">
		<td colspan="3">Forgot Password</td>
	  </tr>
	  <tr>
		<td> EMAIL ID&nbsp;</td>
		<td align="center"><input name="fgtemailid" type="text" class="input" id="req_Email-id_Please enter your email id" size="40"/></td>
		<td><input type="submit" name="Submit" value="Submit" class="button"/></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td colspan="2" align="right"><a href="?pg=lgn">Login Your Account? </a> </td>
	  </tr>
	</table>
</div>
<?}else{?>
<table width="380" border="0" align="center" cellpadding="5" bgcolor="#343434" class="tbborder">
<tr><td colspan="2" class="heading">Change Password</td></tr>
<?if(strlen($error)){?>
	<tr><td colspan="2" style="color:#FFFFFF;font-weight:bold;"><?=$error;?></td></tr>
<?}?>
<tr><td width="238">Old Password</td>
<td width="236"><input name="oldpass" type="password" id="req__Please enter your old password"></td></tr>
<tr><td>New Password</td><td><input name="newpassword" type="password" id="req__Please enter your new password"></td></tr>
<tr><td>Confirm New Password</td><td><input name="cpassword" type="password"  id="req__Please enter your Confirm password"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Submit" class="button">
&nbsp;&nbsp;&nbsp;
<input type="button" name="Button" value="Cancel" class="button" onclick="window.location.href='?'"/>
</td></tr></table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<?}?>

</form>