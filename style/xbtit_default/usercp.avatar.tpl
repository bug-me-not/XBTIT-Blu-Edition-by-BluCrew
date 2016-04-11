<div align=center>
<if:already_upload>
	<h5><tag:language.AV_NO_HEADER /></h5>
	<table class="lista" width="350" cellspacing="1" cellpadding="6">
		<tr>
			<td class="header"><tag:language.AV_NO_1 /></td>
		</tr>
		<tr>
			<td class="lista"><br /><center>
							  <img src="avatar/<tag:recent_avatar />" /></center>
							  <br /><tag:language.AV_NO_3 />: <a href="<tag:link_to_file />"><tag:link_to_file /></a><br /></td>
		</tr>
		<tr>
			<td class="lista" style="height:30px;"><center><a href="<tag:delete_image />"><tag:language.AV_NO_2 /></a></center></td>
		</tr>
	</table>
<else:already_upload>
	<if:notif>
		<h5><tag:notif_msg /></h5>
		<br />
	<else:notif>
	</if:notif>
	
	<table width="350" border="0">
		<tr>
			<td width="100%" align="left">
			<tag:language.AV_FEW_HEAD />
			<ul>
				<li><tag:language.AV_FILE_SIZE /> <tag:max_file_size /> kb</li>
				<li><tag:language.AV_IMAGE_SIZE /> <tag:max_image_width /> x <tag:max_image_height /></li>
				<li><tag:language.AV_FORBIDDEN /></li>
			</ul>
			</td>
		</tr>
	</table>
	
	<form enctype="multipart/form-data" method="post" action="<tag:form_action />">     
	<table class="lista" width="350" cellspacing="1" cellpadding="6">
		<tr>
			<td class="header" colspan="2"><tag:language.MNU_UCP_AVATAR /></td>
		</tr>
		<tr>
			<td class="header" width="80"><tag:language.FILE />:</td>
			<td class="lista"><input type="file" name="objUpload" class="btn"  /></td>
		</tr>
		<tr>
			<td class="lista" colspan="2"><center><input type="submit" value="<tag:language.MNU_UPLOAD />" class="btn" /></center></td>
		</tr>
	</table>
	</form>
</if:already_upload>
<br />
</div>