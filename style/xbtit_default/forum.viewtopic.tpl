<table width="100%">
  <tr>
    <td class="header"><a name="top" /><tag:topic_title /></td>
  </tr>
</table>
<table width="100%" align="center">
  <tr>
    <td align="center" valign="middle">
        <table width="100%">
          <tr>
            <td align="center" valign="middle"><tag:forum_pager /></td>
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle">
    <loop:posts>
      <table class="table table-bordered">
        <!-- Message header (with delete/quote/edit) if authorized) -->
        <tr>
          <td align="left" class="header" colspan="2">
            <table width="100%">
              <tr>
              <td align="left">
                <tag:posts[].new />
                <a name="<tag:posts[].id />" href="<tag:posts[].msglink />"><tag:language.POST />&nbsp;#<tag:posts[].post_number /></a>
              </td>
                <td align="right"><tag:posts[].actions /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="blocklist" align="left" valign="top">
          <!-- poster infos -->
            <table width="140">
              <tr>
                <td>
                <tag:posts[].username />&nbsp;<tag:posts[].pm />
                <br />
                Rank:<tag:posts[].user_group />
      

     
                <br />
                <tag:posts[].date />
                <br />
                <tag:posts[].elapsed />
                <br /><br />
                <tag:posts[].avatar />
                <br /><br />
                
      			 <img src="images/arany.png">&nbsp;<tag:posts[].ratio />
                 <br />
                 <img src="images/speed_up.png">&nbsp;<tag:posts[].uploaded />
                <br />
                 <img src="images/speed_down.png">&nbsp;<tag:posts[].downloaded /><br />
                <br />       <tag:language.POSTS />:&nbsp;<tag:posts[].posts />
                <br />
                &nbsp;<tag:posts[].online />&nbsp;
                </td>
              </tr>
            </table>
          </td>
          <!-- post -->
          <td class="post" width="100%" valign="top" style="padding:10px"><tag:posts[].body /></td>
        </tr>
        <tr>
          <td align="right" class="header" colspan="2"><a href="#top"><tag:posts[].top /></a></td>
        </tr>
      </table>
      <br />
    </loop:posts>
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle">
      <table width="100%">
            <td align="center" valign="middle"><tag:topic_locked /></td>
        <tr>
          <if:can_write_1>
            <td align="center" valign="middle"><a href="<tag:forum_action />"><img src="images/comm.png"></a></td>
          </if:can_write_1>
          </td>
        </tr>
        <td align="center" valign="middle"><tag:forum_pager /></td>
      </table>
    </td>
  </tr>
</table>
<if:moderator>
<script type="text/javascript">
function ShowHide(id,id1) {
    obj = document.getElementsByTagName("div");
    if (obj[id].style.display == 'block'){
     obj[id].style.display = 'none';
     obj[id1].style.display = 'block';
    }
    else {
     obj[id].style.display = 'block';
     obj[id1].style.display = 'none';
    }
}

function windowunder(link)
{
  window.opener.document.location=link;
  window.close();
}
</script>
<br />
<div align="left" style="width:98%">
<span class="pager"><a name="expand" href="#expand" onclick="javascript:ShowHide('moderator','modoption');"><tag:language.MOD_OPTION /></a></span>
</div>
<div id="moderator" style="display:none">
<br />
<table align="center" width="98%" class="lista">
<!-- moderators parts... -->
<tr>
<td align="left" class="lista"><tag:language.STICKY /></td>
<td align="left" class="lista">
<!-- Sticky -->
<form name="setsticky" action="index.php?page=forum&amp;action=setsticky" method="post">
<input type="hidden" name="topicid" value="<tag:topic_id />" />
<input type="hidden" name="returnto" value="<tag:return_to />" />
&nbsp;<input type="radio" name="sticky" value="yes" <tag:sticky_yes /> /><tag:language.YES />
&nbsp;<input type="radio" name="sticky" value="no"  <tag:sticky_no /> /><tag:language.NO />
&nbsp;&nbsp;<input type="submit" value="<tag:language.SET_STICKY />" name="sticky_btn" class="btn" />
</form>
</td>
</tr>
<tr>
<td align="left" class="lista"><tag:language.LOCKED /></td>
<td align="left" class="lista">
<!-- Locked -->
<form name="setlocked" action="index.php?page=forum&amp;action=setlocked" method="post">
<input type="hidden" name="topicid" value="<tag:topic_id />" />
<input type="hidden" name="returnto" value="<tag:return_to />" />
&nbsp;<input type="radio" name="locked" value="yes"  <tag:locked_yes /> /><tag:language.YES />
&nbsp;<input type="radio" name="locked" value="no"  <tag:locked_no /> /><tag:language.NO />
&nbsp;&nbsp;<input type="submit" value="<tag:language.SET_LOCKED />" name="locked_btn" class="btn" />
</form>
</td>
</tr>
<tr>
<td align="left" class="lista"><tag:language.SUBJECT /></td>
<td align="left" class="lista">
<!-- rename  -->
<form name="rename" action="index.php?page=forum&amp;action=rename" method="post">
<input type="hidden" name="topicid" value="<tag:topic_id />" />
<input type="hidden" name="returnto" value="<tag:return_to />" />
&nbsp;<input type="text" size="40" maxlength="40" name="subject" value="<tag:topic_subject />" />
&nbsp;&nbsp;<input type="submit" value="<tag:language.RENAME_TOPIC />" name="rename" class="btn" />
</form>
</td>
</tr>
<tr>
<td align="left" class="lista"><tag:language.MOVE_TOPIC /></td>
<td align="left" class="lista">
<!-- move topic in other forum -->
<form method="post" action="index.php?page=forum&amp;action=movetopic&amp;topicid=<tag:topic_id />" name="movetopic">
&nbsp;<tag:forums_combo />
&nbsp;&nbsp;<input type="submit" value="<tag:language.MOVE />" name="movetopic" class="btn" />
</form>
</td>
</tr>
<tr>
<td align="left" class="lista"><tag:language.DELETE_TOPIC /></td>
<td class="lista">
<form method="get" action="index.php">
<input type="hidden" name="page" value="forum" />
<input type="hidden" name="action" value="deletetopic" />
<input type="hidden" name="topicid" value="<tag:topic_id />" />
<input type="hidden" name="forumid" value="<tag:forum_id />" />
<input type="checkbox" name="sure" value="1" />
&nbsp;<tag:language.IM_SURE />
&nbsp;&nbsp;<input type="submit" value="<tag:language.DELETE_TOPIC />" class="btn" />
</form>
</td>
</tr>
</table>
<br />
</div>
<div id="modoption" style="display:block"><br />
</div>
</if:moderator>

