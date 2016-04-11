<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Blu Chat</h4>
</div>
<?php

global $btit_settings;

//Calling block for ajax chat
if($btit_settings['fmhack_ajax_chat']=='enabled'){

   print "<fieldset><center><legend><a href='{$BASEURL}/chat/index.php'>Full screen</a></legend></center><iframe src='{$BASEURL}/chat/' width='100%' height='600px' name='custom_ajax_chat'>Your browser does not support iframe.</iframe></fieldset>";

}else{
   echo "<div align='center' style='color:red;'><b><span>Error</span><br /><br />This chat has been disbaled</b>";
}
?>
<div class="panel-footer">
</div>
</div>
