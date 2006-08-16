<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    Copyright 2004-2006 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2006 Game Maker 2k - http://cooldude2k.co.funpic.org/
    Emoticons made by Jcink http://tfbb.jcink.com/
*/
require_once('settings.php');
require_once('misc/functions.php');
require_once('inc/function.php');
if($Settings['qstr']==null) {
	$Settings['qstr'] = "&"; }
if($Settings['qsep']==null) {
	$Settings['qsep'] = "="; }
if($Settings['qsep']==$Settings['qstr']) {
	$Settings['qstr'] = "&";
	$Settings['qsep'] = "="; }
if($Settings['qstr']=="/"||
	$Settings['qstr']=="&") {
	$Settings['qsep'] = "="; }
if($Settings['qstr']!="&"&&
	$Settings['qstr']!="/") {
qstring($Settings['qstr'],$Settings['qsep']); }
if($Settings['file_ext']==null) {
	$Settings['file_ext'] = ".php"; }
if($Settings['rss_ext']==null) {
	$Settings['rss_ext'] = ".php"; }
if($Settings['add_power_by']==true) {
$idbpowertitle = " (Powered by ".$iDB.")";
$itbpowertitle = " (Powered by ".$iTB.")"; }
if($Settings['add_power_by']!=true) {
$idbpowertitle = null;
$itbpowertitle = null; }
@error_reporting(E_ALL ^ E_NOTICE);
@ini_set("arg_separator", "&amp;");
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="mysql.php"||$File3Name=="/mysql.php") {
	require('inc/forbidden.php');
	exit(); }
//error_reporting(E_ERROR);
if($Settings['use_gzip']==true) {
if(strstr($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING'], "gzip")) {
	/* Do Nothing :P */ } else { $Settings['use_gzip'] = false; } }
@ob_start();
if($Settings['use_gzip']==true) { 
	@header("Content-Encoding: gzip"); }
@session_set_cookie_params(0, $basedir);
@session_cache_limiter("private, must-revalidate");
@header("Cache-Control: private, must-revalidate"); // IE 6 Fix
@header("Pragma: private, must-revalidate");
if($preact['idb']!="installing") {
@session_name($Settings['sqltable']."sess");
@session_start(); }
if($Settings['hash_type']!="hmac-md5") {
if($Settings['hash_type']!="hmac-sha1") {
$Settings['hash_type']="hmac-sha1"; } }
/* if($Settings['use_iniset']==true) {
Change Some PHP Settings Fix the & to &amp;
ini_set("arg_separator.output","&amp;"); } */

if($_GET['act']=="gpl"||$_GET['act']=="GPL") {
@header("Content-Type: text/plain; charset=iso-8859-15");
require("gpl.txt");
gzip_page($Settings['use_gzip']); die(); }

if($_GET['act']=="readme"||$_GET['act']=="ReadMe") {
@header("Content-Type: text/plain; charset=iso-8859-15");
require("readme.txt");
gzip_page($Settings['use_gzip']); die(); }

if(CheckFiles("install.php")!=true) {
	if($Settings['sqldb']==null) {
		header("Location: ".$basedir."install.php"); }
@ConnectMysql($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
if($_SESSION['CheckCookie']!="done") {
if($_COOKIE['SessPass']!=null&&
$_COOKIE['MemberName']!=null) {
require('inc/prelogin.php');
} }
if($_SESSION['UserGroup']==null) { 
$_SESSION['UserGroup']=$Settings['GuestGroup']; }

//Time Zone Set
if($_SESSION['UserTimeZone']!=null) {
$YourOffSet = $_SESSION['UserTimeZone']; }
if($_SESSION['UserTimeZone']==null) {
$YourOffSet = SeverOffSet(null); }
// Skin Stuff
if($urlvars[2]=="skin"||
	$urlvars[2]=="Skin") {
	if($urlvars[3]!=null) {
		$_GET['skin'] = $urlvars[3]; } }
if($_GET['skin']==null) {
	if($_GET['Skin']!=null) {
		$_GET['skin'] = $_GET['Skin']; }
	if($_POST['skin']!=null) {
		$_GET['skin'] = $_POST['skin']; }
	if($_POST['Skin']!=null) {
		$_GET['skin'] = $_POST['Skin']; } }
if($_GET['skin']!=null) {
$_GET['skin']=preg_replace("/(.*?)\.\/(.*?)/", "iDB", $_GET['skin']);
if($_GET['skin']=="../"||$_GET['skin']=="./") {
$_GET['skin']="iDB"; $_SESSION['Skin']="iDB"; }
if (file_exists("skin/".$_GET['skin']."/settings.php")) {
$_SESSION['Skin'] = $_GET['skin'];
/* The file Skin Exists */ }
else { $_GET['skin']="iDB"; $_SESSION['Skin']="iDB";
/* The file Skin Dose Not Exists */ } }
if($_GET['skin']==null) { 
if($_SESSION['Skin']!=null) {
$_GET['skin']=$_SESSION['Skin']; }
if($_SESSION['Skin']==null) {
$_SESSION['Skin']="iDB";
$_GET['skin']="iDB"; } }
$PreSkin['skindir1'] = $_SESSION['Skin'];
$PreSkin['skindir2'] = "skin/".$_SESSION['Skin'];
require("skin/".$_GET['skin']."/settings.php");
if($_SESSION['DBName']==null) {
	$_SESSION['DBName'] = $Settings['sqldb']; }
if($_SESSION['DBName']!=null) {
	if($_SESSION['DBName']!=$Settings['sqldb']) {
@header("Location: ".$basedir.url_maker("members",$Settings['file_ext'],array("act"),array("logout"),$Settings['qstr'],$Settings['qsep'],FALSE)); } }
?>
