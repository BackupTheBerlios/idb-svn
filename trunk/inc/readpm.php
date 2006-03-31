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
if ($File3Name=="events.php"||$File3Name=="/events.php") {
	require('index.html');
	exit(); }
$safesql =& new SafeSQL_MySQL;
if($_GET['act']=="Read") {
$query = $safesql->query("select * from ".$Settings['sqltable']."messenger where ID=%i", array($_GET['id']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$is=0;
if($num==0) { header("Location: index.php?act=View"); }
while ($is < $num) {
$PMID=mysql_result($result,$is,"id");
$SenderID=mysql_result($result,$is,"SenderID");
$SenderName = GetUserName($SenderID,$Settings['sqltable']);
$SentToID=mysql_result($result,$is,"PMSentID");
$SentToName = GetUserName($SentToID,$Settings['sqltable']);
$MessageName=mysql_result($result,$is,"MessageTitle");
$DateSend=mysql_result($result,$is,"DateSend");
$DateSend=GMTimeChange("F j, Y, g:i a",$DateSend,$YourOffSet);
$MessageText=mysql_result($result,$is,"MessageText");
$requery = $safesql->query("select * from ".$Settings['sqltable']."members where ID=%i", array($SenderID));
$reresult=mysql_query($requery);
$renum=mysql_num_rows($reresult);
$rei=0;
if($_SESSION['UserID']!=$SentToID&&
	$_SESSION['UserID']!=$SenderID) {
header('Location: index.php'); }
while ($rei < $renum) {
$User1ID=$SenderID;
$User1Name=mysql_result($reresult,$rei,"Name");
$User1Email=mysql_result($reresult,$rei,"Email");
$User1Title=mysql_result($reresult,$rei,"Title");
$User1Joined=mysql_result($reresult,$rei,"Joined");
$User1Joined=GMTimeChange("M j Y",$User1Joined,$YourOffSet);
$User1GroupID=mysql_result($reresult,$rei,"GroupID");
$gquery = $safesql->query("select * from ".$Settings['sqltable']."groups where ID=%i", array($User1GroupID));
$gresult=mysql_query($gquery);
$User1Group=mysql_result($gresult,0,"Name");
$User1Signature=mysql_result($reresult,$rei,"Signature");
$User1Avatar=mysql_result($reresult,$rei,"Avatar");
$User1AvatarSize=mysql_result($reresult,$rei,"AvatarSize");
if ($User1Avatar=="http://"||$User1Avatar==null) {
$User1Avatar=$SkinSet['NoAvatar'];
$User1AvatarSize=$SkinSet['NoAvatarSize']; }
$AvatarSize1=explode("x", $User1AvatarSize);
$AvatarSize1W=$AvatarSize1[0];
$AvatarSize1H=$AvatarSize1[1];
$User1Website=mysql_result($reresult,$rei,"Website");
$User1PostCount=mysql_result($reresult,$rei,"PostCount");
$User1IP=mysql_result($reresult,$rei,"IP");
++$rei; }
++$is; }
if($_SESSION['UserID']==$SentToID) {
$queryup = $safesql->query("update ".$Settings['sqltable']."messenger set `Read`=%i WHERE id=%i", array(1,$_GET['id']));
mysql_query($queryup); }
?>
<div class="Table1Border">
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span style="font-weight: bold; float: left;"><?php echo $SkinSet['TitleIcon'] ?><a href="Messenger.php?act=Read&amp;id=<?php echo $_GET['id']; ?>"><?php echo $MessageName; ?></a></span><?php if($SkinSet['TopicLayout']!="Type 2") { ?>
<span style="float: right;">&nbsp;</span><?php } ?></td>
</tr>
<tr class="TableRow2">
<td class="TableRow2" style="vertical-align: center; width: 20%;">
&nbsp;<a href="#User/<?php echo $User1ID; ?>"><?php echo $User1Name; ?></a></td>
<td class="TableRow2" style="vertical-align: center; width: 80%;">
<div style="text-align: left; float: left;">
<span style="font-weight: bold;">Time Sent: </span><?php echo $DateSend; ?>
</div>
<div style="text-align: right;">&nbsp;</div>
</td>
</tr>
<tr>
<td class="TableRow3" style="vertical-align: top;">
<img src="<?php echo $User1Avatar; ?>" alt="<?php echo $User1Name; ?>'s Avatar" style="border: 0px; width: <?php echo $AvatarSize1W; ?>px; height: <?php echo $AvatarSize1H; ?>px;" /><br /><br />
User Title: <?php echo $User1Title; ?><br />
Group: <?php echo $User1Group; ?><br />
Member: <?php echo $User1ID; ?><br />
Posts: <?php echo $User1PostCount; ?><br />
Joined: <?php echo $User1Joined; ?><br /><br />
</td>
<td class="TableRow3" style="vertical-align: center;">
<?php echo $MessageText; ?>
<br /><br />--------------------<br />
<?php echo $User1Signature; ?>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">
<span style="float: left;">&nbsp;<a href="#Act/Email"><?php echo $SkinSet['Email']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="<?php echo $User1Website; ?>"><?php echo $SkinSet['WWW']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/PM"><?php echo $SkinSet['PM']; ?></a></span>
<span style="float: right;">&nbsp;</span></td></tr>
<?php } ?>
</table></div>