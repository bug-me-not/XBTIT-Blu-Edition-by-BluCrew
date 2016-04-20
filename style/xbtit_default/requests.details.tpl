<div id='reqdetails'>
  <div>
    <script type='text/javascript'>
      //Source: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt
      filterInt = function (value) 
      {
        if(/^(\-|\+)?([0-9]+)$/.test(value))
          return true;
        return false;
      }
      function checkBounty()
      {
        var bon = document.getElementsByName('amount')[0];
        if(!filterInt(bon.value))
        {
          alert("You have failed to enter a number BON value. Please try again.");
          bon.focus();
          return false;
        }

        return true;
      }
    </script>
  </div>
  <div id='reqtitle' align='center'><h2><tag:req_head /></h2></div>
  <div id='reqedit' align='center'>
    <if:can_edit>
    <form action method='GET'>
      <input type='hidden' name='page' value='requests'>
      <input type='hidden' name='action' value='reqedit'>
      <input type='hidden' name='req_id' value='<tag:req_id />'>
      <input type='submit' class='btn btn-primary' value='<tag:language.RE />'>
    </form>
  </if:can_edit>
  <form action method='GET'>
  <input type='hidden' name='page' value='requests'>
  <input type='submit' class='btn btn-primary' value='<tag:language.PAR_BACK />'>
  </form>
</div>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Request Info</h4>
</div>
<table class="table table-bordered">
  <tbody>
    <tr>
      <td><tag:language.TRAV_REQ_NAME /></td>
      <td><tag:req_name /></td>
    </tr>
    <tr>
      <td><tag:language.TRAV_REQ_BY /></td>
      <td><a href='index.php?page=userdetails&amp;id=<tag:req_uid />'><tag:req_by /></a> <tag:language.TRAV_ON /> <tag:date_added /></td>
    </tr>
    <tr>
      <td><tag:language.TRAV_CATEG /></td>
      <td><tag:catimg /></td>
    </tr>
    <tr>
      <td><tag:language.TRAV_VIEWS /></td>
      <td><tag:req_views /></td>
    </tr>
    <tr> 
      <td><tag:language.TRAV_ADD_BOUNTY /></td>
      <td>
        <form method='post' action='index.php?page=requests&amp;action=addbounty' onsubmit='return checkBounty();'>
          <input type='hidden' name='req_id' value='<tag:req_id />'>
          <input type='hidden' name='uid' value='<tag:uid />'>
          <input type='hidden' name='auth' value='<tag:uid_auth />'>
          <input type='text' name='amount' size='9'>
          <input type='submit' class='btn btn-primary btn-sm' '<tag:disabled />' value='<tag:language.TRAV_AB />'>
          <strong><tag:language.TRAV_TAX /> </strong>
        </form>
      </td>
    </tr>
    <tr>
      <td><tag:language.TRAV_TOTAL_BOUNTY /></td>
      <td><tag:req_total_bounty /></td>
    </tr>
    <tr>
      <td><tag:language.TRAV_JTAKEN /></td>
      <if:job_taken>
      <td><a href='index.php?page=userdetails&amp;id=<tag:job_uid />'><tag:job_taken_by /></a> <tag:language.TRAV_ON /> <tag:job_taken_when /></td>
      <else:job_taken>
      <td>
        <if:can_upload1>
        <form method='post' action='index.php?page=requests&amp;action=takejob'>
          <input type='hidden' name='req_id' value='<tag:req_id />'>
          <input type='hidden' name='uid' value='<tag:uid />'>
          <input type='hidden' name='auth' value='<tag:uid_auth />'>
          <input type='submit' class='btn btn-primary btn-sm' value='<tag:language.TRAV_TJ />'>
        </form>
        <else:can_upload1>
        <tag:language.TRAV_JOB_NO />
      </if:can_upload1>
    </td>
  </if:job_taken>
</tr>
<tr>
  <td><tag:language.TRAV_FILLED /></td>
  <if:uploaded>
  <td>
    <a href='index.php?page=userdetails&amp;id=<tag:upl_uid />'><tag:filled_by /></a> <tag:language.TRAV_ON /> <tag:uploaded_when />
    <br><a href='index.php?page=torrent-details&amp;infohash=<tag:infohash />'><tag:upload_name /></a>
  </td>
  <else:uploaded>
  <td>
    <if:can_upload2>
    <form method='post' action='index.php?page=requests&amp;action=reqfill'>
      <input type='hidden' name='req_id' value='<tag:req_id />'>
      <input type='hidden' name='uid' value='<tag:uid />'>
      <input type='hidden' name='auth' value='<tag:uid_auth />'>
      <input type='text' name='fill_link' size='40' placeholder="<tag:language.TRAV_TIHH />">
      <input type='submit' class="btn btn-primary btn-sm" value='<tag:language.TRAV_FILL_REQ />'>
    </form>
    <else:can_upload2>
    <tag:language.TRAV_FILL_NO />
  </if:can_upload2>
