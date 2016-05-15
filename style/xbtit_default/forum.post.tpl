<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Post</h4>
</div>
<form method="post" name="compose" action="<tag:frm_action />">
  <table class="table table-bordered">
    <tr>
      <td>
        <if:newtopic>
        <input type="hidden" name="forumid" value="<tag:forum_id />" />
        <else:newtopic>
        <input type="hidden" name="topicid" value="<tag:topic_id />" />
        </if:newtopic>
        <table class="lista" cellspacing="0" cellpadding="5" align="center">
        <if:newtopic_1>
        <tr>
          <td class="header"><tag:language.SUBJECT /></td>
          <td align="left" style="padding: 0px" class="header"><input type="text" size="60" maxlength="40" name="subject" class="form-control" value="<tag:post_subject />" /></td>
        </tr>
        </if:newtopic_1>
        <tr>
          <td class="lista"><tag:language.BODY /></td>
          <td align="left" style="padding: 0px" class="lista"><tag:post_bbcode /></td>
        </tr>
        <tr>
          <td colspan="2" align="center" class="header">
            <input type="submit" name="confirm" class="btn btn-primary btn-md" value="<tag:language.FRM_CONFIRM />" />
            <input type="submit" name="confirm" class="btn btn-danger btn-md" value="<tag:language.FRM_CANCEL />" />
          </td>
        </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
</div>


<if:old_posts>
<a name="top" />
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:language.LAST_10_POSTS /></h4>
</div>
<table>
  <tr>
    <td align="center">
    <loop:posts>
      <table class="table table-bordered">
        <tr>
          <td class="blocklist" align="center" width="150">
          <!-- poster infos -->
            <table>
              <tr>
                <td><a name="<tag:posts[].id />" />
                <tag:posts[].username />&nbsp;(<tag:posts[].user_group />)
                <br />
                <tag:posts[].date />
                <br />
                <tag:posts[].elapsed />
                <br />
                <tag:posts[].avatar />
                <br />
                <tag:language.RATIO />:&nbsp;<tag:posts[].ratio />
                <br />
                <tag:language.POSTS />:&nbsp;<tag:posts[].posts />
                <br />
                <tag:posts[].flag />&nbsp;&nbsp;<tag:posts[].pm />
                </td>
              </tr>
            </table>
          </td>
          <!-- post -->
          <td class="post" width="100%" valign="top" style="padding:10px"><tag:posts[].body /></td>
        </tr>
        <tr>
          <td align="right" class="head" colspan="2"><a href="#top"><tag:posts[].top /></a></td>
        </tr>
      </table>
    </loop:posts>
    </td>
  </tr>
</table>
</div>
</if:old_posts>