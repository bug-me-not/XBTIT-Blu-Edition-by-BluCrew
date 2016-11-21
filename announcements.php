<?php
require_once("include/functions.php");
//require_once (load_language("lang_staff_announcements.php"));
require_once ("language/english/lang_staff_announcements.php");
dbconn();
global $CURUSER, $TABLE_PREFIX, $btit_settings, $language;
//get current style
  $resheet=get_result("SELECT(SELECT `style_url` FROM `{$TABLE_PREFIX}style` WHERE `id`=".$CURUSER["style"].") `style_url`, (SELECT `language_url` FROM `{$TABLE_PREFIX}language` WHERE `id`=".$CURUSER["language"].") `language_url`",true,$btit_settings["cache_duration"]);
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
}
else
    {
        $resstyle=$resheet[0];
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
        $LANGPATH2=$THIS_BASEPATH."/".$resstyle["language_url"];
}
echo"
<html>
<head>
<title>".$language['ANNOUNCEMENT']."</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head>
<body>
<div class='main'>";
if ($CURUSER["admin_access"] != "yes")
stderr("Access Denied!", "".$language['ACCESS_DENIED']."");
unset ($action,$do);
$action = isset($_POST['action']) ? htmlspecialchars($_POST['action']) : (isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'show');
$do = isset($_POST['do']) ? htmlspecialchars($_POST['do']) : (isset($_GET['do']) ? htmlspecialchars($_GET['do']) : '');
function get_user_level_name($i){
global $TABLE_PREFIX;
$res=do_sqlquery("SELECT level FROM {$TABLE_PREFIX}users_level WHERE id=".$i."");
$row=$res->fetch_row();
return $row[0];
}
function get_user_level(){
return $GLOBALS["CURUSER"]["id_level"];
}
function show ($subject, $message, $added, $by, $id_level) {
global $btit_settings, $BASEURL;
?>




<script language="JavaScript1.2">



// Drop-in content box- By Dynamic Drive

// For full source code and more DHTML scripts, visit http://www.dynamicdrive.com

// This credit MUST stay intact for use



var ie=document.all

var dom=document.getElementById

var ns4=document.layers

var calunits=document.layers? "" : "px"



var bouncelimit=32 //(must be divisible by 8)

var direction="up"



function initbox(){

if (!dom&&!ie&&!ns4)

return

crossobj=(dom)?document.getElementById("dropin").style : ie? document.all.dropin : document.dropin

scroll_top=(ie)? truebody().scrollTop : window.pageYOffset

crossobj.top=scroll_top-250+calunits

crossobj.visibility=(dom||ie)? "visible" : "show"

dropstart=setInterval("dropin()",50)

}



function dropin(){

scroll_top=(ie)? truebody().scrollTop : window.pageYOffset

if (parseInt(crossobj.top)<100+scroll_top)

crossobj.top=parseInt(crossobj.top)+40+calunits

else{

clearInterval(dropstart)

bouncestart=setInterval("bouncein()",50)

}

}



function bouncein(){

crossobj.top=parseInt(crossobj.top)-bouncelimit+calunits

if (bouncelimit<0)

bouncelimit+=8

bouncelimit=bouncelimit*-1

if (bouncelimit==0){

clearInterval(bouncestart)

}

}



function dismissbox(){

if (window.bouncestart) clearInterval(bouncestart)

crossobj.visibility="hidden"

window.location="<?php echo $BASEURL;?>/announcements.php";

}



function redo(){

bouncelimit=32

direction="up"

initbox()

}



function truebody(){

return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body

}

window.onload=initbox

</script>





<div id="dropin" style="background-color:#231708;position:absolute;visibility:hidden;left:5px;top:100px;width:650px;height:130px;">
<table width="650" align="center" border="1" cellspacing="0" cellpadding="5" background-color:#231708;><tr><td class="header"><div style="float:left;"><font color=white><?php echo $subject;?> -- <b><?php echo $language["CREATED_ON"]?>:</b> <?php echo $added;?> -- <b><?php echo $language["BY"]?>:</b> <?php echo $by;?></b> -- <b><?php echo $language["TO_LEVEL"]?>:</b> <?php echo $id_level;?></div><div style="float:right; width:16px;"><a href="#" onClick="dismissbox();return false"><img border="0" src="static/images/close.jpg"></a></div></td><tr><td class="lista"><?php echo format_comment($message);?></font></td></tr></table>
</div>


<?php

}



if ($action == 'see') {

$id = (isset($_GET['id']) ? (int)$_GET['id'] : (int)$_POST['id']);

$res = do_sqlquery('SELECT * FROM '.$TABLE_PREFIX.'announcements WHERE id = '.sqlesc($id)) or sqlerr(__FILE__, __LINE__);

$arr = $res->fetch_array();

show ($arr['subject'], $arr['message'], $arr['added'], $arr['by'], get_user_level_name($arr['minclassread']));

die;

}

