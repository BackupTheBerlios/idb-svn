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
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="rss4.php"||$File3Name=="/rss4.php") {
	require('index.php');
	exit(); }
$boardsname = htmlentities($Settings['board_name']);
$boardsname = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $boardsname);
$_GET['feedtype'] = strtolower($_GET['feedtype']);
if($_GET['feedtype']!="rss"&&
$_GET['feedtype']!="atom") { $_GET['feedtype'] = "rss"; }
//$basepath = pathinfo($_SERVER['REQUEST_URI']);
/*if(dirname($_SERVER['REQUEST_URI'])!="."||
	dirname($_SERVER['REQUEST_URI'])!=null) {
$basedir = dirname($_SERVER['REQUEST_URI'])."/"; }*/
if(dirname($_SERVER['SCRIPT_NAME'])!="."||
	dirname($_SERVER['SCRIPT_NAME'])!=null) {
$basedir = dirname($_SERVER['SCRIPT_NAME'])."/"; }
if($basedir==null||$basedir==".") {
if(dirname($_SERVER['SCRIPT_NAME'])=="."||
	dirname($_SERVER['SCRIPT_NAME'])==null) {
$basedir = dirname($_SERVER['PHP_SELF'])."/"; } }
if($basedir=="\/") { $basedir="/"; }
$basedir = str_replace("//", "/", $basedir);
if($Settings['fixpathinfo']!=true&&
	$Settings['fixpathinfo']!=false&&
	$Settings['fixpathinfo']!=null) {
		$basedir = "/"; }
$BaseURL = $basedir;
if($_SERVER['HTTPS']=="on") { $prehost = "https://"; }
if($_SERVER['HTTPS']!="on") { $prehost = "http://"; }
if($Settings['idburl']=="localhost"||$Settings['idburl']==null) {
	$BoardURL = $prehost.$_SERVER["HTTP_HOST"].$BaseURL; }
if($Settings['idburl']!="localhost"&&$Settings['idburl']!=null) {
	$BoardURL = $Settings['idburl']; }
