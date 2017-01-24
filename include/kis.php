<?php
##############################################################################
# KIS Hack - Functions
#
# Copyright (C) 2008 Khez
#
#    This file is part of the KIS hack.
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
global $_KIS;
if (!isset($_KIS)) {
	$_KIS=true;

function kisUserInfo(&$uid) {
	global $TABLE_PREFIX;
	$user=get_result('SELECT invites, joined FROM '.$TABLE_PREFIX.'kis_users WHERE uid='.$uid.' LIMIT 1;');
	if (isset($user[0]))
		return $user[0];

	$user['invites']=0;
	$user['joined']=0;
	quickQuery('INSERT INTO '.$TABLE_PREFIX.'kis_users VALUES ('.$uid.', 0, 0);');
	return $user;
} # getInviteInfo(&$uid)

function kisMod($uid, $by, $exact=false) {
	global $TABLE_PREFIX;
	if ($exact && $by<0)
		return false; # set to negative
	if (!$exact && $by==0)
		return false; # modify to same

	quickQuery('INSERT INTO `'.$TABLE_PREFIX.'kis_users` VALUES ('.$uid.', '.$by.', 0) ON DUPLICATE KEY UPDATE invites='.((!$exact)?'invites+':'').$by.';');
	return true;		
} # kisMod($uid, $by, $exact=false)

function kisJoined(&$newuid, &$token, &$uid) {
	global $TABLE_PREFIX;
	quickQuery('UPDATE '.$TABLE_PREFIX.'kis_sent SET used='.$newuid.' WHERE token='.$token.' LIMIT 1;');
	quickQuery('UPDATE '.$TABLE_PREFIX.'kis_users SET joined=joined+1 WHERE uid='.$uid.' LIMIT 1;');
} # kisJoined(&$newuid, &$token, &$uid)
}
?>