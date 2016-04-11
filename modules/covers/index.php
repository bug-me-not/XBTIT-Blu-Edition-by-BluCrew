<?php
/////////////////////////////////////////////////////////////////////////////////////
// Cover site addon for xbtit by medishack
// Index Page
// DB Entries id, imdb, filename, filelocation, width, height, size, type
////////////////////////////////////////////////////////////////////////////////////
ob_start();
if ($CURUSER["id"] < 4)
{
	$coverquery = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}covers");
	$num = sql_num_rows($coverquery);
	stderr("VIP Access ONLY", "The covers section browser is only available to VIP to access you need to be VIP class or above you may get this by donating for VIP Access.<br />Available covers are still available to download via the relevant torrent detail pages.<br /><br />There are {$num} covers available");
}

if (isset($_GET['list']))
$list = $_GET['list'];
else
$list = "all";

if (isset($_GET['opt']))
$page = $_GET['opt'];
else
$page = "";


// list options
$spacer = "&nbsp;&nbsp;&nbsp;";
print "<div align=\"center\">
<a href=\"index.php?page=modules&module=covers&list=all\">[ALL]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=num\">[#]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=a\">[A]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=b\">[B]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=c\">[C]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=d\">[D]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=e\">[E]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=f\">[F]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=g\">[G]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=h\">[H]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=i\">[I]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=j\">[J]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=k\">[K]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=l\">[L]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=m\">[M]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=n\">[N]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=o\">[O]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=p\">[P]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=q\">[Q]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=r\">[R]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=s\">[S]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=t\">[T]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=u\">[U]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=v\">[V]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=w\">[W]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=x\">[X]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=y\">[Y]</a>$spacer
<a href=\"index.php?page=modules&module=covers&list=z\">[Z]</a>
</div>
<br/><br />";

// only allow mod and above to upload
if ($CURUSER['id_level'] >= 6)
print "<div align=\"center\"><a href=\"index.php?page=modules&module=covers&opt=upload\">Upload Cover</a><br/><br /></div>";

// show upload form
if ($page == "upload"){
if ($CURUSER['id_level'] < 6)
die();

print "<div align=\"center\">
<form action=\"index.php?page=modules&module=covers&opt=takeupload\" method=\"post\" enctype=\"multipart/form-data\">
<input type=\"file\" name=\"coverfile\" id=\"coverfile\"><br /><br />
Title: <input type=\"text\" name=\"title\" id=\"title\" size=\"100\"><br />
IMDB Number: <input type=\"text\" name=\"imdbnum\" id=\"imdbnum\"> e.g 0787474<br />
<br />
Type:
<input type=\"radio\" name=\"type\" value=\"unknown\" checked>Unknown
<input type=\"radio\" name=\"type\" value=\"scan\">Scan
<input type=\"radio\" name=\"type\" value=\"custom\">Custom
<br />
Type:
<input type=\"radio\" name=\"region\" value=\"unknown\" checked>Unknown
<input type=\"radio\" name=\"region\" value=\"a\">A
<input type=\"radio\" name=\"region\" value=\"b\">B
<input type=\"radio\" name=\"region\" value=\"c\">C


<br /><br />
<input type=\"submit\" name=\"submit\" value=\"Upload\">
</form>
<br/><br /></div>";
}
// mysql query to get cover id's that match
if ($list == "all" || $list = ""){
$coverquery = "SELECT * FROM `{$TABLE_PREFIX}covers` ORDER BY `name` ASC";
$covres = (do_sqlquery($coverquery));
}else{
$list = $_GET['list'];
if ($list == 'num'){
$sort = "'1','2','3','4','5','6','7','8','9','0'";
}elseif ($list == 'a'){
$sort = "'A'";
}elseif ($list == 'b'){
$sort = "'B'";
}elseif ($list == 'c'){
$sort = "'C'";
}elseif ($list == 'd'){
$sort = "'D'";
}elseif ($list == 'e'){
$sort = "'E'";
}elseif ($list == 'f'){
$sort = "'F'";
}elseif ($list == 'g'){
$sort = "'G'";
}elseif ($list == 'h'){
$sort = "'H'";
}elseif ($list == 'i'){
$sort = "'I'";
}elseif ($list == 'j'){
$sort = "'J'";
}elseif ($list == 'k'){
$sort = "'K'";
}elseif ($list == 'l'){
$sort = "'L'";
}elseif ($list == 'm'){
$sort = "'M'";
}elseif ($list == 'n'){
$sort = "'N'";
}elseif ($list == 'o'){
$sort = "'O'";
}elseif ($list == 'p'){
$sort = "'P'";
}elseif ($list == 'q'){
$sort = "'Q'";
}elseif ($list == 'r'){
$sort = "'R'";
}elseif ($list == 's'){
$sort = "'S'";
}elseif ($list == 't'){
$sort = "'T'";
}elseif ($list == 'u'){
$sort = "'U'";
}elseif ($list == 'v'){
$sort = "'V'";
}elseif ($list == 'w'){
$sort = "'W'";
}elseif ($list == 'x'){
$sort = "'X'";
}elseif ($list == 'y'){
$sort = "'Y'";
}elseif ($list == 'z'){
$sort = "'Z'";
}else{
stderr('Error','Invalid Selection');
}

$coverquery = "SELECT * FROM `{$TABLE_PREFIX}covers` WHERE `sort` IN (".$sort.") ORDER BY `name` ASC";
$covres = (do_sqlquery($coverquery));
}

