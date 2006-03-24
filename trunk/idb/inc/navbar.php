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
if ($File3Name=="navbar.php"||$File3Name=="/navbar.php") {
	require('index.html');
	exit(); }
if($_SESSION['UserGroup']!=$Settings['GuestGroup']) {
$safesql =& new SafeSQL_MySQL;
$pmquery1 = $safesql->query("select * from ".$Settings['sqltable']."messenger where `PMSentID` = %i and `Read` = 0", array($_SESSION['UserID']));
$pmresult1=mysql_query($pmquery1);
$PMNumber=mysql_num_rows($pmresult1);
$pmquery2 = $safesql->query("select * from ".$Settings['sqltable']."messenger where `SenderID` = %i and `Read` = 0", array($_SESSION['UserID']));
$pmresult2=mysql_query($pmquery2);
$SentPMNumber=mysql_num_rows($pmresult2); }
?>
<table class="NavBar1" style="width: 100%;">
<tr class="NavBar2">
<td class="NavBar2"><a title="<?php echo $Settings['board_name']; ?> (Powered by <?php echo $iDB; ?>)" href="index.php?act=View"><?php echo $SkinSet['Logo']; ?></a></td>
</tr>
<tr class="NavBar3">
<td class="NavBar3"><span class="textleft">&nbsp;<?php if($_SESSION['UserGroup']==$Settings['GuestGroup']) {?>Welcome ( <a href="Members.php?act=login">Log in</a><?php echo $SkinSet['LineDivider']; ?><a href="Members.php?act=signup">Register</a> )<?php } if($_SESSION['UserGroup']!=$Settings['GuestGroup']) { ?>Logged as: <a href="#<?php echo $_SESSION['UserID']; ?>"><?php echo $_SESSION['MemberName']; ?></a> ( <a href="Members.php?act=logout">Log out</a> )<?php } ?></span><span class="textright"><?php if($_SESSION['UserGroup']!=$Settings['GuestGroup']) { ?><a href="Profile.php?act=View">Profile</a><?php echo $SkinSet['LineDivider']; ?><a href="Messenger.php?act=View">MailBox(<?php echo $PMNumber; ?>)</a><?php echo $SkinSet['LineDivider']; ?><?php } ?><a href="Calendar.php?act=View">Calendar</a><?php echo $SkinSet['LineDivider']; ?><a href="TagBoard.php?act=View">TagBoard</a>&nbsp;</span></td>
</tr>
</table>