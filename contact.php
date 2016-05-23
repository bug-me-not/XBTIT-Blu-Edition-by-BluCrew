<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT/DC FM.
//
//    Contact by DiemThuy - 08/2014
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

$date = date('l jS \of F Y');

$ipaddress = $_SERVER["REMOTE_ADDR"];

$contacttpl=new bTemplate();
$contacttpl->set("language",$language);

if(isset($_POST['submit']))
{
   $cat = $_POST['cat'];
   $subcat = $_POST['subcat'];
   $name = sql_esc($_POST['name']);
   $email = sql_esc($_POST['email']);
   $message = sql_esc($_POST['message']);

   $ipaddress = $_SERVER["REMOTE_ADDR"];

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

   if(!filter_var($email, FILTER_VALIDATE_EMAIL))
   {
      stderr("Error","E-mail address is not valid !!");
      stdfoot();
      die;

   }
   else
   {
      if($cat=="" || $cat=="Select Main Subject")
      {
         stderr("Error","Please select a Category !!");
         stdfoot();
         die;
      }
      else
      {
         if($subcat=="" || $subcat=="Select A Subcategory")
         {
            stderr("Error","Please select a Subcategory!!");
            stdfoot();
            die;
         }
         else
         {
            if($name=="")
            {
               stderr("Error","Please enter your Username!!");
               stdfoot();
               die;
            }
            else
            {
               if($email=="")
               {

                  stderr("Error","Please enter your email Address!!");
                  stdfoot();
                  die;
               }
               else
               {
                  if($message=="")
                  {
                     stderr("Error","Please enter a Message !!");
                     stdfoot();
                     die;
                  }
                  else
                  {
                     $insert = quickQuery("INSERT INTO {$TABLE_PREFIX}contact_system(name, email, cat, subcat, message, date, ipaddress) VALUES('$name', '$email', '$cat', '$subcat', '$message', '$date', '$ipaddress')");

                     if($insert)
                     {
                        information_msg("Send","Your message was successfully sent to our Staff Team. Please allow up to 32 hours for a response.");
                        stdfoot();
                        exit();
                     }
                     else
                     {
                        stderr("Error","<font color=\"red\"><b>There was an error while sending your message.<br><br>Please try again.</b></font>");
                        stdfoot();
                        die;

                     }
                  }
               }
            }
         }
      }
   }
}
else
{

   if (isset($CURUSER) && $CURUSER && $CURUSER["uid"]>1)
   $_POST['name']=$CURUSER["username"];

   $contacttpl->set("con2","<form name='frmSelect' method='POST' action='index.php?page=contact'>
   <table border='0'>
   <tr><td>Subject</td><td><select name='cat' onChange='handleOnChange(this);'>
   <option>Select Main Subject</option>
   <option>General Support</option>
   <option>Upload Errors</option>
   <option>Download Errors</option>
   <option>Bug Reports</option>
   <option>Advertising</option>
   </select>&nbsp;&nbsp;&nbsp;&nbsp;<select name=\"subcat\">
   <option>Select A Subcategory</option>
   </select></td></tr>
   <tr><td></td><td></td></tr>
   <tr><td>Your Username</td><td><input type=\"text\" name=\"name\" value=\"".$_POST['name']."\" size=\"50\" maxlength=\"200\"></td></tr>
   <tr><td></td><td></td></tr>
   <tr><td>Email Address</td><td><input type=\"text\" name=\"email\" value=\"".$_POST['email']."\" size=\"50\" maxlength=\"200\"></td></tr>
   <tr><td></td><td></td></tr>
   <tr><td>Message</td><td><textarea name=\"message\" cols=\"39\" rows=\"10\">".$_POST['message']."</textarea></td></tr>");

   //captcha
   global $USE_IMAGECODE,$THIS_BASEPATH;

   if ($USE_IMAGECODE && $action!="mod")
   {
      if (extension_loaded('gd'))
      {
         $arr = gd_info();
         if ($arr['FreeType Support']==1)
         {
            $p=new ocr_captcha();

            $contacttpl->set("CAPTCHA",true,true);

            $contacttpl->set("upload_captcha",$p->display_captcha(true));

            $private=$p->generate_private();
         }
         else
         {
            include("$THIS_BASEPATH/include/security_code.php");
            $scode_index = rand(0, count($security_code) - 1);
            $scode="<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
            $scode.=$security_code[$scode_index]["question"];
            $contacttpl->set("scode_question",$scode);
            $contacttpl->set("CAPTCHA",false,true);
         }
      }
      else
      {
         include("$THIS_BASEPATH/include/security_code.php");
         $scode_index = rand(0, count($security_code) - 1);
         $scode="<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
         $scode.=$security_code[$scode_index]["question"];
         $contacttpl->set("scode_question",$scode);
         $contacttpl->set("CAPTCHA",false,true);
      }
   }
   elseif ($action!="mod")
   {
      include("$THIS_BASEPATH/include/security_code.php");
      $scode_index = rand(0, count($security_code) - 1);
      $scode="<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
      $scode.=$security_code[$scode_index]["question"];
      $contacttpl->set("scode_question",$scode);
      // we will request simple operation to user
      $contacttpl->set("CAPTCHA",false,true);
   }
   //captcha
   $contacttpl->set("con3","<input type=\"hidden\" name=\"ipaddress\" value=\"$ipaddress\">
   <tr><td>&nbsp;</td><td><input type=\"submit\" name=\"submit\" value=\"Send\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"reset\" value=\"Reset\"></td></tr>
   </form>
   </table>
   <b>Your IP Address Is - ($ipaddress).</b>");
}
?>
