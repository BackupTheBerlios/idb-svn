<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2007 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2007 Game Maker 2k - http://cooldude2k.phpnet.us/
*/
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="preindex.php"||$File3Name=="/preindex.php") {
	@header('Location: index.php');
	exit(); }
require('mysql.php');
if($_GET['feed']=="rss"&&$_GET['catfeed']=="rss") {
	$_GET['catfeed']=""; }
if($_GET['feed']=="rss"&&$_GET['subfeed']=="rss") {
	$_GET['subfeed']=""; }
if($_GET['feed']=="rss"||$_GET['act']=="Feed") {
	require($SettDir['inc'].'rssfeed.php'); }
if($_GET['catfeed']=="rss"||$_GET['act']=="catfeed") {
	require($SettDir['inc'].'rssfeed.php'); }
if($_GET['subfeed']=="rss"||$_GET['act']=="subfeed") {
	require($SettDir['inc'].'rssfeed.php'); }
if($Settings['output_type']=="htm") {
	$Settings['output_type'] = "html"; }
if($Settings['output_type']=="xhtm") {
	$Settings['output_type'] = "xhtml"; }
if($Settings['output_type']=="xml+htm") {
	$Settings['output_type'] = "xhtml"; }
if($Settings['html_type']=="xhtml10") {
require($SettDir['inc'].'xhtml10.php'); }
if($Settings['html_type']=="xhtml11") {
if(stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
$ccstart = "//<![CDATA["; $ccend = "//]]>";
require($SettDir['inc'].'xhtml11.php'); } else {
if (stristr($_SERVER["HTTP_USER_AGENT"],"W3C_Validator")) {
	$ccstart = "//<![CDATA["; $ccend = "//]]>";
   require($SettDir['inc'].'xhtml11.php'); } else { 
	   $ccstart = "//<!--"; $ccend = "//-->";
	   $Settings['html_type']="xhtml10";
	   $Settings['html_level']="Strict";
	   require($SettDir['inc'].'xhtml10.php'); } } }
if($Settings['html_type']=="html4") {
$ccstart = "//<!--"; $ccend = "//-->";
require($SettDir['inc'].'html40.php'); }
if($Settings['html_type']!="xhtml10") {
	if($Settings['html_type']!="xhtml11") {
		if($Settings['html_type']!="html4") {
	$ccstart = "//<!--"; $ccend = "//-->";
	require($SettDir['inc'].'xhtml10.php'); } } }
?>