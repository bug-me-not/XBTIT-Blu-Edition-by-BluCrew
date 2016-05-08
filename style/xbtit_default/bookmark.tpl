<table class="table table-bordered">

  <if:pagertop_visible>
    <tr>
      <td class="blocklist" align="center" colspan="11"><tag:pagertop /></td>
    </tr>
  </if:pagertop_visible>

  <tr>
    <td class="head" align="center"><b><tag:language.CATEGORY_FULL /></b></td>
    <td class="head" align="center"><b><tag:language.FILE /></b></td>
    <td class="head" align="center"><b><tag:language.TB_DOWN /></b></td>
    <td class="head" align="center"><b><tag:language.SIZE /></b></td>
    <td class="head" align="center"><b><tag:language.SHORT_S /></b></td>
    <td class="head" align="center"><b><tag:language.SHORT_L /></b></td>
    <td class="head" align="center"><b><tag:language.SHORT_C /></b></td>
    <td class="head" align="center"><b><tag:language.SPEED /></b></td>
    <td class="head" align="center"><b><tag:language.TB_BOOKMARKED /></b></td>
    <td class="head" align="center"><b><tag:language.DELETE /></b></td>
  </tr>


  <if:wish_empty>
    <td class="lista" style="text-align:center;" colspan="11"><tag:language.TB_NOTHING_TO_SEE /></td>
  <else:wish_empty>
    <loop:wish>
    <tr>
      <td class="lista" style="text-align:center;"><tag:wish[].category /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].file /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].down /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].size /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].seed /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].leech /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].completed /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].speed /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].added /></td>
      <td class="lista" style="text-align:center;"><tag:wish[].delete /></td>
    </tr>
    </loop:wish>
  </if:wish_empty>

  <if:pagerbottom_visible>
    <tr>
      <td class="blocklist" align="center" colspan="11"><tag:pagertop /></td>
    </tr>
  </if:pagerbottom_visible>

</table>


