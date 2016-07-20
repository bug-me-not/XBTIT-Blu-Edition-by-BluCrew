<?php
if(!defined("IN_BTIT") || $CURUSER['id'] < 2)
 redirect("index.php");

ob_start();
$text = 
"<div class=\"container\">
<div class=\"row\">
   <div class=\"col-md-12\">

      <center><h1>BluRG.xyz Donation Page</h1>
         <p><b>Thank You for visiting the Donation page! We are a community run site so your support means alot!</b></p><br>
         <div class=\"colors\" font-size=\"2em\">[Please PM <a href=\"index.php?page=userdetails&id=12922\"><span class=\"red\">Vinnie</span></a> with your confirmation details and your account will be credited ASAP]</div><br>
         <br>
            <p class='text-danger'>IMPORTANT NOTES:</p>
            <p class='text-danger'>Donations DO NOT exempt you from the rules or from being banned.</p><br><br>

            <div class=\"panel panel-primary\">
               <div class=\"panel-heading\">
                  <h4 class=\"text-center\"></h4>
               </div>
               <p class='text-success'>All VIP Rank Packages include:</p>
               <span style=\"font-size: 14px\">
                 A star <img src=\"/images/donor.gif\"><br>
                 Unlimited download slots<br>
                 Immune to Low Ratio System<br>
                 Clear of all Warnings<br>
                 Immune to H&R System<br>
                 Immune to Auto Warn and Ban System<br>
                 Hit and run log count cleared<br>
                 Higher Requests Priority<br>
                 Sparkle Effects Username<br>
                 Sitewide Freeleech<br>
                 VIP Forum Access (Includes Forum for other tracker invites)<br><br>
              </span>
           </p>
           <div class=\"panel-footer\">
           </div>
        </div>


        <h2>Choose the amount you wish to donate from the 9 options below</h2>
        <h3>Please mark your donation as hidden/anon on gofundme or else your real name will be made public. Due to the provider refunds are NOT possible.</h3><br><br></center>

     </div>
  </div>
</div>

<div class=\"bs-example-main clearfix\">
   <div class=\"container\">
      <div class=\"row\">
         <div class=\"col-md-12\">
         </div>
      </div>
      <div class=\"row\">
         <div class=\"col-md-4\">
            <div class=\"panel panel-danger\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 1</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$5</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 1 Week VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 5000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 15GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 1 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-danger\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         <div class=\"col-md-4\">
            <div class=\"panel panel-info\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 2</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$10</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 2 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 10,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 30GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 3 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-info\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         <div class=\"col-md-4\">
            <div class=\"panel panel-success\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 3</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$20</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 5 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 15,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 75GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 6 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-success\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class=\"bs-example-main clearfix\">
   <div class=\"container\">
      <div class=\"row\">
         <div class=\"col-md-12\">
         </div>
      </div>
      <div class=\"row\">
         <div class=\"col-md-4\">
            <div class=\"panel panel-danger\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 4</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$30</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 7 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 20,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 125GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 9 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-danger\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         <div class=\"col-md-4\">
            <div class=\"panel panel-info\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 5</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$40</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 10 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 30,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 200GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 12 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-info\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         <div class=\"col-md-4\">
            <div class=\"panel panel-success\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 6</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$50</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 20 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 40,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 300GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 15 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-success\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class=\"bs-example-main clearfix\">
   <div class=\"container\">
      <div class=\"row\">
         <div class=\"col-md-12\">
         </div>
      </div>
      <div class=\"row\">
         <div class=\"col-md-4\">
            <div class=\"panel panel-danger\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 7</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$60</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 30 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 50,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 400GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 18 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-danger\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         <div class=\"col-md-4\">
            <div class=\"panel panel-info\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 8</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$80</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 40 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 75,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 500GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 21 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-info\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         <div class=\"col-md-4\">
            <div class=\"panel panel-success\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">Option 9</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$100</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 50 Weeks VIP</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 100,000 BON</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 600 GB Upload Credit</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> 25 Freelecch Slot</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-success\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class=\"bs-example-main clearfix\">
   <div class=\"container\">
      <div class=\"row\">
         <div class=\"col-md-12\">
         </div>
      </div>
      <div class=\"row\">
         <div class=\"col-md-12\">
            <div class=\"panel panel-warning\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">LIFETIME</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$250</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> FOREVER VIP</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-warning\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class=\"bs-example-main clearfix\">
   <div class=\"container\">
      <div class=\"row\">
         <div class=\"col-md-12\">
         </div>
      </div>
      <div class=\"row\">
         <div class=\"col-md-6\">
            <div class=\"panel panel-primary\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">BluFLIX PLEX Access BASIC</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$7 Per Month</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> Access to BluFLIX Library via PLEX</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i>Only One Active Stream Per BluFLIX Plex account at a time please!</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> Movies, HDTV and Kids Librarys</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i><br></li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-primary\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>

         <div class=\"col-md-6\">
            <div class=\"panel panel-primary\">
               <div class=\"panel-heading\">
                  <h3 class=\"text-center\">BluFLIX PLEX Access PLUS</h3>
               </div>
               <div class=\"panel-body text-center\">
                  <p class=\"lead\" style=\"font-size:40px\"><strong>$10 Per Month</strong></p>
               </div>
               <ul class=\"list-group list-group-flush text-center\">
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> Access to BluFLIX Library via PLEX</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i>Only Two Active Stream Per BluFLIX Plex account at a time please!</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> Movies, HDTV and Kids Librarys</li>
                  <li class=\"list-group-item\"><i class=\"icon-ok text-danger\"></i> Offline Play Option (Sync Media To A Device)</li>
               </ul>
               <div class=\"panel-footer\">
                  <a class=\"btn btn-lg btn-block btn-primary\" href=\"https://www.gofundme.com/kfukmgyc?utm_medium=wdgt\">GET NOW!</a>
               </div>
            </div>
         </div>
         </div>
      </div>
</div>";



$donateotpl = new bTemplate();
$donateotpl->set("doante_text",$text);

ob_end_flush();

?>