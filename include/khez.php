<?php
##############################################################################
# KOCS Hack - CrossHack Functions
#
# Copyright (C) 2008 Khez
#
#    This file is part of the KOCS hack.
#
#
# THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
# WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
# MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
# IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
# TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
# PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
# LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
# NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
# EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
#
##############################################################################

# multi hack require
global $_KHEZ;
if (!isset($_KHEZ)) {
	$_KHEZ=true;

function getTimeList() {
	$time=array();
	$time[]=array('id'=>'s', 'value'=>'Seconds');
	$time[]=array('id'=>'i', 'value'=>'Minutes');
	$time[]=array('id'=>'H', 'value'=>'Hours');
	$time[]=array('id'=>'d', 'value'=>'Days');
	$time[]=array('id'=>'W', 'value'=>'Weeks');
	$time[]=array('id'=>'m', 'value'=>'Months');
	$time[]=array('id'=>'Y', 'value'=>'Years');
	return $time;
} # getTimeList()

function getTimeValue(&$type) {
	switch ($type) {
		case 's':
			return 'second';
		case 'i':
			return 'minute';
		case 'H':
			return 'hour';
		case 'd':
			return 'day';
		case 'W':
			return 'week';
		case 'm':
			return 'month';
		case 'Y':
			return 'year';
	}
} # getTimeValue(&$type)

function getTime($ammount, $type) {
	return strtotime($ammount.' '.getTimeValue($type));
} # getTime($ammount, $type)

function getTimeX(&$ammount, &$type, $time) {
	return strtotime($ammount.' '.getTimeValue($type), $time);
} # getTimeX(&$ammount, &$type, $time)

function getSizeList() {
	$size=array();
	$size[]=array('id'=>'KB', 'value'=>'KB');
	$size[]=array('id'=>'MB', 'value'=>'MB');
	$size[]=array('id'=>'GB', 'value'=>'GB');
	$size[]=array('id'=>'TB', 'value'=>'TB');
	return $size;
} # getSizeList()

function getSizeValue(&$type) {
	switch ($type) {
		case 'KB':
			return 1024;
		case 'MB':
			return 1048576;
		case 'GB':
			return 1073741824;
		case 'TB':
			return 1099511627776;
	}
} # getSizeValue(&$type)

function getSize(&$ammount, &$type) {
	return $ammount*getSizeValue($type);
} # getSize(&$ammount, &$type)

function getName(&$uid) {
	global $language;
	if ($uid==1)
		return $language['KHEZ_USER_GUEST'];
	if ($uid==0)
		return $language['KHEZ_USER_SYSTEM'];
	global $TABLE_PREFIX;
	$name=get_result('SELECT username FROM `'.$TABLE_PREFIX.'users` WHERE `id`='.$uid.' LIMIT 1;', false, 3600);
	if (isset($name[0]))
		return $name[0]['username'];
	return $language['KHEZ_USER_DELETED'];
} # getName(&$uid)

function getNameX(&$uid, $baseURL) {
	global $language;
	if ($uid==1)
		return $language['KHEZ_USER_GUEST'];
	if ($uid==0)
		return $language['KHEZ_USER_SYSTEM'];
	global $TABLE_PREFIX;
	$name=get_result('SELECT username as name FROM `'.$TABLE_PREFIX.'users` WHERE `id`='.$uid.' LIMIT 1;', false, 3600);
	if (isset($name[0]))
		return '<a href="'.$baseURL.'/index.php?page=userdetails&id='.$uid.'">'.$name[0]['name'].'</a>';
	return $language['KHEZ_USER_DELETED'];
} # getNameX(&$uid, $baseURL)

function getCat(&$id) {
	if ($id!=0) {
		global $TABLE_PREFIX;
		$cat=get_result('SELECT name, image FROM `'.$TABLE_PREFIX.'categories` WHERE `id`='.$id.' LIMIT 1;', false, 3600);
	}
	if (isset($cat[0]))
		return $cat[0];
	return array('name'=>'N/A', 'image'=>'');
} # getCat(&$id)

function getTor(&$hash) {
	global $TABLE_PREFIX, $XBTT_USE;
	if ($XBTT_USE) {
    $seeds='f.seeds+ifnull(x.seeders,0) as seeds';
    $leechers='f.leechers+ifnull(x.leechers,0) as leechers';
    $tables=$TABLE_PREFIX.'files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash';
	}	else {
    $seeds='f.seeds as seeds';
    $leechers='f.leechers as leechers';
    $tables=$TABLE_PREFIX.'files f';
	}
	$tor=get_result('SELECT f.filename, '.$seeds.', '.$leechers.' FROM '.$tables.' WHERE f.info_hash='.sqlesc($hash).' LIMIT 1;', false, 3600);

	if (isset($tor[0]))
		return $tor[0];
	return array('filename'=>'N/A', 'leechers'=>0, 'seeds'=>0);
} # getTor(&$hash)

function getTorX(&$hash, $baseURL) {
	global $TABLE_PREFIX, $XBTT_USE;
	if ($XBTT_USE) {
    $seeds='f.seeds+ifnull(x.seeders,0) as seeds';
    $leechers='f.leechers+ifnull(x.leechers,0) as leechers';
    $tables=$TABLE_PREFIX.'files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash';
	}	else {
    $seeds='f.seeds as seeds';
    $leechers='f.leechers as leechers';
    $tables=$TABLE_PREFIX.'files f';
	}
	$tor=get_result('SELECT f.filename, '.$seeds.', '.$leechers.' FROM '.$tables.' WHERE f.info_hash='.sqlesc($hash).' LIMIT 1;', false, 3600);

	if (isset($tor[0]))
		return '<a href="'.$baseURL.'/index.php?page=details&amp;id='.$hash.'">'.$tor[0]['filename'].' ('.$tor[0]['seeds'].'|'.$tor[0]['leechers'].')</a>';
	return '<b>Deleted Torrent</b>';
} # getTorX(&$hash, $baseURL)

function uplMod($uid, $by, $exact=false) {
	global $TABLE_PREFIX;
	if ($exact && $by<0)
		return false; # set to negative
	if (!$exact && $by==0)
		return false; # modify to same

	quickQuery('UPDATE `'.$TABLE_PREFIX.'users` SET uploaded='.((!$exact)?'uploaded+':'').$by.' WHERE id='.$uid.' LIMIT 1;');
	return true;		
} # uplMod($uid, $by, $exact=false)

function isValidMail(&$email) {
	return eregi('^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*'.
	             '@[a-z0-9-]+(\.[a-z0-9-]{1,})*'.
	             '\.([a-z]{2,}){1}$',$email);
} # isValidMail(&$email)

function sqlSlashIt($string='', $like=false, $crlf=false, $php=false) {
	$string=str_replace('\\', (($like)?'\\\\\\\\':'\\\\'), $string);
	if ($crlf)
		$string=str_replace(array("\n","\r","\t"), array('\n', '\r', 't'), $string);
	return str_replace('\'', (($php)?'\\\'':'\'\''), $string);
} # sqlSlashIt($string='', $like=false, $crlf=false, $php=false)
}
?>