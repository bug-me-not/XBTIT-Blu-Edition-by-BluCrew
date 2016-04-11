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

$max_file_size = ($btit_settings["img_file_size"]*1024);
$max_image_width = $btit_settings["img_size_width"];
$max_image_height = $btit_settings["img_size_height"];

function UploadImage($file, $to_url, $allowed_types = NULL, $allowed_ext = NULL)
{
    global $uid, $max_file_size, $max_image_width, $max_image_height, $TABLE_PREFIX, $CURUSER, $btit_settings, $language;

    if(is_uploaded_file($file["tmp_name"]))
    {
        list($x, $y, $image_type) = getimagesize($file["tmp_name"]);

        $size = filesize($file["tmp_name"]);

        if($x > $max_image_width || $y > $max_image_height) {
            redirect("index.php?page=usercp&do=avatar&action=read&what=image_size&uid=".$uid."");
            die;
        }

        if($size > $max_file_size) {
            redirect("index.php?page=usercp&do=avatar&action=read&what=file_size&uid=".$uid."");
            die;
        }


        $split_name = explode(".", $file["name"]);
        $file_name = $file["name"];

        if((($allowed_types == NULL) || (array_search($image_type, $allowed_types, true) !== false)) && (($allowed_ext == NULL) || (array_search(strtolower($split_name[count($split_name) - 1]), $allowed_ext) !== false)))
        {

            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

            while(file_exists($to_url . $file_name))
            {
                $split_name[0] = $split_name[0] . $pattern{ rand(0, 35) };
                $file_name = implode(".", $split_name);
            }
            $file_name=str_replace(" ","_",$file_name);#space create problems for get_image_size!
            move_uploaded_file($file["tmp_name"], ($to_url . $file_name));
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `avatar_upload_name`='$file_name' WHERE `id` = $uid", true);
            return $file_name;
        }
    }
    return false;
}

function del(){
    global $file;
    $file = $_REQUEST["file"];
    $upload_dir = "avatar/";
    @unlink($upload_dir.$file);
}

switch ($action)
    {
    case 'upload':

        if((isset($_FILES["objUpload"]["tmp_name"]) && !empty($_FILES["objUpload"]["tmp_name"])) && (isset($_FILES["objUpload"]["name"]) && !empty($_FILES["objUpload"]["name"])))
        {
            $check_avatar=check_upload($_FILES["objUpload"]["tmp_name"], $_FILES["objUpload"]["name"]);

            switch($check_avatar)
            {
                case 1:
                case 2:
                    $check_avatar_err=$language["ERR_MISSING_DATA"];
                    if(file_exists($_FILES["objUpload"]["tmp_name"]))
                        @unlink($_FILES["objUpload"]["tmp_name"]);
                    break;

                case 3:
                  $check_avatar_err=$language["QUAR_TMP_FILE_MISS"];
                  break;

                case 4:
                  $check_avatar_err=$language["QUAR_OUTPUT"];
                  break;

                case 5:
                default:
                  $check_avatar_err="";
                  break;
            }
            if($check_avatar_err!="")
                stderr($language["ERROR"], $check_avatar_err);
        }
        $allowed_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
        $allowed_ext = array("jpg", "png", "gif", "jpeg");
        $path = "avatar/";
        $global = $_FILES["objUpload"];

        if($filename = UploadImage($global, $path, $allowed_types, $allowed_ext)){
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `avatar_upload`='yes', avatar='$BASEURL/avatar/$filename' WHERE `id` = $uid", true);
            redirect("index.php?page=usercp&do=avatar&action=read&what=success&uid=".$uid."");
        } else
            redirect("index.php?page=usercp&do=avatar&action=read&what=failure&uid=".$uid."");
    break;

    case 'delete':
        del();
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET avatar='', `avatar_upload`='no', `avatar_upload_name`='' WHERE `id`=$uid");
        redirect("index.php?page=usercp&do=avatar&action=read&uid=".$uid."");
    break;

    default:
    case 'read':
        $query = do_sqlquery("SELECT `avatar_upload`, `avatar_upload_name` FROM `{$TABLE_PREFIX}users` WHERE `id` = $uid", true);
        $avatar = $query->fetch_assoc();

        if ($avatar["avatar_upload"] == 'no') {
            if (!empty($what)){
                if ($what == 'image_size')
                    $notif = $language["AVATAR_FAILURE1"]." ".$max_image_width." x ".$max_image_height."";
                elseif ($what == 'file_size')
                    $notif = $language["AVATAR_FAILURE2"]." ".$max_file_size." kb";
                elseif ($what == 'failure')
                    $notif = $language["AVATAR_FAILURE3"];
                elseif ($what == 'success')
                    $notif = $language["AVATAR_SUCCESS"];
                $usercptpl-> set("notif", true, true);
                $usercptpl-> set("notif_msg", $notif);
            }
            else
                $usercptpl-> set("notif", false, true);

            $usercptpl-> set("already_upload", false, true);
            $usercptpl-> set("max_file_size", $max_file_size / 1024);
            $usercptpl-> set("max_image_width", $max_image_width);
            $usercptpl-> set("max_image_height", $max_image_height);
            $usercptpl-> set("language", $language);
            $usercptpl-> set("form_action", "index.php?page=usercp&do=avatar&action=upload&uid=".$uid."");
        } else {
            $usercptpl-> set("already_upload", true, true);
            $usercptpl-> set("language", $language);
            $usercptpl-> set("recent_avatar", $avatar["avatar_upload_name"]);
            $usercptpl-> set("link_to_file", $BASEURL."/avatar/".$avatar["avatar_upload_name"]);
            $usercptpl-> set("delete_image", "index.php?page=usercp&do=avatar&action=delete&file=".$avatar["avatar_upload_name"]."&uid=".$uid."");
        }
    break;
    }

?>