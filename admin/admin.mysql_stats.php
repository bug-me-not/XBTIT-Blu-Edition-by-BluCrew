<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
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

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");



/* $Id: mysql_stats.php,v 1.0 2005/06/20 22:52:24 CoLdFuSiOn Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

ob_start();

$GLOBALS["byteUnits"] = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';
$timespanfmt = '%s days, %s hours, %s minutes and %s seconds';
////////////////// FUNCTION LIST /////////////////////////
    /**
     * Formats $value to byte view
     *
     * @param    double   the value to format
     * @param    integer  the sensitiveness
     * @param    integer  the number of decimals to retain
     *
     * @return   array    the formatted value and its unit
     *
     * @access  public
     *
     * @author   staybyte
     * @version  1.0 - 20 July 2005
     */
    function formatByteDown($value, $limes = 6, $comma = 0)
    {
        $dh           = pow(10, $comma);
        $li           = pow(10, $limes);
        $return_value = $value;
        $unit         = $GLOBALS['byteUnits'][0];

        for ( $d = 6, $ex = 15; $d >= 1; $d--, $ex-=3 ) {
            if (isset($GLOBALS['byteUnits'][$d]) && $value >= $li * pow(10, $ex)) {
                $value = round($value / ( pow(1024, $d) / $dh) ) /$dh;
                $unit = $GLOBALS['byteUnits'][$d];
                break 1;
            } // end if
        } // end for

        if ($unit != $GLOBALS['byteUnits'][0]) {
            $return_value = number_format($value, $comma, '.', ',');
        } else {
            $return_value = number_format($value, 0, '.', ',');
        }

        return array($return_value, $unit);
    } // end of the 'formatByteDown' function

    /**
     * Returns a given timespan value in a readable format.
     *
     * @param  int     the timespan
     *
     * @return string  the formatted value
     */
    function timespanFormat($seconds)
    {
        $return_string = '';
        $days = floor($seconds / 86400);
        if ($days > 0) {
            $seconds -= $days * 86400;
        }
        $hours = floor($seconds / 3600);
        if ($days > 0 || $hours > 0) {
            $seconds -= $hours * 3600;
        }
        $minutes = floor($seconds / 60);
        if ($days > 0 || $hours > 0 || $minutes > 0) {
            $seconds -= $minutes * 60;
        }
        return (string)$days." Days ". (string)$hours." Hours ". (string)$minutes." Minutes ". (string)$seconds." Seconds ";
    }


   /**
     * Writes localised date
     *
     * @param   string   the current timestamp
     *
     * @return  string   the formatted date
     *
     * @access  public
     */
    function localisedDate($timestamp = -1, $format = '')
    {
        global $datefmt, $month, $day_of_week;

        if ($format == '') {
            $format = $datefmt;
        }

        if ($timestamp == -1) {
            $timestamp = time();
        }

        $date = preg_replace('@%[aA]@', $day_of_week[(int)strftime('%w', $timestamp)], $format);
        $date = preg_replace('@%[bB]@', $month[(int)strftime('%m', $timestamp)-1], $date);

        return strftime($date, $timestamp);
    } // end of the 'localisedDate()' function

////////////////////// END FUNCTION LIST /////////////////////////////////////



/**
 * Sends the query and buffers the result
 */
$res = @do_sqlquery('SHOW STATUS') or Die(sql_error());
    while ($row = $res->fetch_row()) {
        $serverStatus[$row[0]] = $row[1];
    }
@$res->free();
unset($res);
unset($row);


/**
 * Displays the page
 */
//Uptime calculation
$res = @do_sqlquery('SELECT UNIX_TIMESTAMP() - ' . $serverStatus['Uptime']);
$row = $res->fetch_row();
//echo sprintf("Server Status Uptime", timespanFormat($serverStatus['Uptime']), localisedDate($row[0])) . "\n";
?>
<table align="center" width="99%" class="lista" border="1" cellpadding="2" cellspacing="1">
<tr><td class="blocklist" align="center" width="100%">
    <table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
      <tr>
        <td style="padding-left:40px;"><b>
