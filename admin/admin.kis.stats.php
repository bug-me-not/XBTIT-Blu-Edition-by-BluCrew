<?php
##############################################################################
# KIS Hack - ACP Stats Tab
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

# direct access
if(!defined("IN_BTIT"))
    die("non direct access!");
if (!defined('IN_ACP'))
	die('non direct access!');
# template
$kisTabTemplate='admin.kis.stats.tpl';
# cache results if we don't force
$cache=($_GET['force']==1)?1:$CACHE_DURATION;
# inits
$result=get_result('SELECT COUNT(*) as total FROM '.$TABLE_PREFIX.'users;',false,$cache);
$members=$result[0]['total']-1; # remove guest account
$result=get_result('SELECT COUNT(*) as total FROM '.$TABLE_PREFIX.'kis_sent WHERE used=0;', $cache);
$pending=$result[0]['total'];
$result=get_result('SELECT SUM(joined) as regged, SUM(invites) as unused, SUM(IF(invites,0,1)) as caninvite FROM '.$TABLE_PREFIX.'kis_users;', $cache);
$regged=$result[0]['regged'];
$unused=$result[0]['unused'];
$caninvite=$result[0]['caninvite'];
# vars
$kis['PENDING']=$pending;
$kis['REGISTERED']=$regged;
$kis['MEMBERS']=$members;
$kis['RATIO']=($members==0)?0:number_format(($regged/$members)*100,0);
$kis['UNUSED']=$unused;
$kis['NOINVITES']=$members-$caninvite;
?>