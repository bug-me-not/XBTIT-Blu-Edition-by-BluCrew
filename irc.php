<?php
if(!defined("IN_BTIT") || $CURUSER['id'] < 2)
 redirect("index.php");

ob_start();
$text = 
"<div class=\"container\">
 <div class=\"row\">
   <div class=\"col-md-12\">
            <div class=\"panel panel-primary\">
               <div class=\"panel-heading\">
                  <h2 class=\"text-center\">BluRG IRC</h2>
               </div>
               <center>
                  <h3>To connect to our IRC with your client our official IRC network is irc.blurg.xyz</h3>
                  <br>
                  <h4>BluRG Channel List</h4>
                  <p class=\"text-danger\">( #blurg | #blurg_announce | #blurg_support )</p>
              </center>
           </p>
           <div class=\"panel-footer\">
           </div>
            </div>
        </div>
        </div>

         <div class=\"row\">
         <div class=\"col-md-12\">
         <div class=\"panel panel-primary\">
         <div class=\"panel-heading\">
         <h2 class=\"text-center\"></h2></div>
         <center><iframe src=\"https://kiwiirc.com/client/irc.blurg.xyz/?nick=BluRG|?&theme=cli#blurg\" style=\"border:0; width:100%; height:450px;\"></iframe></center>
         <div class=\"panel-footer\">
        </div>
        </div>
        </div>
        </div>
        </div>";

$irctpl = new bTemplate();
$irctpl->set("irc_text",$text);

ob_end_flush();

?>

