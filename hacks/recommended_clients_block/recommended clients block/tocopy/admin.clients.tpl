<form method="post" enctype="multipart/form-data" action="<tag:frm_action />" name="clients">
  <table class="header" width="100%" align="center">

		<tr>
			<td class="header" colspan="5" width="100%"align="center"><b>Clients to show in the block</b></td>
        </tr>

        <tr>
  			<td class="header" width="20%" align="left"><b>Client Name</b></td>
			<td class="lista"><input type="text" name="client_name" size="40"></td>
		</tr>

        <tr>
  			<td class="header" width="20%" align="left"><b>Client Web Link</b>	<br />

			<td class="lista"><input type="text" name="client_link" size="40"> ( url including http:// )</td>
		</tr>

        <tr>
  			<td class="header" width="20%" align="left"><b>Client Picture Link</b></td>
			<td class="lista"><input type="file" name="client_image" class="btn" size="40"></td>
		</tr>

		<tr>
			<td class="lista" colspan="2"><center>
										  <input type="submit" class="btn" value="<tag:language.FRM_CONFIRM />">
										  &nbsp;&nbsp;&nbsp;
										  <input type="reset" class="btn" value="<tag:language.FRM_CANCEL />">
										  </center></td>
		</tr>






  </table>
</form>
  <table class="header" width="100%" align="center">


    <tr>
    <td class="header"><b>Client Name</b></td>
    <td class="header"><b>Client Link</b></td>
    <td class="header"><b>Client Image</b></td>
    <td class="header"><b>Client Sort</b></td>
    <td class="header"><b>Delete</b></td>
  </tr>

    <loop:clients>
  <tr>
    <td class="lista"><tag:clients[].name /></td>
    <td class="lista"><tag:clients[].link /></td>
    <td class="lista"><img src=images/btclients/<tag:clients[].image />></td>
    <td class="lista"><tag:clients[].sort /></td>
    <td class="lista" align="center"><tag:clients[].delete /></td>
  </tr>
  </loop:clients>


 </table>
