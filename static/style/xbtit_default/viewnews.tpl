<!-- VIEWNEWS.PHP Template - Just plain HTML and CSS + Template TAGS-->

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Dev Blog</h4>
</div>
<br>
<br>
<br>
<table class="table table-bordered">
  <if:news_exists>
  <loop:viewnews>
   <tr class= "info">
     <td class="lista" align="center">
       <h4><tag:viewnews[].news_title /></h4>     
     </td>
  </tr>
    <if:can_edit_news>
  <tr>
    <td class="header" align="left"><tag:viewnews[].add_edit_news />
      <if:can_delete_news>
        <tag:viewnews[].delete_news />
      </if:can_delete_news>
    </td>
  </tr>
  </if:can_edit_news>
  <tr>
     <td class="lista" align="left" style="text-align:left;font-size: 7pt;">
       <tag:language.POSTED_BY />:&nbsp;<tag:viewnews[].user_posted /><br />
       <tag:language.POSTED_DATE />:&nbsp;<tag:viewnews[].posted_date />
     </td>
   </tr>
   <tr><td><tag:viewnews[].news /></td></tr> 
  </loop:viewnews>
  <else:news_exists>
    <tr>
      <td align="center"><h3><p class= "text-danger"><tag:language.NO_NEWS /></p></h3>
        <if:can_edit_news_1>
        <tag:insert_news_link /><br />
        </if:can_edit_news_1>
      </td>
    </tr>
  </if:news_exists>
</table>
</div>
