<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Blu Chat</a>
</h4>
</div>
<div id="collapse2" class="panel-collapse collapse in">
<?php

global $btit_settings;

//Calling block for ajax chat
if($btit_settings['fmhack_ajax_chat']=='enabled'){

   print "<fieldset><center><legend><a href='{$BASEURL}/chat/index.php'>Full screen</a></legend></center><iframe src='{$BASEURL}/chat/' width='100%' height='600px' name='custom_ajax_chat'>Your browser does not support iframe.</iframe></fieldset>";

}else{
   echo "<div align='center' style='color:red;'><b><span>Error</span><br /><br />This chat has been disbaled</b>";
}
?>
</div>
<div class="panel-footer">
</div>
</div>
