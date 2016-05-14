<!-- VIEWNEWS.PHP Template - Just plain HTML and CSS + Template TAGS-->

<center><h2>Under Contruction</h2></center>

<div class="panel panel-primary">
<table class="table table-bordered">
  <if:news_exists>
  <loop:viewnews>
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
   <tr>
     <td class="lista" align="left">
       <b><tag:language.TITLE />:&nbsp;<tag:viewnews[].news_title /></b><br /><br />
         <table style="border-top:1px solid #000000;width:100%;font-family:Verdana;font-size:10px;">
           <tr><td><tag:viewnews[].news /></td></tr>
         </table>
     </td>
  </tr>
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
