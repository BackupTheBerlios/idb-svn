<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2007 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2007 Game Maker 2k - http://upload.idb.s1.jcink.com/
*/
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="events.php"||$File3Name=="/events.php") {
	require('index.php');
	exit(); }
require_once($SettDir['misc'].'functions.php');
/* Change Some PHP Settings Fix the & to &amp; */
if($Settings['use_iniset']==true&&$Settings['qstr']!="/") {
@ini_set("arg_separator.output",htmlentities($Settings['qstr'], ENT_QUOTES));
@ini_set("arg_separator.input",$Settings['qstr']);
@ini_set("arg_separator",htmlentities($Settings['qstr'], ENT_QUOTES)); }
//$basepath = pathinfo($_SERVER['REQUEST_URI']);
/*if(dirname($_SERVER['REQUEST_URI'])!="."||
	dirname($_SERVER['REQUEST_URI'])!=null) {
$basedir = dirname($_SERVER['REQUEST_URI'])."/"; }*/
if(dirname($_SERVER['SCRIPT_NAME'])!="."||
	dirname($_SERVER['SCRIPT_NAME'])!=null) {
$basedir = dirname($_SERVER['SCRIPT_NAME'])."/"; }
if($basedir==null||$basedir==".") {
if(dirname($_SERVER['SCRIPT_NAME'])=="."||
	dirname($_SERVER['SCRIPT_NAME'])==null) {
$basedir = dirname($_SERVER['PHP_SELF'])."/"; } }
if($basedir=="\/") { $basedir="/"; }
$basedir = str_replace("//", "/", $basedir);
if($Settings['fixbasedir']!=null&&$Settings['fixbasedir']!="") {
		$basedir = $Settings['fixbasedir']; }
