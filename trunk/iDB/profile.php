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
require('preindex.php');
if($_SERVER['PATH_INFO']!=null) {
if($_GET['act']==null&&$urlvars[1]!=null) {
	$_GET['act']=$urlvars[1]; } }
$usefileext = $Settings['file_ext'];
if($usefileext=="noext") { $usefileext = ""; }
$filewpath = "profile".$usefileext.$_SERVER['PATH_INFO'];
?>

<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php require('inc/navbar.php');
if($_SESSION['UserGroup']==$Settings['GuestGroup']) {
header("Location: ".$basedir.url_maker("index",$Settings['file_ext'],array("act"),array("view"),$Settings['qstr'],$Settings['qsep'],FALSE)); } ?>
<table style="width: 100%; vertical-align: top;">
<tr style="width: 100%; vertical-align: top;">
	<td style="width: 15%; vertical-align: top;">
	<table class="Table1" style="width: 100%; float: left; vertical-align: top;">
<tr class="TableRow1">
<td class="TableRow1">Profile Settings</td>
</tr><tr class="TableRow2">
<td class="TableRow2">&nbsp;</td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("profile",$Settings['file_ext'],array("act"),array("view"),$Settings['qstr'],$Settings['qsep']); ?>">Edit NotePad</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("profile",$Settings['file_ext'],array("act"),array("profile"),$Settings['qstr'],$Settings['qsep']); ?>">Edit Profile</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("profile",$Settings['file_ext'],array("act"),array("signature"),$Settings['qstr'],$Settings['qsep']); ?>">Edit Signature</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("profile",$Settings['file_ext'],array("act"),array("avatar"),$Settings['qstr'],$Settings['qsep']); ?>">Edit Avatar</a></td>
</tr><tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr></table><div>&nbsp;</div>
<table class="Table1" style="width: 100%; float: left; vertical-align: top;">
<tr class="TableRow1">
<td class="TableRow1">Board Settings</td>
</tr><tr class="TableRow2">
<td class="TableRow2">&nbsp;</td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("profile",$Settings['file_ext'],array("act"),array("settings"),$Settings['qstr'],$Settings['qsep']); ?>">Board Settings</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("profile",$Settings['file_ext'],array("act"),array("userinfo"),$Settings['qstr'],$Settings['qsep']); ?>">Change User Info</a></td>
</tr><tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr></table>
</td>
	<td style="width: 85%; vertical-align: top;">
<?php if($_GET['act']==null||$_GET['act']=="notepad")
{ $_GET['act']="view"; }
if($_GET['act']=="view"||
$_GET['act']=="signature"||
$_GET['act']=="avatar"||
$_GET['act']=="settings"||
$_GET['act']=="profile"||
$_GET['act']=="userinfo")
{ require('inc/profilemain.php'); } ?>
</td></tr>
</table>
<div>&nbsp;</div>
<?php require('inc/endpage.php'); ?>
</body>
</html>
<?php 
if($profiletitle==null) {
fix_amp($Settings['use_gzip']); }
if($profiletitle!=null) {
change_title($Settings['board_name'].$profiletitle,$Settings['use_gzip']); }
?>
