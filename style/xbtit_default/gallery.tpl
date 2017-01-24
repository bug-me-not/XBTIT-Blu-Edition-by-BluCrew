<br><br><br>

<table>
	<thead>
		<tr>
			<td colspan='2'>Search</td>
		</tr>
	</thead>
	<tbody>
		<form action='index.php?page=modules&amp;module=gallery' method='GET'>
		<input type='hidden' name='action' value='search'>
			<tr>
				<td>Name</td> 
				<td><input type='text' name='name' value='' size='40'></td>
			</tr>
			<tr>
				<td>IMDB ID</td> 
				<td><input type='text' name='imdb' value='0' placeholder='tt1234567' size='10'></td>
			</tr>
			<tr>
				<td>Cover Type</td>
				<td>
					<select name='type'>
						<option value='both'>Both</option>
						<option value='banners'>Banners</option>
						<option value='posters'>Posters</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Uploader</td>
				<td>
					<select name='uploader'>
						<option value='both'>Both</option>
						<option value='system'>System</option>
						<option value='user'>User</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2'><button type='submit'>Search</button></td>
			</tr>
		</form>
	</tbody>
</table>

<br><br><br>

<if:has_images>
<div class='container'>
	<div class='row'>

		<loop:images>

		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a title='<tag:images[].count />' href='<tag:images[].href />' target="_blank" class='thumbnail'>
			<img class="img-responsive" src="<tag:images[].href />" alt="<tag:images[].name />" >
		</a>
	</div>

</loop:images>

</div>
</div>
<else:has_images>
<div><center>There are no images to display.</center></div>
</if:has_images>

<br><br><br>

<div align='center'><center>Coded for BluRG.</center></div>