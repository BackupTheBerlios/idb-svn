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
if($_GET['act']=="View"||$_GET['act']==null) {
$query = $safesql->query("select * from ".$Settings['sqltable']."events where ID=%i", array($_GET['id']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$is=0;
if($num==0) { header("Location: index.php?act=View"); }
while ($is < $num) {
$EventID=mysql_result($result,$is,"ID");
$EventUser=mysql_result($result,$is,"UserID");
$EventName=mysql_result($result,$is,"EventName");
$EventText=mysql_result($result,$is,"EventText");
$EventStart=mysql_result($result,$is,"TimeStamp");
$EventEnd=mysql_result($result,$is,"TimeStampEnd");
$EventStart = GMTimeChange("M. j Y",$EventStart,null);
$EventEnd = GMTimeChange("M. j Y",$EventEnd,null);
$requery = $safesql->query("select * from ".$Settings['sqltable']."members where ID=%i", array($EventUser));
$reresult=mysql_query($requery);
$renum=mysql_num_rows($reresult);
$rei=0;
while ($rei < $renum) {
$User1ID=$MyUserID;
$User1Name=mysql_result($reresult,$rei,"Name");
$User1Email=mysql_result($reresult,$rei,"Email");
$User1Title=mysql_result($reresult,$rei,"Title");
$User1Joined=mysql_result($reresult,$rei,"Joined");
$User1Joined=GMTimeChange("M j, Y, g:i a",$User1Joined,$YourOffSet);
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
?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span style="font-weight: bold; float: left;"><?php echo $SkinSet['TitleIcon'] ?><a href="Event.php?act=<?php echo $_GET['act']; ?>&amp;id=<?php echo $_GET['id']; ?>"><?php echo $EventName; ?></a></span><?php if($SkinSet['TopicLayout']!="Type 2") { ?>
<span style="float: right;">&nbsp;</span><?php } ?></td>
</tr>
<tr class="TableRow2">
<td class="TableRow2" style="vertical-align: center; width: 20%;">
&nbsp;<a href="#User/<?php echo $User1ID; ?>"><?php echo $User1Name; ?></a></td>
<td class="TableRow2" style="vertical-align: center; width: 80%;">
<div style="text-align: left; float: left;">
<span style="font-weight: bold;">Event Start: </span><?php echo $EventStart; ?><?php echo $SkinSet['LineDividerTopic']; ?><span style="font-weight: bold;">Event End: </span><?php echo $EventEnd; ?>
</div>
<div style="text-align: right;">&nbsp;</div>
</td>
</tr>
<tr>
<td class="TableRow3" style="vertical-align: top;">
<img src="<?php echo $User1Avatar; ?>" alt="<?php echo $User1Name; ?>'s Avatar" style="border: 0px; width: <?php echo $AvatarSize1W; ?>px; height: <?php echo $AvatarSize1H; ?>px;" /><br /><br />
<br />
Group: <?php echo $User1Group; ?><br />
Posts: <?php echo $User1PostCount; ?><br />
Joined: <?php echo $User1Joined; ?><br /><br />
</td>
<td class="TableRow3" style="vertical-align: center;">
<?php echo $EventText; ?>
<br /><br />--------------------<br />
<?php echo $User1Signature; ?>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">
<span style="float: left;">&nbsp;<a href="#Act/Email"><?php echo $SkinSet['Email']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="<?php echo $User1Website; ?>"><?php echo $SkinSet['WWW']; ?></a><?php echo $SkinSet['LineDividerTopic']; ?><a href="#Act/PM"><?php echo $SkinSet['PM']; ?></a></span>
<span style="float: right;">&nbsp;</span></td>
</tr>
<?php } ?>