<if:view>
<if:owner><div style="float:right;"><a href="index.php?page=teaminfo&team=<tag:team />&action=edit"><img src="<tag:STYLEURL />/images/edit.png"></a></div></if:owner>
<br />

<div align="center">
<img src="<tag:pic />" width="300" height="300" border="1">
</div>        

<br />
<div align="center">
  <table width="50%" cellspacing="0" cellpadding="2" border="0">
    <tr>
      <td class="block" colspan="3" style="text-align:center"><tag:language.OWNER_TEAM /></td>
    </tr>
    <tr>
      <td width="90" class="lista" valign="top" style="text-align:center"><tag:img /></td>
      <td class=lista valign=top><div style="background: #c3d1dc; border: 1px solid #396184; padding-left: 5px;">
        <tag:uname /></div><br/>
        <tag:language.UPLOADED />:&nbsp;<tag:dl /><br />
        <tag:language.DOWNLOADED />:&nbsp;<tag:ul /><br />
        <tag:language.RATIO />:&nbsp;<tag:ratio /><br />
        <tag:language.TU />:&nbsp;<tag:count /><br />
      </td>
    </tr>
  </table>
  
  <br />
  <br />  

  <table width="50%" cellspacing="0" cellpadding="2" border="0">
    <tr>
      <td class="block" colspan="3" style="text-align:center"><tag:language.TEAM_INFO /></td>
    </tr>
    <tr>
      <td width="90" class="lista" valign="top"><tag:info /></td>
    </tr>
  </table>

</div>
<br />
<br />
<div align="center">
  <tag:pagertop />
  <table width="50%" cellspacing="0" cellpadding="2" border="0">
    <tr>
      <td class="block" colspan="4"><center>Users</center></td>
    </tr>
    <tr>
      <td class="header" align="center"><tag:language.USERNAME /></td>
      <td class="header" align="center"><tag:language.UPLOADED /></td>
      <td class="header" align="center"><tag:language.DOWNLOADED /></td>
      <td class="header" align="center"><tag:language.TU /></td>
    </tr>

    <loop:teamu>
    <tr>
      <td width="90" class="lista" valign="top" style="text-align:center;"><a href="<tag:teamu[].username_link />"><tag:teamu[].username /></a></td>
      <td class="lista" valign="top" style="text-align:center;color:green;">&uarr;&nbsp;<tag:teamu[].uploaded /></td>
      <td class="lista" valign="top" style="text-align:center;color:red;">&darr;&nbsp;<tag:teamu[].downloaded /></td>
      <td class="lista" valign="top" style="text-align:center;"><tag:teamu[].countt /></td>
    </tr>
    </loop:teamu>
  </table>
  <tag:pagerbottom />
  <br />

  <br />
  <table width="50%" border="0" align="center">
    <tr>
      <td width="100%" class="block" colspan="4" style="text-align:center;"><tag:language.TEAMS_LAST_5 /></td>
    </tr>
    <tr>
      <td width=100% class=header><tag:language.TEAMS_FILENAME /></td>
      <td width=100% class=header><tag:language.UPLOADER /></td>
      <td width=100% class=header><tag:language.TEAMS_SEEDS /></td>
      <td width=100% class=header><tag:language.TEAMS_LEECHERS /></td>
    </tr>

    <if:got_rows>
    <loop:last5data>
    <tr>
      <td class="lista" style="text-align:center;"><tag:last5data[].torrent_link /></td>
      <td class="lista" style="text-align:center;"><tag:last5data[].username_link /></td>
      <td class="lista" style="text-align:center;"><tag:last5data[].seeders /></td>
      <td class="lista" style="text-align:center;"><tag:last5data[].leechers /></td>
    </tr>
    </loop:last5data>
    <else:got_rows>
    <tr>
      <td class="lista" colspan="4" style="text-align:center;"><tag:language.TEAMS_NOTHING_2C /></td>
    </tr>
    </if:got_rows>
    </table>
  <br />                        
  <a href="javascript: history.go(-1);"><tag:language.BACK /></a>
</div>
</if:view>

<if:edit>
<br />
<br />
<form name="smolf3d1" method="post" action="index.php?page=teaminfo&team=<tag:team />&action=save">
  <div align="center">
    <table class="main" cellspacing="0" cellpadding="5" width="50%">
      <tr>
        <td class="header" colspan="2" align="center"><tag:language.TEAMPIC_EDIT /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.TEAMPIC_IMAGE /></td>
        <td align="right" class="lista"><input type="text" size="50" maxlength="300" name="pic" value="<tag:teampic />"></td>
      </tr>
      <tr>
        <td class="header" colspan="2" align="center"><input type="Submit" value="Update"></td>
      </tr>
    </table>
  </div>
</form>
<br />
<br />
</if:edit>                










