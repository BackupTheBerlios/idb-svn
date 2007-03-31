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
$filewpath = $exfile['calendar'].$usefileext.$_SERVER['PATH_INFO'];
if($Settings['html_type']=="html4") { ?>
<link rel="alternate" type="application/rss+xml" title="Event RSS Feed" href="<?php echo url_maker($exfile['rss'],$Settings['rss_ext'],"act=eventrss",$Settings['qstr'],$Settings['qsep'],$prexqstr['rss'],$exqstr['rss']); ?>">
<?php } if($Settings['html_type']!="html4") { ?>
<link rel="alternate" type="application/rss+xml" title="Event RSS Feed" href="<?php echo url_maker($exfile['rss'],$Settings['rss_ext'],"act=eventrss",$Settings['qstr'],$Settings['qsep'],$prexqstr['rss'],$exqstr['rss']); ?>" />
<?php } echo "\n"; ?>
<title> <?php echo $Settings['board_name'].$idbpowertitle; ?> </title>
</head>
<body>
<?php
require($SettDir['inc'].'navbar.php');

if($_GET['act']==null) {
$_GET['act']="view"; }
if($_GET['act']=="view")
{ require($SettDir['inc'].'calendars.php'); }
require($SettDir['inc'].'endpage.php'); ?>
</body>
</html>
<?php
change_title($Settings['board_name']." ".$ThemeSet['TitleDivider']." Viewing Calendar",$Settings['use_gzip']);
?>
