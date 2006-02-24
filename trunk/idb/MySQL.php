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
*/
require('Settings.php');
require('misc/Kernel.php');
error_reporting(E_ALL ^ E_NOTICE);
@ini_set("arg_separator", "&amp;");
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="MySQL.php"||$File3Name=="/MySQL.php") {
	require('inc/403.html');
	exit(); }
//error_reporting(E_ERROR);
if($Settings['use_gzip']!=true) { ob_start(); }
if($Settings['use_gzip']==true) { ob_start("ob_gzhandler"); }
session_name("iDBid");
header("Content-type: text/html; charset=iso-8859-15");
header('Cache-control: private, must-revalidate'); // IE 6 Fix
header('Pragma: private');
session_start();
require('inc/safesql/SafeSQL.class.php');
if($Settings['hash_type']!="hmac-md5") {
if($Settings['hash_type']!="hmac-sha1") {
$Settings['hash_type']="hmac-sha1"; } }
/* if($Settings['use_iniset']==true) {
Change Some PHP Settings Fix the & to &amp;
ini_set("arg_separator.output","&amp;"); } */

if($_GET['act']=="gpl"||$_GET['act']=="GPL") {
header('Content-type: text/plain');
require("gpl.txt"); die(); }

if(CheckFiles("install.php")!=true) {
	if($Settings['sqldb']==null) {
		header("Location: install.php"); }
ConnectMysql($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
if($_SESSION['CheckCookie']!="done") {
if($_COOKIE['SessPass']!=null&&
$_COOKIE['MemberName']!=null) {
require('inc/prelogin.php');
} }
if($_SESSION['UserGroup']==null) { 
$_SESSION['UserGroup']=$Settings['GuestGroup']; }
$safesql =& new SafeSQL_MySQL;
//Time Zone Set
if($_SESSION['UserTimeZone']!=null) {
$YourOffSet = $_SESSION['UserTimeZone']; }
if($_SESSION['UserTimeZone']==null) {
$YourOffSet = SeverOffSet(null); }
// Skin Stuff
if($_GET['Skin']!=null) {
$_GET['Skin']=preg_replace("/(.*?)\.\/(.*?)/", "iDB", $_GET['Skin']);
if($_GET['Skin']=="../"||$_GET['Skin']=="./") {
$_GET['Skin']="iDB"; $_SESSION['Skin']="iDB"; }
if (file_exists("skin/".$_GET['Skin']."/Settings.php")) {
$_SESSION['Skin'] = $_GET['Skin'];
/* The file Skin Exists */ }
else { $_GET['Skin']="iDB"; $_SESSION['Skin']="iDB";
/* The file Skin Dose Not Exists */ } }
if($_GET['Skin']==null) { 
if($_SESSION['Skin']!=null) {
$_GET['Skin']=$_SESSION['Skin']; }
if($_SESSION['Skin']==null) {
$_SESSION['Skin']="iDB";
$_GET['Skin']="iDB"; } }
$PreSkin['skindir1'] = $_SESSION['Skin'];
$PreSkin['skindir2'] = "skin/".$_SESSION['Skin'];
require("skin/".$_GET['Skin']."/Settings.php");
?>