</td>
</if:uploaded> 
</tr>
</tbody>
</table>
</div>
<br>
<br>
<div class="panel panel-default">
   <div class="panel-heading">
      <h4>Description</h4>
   </div>
   <div class="panel-body">
      <table class="table table-striped">
    <p><tag:req_descr /></p>
  </table>
  </div>
  </div>
<br>
<br>
</div>


<div class="panel panel-default">
   <div class="panel-heading">
      <h4>Comments</h4>
   </div>
   <div class="panel-body">
      <table class="table table-striped">
  <table width="100%" class="lista">
  <tr>
    <td align="center" colspan="3" class="header">
    <tag:lock />
    <button id="insert_comment" class="btn btn-info">Post a Comment</button>
    </td>
  </tr>
  <div style="height:17px" ><div id="flash" align="center" ></div></div>

      <table id="load_new_comment" width="100%" class="lista">
        <if:NO_COMMENTS>
      <tr>
        <td id="nc" colspan="3" class="lista" align="center"><tag:language.NO_COMMENTS /></td>
      </tr>
        <else:NO_COMMENTS>
  <!-- Comment Box -->
  <div id="message" style="display: none; background: rgba(100, 100, 100, 0.5); border:solid 1px #DEDEDE; border-radius: 10px; padding:4px; position: fixed; top: 40%; left: 40%;"></div>
  <tr>
    <td align="center" colspan="3">
     <div align="center" id="commentbox" style="display: none">
      <form enctype="multipart/form-data" name="comment" method="post" action="">
      <table class="lista" border="0" cellpadding="10">
        <tr>
        <td align="left" class="header"><tag:language.COMMENT_1 />:</td>
        <td class="lista" align="left"><tag:comment_comment /></td>
        </tr>
        <tr>
        <td class="header" colspan="2" align="center">
        <input type="submit" class="btn btn-primary" name="confirm" id="submit_btn" value="<tag:language.FRM_CONFIRM />" />
        </td>
        </tr>
      </table>
      </form>
  </div>
    </td>
  </tr>
</table>
  <!-- End Comment Box -->
</table>
</div>
</div>

<!-- Comments Script -->
<script>
    jQuery(document).ready(function($) {
    $("button#insert_comment").click(function() {  
      $('div#commentbox').slideToggle("slow");
      $('textarea').focus();
    });
    var info_hash = "<tag:torrent.info_hash />";
    var usern = "<tag:current_username />";
   
    $("#submit_btn").click(function() {
      var content = $("textarea").val();
      var c_length = $("textarea").val().length;
      if(c_length < 2)
        {
        $("#message").fadeIn(400).html('<div style="float: left;left: 14px;position: absolute;border: 5px solid #eeeeee;padding: 1px;"></div><p style=\'background:#EEEEEE; border-radius: 0px 5px 5px 5px; color:red; font-size: 22px; padding: 6px; margin: 10px; background-clip: padding-box;\'><img src="images/Badge-cancel.png" align="center">ERROR! Please Insert Some TEXT. <br />(At least 2 characters)</p>').delay (2000).fadeOut(1000);
        }
      else
        {
        var dataString = 'comment='+ content + '&id='+info_hash + '&user='+usern;
        $("#flash").fadeIn(400).html('<img src="images/loading-a.gif" align="center">&nbsp;<span>Loading Comment...</span>');
           $.ajax({  
              type: "POST",  
              url: "ajax-comment.php", 
              data: dataString,
              success: function(html) {  
              $("#load_new_comment > tbody > tr:first").before(html);
              $("textarea").val('');
              $("div#commentbox").slideToggle(2000);
              $("#flash").fadeOut(1000);
              $("#message").fadeIn(400).html('<div style="float: left;left: 14px;position: absolute;border: 5px solid #eeeeee; padding: 1px;"></div><p style="background:#EAF1DF; border-radius: 0px 5px 5px 5px; color: green; font-size: 22px; padding: 6px; margin: 10px; background-clip: padding-box;"><img src="images/Badge-tick.png" align="center">Comment Successfully Posted.<br />Thanks For Your Comment.</p>').delay (2000).fadeOut(1000);
              $("td.new").animate({
                  opacity: 1
                }, 1500, function() {
                  $(this).animate({background: "#b1b8e0"}, 2500, function(){$(this).removeClass("new")});
                  });
              $("#nc").remove();
                }  
              });  
        }
        return false;
      });
      
    });  
</script>

