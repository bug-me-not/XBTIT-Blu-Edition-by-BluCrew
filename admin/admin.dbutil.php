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



switch($action)
    {

    case 'tables':
        if (isset($_POST["doit"]) && isset($_POST["tname"]))
          {
            $table_action=strtoupper($_POST["doit"]);
            $tables=implode(",",$_POST["tname"]);
            if (isset($_POST["tname"]))
              {
                switch ($table_action)
                   {
                    case strtoupper($language['DBUTILS_REPAIR']):
                        $dbres=do_sqlquery("REPAIR TABLE $tables");
                        break;
                    case strtoupper($language['DBUTILS_ANALYSE']):
                        $dbres=do_sqlquery("ANALYZE TABLE $tables");
                        break;
                    case strtoupper($language['DBUTILS_OPTIMIZE']):
                        $dbres=do_sqlquery("OPTIMIZE TABLE $tables");
                        break;
                    case strtoupper($language['DBUTILS_CHECK']):
                        $dbres=do_sqlquery("CHECK TABLE $tables");
                        break;
                        /*
                    case strtoupper($language['DBUTILS_DELETE']):
                        $dbres=do_sqlquery("DROP TABLE $tables");
                        header("Location: index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=status");
                        exit();
                        break;
                            */
                 }
                 $t=array();
                 while ($tstatus=$dbres->fetch_array())
                      {
                         $t[$i]["table"]=$tstatus['Table'];
                         $t[$i]["operation"]=$tstatus['Op'];
                         $t[$i]["info"]=$tstatus['Msg_type'];
                         $t[$i]["status"]=$tstatus['Msg_text'];
                         $i++;
                 }
                  $admintpl->set("language",$language);
                  $admintpl->set("results",$t);
                  $admintpl->set("db_status",false,true);
                  $admintpl->set("table_result",true,true);

              }
        }
         else
            header("Location: index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=status");
        break;


    case 'status':
    default:
        $dbstatus=do_sqlquery("SHOW TABLE STATUS");
        if (sql_num_rows($dbstatus)>0)
            {
              $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=dbutil&amp;action=tables");
              $i=0;
              $bytes=0;
              $records=0;
              $overhead=0;
              $tables=array();
              // display current status for tables
              while ($tstatus=$dbstatus->fetch_array())
                  {
                  $tables[$i]["name"]=$tstatus['Name'];
                  $tables[$i]["rows"]=$tstatus['Rows'];
                  $tables[$i]["length"]=makesize($tstatus['Data_length']+$tstatus['Index_length']);
                  $tables[$i]["overhead"]=($tstatus['Data_free']==0?"-":makesize($tstatus['Data_free']));
                  $i++;
                  $bytes+=$tstatus['Data_length']+$tstatus['Index_length'];
                  $records+=$tstatus['Rows'];
                  $overhead+=$tstatus['Data_free'];
                }
                $admintpl->set("language",$language);
                $admintpl->set("tables",$tables);
                $admintpl->set("db_status",true,true);
                $admintpl->set("table_count",$i);
                $admintpl->set("table_bytes",makesize($bytes));
                $admintpl->set("table_records",$records);
                $admintpl->set("table_overhead",makesize($overhead));
                unset($tables);
                unset($bytes);
                unset($records);
                unset($overhead);
            }
        break;

}


?>
