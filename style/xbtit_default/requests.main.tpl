<if:view_requests>
<div id='requests'>
	<center><h2><tag:req_welcome /></h2></center>
	<div class='new user' style='overflow: hidden;'>
		<div id='myreq' align='center'>
			<form method="get" action>
				<input type='hidden' name='page' value='requests'>
				<input type='hidden' name='uid' value='<tag:uid />'>
				<input type='submit' class='btn btn-sm btn-primary' value='<tag:language.TRAV_VMR />'>
			</form>
			<form method='get' action>
				<input type='hidden' name='page' value='requests'>
				<input type='hidden' name='action' value='createreq'>
				<input type='submit' class='btn btn-sm btn-primary' value='<tag:language.TRAV_ANR />'>
			</form>
		</div>
	</div>
	<br><div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Options</h4>
</div>
	<div id='req_search' class='lista'>
		<form method='get' action>
			<input type='hidden' name='page' value='requests'>
			<input type='hidden' name='action' value='search'>
			<table cellpadding="6" cellspacing="1" border="0" class="border" width="">
				<tbody>
					<tr>
						<td><h1><tag:language.TRAV_REQ_NAME /></h1></td>
						<td><input type='text' name='title' class='form-control' size='40' placeholder="<tag:language.TRAV_SEARCH_TITLE />" value="<tag:title_value />"></td>
					</tr>
					<tr>
						<td><h1><tag:language.TRAV_SELCAT /></h1></td>
						<td><tag:category /></td>
					</tr>
					<tr>
						<td><h1><tag:language.TRAV_HIDE_FILLED /></h1></td>
						<td><input type='checkbox' name='hfilled' <tag:hfillcheck /> ></td>
					</tr>
					<tr>
						<td><h1><tag:language.TRAV_HIDE_TAKEN /></h1></td>
						<td><input type='checkbox' name='htaken' <tag:htakencheck /> ></td>
					</tr>
					<tr>
						<td><h1><tag:language.TRAV_SORTBY /></h1></td>
						<td> 
							<select name='col'> 
								<option value='name' <tag:col_name /> ><tag:language.TRAV_NAME /></option>
								<option value='views' <tag:col_views /> ><tag:language.TRAV_VIEWS /></option>
								<option value='bon' <tag:col_bon /> ><tag:language.TRAV_BON /></option>
							</select>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<select name='order'>
								<option value='ASC' <tag:order_asc /> ><tag:language.TRAV_ASC /></option>
								<option value='DESC' <tag:order_desc /> ><tag:language.TRAV_DESC /></option>
							</select> 
						</td>
					</tr>
					<tr><td colspan='2'><input type='submit' class='btn btn-sm btn-primary' value='<tag:language.TRAV_SEARCH />'></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div class="panel-footer">
</div>
</div>

	<br>
	<div id='req_view'>
		<if:has_requests>
		<div class="panel panel-default">
   <div class="panel-heading">
      <h4>Requests Table</h4>
   </div>
   <div class="panel-body">
      <table class="table table-bordered">
			<thead>
				<tr>
					<th><tag:language.TRAV_JTAKEN /></th>
					<th><tag:language.CATEGORY_FULL /></th>
					<th><tag:language.TRAV_REQ_NAME /></th>
					<th><tag:language.TRAV_REQ_BY /></th>
					<th><tag:language.TRAV_FILLED /></th>
					<th><tag:language.TRAV_BON /></th>
					<th><tag:language.TRAV_MANAGE /></th>
				</tr>
			</thead>
			<tbody>
				<loop:reqdata>
				<tr>
					<td>
						<tag:reqdata[].job />
					</td>
					<td>
						<a href='index.php?page=torrents&amp;category=<tag:reqdata[].catid />'><tag:reqdata[].catimg /></a>
					</td>
					<td><a href='index.php?page=requests&amp;action=viewreq&amp;id=<tag:reqdata[].req_id />'><tag:reqdata[].reqname /></a></td>
					<td> 
						<a href='index.php?page=userdetails&amp;id=<tag:reqdata[].req_uid />'><tag:reqdata[].req_by /></a>
						<br>
						<tag:reqdata[].req_when />
					</td>
					<td> 
						<tag:reqdata[].filled />
					</td>
					<td>
						<tag:reqdata[].bon /> <tag:language.TRAV_BON1 />
						<br>
						<tag:language.by /> <tag:reqdata[].voters /> <tag:language.TRAV_VOTERS />
					</td>
					<td> 
						<tag:reqdata[].access />
					</td>
				</tr>
			</loop:reqdata>
		</tbody>
	</table>
	<else:has_requests>
	<span><strong><tag:language.TRAV_NOWTFOUND /></strong></span>
</if:has_requests>
</div>
<br>
<div class='pager'>
	<tag:bottom_pager />
</div>
</div>
<else:view_requests>
<tag:requests_content />
</if:view_requests>