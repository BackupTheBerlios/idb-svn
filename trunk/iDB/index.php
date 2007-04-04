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

    $FileInfo: index.php - Last Update: 04/04/2007 SVN 33 - Author: cooldude2k $
*/
require('preindex.php');
$usefileext = $Settings['file_ext'];
if($ext=="noext"||$ext=="no ext"||$ext=="no+ext") { $usefileext = ""; }
$filewpath = $exfile['index'].$usefileext.$_SERVER['PATH_INFO'];
?>
<link rel="alternate" type="application/rss+xml" title="Board RSS Feed" href="<?php echo url_maker($exfile['rss'],$Settings['rss_ext'],"act=boardrss",$Settings['qstr'],$Settings['qsep'],$prexqstr['rss'],$exqstr['rss']); ?>" />
<link rel="alternate" type="application/rss+xml" title="Category RSS Feed" href="<?php echo url_maker($exfile['rss'],$Settings['rss_ext'],"act=categoryrss&subid=0",$Settings['qstr'],$Settings['qsep'],$prexqstr['rss'],$exqstr['rss']); ?>" />
<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php require($SettDir['inc'].'navbar.php');

if($_GET['act']==null)
{ $_GET['act']="view"; }
if($_GET['act']=="view")
{ require($SettDir['inc'].'forums.php'); }
if($_GET['act']=="view"||$_GET['act']=="stats")
{ require($SettDir['inc'].'stats.php'); }
require($SettDir['inc'].'endpage.php');
?>
</body>
</html>
<?php fix_amp($Settings['use_gzip']); ?>
