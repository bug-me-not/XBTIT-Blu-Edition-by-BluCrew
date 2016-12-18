<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse8">Support Us</a>
</h4>
</div>
<div id="collapse8" class="panel-collapse collapse in">
<?php
/////////////////////////////////////////////////////////////////////////////////////
// Donations by HDVinnie
////////////////////////////////////////////////////////////////////////////////////

block_begin("Donate");

echo "<table width='100%'>\n<tr>\n<td class='lista' style='text-align:center;'><br />";

print("<i class='fa fa-credit-card-alt fa-4x'></i>");

//go fund me
print("<p align=\"center\" class='text-danger'>Donate via Gofundme</p>");
print("<p align=\"center\" class='text-danger'>(Visa/Mastercard/Discover)</p><br />");
print "<a target=\"_blank\" style=\"border:none;\" href=\"index.php?page=donate_options\" title=\"Visit this page now.\"class=\"donate\">DONATE NOW</a><br />";
//go fund me

echo "<br /></td>\n</tr>\n</table>\n";

block_end();

?>
</div>
<div class="panel-footer">
</div>
</div>
