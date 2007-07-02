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

    $FileInfo: preinstall.php - Last Update: 07/01/2007 SVN 35 - Author: cooldude2k $
*/
@error_reporting(E_ALL ^ E_NOTICE);
@ini_set('session.use_trans_sid', false);
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="preinstall.php"||$File3Name=="/preinstall.php") {
	@header('Location: index.php');
	exit(); }

@header("Cache-Control: private, must-revalidate"); // IE 6 Fix
@header("Pragma: private, must-revalidate");
@header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
@header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
@header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
@output_reset_rewrite_vars();
if(!isset($SettDir['inc'])) { $SettDir['inc'] = "inc/"; }
if(!isset($SettDir['misc'])) { $SettDir['misc'] = "inc/misc/"; }
if(!isset($SettDir['admin'])) { $SettDir['admin'] = "inc/admin/"; }
if(!isset($SettDir['mod'])) { $SettDir['mod'] = "inc/mod/"; }
if(!isset($SettDir['themes'])) { $SettDir['themes'] = "themes/"; }
if(file_exists($SettDir['themes']."iDB/settings.php")) {
	require($SettDir['themes']."iDB/settings.php"); }
if(!file_exists($SettDir['themes']."iDB/settings.php")) {
	require($SettDir['themes']."Gray/settings.php"); }
?>