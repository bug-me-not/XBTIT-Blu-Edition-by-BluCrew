 	<!-- include the Tools -->
	<script src="/jscript/jquery.tools.min.js"></script>
 

<!-- the tabs -->
<ul class="tabs">
 	<li><a href="#home"><tag:language.HOME /></a></li> 
 	<li><a href="#url"><tag:language.REWRITE /></a></li> 
	<li><a href="#meta"><tag:language.META /></a></li> 
	<li><a href="#google"><tag:language.GOOGLE /></a></li>
	<li><a href="#sitemap"><tag:language.SITEMAP /></a></li> 
  
</ul>

<!-- tab "panes" -->
<div class="panes">
<!-- Pannel Home -->
	<div> 
 
      <table class="header" width="100%" align="center">    
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.WELCOME /></b></center></td>
      </tr>
 
      <tr>
   
      <td class="lista" colspan="3">  <div id="left_wrapper"> 
    <div id="left"><br /><img src="images/mod_rewrite_logo.gif"> <br />
  <p><tag:language.MSG1 /><br />
  <tag:language.MSG2 /><br />
  <tag:language.MSG3 />
  </p>
  </div>
  </div>
  <div id="middle_wrapper"> 
    <div id="middle">
  <p><tag:language.MSG4 /></p> 
    </div>
  </div>
 
  </div>
      </td>
      </tr>
  
      </table> </div>

<!-- Pannel Rewrite -->
	<div> 
      <form action="<tag:frm_action_rewrite />" method="post">
      <table class="header" width="100%" align="center">    
       <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.MSG5 /></b></center></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.TEST_MOD /></td>
      <td class="lista" colspan="3"> <tag:testrew /> </td>
      </tr>
 
      <tr>
      <td class="header"><tag:language.REWTITE_TORRENT /></td>
      <tag:seo />
      <td class="header"><tag:language.REWTITE_USER /></td>
      <tag:seo_user />
      </tr>
 
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.LETTERS_REPLACE /></td>
      <td class="lista" colspan="3"><textarea name="str" rows="1" cols="80"><tag:str /></textarea></td>
      </tr> 
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.REPLACE_TO /></td>
      <td class="lista" colspan="3"><textarea name="strto" rows="1" cols="80"><tag:strto /></textarea></td>
      </tr>
      <tr>
     <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.UPDATE_SETTINGS />" /></td>
     </tr></table></form></div>

<!-- Pannel meta -->
	<div> 
      <form action="<tag:frm_action_meta />" method="post">
      <table class="header" width="100%" align="center">    
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.OPTION_META /></b></center></td>
      </tr>
      <tr>
      <td class="header"><tag:language.URL_CANN /></td>
      <tag:cano />
      <td class="header"><tag:language.USE_META /></td>
      <tag:meta />
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.META_DESCRIPTION /></td>
      <td class="lista" colspan="3"><textarea name="metadesc" rows="1" cols="80"><tag:metadesc /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.META_KEYWORD /></td>
      <td class="lista" colspan="3"><textarea name="metakeyword" rows="1" cols="80"><tag:metakeyword /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.META_COPYRIGTT /></td>
      <td class="lista" colspan="3"><textarea name="copyright" rows="1" cols="80"><tag:copyright /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.META_AUT /></td>
      <td class="lista" colspan="3"><textarea name="author" rows="1" cols="80"><tag:author /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.META_ROBOTS /></td>
      <td class="lista" colspan="3"><textarea name="robots" rows="1" cols="80"><tag:robots /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.META_REVISIT /></td>
      <td class="lista" colspan="3"><textarea name="revisitafter" rows="1" cols="80"><tag:revisitafter /></textarea></td>
      </tr>  
      <tr>
     <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.UPDATE_SETTINGS />" /></td>
     </tr></table></form></div>
 

<!-- Panel googl tools -->
<div>
      <form action="<tag:frm_action_google />" method="post">
      <table class="header" width="100%" align="center">  
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.GOOGLE_TOOLS /></b></center></td>
      </tr>
      <tr>
      <td class="header"><tag:language.USE_GOOGLE_ANA /></td>
      <tag:analytic_active />
      <td class="header"><tag:language.USE_GOOGLE_WEBMASTER /></td>
      <tag:ggwebmaster_active />
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1">Code <a href="http://www.google.com/analytics/" target="_BLANK"><tag:language.GOOGLE_ANA /></td>
      <td class="lista" colspan="3"><textarea name="analytic" rows="1" cols="80"><tag:analytic /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.GOOGLE_CODE /></td>
      <td class="lista" colspan="3"><textarea name="ggwebmaster" rows="1" cols="80"><tag:ggwebmaster /></textarea></td>
      </tr>
      <tr>
     <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.UPDATE_SETTINGS />" /></td>
     </tr>
      </table>
      </form>
