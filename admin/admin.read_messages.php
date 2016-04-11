<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT/DC FM.
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

if($_GET['option']=="delete")
{
   $id = sql_esc($_GET['id']);
   if($id)
   {
      $gid = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}contact_system WHERE id = '$id'") or die(sql_error());
      $cid = sql_num_rows($gid);

      if($cid=="0")
      {
         $delte="<center><font color=\"red\"><b>Invalid  ID!</b></font></center><br><br>";
      }
      else
      {
         $del = do_sqlquery("DELETE FROM {$TABLE_PREFIX}contact_system WHERE id = '$id'") or die(sql_error());
         if($del)
         {
            $delte= "<center><font color=\"green\"><b>Deleted message.</b></font></center><br><br>";
         }
         else
         {
            $delte= "<center><font color=\"red\"><b>This message can not be removed.</b></font></center><br><br>";
         }
      }
   }
   else
   {
      $delte="<center><font color=\"red\"><b>Select the message to delete.</b></font></center><br><br>";
   }
}

if($_GET['option']=="reply")
{
   $id = sql_esc($_GET['id']);
   if ($_POST['bt'] == "Send")
   {
      if (($_POST['email'] != "") AND ($_POST['sub'] != "") AND ($_POST['messe'] != ""))
      {
         $mes=sql_esc($_POST['messe']);
         quickQuery("UPDATE {$TABLE_PREFIX}contact_system SET re='yes',message2='".$mes."' WHERE id='" .$id. "'");

         $headers = "MIME-Version: 1.0\r\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
         $headers .= "From:".$SITEEMAIL."\r\n";
         $mailbody = $HTTP_POST_VARS["messe"];

         if (send_mail("".$_POST['email']."",$_POST['sub'],$mailbody))
         $message = "<center><font size=\"4\" color=\"#00FF00\"><b>This message has been sent...</b></font><a  href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages\"><font size=\"4\" color=\"#00FF00\"><b> Back</b></font></a></center>";
      }
      else
      {
         $message2 = "<center><font size=\"4\" color=\"#FF0000\"><b>You did not fill in all fields...</b></font></center>";
      }
   }
   $gmsg2 = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}contact_system WHERE id = '$id'") or die(sql_error());
   $msg2 = $gmsg2->fetch_assoc();
   $cat2 = $msg2['cat'];
   $subcat2 = $msg2['subcat'];
   $messagecyt= $msg2['message'];

   if($message=="")
   {
      $send="<p>".$message2."</p>
      <form action=\"\" method=\"post\">
      <table  align=\"center\" class=\"lista\" border=\"0\">
      <tr><td class=\"header\">E-mail: </td><td  class=\"lista\"><input type=\"text\" name=\"email\" value=\"".$msg2['email']."\" size=\"35\" maxlength=\"150\"></td></tr>
      <tr><td class=\"header\">Title: </td><td  class=\"lista\"><input type=\"text\" name=\"sub\" value=\"RE: ".$cat2." - ".$subcat2."\" size=\"35\" maxlength=\"150\"></td></tr>
      <tr><td class=\"header\">Message:</td><td  class=\"lista\"> <textarea rows=\"20\" cols=\"80\" name=\"messe\">\n\n\n\n\n\n\n\n----- Original Message ----- \n\n".format_comment($messagecyt)."</textarea></td></tr>
      </table><table align=\"center\" border=\"0\" class=\"lista\"><tr>
      <td class=\"header\" align=\"right\"><input type=\"submit\" class=\"btn\" name=\"bt\" value=\"Send\" /></form></td><td class=\"header\" align=\"left\"><form method=\"post\" action=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages\"><input type=\"submit\" class=\"btn\" value=\"Back\"></form></td></tr>
      </table>
      ";
   }
   else
   {
      $send="<p>".$message."</p>";
   }

}
elseif($_GET['option']=="view")
{
   $id = sql_esc($_GET['id']);

   $gmsg = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}contact_system WHERE id = '$id'") or die(sql_error());
   if (sql_num_rows($gmsg)>0)
   {
      $msg = $gmsg->fetch_assoc();

      $msgid = $msg['id'];
      $ipaddress = $msg['ipaddress'];
      $name = $msg['name'];
      $email = $msg['email'];
      $date = $msg['date'];
      $cat = $msg['cat'];
      $subcat = $msg['subcat'];
      $message = $msg['message'];
      $message2 = $msg['message2'];

      $w="<fieldset><legend> Details of sender  </legend>
      <table border=\"0\">
      <tr><td>Id:</td><td>".$msgid."</td></tr>
      <tr><td>IP :</td><td>".$ipaddress."</td></tr>
      <tr><td>From:</td><td>".$name."</td></tr>
      <tr><td>Email :</td><td>".$email."</td></tr>
      </table></fieldset>
      <br><br>
      <fieldset><legend>Message </legend>
      <table border=\"0\">
      <tr><td>Sent Date:</td><td>".$date."</td></tr>
      <tr><td>Main Category:</td><td>".$cat."</td></tr>
      <tr><td>Sub Category:</td><td>".$subcat."</td></tr>
      <tr><td></td><td></td></tr>
      <tr><td><hr></td><td><hr></td></tr>
      <tr><td>Message Details:</td><td>".format_comment($message)."</td></tr></table></fieldset>
      <fieldset><legend>Message cumulative</legend>
      <table border=\"0\">
      <tr><td>".format_comment($message2)."
      </td>
      </tr>
      </table>
      </fieldset>
      <table border=\"0\">
      <tr><td><a  href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages&amp;option=reply&amp;id=".$msgid."\"><b>Reply</b></a> | <a title=\"Delete Message\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages&amp;option=delete&amp;id=".$msgid."\"><b>Delete</b></a> | <a title=\"back\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages\"><b>Back</b></a></td>
      </tr>
      </table>";

   }
   else
   $w="<font color=\"red\"><b>Invalid Message ID.</b></font>";


}
else
{
   $sql = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}contact_system ORDER BY id");
   if (sql_num_rows($sql)>0)
   {
      $s2="<table align=\"center\" class=\"lista\" width=\"100%\">";
      $s2.="<tr>
      <td class=\"header\" align=\"center\">ID</td>
      <td class=\"header\" align=\"center\">Category</td>
      <td class=\"header\" align=\"center\">Name</td>
      <td class=\"header\" align=\"center\">Email</td>
      <td class=\"header\" align=\"center\">Date</td>
      <td class=\"header\" align=\"center\">Answered</td>
      <td class=\"header\" align=\"center\">View | Delete</td>
      </tr>";
      while($res = $sql->fetch_assoc())
      {
         if($res['re']=='no')
         {
            $re="<font color=\"#FF0000\">NO</font>";
         }
         else
         {
            $re="<font color=\"#00FF00\">YES</font>";
         }

         $s2.="<tr>";
         $s2.="<td align=\"center\" class=\"lista\">".$res['id']."</td>";
         $s2.="<td align=\"center\" class=\"lista\">".$res['subcat']."</td>";
         $s2.="<td align=\"center\" class=\"lista\">".$res['name']."</td>";
         $s2.="<td align=\"center\" class=\"lista\">".$res['email']."</td>";
         $s2.="<td align=\"center\" class=\"lista\">".$res['date']."</td>";
         $s2.="<td align=\"center\" class=\"lista\">".$re."</td>";
         $s2.="<td align=\"center\" class=\"lista\"><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages&amp;option=view&amp;id=".$res['id']."\"><b>View</b></a> | <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=read_messages&amp;option=delete&amp;id=".$res['id']."\"><b>Delete</b></a> </td>";
         $s2.="</tr>";
      }
      $s2.="</table>";
   }
   else
   $s2="<font color=\"red\"><b>There are no messages to display.</b></font>";
}
$admintpl->set("s2",$s2);
$admintpl->set("w",$w);
$admintpl->set("send",$send);
$admintpl->set("dele",$delte);
$admintpl->set('language',$language);
?>
