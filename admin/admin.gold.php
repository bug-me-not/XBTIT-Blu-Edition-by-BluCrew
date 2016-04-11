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

if (!defined("IN_ACP"))
      die("non direct access!");



$action=(isset($_GET["action"])?$_GET["action"]:"");
$settings = array();
function readGoldSettings()
{
	global $TABLE_PREFIX, $settings, $language, $BASEURL;
	 $res=get_result("SELECT * FROM {$TABLE_PREFIX}gold  WHERE id='1'",true);

       $count=0;


       foreach ($res as $key=>$value)
         {
             $settings[$count]["gold_picture"]=unesc("<img src='$BASEURL/images/".$value["gold_picture"]."' border='0' alt='gold'/>
             										  <br/>".$language["GOLD_CHOOSE_PIC"].":<br/><input type='file' name='gold_picture'/>");
             $settings[$count]["gold_percent"]=unesc("<input type='text' name='gold_percent' value='".$value["gold_percentage"]."' size='3' maxlength='3' />% (".(100-$value["gold_percentage"])."% ".$language["GOLD_FL"].")");
             $settings[$count]["silver_percent"]=unesc("<input type='text' name='silver_percent' value='".$value["silver_percentage"]."' size='3' maxlength='3' />% (".(100-$value["silver_percentage"])."% ".$language["GOLD_FL"].")");
             $settings[$count]["bronze_percent"]=unesc("<input type='text' name='bronze_percent' value='".$value["bronze_percentage"]."' size='3' maxlength='3' />% (".(100-$value["bronze_percentage"])."% ".$language["GOLD_FL"].")");
             $settings[$count]["level"]=createUsersLevelCombo(unesc($value["level"]));
             $settings[$count]["silver_picture"]=unesc("<img src='$BASEURL/images/".$value["silver_picture"]."' border='0'  alt='silver'/>
             											<br/>".$language["GOLD_CHOOSE_PIC"].":<br/><input type='file' name='silver_picture'/>");
             $settings[$count]["bronze_picture"]=unesc("<img src='$BASEURL/images/".$value["bronze_picture"]."' border='0'  alt='bronze'/>
             											<br/>".$language["GOLD_CHOOSE_PIC"].":<br/><input type='file' name='bronze_picture'/>");
             $settings[$count]["gold_description"]=unesc("<textarea name='gold_description' style='width:250px; height:120px; border:1px solid #999999;'>".$value["gold_description"]."</textarea>");
             $settings[$count]["silver_description"]=unesc("<textarea name='silver_description' style='width:250px; height:120px; border:1px solid #999999;'>".$value["silver_description"]."</textarea>");
             $settings[$count]["bronze_description"]=unesc("<textarea name='bronze_description' style='width:250px; height:120px; border:1px solid #999999;'>".$value["bronze_description"]."</textarea>");
             $settings[$count]["classic_description"]=unesc("<textarea name='classic_description' style='width:250px; height:120px; border:1px solid #999999;'>".$value["classic_description"]."</textarea>");
            
             $count++;
         }
        
}
function getFileExtension($name) {
		return substr($name, strrpos($name, '.'));
	}
switch ($action)
  {
    case "save":

       if (!isset($_POST["level"]) && !isset($_POST["gold_description"]) && !isset($_POST["silver_description"]) && !isset($_POST["classic_description"]) && !isset($_POST["bronze_description"]))
           {
            redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=gold");
            exit();
       }
       $pass = true;
       $error_msg='';
       $upload_path='/images/';
       $gold_file='';
       $silver_file='';
       $g_file_uploaded=false;
       $s_file_uploaded=false;
       $b_file_uploaded=false;
       if(isset($_FILES['gold_picture']) && $_FILES['gold_picture']['name'] !='')
       {
           if((isset($_FILES["gold_picture"]["tmp_name"]) && !empty($_FILES["gold_picture"]["tmp_name"])) && (isset($_FILES["gold_picture"]["name"]) && !empty($_FILES["gold_picture"]["name"])))
           {
               $check_gold=check_upload($_FILES["gold_picture"]["tmp_name"], $_FILES["gold_picture"]["name"]);

               switch($check_gold)
               {
                   case 1:              
                   case 2:
                     $check_gold_err=$language["ERR_MISSING_DATA"];
                     if(file_exists($_FILES["gold_picture"]["tmp_name"]))
                         @unlink($_FILES["gold_picture"]["tmp_name"]);
                     break;

                   case 3:
                     $check_gold_err=$language["QUAR_TMP_FILE_MISS"];
                     break;

                   case 4:
                     $check_gold_err=$language["QUAR_OUTPUT"];
                     break;

                   case 5:
                   default:
                     $check_gold_err="";
                     break;
               }
               if($check_gold_err!="")
                   stderr($language["ERROR"], $check_gold_err);
           }

       	if($_FILES['gold_picture']['size']>1)
       	{
       		if(is_uploaded_file($_FILES['gold_picture']['tmp_name']))
       		{
       			if(!is_dir($THIS_BASEPATH."/".$upload_path))
       			{
       				@mkdir($THIS_BASEPATH."/images",0777);
       			}
       			$size = @getimagesize($_FILES['gold_picture']['tmp_name']);
       			if($size[0]<=100 && $size[1]<=100)
       			{
	       			if (@move_uploaded_file($_FILES['gold_picture']['tmp_name'], $THIS_BASEPATH."/".$upload_path.'gold'.getFileExtension($_FILES['gold_picture']['name'])))
					{
						chmod($THIS_BASEPATH."/".$upload_path.'gold'.getFileExtension($_FILES['gold_picture']['name']),0777);
						$gold_file = 'gold'.getFileExtension($_FILES['gold_picture']['name']);
						$g_file_uploaded = true;
					}
					else 
					{
						$pass = false;
	       				$error_msg = $language["GOLD_NO_FILE"];
					}
					
       			}
       			else 
       			{
       				$pass = false;
	       			$error_msg = $language["GOLD_TOO_BIG"];
       			}
       		}
       		else 
       		{
       				$pass = false;
       				$error_msg = $language["GOLD_NOT_UPPED"];
       		}
       	}
       	else 
       	{
       		$pass = false;
       		$error_msg = $language["GOLD_TOO_SMALL"];
       	}
       }
       if(isset($_FILES['silver_picture']) && $_FILES['silver_picture']['name'] !='')
       {
           if((isset($_FILES["silver_picture"]["tmp_name"]) && !empty($_FILES["silver_picture"]["tmp_name"])) && (isset($_FILES["silver_picture"]["name"]) && !empty($_FILES["silver_picture"]["name"])))
           {
               $check_silver=check_upload($_FILES["silver_picture"]["tmp_name"], $_FILES["silver_picture"]["name"]);
          
               switch($check_silver)
               {
                   case 1:              
                   case 2:
                     $check_silver_err=$language["ERR_MISSING_DATA"];
                     if(file_exists($_FILES["silver_picture"]["tmp_name"]))
                         @unlink($_FILES["silver_picture"]["tmp_name"]);
                     break;

                   case 3:
                     $check_silver_err=$language["QUAR_TMP_FILE_MISS"];
                     break;

                   case 4:
                     $check_silver_err=$language["QUAR_OUTPUT"];
                     break;

                   case 5:
                   default:
                     $check_silver_err="";
                     break;
               }
               if($check_silver_err!="")
                   stderr($language["ERROR"], $check_silver_err);
           }
       	if($_FILES['silver_picture']['size']>1)
       	{
       		if(is_uploaded_file($_FILES['silver_picture']['tmp_name']))
       		{
       			
       			if(!is_dir($THIS_BASEPATH."/".$upload_path))
       			{
       				@mkdir($THIS_BASEPATH."/images",0777);
       				//chmod($_SERVER['DOCUMENT_ROOT'].$upload_path,0777);
       			}
       			
       			$size = @getimagesize($_FILES['silver_picture']['tmp_name']);
       			
       			if($size[0]<=100 && $size[1]<=100)
       			{
	       			if (@move_uploaded_file($_FILES['silver_picture']['tmp_name'], $THIS_BASEPATH."/".$upload_path.'silver'.getFileExtension($_FILES['silver_picture']['name'])))
					{
						
						chmod($THIS_BASEPATH."/".$upload_path.'silver'.getFileExtension($_FILES['silver_picture']['name']),0777);
						$silver_file = 'silver'.getFileExtension($_FILES['silver_picture']['name']);
						$s_file_uploaded = true;
					}
					else 
					{
						$pass = false;
	       				$error_msg = $language["GOLD_NO_FILE"];
					}
					
       			}
       			else 
       			{
       				$pass = false;
	       			$error_msg = $language["GOLD_TOO_BIG"];
       			}
       		}
       		else 
       		{
       				$pass = false;
       				$error_msg = $language["GOLD_NOT_UPPED"];
       		}
       	}
       	else 
       	{
       		$pass = false;
       		$error_msg = $language["GOLD_TOO_SMALL"];
       	}
       }
       if(isset($_FILES['bronze_picture']) && $_FILES['bronze_picture']['name'] !='')
       {
           if((isset($_FILES["bronze_picture"]["tmp_name"]) && !empty($_FILES["bronze_picture"]["tmp_name"])) && (isset($_FILES["bronze_picture"]["name"]) && !empty($_FILES["bronze_picture"]["name"])))
           {
               $check_bronze=check_upload($_FILES["bronze_picture"]["tmp_name"], $_FILES["bronze_picture"]["name"]);
          
               switch($check_bronze)
               {
                   case 1:              
                   case 2:
                     $check_bronze_err=$language["ERR_MISSING_DATA"];
                     if(file_exists($_FILES["bronze_picture"]["tmp_name"]))
                         @unlink($_FILES["bronze_picture"]["tmp_name"]);
                     break;

                   case 3:
                     $check_bronze_err=$language["QUAR_TMP_FILE_MISS"];
                     break;

                   case 4:
                     $check_bronze_err=$language["QUAR_OUTPUT"];
                     break;

                   case 5:
                   default:
                     $check_bronze_err="";
                     break;
               }

               if($check_bronze_err!="")
                   stderr($language["ERROR"], $check_bronze_err);
           }
       	if($_FILES['bronze_picture']['size']>1)
       	{
       		if(is_uploaded_file($_FILES['bronze_picture']['tmp_name']))
       		{
       			if(!is_dir($THIS_BASEPATH."/".$upload_path))
       			{
       				@mkdir($THIS_BASEPATH."/images",0777);
       			}
       			$size = @getimagesize($_FILES['bronze_picture']['tmp_name']);
       			if($size[0]<=100 && $size[1]<=100)
       			{
	       			if (@move_uploaded_file($_FILES['bronze_picture']['tmp_name'], $THIS_BASEPATH."/".$upload_path.'bronze'.getFileExtension($_FILES['bronze_picture']['name'])))
					{
						chmod($THIS_BASEPATH."/".$upload_path.'bronze'.getFileExtension($_FILES['bronze_picture']['name']),0777);
						$bronze_file = 'bronze'.getFileExtension($_FILES['bronze_picture']['name']);
						$b_file_uploaded = true;
					}
					else 
					{
						$pass = false;
	       				$error_msg = $language["GOLD_NO_FILE"];
					}
					
       			}
       			else 
       			{
       				$pass = false;
	       			$error_msg = $language["GOLD_TOO_BIG"];
       			}
       		}
       		else 
       		{
       				$pass = false;
       				$error_msg = $language["GOLD_NOT_UPPED"];
       		}
       	}
       	else 
       	{
       		$pass = false;
       		$error_msg = $language["GOLD_TOO_SMALL"];
       	}
       }
      if($pass)
      {
       $level = unesc($_POST['level']);
       $gold_description = unesc($_POST['gold_description']);
       $silver_description = unesc($_POST['silver_description']);
       $bronze_description = unesc($_POST['bronze_description']);
       $classic_description = unesc($_POST['classic_description']);
       if($g_file_uploaded)
       {
       	$gold_picture = $gold_file;
       }
       else 
       {
       		$res=get_result("SELECT * FROM {$TABLE_PREFIX}gold  WHERE id='1'",true);
       		foreach ($res as $key=>$value)
         	{
         		$gold_picture = $value["gold_picture"];
         	}
       }
	   if($s_file_uploaded)
       {
       	$silver_picture = $silver_file;
       }
       else 
       {
       		$res=get_result("SELECT * FROM {$TABLE_PREFIX}gold  WHERE id='1'",true);
       		foreach ($res as $key=>$value)
         	{
         		$silver_picture = $value["silver_picture"];
         	}
       }
	   if($b_file_uploaded)
       {
       	$bronze_picture = $bronze_file;
       }
       else 
       {
       		$res=get_result("SELECT * FROM {$TABLE_PREFIX}gold  WHERE id='1'",true);
       		foreach ($res as $key=>$value)
         	{
         		$bronze_picture = $value["bronze_picture"];
         	}
       }
       $res=get_result("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold`  WHERE `id`='1'",true);
       $new_gold_percent=(float)0+$_POST["gold_percent"];
       $new_silver_percent=(float)0+$_POST["silver_percent"];
       $new_bronze_percent=(float)0+$_POST["bronze_percent"];

       $current=$res[0];
       $gold_change=false;
       $silver_change=false;
       $bronze_change=false;
       if($new_gold_percent>=0 && $new_gold_percent<=100 && $current["gold_percentage"]!=$new_gold_percent)
       {
           $gold_change=true;
           if($XBTT_USE)
               quickQuery("UPDATE `{$TABLE_PREFIX}files` `f` LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash` SET `xf`.`down_multi`=".$new_gold_percent.", `xf`.`flags`=2 WHERE `f`.`gold`=2", true);
       }
       if($new_silver_percent>=0 && $new_silver_percent<=100 && $current["silver_percentage"]!=$new_silver_percent)
       {
           $silver_change=true;
           if($XBTT_USE)
               quickQuery("UPDATE `{$TABLE_PREFIX}files` `f` LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash` SET `xf`.`down_multi`=".$new_silver_percent.", `xf`.`flags`=2 WHERE `f`.`gold`=1", true);
       }
       if($new_bronze_percent>=0 && $new_bronze_percent<=100 && $current["bronze_percentage"]!=$new_bronze_percent)
       {
           $bronze_change=true;
           if($XBTT_USE)
               quickQuery("UPDATE `{$TABLE_PREFIX}files` `f` LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash` SET `xf`.`down_multi`=".$new_bronze_percent.", `xf`.`flags`=2 WHERE `f`.`gold`=3", true);
       }
       quickQuery("UPDATE `{$TABLE_PREFIX}gold` 
       				SET `level` = $level, ".
                    (($gold_change===true)?"`gold_percentage` = '$new_gold_percent', ":"").
                    (($silver_change===true)?"`silver_percentage` = '$new_silver_percent', ":"").
                    (($bronze_change===true)?"`bronze_percentage` = '$new_bronze_percent', ":"")."
                    `gold_description` = '$gold_description', 
       				`silver_description` = '$silver_description',
       				`bronze_description` = '$bronze_description', 
       				`classic_description` = '$classic_description' ,
       				`silver_picture` = '$silver_picture' ,
       				`gold_picture` = '$gold_picture',
       				`bronze_picture` = '$bronze_picture'
       				WHERE `id`='1'",true);
      
       $admintpl->set("settings_done_msg","<div align=\"center\">Settings saved!</div>");
      }
      else 
      {
      	
      	 $admintpl->set("settings_done_msg",$error_msg);
      }
      	$admintpl->set("language",$language);
       readGoldSettings();
       
       $admintpl->set("settings",$settings);
       $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=gold&amp;action=save");
       break;

    default:

      $block_title=$language["PRUNE_TORRENTS"];
      
      readGoldSettings();

      $admintpl->set("language",$language);
	  $admintpl->set("settings_done_msg","");
	  $admintpl->set("settings",$settings);
      $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=gold&amp;action=save");
      
}

?>