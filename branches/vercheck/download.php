<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2009-2011 iDB Support - http://idb.berlios.de/
    Copyright 2009-2011 Game Maker 2k - http://gamemaker2k.org/

    $FileInfo: index.php - Last Update: 08/02/2011 Ver 3.0.8 - Author: cooldude2k $
*/
@ini_set("html_errors", false);
@ini_set("track_errors", false);
@ini_set("display_errors", false);
@ini_set("report_memleaks", false);
@ini_set("display_startup_errors", false);
//@ini_set("error_log","logs/error.log"); 
//@ini_set("log_errors","On"); 
@ini_set("docref_ext", "");
@ini_set("docref_root", "http://php.net/");
@ini_set("date.timezone","UTC"); 
@ini_set("default_mimetype","text/html");
@error_reporting(E_ALL ^ E_NOTICE);
@set_time_limit(30); @ignore_user_abort(true);
if(function_exists("date_default_timezone_set")) { 
	@date_default_timezone_set("UTC"); }
function idb_output_handler($buffer) { return $buffer; }
@ob_start("idb_output_handler");
header("Cache-Control: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("Pragma: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("P3P: CP=\"IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"");
header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
output_reset_rewrite_vars();
$_GET['file'] = null;
if($_GET['file']==null) {
$mirrors['mirror'] = array("prdownload.berlios.de","downloads.sourceforge.net","get.idb.s1.jcink.com","ihost.net46.net","idb.gamemaker2k.org","of.openfoundry.org"); 
$mirrors['url'] = array("http://prdownload.berlios.de/idb/","http://downloads.sourceforge.net/intdb/","http://get.idb.s1.jcink.com/","http://download.ihost.net46.net/","ftp://ftp.berlios.de/pub/idb/nighty-ver/","http://of.openfoundry.org/download_path/idb/0.4.6.696/");
$mirrors['name'] = array("BerliOS","SourceForge","Get iDB @ iDB.S1.Jcink.com","Get iDB @ IHost.Net46.net","iDB Support FTP","OpenFoundry"); 
$mirrors['links'] = array("http://developer.berlios.de/projects/idb/","http://sourceforge.net/projects/intdb","http://get.idb.s1.jcink.com/","http://download.ihost.net46.net/","http://idb.gamemaker2k.org/","http://of.openfoundry.org/projects/1220");
//$files = array("iDB.zip","iDB.tar.gz","iDB.tar.bz2","iDB.tar.lzma","iDB.tar.xz","iDB.7z","iDB.deb","iDB.rpm","iDB-Host.zip","iDB-Host.tar.gz","iDB-Host.lzma","iDB-Host.tar.xz","iDB-Host.tar.bz2","iDB-Host.7z","iDB-Host.deb","iDB-Host.rpm","iDBEH-Mod.zip","iDBEH-Mod.tar.gz","iDBEH-Mod.tar.bz2","iDBEH-Mod.tar.lzma","iDBEH-Mod.tar.xz","iDBEH-Mod.7z");
$files = array("iDB.zip","iDB.tar.gz","iDB.tar.bz2","iDB.tar.xz","iDB.7z","iDB-Host.zip","iDB-Host.tar.gz","iDB-Host.tar.xz","iDB-Host.tar.bz2","iDB-Host.7z","iDBEH-Mod.zip","iDBEH-Mod.tar.gz","iDBEH-Mod.tar.bz2","iDBEH-Mod.tar.xz","iDBEH-Mod.7z","iDBEH-SubMod.zip","iDBEH-SubMod.tar.gz","iDBEH-SubMod.tar.bz2","iDBEH-SubMod.tar.xz","iDBEH-SubMod.7z","webinstaller.zip","webinstaller.tar.gz","webinstaller.tar.bz2","webinstaller.7z");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title> iDB Download List </title>
<meta http-equiv="content-language" content="en-US">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15">
<meta name="Generator" content="EditPlus">
<meta name="Author" content="Cool Dude 2k">
<meta name="Keywords" content="iDB Download List">
<meta name="Description" content="iDB Download List">
<meta name="ROBOTS" content="Index, FOLLOW">
<meta name="revisit-after" content="1 days">
<meta name="GOOGLEBOT" content="Index, FOLLOW">
<meta name="resource-type" content="document">
<meta name="distribution" content="global">
<link rel="icon" href="favicon.ico" type="image/icon">
<link rel="shortcut icon" href="favicon.ico" type="image/icon">
<?php echo "<!-- Katarzyna o_O -->"; ?>
</head>

<body>
<?php $i = 0; $num = count($mirrors['mirror']);
echo "<!-- Renee Sabonis ^_^ -->";
while($i < $num) {
$l = 0; $nums = count($files); ?>
<ul><li><a href="<?php echo $mirrors['links'][$i]; ?>"><?php echo $mirrors['name'][$i]; ?></a><ul>
<?php while($l < $nums) { ?>
	<li><a href="<?php echo $mirrors['url'][$i]; ?><?php echo $files[$l]; ?>"><?php echo $files[$l]; ?></a></li>
<?php ++$l; } 
echo "<!-- Renee Sabonis ^_^ -->"; ?>
</ul></li></ul>
<?php ++$i; } ?>
<div style="text-align: center; font-family: Sans-Serif;" id="berlioslogo">
<a href="http://developer.berlios.de/" title="BerliOS Developer Logo" onclick="window.open(this.href); return false;">
<img src="http://developer.berlios.de/bslogo.php?group_id=6135" alt="BerliOS Developer Logo" title="BerliOS Developer Logo" style="border: 0px; height: 32px; width: 124px;" /></a>
<a href="http://sourceforge.net/" title="SourceForge.NET Logo" onclick="window.open(this.href); return false;">
<img title="SourceForge.NET Logo" alt="SourceForge Logo" src="http://sourceforge.net/sflogo.php?group_id=195913&amp;type=2" style="border: 0px; height: 32px; width: 124px;" /></a><br />
<a href="http://sourceforge.jp/" title="SourceForge.JP Logo" onclick="window.open(this.href); return false;">
<img title="SourceForge.JP Logo" alt="SourceForge Logo" src="http://sourceforge.jp/sflogo.php?group_id=4684&amp;type=5" style="border: 0px; height: 32px; width: 124px;" /></a>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1754608-1");
pageTracker._trackPageview();
} catch(err) {}</script></div>
<?php echo "<!-- Dagmara O_o -->"; ?>
</body>
</html>
<?php } ?>
