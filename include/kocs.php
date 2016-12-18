<?php
##############################################################################
# KOCS Hack - CrossHack Functions
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

function scList() {
	global $language;
	$sc=array();
	$sc[]=array('id'=>'0', 'value'=>$language['KOCS_PAK_TEXT']);
#	if (@function_exists('gzinflate'))
#		$sc[]=array('id'=>'1', 'value'=>$language['KOCS_PAK_ZIP']);
#	if (@function_exists('bzopen'))
#		$sc[]=array('id'=>'2', 'value'=>$language['KOCS_PAK_BZIP']);
	if (@function_exists('gzopen'))
		$sc[]=array('id'=>'3', 'value'=>$language['KOCS_PAK_GZIP']);
	return $sc;
} # scList()

function getFC($filepath) {
	$file=@fopen($filepath,'rb');
	if (!$file)
		return false;
	$test=fread($file,4);
	$len=strlen($test);
	fclose($file);
	if ($len>=2&&$test[0]==chr(31)&&$test[1]==chr(139))
		return 'application/gzip';
	if ($len>=3&&substr($test,0,3)=='BZh')
		return 'application/bzip2';
	if ($len>=4&&$test=='PK\003\004')
		return 'application/zip';
	return 'none';
} # getFC($filepath)
?>