<script type="text/javascript" src="./jscript/logincollapse.js"></script>
<script type="text/javascript" src="./jscript/jquery-1.7.min.js"></script>
<form id=form1 name=form1 method=post action=index.php?page=applysend>
<table width=800 border=0 align=center cellpadding=0 cellspacing=0>
<tr>
<td width=698><div align=center><span class=style1><b><tag:language.ATTENTION /></span><br />
<tag:language.MSG1 /></b></td>
</tr>
</table>
<table width=700 border=1 align=center cellpadding=3 cellspacing=0>
<tr>
<td><span class=style2>*</span><b><tag:language.COUNTRY /><b></td>
<td>
<label>
<textarea name=intentioneaza cols=40 rows=1 id=intentioneaza></textarea>
</label>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.EMAIL /><b></td>
<td>
<textarea name=sursa cols=40 rows=1 id=sursa></textarea>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.DESIRED_NAME /><b></td>
<td>
<textarea name=sursas cols=40 rows=1 id=sursas></textarea>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.ABOUT_US /></td>
<td>
<textarea name=altsite cols=40 rows=4 id=altsite></textarea>
</td>
</tr>
<tr>
<td colspan = 2><b><tag:language.MSG2 /></b></td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.JOIN_SITE /><b></td>
<td>
<textarea name=motiv cols=40 rows=4 id=motiv></textarea>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.OFFER_SITE /><b></td>
<td>
<textarea name=stisite cols=40 rows=4 id=stisite></textarea>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.SEED_BOX /></b></td>
<td>
<select name=oday id=oday>
<option value=Yes>Yes</option>
<option value=No selected=selected>No</option>
</select>
</td>
</tr>
<tr><td colspan = 2><b><tag:language.MSG3 /></b></td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.PROFILE1 /></b></span></td>
<td>
<textarea name=sursaa cols=40 rows=1 id=sursaa></textarea>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.PROFILE2 /></b></span></td>
<td>
<textarea name=sursad cols=40 rows=1 id=sursad></textarea>
</td>
</tr>
<tr>
<td><b><tag:language.PROFILE3 /></b></td>
<td>
<textarea name=sursaf cols=40 rows=1 id=sursaf></textarea>
</td>
</tr>
<tr>
<td><span class=style2>*</span><b><tag:language.SEED_TIME /><b></td>
<td>
<select name=seet id=seet>
<option value=50>50%</option>
<option value=75>75%</option>
<option value=100 selected=selected>100%</option>
<option value=150>150%</option>
<option value=200>200%</option>
</select>
</td>
</tr>
<tr>
<td>
<span class=style2>*</span><b><tag:language.RULES_AGREE /><b></td>
<td>
<a href="javascript:logincollapse.toggle('apply_rules')"><tag:language.READ_NOW /></a><a href="javascript:logincollapse.show('apply_rules')" /></a>
</td>
</tr>
</table>
<table width=700 border=1 align=center cellpadding=3 cellspacing=0>           
<tr>        
<if:CAPTCHA>
    <tr>
       <td align="left" ><b><tag:language.IMAGE_CODE /></b></td>
       <td align="left" ><input type="text" name="private_key" maxlength="6" size="6" value="" />&nbsp;&nbsp;<tag:account_captcha /></td>
    </tr>
    <else:CAPTCHA>
    <tr>
       <td align="left" ><b><tag:language.SECURITY_CODE /></b></td>
       <td align="left" ><tag:scode_question /><input type="text" name="scode_answer" maxlength="6" size="6" value="" /></td>
    </tr>
</if:CAPTCHA>
<td colspan = 2><b><tag:language.MSG4 /></b></td>  
</tr>
</table>
<div id="apply_rules" style="display:none">
<table width=700 border=1 align=center cellpadding=3 cellspacing=0>
<tr>
<td colspan = 2 valign="BOTTOM">
<center><b><tag:language.APPLY_RULES /></b></center><br />
<justify><tag:apply_rules_text /></br></br></justify>
<center>
<b><tag:language.APPLY_AGREE /></b>
<select name=regulament id=regulament>
<option value=Yes>Yes</option>
<option value=No selected=selected>No</option>
</select>
  <br></center>
</tr>
</table>
<p>
<label>
<div align=center>
<input name=Submit type=submit id=Submit value=<tag:language.APPLY /> "> 
</div>
</label>
</p>
</form>