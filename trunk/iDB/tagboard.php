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
//This is Where You Put The Name of This File and Your Board Name
$usefileext = $Settings['file_ext'];
if($usefileext=="noext") { $usefileext = ""; }
$filewpath = "tagboard".$usefileext.$_SERVER['PATH_INFO'];
$filename="TagBoard";
$boardname=$Settings['board_name']; ?>

<title> <?php echo $Settings['board_name'].$itbpowertitle; ?> </title>
</head>
<body>
<?php require('inc/navbar.php'); 

if($_GET['act']==null)
{ $_GET['act']="view"; }
if($_GET['act']=="view")
{ require('inc/tagboards.php'); }
require('inc/endpage.php'); ?>
</body>
</html>
<?php fix_amp($Settings['use_gzip']); ?>
