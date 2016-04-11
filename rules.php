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


if ($limit>0)
  $limitqry="LIMIT $limit";
$res=do_sqlquery("SELECT r.text AS text, r.sort_index AS sort_index, r.id AS id ,rg.title AS cat_title, rg.id AS cat_id, rg.sort_index AS g_sort_index
                    FROM {$TABLE_PREFIX}rules r
                    INNER JOIN {$TABLE_PREFIX}rules_group rg on r.cat_id=rg.id
                    WHERE r.active = '1' AND rg.active = '1' GROUP BY r.sort_index ORDER BY rg.sort_index,r.sort_index ASC $limitqry");

// load language file
//require(load_language("lang_viewrules.php"));

$rulestpl = new bTemplate();
$rulestpl -> set("language",$language);


$rules=array();
$i=0;

$rulestpl -> set("rules_exists", (sql_num_rows($res) > 0),TRUE);

$id='';
$j=1;
$k=1;
while ($rows=$res->fetch_array())
  {
      if($id != $rows['cat_id'])
    {
     $rules[$i]["rules_group_title"] = unesc('<br/>'.$rows["cat_title"].'<br/>');
     $rules[$i]["rules_text"] = format_comment(unesc($rows["sort_index"].'. '.$rows["text"]));
     $id = $rows['cat_id'];
     $j++;
    }
    else
    {

        $rules[$i]["rules_text"] = format_comment(unesc($rows["sort_index"].'. '.$rows["text"]));
        $k++;
    }

    /*  if($id != $rows['cat_id'])
    {

        $rules[$i]["rules_group_title"] = unesc($rows["cat_title"]);
        $rules[$i]["rules_text"] = unesc($rows["text"]);
        $rules[$i]["rules_link"] = unesc("index.php?page=rules#".$rows['id']);
        //rules2
        $rules2[$i]["posted_date"] = date("d/m/Y H:i",$rows["date"]-$offset);
        $rules2[$i]["rules_group_title"] = unesc(" <tr>
             <td class='header' align='center'>
              <b>".$rows["cat_title"]."</b>
             </td>
           </tr>");
        $rules2[$i]["rules_text"] = unesc($rows["text"]);
        $rules2[$i]["rules_link"] = unesc($rows['id']);
        $id = $rows['cat_id'];
    }
    else
    {
        $rules[$i]["rules_title"] = unesc($rows["title"]);
        $rules[$i]["rules_text"] = format_comment($rows["description"]);
        $rules[$i]["rules_link"] = unesc("index.php?page=rules#".$rows['id']);
        //rules2
        $rules2[$i]["posted_date"] = date("d/m/Y H:i",$rows["news_date"]-$offset);
        $rules2[$i]["rules_title"] = unesc($rows["title"]);
        $rules2[$i]["rules_text"] = format_comment($rows["description"]);
        $rules2[$i]["rules_link"] = unesc($rows['id']);

    }*/


      $i++;

  }

$rulestpl -> set("rules", $rules);
/*$rulestpl -> set("rules2", $rules2);*/

?>