</div>
<!-- Pannel Sitemap-->
	<div> 
 
<form action="<tag:frm_action_optsitemap />" method="post">
 <table class="header" width="100%" align="center">
 
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.SITEMAP_GEN /></b></center></td>
      </tr>

      <tr>
      <td class="header"><tag:language. />Active Sitemap</td>
      <tag:active_map />
      <td class="header"><tag:language. />Max URL</td>
      <td class="lista"><input type="text" name="max_url" value="<tag:maxurl />" size="30" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language. />Absolute path</td>
      <td class="lista"><input type="text" value="<tag:pathserv />" size="30" READONLY /></td>
      <td class="header"><tag:language. />Name of Sitemap</td>
      <td class="lista"><input type="text" name="name_sitemap" value="<tag:name_sitemap />" size="30" /></td>
      </tr>

 
      <tr>
     <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.UPDATE_SITEMAP />" /></td>
     </tr>
 </table>
</form>

<form action="<tag:frm_action_sitemap />" method="post">
  <table class="header" width="100%" align="center">
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.SITEMAP_GEN /></b></center></td>
      </tr>

      <tr>
      <td class="header"><tag:language.YOUR_WEBSITE /></td>
      <td class="lista"><input type="hidden" name="website" value="<tag:website />"/><tag:website /></td>
      <td class="header"><tag:language.MAX_URL /></td>
      <td class="lista"> <tag:maxurl /> / <tag:url_db /><input type="hidden" name="max_url" value="<tag:maxurl />"/></td>
      </tr>
      <tr>
      <td class="header"><tag:language.ABSOLUTE_PATH /></td>
      <td class="lista"><tag:pathserv /><input type="hidden" value="<tag:pathserv />"/></td>
      <td class="header"><tag:language.NAME_SITEMAP /></td>
      <td class="lista"><tag:name_sitemap /><input type="hidden" name="name_sitemap" value="<tag:name_sitemap />"/></td>
      </tr>
      <tr>
      <td class="header"><tag:language.PRIORITY /></td>
      <td class="lista"> 
			<select name="priority" onchange="add_soc(this);"/ >
			<option value="0.1" >0,1</option>
			<option value="0.2" >0,2</option>
			<option value="0.3" >0,3</option>
			<option value="0.4" >0,4</option>
			<option value="0.5" >0,5</option>
			<option value="0.6" >0,6</option>
			<option value="0.7" >0,7</option>
			<option value="0.8" >0,8</option>
			<option value="0.9" >0,9</option>
			<option value="1" >1</option>
			</select>
				</td>
      <td class="header"><tag:language.CHANGE_FREQ /></td>
      <td class="lista"> 
			<select name="changefreq" onchange="add_soc(this);"/ >
			<option value="<tag:language.DAILY />" ><tag:language.DAILY /></option>
			<option value="<tag:language.WEEKLY />" ><tag:language.WEEKLY /></option>
			<option value="<tag:language.MONTHLY />" ><tag:language.MONTHLY /></option>
			<option value="<tag:language.YEARLY />" ><tag:language.YEARLY /></option>
			</select>
				</td>
      </tr>
 
 
 
 
      <tr>
     <td colspan="6" class="lista" style="text-align:center"><tag:chmod /><br /><tag:boutonmap /></td>
     </tr>
 </table>

 
 
</form>

 <table class="header" width="100%" align="center">
      <tr>
      <td class="header" align="center" colspan="4"><center><b><tag:language.TOOLS_SITEMAP /></b></center></td>
      </tr>
      <tr>
      <td class="header"><tag:language.YOUR_SITEMAP /></td>
      <td class="lista"><tag:mapcreated /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.SUBMIT_GOOGLE /></td>
      <td class="lista"><tag:submit_goo /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.SUBMIT_ASK /></td>
      <td class="lista"><tag:submit_ask /></td>
      </tr>
 

	</table>

</div>
 
<!-- javasript -->
<script>
// Tab's
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div");
});
</script>