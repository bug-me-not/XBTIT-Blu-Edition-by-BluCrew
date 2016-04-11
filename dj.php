<?php

if (!defined("IN_BTIT"))
    die("non direct access!");


global $TABLE_PREFIX, $CURUSER;

require(load_language("lang_shoutcast.php"));

$djtpl=new bTemplate();
$djtpl->set("language",$language);

$pages = explode(",", $language['pages']);

if(!in_array($_GET['do'], $pages))
{
    stderr($language['ERROR'],$language['strange']);
}

if ($_GET['do']=='manage')
{
    $query = do_sqlquery ('SELECT activedays, activetime, genre FROM '.$TABLE_PREFIX.'shoutcastdj WHERE active = \'1\' AND uid = \'' . $CURUSER['uid'] . '\'', true);
    if (sql_num_rows ($query) == 0)
    {
        stderr ($language['ERROR'], $language['hey']);
    }
    if (strtoupper ($_SERVER['REQUEST_METHOD']) == 'POST')
    {
        $availabledays = array (1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
        $activedays = $_POST['activedays'];
        $activetime = trim ($_POST['activetime']);
        $genre = trim ($_POST['genre']);
        if ((((is_array ($activedays) AND count ($activedays)) AND 5 < strlen ($activetime)) AND 2 < strlen ($genre)))
        {
            $selectedadays = array ();
            foreach ($activedays as $ad)
            {
                if ($availabledays[$ad])
                {
                    $selectedadays[] = $availabledays[$ad];
                    continue;
                }
            }
            if (count ($selectedadays))
            {
                $activedays = implode (',', $selectedadays);
                do_sqlquery ('UPDATE '.$TABLE_PREFIX.'shoutcastdj SET activedays = ' . sqlesc ($activedays) . ', activetime = ' . sqlesc ($activetime) . ', genre = ' . sqlesc ($genre) . ' WHERE active = \'1\' AND uid = \'' . $CURUSER['uid'] . '\'', true);
                success_msg ($language['SUCCESS'],$language['updated']);
                stdfoot(true,false);
                die();
            }
            else
            {
                stderr ($language['ERROR'],$language['blank']);
            }
        }
        else
        {
            stderr ($language['ERROR'],$language['blank']);
        }
    }
    $DJ = $query->fetch_assoc();

    $availabledays = explode (',', $language['days']);
    $days = '';
    $i = 0;
    while ($i < 7)
    {
        $days .= '
            <input type="checkbox" value="' . ($i + 1) . '" name="activedays[]"' . (in_array (substr ($availabledays[$i], 0, 3), explode (',', $DJ['activedays'])) ? ' checked="checked"' : '') . ' /> ' . $availabledays[$i] . ' ';
        ++$i;
    }

    $manform='
        <form method="POST" action="index.php?page=dj&do=manage">
          <table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td class="header"><center>' . $language['bedj'] . '</center></td>
            </tr>
            <tr>
              <td align="left" class=lista>
                <fieldset>
                <legend>' . sprintf ($language['f1'], $SITENAME) . '</legend>
                ' . $days . '
                <div style="padding-top:10px;">
                <b>' . $language['f2'] . '</b> <input type="text" name="activetime" value="' . htmlspecialchars ($DJ['activetime']) . '" /> <b>' . $language['example'] . '</b>
                </div>
                </fieldset>
                <fieldset>
                <legend>' . $language['f5'] . '</legend>
                <input type="text" name="genre" value="' . htmlspecialchars ($DJ['genre']) . '" size="50" />
                </fieldset>
                </td>
              </tr>
              <tr>
                <td align="center" class="header"><center>
                  <input type="submit" value="' . $language['f3'] . '" /> <input type="reset" value="' . $language['f4'] . '" />
                  </center>
                </td>
              </tr>
            </table>
          </form>';

    $djtpl->set("manform",$manform);
}

if ((($_GET['do']=='edit' AND is_valid_id ($_GET['id'])) AND $CURUSER["edit_users"]=="yes"))
{
    $Updated = false;
    $Query = do_sqlquery ('SELECT * FROM '.$TABLE_PREFIX.'shoutcastdj WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
    if (0 < sql_num_rows ($Query))
    {
        $Updated = false;
        if (strtoupper ($_SERVER['REQUEST_METHOD']) == 'POST')
        {
            $availabledays = array (1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
            $activedays = $_POST['activedays'];
            $activetime = trim ($_POST['activetime']);
            $genre = trim ($_POST['genre']);
            if ((((is_array ($activedays) AND count ($activedays)) AND 5 < strlen ($activetime)) AND 2 < strlen ($genre)))
            {
                $selectedadays = array ();
                foreach ($activedays as $ad)
                {
                    if ($availabledays[$ad])
                    {
                        $selectedadays[] = $availabledays[$ad];
                        continue;
                    }
                }
                if (count ($selectedadays))
                {
                    $activedays = implode (',', $selectedadays);
                    do_sqlquery ('UPDATE '.$TABLE_PREFIX.'shoutcastdj SET activedays = ' . sqlesc ($activedays) . ', activetime = ' . sqlesc ($activetime) . ', genre = ' . sqlesc ($genre) . ' WHERE active = \'1\' AND id = \'' . $_GET['id'] . '\'', true);
                    $Updated = true;
                }
                else
                {
                    stderr ($language['ERROR'],$language['blank']);
                }
            }
            else
            {
                stderr ($language['ERROR'],$language['blank']);
            }
        }
        if (!$Updated)
        {
            $DJ = $Query->fetch_assoc();
            $availabledays = explode (',', $language['days']);
            $days = '';
            $i = 0;
            while ($i < 7)
            {
                $days .= '
                    <input type="checkbox" value="' . ($i + 1) . '" name="activedays[]"' . (in_array (substr ($availabledays[$i], 0, 3), explode (',', $DJ['activedays'])) ? ' checked="checked"' : '') . ' /> ' . $availabledays[$i] . ' ';
                ++$i;
            }
            $edform='
                <form method="POST" action="index.php?page=dj&do=edit&amp;id=' . $DJ['id'] . '">
                <table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td class="header"><center>' . $language['bedj'] . '</center></td>
                  </tr>
                  <tr>
                    <td align="left" class=lista>
                      <fieldset>
                      <legend>' . sprintf ($language['f1'], $SITENAME) . '</legend>
                      ' . $days . '
                      <div style="padding-top:10px;">
                      <b>' . $language['f2'] . '</b> <input type="text" name="activetime" value="' . htmlspecialchars ($DJ['activetime']) . '" /> <b>' . $lang->shoutcast['example'] . '</b>
                      </div>
                      </fieldset>
                      <fieldset>
                      <legend>' . $language['f5'] . '</legend>
                      <input type="text" name="genre" value="' . htmlspecialchars ($DJ['genre']) . '" size="50" />
                      </fieldset>
                    </td>
                  </tr>
                  <tr>
                    <td align="center" class="header">
                      <input type="submit" value="' . $language['f3'] . '" /> <input type="reset" value="' . $language['f4'] . '" />
                    </td>
                  </tr>
                </table>
                </form>';
        }
        $djtpl->set("edform",$edform);
    }
    $_GET['do'] = 'list';
    $_GET['id'] = 0 + $_GET['id'];
}
if ((($_GET['do']=='approve' AND is_valid_id ($_GET['id'])) AND $CURUSER["edit_users"]=="yes"))
{
    do_sqlquery ('UPDATE '.$TABLE_PREFIX.'shoutcastdj SET active = \'1\' WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
    if (sql_affected_rows())
    {
        $Query = do_sqlquery ('SELECT uid FROM '.$TABLE_PREFIX.'shoutcastdj WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
        send_pm (0,$Query->fetch_assoc()['uid'],sqlesc($language['subject']),sqlesc (''.$language['amsg']. '[url]' . $BASEURL . '/index.php?page=dj_faq[/url]'));
    }
    $_GET['do'] = 'list';
    $_GET['id'] = 0 + $_GET['id'];
}
if ((($_GET['do']=='deny' AND is_valid_id ($_GET['id'])) AND $CURUSER["edit_users"]=="yes"))
{
    do_sqlquery ('UPDATE '.$TABLE_PREFIX.'shoutcastdj SET active = \'2\' WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
    if (sql_affected_rows())
    {
        $Query = do_sqlquery ('SELECT uid FROM '.$TABLE_PREFIX.'shoutcastdj WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
        send_pm (0,$Query->fetch_assoc()['uid'],sqlesc($language['subject']),sqlesc($language['dmsg']));
    }
    $_GET['do'] = 'list';
    $_GET['id'] = 0 + $_GET['id'];
}
if ((($_GET['do']=='kick' AND is_valid_id ($_GET['id'])) AND $CURUSER["edit_users"]=="yes"))
{
    do_sqlquery ('UPDATE '.$TABLE_PREFIX.'shoutcastdj SET active = \'3\' WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
    if (sql_affected_rows())
    {
        $Query = do_sqlquery ('SELECT uid FROM '.$TABLE_PREFIX.'shoutcastdj WHERE id = \'' . (0 + $_GET['id']) . '\'', true);
        send_pm (0,$Query->fetch_assoc()['uid'],sqlesc($language['subject2']),sqlesc($language['kmsg']));
    }
    $_GET['do'] = 'list';
    $_GET['id'] = 0 + $_GET['id'];
}

if ($_GET['do']=='request')
{
    $query = do_sqlquery ('SELECT uid FROM '.$TABLE_PREFIX.'shoutcastdj WHERE uid = \'' . $CURUSER['uid'] . '\'', true);
    if (0 < sql_num_rows ($query))
    {
        stderr($language['ERROR'],$language['already']);
    }
    $Query = do_sqlquery ('SELECT t.*, u.username, g.prefixcolor, g.suffixcolor FROM '.$TABLE_PREFIX.'shoutcastdj t LEFT JOIN '.$TABLE_PREFIX.'users u ON t.uid=u.id LEFT JOIN '.$TABLE_PREFIX.'users_level g ON u.id_level=g.id WHERE t.active=1',true);
    if (sql_num_rows ($Query))
    {
        $reqform = '<br />
            <table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td colspan="5" class="header"><center>' . $language['djlist'] . '</center></td>
              </tr>
              <tr>
                <td class="header"><center>' . $language['djname'] . '</center></td>
                <td class="header"><center>' . $language['adays'] . '</center></td>
                <td class="header"><center>' . $language['atime'] . '</center></td>
                <td class="header"><center>' . $language['genre'] . '</center></td>
              </tr>';
        while ($List = $Query->fetch_assoc())
        {
            $reqform .= '
                <tr' . ((isset ($_GET['id']) AND $_GET['id'] == $List['id']) ? ' class="highlight"' : '') . '>
                  <td class=lista><center><a href="'.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$List["uid"]."_".strtr($List["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$List["uid"]).'">' . unesc ($List['prefixcolor'] . $List['username'] . $List['suffixcolor']) . '</a></center></td>
                  <td class=lista><center>' . htmlspecialchars ($List['activedays']) . '</center></td>
                  <td class=lista><center>' . htmlspecialchars ($List['activetime']) . '</center></td>
                  <td class=lista><center>' . htmlspecialchars ($List['genre']) . '</center></td>
                </tr>';
        }
        $reqform.="</table><br />";
    }
    if (strtoupper ($_SERVER['REQUEST_METHOD']) == 'POST')
    {
        (isset($_POST["activedays"]) && is_array($_POST["activedays"])) ? $activedays=$_POST["activedays"] :  $activedays=array();
        (isset($_POST["activetime"])) ? $activetime=$_POST["activetime"] :  $activetime="";

        $count1=substr_count($activetime,"-");
        $count2=substr_count($activetime,":");

        if($count1<>1 || $count2<>2)
        {
           stderr($language["ERROR"],$language['INV_TIME_SLOT_1']);
        }
        $split_slot=explode("-",$activetime);
        $slot_start=explode(":",$split_slot[0]);
        $slot_end=explode(":",$split_slot[1]);
        $mergedtime[0]=$slot_start[0] . $slot_start[1];
        $mergedtime[1]=$slot_end[0] . $slot_end[1];

        if($split_slot[0]==$split_slot[1])
        {
            stderr($language["ERROR"],$language['INV_TIME_SLOT_2']);
        }
        elseif($slot_start[0]>23 || $slot_end[0]>23)
        {
            stderr($language["ERROR"],$language['INV_TIME_FORMAT_1']);
        }
        elseif($slot_start[1]>59 || $slot_end[1]>59)
        {
            stderr($language["ERROR"],$language['INV_TIME_FORMAT_2']);
        }
        elseif($mergedtime[0]>$mergedtime[1])
        {
            $mergedtime[1]+=2400;
        }

        $query="SELECT `dj`.`uid` `id`, `ul`.`prefixcolor`, `u`.`username`, `ul`.`suffixcolor`, `dj`.`activedays`, `dj`.`activetime` FROM `{$TABLE_PREFIX}shoutcastdj` `dj` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `dj`.`uid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `dj`.`active`=1";

        $res=do_sqlquery($query,true);

        while($row=$res->fetch_assoc())
        {
            $split_slot2=explode("-",$row["activetime"]);
            $slot_start2=explode(":",$split_slot2[0]);
            $slot_end2=explode(":",$split_slot2[1]);
            $mergedtime2[0]=$slot_start2[0] . $slot_start2[1];
            $mergedtime2[1]=$slot_end2[0] . $slot_end2[1];

            if($mergedtime2[0]>$mergedtime2[1])
            {
                $mergedtime2[1]+=2400;
            }
            $days_active=explode(",",$row["activedays"]);

            $err_output=$language['ERR_OUTPUT_1']." <a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["id"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["id"])."'>".unesc($row["prefixcolor"].$row["username"].$row["suffixcolor"])."</a> ".$language['ERR_OUTPUT_2']." ";
            foreach($activedays as $v)
            {
                if($v==1)
                    $v="Mon";
                elseif($v==2)
                    $v="Tue";
                elseif($v==3)
                    $v="Wed";
                elseif($v==4)
                    $v="Thu";
                elseif($v==5)
                    $v="Fri";
                elseif($v==6)
                    $v="Sat";
                elseif($v==7)
                    $v="Sun";

                if(in_array($v,$days_active))
                {
                      if(($mergedtime[0]>$mergedtime2[0] && $mergedtime[0]<$mergedtime2[1]) || ($mergedtime[1]>$mergedtime2[0] && $mergedtime[1]<$mergedtime2[1]) || $mergedtime[0]==$mergedtime2[0] || $mergedtime[1]==$mergedtime2[1])
                          $err_output.=$v.", ";
                }
            }
            if($err_output!=$language['ERR_OUTPUT_1']." <a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["id"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["id"])."'>".unesc($row["prefixcolor"].$row["username"].$row["suffixcolor"])."</a> ".$language['ERR_OUTPUT_2']." ")
            {
                $err_output=trim($err_output,", ").". ".$language['ERR_OUTPUT_3'];
                stderr($language["ERROR"],$err_output);
            }
        }
        $availabledays = array (1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun');
        $activedays = $_POST['activedays'];
        $activetime = trim ($_POST['activetime']);
        $genre = trim ($_POST['genre']);
        if ((((is_array ($activedays) AND count ($activedays)) AND 5 < strlen ($activetime)) AND 2 < strlen ($genre)))
        {
            $selectedadays = array ();
            foreach ($activedays as $ad)
            {
                if ($availabledays[$ad])
                {
                    $selectedadays[] = $availabledays[$ad];
                    continue;
                }
            }
            if (count ($selectedadays))
            {
                $activedays = implode (',', $selectedadays);
                do_sqlquery ('INSERT INTO '.$TABLE_PREFIX.'shoutcastdj VALUES (NULL, \'' . $CURUSER['uid'] . '\', \'0\', ' . sqlesc ($activedays) . ', ' . sqlesc ($activetime) . ', ' . sqlesc ($genre) . ')', true);
                $id = sql_insert_id();
                $query = do_sqlquery ('SELECT u.id FROM '.$TABLE_PREFIX.'users u LEFT JOIN '.$TABLE_PREFIX.'users_level g ON u.id_level=g.id WHERE delete_users=\'yes\'', true);

                while ($si = $query->fetch_assoc())
                {
                    send_pm (0,$si[id],sqlesc( $language['subject']),sqlesc(''.$language['msg'].' '.$CURUSER['username'].' '.$language['msgg'].' [url]' . $BASEURL . '/index.php?page=dj&do=list&id=' . $id . '[/url]'));
                }
                success_msg ($language['SUCCESS'],$language['thanks']);
                stdfoot(true,false);
                die();
            }
            else
            {
                stderr ($language['ERROR'],$language['blank']);
            }
        }
        else
        {
            stderr ($language['ERROR'],$language['blank']);
        }
    }
    $availabledays = explode (',', $language['days']);
    $days = '';
    $i = 0;
    while ($i < 7)
    {
        $days .= '
            <input type="checkbox" value="' . ($i + 1) . '" name="activedays[]" /> ' . $availabledays[$i] . ' ';
        ++$i;
    }
    $reqform.='
        <form method="POST" action="index.php?page=dj&do=request">
        <table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
          <tr>
            <td class="header"><center>' . $language['bedj'] . '</center></td>
          </tr>
          <tr>
            <td align="left" class=lista>
            <fieldset>
            <legend>' . sprintf ($language['f1'], $SITENAME) . '</legend>
            ' . $days . '
            <div style="padding-top:10px;">
            <b>' . $language['f2'] . '</b> <input type="text" name="activetime" value="00:00-00:00" maxlength=11 /> <b>' . $language['example'] . ' '.date('H:i').'</b>
            </div>
            </fieldset>
            <fieldset>
            <legend>' . $language['f5'] . '</legend>
            <input type="text" name="genre" value="" size="50" />
            </fieldset>
          </td>
        </tr>
        <tr>
          <td align="center" class="header">
            <input type="submit" value="' . $language['f3'] . '" /> <input type="reset" value="' . $language['f4'] . '" />
          </td>
        </tr>
      </table>
      </form>';
    $djtpl->set("reqform",$reqform);
}
if ($_GET['do'] == 'list')
{
    $is_mod = $CURUSER["edit_users"]=="yes";
    $Query = do_sqlquery ('SELECT t.*, u.username, g.prefixcolor, g.suffixcolor FROM '.$TABLE_PREFIX.'shoutcastdj t LEFT JOIN '.$TABLE_PREFIX.'users u ON t.uid=u.id LEFT JOIN '.$TABLE_PREFIX.'users_level g ON u.id_level=g.id ORDER by t.active ASC', true);
    if (sql_num_rows ($Query))
    {
        $activedjlist = '
            <table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td colspan="5" class="header"><center>' . $language['djlist'] . '</center></td>
              </tr>
              <tr>
                <td class="header"><center>' . $language['djname'] . '</center></td>
                <td class="header"><center>' . $language['adays'] . '</center></td>
                <td class="header"><center>' . $language['atime'] . '</center></td>
                <td class="header"><center>' . $language['genre'] . '</center></td>
                <td class="header"><center>' . $language['status'] . '</center></td>
              </tr>';
        while ($List = $Query->fetch_assoc())
        {
            $activedjlist .= '
                <tr' . ((isset ($_GET['id']) AND $_GET['id'] == $List['id']) ? ' class="highlight"' : '') . '>
                  <td class=lista><center><a href="'.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$List["uid"]."_".strtr($List["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$List["uid"]).'">' . unesc ($List['prefixcolor'] . $List['username'] . $List['suffixcolor']) . '</a></center></td>
                  <td class=lista><center>' . htmlspecialchars ($List['activedays']) . '</center></td>
                  <td class=lista><center>' . htmlspecialchars ($List['activetime']) . '</center></td>
                  <td class=lista><center>' . htmlspecialchars ($List['genre']) . '</center></td>
                  <td class=lista>' . ($is_mod ? '<span style="float: right;"><a href="index.php?page=dj&do=approve&amp;id=' . $List['id'] . '">[' . $language['approve'] . ']</a> <a href="index.php?page=dj&do=deny&amp;id=' . $List['id'] . '">[' . $language['deny'] . ']</a> <a href="index.php?page=dj&do=kick&amp;id=' . $List['id'] . '">[' . $language['kick'] . ']</a> <a href="index.php?page=dj&do=edit&amp;id=' . $List['id'] . '">[' . $language['edit'] . ']</a></span>' : '') . '<center><font color="' . ($List['active'] == '0' ? 'red">' . $language['pending'] : ($List['active'] == '1' ? 'green">' . $language['approved'] : ($List['active'] == '2' ? 'blue">' . $language['denied'] : 'darkred">' . $language['kicked']))) . '</font></center></td>
                </tr>';
        }
    }
    else
    {
        stderr ($language['ERROR'], $language['down2']);
    }
    $djtpl->set("list",$activedjlist . '</table>');
}

?>
