<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2007 Cool Dude 2k - http://intdb.sourceforge.net/
    Copyright 2004-2007 Game Maker 2k - http://upload.idb.s1.jcink.com/

    $FileInfo: mysql.php - Last Update: 06/18/2007 SVN 26 - Author: cooldude2k $
*/
@error_reporting(E_ALL ^ E_NOTICE);
@ini_set('session.use_trans_sid', false);
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="mysql.php"||$File3Name=="/mysql.php") {
	@header('Location: index.php');
	exit(); }
if(@ini_get("register_globals")) { $PreDir['misc'] = "inc/misc/";
	require_once($PreDir['misc'].'killglobals.php'); unset($PreDir); }
require_once('settings.php');
@ini_set("error_prepend_string","<span style='color: ff0000;'>");
@ini_set("error_append_string","</span>");
if($Settings['fixpathinfo']==true) {
	$_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
	@putenv("PATH_INFO=".$_SERVER['ORIG_PATH_INFO']); }
if(!isset($SettDir['inc'])) { $SettDir['inc'] = "inc/"; }
if(!isset($SettDir['misc'])) { $SettDir['misc'] = "inc/misc/"; }
if(!isset($SettDir['admin'])) { $SettDir['admin'] = "inc/admin/"; }
if(!isset($SettDir['mod'])) { $SettDir['mod'] = "inc/mod/"; }
if(!isset($SettDir['themes'])) { $SettDir['themes'] = "themes/"; }
if(!isset($Settings['use_iniset'])) { $Settings['use_iniset'] = null; }
if(!isset($_SERVER['PATH_INFO'])) { $_SERVER['PATH_INFO'] = null; }
if(!isset($_GET['page'])) { $_GET['page'] = null; }
if(!isset($_GET['act'])) { $_GET['act'] = null; }
if(!isset($_POST['act'])) { $_POST['act'] = null; }
if(!isset($_GET['id'])) { $_GET['id'] = null; }
$_TEG = array(null);
$_TEG['part'] = preg_replace("/Part(1|2|3|4)/","\\1",$_GET['act']);
$_GET['act'] = strtolower($_GET['act']);
if(isset($_TEG['part'])) {
if($_TEG['part']<=4&&$_TEG['part']>=1) {
$_GET['act'] = "Part".$_TEG['part']; } }
require_once($SettDir['inc'].'filename.php');
require_once($SettDir['inc'].'function.php');
if($Settings['enable_pathinfo']==true) { 
	mrstring(); /* Change Path info to Get Vars :P */ }
require_once($SettDir['misc'].'setcheck.php');
@ini_set("default_charset",$Settings['charset']);
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="mysql.php"||$File3Name=="/mysql.php") {
	require($SettDir['inc'].'forbidden.php');
	exit(); }
//error_reporting(E_ERROR);
if($Settings['use_gzip']=="on") {
if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'], "gzip")) { 
	$GZipEncode['Type'] = "gzip"; } else { 
	if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'], "deflate")) { 
	$GZipEncode['Type'] = "deflate"; } else { 
		$Settings['use_gzip'] = "off"; $GZipEncode['Type'] = "none"; } } }
if($Settings['use_gzip']=="gzip") {
if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'], "gzip")) { $Settings['use_gzip'] = "on";
	$GZipEncode['Type'] = "gzip"; } else { $Settings['use_gzip'] = "off"; } }
if($Settings['use_gzip']=="deflate") {
if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'], "deflate")) { $Settings['use_gzip'] = "on";
	$GZipEncode['Type'] = "deflate"; } else { $Settings['use_gzip'] = "off"; } }
@ob_start();
if($Settings['use_gzip']=="on") { 
if($GZipEncode['Type']!="gzip") { if($GZipEncode['Type']!="deflate") { $GZipEncode['Type'] = "gzip"; } }
	if($GZipEncode['Type']=="gzip") {
	@header("Content-Encoding: gzip"); }
	if($GZipEncode['Type']=="deflate") {
	@header("Content-Encoding: deflate"); } }
