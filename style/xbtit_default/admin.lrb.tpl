<form name="lrba" action="<tag:frm_actiona />" method="post">
<table class="header" width="85%" align="center">

      <tr>
      <td class="header" align="center" colspan="4"><tag:language.RAT_OV_SET /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.RAT_EN_SYS /></td>
      <td class="lista" colspan="3"><input type="checkbox" name="wb_sys" value="wb_sys" <tag:wb_button /> /></td>
     </tr>
    <tr>
      <td class="header" valign="top" colspan="1"><tag:language.RAT_1ST_WAR /></td>
      <td class="lista" colspan="3"><textarea name="wb_text_one" rows="3" cols="60"><tag:lrb.wb_text_one /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.RAT_2ND_WAR /></td>
      <td class="lista" colspan="3"><textarea name="wb_text_two" rows="3" cols="60"><tag:lrb.wb_text_two /></textarea></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.RAT_LAST_WAR /></td>
      <td class="lista" colspan="3"><textarea name="wb_text_fin" rows="3" cols="60"><tag:lrb.wb_text_fin /></textarea></td>
      </tr>
      <tr>
    <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.FRM_CONFIRM />" /></td>
</tr>
</form>  

<form name="lrbb" action="<tag:frm_actionb />" method="post">      
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.RAT_US_SET /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.RAT_RANK_ID /></td>
      <td class="lista"><input type="text" name="wb_rank" size="4" /></td>
      <td class="header"><tag:language.RAT_MIN_DOWN /></td>
      <td class="lista"><input type="text" name="wb_down" size="4" /><tag:language.GB /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.RAT_1ST_RAT /></td>
      <td class="lista"><input type="text" name="wb_one"  size="4" /></td>
      <td class="header"><tag:language.RAT_NEXT_WARN /></td>
      <td class="lista"><input type="text" name="wb_days_one"  size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.RAT_2ND_RAT /></td>
      <td class="lista"><input type="text" name="wb_two" size="4" /></td>
      <td class="header"><tag:language.RAT_NEXT_WARN /></td>
      <td class="lista"><input type="text" name="wb_days_two"  size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.RAT_3RD_RAT /></td>
      <td class="lista"><input type="text" name="wb_three"  size="4" /></td>
      <td class="header"><tag:language.RAT_DBFWAB /></td>
      <td class="lista"><input type="text" name="wb_days_fin"  size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.RAT_FIN_RAT /></td>
      <td class="lista"><input type="text" name="wb_fin" size="4" /></td>
      <td class="header"><tag:language.RAT_SWS /></td>
      <td class="lista"><input type="checkbox" name="wb_warn" /></td>
      </tr>

     
	<tr>
    <td colspan="6" class="lista" style="text-align:center"><br><input type="submit" name="action" value="<tag:language.RAT_NEW_GROUP />" /></td>
</tr>
	  </table></form>

<table class="header" width="85%" align="center"><center><b><tag:language.RAT_GROUP_RULES /></b></center>

<tr>
    <td class="header" align="center"><tag:language.RAT_ID_LEVEL /></td>
    <td class="header" align="center"><tag:language.RAT_USERG /></td>
    <td class="header" align="center"><tag:language.RAT_MIN_DOWN_A /></td>
    <td class="header" align="center"><tag:language.RAT_1ST_RAT_A /></td>
    <td class="header" align="center"><tag:language.RAT_DTSW /></td>
    <td class="header" align="center"><tag:language.RAT_2ND_RAT_A /></td>
    <td class="header" align="center"><tag:language.RAT_DTTW /></td>
    <td class="header" align="center"><tag:language.RAT_3RD_RAT_A /></td>
    <td class="header" align="center"><tag:language.RAT_DTB /></td>
    <td class="header" align="center"><tag:language.RAT_FIN_RAT_A /></td>
    <td class="header" align="center"><tag:language.RAT_WS /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
</tr>

<loop:hit>
<tr>
    <td class="lista" style="text-align:center;"><tag:hit[].wb_rank /></td>
    <td class="lista" style="text-align:center;"><tag:hit[].wb_group /></td>
    <td class="lista" style="text-align:center;"><tag:hit[].min_download /></td>
    <td class="lista" style="text-align:center;"><span style="color:red;"><tag:hit[].ratio_one /></span></td>
    <td class="lista" style="text-align:center;"><span style="color:blue;"><tag:hit[].days_one /></span></td>
    <td class="lista" style="text-align:center;"><span style="color:red;"><tag:hit[].ratio_two /></span></td>
    <td class="lista" style="text-align:center;"><span style="color:blue;"><tag:hit[].days_two /></span></td>
    <td class="lista" style="text-align:center;"><span style="color:red;"><tag:hit[].ratio_three /></span></td>
    <td class="lista" style="text-align:center;"><span style="color:blue;"><tag:hit[].days_three /></span></td>
    <td class="lista" style="text-align:center;"><span style="color:red;"><tag:hit[].ratio_fin /></span></td>
    <td class="lista" style="text-align:center;"><tag:hit[].warn /></td>
    <td class="lista" style="text-align:center;"><tag:hit[].delete /></td>
</tr>
</loop:hit>

</table>
<table class="header" width="85%" align="center"><center><b><tag:language.RAT_WABH /></b></center>
<tr>
    <td class="header" align="center"><tag:language.RAT_USER /></td>
    <td class="header" align="center"><tag:language.RAT_USERG /></td>
    <td class="header" align="center"><tag:language.RAT_WARN_TIM /></td>
    <td class="header" align="center"><tag:language.DATE /></td>
    <td class="header" align="center"><tag:language.RAT_WS /></td>
    <td class="header" align="center"><tag:language.RAT_WS_BANNED /></td>
    <td class="header" align="center"><tag:language.RAT_UNWARN /></td>
    <td class="header" align="center"><tag:language.RAT_UNBAN /></td>
</tr>

  <loop:list>
  <tr>
    <td class="lista" style="text-align:center;"><tag:list[].username /></td>
    <td class="lista" style="text-align:center;"><tag:list[].group /></td>
    <td class="lista" style="text-align:center;"><span style="color:red;"><tag:list[].warn /></span></td>
    <td class="lista" style="text-align:center;"><tag:list[].date /></td>
    <td class="lista" style="text-align:center;"><tag:list[].show /></td>
    <td class="lista" style="text-align:center;"><tag:list[].ban /></td>
    <td class="lista" style="text-align:center;"><tag:list[].unwarn /></td>
    <td class="lista" style="text-align:center;"><tag:list[].unban /></td>
  </tr>
  </loop:list>
</table>