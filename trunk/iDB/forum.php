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
	$_GET['id']=$urlvars[2]; }
if($_GET['CatID']==null&&$urlvars[3]!=null) {
	$_GET['CatID']=$urlvars[3]; } }
$usefileext = $Settings['file_ext'];
if($usefileext=="noext") { $usefileext = ""; }
$filewpath = "forum".$usefileext.$_SERVER['PATH_INFO'];
if($Settings['html_type']=="html4") { ?>
<link rel="alternate" type="application/rss+xml" title="Forum Topics RSS Feed" href="<?php echo url_maker("rss",$Settings['rss_ext'],array("act","id","CatID"),array("TopicFeed",$_GET['id'],$_GET['CatID']),$Settings['qstr'],$Settings['qsep']); ?>">
<?php } if($Settings['html_type']!="html4") { ?>
<link rel="alternate" type="application/rss+xml" title="Forum Topics RSS Feed" href="<?php echo url_maker("rss",$Settings['rss_ext'],array("act","id","CatID"),array("TopicFeed",$_GET['id'],$_GET['CatID']),$Settings['qstr'],$Settings['qsep']); ?>" />
<?php } echo "\n"; ?>
<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php require('inc/navbar.php');

if($_GET['act']==null)
{ $_GET['act']="view"; }
if(!is_numeric($_GET['id']))
{ $_GET['id']="1"; }
if(!is_numeric($_GET['CatID']))
{ $_GET['CatID']="1"; }
if($_GET['act']=="view")
{ require('inc/topics.php'); } 
require('inc/endpage.php'); ?>
</body>
</html>
<?php change_title($Settings['board_name']." - Viewing ".$ForumName." Forum",$Settings['use_gzip']); ?>
