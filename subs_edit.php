<?php

//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com
//converted to xbtit by cooly
if (!defined("IN_BTIT"))
    die("non direct access!");

    
global $CURUSER;
require "include/sanitize.php";
$subsedittpl = new bTemplate();
require (load_language("lang_subs.php"));
if ($CURUSER["can_upload"] == "no")
{
    err_msg(ERROR, NOT_AUTH_VIEW_NEWS);
    stdfoot();
    exit;
}
$action = $_GET["action"];
if ($action == "edit")
{
    $id = $_GET["id"];
    $res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}subtitles WHERE id=" . $_GET['id']) or
        sqlerr();
    if (sql_num_rows($res) != 1)
        stderr("Error", "No message with ID $id.");
    $arr = $res->fetch_assoc();
    if ($CURUSER["uid"] != $arr["uploader"] or $CURUSER["edit_torrents"] != "yes")
        stderr("Error", "you didnt post this!");
    $save = (int)$_GET["save"];
    if ($save)
    {
        $crk = $_POST['crk'];
        if (!is_null($crk))
        {
            $nume = $_POST['nume'];
            $hash = $_POST['hash'];
            $pic = $_POST['pic'];
            $cds = $_POST['cds'];
            $autor = $_POST['author'];
            $link = $_POST['link'];
            $frame = $_POST['frame'];
            $idflag = intval($_POST["flag"]);
            $ping = do_sqlquery("SELECT info_hash FROM {$TABLE_PREFIX}files WHERE info_hash='$hash'");
            $find = $ping->fetch_assoc();
            if ($hash > $find["info_hash"])
            {
                stderr("Error", "No torrent matches this info hash");
                stdfoot();
                exit;
            }
            if (is_null($nume) || is_null($hash) || is_null($pic) || is_null($cds) ||
                is_null($autor) || is_null($link) || is_null($frame))
            {
                stderr("Error", "Please Complete all the fields!");
                stdfoot(false, false, true);
                die;
            }
            $cds = sanitize_paranoid_string($cds);
            $autor = sanitize_paranoid_string($autor);
            quickQuery("UPDATE {$TABLE_PREFIX}subtitles SET name='$nume', hash='$hash', pic='$pic', cds='$cds', author='$autor', imdb='$link', Framerate='$frame', flag='$idflag' WHERE id=" .
                $_GET['id']) or sqlerr();
            redirect("index.php?page=subtitles");
        }
    }
    $getname = do_sqlquery("select * from {$TABLE_PREFIX}countries where id=" . $arr["flag"]);
    $named = $getname->fetch_assoc();
    $fres = flag_list();
    $option = "\n<select name=\"flag\" size=\"1\">\n<option value='" . $arr["flag"] .
        "'>" . $named["name"] . "</option>";
    $thisip = $_SERVER["REMOTE_ADDR"];
    $remotedns = gethostbyaddr($thisip);
    if ($remotedns != $thisip)
    {
        $remotedns = strtoupper($remotedns);
        preg_match('/^(.+)\.([A-Z]{2,3})$/', $remotedns, $tldm);
        if (isset($tldm[2]))
            $remotedns = sqlesc($tldm[2]);
    }
    foreach ($fres as $flag)
    {
        $option .= "\n<option ";
        if ($flag["id"] == $dati["flag"] || ($flag["domain"] == $remotedns && $action ==
            "signup"))
            $option .= "\"selected\" ";
        $option .= "value=\"" . $flag["id"] . "\">" . $flag["name"] . "</option>";
    }
    $option .= "\n</select>";
    $upform = "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"index.php?page=subedit&action=edit&save=1&id=$id\">
<p>&nbsp;</p>
<table width=\"349\" border=\"0\" align=\"center\">
<tr><td class=block colspan=4>&nbsp;</td></tr><tr>
  <tr>
    <td class=header width=\"95\">" . $language['SUB_NAME'] . "</td>
    <td class=lista width=\"244\"><input name=\"nume\" type=\"text\" id=\"nume\" size=\"40\" value=\"" .
        $arr[name] . "\"></td>
  </tr>
   <tr>
    <td class=header width=\"95\">" . $language['SUB_HASH'] . "</td>
    <td class=lista width=\"244\"><input name=\"hash\" type=\"text\" id=\"hash\" size=\"40\" value=\"" .
        $arr[hash] . "\"></td>
  </tr>
  <tr>
    <td class=header>" . $language['SUB_IMDB'] . "</td>
    <td class=lista><input name=\"link\" type=\"text\" id=\"link\" size=\"40\" value=\"" .
        $arr[imdb] . "\"></td>
  </tr>
       <tr>
       <td align=\"left\" class=\"header\">" . $language['SUB_LANG'] . "</td>
       <td align=\"left\" class=\"lista\">" . $option . "</td>
    </tr>
  <tr>
    <td class=header>" . $language['SUB_IMG'] . "</td>
    <td class=lista><input name=\"pic\" type=\"text\" id=\"pic\" size=\"40\" value=\"" .
        $arr[pic] . "\"></td>
  </tr>
  <tr>
    <td class=header><label for=\"checkbox_row_6\">" . $language['SUB_FR'] .
        "</label>
      :</td>
    <td class=lista><input name=\"frame\" type=\"text\" id=\"frame\" size=\"10\" value=\"" .
        $arr[Framerate] . "\"></td>
  </tr>
  <tr>
    <td class=header>" . $language['SUB_CD'] . "</td>
    <td class=lista><input name=\"cds\" type=\"text\" id=\"cds\" size=\"10\" value=\"" .
        $arr[cds] . "\"></td>
  </tr>
  <tr>
    <td class=header><label for=\"checkbox_row_10\">" . $language['SUB_AUTH'] .
        "</label></td>
    <td class=lista><input name=\"author\" type=\"text\" id=\"author\" size=\"40\" value=\"" .
        $arr[author] . "\"></td>
  </tr>
</table>
<p align=\"center\">
  <input name=\"crk\" type=\"hidden\" id=\"crk\" value=\"100\" />
  <input class=btn name=\"Submit\" type=\"submit\" id=\"Submit\" value=\"" . $language['SUB'] .
        "\" />&nbsp; " . $language['SUBCANCEL'] . "
</p>
</form>";
}
$endp = "</p>";
$subsedittpl->set("upform", $upform);
$subsedittpl->set("endp", $endp);

?>