// display results in a form list
if ($page == "view" || $page == "upload" || $page == "takeupload") {
print "";
}else{
print "<div align=\"center\">
<form action=\"index.php?page=modules&module=covers&opt=view\" method=\"post\">
<select name=\"id\">";
while($cover = $covres->fetch_assoc()) {

print "<option value=\"".$cover['id']."\">".$cover['name']." [Region: ".$cover['region']."] - [".$cover['type']." ".$cover['scan']."] - [".$cover['width']." x ".$cover['height']."] @ ".makesize($cover['size'])."</option>";
 }
print "</select>
<input type=\"submit\" value=\"Display\">
</form>
<br/><br /></div>
";
}

// view cover
if ($page == "view"){
// only allow mod and above to delete
if ($CURUSER['id_level'] >= 6)
print "<div align=\"center\"><a href=\"index.php?page=modules&module=covers&opt=del\">Delete Cover (Not working yet)</a><br/><br /></div>";

print "<div align=\"center\">";
// show image
if (isset($_POST['id'])){
$covid = $_POST['id'];
}elseif (isset($_GET['id'])){
$covid = $_GET['id'];
}else{
$covid = 0;
}
// do something if covid is 0 or not exist

$coverquery = "SELECT * FROM `{$TABLE_PREFIX}covers` WHERE `id` = ".$covid."";
$cover = do_sqlquery($coverquery)->fetch_assoc();
print "<div align=\"center\">
<h1>".$cover['name']."</h1><br />
Size: ".$cover['width']." x ".$cover['height']." @ ".makesize($cover['size'])."
<br/><br /></div>";
print "<img src=\"covers/".$cover['filename']."\" alt=\"".$cover['name']."\" width=\"400\">";
print "<br/><br /></div>";
}


// delete cover
if ($page == "del"){
if ($CURUSER['id_level'] < 6)
die();
print "<div align=\"center\">
delete cover not implemented yet
<br/><br /></div>";
}

// deal with uploaded data
if ($page == "takeupload"){
if ($CURUSER['id_level'] < 6)
die();
// make sure name is set and file was uploaded
is_uploaded_file($_FILES["coverfile"]["tmp_name"]) or stderr('Error','No file uploaded or no file was selected for upload');
is_numeric($_POST["imdbnum"]) or stderr('Error','IMDB Field should be a number');
if (!isset($_POST['title']) || $_POST['title'] == "" || !isset($_POST['imdbnum']) || $_POST['imdbnum'] == ""){
unset($_FILES["coverfile"]["tmp_name"]);
stderr('Error','No title entered or IMDB Number missing');
die();
}

$imdblen = strlen($_POST["imdbnum"]);
if ($imdblen != 7){
stderr('Error','IMDB Number is of the incorrect length it should be 7 numbers');
die();
}


//insert file into database
$coverfile = $_FILES["coverfile"]["tmp_name"];
$name = $_FILES["coverfile"]["name"];
$siz = $_FILES["coverfile"]["size"];
$ext = pathinfo($name, PATHINFO_EXTENSION);
$md5 = md5_file($_FILES["coverfile"]["tmp_name"]).".".$ext;
$imdbnum = $_POST['imdbnum'];
$type = $_POST['type'];
//$cover = $_POST['cover']; using dimentions to figure a disc
$title = $_POST['title'];
$region = $_POST['region'];
$COVERDIR = "covers";
$sort = $title[0];
list($width, $height) = getimagesize($_FILES["coverfile"]["tmp_name"]);

if ($width == $height){
$cover = 'DISC';
}else{
$cover = 'CASE';
}

$cf = @move_uploaded_file($_FILES["coverfile"]["tmp_name"],$COVERDIR."/".$md5);
if (!$cf)
{
stderr('Error','Failed to move the cover');
die();
}
unset($_FILES["coverfile"]["tmp_name"]);
$user = $CURUSER['uid'];
quickQuery("INSERT INTO `{$TABLE_PREFIX}covers` (`imdb`, `name`, `filename`, `width`, `height`, `size`, `type`, `region`, `scan`, `sort`, `user`) VALUES ('{$imdbnum}', '{$title}', '{$md5}', '{$width}', '{$height}', '{$siz}', '{$cover}', '{$region}', '{$type}', '{$sort}', '{$user}')");


$siz = round($siz/1000/1000, 2);

print "<div align=\"center\">
Upload done
<br/><br /></div>";
}

// footer
print "<div align=\"center\">Cover Site by Medishack<br/><br /></div>";
$module_out=ob_get_contents();
ob_end_clean();
?>
