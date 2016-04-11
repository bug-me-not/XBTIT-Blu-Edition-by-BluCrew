<style>
textarea#glow{
color:#666;
font-size:14px;
-moz-border-radius: 8px; -webkit-border-radius: 8px;
margin:5px 0px 10px 0px;
padding:10px;
height:300px;
width:95%;
border:#999 1px solid;
font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
transition: all 0.25s ease-in-out;
-webkit-transition: all 0.25s ease-in-out;
-moz-transition: all 0.25s ease-in-out;
box-shadow: 0 0 5px rgba(81, 203, 238, 0);
-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
}
textarea#glow:focus{
color:#000;
outline:none;
border:#FF0022 2px solid;
font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
box-shadow: 0 0 5px rgba(81, 203, 238, 1);
-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
}
input#glow:focus{
color:#000;
outline:none;
border:#FF0022 2px solid;
font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size:14px;
box-shadow: 0 0 5px rgba(81, 203, 238, 1);
-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
}
input#glow{
color:#666;
font-size:14px;
-moz-border-radius: 8px; -webkit-border-radius: 8px;
margin:5px 0px 10px 0px;
padding:10px;
height:16px;
width:92%;
border:#999 1px solid;
font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
transition: all 0.25s ease-in-out;
-webkit-transition: all 0.25s ease-in-out;
-moz-transition: all 0.25s ease-in-out;
box-shadow: 0 0 5px rgba(81, 203, 238, 0);
-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 0);
}
input#line:focus{
color:#000;
outline:none;
border:#FF0022 2px solid;
font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size:14px;
box-shadow: 0 0 5px rgba(81, 203, 238, 1);
-webkit-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
-moz-box-shadow: 0 0 5px rgba(81, 203, 238, 1);
}
table#inputs
{
table-layout:fixed;
}
</style>
<table width="100%" valign="top">
<tr>
<td align="center" class="lista">
<div align="center" style="float:center;">
<textarea cols=100 rows=20 id="glow">
<if:error_log_exists>
<loop:error_logs>
<tag:error_logs[].line />
</loop:error_logs>
</if:error_log_exists>
</textarea>
</div>
<table width="100%" valign="top" id="inputs">
<form method="POST" action="<tag:frm_action />">
<tr>
<td colspan="2" class="header" style="text-align:center;"><tag:language.LOGS_LINE_AMT />&nbsp;<input type="text" id="line" name="php_log_lines" value="<tag:config.php_log_lines />" size="2">&nbsp;<tag:language.LOGS_LINE_AMT_1 /></td>
</tr>
<tr>
      <td class="header" width="50%"><tag:language.LOGS_COOLY_NAME /></td>
      
	  <td class="header" width="50%"><tag:language.LOGS_COOLY_PATH /></td>
      
    </tr>
<tr>
      
      <td class="lista" style="text-align:center;" width="50%"><input id="glow" type="text" name="php_log_name" value="<tag:config.php_log_name />" size="50" /><br />
	  <tag:language.LOGS_COOLY_NAMES /></td>
	  
      <td class="lista" style="text-align:center;" width="50%"><input id="glow" type="text" name="php_log_path" value="<tag:config.php_log_path />" size="50" />
	  <br /><tag:language.LOGS_COOLY_PATHS />&nbsp;<b><span style="color:red;"><tag:config.php_log_path_find /></span></b>
	  </td>
    </tr>
	 <tr>
      <td align="center" class="header"><input type="submit" name="write" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
      <td align="center" class="header"><input type="submit" name="cancel" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
    </tr>
</form>
</table>
<div style="float-center" align="center"><tag:language.LOGS_COOLY_NOTE /></div>
<table width=100%>
<tr>
      <td class="header" colspan="2" style="text-align:center;"><tag:language.LOGS_COOLY_LIST /></td>
	  </tr>
	  <tr>
	  <td class="lista"style="text-align:center;"><loop:list><tag:list[].file /></loop:list></td>
	  </tr>
	  <tr>
	  <td class="header" style="text-align:center;"><tag:flush /></td>
	  </table>
</td>
</tr>
</table>