<?php
print("\tThis MySQL server has been running for ". timespanFormat($serverStatus['Uptime']) .". It started up on ". localisedDate($row[0])) . "\n";
?>
        </b></td>
      </tr>
    </table>

<?php

$res->free();
unset($res);
unset($row);
//Get query statistics
$queryStats = array();
$tmp_array = $serverStatus;
    foreach($tmp_array AS $name => $value) {
        if (substr($name, 0, 4) == 'Com_') {
            $queryStats[str_replace('_', ' ', substr($name, 4))] = $value;
            unset($serverStatus[$name]);
        }
    }
unset($tmp_array);
?>
<table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
      <tr>
        <td>
<div align="left">
<ul>
    <li>
        <!-- Server Traffic -->
        <b>Server traffic:</b> These tables show the network traffic statistics of this MySQL server since its startup</li></ul>
                </div>

        </td>
      </tr>
    </table>
        <table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
            <tr>
                <td valign="top">
                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td colspan="2" class="header" align="center">&nbsp;Traffic&nbsp;</td>
                            <td class="header">&nbsp;&nbsp;Per Hour&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista">&nbsp;Received&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo join(' ', formatByteDown($serverStatus['Bytes_received'])); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo join(' ', formatByteDown($serverStatus['Bytes_received'] * 3600 / $serverStatus['Uptime'])); ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista" >&nbsp;Sent&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo join(' ', formatByteDown($serverStatus['Bytes_sent'])); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo join(' ', formatByteDown($serverStatus['Bytes_sent'] * 3600 / $serverStatus['Uptime'])); ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista">&nbsp;Total&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo join(' ', formatByteDown($serverStatus['Bytes_received'] + $serverStatus['Bytes_sent'])); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo join(' ', formatByteDown(($serverStatus['Bytes_received'] + $serverStatus['Bytes_sent']) * 3600 / $serverStatus['Uptime'])); ?>&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td valign="top">
                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td colspan="2" class="header">&nbsp;Connections&nbsp;</td>
                            <td class="header">&nbsp;&oslash;&nbsp;Per Hour&nbsp;</td>
                            <td class="header">&nbsp;%&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista">&nbsp;Failed Attempts&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format($serverStatus['Aborted_connects'], 0, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($serverStatus['Aborted_connects'] * 3600 / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo ($serverStatus['Connections'] > 0 ) ? number_format(($serverStatus['Aborted_connects'] * 100 / $serverStatus['Connections']), 2, '.', ',') . '&nbsp;%' : '---'; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista">&nbsp;Aborted Clients&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format($serverStatus['Aborted_clients'], 0, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($serverStatus['Aborted_clients'] * 3600 / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo ($serverStatus['Connections'] > 0 ) ? number_format(($serverStatus['Aborted_clients'] * 100 / $serverStatus['Connections']), 2 , '.', ',') . '&nbsp;%' : '---'; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista">&nbsp;Total&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format($serverStatus['Connections'], 0, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($serverStatus['Connections'] * 3600 / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(100, 2, '.', ','); ?>&nbsp;%&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
      <tr>
        <td>
<div align="left">
<ul>
    <li>
        <!-- Queries -->
        <?php print("<b>Query Statistics:</b> Since its start up ". number_format($serverStatus['Questions'], 0, '.', ',')." queries have been sent to the server.\n"); ?></li></ul>
                </div>

        </td>
      </tr>
    </table>
        <table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
            <tr>
                <td colspan="2">

                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td class="header">&nbsp;Total&nbsp;</td>
                            <td class="header">&nbsp;&oslash;&nbsp;Per&nbsp;Hour&nbsp;</td>
                            <td class="header">&nbsp;&oslash;&nbsp;Per&nbsp;Minute&nbsp;</td>
                            <td class="header">&nbsp;&oslash;&nbsp;Per&nbsp;Second&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="lista" align="right">&nbsp;<?php echo number_format($serverStatus['Questions'], 0, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($serverStatus['Questions'] * 3600 / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($serverStatus['Questions'] * 60 / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($serverStatus['Questions'] / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td class="header" colspan="2">&nbsp;Query&nbsp;Type&nbsp;</td>
                            <td class="header">&nbsp;&oslash;&nbsp;Per&nbsp;Hour&nbsp;</td>
                            <td class="header">&nbsp;%&nbsp;</td>
                        </tr>
<?php

$useBgcolorOne = TRUE;
$countRows = 0;
foreach ($queryStats as $name => $value) {

// For the percentage column, use Questions - Connections, because
// the number of connections is not an item of the Query types
// but is included in Questions. Then the total of the percentages is 100.
?>
                        <tr>
                            <td class="lista">&nbsp;<?php echo htmlspecialchars($name); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format($value, 0, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($value * 3600 / $serverStatus['Uptime']), 2, '.', ','); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo number_format(($value * 100 / ($serverStatus['Questions'] - $serverStatus['Connections'])), 2, '.', ','); ?>&nbsp;%&nbsp;</td>
                        </tr>
<?php
    $useBgcolorOne = !$useBgcolorOne;
    if (++$countRows == ceil(count($queryStats) / 2)) {
        $useBgcolorOne = TRUE;
?>
                    </table>
                </td>
                <td valign="top">
                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td colspan="2" class="header" >&nbsp;Query&nbsp;Type&nbsp;</td>
                            <td class="header">&nbsp;&oslash;&nbsp;Per&nbsp;Hour&nbsp;</td>
                            <td class="header">&nbsp;%&nbsp;</td>
                        </tr>
<?php
    }
}
unset($countRows);
unset($useBgcolorOne);
?>
                    </table>
                </td>
            </tr>
        </table>
    </li>
<?php
//Unset used variables
unset($serverStatus['Aborted_clients']);
unset($serverStatus['Aborted_connects']);
unset($serverStatus['Bytes_received']);
unset($serverStatus['Bytes_sent']);
unset($serverStatus['Connections']);
unset($serverStatus['Questions']);
unset($serverStatus['Uptime']);

if (!empty($serverStatus)) {
?>
    <table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
      <tr>
        <td>
<div align="left">
<ul>
    <li>
        <!-- Other status variables -->
        <b>More status variables</b></li></ul>
                </div>

        </td>
      </tr>
    </table>
        <table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
            <tr>
                <td colspan="2">

                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td class="header">&nbsp;Variable&nbsp;</td>
                            <td class="header">&nbsp;Value&nbsp;</td>
                        </tr>
<?php
    $useBgcolorOne = TRUE;
    $countRows = 0;
    foreach($serverStatus AS $name => $value) {
?>
                        <tr>
                            <td class="lista">&nbsp;<?php echo htmlspecialchars(str_replace('_', ' ', $name)); ?>&nbsp;</td>
                            <td class="lista" align="right">&nbsp;<?php echo htmlspecialchars($value); ?>&nbsp;</td>
                        </tr>
<?php
        $useBgcolorOne = !$useBgcolorOne;
        if (++$countRows == ceil(count($serverStatus) / 3) || $countRows == ceil(count($serverStatus) * 2 / 3)) {
            $useBgcolorOne = TRUE;
?>
                    </table>
                </td>
                <td valign="top">
                    <table border="0" class="lista" align="center" width="100%">
                        <tr>
                            <td class="header">&nbsp;Variable&nbsp;</td>
                            <td class="header">&nbsp;Value&nbsp;</td>
                        </tr>
<?php
        }
    }
    unset($useBgcolorOne);
?>
                    </table>
                </td>
            </tr>
        </table>

<?php
}

?>
<table align="center" width="96%" class="lista" border="0" cellpadding="4" cellspacing="1">
      <tr>
        <td>
<div align="left">
<ul>
    <li>The code for MySQL server status is kindly provided by CoLdFuSiOn (Tbdev.net)</li></ul>
                </div>
            <div align="right">
<ul><a href="#">Back to Top</a></div>
        </td>
      </tr>
    </table></td>
      </tr>
    </table>
<?php

$content=ob_get_contents();
ob_end_clean();

?>
