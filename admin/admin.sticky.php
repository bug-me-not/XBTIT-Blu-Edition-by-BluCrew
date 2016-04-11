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



/*
$admintpl->set("add_new",false,true);

*/
$admintpl->set("read",false,true);
switch ($action)
    {
         case 'edit':
          $block_title=$language["STICKY_SETTINGS"].'E';
          $id=max(0,$_GET["id"]);
          $admintpl->set("edit",false,true);
          $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=sticky&amp;action=save&amp;id=$id");
          $admintpl->set("language",$language);
          $sticky_group=get_result("SELECT * FROM {$TABLE_PREFIX}sticky WHERE id=$id",true);
          $sticky_current_group=$sticky_group[0];
          unset($sticky_group);
          $sticky_current_group["color"]=unesc($sticky_current_group["color"]);
          
          $admintpl->set("sticky",$sticky_current_group);
          break;
          
        case 'save':
          if ($_POST["write"]==$language["FRM_CONFIRM"])
            {
              
                   $color=sqlesc($_POST["color"]);
                   $level=sqlesc($_POST["sticky_level"]);
                   $id=max(0,$_GET["id"]);
                  
                   quickQuery("UPDATE {$TABLE_PREFIX}sticky SET color = $color, level = $level WHERE id=$id",true);
                   
              
            }

            // we don't break, so now we read ;)

        case '':
        case 'read':
        default:

          $block_title=$language["STICKY_SETTINGS"].'E';
           
          $admintpl->set("list",true,true);
          $admintpl->set("language",$language);
          $rsticky=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}sticky ORDER BY id",true);
          
          
          
          $sticky=array();
         $s=$rsticky->fetch_assoc();
                $id = $s['id'];
                $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=sticky&amp;action=save&amp;id=$id");
                $sticky["color"]=$s["color"];
                //$sticky[$i]["group_view"]=$s["group_view"];

          $rez_levels=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users_level ORDER BY id",true);
          $level = "<select name='sticky_level'>";
           while($row=$rez_levels->fetch_assoc())
           {
                $selected='';
                if($s['level']==$row['id_level']) 
                {
                    $selected = 'selected';
                }
                $level .="<option value=".$row['id_level']." ".$selected.">".$row['level']."</option>";
           }
           $level .= '</select>';
          $admintpl->set("level",$level);

          unset($s);
          $rsticky->free();

          $admintpl->set("sticky",$sticky);

}

?>