<?php
function return_error($heading = 'Error!', $string)
{
    global $language, $STYLEPATH, $page, $STYLEURL, $THIS_BASEPATH;

    require ("$THIS_BASEPATH/btemplate/bTemplate.php");
    // just in case not found the language
    if(!$language['BACK'])
        $language['BACK'] = 'Back';
    $err_tpl = new bTemplate();
    $err_tpl->set('error_title', $heading);
    $err_tpl->set('error_message', $string);
    $err_tpl->set('error_image', $STYLEURL.'/images/error.gif');
    $err_tpl->set('language', $language);
    $err_tpl->set('error_footer', '<a href="javascript: history.go(-1);">'.$language['BACK'].'</a>');
    return $err_tpl->fetch(load_template('error.tpl'));
}
if(isset($_POST["list"]))
{
    if(!isset($CURUSER) || !is_array($CURUSER))
    {
        session_name("BluRG");
        session_start();
        $CURUSER = $_SESSION["CURUSER"];
    }
    if(!isset($THIS_BASEPATH))
        $THIS_BASEPATH="..";
    require $THIS_BASEPATH."/include/functions.php";
    include (load_language("lang_main.php"));
    include (load_language("lang_admin.php"));
    if(!$CURUSER || $CURUSER["admin_access"] != "yes")
    {
        echo return_error($language["ERROR"], $language["NOT_ADMIN_CP_ACCESS"]);
        die;
    }
    // Additional admin check by miskotes
    $aid = max(0, $_POST["user"]);
    $arandom = max(0, $_POST["code"]);
    if(!$aid || empty($aid) || $aid == 0 || !$arandom || empty($arandom) || $arandom == 0)
    {
        echo return_error($language["ERROR"], $language["NOT_ADMIN_CP_ACCESS"]);
        die;
    }
    // only owner can do this change
    $mqry_username = sqlesc($CURUSER['username']);

    $mqry = do_sqlquery("select u.id, ul.admin_access from {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}users_level ul on ul.id=u.id_level WHERE u.id=$aid AND random=$arandom AND ul.id=8 AND username={$mqry_username}", true);

    if(sql_num_rows($mqry) < 1)
    {
        echo return_error($language["ERROR"], $language["NOT_ADMIN_CP_ACCESS"]);
        die;
    }
    $current_id = (isset($_POST['current_id'])?(int)$_POST['current_id']:0);
    $out = '';
    // the user's ask to save
    if(isset($_POST['do']))
    {
        switch($_POST['do'])
        {
            case '1'; // save settings
                if(count($_POST['check']) > 0)
                {
                    foreach($_POST['check'] as $id => $value)
                        quickQuery("UPDATE {$TABLE_PREFIX}adminpanel SET access='".($value == 'true'?1:0)."' WHERE id=$id");
                }
                break;
            case '2': // add a new section
                $section = sqlesc($_POST['section']);
                $desc = sqlesc($_POST['description']);
                $url = sqlesc($_POST['link']);
                quickQuery("DELETE FROM {$TABLE_PREFIX}adminpanel WHERE section=$section AND id_level=$current_id"); // delete old same named section
                quickQuery("INSERT INTO {$TABLE_PREFIX}adminpanel SET section=$section, description=$desc, link=$url, id_level=$current_id"); // insert new
                break;
        }
    }
    $out .= '
  <form id="aut_list" name="aut_list" action="admin.modpanel.php" method="post">
  <table>
  <tr>
  <td>
  ';
    $rrlist = rank_list();
    $out .= '<select id="r_opt">';
    foreach($rrlist as $id => $rlevel)
    {
        if($rlevel['admin_access'] == 'yes' && $rlevel['id'] != $CURUSER['id']) // let's display only admincp allowed
        {
            if($current_id == $rlevel['id'])
                $out .= '<option value="'.$rlevel['id'].'" selected="selected">'.$rlevel['level'].'</option>';
            else
                $out .= '<option value="'.$rlevel['id'].'">'.$rlevel['level'].'</option>';
        }
    }
    $out .= '
  </select>&nbsp;&nbsp;
  <input type="button" onclick="Show_ModPanel(document.aut_list.r_opt.options[document.aut_list.r_opt.selectedIndex].value);" name="sel_level" value="'.$language['SELECT'].'"/>
  </td>
  </tr>
  <tr>
  <td>
  ';
    unset($rrlist);
    // let's the list begin
    if($current_id > 0)
    {
        $radmincp = do_sqlquery("SELECT id, access, description FROM {$TABLE_PREFIX}adminpanel WHERE id_level=$current_id", true);
        if($radmincp)
        {
            $out .= '
          <br />
          <br />
          <table width="100%" class="lista">
          <tr>
          <td class="header" style="text-align:center">Section</td>
          <td class="header" style="text-align:center">Allow</td>
          </tr>
          ';
            while($rlevel = $radmincp->fetch_assoc())
            {
                if(array_key_exists($rlevel['description'], $language))
                    $desc = $language[$rlevel['description']];
                else
                    $desc = unesc($rlevel['description']);
                $out .= '<tr><td class="lista">'.$desc.'</td><td class="lista" style="text-align:center"><input type="checkbox" id="check['.$rlevel['id'].']" name="check['.$rlevel['id'].']"'.($rlevel['access'] == '1'?
                    ' checked="checked"':'').'</td></tr>';
            }
            $out .= '
        <tr>
        <td colspan="2" style="text-align:center"><input type="button" onclick="Show_ModPanel(document.aut_list.r_opt.options[document.aut_list.r_opt.selectedIndex].value,1);" name="sel_level" value="Save"/></td>
        </tr>
        </table>
        ';
        }
        $out .= '
    </td>
    </tr>
    <tr>
    <td>
    <br />
    <br />
    <table class="lista" width="100%">
    <tr><td class="header" colspan="2" style="text-align:center">'.$language['MODCP_NEWSECTION'].'</td></tr>
    <tr><td class="lista" width="30%">'.$language['MODCP_SECTION'].'</td><td class="lista" width="70%"><input type="text" maxlenght="50" name="section" id="section" style="width:95%" /></td></tr>
    <tr><td class="lista" width="30%">'.$language['MODCP_DESC'].
            '</td><td class="lista" width="70"><input type="text" maxlenght="250" name="description" id="description" style="width:95%" /></td></tr>
    <tr><td class="lista" width="30%">'.$language['MODCP_URL'].'</td><td class="lista" width="70%"><input type="text" maxlenght="200" name="link" id="link" style="width:95%" /></td></tr>
    <tr><td colspan="2" style="text-align:center"><input type="button" onclick="Show_ModPanel(document.aut_list.r_opt.options[document.aut_list.r_opt.selectedIndex].value,2);" name="sel_level" value="'.
            $language['FRM_CONFIRM'].'"/></td></tr>
    </table>
    </form>';
    }
    echo $out;
    die;
}
else
{
    echo 'no direct access';
}

?>
