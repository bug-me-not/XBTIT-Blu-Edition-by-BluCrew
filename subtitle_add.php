<?php

//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com
//converted to xbtit by cooly
if (!defined("IN_BTIT"))
    die("non direct access!");


require "include/sanitize.php";
require (load_language("lang_subs.php"));
$subsaddtpl = new bTemplate();
if ($CURUSER["can_upload"] == "no")
{
    err_msg(ERROR, NOT_AUTH_VIEW_NEWS);
    stdfoot();
    exit;
}
$nume = "";
$hash = "";
$pic = "";
$cds = "";
$autor = "";
$link = "";
$frame = "";
if (isset($_POST['crk']))
{
    $nume = $_POST['nume'];
    $hash = $_POST['hash'];
    $pic = $_POST['pic'];
    $cds = $_POST['cds'];
    $autor = $_POST['author'];
    $link = $_POST['link'];
    $frame = $_POST['frame'];
    $idflag = intval($_POST["flag"]);
    $file = $_POST["file"];
    $ping = do_sqlquery("SELECT info_hash FROM {$TABLE_PREFIX}files WHERE info_hash='$hash'");
    $find = $ping->fetch_assoc();
    if ($hash > $find["info_hash"])
    {
        stderr("Error", "No torrent matches this info hash");
        stdfoot();
        exit;
    }
    if (empty($nume) || empty($hash) || empty($idflag))
    {
        stderr("Error", "Please Complete all the fields!");
        stdfoot(false, false, true);
        die;
    }
    $file = $_FILES['file'];
    if (!$file || $file["size"] == 0 || $file["name"] == "")
        stderr("Error", "Nothing received! The selected file may have been too large.");
    if ($file["size"] > 1048576)
        stderr("Error", "Subs are too big! Max 1,048,576 bytes.");
    $res = get_result("SELECT * FROM {$TABLE_PREFIX}subtitles", true);
    $dupe = $res[0];
    if ($nume == $dupe['name'])
    {
        stderr("Error", "Duplicate name!");
        stdfoot(false, false, true);
        die;
    }
    //if($pic==$dupe['pic']){
    //stderr("Error","Duplicate pic!");
    //stdfoot(false,false,true);
    // die;
    //}/////other subs may be the same.
    //if($link==$dupe['imdb']){
    //stderr("Error","Duplicate imdb link!");
    //stdfoot(false,false,true);
    //           die;
    //}/////other subs may be the same.
    if ($_FILES['file']['name'] == $dupe['file'])
    {
        stderr("Error", "Duplicate file name");
        stdfoot(false, false, true);
        die;
    }
    $cds = sanitize_paranoid_string($cds);
    $autor = sanitize_paranoid_string($autor);
    $x = $_FILES['file']['name'];
    if ($_POST) //patch by Petr1fied

    {
        $ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], ".") + 1);
        $allowedext = array('sub', 'srt', 'zip', 'rar', 'ace', 'txt', 'SUB', 'SRT',
            'ZIP', 'RAR', 'ACE', 'TXT');
        if (!in_array($ext, $allowedext))
            die("Error: File extension <strong>$ext</strong> not allowed.");
        if ((isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) &&
            (isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])))
        {
            $check_subs = check_upload($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
            switch ($check_subs)
            {
                case 1:
                case 2:
                    $check_subs_err = $language["ERR_MISSING_DATA"];
                    if (file_exists($_FILES["file"]["tmp_name"]))
                        unlink($_FILES["file"]["tmp_name"]);
                    break;
                case 3:
                    $check_subs_err = $language["QUAR_TMP_FILE_MISS"];
                    break;
                case 4:
                    $check_subs_err = $language["QUAR_OUTPUT"];
                    break;
                case 5:
                default:
                    $check_subs_err = "";
                    break;
            }
            if ($check_subs_err != "")
                stderr($language["ERROR"], $check_subs_err);
        }
        $THIS_BASEPATH = dirname(__file__);
        $target_path = "subtitles/";
        $target_path = $target_path . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path))
        {
            @chmod("$THIS_BASEPATH/$target_path", 0777);
        }
        $uid = $CURUSER['uid'];
        quickQuery("INSERT INTO `{$TABLE_PREFIX}subtitles` (`id`, `name`, `hash`, `file`, `imdb`, `pic`, `Framerate`, `cds`, `uploader`, `downloaded`, `author`, `flag`) VALUES ('', '$nume', '$hash', '$x', '$link', '$pic', '$frame', '$cds', $uid, 0, '$autor',$idflag); ", true);
        success_msg("
Success", "The subtitle was added to the database!<br><a href=index.php?page=subtitles>Back To Subtitles!</a>");
        stdfoot(false, false, true);
        die;
    } else
    {
        stderr("Error", "There was an error while uploading, please try again!");
        stdfoot(false, false, true);
        die;
    }
} else
{
    $fres = flag_list();
    $option = "\n<select name=\"flag\" size=\"1\">\n<option value='0'>---</option>";
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
    $upform = "<form id=\"form1\" enctype=\"multipart/form-data\" name=\"form1\" method=\"post\" action=\"index.php?page=subadd\">
<p>&nbsp;</p>
<table border=\"0\" align=\"center\">
<tr><td class=\"block\" colspan=\"4\">&nbsp;</td></tr><tr>
  <tr>
    <td class=\"header\">" . $language['SUB_NAME'] . " *</td>
    <td class=\"lista\"><input name=\"nume\" type=\"text\" id=\"nume\" size=\"40\" /></td>
  </tr>
   <tr>
    <td class=header>" . $language['SUB_HASH'] . " *</td>
    <td class=\"lista\"><input name=\"hash\" type=\"text\" id=\"hash\" size=\"40\" /></td>
  </tr>
  <tr>
    <td class=\"header\">" . $language['SUB_IMDB'] . "</td>
    <td class=\"lista\"><input name=\"link\" type=\"text\" id=\"link\" size=\"40\" /></td>
  </tr>
       <tr>
       <td align=\"left\" class=\"header\">" . $language['SUB_LANG'] . " *</td>
       <td align=\"left\" class=\"lista\">" . $option . "</td>
    </tr>
  <tr>
    <td class=\"header\">" . $language['SUB_IMG'] . "</td>
    <td class=\"lista\"><input name=\"pic\" type=\"text\" id=\"pic\" size=\"40\" /></td>
  </tr>
  <tr>
    <td class=\"header\">" . $language['SUB_FR'] . "</td>
    <td class=\"lista\"><input name=\"frame\" type=\"text\" id=\"frame\" size=\"10\" /></td>
  </tr>
  <tr>
    <td class=\"header\">" . $language['SUB_CD'] . "</td>
    <td class=\"lista\"><input name=\"cds\" type=\"text\" id=\"cds\" size=\"10\" /></td>
  </tr>
  <tr>
    <td class=\"header\">" . $language['SUB_AUTH'] . "</td>
    <td class=\"lista\"><input name=\"author\" type=\"text\" id=\"author\" size=\"40\" /></td>
  </tr>
  <tr>
    <td class=\"header\">" . $language['SUB_FILE'] . " *</td>
    <td class=\"lista\"><br />
      <input type=\"file\" name=\"file\" />
<br />" . $language['SUB_FILE_T'] . "
</td>
  </tr>
</table>
<p align=\"center\">
  <input name=\"crk\" type=\"hidden\" id=\"crk\" value=\"100\" />
  <input class=btn name=\"Submit\" type=\"submit\" id=\"Submit\" value=\"" . $language['SUB'] .
        "\" />&nbsp;" . $language['SUBCANCEL'] . "
</p>
</form>";
}
$subsaddtpl->set("upform", $upform);
//converted to xbtit by cooly
//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com


?>
