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
                  <h4 class=\"text-center\"></h4>
               </div>
               <span style=\"font-size: 14px\">
                  To connect to our IRC with your client our official IRC network is irc.blurg.xyz
                  <br>
                  BluRG Channel List 
                  ( #blurg | #blurg_announce | #blurg_support )
              </span>
           </p>
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