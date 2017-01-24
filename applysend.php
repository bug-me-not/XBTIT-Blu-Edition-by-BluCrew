<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT/DC FM.
//
// Apply for membership by DiemThuy - 06/2014
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

if (!defined("IN_BTIT"))
      die("non direct access!");
      
$intentioneaza=$_POST['intentioneaza'];
$sursa=$_POST['sursa'];
$sursas=$_POST['sursas'];
$altsite=$_POST['altsite'];
$motiv=$_POST['motiv'];
$stisite=$_POST['stisite'];
$regulament=$_POST['regulament'];
$oday=$_POST['oday'];
$sursaa=$_POST['sursaa'];
$sursad=$_POST['sursad'];
$sursaf=$_POST['sursaf'];
$seet=$_POST['seet'];

//captcha
global $USE_IMAGECODE,$THIS_BASEPATH;
if ($USE_IMAGECODE)
{
  if (extension_loaded('gd'))
    {
     $arr = gd_info();
     if ($arr['FreeType Support']==1)
      {
        $public=$_POST['public_key'];
        $private=$_POST['private_key'];

          $p=new ocr_captcha();

          if ($p->check_captcha($public,$private) != true)
              {
              err_msg($language["ERROR"],$language["ERR_IMAGE_CODE"]);
              stdfoot();
              exit;
          }
       }
       else
         {
           include("$THIS_BASEPATH/include/security_code.php");
           $scode_index=intval($_POST["security_index"]);
           if ($security_code[$scode_index]["answer"]!=$_POST["scode_answer"])
              {
              err_msg($language["ERROR"],$language["ERR_IMAGE_CODE"]);
              stdfoot();
              exit;
            }
         }
    }
     else
       {
         include("$THIS_BASEPATH/include/security_code.php");
         $scode_index=intval($_POST["security_index"]);
         if ($security_code[$scode_index]["answer"]!=$_POST["scode_answer"])
            {
            err_msg($language["ERROR"],$language["ERR_IMAGE_CODE"]);
            stdfoot();
            exit;
          }
       }
}
else
  {
    include("$THIS_BASEPATH/include/security_code.php");
    $scode_index=intval($_POST["security_index"]);
    if ($security_code[$scode_index]["answer"]!=$_POST["scode_answer"])
       {
       err_msg($language["ERROR"],$language["ERR_IMAGE_CODE"]);
       stdfoot();
       exit;
     }
}
//captcha


if(!empty($intentioneaza) && !empty($sursa) && !empty($sursas) && !empty($altsite) && !empty($motiv) && !empty($stisite) && !empty($regulament) && !empty($oday) && !empty($seet)) {

$user=$sursas;

$msg="Request to become a member \n\n
[color=red]Desired user name:[/color] $user\n
[color=red]Email adress:[/color] $sursa\n
[color=red]Country:[/color] $intentioneaza\n
[color=red]Did hear about our website( or referred by ):[/color] $altsite\n
[color=red]Want to be a member because:[/color] $motiv\n
[color=red]Want to do what for our website:[/color] $stisite\n
[color=red]Know the rules:[/color] $regulament\n
[color=red]Have a seedbox:[/color] $oday\n
[color=red]Will seed up to:[/color] $seet %\n
[color=red](opt))Profile link 1:[/color] $sursaa\n
[color=red](opt))Profile link 2:[/color] $sursad\n
[color=red](opt))Profile link 3:[/color] $sursaf\n
If you aprove this member [$user] , you can create a account in acp/add new user\n 
After that send the user his nick/pw by email.
";

;
$ms=sqlesc($msg);

send_pm(0,2,sqlesc("New Member Request - Desired Username $user"),$ms);



       stderr("Application Sended", "The staff will review your application, after that, you will get a response, thank you ");
       stdfoot();
       die;
}
else
{
       stderr("Alert ! ", "You did not fill in all needed (*) fields");
       stdfoot();
       die;
}

?>