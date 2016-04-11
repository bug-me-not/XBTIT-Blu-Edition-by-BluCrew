<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license Modified MIT License
 * @link https://blueimp.net/ajax/
 */

// List containing the registered chat users:
$users = array();

// Default guest user (don't delete this one):
$users[0] = array();
$users[0]['userRole'] = AJAX_CHAT_GUEST;
$users[0]['userName'] = 'guest';
$users[0]['password'] = 'lajhdlkjsbflkjasbf';
$users[0]['channels'] = array(0);

// Sample admin user:
$users[1] = array();
$users[1]['userRole'] = AJAX_CHAT_ADMIN;
$users[1]['userName'] = 'admin';
$users[1]['password'] = 'kjsadkjflbasdfkjbas';
$users[1]['channels'] = array(1,2,3,4,5,6);

// Sample moderator user:
$users[2] = array();
$users[2]['userRole'] = AJAX_CHAT_MODERATOR;
$users[2]['userName'] = 'moderator';
$users[2]['password'] = ';askdnfkjdns;fjksf';
$users[2]['channels'] = array(1,2,3,4,5,6);

$users[3] = array();
$users[3]['userRole'] = AJAX_CHAT_BLURG;
$users[3]['userName'] = 'blurg';
$users[3]['password'] = 'kljasfkjsdhfakh';
$users[3]['channels'] = array(1,2,3,4,5);

$users[4] = array();
$users[4]['userRole'] = AJAX_CHAT_TRUSTEE;
$users[4]['userName'] = 'trustee';
$users[4]['password'] = 'l;aksjhflkjsadfh';
$users[4]['channels'] = array(1,2,3,4);

$users[5] = array();
$users[5]['userRole'] = AJAX_CHAT_VIP;
$users[5]['userName'] = 'vip';
$users[5]['password'] = 'aksshfkjsdahfjkhsf';
$users[5]['channels'] = array(1,2,3,4);

$users[6] = array();
$users[6]['userRole'] = AJAX_CHAT_UPLOADER;
$users[6]['userName'] = 'uploader';
$users[6]['password'] = 'lkjsafkjasfaksjdbf';
$users[6]['channels'] = array(1,2,3);

$users[7] = array();
$users[7]['userRole'] = AJAX_CHAT_BLUGOD;
$users[7]['userName'] = 'blugod';
$users[7]['password'] = 'lkjahsdfjkkjasfaksjdbf';
$users[7]['channels'] = array(1,2,3);

$users[8] = array();
$users[8]['userRole'] = AJAX_CHAT_BLUJUNKIE;
$users[8]['userName'] = 'blujunkie';
$users[8]['password'] = 'kjahsfkljhsdsfaksjdbf';
$users[8]['channels'] = array(1,2,3);

$users[9] = array();
$users[9]['userRole'] = AJAX_CHAT_BLUADDICT;
$users[9]['userName'] = 'bluaddict';
$users[9]['password'] = 'kljahsfkjlsfsfaksjdbf';
$users[9]['channels'] = array(1,2,3);

$users[10] = array();
$users[10]['userRole'] = AJAX_CHAT_BLUMASTER;
$users[10]['userName'] = 'blumaster';
$users[10]['password'] = 'kjashfjkashfsfaksjdbf';
$users[10]['channels'] = array(1,2,3);

$users[11] = array();
$users[11]['userRole'] = AJAX_CHAT_BLUWARRIOR;
$users[11]['userName'] = 'bluwarrior';
$users[11]['password'] = 'lkjashfkjsahdffaksjdbf';
$users[11]['channels'] = array(1,2,3);

$users[12] = array();
$users[12]['userRole'] = AJAX_CHAT_BLUUSER;
$users[12]['userName'] = 'bluuser';
$users[12]['password'] = 'kljashdfkjdshffaksjdbf';
$users[12]['channels'] = array(1,2,3);

$users[13] = array();
$users[13]['userRole'] = AJAX_CHAT_RECRUIT;
$users[13]['userName'] = 'recruit';
$users[13]['password'] = 'kjshfkaljhfaksjdbf';
$users[13]['channels'] = array(1,2,3);

$users[14] = array();
$users[14]['userRole'] = AJAX_CHAT_LEECHER;
$users[14]['userName'] = 'leecher';
$users[14]['password'] = 'klashfjkshfljkahsdjksfaksjdbf';
$users[14]['channels'] = array(1,2,3);

$users[15] = array();
$users[15]['userRole'] = AJAX_CHAT_SUPERLEECH;
$users[15]['userName'] = 'superleech';
$users[15]['password'] = 'klajsdhfkjlsdhfjklhasdaksjdbf';
$users[15]['channels'] = array(1,2,3);

// Sample registered user:
$users[16] = array();
$users[16]['userRole'] = AJAX_CHAT_USER;
$users[16]['userName'] = 'user';
$users[16]['password'] = 'jlasbfjksdbfjksdfb';
$users[16]['channels'] = array(1,2,3);

?>
