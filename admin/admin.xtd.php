<?php
/////////////////////////////////////////////////////////////////////////////////////
// XTD Hack - Admin Settings Page
//
// Copyright (C) 2008  Khez
//
//    This file is part of the eXtended Torrent Description hack.
//
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

if (!defined('IN_ACP'))
  die('non direct access!');



if ( !isset($language['KHEZ_UNINSTALL_DB']) )
	require(load_language('lang_khez.php'));
require(load_language('lang_xtd.php'));
$xtd_db=do_sqlquery('SELECT COUNT(*) as db FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "xtd_%" LIMIT 1;');
$xtd_db=$xtd_db->fetch_row();
$xtd_db=$xtd_db[0];

/*
$hack_info=do_sqlquery("SELECT id FROM `{$TABLE_PREFIX}hacks` WHERE `title` = 'fmhack_extended_torrent_description' LIMIT 1;");
$hack_info=$hack_info->fetch_assoc();

$xtd['URL']='<a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=hacks&amp;action=uninstall&amp;id='.$hack_info['id'].'">'.$language['KHEZ_UNINSTALL_DB'].'</a>';
*/

$config=false;
if ($xtd_db) {
  switch ($action) {
    case 'write':
      if ($_POST['confirm']==$language['FRM_CONFIRM']) {
        $config=true;
        $enabled=(isset($_POST['enabled']))?'true':'false';
				$case=(isset($_POST['case']))?'true':'false';
        $img=abs((int)$_POST['img']);
        $url=abs((int)$_POST['url']);
        $chars=abs((int)$_POST['chars']);
				$loc=abs((int)$_POST['loc']);
        $file=sqlesc($_POST['file']);
        quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "xtd_%" LIMIT 7;', true);
        quickQuery('INSERT INTO `'.$TABLE_PREFIX.'khez_configs` VALUES ("xtd_enabled", "'.$enabled.'"), ("xtd_img", '.$img.'), ("xtd_url", '.$url.'), ("xtd_chars", '.$chars.'), ("xtd_file", '.$file.'), ("xtd_casesens", '.$case.'), ("xtd_loc", '.$loc.');', true);
      }
/*
      elseif ($_POST['confirm']==$language['HACK_UNINSTALL']) {
        quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "xtd_%";', true);
        $xtd_db=false;
        break;
      }
*/
    case 'read':
    case '':
    default:
      $xtdfig_db=get_khez_config('SELECT `key`,`value` FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "xtd_%" LIMIT 7;', 0);
			# init vars
			$pick=$xtdfig_db['xtd_loc'];
			# search type combo
			$combo='<select name="loc">';
			$combo.="\n".'<option value="0"'.($pick==0?' selected="selected" ':'').'>'.$language['XTD_EXACT'].'</option>';
			$combo.="\n".'<option value="1"'.($pick==1?' selected="selected" ':'').'>'.$language['XTD_BEGIN'].'</option>';
			$combo.="\n".'<option value="2"'.($pick==2?' selected="selected" ':'').'>'.$language['XTD_END'].'</option>';
			$combo.="\n".'<option value="2"'.(!in_array($pick, array(0,1,2))?' selected="selected" ':'').'>'.$language['XTD_ANYWHERE'].'</option>';
			$combo.='</select>';
      # xtd configs
      $xtd['ENABLED']=($xtdfig_db['xtd_enabled'])?'checked="checked"':'';
      $xtd['CASE']=($xtdfig_db['xtd_casesens'])?'checked="checked"':'';
      $xtd['IMG']=$xtdfig_db['xtd_img'];
      $xtd['URL']=$xtdfig_db['xtd_url'];
      $xtd['CHARS']=$xtdfig_db['xtd_chars'];
      $xtd['FILE']=$xtdfig_db['xtd_file'];
			$xtd['LOC']=$combo;
  } # switch
} # if db

$admintpl->set('frm_action','index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=xtd&amp;action=write');
$admintpl->set('language',$language);
$admintpl->set('xtd',$xtd);
$admintpl->set('nodb',!$xtd_db,true);
$admintpl->set('config',$config,true);
?>
