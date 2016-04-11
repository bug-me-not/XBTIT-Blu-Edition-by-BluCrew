<?php
#####################################################################################
#                     xbtit - Bittorrent tracker/frontend                           #
#                                                                                   #
#                      Copyright (C) 2004 - 2013 Btiteam                            #
#                                                                                   #
#  This file is part of xbtit.                                                      #
#                                                                                   #
# Redistribution and use in source and binary forms, with or without modification,  #
# are permitted provided that the following conditions are met:                     #
#                                                                                   #
#   1. Redistributions of source code must retain the above copyright notice,       #
#      this list of conditions and the following disclaimer.                        #
#   2. Redistributions in binary form must reproduce the above copyright notice,    #
#      this list of conditions and the following disclaimer in the documentation    #
#      and/or other materials provided with the distribution.                       #
#   3. The name of the author may not be used to endorse or promote products        #
#      derived from this software without specific prior written permission.        #
#                                                                                   #
# THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED      #
# WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF              #
# MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.              #
# IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,      #
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED          #
# TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR            #
# PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF            #
# LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING              #
# NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,      #
# EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                                #
#                                                                                   #
#####################################################################################

                          ###############################
                          #                             #
                          # Name: Duplicate Accounts    #
                          # Type: Module/Hack           #
                          # Version: 1.0                #
                          # Designed for: Xbtit 2.0     #
                          # Developer: CobraCRK         #
                          # WWW: www.veldev.net         #
                          # E-mail: cobracrk@veldev.net #
                          # Credits: all btiteam dev    #
                          #                             #
                          ###############################

if (!defined("IN_BTIT"))
    die("non direct access!");
if (!defined("IN_ACP"))
    die("non direct access!");


$res = do_sqlquery("SELECT `lip` FROM `{$TABLE_PREFIX}users` WHERE `id`>1 AND `lip`<>0 GROUP BY `lip` HAVING count(*) > 1",true);
if(@sql_num_rows($res)==0)
    stderr($language['ERROR'],$language['ERR_USERS_NOT_FOUND']);

$i=0;
while($r=$res->fetch_assoc())
{
    if ($XBTT_USE)
        $ros = do_sqlquery("SELECT `u`.`username`, `u`.`id`, `u`.`email`, (u.uploaded+IFNULL(x.uploaded,0)) `uploaded`, (u.downloaded+IFNULL(x.downloaded,0)) `downloaded`,`u`.`cip`,`u`.`id`,`u`.`joined`, `u`.`lastconnect`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `x`.`uid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`lip`='".$r['lip']."' ORDER BY `u`.`lip`",true);
    else
        $ros = do_sqlquery("SELECT `u`.`username`, `u`.`id`, `u`.`email`, `u`.`uploaded`, `u`.`downloaded`,`u`.`cip`,`u`.`id`,`u`.`joined`, `u`.`lastconnect`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`lip`='".$r['lip']."' ORDER BY `u`.`lip`",true);

    if(@sql_num_rows($ros)>0)
    {
        while($arr = $ros->fetch_assoc())
        {
            if ($arr['joined'] == '0000-00-00 00:00:00')
                $arr['joined'] = '-';
            if ($arr['lastconnect'] == '0000-00-00 00:00:00')
                $arr['lastconnect'] = '-';
            if($arr["downloaded"] > 0)
                $ratio = number_format($arr["uploaded"] / $arr["downloaded"], 3);
            else
                $ratio="&#8734;";

            $ratio = "$ratio";
            $uploaded = makesize($arr["uploaded"]);
            $downloaded = makesize($arr["downloaded"]);
            $added = substr($arr['joined'],0,10);
            $last_access = substr($arr['lastconnect'],0,10);
            $ip=htmlspecialchars($arr['cip']);

            $dupes[$i]["USER_NAME"]=unesc($arr["prefixcolor"].$arr['username'].$arr["suffixcolor"]);
            $dupes[$i]["ID"]=$arr['id'];
            $dupes[$i]["EMAIL"]=$arr['email'];
            $dupes[$i]["RATIO"]=$ratio;
            $dupes[$i]["UPLOADED"]=$uploaded;
            $dupes[$i]["DOWNLOADED"]=$downloaded;
            $dupes[$i]["ADDED"]=$added;
            $dupes[$i]["LAST_ACCESS"]=$last_access;
            $dupes[$i]["IP"]=$ip;
            $i++;
        }
    }
}

$admintpl->set("users",$dupes);
$admintpl->set("language",$language);

?>
