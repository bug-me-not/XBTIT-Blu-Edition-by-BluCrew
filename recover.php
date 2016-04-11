<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
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



require_once(load_language("lang_recover.php"));

if (isset($_GET["act"])) $act=$_GET["act"];
  else $act="recover";



if ($act == "takerecover")
{
  $email = trim($_POST["email"]);
  if (!$email)
    stderr($language["ERROR"],$language["ERR_NO_EMAIL"]);

  $res = do_sqlquery("SELECT id, email FROM {$TABLE_PREFIX}users WHERE email=".sqlesc($email)." LIMIT 1",true);
  $arr = $res->fetch_assoc() or stderr($language["ERROR"],$language["ERR_EMAIL_NOT_FOUND_1"]." <b>$email</b> ".$language["ERR_EMAIL_NOT_FOUND_2"]);
if ($USE_IMAGECODE)
{
  if (extension_loaded('gd'))
    {
     $arr_gd = gd_info();
     if ($arr_gd['FreeType Support']==1)
      {
        $public=$_POST['public_key'];
        $private=$_POST['private_key'];

          $p=new ocr_captcha();

          if ($p->check_captcha($public,$private) != true)
              {
              stderr($language["ERROR"],$language["ERR_IMAGE_CODE"]);
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

$floor = 100000;
$ceiling = 999999;
srand((double)microtime()*1000000);
$random = rand($floor, $ceiling);

quickQuery("UPDATE {$TABLE_PREFIX}users SET random='$random' WHERE id='".$arr["id"]."'",true);
if (sql_affected_rows()==0)
    stderr($language["ERROR"],"".$language["ERR_DB_ERR"].",".$arr["id"].",".$email.",".$random."");

$user_temp_id = $arr["id"];
$user_temp_email = $email;

$body=sprintf($language["RECOVER_EMAIL_1"],$email,$_SERVER["REMOTE_ADDR"],"$BASEURL/index.php?page=recover&act=generate&id=$user_temp_id&random=$random",$SITENAME);

  send_mail( $arr["email"], "$SITENAME ".$language["PASS_RESET_CONF"], $body) or stderr($language["ERROR"],$language["ERR_SEND_EMAIL"]);
  success_msg($language["SUCCESS"],$language["SUC_SEND_EMAIL"]." <b>$email</b>.\n".$language["SUC_SEND_EMAIL_2"]);
  $tpl->set("main_footer",bottom_menu()."<br />\n");
  $tpl->set("btit_version",print_version());
  echo $tpl->fetch(load_template("main.tpl"));
  die();

}
elseif ($act == "generate")
{

    $id = intval(0 + $_GET["id"]);
    $random = intval($_GET["random"]);

if (!$id || !$random || empty($random) || $random==0)
    stderr($language["ERROR"],$language["ERR_UPDATE_USER"]);

$res = do_sqlquery("SELECT `username`, `email`, `random`".((substr($GLOBALS["FORUMLINK"],0,3)=="smf") ? ", `smf_fid`" : (($GLOBALS["FORUMLINK"]=="ipb")?", ipb_fid":""))." FROM `{$TABLE_PREFIX}users` WHERE `id` = $id",true);
$arr = $res->fetch_array();

if ($random!=$arr["random"])
    stderr($language["ERROR"],$language["ERR_UPDATE_USER"]);

    $email = $arr["email"];
    $newpassword=pass_the_salt(20);
    $multipass=hash_generate(array("salt" => ""), $newpassword, $arr["username"]);
    $i=$btit_settings["secsui_pass_type"];

    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `password`='".sql_esc($multipass[$i]["rehash"])."', `salt`='".sql_esc($multipass[$i]["salt"])."', `pass_type`='".$i."', `dupe_hash`='".sql_esc($multipass[$i]["dupehash"])."' WHERE `id`=$id AND `random`=$random",true);

    if (!sql_affected_rows())
        stderr($language["ERROR"],$language["ERR_UPDATE_USER"]);

    if(substr($GLOBALS["FORUMLINK"],0,3)=="smf")
    {
        $passhash=smf_passgen($arr["username"], $newpassword);
        quickQuery("UPDATE `{$db_prefix}members` SET `passwd`='$passhash[0]', `password".(($FORUMLINK=="smf")?"S":"_s")."alt`='$passhash[1]' WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$arr["smf_fid"],true);
    }
	elseif($GLOBALS["FORUMLINK"]=="ipb")
 	{
        if(!defined('IPS_ENFORCE_ACCESS'))
            define('IPS_ENFORCE_ACCESS', true);
        if(!defined('IPB_THIS_SCRIPT'))
            define('IPB_THIS_SCRIPT', 'public');

        if(!isset($THIS_BASEPATH) || empty($THIS_BASEPATH))
            $THIS_BASEPATH=dirname(__FILE__);

 	  	require_once($THIS_BASEPATH. '/ipb/initdata.php' );
 	  	require_once( IPS_ROOT_PATH . 'sources/base/ipsRegistry.php' );
 	    require_once( IPS_ROOT_PATH . 'sources/base/ipsController.php' );
 	  	$registry = ipsRegistry::instance();
	    $registry->init();
 	  	$ipbhash=ipb_passgen($newpassword);
 	  	IPSMember::save($arr["ipb_fid"], array("members" => array("member_login_key" => "", "member_login_key_expire" => "0", "members_pass_hash" => "$ipbhash[0]", "members_pass_salt" => "$ipbhash[1]")));
 	}
  $body=sprintf($language["RECOVER_EMAIL_2"],$arr["username"],$newpassword,"$BASEURL/index.php?page=login",$SITENAME);
  send_mail($email, "$SITENAME ".$language["ACCOUNT_DETAILS"], $body) or stderr($language["ERROR"],$language["ERR_SEND_EMAIL"]);
  redirect("index.php?page=recover&act=recover_ok&id=$id&random=$random");
  die();
}
elseif ($act=="recover_ok")
{
  $id = intval(0 + $_GET["id"]);
  $random = intval($_GET["random"]);
                          
  if (!$id || !$random || empty($random) || $random==0)
       stderr($language["ERROR"],$language["ERR_UPDATE_USER"]);

   $res = do_sqlquery("SELECT `username`, `email`, `random`".((substr($GLOBALS["FORUMLINK"],0,3)=="smf") ? ", `smf_fid`" : "")." FROM `{$TABLE_PREFIX}users` WHERE `id` = $id",true);
  $arr = $res->fetch_array();

  if ($random!=$arr["random"])
       stderr($language["ERROR"],$language["ERR_UPDATE_USER"]);

  $email = $arr["email"];

  success_msg($language["SUCCESS"],$language["SUC_SEND_EMAIL"]." <b>$email</b>.\n".$language["SUC_SEND_EMAIL_2"]);

  $tpl->set("main_footer",bottom_menu()."<br />\n");
  $tpl->set("btit_version",print_version());
  echo $tpl->fetch(load_template("main.tpl"));
  die();


}
elseif ($act == "recover");
{
    $recovertpl=new bTemplate();
    global $language, $recovertpl;
    $recovertpl->set("language",$language);
    $recover=array();
    $recover["action"]="index.php?page=recover&amp;act=takerecover";
    $recovertpl->set("recover",$recover);

    if ($USE_IMAGECODE)
      {
       if (extension_loaded('gd'))
         {
           $arr = gd_info();
           if ($arr['FreeType Support']==1)
             {
              $p=new ocr_captcha();
              $recovertpl->set("CAPTCHA",true,true);
              $recovertpl->set("recover_captcha",$p->display_captcha(true));
              $private=$p->generate_private();
               }
           else
             {
               include("$THIS_BASEPATH/include/security_code.php");
               $scode_index = rand(0, count($security_code) - 1);
               $scode="<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
               $scode.=$security_code[$scode_index]["question"];
               $recovertpl->set("scode_question",$scode);
               $recovertpl->set("CAPTCHA",false,true);
             }
         }
         else
           {
             include("$THIS_BASEPATH/include/security_code.php");
             $scode_index = rand(0, count($security_code) - 1);
             $scode="<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
             $scode.=$security_code[$scode_index]["question"];
             $recovertpl->set("scode_question",$scode);
             $recovertpl->set("CAPTCHA",false,true);
           }
       }
    else
      {
        include("$THIS_BASEPATH/include/security_code.php");
        $scode_index = rand(0, count($security_code) - 1);
        $scode="<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
        $scode.=$security_code[$scode_index]["question"];
        $recovertpl->set("scode_question",$scode);
        $recovertpl->set("CAPTCHA",false,true);
      }
}

?>