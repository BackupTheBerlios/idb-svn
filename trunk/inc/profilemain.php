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
if ($File3Name=="profilemain.php"||$File3Name=="/profilemain.php") {
	require('index.html');
	exit(); }
$safesql =& new SafeSQL_MySQL;
if($_GET['act']=="View") {
$query = $safesql->query("select * from ".$Settings['sqltable']."members where `id`=%i", array($_SESSION['UserID']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
$YourID=mysql_result($result,$i,"id");
$Notes=mysql_result($result,$i,"Notes");
?>
<table class="Table1" style="width: 100%;">
<tr class="TableRow1">
<td class="TableRow1" colspan="6"><span class="textright">&nbsp;</span>
<?php echo $SkinSet['TitleIcon'] ?><a href="Profile.php?act=View">Profile Editer</a></td>
</tr>
<tr id="Messenger" class="TableRow2">
<th class="TableRow2">NotePad</th>
</tr>
<tr class="TableRow3" id="NotePad">
<td class="TableRow3" colspan="1">
<form method="post" action=""><div style="text-align: center;">
<label for="NotePad">Your NotePad</label><br />
<textarea class="TextBox" name="NotePad" id="NotePad" style="width: 75%; height: 128px;" rows="10" cols="84"><?php echo $Notes; ?></textarea>
<br /><input type="submit" class="Button" value="Save" />&nbsp;<input class="Button" type="reset" />
</div></form></td>
</tr>
<tr id="ForumEnd" class="TableRow4">
<td class="TableRow4" colspan="1">&nbsp;</td>
</tr>
</table>
<?php } ?>