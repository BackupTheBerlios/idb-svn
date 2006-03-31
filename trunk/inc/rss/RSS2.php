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
*/
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="RSS2.php"||$File3Name=="/RSS2.php") {
	require('index.html');
	exit(); }
require( 'MySQL.php');
$BoardURL = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";
$BoardURL = preg_replace("/misc/isxS", "", $BoardURL);
if ($_GET['id']==null) { $_GET['id']="1"; }
if ($_GET['Validate']=="RSS"||$_GET['validate']=="RSS") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=RSS/isxS", "?Renee=Awesome", $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=RSS/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://validator.w3.org/feed/check.cgi?url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
header("Content-type: application/xml");
$safesql =& new SafeSQL_MySQL;
$query = $safesql->query("select * from ".$Settings['sqltable']."topics where ForumID=%i and CategoryID=%i ORDER BY Pinned DESC, LastUpdate DESC", array($_GET['id'],$_GET['CatID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
unset($safesql);
$i=0;
while ($i < $num) {
$TopicID=mysql_result($result,$i,"ID");
$CategoryID=mysql_result($result,$i,"CategoryID");
$UsersID=mysql_result($result,$i,"UserID");
$GuestName=mysql_result($result,$i,"GuestName");
$TheTime=mysql_result($result,$i,"TimeStamp");
$TopicName=mysql_result($result,$i,"TopicName");
$ForumDescription=mysql_result($result,$i,"Description");
$One = $One.'<rdf:li rdf:resource="'.$BoardURL.'Topic.php?id='.$TopicID.'&amp;ForumID='.$_GET['id'].'&amp;CatID='.$CategoryID.'"/>'."\n";
$Two = $Two.'<item>'."\n".'<title>'.htmlentities($TopicName).'</title>'."\n".'<description>'.htmlentities($ForumDescription).'</description>'."\n".'<link>'.$BoardURL.'Topic.php?id='.$TopicID.'&amp;ForumID='.$_GET['id'].'&amp;CatID='.$CategoryID.'</link>'."\n".'<guid>'.$BoardURL.'Topic.php?id='.$TopicID.'&amp;ForumID='.$_GET['id'].'&amp;CatID='.$CategoryID.'</guid>'."\n".'</item>'."\n";
++$i; }
if ($act=="Download") {
header('Content-Disposition: attachment; filename="'.$Settings['board_name'].'.xml"'); } ?>
<?php xml_doc_start("1.0","iso-8859-15"); ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
   <title><?php echo htmlentities($Settings['board_name']); ?></title>
   <description>RSS Feed of the Topics in Board <?php echo htmlentities($Settings['board_name']); ?></description>
   <link><?php echo $BoardURL; ?></link>
   <language>en-us</language>
   <generator>Edit Plus v2.12</generator>
   <copyright>Game Maker 2k© 2004</copyright>
   <ttl>120</ttl>
   <image>
	<url><?php echo $BoardURL; ?>Pics/xml.gif</url>
	<title><?php echo htmlentities($Settings['board_name']); ?></title>
	<link><?php echo $BoardURL; ?></link>
   </image>
 <?php echo "\n".$Two."\n"; ?></channel>
</rss>
<?php mysql_close(); ?>