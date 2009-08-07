<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2009 iDB Support - http://idb.berlios.de/
    Copyright 2004-2009 Game Maker 2k - http://gamemaker2k.org/

    $FileInfo: filename.php - Last Update: 6/16/2009 SVN 264 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="filename.php"||$File3Name=="/filename.php") {
	require('index.php');
	exit(); }
// Check and set stuff
if(dirname($_SERVER['SCRIPT_NAME'])!=".") {
$basedir = dirname($_SERVER['SCRIPT_NAME'])."/"; }
if(dirname($_SERVER['SCRIPT_NAME'])==".") {
$basedir = dirname($_SERVER['PHP_SELF'])."/"; }
if($basedir=="\/") { $basedir="/"; }
$basedir = str_replace("//", "/", $basedir);
$cbasedir = $basedir;
if($Settings['fixbasedir']!=null&&$Settings['fixbasedir']!="off") {
		$basedir = $Settings['fixbasedir']; }
if($Settings['fixcookiedir']!=null&&$Settings['fixcookiedir']!="") {
		$cbasedir = $Settings['fixcookiedir']; }
$BaseURL = $basedir;
if(!isset($_SERVER['HTTPS'])) { $_SERVER['HTTPS'] = 'off'; }
if($_SERVER['HTTPS']=="on") { $prehost = "https://"; }
if($_SERVER['HTTPS']!="on") { $prehost = "http://"; }
if($Settings['idburl']=="localhost"||$Settings['idburl']==null) {
	$rssurl = $prehost.$_SERVER["HTTP_HOST"].$BaseURL; }
if($Settings['idburl']!="localhost"&&$Settings['idburl']!=null) {
	$rssurlon = "on"; $rssurl = $Settings['idburl']; }
if($Settings['rssurl']!=null&&$Settings['rssurl']!="") {
	$rssurlon = "on"; $rssurl = $Settings['rssurl']; }
/* In php 6 and up the function get_magic_quotes_gpc dose not exist. 
   here we make a fake version that always sends false out. :P */
if(!function_exists('get_magic_quotes_gpc')) {
function get_magic_quotes_gpc() { return false; } }
require_once($SettDir['inc'].'versioninfo.php');
//File naming stuff. <_< 
$exfile = array(); $exfilerss = array();
$exqstr = array(); $exqstrrss = array();
$exfile['calendar'] = 'calendar';
$prexqstr['calendar'] = null; $exqstr['calendar'] = "board=".$_GET['board'];
$exfile['category'] = 'category';
$prexqstr['category'] = null; $exqstr['category'] = "board=".$_GET['board'];
$exfile['event'] = 'event';
$prexqstr['event'] = null; $exqstr['event'] = "board=".$_GET['board'];
$exfile['forum'] = 'forum';
$prexqstr['forum'] = null; $exqstr['forum'] = "board=".$_GET['board'];
$exfile['index'] = 'index';
$prexqstr['index'] = null; $exqstr['index'] = "board=".$_GET['board'];
$exfile['member'] = 'member';
$prexqstr['member'] = null; $exqstr['member'] = "board=".$_GET['board'];
$exfile['messenger'] = 'messenger';
$prexqstr['messenger'] = null; $exqstr['messenger'] = "board=".$_GET['board'];
$exfile['profile'] = 'profile';
$prexqstr['profile'] = null; $exqstr['profile'] = "board=".$_GET['board'];
$exfile['rss'] = 'rss';
$prexqstr['rss'] = null; $exqstr['rss'] = "board=".$_GET['board'];
$exfile['search'] = 'search';
$prexqstr['search'] = null; $exqstr['search'] = "board=".$_GET['board'];
$exfile['subforum'] = 'subforum';
$prexqstr['subforum'] = null; $exqstr['subforum'] = "board=".$_GET['board'];
$exfile['subcategory'] = 'subcategory';
$prexqstr['subcategory'] = null; $exqstr['subcategory'] = "board=".$_GET['board'];
$exfile['topic'] = 'topic';
$prexqstr['topic'] = null; $exqstr['topic'] = "board=".$_GET['board'];
$exfile['redirect'] = 'forum';
$prexqstr['redirect'] = null; $exqstr['redirect'] = "board=".$_GET['board'];
$exfile['admin'] = 'admin';
$prexqstr['admin'] = null; $exqstr['admin'] = "board=".$_GET['board'];
$exfile['modcp'] = 'modcp';
$prexqstr['modcp'] = null; $exqstr['modcp'] = "board=".$_GET['board'];
$exfilejs['javascript'] = 'javascript';
$prexqstrjs['javascript'] = null; $exqstrjs['javascript'] = null;
$exfilerss['forum'] = 'forum'; 
$prexqstrrss['forum'] = null; $exqstrrss['forum'] = "board=".$_GET['board'];
$exfilerss['subforum'] = "subforum";
$prexqstrrss['subforum'] = null; $exqstrrss['subforum'] = "board=".$_GET['board'];
$exfilerss['subcategory'] = "subcategory";
$prexqstrrss['subcategory'] = null; $exqstrrss['subcategory'] = "board=".$_GET['board'];
$exfilerss['redirect'] = 'forum';
$prexqstrrss['redirect'] = null; $exqstrrss['redirect'] = "board=".$_GET['board'];
$exfilerss['topic'] = "topic";
$prexqstrrss['topic'] = null; $exqstrrss['topic'] = "board=".$_GET['board'];
$exfilerss['category'] = 'category';
$prexqstrrss['category'] = null; $exqstrrss['category'] = "board=".$_GET['board'];
$exfilerss['event'] = 'event';
$prexqstrrss['event'] = null; $exqstrrss['event'] = "board=".$_GET['board'];
?>