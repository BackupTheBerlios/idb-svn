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
require('preindex.php');
$usefileext = $Settings['file_ext'];
if($ext=="noext"||$ext=="no ext"||$ext=="no+ext") { $usefileext = ""; }
$filewpath = $exfile['profile'].$usefileext.$_SERVER['PATH_INFO'];
?>

<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php require($SettDir['inc'].'navbar.php');
if($_SESSION['UserGroup']==$Settings['GuestGroup']) {
redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false)); }
if($_GET['act']==null||$_GET['act']=="notepad")
{ $_GET['act']="view"; }
if($_GET['act']=="view"||
$_GET['act']=="signature"||
$_GET['act']=="avatar"||
$_GET['act']=="settings"||
$_GET['act']=="profile"||
$_GET['act']=="userinfo")
{ require($SettDir['inc'].'profilemain.php'); } ?>
<div>&nbsp;</div>
<?php require($SettDir['inc'].'endpage.php'); ?>

</body>
</html>
<?php 
if($profiletitle==null) {
fix_amp($Settings['use_gzip']); }
if($profiletitle!=null) {
change_title($Settings['board_name'].$profiletitle,$Settings['use_gzip']); }
?>
