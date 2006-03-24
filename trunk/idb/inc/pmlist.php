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
if ($File3Name=="pmlist.php"||$File3Name=="/pmlist.php") {
	require('index.html');
	exit(); }
$safesql =& new SafeSQL_MySQL;
if($_GET['act']=="View") {
?>
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="6"><span class="textright">&nbsp;</span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Messenger.php?act=View">MailBox(<?php echo $PMNumber; ?>)</a></td>
</tr>
<tr id="Messenger" class="TableRow2">
<th class="TableRow2" style="width: 50%;">Message Name</th>
<th class="TableRow2" style="width: 25%;">Sender</th>
<th class="TableRow2" style="width: 25%;">Time</th>
</tr>
<?php
$query = $safesql->query("select * from ".$Settings['sqltable']."messenger where `PMSentID` = %i ORDER BY DateSend DESC", array($_SESSION['UserID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$PMID=mysql_result($result,$i,"id");
$SenderID=mysql_result($result,$i,"SenderID");
$SenderName = GetUserName($SenderID,$Settings['sqltable']);
$SentToID=mysql_result($result,$i,"PMSentID");
$SentToName = GetUserName($SentToID,$Settings['sqltable']);
$MessageName=mysql_result($result,$i,"MessageTitle");
$DateSend=mysql_result($result,$i,"DateSend");
$DateSend=GMTimeChange("F j, Y, g:i a",$DateSend,$YourOffSet);
?>
<tr class="TableRow3" id="Message<?php echo $PMID; ?>">
<td class="TableRow3"><div class="messagename">
<a href="Messenger.php?act=Read&amp;id=<?php echo $PMID; ?>"><?php echo $MessageName; ?></a></div></td>
<td class="TableRow3" style="text-align: center;"><a href="#<?php echo $SenderID; ?>"><?php echo $SenderName; ?></a></td>
<td class="TableRow3" style="text-align: center;"><?php echo $DateSend; ?></td>
</tr>
<?php ++$i; } ?>
<tr id="ForumEnd" class="TableRow4">
<td class="TableRow4" colspan="6">&nbsp;</td>
</tr>
</table>
<?php } 
if($_GET['act']=="ViewSent") {
?>
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="6"><span class="textright">&nbsp;</span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Messenger.php?act=View">MailBox(<?php echo $PMNumber; ?>)</a></td>
</tr>
<tr id="Messenger" class="TableRow2">
<th class="TableRow2" style="width: 50%;">Message Name</th>
<th class="TableRow2" style="width: 25%;">Sent To</th>
<th class="TableRow2" style="width: 25%;">Time</th>
</tr>
<?php
$query = $safesql->query("select * from ".$Settings['sqltable']."messenger where `SenderID` = %i ORDER BY DateSend DESC", array($_SESSION['UserID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$PMID=mysql_result($result,$i,"id");
$SenderID=mysql_result($result,$i,"SenderID");
$SenderName = GetUserName($SenderID,$Settings['sqltable']);
$SentToID=mysql_result($result,$i,"PMSentID");
$SentToName = GetUserName($SentToID,$Settings['sqltable']);
$MessageName=mysql_result($result,$i,"MessageTitle");
$DateSend=mysql_result($result,$i,"DateSend");
$DateSend=GMTimeChange("F j, Y, g:i a",$DateSend,$YourOffSet);
?>
<tr class="TableRow3" id="Message<?php echo $PMID; ?>">
<td class="TableRow3"><div class="messagename">
<a href="Messenger.php?act=Read&amp;id=<?php echo $PMID; ?>"><?php echo $MessageName; ?></a></div></td>
<td class="TableRow3" style="text-align: center;"><a href="#<?php echo $SentToID; ?>"><?php echo $SentToName; ?></a></td>
<td class="TableRow3" style="text-align: center;"><?php echo $DateSend; ?></td>
</tr>
<?php ++$i; } ?>
<tr id="ForumEnd" class="TableRow4">
<td class="TableRow4" colspan="6">&nbsp;</td>
</tr>
</table>
<?php } ?>