if($rssurlon==true) { $BoardURL =  $rssurl; }
$feedsname = basename($_SERVER['SCRIPT_NAME']);
if($_SERVER['PATH_INFO']!=null) {
$feedsname .= htmlentities($_SERVER['PATH_INFO']); }
if($_SERVER['QUERY_STRING']!=null) {
$feedsname .= "?".htmlentities($_SERVER['QUERY_STRING']); }
$checkfeedtype = "application/rss+xml";
if($_GET['feedtype']=="rss") { $checkfeedtype = "application/rss+xml"; }
if($_GET['feedtype']=="atom") { $checkfeedtype = "application/atom+xml"; }
if(stristr($_SERVER["HTTP_ACCEPT"],$checkfeedtype) ) {
@header("Content-Type: application/rss+xml; charset=".$Settings['charset']); }
else{ if(stristr($_SERVER["HTTP_ACCEPT"],"application/xml") ) {
@header("Content-Type: application/xml; charset=".$Settings['charset']); }
else { if (stristr($_SERVER["HTTP_USER_AGENT"],"FeedValidator")) {
   @header("Content-Type: application/xml; charset=".$Settings['charset']);
} else { @header("Content-Type: text/xml; charset=".$Settings['charset']); } } }
@header("Content-Language: en");
@header("Vary: Accept");
$YourOffSet=$_GET['offset'];
$CountDays = GMTimeGet("t",$YourOffSet);
$MyDay = GMTimeGet("d",$YourOffSet);
$MyDay2 = GMTimeGet("dS",$YourOffSet);
$MyDayName = GMTimeGet("l",$YourOffSet);
$MyYear = GMTimeGet("Y",$YourOffSet);
$MyMonth = GMTimeGet("m",$YourOffSet);
$MyTimeStamp1 = mktime("0","0","0",$MyMonth,"1",$MyYear);
$MyTimeStamp2 = mktime("24","59","59",$MyMonth,$CountDays,$MyYear);
$MyMonthName = GMTimeGet("F",$YourOffSet);
$FirstDayThisMouth = date("w", mktime(0, 0, 0, $MyMonth, 1, $MyYear));
$query = query("select * from ".$Settings['sqltable']."events where TimeStamp>=%i and TimeStampEnd<=%i", array($MyTimeStamp1,$MyTimeStamp2));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$Atom = null; $RSS = null; $i=0;
while ($i < $num) {
$EventID=mysql_result($result,$i,"ID");
$EventUser=mysql_result($result,$i,"UserID");
$EventName=mysql_result($result,$i,"EventName");
$EventText=mysql_result($result,$i,"EventText");
$EventStart=mysql_result($result,$is,"TimeStamp");
$EventEnd=mysql_result($result,$is,"TimeStampEnd");
$EventDay = GMTimeChange("m/d/y",$EventStart,$YourOffSet);
$EventDayEnd = GMTimeChange("m/d/y",$EventEnd,$YourOffSet);
$Atom .= '<entry>'."\n".'<title>'.htmlentities($EventName).'</title>'."\n".'<summary>Event Starts at '.$EventDay.' and ends at '.$EventDayEnd.'</summary>'."\n".'<link rel="alternate" href="'.$BoardURL.url_maker($exfilerss['event'],$Settings['file_ext'],"act=view&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstrrss['event'],$exqstrrss['event']).'" />'."\n".'<id>'.$BoardURL.url_maker($exfilerss['event'],$Settings['file_ext'],"act=view&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstrrss['event'],$exqstrrss['event']).'</id>'."\n".'<author>'."\n".'<name>'.$SettInfo['Author'].'</name>'."\n".'</author>'."\n".'<updated>'.gmdate("Y-m-d\TH:i:s\Z").'</updated>'."\n".'</entry>'."\n";
$RSS .= '<item>'."\n".'<title>'.htmlentities($EventName).'</title>'."\n".'<description>Event Starts at '.$EventDay.' and ends at '.$EventDayEnd.'</description>'."\n".'<link>'.$BoardURL.url_maker($exfilerss['event'],$Settings['file_ext'],"act=view&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstrrss['event'],$exqstrrss['event']).'</link>'."\n".'<guid>'.$BoardURL.url_maker($exfilerss['event'],$Settings['file_ext'],"act=view&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstrrss['event'],$exqstrrss['event']).'</guid>'."\n".'</item>'."\n";
++$i; } @mysql_free_result($result); ?>
<?php xml_doc_start("1.0",$Settings['charset']); ?>
<!-- generator="<?php echo version_info("iDB",$VER1,$VER3); ?>" -->
<?php if($_GET['feedtype']=="rss") { ?>
<rss version="2.0">
  <channel>
   <title><?php echo $boardsname; ?></title>
   <link><?php echo $BoardURL; ?></link>
   <description>RSS Feed of the Events on Board <?php echo $boardsname; ?></description>
   <language>en</language>
   <generator><?php echo version_info("iDB",$VER1,$VER3); ?></generator>
   <copyright><?php echo $SettInfo['Author']; ?></copyright>
   <ttl>120</ttl>  
   <image>
	<url><?php echo $BoardURL; ?>inc/rss/rss.gif</url>
	<title><?php echo $boardsname; ?></title>
	<link><?php echo $BoardURL; ?></link>
   </image>
 <?php echo "\n".$RSS."\n"; ?></channel>
</rss>
<?php } if($_GET['feedtype']=="atom") { ?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title><?php echo $boardsname; ?></title>
   <subtitle>RSS Feed of the Topics in Board <?php echo $boardsname; ?></subtitle>
   <link rel="self" href="<?php echo $feedsname; ?>" />
   <id><?php echo $BoardURL; ?></id>
   <updated><?php echo gmdate("Y-m-d\TH:i:s\Z"); ?></updated>
   <generator><?php echo version_info("iDB",$VER1,$VER3); ?></generator>
  <icon><?php echo $BoardURL.$SettDir['rss']; ?>rss.gif</icon>
 <?php echo "\n".$Atom."\n"; ?>
</feed>
<?php } mysql_close();
gzip_page($Settings['use_gzip']); ?>
