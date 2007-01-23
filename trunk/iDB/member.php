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
if($_GET['act']=="view") {
if($_GET['id']==null&&$urlvars[2]!=null) {
	$_GET['id']=$urlvars[2]; } }
if($_GET['act']=="list") {
if($_GET['orderby']==null&&$urlvars[2]!=null) {
	$_GET['orderby']=$urlvars[2]; }
if($_GET['ordertype']==null&&$urlvars[3]!=null) {
	$_GET['ordertype']=$urlvars[3]; } } }
$filewpath = $exfile['member'].$Settings['file_ext'].$_SERVER['PATH_INFO'];
if($_GET['act']==null) { $_GET['act'] = "login"; }
?>

<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php if($_GET['act']==null)
{ $_GET['act']="view"; }
if(!is_numeric($_GET['id']))
{ $_GET['id']="1"; }
require($SettDir['inc'].'navbar.php');
if($_GET['act']=="login"||
$_POST['act']=="loginmember"||
$_GET['act']=="logout")
{ require($SettDir['inc'].'members.php'); } 
if($_GET['act']=="list"||
$_GET['act']=="view"||
$_GET['act']=="signup")
{ require($SettDir['inc'].'members.php'); } 
if($_GET['act']=="makemember") {
if($_POST['act']=="makemembers") {
require($SettDir['inc'].'members.php'); } } ?>
<div>&nbsp;</div>
<?php require($SettDir['inc'].'endpage.php');
?>

</body>
</html>
<?php 
if($membertitle==null) {
fix_amp($Settings['use_gzip']); }
if($membertitle!=null) {
change_title($Settings['board_name'].$membertitle,$Settings['use_gzip']); }
?>
