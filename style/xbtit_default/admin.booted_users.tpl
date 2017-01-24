<table class="header" width="100%" align="center">
  <tr>
    <td class="lista" colspan="4"><tag:pager_top /></td>
  </tr>
  <tr>
    <td class="header"><b><tag:language.ACP_BOOTED_NM /></b></td>
    <td class="header"><b><tag:language.ACP_BOOTED_EXP /></b></td>
    <td class="header"><b><tag:language.ACP_BOOTED_REA /></b></td>
    <td class="header"><b><tag:language.ACP_BOOTED_WHO /></b></td>
  </tr>
  <loop:boots>
  <tr>
    <td class="lista"><tag:boots[].username /></td>
    <td class="lista"><tag:boots[].addbooted /></td>
    <td class="lista"><tag:boots[].whybooted /></td>
    <td class="lista"><tag:boots[].whobooted /></td>
  </tr>
  </loop:boots>
  <tr>
    <td class="lista" colspan="4"><tag:pager_bottom /></td>
  </tr>
</table>
