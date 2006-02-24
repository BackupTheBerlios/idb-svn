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
if ($File3Name=="RSS5.php"||$File3Name=="/RSS5.php") {
	require('index.html');
	exit(); }
require( 'MySQL.php');
$BoardURL = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";
$BoardURL = preg_replace("/misc/isxS", "", $BoardURL);
header("Content-type: application/xml");
if ($_GET['Validate']=="RSS"||$_GET['validate']=="RSS") {
	$NEW["REQUEST_URI"] = preg_replace("/\?Validate\=RSS/isxS", "?Renee=Awesome", $_SERVER["REQUEST_URI"]);
	$NEW["REQUEST_URI"] = preg_replace("/\&Validate\=RSS/isxS", "", $NEW["REQUEST_URI"]);
	header('Location: http://validator.w3.org/feed/check.cgi?url='.urlencode('http://'.$_SERVER["HTTP_HOST"].$NEW["REQUEST_URI"])); }
if ($act=="Download") {
header('Content-Disposition: attachment; filename="'.$Settings['board_name'].'.xml"'); }
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
$safesql =& new SafeSQL_MySQL;
$query = $safesql->query("select * from ".$Settings['sqltable']."events where TimeStamp>=%i and TimeStampEnd<=%i", array($MyTimeStamp1,$MyTimeStamp2));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$EventID=mysql_result($result,$i,"ID");
$EventUser=mysql_result($result,$i,"UserID");
$EventName=mysql_result($result,$i,"EventName");
$EventText=mysql_result($result,$i,"EventText");
$EventStart=mysql_result($result,$is,"TimeStamp");
$EventEnd=mysql_result($result,$is,"TimeStampEnd");
$EventDay = GMTimeChange("m/d/y",$EventStart,$YourOffSet);
$EventDayEnd = GMTimeChange("m/d/y",$EventEnd,$YourOffSet);
$One = $One.'<rdf:li rdf:resource="'.$BoardURL.'Event.php?id='.$EventID.'"/>'."\n\r";
$Two = $Two.'<item>'."\n\r".'<title>'.htmlentities($EventName).'</title>'."\n\r".'<description>Event Starts at '.$EventDay.' and ends at '.$EventDayEnd.'</description>'."\n\r".'<link>'.$BoardURL.'Event.php?act=View&amp;id='.$EventID.'</link>'."\n\r".'</item>'."\n\r";
++$i; } ?>
<?php xml_doc_start("1.0","iso-8859-15"); ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
   <title><?php echo htmlentities($Settings['board_name']); ?></title>
   <link><?php echo $BoardURL; ?></link>
   <description>RSS Feed of the Events on Board <?php echo htmlentities($Settings['board_name']); ?></description>
   <language>en-us</language>
   <generator>Edit Plus v2.12</generator>
   <copyright>Game Maker 2k© 2004</copyright>
   <ttl>120</ttl>  
   <image>
	<url><?php echo $BoardURL; ?>Pics/xml.gif</url>
	<title><?php echo htmlentities($Settings['board_name']); ?></title>
	<link><?php echo $BoardURL; ?></link>
   </image>
 <?php echo "\n\r".$Two."\n\r"; ?></channel>
</rss>
<?php mysql_close(); ?>