<if:CHECK4>
<if:CHECK>
<form method="post" action="<tag:link />">
<table>
	<tr>
		<td>Info hash:</td>
		<td><tag:info_hash /></td>
	</tr>
	<tr>
		<td>File name:</td>
		<td><tag:filename /></td>
	</tr>
	<tr>
		<td>Uploader:</td>
		<td><tag:uploader /></td>
	</tr>
	
	<tr>
		<td>
		Enter reason:
		</td>
	</tr>
	<tr>
		<td>
		<div id='description' style=" background:#fff; padding:3px; border:1px solid #999999; font-family:Verdana; font-size:12px;"></div>
		</td>
	</tr>
	<tr>
		<td>
		<textarea name='msg' style="width:350px; height:150px; border:1px solid #999999; font-family:Verdana; font-size:12px;"></textarea>
		</td>
	</tr>
	
	<tr>
		<td>
		Select reason:
		</td>
	</tr>
	<tr>
		<td>
		<tag:moderate_reasons />
		</td>
	</tr>
	<tr>
		<td>
			<input value="Send" type="submit" />
		</td>
	</tr>
<if:SENDED><tr><td><tag:message /></td></tr></if:SENDED>
<if:NO_SENDED><tr><td><tag:message2 /></td></tr></if:NO_SENDED>
</table>
</form>
</if:CHECK>
<if:CHECK2>Bad ID</if:CHECK2>
<if:CHECK3><tag:selecting /></if:CHECK3>
<if:CHECK5>
<table><tr>
<if:CHECK6>
<td>You modered torrent.</td>
<else:CHECK6>
<if:CHECK8>
<td><tag:info_hash2 /></td>
<td><tag:filename2 /></td>
<td><tag:uploader2 /></td>
<td><tag:editing /></td>
</if:CHECK8>
</if:CHECK6>
</tr></table>
</if:CHECK5>
<else:CHECK4>You're not authorized to access the moder panel!</if:CHECK4>
<a href="<tag:return />">Return Back</a>