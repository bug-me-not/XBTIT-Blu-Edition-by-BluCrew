 <script language="Javascript">
function confirm_delete(id)
{
	if(confirm('<tag:language.PAR_SURE_DEL />'))
	{
		self.location.href='index.php?page=partners&action=deletepartner&id='+id;
	}
}
</script>


<if:action_main>
<table class="main" cellspacing="0" cellpadding="5" width="90%" align="center">
  <tr>
    <td class="header" style="text-align:center;"><b><tag:language.PAR_BANNER /></b></td>
    <td class="header" style="text-align:center;"><b><tag:language.PAR_NAME /></b></td>
    <td class="header" style="text-align:center;"><b><tag:language.PAR_LINK /></b></td>
    <td class="header" style="text-align:center;"><b><tag:language.PAR_ADDEDBY /></b></td>
    <td class="header" style="text-align:center;"><b><tag:language.PAR_EDDEL /></b></td>
  </tr>

  <if:no_partners>
  <tr>
    <td colspan="<tag:colspan />" class="lista" style="text-align:center;"><tag:language.PAR_NO_PART /></td>
  </tr>
  <else:no_partners>
  <loop:partners>
  <tr>
    <td class="lista" style="text-align:center;"><img src="<tag:partners[].banner />" /></td>
    <td class="lista" style="text-align:center;"><b><tag:partners[].title /></b></td>
    <td class="lista" style="text-align:center;"><a href="<tag:partners[].link />" target ="_blank"><img src="../images/visit.gif" /></a></td>
    <td class="lista" style="text-align:center;"><tag:partners[].username /></td>
    <if:edit_torrents_2>
    <td class="lista" style="text-align:center;"><a href="index.php?page=partners&action=editpartner&id=<tag:partners[].id />"><img src="../images/edit.gif" /></a>&nbsp;<a href="javascript:confirm_delete('<tag:partners[].id />');"><img src="../images/delete.gif" /></a></td>
    </if:edit_torrents_2>
  </tr>
  </loop:partners>
  </if:no_partners>

  <if:edit_torrents_3>
  <tr>
    <td colspan="<tag:colspan />">
      <form method="post" action="<tag:BASEURL />/index.php?page=partners&action=addpartner">
        <table class="main" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td class="header" colspan="2" style="text-align:center;"><b><tag:language.PAR_ADD_NEW /></b></td>
          </tr>
          <tr>
            <td class="header" style="text-align:right;"><b><tag:language.PAR_TITLE />:</b></td>
            <td class="lista" style="text-align:left;"><input type="text" name="title" size="30"></td>
          </tr>
          <tr>
            <td class="header" style="text-align:right;"><b><tag:language.PAR_BAN_URL />:</b></td>
            <td class="lista" style="text-align:left;"><input type="text" name="banner" size="60"><br/><font class="small"><tag:language.PAR_3RD_PARTY /></font></td>
          </tr>
          <tr>
            <td class="header" style="text-align:right;"><b><tag:language.PAR_LINK />:</b></td>
            <td class="lista" style="text-align:left;"><input type="text" name="link" size="60"></td>
          </tr>
          <tr>
            <td class="header" colspan="2" style="text-align:center;"><input type="submit" value="<tag:language.PAR_UPDATE />"></td>
          </tr>
        </table>
      </form>
    </td>
  </tr> 
  </if:edit_torrents_3>
</table>
</if:action_main>

<if:action_edit>

<div align="center"><h1><tag:language.PAR_ED_PART /> <tag:title /></h1></div>

<form method="post" action="<tag:BASEURL />/index.php?page=partners&action=editpartner&id=<tag:id />">
<table class="main" cellspacing="0" cellpadding="5" width="98%" align="center">
  <tr>
    <td class="header" style="text-align:right;"><tag:language.PAR_TITLE />:</td>
    <td class="lista" style="text-align:left;"><input type="text" name="title" size="30" value="<tag:title />"></td>
  </tr>
  <tr>
    <td class="header" style="text-align:right;"><tag:language.PAR_BAN_URL />:</td>
    <td class="lista" style="text-align:left;"><input type="text" name="banner" size="60" value="<tag:banner />"><br/><font class="small"><tag:language.PAR_3RD_PARTY /></font></td>
  </tr>
  <tr>
    <td class="header" style="text-align:right;"><tag:language.PAR_CUR_BAN />:</td>
    <td class="lista" style="text-align:left;"><img src="<tag:banner />" /></td>
  </tr>
  <tr>
    <td class="header" style="text-align:right;"><tag:language.PAR_LINK />:</td>
    <td class="lista" style="text-align:left;"><input type="text" name="link" size="40" value="<tag:link />"></td>
  </tr>
  <tr>
    <td class="header" style="text-align:center;" colspan="2"><input type="submit" value="<tag:language.PAR_UPDATE />"><input type="button" value="<tag:language.PAR_BACK />" onclick="history.go(-1);return true;"></td>
  </tr>
</table>
</form>

</if:action_edit>