$BaseURL = $basedir;
// Get our Host Name and Referer URL's Host Name
$REFERERurl = parse_url($_SERVER['HTTP_REFERER']);
$URL['REFERER'] = $REFERERurl['host'];
$URL['HOST'] = $_SERVER["SERVER_NAME"];
$REFERERurl = null; unset($REFERERurl);
function qstring($qstr=";",$qsep="=")
{ $_GET = null; $_GET = array();
if (!isset($_SERVER['QUERY_STRING'])) {
$_SERVER['QUERY_STRING'] = getenv('QUERY_STRING'); }
@ini_get("arg_separator.input", $qstr);
$_SERVER['QUERY_STRING'] = urldecode($_SERVER['QUERY_STRING']);
$preqs = explode($qstr,$_SERVER["QUERY_STRING"]);
$qsnum = count($preqs); $qsi = 0;
while ($qsi < $qsnum) {
$preqst = explode($qsep,$preqs[$qsi],2);
$fix1 = array(" ",'$'); $fix2  = array("_","_");
$preqst[0] = str_replace($fix1, $fix2, $preqst[0]);
$preqst[0] = killbadvars($preqst[0]);
if($preqst[0]!=null) {
$_GET[$preqst[0]] = $preqst[1]; }
++$qsi; } return true; }
if($_SERVER['PATH_INFO']==null) {
	if(@getenv('PATH_INFO')!=null&&@getenv('PATH_INFO')!="1") {
$_SERVER['PATH_INFO'] = @getenv('PATH_INFO'); }
if(@getenv('PATH_INFO')==null) {
$myscript = $_SERVER["SCRIPT_NAME"];
$myphpath = $_SERVER["PHP_SELF"];
$mypathinfo = str_replace($myscript, "", $myphpath);
@putenv("PATH_INFO=".$mypathinfo); } }
function mrstring() {
$urlvar = explode('/',$_SERVER['PATH_INFO']);
$num=count($urlvar); $i=1;
while ($i <= $num) {
//$urlvar[$i] = urldecode($urlvar[$i]);
if($_GET[$urlvar[$i]]==null&&$urlvar[$i]!=null) {
$fix1 = array(" ",'$'); $fix2  = array("_","_");
$urlvar[$i] = str_replace($fix1, $fix2, $urlvar[$i]);
$urlvar[$i] = killbadvars($urlvar[$i]);
	$_GET[$urlvar[$i]] = $urlvar[$i+1]; }
++$i; ++$i; } return true; }
function redirect($type,$file,$time=0,$url=null,$dbsr=true)
{
if($type!="location"&&
	$type!="refresh") {
	$type=="location"; }
if($url!=null) {
$file = $url.$file; }
if($dbsr==true) {
$file = str_replace("//", "/", $file); }
if($type=="refresh") {
header("Refresh: ".$time."; URL=".$file); }
if($type=="location") {
@session_write_close();
header("Location: ".$file); }
return true; }
function url_maker($file,$ext,$qvarstr=null,$qstr=";",$qsep="=",$prexqstr=null,$exqstr=null,$fixhtml=true) {
if($ext==null) { $ext = ".php"; } 
if($ext=="noext"||$ext=="no ext"||$ext=="no+ext") { $ext = null; }
$file = $file.$ext;
if($qvarstr==null) { $fileurl = $file; }
if($fixhtml==true||$fixhtml==null) {
$qstr = htmlentities($qstr, ENT_QUOTES);
$qsep = htmlentities($qsep, ENT_QUOTES); }
if($prexqstr!=null) { 
$rene1 = explode("&",$prexqstr);
$renenum=count($rene1);
$renei=0;
$reneqstr = "index.php?";
if($qstr!="/") { $fileurl = $file."?"; }
if($qstr=="/") { $fileurl = $file."/"; }
while ($renei < $renenum) {
	$rene2 = explode("=",$rene1[$renei]);
	$rene2[0] = urlencode($rene2[0]);
	$rene2[1] = urlencode($rene2[1]);
	if($qstr!="/") {
	$fileurl = $fileurl.$rene2[0].$qsep.$rene2[1]; }
	if($qstr=="/") {
	$fileurl = $fileurl.$rene2[0]."/".$rene2[1]."/"; }
	$reneis = $renei + 1;
	if($qstr!="/") {
	if($reneis < $renenum) { $fileurl = $fileurl.$qstr; } }
	++$renei; } }
if($qvarstr!=null&&$qstr!="/") { $fileurl = $fileurl.$qstr; }
if($qvarstr!=null) { 
if($prexqstr==null) {
if($qstr!="/") { $fileurl = $file."?"; }
if($qstr=="/") { $fileurl = $file."/"; } }
$cind1 = explode("&",$qvarstr);
$cindnum=count($cind1);
$cindi=0;
$cindqstr = "index.php?";
while ($cindi < $cindnum) {
	$cind2 = explode("=",$cind1[$cindi]);
	$cind2[0] = urlencode($cind2[0]);
	$cind2[1] = urlencode($cind2[1]);
	if($qstr!="/") {
	$fileurl = $fileurl.$cind2[0].$qsep.$cind2[1]; }
	if($qstr=="/") {
	$fileurl = $fileurl.$cind2[0]."/".$cind2[1]."/"; }
	$cindis = $cindi + 1;
	if($qstr!="/") {
	if($cindis < $cindnum) { $fileurl = $fileurl.$qstr; } }
	++$cindi; } }
if($exqstr!=null&&$qstr!="/") { $fileurl = $fileurl.$qstr; }
if($exqstr!=null) { 
if($qvarstr==null&&$prexqstr==null) {
if($qstr!="/") { $fileurl = $file."?"; }
if($qstr=="/") { $fileurl = $file."/"; } }
$sand1 = explode("&",$exqstr);
$sanum=count($sand1);
$sandi=0;
$sandqstr = "index.php?";
while ($sandi < $sanum) {
	$sand2 = explode("=",$sand1[$sandi]);
	$sand2[0] = urlencode($sand2[0]);
	$sand2[1] = urlencode($sand2[1]);
	if($qstr!="/") {
	$fileurl = $fileurl.$sand2[0].$qsep.$sand2[1]; }
	if($qstr=="/") {
	$fileurl = $fileurl.$sand2[0]."/".$sand2[1]."/"; }
	$sandis = $sandi + 1;
	if($qstr!="/") {
	if($sandis < $sanum) { $fileurl = $fileurl.$qstr; } }
	++$sandi; } }
return $fileurl; }
$thisdir = dirname(realpath("Preindex.php"))."/";
function GetQueryStr($qstr=";",$qsep="=",$fixhtml=true)
{ $pregqstr = preg_quote($qstr,"/");
$pregqsep = preg_quote($qsep,"/");
$oqstr = $qstr; $oqsep = $qsep;
if($fixhtml==true||$fixhtml==null) {
$qstr = htmlentities($qstr, ENT_QUOTES);
$qsep = htmlentities($qsep, ENT_QUOTES); }
$OldBoardQuery = preg_replace("/".$pregqstr."/isxS", $qstr, $_SERVER['QUERY_STRING']);
$BoardQuery = "?".$OldBoardQuery;
return $BoardQuery; }
?>