elseif ($action == 'delete') {

$id = (isset($_GET['id']) ? (int)$_GET['id'] : (int)$_POST['id']);

$sure = (string)$_GET['sure'];

if (!$sure) {

die('<div style="margin-top:100px"><table width="600" align="center" border="1" cellspacing="0" cellpadding="5"><td class="header" align="center" style="text-align:center;margin-top:200px;"><span style="font-weight:bold;">'.$language['SANITY_CHECK'].':</span></td></tr><tr><td class="lista" style="text-align:center;"> '.$language['DLETE_ANN'].' '.$language['CLICK1'].' <a href=?action=delete&id='.$id.'&sure=yes>'.$language['CLICK2'].'</a> '.$language['CLICK4'].' (<a href="announcements.php">'.$language['CANCEL'].'</a>)</td></tr></table></div>');

}else

quickQuery('DELETE FROM '.$TABLE_PREFIX.'announcements WHERE id = '.sqlesc($id)) or sqlerr(__FILE__, __LINE__);

redirect("announcements.php");

}

elseif ($action == 'add') {

if ($do == 'save') {

//$added = get_date_time();

$subject = htmlspecialchars($_POST['subject']);

$message = htmlspecialchars($_POST['message']);

$minclassread = $_POST['minclassread'];

if (empty($subject) OR empty($message))

stderr("Error!", "Dont leave any fields blank!");

quickQuery('INSERT INTO '.$TABLE_PREFIX.'announcements (subject, message, added, minclassread) VALUES ('.sqlesc($subject).', '.sqlesc($message).', NOW(), '.sqlesc($minclassread).')') or sqlerr(__FILE__, __LINE__);

quickQuery('UPDATE '.$TABLE_PREFIX.'users SET announce_read = \'no\' WHERE announce_read = \'yes\' AND id_level >= '.$minclassread) or sqlerr(__FILE__, __LINE__);

redirect("announcements.php");



}else{



$maxclass = get_user_level();

for ($i = 1; $i <= $maxclass; ++$i)

$value .= "<option value=$i" . ($row["minclassread"] == $i ? " selected" : "") . ">" . get_user_level_name($i) . "\n";

$scripty="

<script type=\"text/javascript\">

<!--

function anntext(repdeb, repfin) {

  var input = document.forms['announce'].elements['message'];

  input.focus();



  if(typeof document.selection != 'undefined') {



    var range = document.selection.createRange();

    var insText = range.text;

    range.text = repdeb + insText + repfin;



    range = document.selection.createRange();

    if (insText.length == 0) {

      range.move('character', -repfin.length);

    } else {

      range.moveStart('character', repdeb.length + insText.length + repfin.length);

    }

    range.select();

  }



  else if(typeof input.selectionStart != 'undefined')

  {



    var start = input.selectionStart;

    var end = input.selectionEnd;

    var insText = input.value.substring(start, end);

    input.value = input.value.substr(0, start) + repdeb + insText + repfin + input.value.substr(end);



    var pos;

    if (insText.length == 0) {

      pos = start + repdeb.length;

    } else {

      pos = start + repdeb.length + insText.length + repfin.length;

    }

    input.selectionStart = pos;

    input.selectionEnd = pos;

  }



  else

  {



    var pos;

    var re = new RegExp('^[0-9]{0,3}$');

    while(!re.test(pos)) {

      pos = prompt(\"Insertion à la position (0..\" + input.value.length + \"):\", \"0\");

    }

    if(pos > input.value.length) {

      pos = input.value.length;

    }



    var insText = prompt(\"Veuillez entrer le texte à formater:\");

    input.value = input.value.substr(0, pos) + repdeb + insText + repfin + input.value.substr(pos);

  }

}



function bbcolor() {

	var colorvalue = document.forms['announce'].elements['color'].value;

	anntext(\"[color=\"+colorvalue+\"]\", \"[/color]\");

}



function bbfont() {

	var fontvalue = document.forms['announce'].elements['font'].value;

	anntext(\"[font=\"+fontvalue+\"]\", \"[/font]\");

}

function bbsize() {

    var sizevalue = document.forms['announce'].elements['size'].value;

    anntext(\"[size=\"+sizevalue+\"]\", \"[/size]\");

}

//-->

</script>";



echo $scripty;





$tags= "<table border=0 cellpadding=0 cellspacing=2><tr>

<tr>


<td width=22><a href=\"javascript:anntext('[b]', '[/b]')\"><img src=./images/bbcode/bbcode_bold.gif border=0 alt='Bold'></a></td>

<td width=22><a href=\"javascript:anntext('[i]', '[/i]')\"><img src=./images/bbcode/bbcode_italic.gif border=0 alt='Italic'></a></td>

<td width=22><a href=\"javascript:anntext('[u]', '[/u]')\"><img src=./images/bbcode/bbcode_underline.gif border=0 alt='Underline'></a></td>

<td width=22><a href=\"javascript:anntext('[url]', '[/url]')\"><img src=./images/bbcode/bbcode_url.gif border=0 alt='Url'></a></td>
<td width=22><a href=\"javascript:anntext('[img]', '[/img]')\"><img src=./images/bbcode/bbcode_image.gif border=0 alt='Img'></a></td>





<td>

<select name='color' size=\"1\" onChange=\"javascript:bbcolor()\">

<option selected='selected'>COLOR</option>

<option value=skyblue style=color:skyblue>sky blue</option>

<option value=royalblue style=color:royalblue>royal blue</option>

<option value=blue style=color:blue>blue</option>

<option value=darkblue style=color:darkblue>dark-blue</option>

<option value=orange style=color:orange>orange</option>

<option value=orangered style=color:orangered>orange-red</option>

<option value=crimson style=color:crimson>crimson</option>

<option value=red style=color:red>red</option>

<option value=firebrick style=color:firebrick>firebrick</option>

<option value=darkred style=color:darkred>dark red</option>

<option value=green style=color:green>green</option>

<option value=limegreen style=color:limegreen>limegreen</option>

<option value=seagreen style=color:seagreen>sea-green</option>

<option value=deeppink style=color:deeppink>deeppink</option>

<option value=tomato style=color:tomato>tomato</option>

<option value=coral style=color:coral>coral</option>

<option value=purple style=color:purple>purple</option>

<option value=indigo style=color:indigo>indigo</option>

<option value=burlywood style=color:burlywood>burlywood</option>

<option value=sandybrown style=color:sandybrown>sandy brown</option>

<option value=sienna style=color:sienna>sienna</option>

<option value=chocolate style=color:chocolate>chocolate</option>

<option value=teal style=color:teal>teal</option>

<option value=silver style=color:silver>silver</option>

</select></td>



<td>

<select name='size' size=\"1\" onChange=\"javascript:bbsize()\">

<option selected='selected'>Size</option>

<option value=1>1</option>

<option value=2>2</option>

<option value=3>3</option>

<option value=4>4</option>

<option value=5>5</option>

<option value=6>6</option>

<option value=7>7</option>

</select></td>

</tr></table>";

$fun='<script type = "text/javascript">



// decreases height of text box - use similar with cols to decrease width

function decHeight() {

if(document.announce.message.rows > 3){

document.announce.message.rows = document.announce.message.rows - 3;

}

}



// increases height of text box - use similar with cols to increase width

function incHeight() {

document.announce.message.rows = document.announce.message.rows + 3;

}





</script>';



echo '<form name="announce" method=post action="'.$_SERVER['SCRIPT_NAME'].'">

<input type=hidden name=action value=add>

<input type=hidden name=do value=save>';

echo '<table border=1 cellspacing=0 cellpadding=5 align=center>';

echo '<tr><td class="header">'.$language['SUBJECT'].': </td><td class="lista"><input type=text name=subject id=specialboxg maxlength=64 size=45>&nbsp;&nbsp;<input type="button" name="up" style = "color:red; font-size: 12pt; font-weight:bold" value="+" onclick="incHeight();" title="'.$language["INCREASE_TEXT"].'">

<input type="button" name="dn" style = "color:red; font-size: 12pt; font-weight:bold" value="-" onclick="decHeight();" title="'.$language["DECREASE_TEXT"].'"></td></tr>';

echo '<tr><td class="header">'.$language["MESSAGE"].': </td><td class="lista"><textarea id="txtara" name=message rows=8 cols=60 id=specialboxg></textarea><br />'.$tags.'</tr></td>';

echo '<tr><td class="header">'.$language["MIN_CLASS_READ"].':</td><td class="lista">

<select name=minclassread>'.$value.'</select>&nbsp;<input type=submit value='.$language["SAVE"].' class=btn></form></td></tr></table>';

echo"<br /><center><a href='announcements.php'>".$language['GO_BACK']."</a></center>";

echo $fun."</div>";

die;

}

}

elseif ($action == 'edit') {

$id = (isset($_GET['id']) ? (int)$_GET['id'] : (int)$_POST['id']);

if ($do == 'save'){

$by = htmlspecialchars($_POST['by']);

$subject = htmlspecialchars($_POST['subject']);

$message = htmlspecialchars($_POST['message']);

$minclassread = $_POST['minclassread'];

$list=get_result("SELECT id FROM {$TABLE_PREFIX}users_level ORDER by id",true);

$allow = array(implode(",",$list));

if (empty($subject) OR empty($message) OR empty($by))

stderr("Error!", "Dont leave any fields blank!".print_r($list).$allow);

quickQuery('UPDATE '.$TABLE_PREFIX.'announcements SET `by` = '.sqlesc($by).', subject = '.sqlesc($subject).', message = '.sqlesc($message).', minclassread = '.sqlesc($minclassread).' WHERE id = '.sqlesc($id)) or sqlerr(__FILE__, __LINE__);

if ($_POST['reset'] == 'yes')

quickQuery('UPDATE '.$TABLE_PREFIX.'users SET announce_read = \'no\' WHERE announce_read = \'yes\' AND id_level >= '.$minclassread) or sqlerr(__FILE__, __LINE__);

redirect("announcements.php");

}else{

$res = do_sqlquery('SELECT * FROM '.$TABLE_PREFIX.'announcements WHERE id = '.sqlesc($id)) or sqlerr(__FILE__, __LINE__);

if (sql_num_rows($res) == 0)

stderr('Error',''.$language["INVALID_LINK"].'!');

else

$arr = $res->fetch_array();

$maxclass = get_user_level();

for ($i = 0; $i <= $maxclass; ++$i)

$value .= "<option value=$i" . ($arr["minclassread"] == $i ? " selected" : "") . ">" . get_user_level_name($i) . "\n";

echo '<form method=post action="'.$_SERVER['SCRIPT_NAME'].'">

<input type=hidden name=action value=edit>

<input type=hidden name=do value=save>

<input type=hidden name=id value='.$id.'>';

echo '<br /><br /><table border=1 cellspacing=0 cellpadding=5 align=center>';

echo '<tr><td class=header>'.$language['SUBJECT'].': </td><td class=lista><input type=text name=subject id=specialboxg size=35 maxlength=64 value="'.$arr['subject'].'"></tr></td>';

echo '<tr><td class=header>'.$language['MESSAGE'].': </td><td class=lista><textarea name=message rows=10 cols=50 id=specialboxg>'.$arr['message'].'</textarea></tr></td>';

echo '<tr><td class=header>'.$language['CREATOR'].': </td><td class=lista><input type=text name=by id=specialboxg maxlength=64 value="'.$arr['by'].'"></tr></td>';

echo '<tr><td class=header>'.$language['MIN_CLASS_READ'].': </td><td class=lista>

<select name=minclassread>'.$value.'</select> <input type=checkbox name=reset value=yes> '.$language['CHECK_THIS'].' <input type=submit value=save class=btn></form></tr></td></table>';

echo"<br /><center><a href='announcements.php'>".$language['GO_BACK']."</a>";

die;

}

}



//===Show All Announcements

$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}announcements ORDER by added DESC");


echo"<br /><br /><table border=1 cellspacing=0 cellpadding=5 width=100% class='main'>
<tr><td class='header' colspan='6' style='text-align:center;'>".$language['MANAGE_ANN']."</td></tr>\n
<tr><td class='header' style='text-align:center;'>".$language['ID']."</td><td class='header' style='text-align:center;'>".$language['SUBJECT']."</td><td class='header' style='text-align:center;'>".$language['MESSAGE']."</td><td class='header' style='text-align:center;'>".$language['ADDED']."</td><td class='header' style='text-align:center;'>".$language['MIN_CLASS']."</td><td class='header' style='text-align:center;'>".$language['ACTION']."</td></tr>\n";

if (sql_num_rows($res) >= 1) {

while ($arr = $res->fetch_array()) {

print("<tr><td class='lista' style='text-align:center;'>".htmlspecialchars($arr[id])."</td><td class='lista' style='text-align:center;'>".htmlspecialchars($arr[subject])."</td>".

"<td class='lista' style='text-align:center;'>".format_comment($arr[message])."</td><td class='lista'style='text-align:center;'>".htmlspecialchars($arr[added])." <b>".$language['BY']."&nbsp;"."".htmlspecialchars($arr[by])."</b></td><td class='lista' style='text-align:center;'>".get_user_level_name(htmlspecialchars($arr[minclassread]))."</td><td class='lista' style='text-align:center;'><a href=?action=see&id=$arr[id]>".$language['SHOW']."</a>&nbsp;/&nbsp;<a href=?action=edit&id=$arr[id]>".$language['EDIT']."</a>&nbsp;/&nbsp;<a href=?action=delete&id=$arr[id]>".$language['DELETE']."</a></td></tr>");

}

}else

print("<tr><td colspan=6>".$language['NOT_FOUND']."</td></tr>");

print("<tr><td class='header' colspan=6 style='text-align:center;'>".$language['CLICK1']." <a href=?action=add>".$language['CLICK2']."</a> ".$language['CLICK3']."</tr></td></tr>");

echo "</table></div></body></html>";
?>
