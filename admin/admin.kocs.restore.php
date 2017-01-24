<?php
##############################################################################
# KOCS Hack - Restore Tab
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
$kocsTabTemplate='admin.kocs.restore.tpl';

# code
switch ($action) {
	case 'restore':
		# move file to cache
		$file=realpath(dirname(__FILE__).'/../..').'/cache/kocs_restore.sql';
		if (move_uploaded_file($_FILES['restore']['tmp_name'], $file)) {
			# get compression info
			$fc=getFC($file);
			# get decompression info
			switch($fc) {
				# gzip
				case 'application/gzip':
					# server supported ?
					if (@function_exists('gzopen')) {
						$open='gzopen';
						$close='gzclose';
						$get='gzgets';
						$eof='gzeof';
					} else $_MSG[]=array('Error', sprintf($language['KOCS_BADCOMP'], $language['KOCS_PAK_GZIP']));
					break;
				# bzip
				case 'application/bzip2':
					# server supported ?
					if (@function_exists('bzopen')) {
						$_MSG[]=array('Error', sprintf($language['KOCS_NOTDONE'], $language['KOCS_PAK_BZIP']));					
						$error=true;
					} else $_MSG[]=array('Error', sprintf($language['KOCS_BADCOMP'], $language['KOCS_PAK_BZIP']));
					break;
				# zip
				case 'application/zip':
					# server supported ? 
					if (@function_exists('gzinflate')) {
						$_MSG[]=array('Error', sprintf($language['KOCS_NOTDONE'], $language['KOCS_PAK_ZIP']));
						$error=true;
					} else $_MSG[]=array('Error', sprintf($language['KOCS_BADCOMP'], $language['KOCS_PAK_ZIP']));
					break;
				# text mode
				case 'none':
					$open='fopen';
					$close='fclose';
					$get='fgets';
					$eof='feof';
					break;
				# should never get here
				default:
					$_MSG[]=array('Error', 'Unable to open uploaded file.');
					$error=true;
			}
			# decompression init error ?
			if (!isset($error)) {
				if ($fh=@$open($file, 'r')) {
					# restore inits
					$line=0;
					$sql='';
					$querys=0;
					$errors=0;
					$comments=0;
					$sqlerrors=array();
					# should get dump data from file and save it
					# loop file
					while (!$eof($fh)) {
						# get line, update line number
						$buffer=$get($fh, 4096);
						$line++;
						# test line is comment
						if ($buffer[0]=='#')
							$comments++;
						else {
							$sql.=$buffer;
							# current sql completely read
							if ($buffer[strlen($buffer)-2]==';') {
								# do the query and update query number
								quickQuery($sql);
								$querys++;
								# check for errors
								if (sql_errno()!=0) {
									$errors++;
									$sqlerrors[]=sql_error();
								}
								# clear current sql
								$sql='';
							}
						}
					}
					# close file
					$close($fh);
					# log it
					if ($kocsfig['kocs_cfg_logs'])
						write_log('[KOCS] <a href="'.$BASEURL.'/index.php?page=userdetails&id='.$uid.'">'.$uname.'</a> made a restore with '.$errors.' errors.', 'add');
					quickQuery('DELETE FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kocs_res_%" LIMIT 3;');
					quickQuery('INSERT INTO `'.$TABLE_PREFIX.'khez_configs` VALUES ("kocs_res_last", UNIX_TIMESTAMP()), ("kocs_res_by", '.$uid.'), ("kocs_res_errors", '.$errors.');');
					# add some restore responses
					$_MSG[]=array('Notice', 'Lines: '.$line);
					$_MSG[]=array('Notice', 'Comments: '.$comments);
					if ($querys==0)
						$_MSG[]=array('Error', 'No querys found in the file.');
					else
						$_MSG[]=array('Notice', 'Restoring from file had '.$querys.' querys.');
					if ($errors==0)
						$_MSG[]=array('Success', 'Restoring from file had no errors.');
					else {
						$level=($errors < 10)?'Warning':'Error';
						$_MSG[]=array($level, 'Restoring from file had '.$errors.' errors.');
						foreach ($sqlerrors as $error)
							$_MSG[]=array('DBError', $error);
					}
				} else $_MSG[]=array('Error', $language['KOCS_FILEPERM']);
			}
		} else $_MSG[]=array('Error', $language['KOCS_UPLOAD']);
	default:
		# send last backup notice if not trying to download
		if ($action!='restore') {
			if ($kocsfig['kocs_res_by']==0)
				$_MSG[]=array('Success', $language['KOCS_RN_NONE']);
			else{
				if ($kocsfig['kocs_res_last'] < getTime('-1', 'm'))
					$_MSG[]=array('Notice', $language['KOCS_RN_OLD']);
				$_MSG[]=array('Error', sprintf($language['KOCS_RN_DONE'], date('Y/m/d H:i:s', $kocsfig['kocs_res_last']), getNameX($kocsfig['kocs_res_by'], $BASEURL), $kocsfig['kocs_res_errors']));
			}
		}
}
?>