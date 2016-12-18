<div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:topic_title /></h4>
</div>
<loop:posts>
<table class="maibaugrand left" align="center" width="100%" cellspacing="0" cellpadding="3">
<tbody>
<tr>
<td class="head" align="left" colspan="2" height="24">
<span><tag:posts[].username />&nbsp;<tag:posts[].pm /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-refresh" aria-hidden="true"></i> <tag:posts[].ratio /> &nbsp;&nbsp;&nbsp; <i class="fa fa-upload" aria-hidden="true"></i><tag:posts[].uploaded /> &nbsp;&nbsp;&nbsp; <i class="fa fa-download" aria-hidden="true"></i><tag:posts[].downloaded /> &nbsp;&nbsp;&nbsp; <i class="fa fa-commenting" aria-hidden="true"></i><tag:posts[].posts /></span>
</td>
<td class="head" align="right" colspan="2" height="24"><tag:posts[].online /></td>
</tr>

<td align="left" class="comment-avatar-container">
  <div class="user-avatar comment-avatar" style="background-image:url(/avatar/default_avatar.gif), url(/avatar/default_avatar.gif);background-position:0,0;background-repeat:no-repeat;max-width: 100px; width: expression(this.width &gt; 100 ? 100: true);"> </div>
</td>
<td width="100%" align="left" class="text"><tag:posts[].body /></td>

<tr>
<td class="comment_footer" align="center" colspan="2">
<div style="float: left; width: auto;"><tag:posts[].actions /></div>
<div align="right" class="comment-added"><tag:posts[].new /><a name="<tag:posts[].id />" href="<tag:posts[].msglink />"><tag:language.POST />&nbsp;#<tag:posts[].post_number /></a>&nbsp;&nbsp;on&nbsp;&nbsp;<tag:posts[].date /><tag:posts[].elapsed /></div>
</td></tr></tbody></table>
</loop:posts>
</div>

  <tr>
    <td align="center" valign="middle">
      <table width="100%">
            <td align="center" valign="middle"><tag:topic_locked /></td>
        <tr>
          <if:can_write_1>
            <td align="center" valign="middle"><a href="<tag:forum_action />"><button class="btn btn-labeled btn-info btn-lg" type="button">
   <span class="btn-label"><i class="fa fa-comment"></i></span>Insert Comment Here</button></a></td>
          </if:can_write_1>
          </td>
        </tr>
        <td align="center" valign="middle"><tag:forum_pager /></td>
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>



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
<div class="panel panel-danger">
<div class="panel-heading">
<h4 class="text-center"><span class="pager"><a name="expand" href="#expand" onclick="javascript:ShowHide('moderator','modoption');"><tag:language.MOD_OPTION />&nbsp;&nbsp;<i class="fa fa-plus"></i></a></span></h4>
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
&nbsp;&nbsp;<input type="submit" value="<tag:language.SET_STICKY />" name="sticky_btn" class="btn btn-primary btn-sm" />
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
&nbsp;&nbsp;<input type="submit" value="<tag:language.SET_LOCKED />" name="locked_btn" class="btn btn-primary btn-sm" />
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
&nbsp;<input type="text" size="40" maxlength="40" name="subject" class="form-control" value="<tag:topic_subject />" />
&nbsp;&nbsp;<input type="submit" value="<tag:language.RENAME_TOPIC />" name="rename" class="btn btn-primary btn-sm " />
</form>
</td>
</tr>
<tr>
<td align="left" class="lista"><tag:language.MOVE_TOPIC /></td>
<td align="left" class="lista">
<!-- move topic in other forum -->
<form method="post" action="index.php?page=forum&amp;action=movetopic&amp;topicid=<tag:topic_id />" name="movetopic">
&nbsp;<tag:forums_combo />
&nbsp;&nbsp;<input type="submit" value="<tag:language.MOVE />" name="movetopic" class="btn btn-primary btn-sm" />
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
&nbsp;&nbsp;<input type="submit" value="<tag:language.DELETE_TOPIC />" class="btn btn-danger btn-sm" />
</form>
</td>
</tr>
</table>
</div>
</div>
</if:moderator>

