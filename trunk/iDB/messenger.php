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
	$_GET['act']=$urlvars[1]; }
if($_GET['id']==null&&$urlvars[2]!=null) {
	$_GET['id']=$urlvars[2]; } }
$usefileext = $Settings['file_ext'];
if($usefileext=="noext") { $usefileext = ""; }
$filewpath = "messenger".$usefileext.$_SERVER['PATH_INFO'];
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
	<div class="Table1Border">
	<table class="Table1" style="width: 100%; float: left; vertical-align: top;">
<tr class="TableRow1">
<td class="TableRow1">Messenger</td>
</tr><tr class="TableRow2">
<td class="TableRow2">&nbsp;</td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("messenger",$Settings['file_ext'],array("act"),array("view"),$Settings['qstr'],$Settings['qsep']); ?>">View MailBox</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker("messenger",$Settings['file_ext'],array("act"),array("viewsent"),$Settings['qstr'],$Settings['qsep']); ?>">View SentBox</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="#<?php echo url_maker("messenger",$Settings['file_ext'],array("act"),array("send"),$Settings['qstr'],$Settings['qsep']); ?>">Send Message</a></td>
</tr><tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr></table></div>
</td>
	<td style="width: 85%; vertical-align: top;">
<?php if($_GET['act']==null)
{ $_GET['act']="view"; }
if($_GET['act']=="view"||$_GET['act']=="viewsent")
{ require('inc/pmlist.php'); }
if($_GET['act']=="read")
{ require('inc/readpm.php'); } ?>
</td></tr>
</table>
<div>&nbsp;</div>
<?php require('inc/endpage.php'); ?>
</body>
</html>
<?php 
if($_GET['act']=="read") {
change_title($Settings['board_name']." - Viewing Message ".$MessageName,$Settings['use_gzip']); }
if($_GET['act']=="viewsent") { 
change_title($Settings['board_name']." - Viewing Sent MailBox",$Settings['use_gzip']); }
if($_GET['act']!="read"&&$_GET['act']!="viewsent") { 
change_title($Settings['board_name']." - Viewing MailBox",$Settings['use_gzip']); }
?>
