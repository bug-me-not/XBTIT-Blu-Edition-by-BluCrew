<?php
##############################################################################
# KOCS Hack - Backup Tab
#
# Copyright (C) 2008 Khez
#
#    This file is part of the KOCS hack.
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

# direct access
if(!defined("IN_BTIT"))
    die("non direct access!");
if (!defined('IN_ACP'))
	die('non direct access!');

# template
$kocsTabTemplate='admin.kocs.backup.tpl';
# inits
$prefix=(isset($_POST['prefix']))?$_POST['prefix']:$TABLE_PREFIX.(($XBTT_USE)?'|xbt_':'').(($FORUMLINK=='smf')?'|'.$db_prefix:'');

# code
switch ($action) {
	case 'download':
	if ($_POST['confirm']==$language['FRM_CONFIRM']) {
		# backup inits
		$txt=true;
		$deflate=false;
		$die=false;
		$doDownload=false;
		# get compression
		switch ($_POST['compress']) {
			case 3:
			case 2:
			case 1:
				if (function_exists('gzopen')) {
					$open='gzopen';
					$write='gzwrite';
					$close='gzclose';
					$fileSufix='.gz';
					$txt=false;
				}
				break;
			# for future release, offer support for BZIP and ZIP
			case 2:
				if (function_exists('bzopen')) {
					$open='bzopen';
					$write='bzwrite';
					$close='bzclose';
					$fileSufix='.bz2';
					$txt=false;
				}
				break;
			case 1:
				if (function_exists('gzinflate')) {
					$open='gzopen';
					$write='gzwrite';
					$close='gzclose';
					$fileSufix='.zip';
					$deflate=true;
					$txt=false;
				}
				break;
		}
		if ($txt) {
			$fileSufix='';
			$open='fopen';
			$write='fwrite';
			$close='fclose';
		}
		# creat sql file
		$path=realpath(dirname(__FILE__).'/../..').'/cache/kocs_backup.sql';
		if ($file=$open($path, 'w')) {
			# more inits
			$noPrefix=($prefix=='');
			if ($noPrefix) {
				$infoPrefix='NONE';
				$prefixes[]='';
				$prefixType='entire database';
			} else {
				$infoPrefix=$prefix;
				$prefixes=explode('|', $prefix);
				$prefixType='prefix: '.$prefix;
			}
			$comment=isset($_POST['comment']);
			$time=time();
			# determine backup type
			switch($_POST['backupType']){
				case 1:
					$data=true;
					$struct=false;
					$backupType='data';
					break;
				case 2:
					$data=false;
					$struct=true;
					$backupType='structure';
					break;
				case 3:
				default:
					$data=true;
					$struct=true;
					$backupType='full';
			}
			# determine data type
			if ($data) {
				switch ($_POST['dataType']) {
					case 1:
						$insert=true;
						$replace=false;
						$dataType='INSERT';
						break;
					case 2:
					default:
						$insert=false;
						$replace=true;
						$dataType='REPLACE';
				}
			}
			# determine structure type
			if ($struct) {
				switch ($_POST['structureType']) {
					case 2:
						$drop=true;
						$notexist=false;
						$structType='DROP TABLE IF EXISTS';
						break;
					case 3:
						$drop=false;
						$notexist=true;
						$structType='IF NOT EXIST';
						break;
					case 1:
					default:
						$drop=false;
						$notexist=false;
						$structType='NORMAL';
				}
			}
			# embed backup info
			$info='## Khez Tools SQL Dump'."\n".'## version 3.0'."\n".'## '.$BASEURL."\n";
			$info.='## Backup Time '.date('Y/m/d H:i:s', $time)."\n".'## Table Prefixes '.$infoPrefix."\n";
			$info.='## Data '.(($data)?'ON'."\n".'## Data Type '.$dataType:'OFF')."\n";
			$info.='## Structure '.(($struct)?'ON'."\n".'## Structure Type '.$structType:'OFF');
			$write($file, $info);
			# loop prefixes
			foreach ($prefixes as $sqlPrefix) {
				$sqlPrefix=($noPrefix)?'':' LIKE "'.$sqlPrefix.'%"';
				# get tables				
				$tables=do_sqlquery('SHOW TABLES FROM `'.$database.'`'.$sqlPrefix.';');
				$totalTables=sql_num_rows($tables);
				if ($totalTables!=0) {
					$doDownload=true;
					# loop tables
					for ($i=0;$i<$totalTables;$i++) {
						$table=$tables->fetch_row();
						$tableName=$table[0];
						$sql='';
						# do struct
						if ($struct) {
							$table=do_sqlquery('SHOW CREATE TABLE '.$tableName.';');
							$row=$table->fetch_row();
							if ($drop) {
								if ($comment)
									$sql.="\n\n".'##'."\n".'## Drop Table Enabled For `'.$tableName.'`'."\n".'##';
								$sql.="\n\n".'DROP TABLE IF EXISTS `'.$tableName.'`;';
							}
							if ($comment)
								$sql.="\n\n".'##'."\n".'## Table structure for table `'.$tableName.'`'."\n".'##';
							$sql.="\n\n".(($notexist)?'CREATE TABLE IF NOT EXISTS'.substr($row[1],12):$row[1]).';';
							$table->free();
						}
						# do data
						if ($data) {
							# get rows
							$rows=do_sqlquery('SELECT * FROM `'.$tableName.'`;');
							$totalRows=sql_num_rows($rows);
							if ($totalRows !=0) {
								if ($comment)
									$sql.="\n\n".'##'."\n".'## Dumping data for table `'.$tableName.'` ( '.$totalRows.' rows )'."\n".'##';
								$sql.="\n\n".$dataType.' INTO `'.$tableName.'` (';
								# get columns
								$cols=do_sqlquery('SHOW COLUMNS FROM `'.$tableName.'`;');
								$totalCols=sql_num_rows($cols);
								for ($j=1;$j<=$totalCols;$j++) {
									$col=$cols->fetch_row();
									$sql.='`'.$col[0].'`'.(($totalCols==$j)?'':',');
								}
								$cols->free();
								$sql.=') VALUES'."\n";
								# get values
								for ($j=1;$j<=$totalRows;$j++) {
									$row=$rows->fetch_row();
									$sql.='( \''.sqlSlashIt($row[0]).'\'';
									unset($row[0]);
									foreach ($row as $value)
										$sql.=', \''.sqlSlashIt($value).'\'';
									$sql.=' )'.(($totalRows==$j)?';':','."\n");
								}
							}
							$rows->free();
						}
						# write tablq sql
						$write($file, $sql);
					}
				}
			}
		} else $_MSG[]=array('Error', $language['KOCS_FILEPERM']);
		# close file
		$close($file);
		# downlao file
		if ($doDownload) {
			# log it
			if ($kocsfig['kocs_cfg_logs'])
				write_log('[KOCS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> made a '.$backupType.' backup on '.$prefixType.'.', 'add');
			quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kocs_bak_%" LIMIT 2;');
			quickQuery('INSERT INTO `'.$TABLE_PREFIX.'khez_configs` VALUES ("kocs_bak_last", '.$time.'), ("kocs_bak_by", '.$uid.');');
			# push headers
			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Cache-Control: private',false);
			header('Content-Type: '.$ctype);
			header('Content-Disposition: attachment; filename="'.$btit_settings['name'].'.'.date('Ymd_His', $time).'.sql'.$fileSufix.'";' );
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($path));
			# ouput backup
			readfile($path);
			die();
		} else $_MSG[]=array('Warning', $language['KOCS_NOTABLES']);
	}

	case 'read':
	default:
		# send last backup notice if not trying to download
		if ($action!='download') {
			if ($kocsfig['kocs_bak_by']==0)
				$_MSG[]=array('Error', $language['KOCS_BN_NONE']);
			else{
				if ($kocsfig['kocs_bak_last'] < getTime('-1', 'W'))
					$_MSG[]=array('Warning', $language['KOCS_BN_OLD']);
				$_MSG[]=array('Notice', sprintf($language['KOCS_BN_DONE'], date('Y/m/d H:i:s', $kocsfig['kocs_bak_last']), getNameX($kocsfig['kocs_bak_by'], $BASEURL)));
			}
		}
		# supported compression combo opts
		$sc=scList();
		$opts['complete']=true;
		$opts['name']='compress';
		$opts['default']=3;
		# KOCS backup
		$kocs['PREFIX']=$prefix;
		$kocs['COMPRESS']=get_combo($sc, $opts);
}
?>