/* if(eregi("msie",$browser) && !eregi("opera",$browser)){
@header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"'); } */
@session_set_cookie_params(0, $basedir);
@session_cache_limiter("private, must-revalidate");
@header("Cache-Control: private, must-revalidate"); // IE 6 Fix
@header("Pragma: private, must-revalidate");
@header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
@header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
@header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
if(CheckFiles("install.php")!=true) {
@session_name($Settings['sqltable']."sess");
@session_start(); }
@output_reset_rewrite_vars();
if($Settings['hash_type']!="hmac-md5") {
if($Settings['hash_type']!="hmac-sha1") {
$Settings['hash_type']="hmac-sha1"; } }
if($_GET['act']=="bsdl"||$_GET['act']=="BSDL") { $_GET['act']="bsd"; }
if($_GET['act']=="bsd"||$_GET['act']=="bsd") {
@header("Content-Type: text/plain; charset=".$Settings['charset']);
require("LICENSE"); gzip_page($Settings['use_gzip'],$GZipEncode['Type']); die(); }
if($_GET['act']=="README"||$_GET['act']=="ReadME") { $_GET['act']="readme"; }
if($_GET['act']=="readme"||$_GET['act']=="ReadMe") {
@header("Content-Type: text/plain; charset=".$Settings['charset']);
require("README"); gzip_page($Settings['use_gzip'],$GZipEncode['Type']); die(); }
if($_GET['act']=="js"||$_GET['act']=="javascript") {
@header("Content-Script-Type: text/javascript");
if(stristr($_SERVER["HTTP_ACCEPT"],"application/x-javascript") ) {
@header("Content-Type: application/x-javascript; charset=".$Settings['charset']); } else {
if(stristr($_SERVER["HTTP_ACCEPT"],"application/javascript") ) {
@header("Content-Type: application/javascript; charset=".$Settings['charset']); } else {
@header("Content-Type: text/javascript; charset=".$Settings['charset']); } }
require("inc/javascript.php"); die(); }
if(CheckFiles("install.php")!=true) {
	if($Settings['sqldb']==null) {
		redirect("location",$basedir."install.php"); }
@ConnectMysql($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
if(CheckFiles("install.php")==true) {
	$Settings['board_name'] = "Installing iDB"; }
if(isset($_SESSION['CheckCookie'])) {
if($_SESSION['CheckCookie']!="done") {
if($_COOKIE['SessPass']!=null&&
$_COOKIE['MemberName']!=null) {
require('inc/prelogin.php'); } } }
if(!isset($_SESSION['UserGroup'])) { $_SESSION['UserGroup'] = null; }
if($_SESSION['UserGroup']==null) { 
$_SESSION['UserGroup']=$Settings['GuestGroup']; }
//Time Zone Set
if(!isset($_SESSION['UserTimeZone'])) { $_SESSION['UserTimeZone'] = null; }
if($_SESSION['UserTimeZone']==null||
	!is_numeric($_SESSION['UserTimeZone'])) {
	if($Settings['DefaultTimeZone']!=null&&
	is_numeric($Settings['DefaultTimeZone'])) {
	$_SESSION['UserTimeZone'] = $Settings['DefaultTimeZone']; }
	if($Settings['DefaultTimeZone']==null) {
	$_SESSION['UserTimeZone'] = SeverOffSet(); }
	if(!is_numeric($Settings['DefaultTimeZone'])) {
	$_SESSION['UserTimeZone'] = SeverOffSet(); } }
if(!isset($_SESSION['UserDST'])) { $_SESSION['UserDST'] = null; }
if($_SESSION['UserDST']==null) {
if($Settings['DefaultDST']=="off") { 
	$_SESSION['UserDST'] = "off"; }
if($Settings['DefaultDST']=="on") { 
	$_SESSION['UserDST'] = "on"; } }
// Skin Stuff
if(!isset($_SESSION['Theme'])) { $_SESSION['Theme'] = null; }
if(!isset($_GET['theme'])) { $_GET['theme'] = null; }
if(!isset($_POST['theme'])) { $_POST['theme'] = null; }
if(!isset($_GET['skin'])) { $_GET['skin'] = null; }
if(!isset($_POST['skin'])) { $_POST['skin'] = null; }
if(!isset($_GET['style'])) { $_GET['style'] = null; }
if(!isset($_POST['style'])) { $_POST['style'] = null; }
if(!isset($_GET['css'])) { $_GET['css'] = null; }
if(!isset($_POST['css'])) { $_POST['css'] = null; }
if($_GET['theme']==null) {
	if($_POST['theme']!=null) {
		$_GET['theme'] = $_POST['theme']; }
	if($_POST['skin']!=null) {
		$_GET['theme'] = $_POST['skin']; }
	if($_POST['style']!=null) {
		$_GET['theme'] = $_POST['style']; }
	if($_POST['css']!=null) {
		$_GET['theme'] = $_POST['css']; }
	if($_GET['skin']!=null) {
		$_GET['theme'] = $_GET['skin']; }
	if($_GET['style']!=null) {
		$_GET['theme'] = $_GET['style']; }
	if($_GET['css']!=null) {
		$_GET['theme'] = $_GET['css']; } }
if($_GET['theme']!=null) {
$_GET['theme']=preg_replace("/(.*?)\.\/(.*?)/", "iDB", $_GET['theme']);
if($_GET['theme']=="../"||$_GET['theme']=="./") {
$_GET['theme']="iDB"; $_SESSION['Theme']="iDB"; }
if (file_exists($SettDir['themes'].$_GET['theme']."/settings.php")) {
$_SESSION['Theme'] = $_GET['theme'];
if($_SESSION['UserGroup']!=$Settings['GuestGroup']) {
$NewDay=GMTimeStamp();
$qnewskin = query("update ".$Settings['sqltable']."members set `UseTheme`='%s',`LastActive`='%s' WHERE `id`=%i", array($_GET['theme'],$NewDay,$_SESSION['UserID']));
mysql_query($qnewskin); }
/* The file Theme Exists */ }
else { $_GET['theme'] = $Settings['DefaultTheme']; 
$_SESSION['Theme'] = $Settings['DefaultTheme'];
/* The file Theme Dose Not Exists */ } }
if($_GET['theme']==null) { 
if($_SESSION['Theme']!=null) {
$_GET['theme']=$_SESSION['Theme']; }
if($_SESSION['Theme']==null) {
$_SESSION['Theme']=$Settings['DefaultTheme'];
$_GET['theme']=$Settings['DefaultTheme']; } }
$PreSkin['skindir1'] = $_SESSION['Theme'];
$PreSkin['skindir2'] = $SettDir['themes'].$_SESSION['Theme'];
require($SettDir['themes'].$_GET['theme']."/settings.php");
if(!isset($_SESSION['DBName'])) { $_SESSION['DBName'] = null; }
if($_SESSION['DBName']==null) {
	$_SESSION['DBName'] = $Settings['sqldb']; }
if($_SESSION['DBName']!=null) {
	if($_SESSION['DBName']!=$Settings['sqldb']) {
@redirect("location",$basedir.url_maker($exfile['member'],$Settings['file_ext'],"act=logout",$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member'],false)); } }
?>
