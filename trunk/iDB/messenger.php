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
require('preindex.php');
if($_SERVER['PATH_INFO']!=null) {
if($_GET['act']==null&&$urlvars[1]!=null) {
	$_GET['act']=$urlvars[1]; }
if($_GET['id']==null&&$urlvars[2]!=null) {
	$_GET['id']=$urlvars[2]; } }
$usefileext = $Settings['file_ext'];
if($usefileext=="noext") { $usefileext = ""; }
$filewpath = $exfile['messenger'].$usefileext.$_SERVER['PATH_INFO'];
?>

<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php require($SettDir['inc'].'navbar.php');
if($_SESSION['UserGroup']==$Settings['GuestGroup']) {
redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],array("act"),array("view"),$Settings['qstr'],$Settings['qsep'],$exqstr['index'],FALSE)); } ?>

<?php if($_GET['act']==null)
{ $_GET['act']="view"; }
if(!is_numeric($_GET['id']))
{ $_GET['id']="1"; }
if($_GET['act']=="view"||$_GET['act']=="viewsent")
{ require($SettDir['inc'].'pm.php'); }
if($_GET['act']=="read")
{ require($SettDir['inc'].'pm.php'); } ?>

<div>&nbsp;</div>
<?php require($SettDir['inc'].'endpage.php'); ?>

</body>
</html>
<?php 
if($_GET['act']=="read") {
change_title($Settings['board_name']." ".$ThemeSet['TitleDivider']." Viewing Message ".$MessageName,$Settings['use_gzip']); }
if($_GET['act']=="viewsent") { 
change_title($Settings['board_name']." ".$ThemeSet['TitleDivider']." Viewing Sent MailBox",$Settings['use_gzip']); }
if($_GET['act']!="read"&&$_GET['act']!="viewsent") { 
change_title($Settings['board_name']." ".$ThemeSet['TitleDivider']." Viewing MailBox",$Settings['use_gzip']); }
?>
