<?php
global $CURUSER;
if($CURUSER["view_users"]=="yes"){
?>
<table align=center width=100%><tr>
<td align=center>
<div name="timediv" id="timediv"></div>
</td>
</tr>
</table>
<?php
block_end();
}
?>