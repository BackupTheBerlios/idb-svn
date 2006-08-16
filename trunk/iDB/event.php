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
$filewpath = "event".$usefileext.$_SERVER['PATH_INFO'];
?>

<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php require('inc/navbar.php'); ?>
<div class="Table1Border">
<table class="Table1" width="100%">
<?php if($_GET['act']=="event"){ $_GET['act']="view"; }
if(!is_numeric($_GET['id']))
{ $_GET['id']="1"; }
if($_GET['act']=="view"||$_GET['act']==null) {
$_GET['act']="view";
require('inc/events.php'); } ?>
</table></div>
<div>&nbsp;</div>
<?php require('inc/endpage.php'); ?>
</body>
</html>
<?php change_title($Settings['board_name']." - Viewing Event ".$EventName,$Settings['use_gzip']); ?>
