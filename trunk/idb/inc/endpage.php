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
if ($File3Name=="endpage.php"||$File3Name=="/endpage.php") {
	require('index.html');
	exit(); }
if ($SkinSet['CopyRightType']=="CopyRight 1") {
echo "<table class=\"crtable1\" style=\"font-size:11px; width:auto; width: 100%;\">\n<tr class=\"crtable2\">\n<td><div style=\"text-align: center;\" class=\"copyright\">Powered by: ".$iDBV3." &copy; ".GMTimeChange("Y",GMTimeSend(null),$YourOffSet)." &nbsp;<a href=\"http://cooldude2k.co.funpic.org/\">Game Maker 2k</a></div></td></tr>\n<tr class=\"crtable3\"><td><div style=\"text-align: center;\" class=\"copyright\">".$SkinSet['CopyRight']."</div></td></tr>\n</table>"; }
if ($SkinSet['CopyRightType']!="CopyRight 1") {
echo "<div class=\"copyright\">".$iDBV1."<br />\n".$SkinSet['CopyRight']."</div>"; }
mysql_close();
?>