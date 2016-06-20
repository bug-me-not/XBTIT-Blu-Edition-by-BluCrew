<div id='createreq'>
	<div>
		<script type='text/javascript'>
		//Source: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt
		filterInt = function (value) 
		{
			if(/^(\-|\+)?([0-9]+)$/.test(value))
				return true;
			return false;
		}

		function CheckRequest()
		{
			var req = document.getElementsByName('reqtitle')[0];
			if (req.value.length == 0)
			{
				alert('You must specify a title for the request.');
				req.focus();
				return false;
			}

			var cat = document.getElementsByName('category')[0];
			if(cat.value == 0)
			{
				alert("You need to specify a category.");
				cat.focus();
				return false;
			}

			var imdb = document.getElementsByName('imdb')[0];
			if(!filterInt(imdb.value))
			{
				alert("Please fill IMDB. Otherwise enter 0 if not available.");
				imdb.focus();
				return false;
			}

			var tvdb = document.getElementsByName('tvdb')[0];
			if(!filterInt(tvdb.value))
			{
				alert("Please fill TVDB ID. Otherwise enter 0 if not available.");
				imdb.focus();
				return false;
			}

			var desc = document.getElementsByName('description')[0];
			if(desc.value.length == 0)
			{
				var sure = confirm("Are you sure you want to add no description?");
				if(sure == false)
				{
					desc.focus();
					return false;
				}
			}

			return true;
		}
	</script>
</div>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Request Guidelines</h4>
</div>
Please Be Sure To Add Proper IMDB ID If Movie and or Proper TVDB ID is TV Show</br>Please Be Sure To Enter A Proper Description In Detail As To What It Is You Are Requesting</br>Please Be Sure To Enter A Proper Title For Your Request (Title)(Year)(Resolution)(Format)</br>It Cost <tag:aBON /> BON To Make A Request In Which It Is Added As A Bounty
<div class="panel-footer">
</div>
</br>
<div class='header' align='center'>
	<h2><tag:header /></h2>
</div>
<form action='<tag:url />' method='post' class='lista' onsubmit='return CheckRequest();'>
<table align='center' width='100%' cellspacing='2'>
	<div>
		<input type='hidden' name='uid' value='<tag:uid />'>
		<input type='hidden' name='auth' value='<tag:uid_auth />'>
		<input type='hidden' name='req_id' value='<tag:req_id />'>
	</div>
	<tr>
		<td> 
			<tag:language.TRAV_REQ_NAME />
		</td>
		<td> 
			<input type='text' name='reqtitle' size='75' class='form-control' value='<tag:reqtitle />'>
		</td>
	</tr>
	<tr>
		<td>
			<tag:language.TRAV_CATEG />
		</td>
		<td> 
			<tag:category />
		</td>
	</tr>
	<tr>
		<td>
			<tag:language.IMDB_SEARCH /> <tag:language.NOTE_ID />
		</td>
		<td> 
			<input type="text" name="imdb" size='10' class='form-control' value='<tag:imdb />'>
		</td>
	</tr>
	<tr>
		<td>
			<tag:language.TVDB /> <tag:language.NOTE_ID />
		</td>
		<td>
			<input type='text' name='tvdb' size='10' class='form-control' value='<tag:tvdb />'>
		</td>
	</tr>
	<tr>
		<td>
			<tag:language.DESCRIPTION />
		</td>
		<td>
			<textarea rows='7' cols='60' name='description' class='form-control'><tag:description /></textarea>
		</td>
	</tr>
	</div>
	<tr>
		<td colspan='2'>
			<center><input type='submit' class='btn btn-primary' value='<tag:language.TRAV_AR />'></center>
		</td>
	</tr>
    </form>
   </table>
     </div>
 