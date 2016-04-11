<script type="text/javascript">

window.onload=function()
{
    <if:not_gazelle>
    var elm= document.getElementById('gazelle');
    elm.style.visibility = 'hidden';
    </if:not_gazelle>
    <if:not_session>
    var elm2= document.getElementById('cookie_extra');
    elm2.style.visibility = 'hidden';
    </if:not_session>
    <if:not_ip_options>
    var elm3= document.getElementById('ip_options');
    elm3.style.visibility = 'hidden';
    </if:not_ip_options>
}

function hide(obj)
  {
      obj1 = document.getElementById(obj);
      obj1.style.visibility = 'hidden';
  }
function show(obj)
  {
      obj1 = document.getElementById(obj);
      obj1.style.visibility = 'visible';
  }
</script>

<div align='center'>
  <form name='security_suite' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=security_suite'>
    <table>
    <tr>
      <td class="header" align="center" colspan="2"><b><tag:language.SECSUI_QUAR_SETTING /></b></td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_QUAR_TERMS_1 /></b></td>
      <td class="lista"><tag:language.SECSUI_QUAR_TERMS_2 /><br /><textarea rows="5" cols="37" name="secsui_quarantine_search_terms"><tag:config.secsui_quarantine_search_terms /></textarea><tag:language.SECSUI_QUAR_TERMS_3 /><tag:short_open_tag /></td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_QUAR_DIR_1 /></b></td>
      <td class="lista"><tag:language.SECSUI_QUAR_DIR_2 /><br /><b><tag:recommended /></b><br /><input type="text" name="secsui_quarantine_dir" value="<tag:config.secsui_quarantine_dir />" size="50" maxlength="200" /><br /><tag:language.SECSUI_QUAR_DIR_3 /></td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_QUAR_PM /></b></td>
      <td class="lista"><input type="text" name="secsui_quarantine_pm" value="<tag:config.secsui_quarantine_pm />" size="5" maxlength="10" />&nbsp;(<tag:config.secsui_quarantine_user />)</td>
    </tr>

    <tr>
      <td class="header" align="center" colspan="2"><b><tag:language.SECSUI_PASS_SETTINGS /></b></td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_PASS_TYPE /></b></td>
      <td class="lista"><tag:language.SECSUI_PASS_INFO /><br /><tag:secsui_pass_type /><div id="gazelle"><b><tag:language.SECSUI_GAZ_TITLE />:</b>&nbsp;&nbsp;<input type="text" name="secsui_ss" value="<tag:config.secsui_ss />"><span style="color:red"><b><tag:language.SECSUI_GAZ_DESC /></b></span></div></td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_PASS_MUST /></b></td>
      <td class="lista">
        <table width="100%">
          <tr>
            <td class="header" width="33%" align="right"><b><tag:language.SECSUI_PASS_BE_AT_LEAST />:<b></td>
            <td class="lista" width="67%"><input type="text" name="pass_min_char" value="<tag:pass_min_char />" size="4" />&nbsp;&nbsp;<b><tag:min_char_lang /><b></td>
          </tr>
          <tr>
            <td class="header" width="33%" align="right"><b><tag:language.SECSUI_PASS_HAVE_AT_LEAST />:<b></td>
            <td class="lista" width="67%"><input type="text" name="pass_min_lct" value="<tag:pass_min_lct />" size="4" />&nbsp;&nbsp;<b><tag:min_lc_lang /><b></td>
          </tr>
          <tr>
            <td class="header" width="33%" align="right"><b><tag:language.SECSUI_PASS_HAVE_AT_LEAST />:<b></td>
            <td class="lista" width="67%"><input type="text" name="pass_min_uct" value="<tag:pass_min_uct />" size="4" />&nbsp;&nbsp;<b><tag:min_uc_lang /><b></td>
          </tr>
          <tr>
            <td class="header" width="33%" align="right"><b><tag:language.SECSUI_PASS_HAVE_AT_LEAST />:<b></td>
            <td class="lista" width="67%"><input type="text" name="pass_min_num" value="<tag:pass_min_num />" size="4" />&nbsp;&nbsp;<b><tag:min_num_lang /><b></td>
          </tr>
          <tr>
            <td class="header" width="33%" align="right"><b><tag:language.SECSUI_PASS_HAVE_AT_LEAST />:<b></td>
            <td class="lista" width="67%"><input type="text" name="pass_min_sym" value="<tag:pass_min_sym />" size="4" />&nbsp;&nbsp;<b><tag:min_sym_lang /><b></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class="header" align="center" colspan="2"><b><tag:language.SECSUI_COOKIE_SETTINGS /></b></td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_COOKIE_PRIMARY /></b></td>
      <td class="lista">
      <table width="100%" border="0">
        <tr>
          <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_TYPE />:</b></td>
          <td class="lista" width="67%"><tag:secsui_cookie_type /></td>
        </tr>
      </table>
      <div id="cookie_extra">
        <table width="100%" border="0" align="left">
          <tr>
            <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_NAME />:</b></td>
            <td class="lista" width="33%"><input type="text" name="secsui_cookie_name" value="<tag:config.secsui_cookie_name />" size="24"></td>
            <td class="lista" rowspan="4" width="34%"><b><tag:language.SECSUI_COOKIE_PD /></b></td>
          </tr>
          <tr>
            <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_EXPIRE />:</b></td>
            <td class="lista" width="33%"><input type="text" name="secsui_cookie_exp1" value="<tag:config.secsui_cookie_exp1 />" size="9">&nbsp;&nbsp;<tag:secsui_cookie_exp2 /></td>
          </tr>
          <tr>
            <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_PATH />:</b></td>
            <td class="lista" width="33%"><input type="text" name="secsui_cookie_path" value="<tag:config.secsui_cookie_path />" size="24"></td>
          </tr>
          <tr>
            <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_DOMAIN />:</b></td>
            <td class="lista" width="33%"><input type="text" name="secsui_cookie_domain" value="<tag:config.secsui_cookie_domain />" size="24"></td>
          </tr>
        </table>
      </div>
      </td>
    </tr>
    <tr>
      <td class="header"><b><tag:language.SECSUI_COOKIE_ITEMS /></b></td>
      <td class="lista">
      
      <table width="100%" border="0">
        <tr>
          <td class="header" align="right" width="33%"><b><tag:language.USERNAME />:</b></td>
          <td class="lista" width="33%" style="text-align:center;"><input type="radio" name="username" value="yes" <tag:4a_checked /> /> <tag:language.YES />&nbsp;&nbsp;&nbsp;<input type="radio" name="username" value="no" <tag:4b_checked /> /> <tag:language.NO /></td>
          <td class="lista" rowspan="5" width="34%"><b><tag:language.SECSUI_COOKIE_DEF /></b></td>
        </tr>
        <tr>
          <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_PSALT />:</b></td>
          <td class="lista" width="33%" style="text-align:center;"><input type="radio" name="pass_salt" value="yes" <tag:5a_checked /> /> <tag:language.YES />&nbsp;&nbsp;&nbsp;<input type="radio" name="pass_salt" value="no" <tag:5b_checked /> /> <tag:language.NO /></td>
        </tr>
        <tr>
          <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_UAGENT />:</b></td>
          <td class="lista" width="33%" style="text-align:center;"><input type="radio" name="uagent" value="yes" <tag:6a_checked /> /> <tag:language.YES />&nbsp;&nbsp;&nbsp;<input type="radio" name="uagent" value="no" <tag:6b_checked /> /> <tag:language.NO /></td>
        </tr>
        <tr>
          <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_ALANG />:</b></td>
          <td class="lista" width="33%" style="text-align:center;"><input type="radio" name="alang" value="yes" <tag:7a_checked /> /> <tag:language.YES />&nbsp;&nbsp;&nbsp;<input type="radio" name="alang" value="no" <tag:7b_checked /> /> <tag:language.NO /></td>
        </tr>
        <tr>
          <td class="header" align="right" width="33%"><b><tag:language.SECSUI_COOKIE_IP />:</b></td>
          <td class="lista" width="33%" style="text-align:center;"><input type="radio" name="ipadd" value="yes" <tag:8a_checked /> onclick="show('ip_options');" /> <tag:language.YES />&nbsp;&nbsp;&nbsp;<input type="radio" name="ipadd" value="no" <tag:8b_checked /> onclick="hide('ip_options');" /> <tag:language.NO /><div id="ip_options"><tag:secsui_ip_octets /></div></td>
        </tr>
      </table>
      </td>
    </tr>

    <tr>
      <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
    </tr>
    </table>
  </form>
</div>