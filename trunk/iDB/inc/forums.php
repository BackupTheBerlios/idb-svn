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
if ($File3Name=="boards.php"||$File3Name=="/boards.php") {
	require('index.php');
	exit(); }
$prequery = query("select * from ".$Settings['sqltable']."categories where ShowCategory='on' and InSubForum=0", array());
$preresult=mysql_query($prequery);
$prenum=mysql_num_rows($preresult);
$prei=0;
while ($prei < $prenum) {
$CategoryID=mysql_result($preresult,$prei,"ID");
$CategoryName=mysql_result($preresult,$prei,"Name");
$CategoryShow=mysql_result($preresult,$prei,"ShowCategory");
$CategoryDescription=mysql_result($preresult,$prei,"Description");
/*	Toggle Code	*/
$query2 = query("select * from ".$Settings['sqltable']."forums where ShowForum='yes' and CategoryID='%s' and InSubForum=0", array($CategoryID));
$result2=mysql_query($query2);
$num2=mysql_num_rows($result2);
$i2=0;
$toggle="";
while ($i2 < $num2) {
$ForumID=mysql_result($result2,$i2,"ID");
$i3=$i2+1;
if ($i3!=$num2) {
$toggle=$toggle."toggletag('Forum".$ForumID."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('Forum".$ForumID."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('Cat".$CategoryID."'),toggletag('CatEnd".$CategoryID."');return false;"; }
++$i2; }
if($toggle==null) { $toggle="toggletag('Cat".$CategoryID."'),toggletag('CatEnd".$CategoryID."');return false;"; } 
@mysql_free_result($result2);
?>
<div class="Table1Border">
<table class="Table1">
<tr class="TableRow1">
<td class="TableRow1" colspan="5"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['category'],$Settings['file_ext'],"act=view&id=".$CategoryID,$Settings['qstr'],$Settings['qsep'],$prexqstr['category'],$exqstr['category']); ?>" id="Toggle<?php echo $CategoryID; ?>"><?php echo $CategoryName; ?></a></span>
<span style="float: right;"><a href="<?php echo $filewpath; ?>#Toggle<?php echo $CategoryID; ?>" onclick="<?php echo $toggle; ?>"><?php echo $ThemeSet['Toggle']; ?></a><?php echo $ThemeSet['ToggleExt']; ?></span></td>
</tr>
<?php
$query = query("select * from ".$Settings['sqltable']."forums where ShowForum='yes' and CategoryID=%i and InSubForum=0 ORDER BY ID", array($CategoryID));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
if($num>=1) {
?>
<tr id="Cat<?php echo $CategoryID; ?>" class="TableRow2">
<th class="TableRow2" style="width: 4%;">&nbsp;</th>
<th class="TableRow2" style="width: 58%;">Forum</th>
<th class="TableRow2" style="width: 7%;">Topics</th>
<th class="TableRow2" style="width: 7%;">Posts</th>
<th class="TableRow2" style="width: 24%;">Last Topic</th>
</tr>
<?php }
while ($i < $num) {
$ForumID=mysql_result($result,$i,"ID");
$ForumName=mysql_result($result,$i,"Name");
$ForumShow=mysql_result($result,$i,"ShowForum");
$ForumType=mysql_result($result,$i,"ForumType");
$NumTopics=mysql_result($result,$i,"NumTopics");
$NumPosts=mysql_result($result,$i,"NumPosts");
$ForumDescription=mysql_result($result,$i,"Description");
$ForumType = strtolower($ForumType);
unset($LastTopic);
$gltquery = query("select * from ".$Settings['sqltable']."topics where CategoryID=%i and ForumID=%i ORDER BY LastUpdate DESC", array($CategoryID,$ForumID));
$gltresult=mysql_query($gltquery);
$gltnum=mysql_num_rows($gltresult);
if($gltnum>0){
$TopicID=mysql_result($gltresult,0,"ID");
$TopicName=mysql_result($gltresult,0,"TopicName");
$NumReplys=mysql_result($gltresult,0,"NumReply");
$ShowReply = $NumReplys + 1;
$TopicName1 = substr($TopicName,0,12);
if (strlen($TopicName)>12) { $TopicName1 = $TopicName1."..."; }
$UsersID=mysql_result($gltresult,0,"UserID");
$GuestName=mysql_result($gltresult,0,"GuestName");
$UsersName = GetUserName($UsersID,$Settings['sqltable']);
$UsersName1 = substr($UsersName,0,18);
if($UsersName=="Guest") { $UsersName=$GuestName;
if($UsersName==null) { $UsersName="Guest"; } }
if (strlen($UsersName)>15) { $UsersName1 = $UsersName1."...";
$oldtopicname=$TopicName; $oldusername=$UsersName;
$TopicName=$TopicName1; $UsersName=$UsersName1; }
$LastTopic = "User: <a href=\"".url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$UsersID,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member'])."\" title=\"".$oldusername."\">".$UsersName."</a><br />\nTopic: <a href=\"".url_maker($exfile['topic'],$Settings['file_ext'],"act=view&id=".$TopicID,$Settings['qstr'],$Settings['qsep'],$prexqstr['topic'],$exqstr['topic'])."#post".$ShowReply."\" title=\"".$oldtopicname."\">".$TopicName."</a>"; }
if($LastTopic==null) { $LastTopic="&nbsp;<br />&nbsp;"; }
$ForumType = strtolower($ForumType);
$PreForum = $ThemeSet['ForumIcon'];
if ($ForumType=="forum") {
	$PreForum=$ThemeSet['ForumIcon']; }
if ($ForumType=="subforum") {
	$PreForum=$ThemeSet['SubForumIcon']; }
if ($ForumType=="redirect") {
	$PreForum=$ThemeSet['RedirectIcon']; }
?>
<tr class="TableRow3" id="Forum<?php echo $ForumID; ?>">
<td class="TableRow3"><div class="forumicon">
<?php echo $PreForum; ?></div></td>
<td class="TableRow3"><div class="forumname"><a href="<?php echo url_maker($exfile[$ForumType],$Settings['file_ext'],"act=view&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr[$ForumType],$exqstr[$ForumType]); ?>"><?php echo $ForumName; ?></a></div>
<div class="forumdescription"><?php echo $ForumDescription; ?></div></td>
<td class="TableRow3" style="text-align: center;"><?php echo $NumTopics; ?></td>
<td class="TableRow3" style="text-align: center;"><?php echo $NumPosts; ?></td>
<td class="TableRow3"><?php echo $LastTopic; ?></td>
</tr>
<?php
++$i; } @mysql_free_result($result);
if($num>=1) {
?>
<tr id="CatEnd<?php echo $CategoryID; ?>" class="TableRow4">
<td class="TableRow4" colspan="5">&nbsp;</td>
</tr>
<?php } ?>
</table></div>
<div>&nbsp;</div>
<?php
++$prei; }
@mysql_free_result($preresult); ?>