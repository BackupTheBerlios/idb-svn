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

    $FileInfo: rss.php - Last Update: 04/09/2007 SVN 41 - Author: cooldude2k $
*/
@error_reporting(E_ALL ^ E_NOTICE);
if(@ini_get("register_globals")) {
	require_once('inc/misc/killglobals.php'); }
require_once('mysql.php');
if($SettDir['inc']==null) { $SettDir['inc'] = "inc/"; }
if($SettDir['misc']==null) { $SettDir['misc'] = "inc/misc/"; }
if($SettDir['rss']==null) { $SettDir['rss'] = "inc/rss/"; }
if($SettDir['admin']==null) { $SettDir['admin'] = "inc/admin/"; }
if($SettDir['mod']==null) { $SettDir['mod'] = "inc/mod/"; }
if($SettDir['themes']==null) { $SettDir['themes'] = "themes/"; }
if($Settings['enable_rss']==true) {
if($_GET['act']==null)
{	$_GET['act']="boardrss";	}
if($_GET['act']==null)
{	$_GET['act']="boardfeed";	}
if($_GET['act']=="boardfeed")
{	$_GET['act'] = "boardrss";	}
if($_GET['act']=="catboardfeed")
{	$_GET['act'] = "catboardrss";	}
if($_GET['act']=="categoryfeed")
{	$_GET['act'] = "categoryrss";	}
if($_GET['act']=="topicfeed")
{	$_GET['act'] = "topicrss";	}
if($_GET['act']=="eventfeed")
{	$_GET['act'] = "eventrss";	}
if($_GET['act']=="boardrss")
{	$_GET['feedtype'] = "rss";
	require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="boardatom")
{	$_GET['feedtype'] = "atom";
	require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="catboardrss")
{	$_GET['feedtype'] = "rss";
	require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="catboardatom")
{	$_GET['feedtype'] = "atom";
	require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="categoryrss")
{	$_GET['feedtype'] = "rss";
	require($SettDir['rss'].'rss3.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="categoryatom")
{	$_GET['feedtype'] = "atom";
	require($SettDir['rss'].'rss3.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="topicrss")
{	$_GET['feedtype'] = "rss";
	require($SettDir['rss'].'rss2.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="topicatom")
{	$_GET['feedtype'] = "atom";
	require($SettDir['rss'].'rss2.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="eventrss")
{	$_GET['feedtype'] = "rss";
	require($SettDir['rss'].'rss4.php'); $Feed['Feed']="Done";	}
if($_GET['act']=="eventatom")
{	$_GET['feedtype'] = "atom";
	require($SettDir['rss'].'rss4.php'); $Feed['Feed']="Done";	}
if($Feed['Feed']!="Done")
{	$_GET['feedtype'] = "rss";
	require($SettDir['rss'].'rss1.php'); $Feed['Feed']="Done";	} }
?>