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


$parentform=$_GET["form"];
$parentarea=$_GET["text"];


$count=0;
$i=0;
reset($smilies);
reset($privatesmilies);

$all_smiles=array();



 if($btit_settings["fmhack_custom_smileys"]=="enabled")
 {
    global $TABLE_PREFIX;
    $list=get_result("SELECT `key`,`value` FROM {$TABLE_PREFIX}smilies",true);
    foreach($list as $code=>$url)
    {
    switch($i)
       {
        case 0:
            $all_smiles[$count]["first_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$url['key'])."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url['value']."\" alt=\"".$url['value']."\" /></a>";
            $all_smiles[$count]["second_col"]="";
            $all_smiles[$count]["third_col"]="";
            $i++;
            break;
        case 1:
            $all_smiles[$count]["second_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$url['key'])."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url['value']."\" alt=\"".$url['value']."\" /></a>";
            $i++;
            break;
        case 2:
            $all_smiles[$count]["third_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$url['key'])."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url['value']."\" alt=\"".$url['value']."\" /></a>";
            $count++;
            $i=0;
            break;
    }
}
}else{
foreach($smilies as $code=>$url) {
    switch($i)
       {
        case 0:
            $all_smiles[$count]["first_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url."\" alt=\"$url\" /></a>";
            $all_smiles[$count]["second_col"]="";
            $all_smiles[$count]["third_col"]="";
            $i++;
            break;
        case 1:
            $all_smiles[$count]["second_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url."\" alt=\"$url\" /></a>";
            $i++;
            break;
        case 2:
            $all_smiles[$count]["third_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url."\" alt=\"$url\" /></a>";
            $count++;
            $i=0;
            break;
    }
}
}

foreach($privatesmilies as $code=>$url) {
    switch($i)
       {
        case 0:
            $all_smiles[$count]["first_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url."\" alt=\"$url\" /></a>";
            $all_smiles[$count]["second_col"]="";
            $all_smiles[$count]["third_col"]="";
            $i++;
            break;
        case 1:
            $all_smiles[$count]["second_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url."\" alt=\"$url\" /></a>";
            $i++;
            break;
        case 2:
            $all_smiles[$count]["third_col"]="<a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',window.opener.document.forms.$parentform.$parentarea);\"><img border=\"0\" src=\"images/smilies/".$url."\" alt=\"$url\" /></a>";
            $count++;
            $i=0;
            break;
    }
}

$moresmiles_tpl=new bTemplate();
$moresmiles_tpl->set("language",$language);
$moresmiles_tpl->set("smiles",$all_smiles);
if($no_columns==1)//fixes the display when no columns are in main.
$no_columns=0;
?>