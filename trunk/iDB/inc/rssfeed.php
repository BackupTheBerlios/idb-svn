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
if ($File3Name=="rssfeed.php"||$File3Name=="/rssfeed.php") {
	require('index.php');
	exit(); }
if($_get['act']=="feed") {
	if($_GET['feedtype']!="rss"&&
	$_GET['feedtype']!="atom") { $_GET['feedtype'] = "rss"; }
	if($_GET['feedtype']=="rss") { $_GET['feed'] = "rss"; }
	if($_GET['feedtype']=="atom") { $_GET['feed'] = "atom"; } }
if($_GET['feed']=="rss"||$_GET['feed']=="atom") {
if(CheckFiles("index.php")==true) { 
require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done"; exit(); }
if(CheckFiles("Forum.php")==true) { 
require($SettDir['rss'].'rss2.php'); $Feed['Feed']="Done"; exit(); }
if(CheckFiles("SubForum.php")==true) { 
require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done"; exit(); }
if(CheckFiles("Category.php")==true) { 
require($SettDir['rss'].'rss4.php'); $Feed['Feed']="Done"; exit(); }
if(CheckFiles("Calendar.php")==true) { 
require($SettDir['rss'].'rss5.php'); $Feed['Feed']="Done"; exit(); }
}
if($_get['act']=="catfeed") {
	if($_GET['feedtype']!="rss"&&
	$_GET['feedtype']!="atom") { $_GET['feedtype'] = "rss"; }
	if($_GET['feedtype']=="rss") { $_GET['catfeed'] = "rss"; }
	if($_GET['feedtype']=="atom") { $_GET['catfeed'] = "atom"; } }
if($_GET['catfeed']=="rss"||$_GET['catfeed']=="atom") {
if(CheckFiles("index.php")==true) { 
	$_GET['subid'] = 0;
require($SettDir['rss'].'rss4.php'); $Feed['Feed']="Done"; exit(); }
if(CheckFiles("category.php")==true) { 
require($SettDir['rss'].'rss4.php'); $Feed['Feed']="Done"; exit(); }
}
if($_get['act']=="subfeed") {
	if($_GET['feedtype']!="rss"&&
	$_GET['feedtype']!="atom") { $_GET['feedtype'] = "rss"; }
	if($_GET['feedtype']=="rss") { $_GET['subfeed'] = "rss"; }
	if($_GET['feedtype']=="atom") { $_GET['subfeed'] = "atom"; } }
if($_GET['subfeed']=="rss"||$_GET['subfeed']=="atom") {
if(CheckFiles("subforum.php")==true) { 
require($SettDir['rss'].'rss2.php'); $Feed['Feed']="Done"; exit(); }
}
?>