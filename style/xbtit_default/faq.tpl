<!-- faq.PHP Template - Just plain HTML and CSS + Template TAGS-->
<div style="float:left; width:100%; text-align:left;padding-left:10px;padding-top:10px;">
<if:faq_exists>
  <div style="float:left; width:100%; text-align:left;padding-left:10px;padding-top:10px;">
  <loop:faq>
      <div style="float:left; width:100%;">
            <b><tag:faq[].faq_group_title /></b>
      </div>
      <div style="float:left; width:100%; padding-left:10px;">
            <a href='<tag:faq[].faq_link />'><tag:faq[].faq_title /></a><br>
      </div>
  </loop:faq>
  <table cellpadding="4" cellspacing="1" align="left" border="0" width="99%" style="font-family:Verdana;font-size:11px" class="lista">
          <loop:faq2>
         
              <b><tag:faq2[].faq_group_title />
           <tr>
             <td class="lista" align="center">
               <b><a name='<tag:faq2[].faq_link />' id='<tag:faq2[].faq_link />'><tag:faq2[].faq_title /></a><br></b><br /><br />
                 <table style="border-top:1px solid gray; width:100%; font-family: Verdana;font-size:10px">
                   <tr><td><tag:faq2[].faq_text /></td></tr>
                 </table>
             </td>
          </tr>
           </loop:faq2>

    <if:read_verify>
      <form name="forced_faq" method="post" action="index.php?page=faq">
        <tr>
          <td class="header" align="center"><input type="checkbox" name="agree"><tag:language.FAQ_AGREE /></td>
        </tr>
        <tr>
          <td class="blocklist" align="center"><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
        </tr>
      </form>
    </if:read_verify>
     
  </table>
     
<else:faq_exists>
<div align="center">No F.A.Q.</div>
</if:faq_exists>
</div>

