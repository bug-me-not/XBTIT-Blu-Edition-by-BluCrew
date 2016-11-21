<table class="header" width="100%" align="center">

  <tr>

    <td class="header"><b>Where did the users hear about us</b></td>
    <td class="header"><b><center>Sign up date</b></center></td>
    <td class="header"><b>Username</b></td>


  </tr>
  <loop:heardlog>
  <tr>


    <td class="lista"><tag:heardlog[].where /></td>
    <td class="lista"><center><tag:heardlog[].date /></center></td>
    <td class="lista"><tag:heardlog[].username /></td>

  </tr>
  </loop:heardlog>

</table>
