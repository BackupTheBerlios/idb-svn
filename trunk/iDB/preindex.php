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
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="preindex.php"||$File3Name=="/preindex.php") {
	require('inc/forbidden.php');
	exit(); }
require('mysql.php');
if($_GET['Feed']=="rss"&&$_GET['CatFeed']=="rss") {
	$_GET['CatFeed']=""; }
if($_GET['Feed']=="rss"&&$_GET['SubFeed']=="rss") {
	$_GET['SubFeed']=""; }
if($_GET['Feed']=="rss"||$_GET['act']=="Feed") {
	require('inc/rssfeed.php'); }
if($_GET['CatFeed']=="rss"||$_GET['act']=="CatFeed") {
	require('inc/rssfeed.php'); }
if($_GET['SubFeed']=="rss"||$_GET['act']=="SubFeed") {
	require('inc/rssfeed.php'); }
if($Settings['html_type']=="xhtml10") {
require('inc/xhtml10.php'); }
if($Settings['html_type']=="xhtml11") {
if(stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
require('inc/xhtml11.php'); } else {
if (stristr($_SERVER["HTTP_USER_AGENT"],"W3C_Validator")) {
   require('inc/xhtml11.php'); } else { 
	   $Settings['html_type']="xhtml10";
	   $Settings['html_level']="Strict";
	   require('inc/xhtml10.php'); } } }
if($Settings['html_type']=="html4") {
require('inc/html40.php'); }
if($Settings['html_type']!="xhtml10") {
	if($Settings['html_type']!="xhtml11") {
		if($Settings['html_type']!="html4") {
	require('inc/xhtml10.php'); } } }
?>