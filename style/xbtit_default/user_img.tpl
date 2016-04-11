<div align="center">
  <tag:language.UIMG_MSG_1 /> <tag:user />, <tag:language.UIMG_MSG_2 />
  <br /><br />
  <tag:language.UIMG_MSG_3 />: <if:have_image><tag:userimages /><else:have_image><span style="color:darkred;"><b><tag:language.UIMG_NO_ICONS /></b></span></if:have_image><br />
  <table class="lista" width="60%" align="center">
    <tr>
      <td class="header" align="center" width="40%"><tag:language.TITLE /></td>
      <td class="header" align="center" width="20%"><tag:language.IMAGE /></td>
    </tr>
    <loop:image_list>
    <tr>
      <td class="lista" style="text-align:center;" width="40%"><tag:image_list[].desc /></td>
      <td class="lista" style="text-align:center;" width="20%"><tag:image_list[].img /></td>
    </tr>
    </loop:image_list>
  </table>
  <br /><br />
</div>