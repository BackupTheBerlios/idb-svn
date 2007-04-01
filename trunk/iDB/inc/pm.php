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
if ($File3Name=="pm.php"||$File3Name=="/pm.php") {
	require('index.php');
	exit(); }
?>
<table class="Table3">
<tr style="width: 100%; vertical-align: top;">
	<td style="width: 15%; vertical-align: top;">
	<div class="Table1Border">
	<table class="Table1" style="width: 100%; float: left; vertical-align: top;">
<tr class="TableRow1">
<td class="TableRow1"><?php echo $ThemeSet['TitleIcon'] ?>Messenger</td>
</tr><tr class="TableRow2">
<td class="TableRow2">&nbsp;</td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>">View MailBox</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=viewsent",$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>">View SentBox</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="#<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=send",$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>">Send Message</a></td>
</tr><tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr></table></div>
</td>
	<td style="width: 85%; vertical-align: top;">
<?php
if($_GET['act']=="view") {
?>
<div class="Table1Border">
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="6"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>">MailBox(<?php echo $PMNumber; ?>)</a>
</span><span style="float: right;">&nbsp;</span></td>
</tr>
<tr id="Messenger" class="TableRow2">
<th class="TableRow2" style="width: 4%;">State</th>
<th class="TableRow2" style="width: 46%;">Message Name</th>
<th class="TableRow2" style="width: 25%;">Sender</th>
<th class="TableRow2" style="width: 25%;">Time</th>
</tr>
<?php
$query = query("select * from ".$Settings['sqltable']."messenger where `PMSentID` = %i ORDER BY DateSend DESC", array($_SESSION['UserID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$PMID=mysql_result($result,$i,"id");
$SenderID=mysql_result($result,$i,"SenderID");
$SenderName = GetUserName($SenderID,$Settings['sqltable']);
$SentToID=mysql_result($result,$i,"PMSentID");
$SentToName = GetUserName($SentToID,$Settings['sqltable']);
$PMGuest=mysql_result($result,$i,"GuestName");
$MessageName=mysql_result($result,$i,"MessageTitle");
$MessageDesc=mysql_result($result,$i,"Description");
$DateSend=mysql_result($result,$i,"DateSend");
$DateSend=GMTimeChange("F j, Y, g:i a",$DateSend,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MessageStat=mysql_result($result,$i,"Read");
if($SenderName=="Guest") { $SenderName=$PMGuest;
if($SenderName==null) { $SenderName="Guest"; } }
$PreMessage = $ThemeSet['MessageUnread'];
if ($MessageStat==0) {
	$PreMessage=$ThemeSet['MessageUnread']; }
if ($MessageStat==1) {
	$PreMessage=$ThemeSet['MessageRead']; }
?>
<tr class="TableRow3" id="Message<?php echo $PMID; ?>">
<td class="TableRow3"><div class="messagestate">
<?php echo $PreMessage; ?></div></td>
<td class="TableRow3"><div class="messagename">
<a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=read&id=".$PMID,$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>"><?php echo $MessageName; ?></a></div>
<div class="messagedesc"><?php echo $MessageDesc; ?></div></td>
<td class="TableRow3" style="text-align: center;"><a href="<?php echo url_maker($exfile['member'],$Settings['file_ext'],"act=read&id".$SenderID,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']); ?>"><?php echo $SenderName; ?></a></td>
<td class="TableRow3" style="text-align: center;"><?php echo $DateSend; ?></td>
</tr>
<?php ++$i; } @mysql_free_result($result); ?>
<tr id="ForumEnd" class="TableRow4">
<td class="TableRow4" colspan="6">&nbsp;</td>
</tr>
<?php } 
if($_GET['act']=="viewsent") {
?>
<div class="Table1Border">
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="6"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>">MailBox(<?php echo $PMNumber; ?>)</a>
</span><span style="float: right;">&nbsp;</span></td>
</tr>
<tr id="Messenger" class="TableRow2">
<th class="TableRow2" style="width: 4%;">State</th>
<th class="TableRow2" style="width: 46%;">Message Name</th>
<th class="TableRow2" style="width: 25%;">Sent To</th>
<th class="TableRow2" style="width: 25%;">Time</th>
</tr>
<?php
$query = query("select * from ".$Settings['sqltable']."messenger where `SenderID` = %i ORDER BY DateSend DESC", array($_SESSION['UserID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$PMID=mysql_result($result,$i,"id");
$SenderID=mysql_result($result,$i,"SenderID");
$SenderName = GetUserName($SenderID,$Settings['sqltable']);
$SentToID=mysql_result($result,$i,"PMSentID");
$SentToName = GetUserName($SentToID,$Settings['sqltable']);
$PMGuest=mysql_result($result,$i,"GuestName");
$MessageName=mysql_result($result,$i,"MessageTitle");
$MessageDesc=mysql_result($result,$i,"Description");
$DateSend=mysql_result($result,$i,"DateSend");
$DateSend=GMTimeChange("F j, Y, g:i a",$DateSend,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MessageStat=mysql_result($result,$i,"Read");
if($SenderName=="Guest") { $SenderName=$PMGuest;
if($SenderName==null) { $SenderName="Guest"; } }
$PreMessage = $ThemeSet['MessageUnread'];
if ($MessageStat==0) {
	$PreMessage=$ThemeSet['MessageUnread']; }
if ($MessageStat==1) {
	$PreMessage=$ThemeSet['MessageRead']; }
?>
<tr class="TableRow3" id="Message<?php echo $PMID; ?>">
<td class="TableRow3"><div class="messagestate">
<?php echo $PreMessage; ?></div></td>
<td class="TableRow3"><div class="messagename">
<a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=read&id=".$PMID,$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>"><?php echo $MessageName; ?></a></div>
<div class="messagedesc"><?php echo $MessageDesc; ?></div></td>
<td class="TableRow3" style="text-align: center;"><a href="<?php echo url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$SentToID,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']); ?>"><?php echo $SentToName; ?></a></td>
<td class="TableRow3" style="text-align: center;"><?php echo $DateSend; ?></td>
</tr>
<?php ++$i; } ?>
<tr id="ForumEnd" class="TableRow4">
<td class="TableRow4" colspan="6">&nbsp;</td>
</tr>
<?php } @mysql_free_result($result);
if($_GET['act']=="read") {
$query = query("select * from ".$Settings['sqltable']."messenger where ID=%i", array($_GET['id']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$is=0;
if($num==0) { redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false)); }
while ($is < $num) {
$PMID=mysql_result($result,$is,"id");
$SenderID=mysql_result($result,$is,"SenderID");
$SenderName = GetUserName($SenderID,$Settings['sqltable']);
$SentToID=mysql_result($result,$is,"PMSentID");
$SentToName = GetUserName($SentToID,$Settings['sqltable']);
$PMGuest=mysql_result($result,$is,"GuestName");
$MessageName=mysql_result($result,$is,"MessageTitle");
$DateSend=mysql_result($result,$is,"DateSend");
$DateSend=GMTimeChange("F j, Y, g:i a",$DateSend,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MessageText=mysql_result($result,$is,"MessageText");
$MessageDesc=mysql_result($result,$i,"Description");
$requery = query("select * from ".$Settings['sqltable']."members where ID=%i", array($SenderID));
$reresult=mysql_query($requery);
$renum=mysql_num_rows($reresult);
$rei=0;
if($_SESSION['UserID']!=$SentToID&&
	$_SESSION['UserID']!=$SenderID) {
redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false)); }
while ($rei < $renum) {
$User1ID=$SenderID;
$User1Name=mysql_result($reresult,$rei,"Name");
$User1Email=mysql_result($reresult,$rei,"Email");
$User1Title=mysql_result($reresult,$rei,"Title");
$User1Joined=mysql_result($reresult,$rei,"Joined");
$User1Joined=GMTimeChange("M j Y",$User1Joined,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$User1GroupID=mysql_result($reresult,$rei,"GroupID");
$gquery = query("select * from ".$Settings['sqltable']."groups where ID=%i", array($User1GroupID));
$gresult=mysql_query($gquery);
$User1Group=mysql_result($gresult,0,"Name");
@mysql_free_result($gresult);
$User1Signature=mysql_result($reresult,$rei,"Signature");
$User1Avatar=mysql_result($reresult,$rei,"Avatar");
$User1AvatarSize=mysql_result($reresult,$rei,"AvatarSize");
if ($User1Avatar=="http://"||$User1Avatar==null) {
$User1Avatar=$ThemeSet['NoAvatar'];
$User1AvatarSize=$ThemeSet['NoAvatarSize']; }
$AvatarSize1=explode("x", $User1AvatarSize);
$AvatarSize1W=$AvatarSize1[0]; $AvatarSize1H=$AvatarSize1[1];
$User1Website=mysql_result($reresult,$rei,"Website");
$User1PostCount=mysql_result($reresult,$rei,"PostCount");
$User1IP=mysql_result($reresult,$rei,"IP");
++$rei; } @mysql_free_result($reresult);
++$is; } @mysql_free_result($result);
if($_SESSION['UserID']==$SentToID) {
$queryup = query("update ".$Settings['sqltable']."messenger set `Read`=%i WHERE id=%i", array(1,$_GET['id']));
mysql_query($queryup); }
if($User1Name=="Guest") { $User1Name=$PMGuest;
if($User1Name==null) { $User1Name="Guest"; } }
$MessageText = text2icons($MessageText,$Settings['sqltable']);
$User1Signature = text2icons($User1Signature,$Settings['sqltable']);
?>
<div class="Table1Border">
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span style="font-weight: bold; float: left;"><?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['messenger'],$Settings['file_ext'],"act=view&id=".$_GET['id'],$Settings['qstr'],$Settings['qsep'],$prexqstr['messenger'],$exqstr['messenger']); ?>"><?php echo $MessageName; ?></a></span><?php if($ThemeSet['TopicLayout']!="Type 2") { ?>
<span style="float: right;">&nbsp;</span><?php } ?></td>
</tr>
<tr class="TableRow2">
<td class="TableRow2" style="vertical-align: middle; width: 20%;">
&nbsp;<a href="<?php echo url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$User1ID,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']); ?>"><?php echo $User1Name; ?></a></td>
<td class="TableRow2" style="vertical-align: middle; width: 80%;">
<div style="text-align: left; float: left;">
<span style="font-weight: bold;">Time Sent: </span><?php echo $DateSend; ?>
</div>
<div style="text-align: right;">&nbsp;</div>
</td>
</tr>
<tr>
<td class="TableRow3" style="vertical-align: top;">
 <?php  /* Avatar Table Thanks For SeanJ's Help at http://seanj.jcink.com/ */  ?>
 <table class="AvatarTable" style="width: 100px; height: 100px; text-align: center;">
	<tr class="AvatarRow" style="width: 100%; height: 100%;">
		<td class="AvatarRow" style="width: 100%; height: 100%; text-align: center; vertical-align: middle;">
		<img src="<?php echo $User1Avatar; ?>" alt="<?php echo $User1Name; ?>'s Avatar" style="border: 0px; width: <?php echo $AvatarSize1W; ?>px; height: <?php echo $AvatarSize1H; ?>px;" />
		</td>
	</tr>
 </table><br />
User Title: <?php echo $User1Title; ?><br />
Group: <?php echo $User1Group; ?><br />
Member: <?php echo $User1ID; ?><br />
Posts: <?php echo $User1PostCount; ?><br />
Joined: <?php echo $User1Joined; ?><br /><br />
</td>
<td class="TableRow3" style="vertical-align: middle;">
<div class="pmpost"><?php echo $MessageText; ?></div>
<?php if(isset($User1Signature)) { ?> <br />--------------------
<div class="signature"><?php echo $User1Signature; ?></div><?php } ?>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">
<span style="float: left;">&nbsp;<a href="<?php echo url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$User1ID,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']); ?>"><?php echo $ThemeSet['Profile']; ?></a><?php echo $ThemeSet['LineDividerTopic']; ?><a href="<?php echo $User1Website; ?>" onclick="window.open(this.href);return false;"><?php echo $ThemeSet['WWW']; ?></a><?php echo $ThemeSet['LineDividerTopic']; ?><a href="#Act/PM"><?php echo $ThemeSet['PM']; ?></a></span>
<span style="float: right;">&nbsp;</span></td></tr>
<?php } ?>
</table></div>
</td></tr>
</table>