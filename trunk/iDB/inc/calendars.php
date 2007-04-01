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
if ($File3Name=="calendars.php"||$File3Name=="/calendars.php") {
	require('index.php');
	exit(); }
// Count the Days in this month
$MyTimeStamp = GMTimeStamp();
$CountDays = GMTimeGet("t",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyDay = GMTimeGet("j",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyDay2 = GMTimeGet("jS",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyDayName = GMTimeGet("l",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyYear = GMTimeGet("Y",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyYear2 = GMTimeGet("y",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyMonth = GMTimeGet("m",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyTimeStamp1 = mktime("0","0","0",$MyMonth,"1",$MyYear);
$MyTimeStamp2 = mktime("24","59","59",$MyMonth,$CountDays,$MyYear);
$MyMonthName = GMTimeGet("F",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$FirstDayThisMouth = date("w", mktime(0, 0, 0, $MyMonth, 1, $MyYear));
$EventsName = array();
$query = query("select * from ".$Settings['sqltable']."events where TimeStamp>=%i and TimeStampEnd<=%i", array($MyTimeStamp1,$MyTimeStamp2));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$is=0;
while ($is < $num) {
$EventID=mysql_result($result,$is,"ID");
$EventUser=mysql_result($result,$is,"UserID");
$EventGuest=mysql_result($result,$is,"GuestName");
$EventName=mysql_result($result,$is,"EventName");
$EventText=mysql_result($result,$is,"EventText");
$EventStart=mysql_result($result,$is,"TimeStamp");
$EventEnd=mysql_result($result,$is,"TimeStampEnd");
$EventDay = GMTimeChange("j",$EventStart,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$EventDayEnd = GMTimeChange("j",$EventEnd,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$oldeventname=$EventName;
$EventName1 = substr($EventName,0,10);
if (strlen($EventName)>10) { $EventName1 = $EventName1."..."; }
$EventName=$EventName1;
if ($EventsName[$EventDay] != null) {
	$EventsName[$EventDay] .= ",\n\r<a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>";	 }
if ($EventsName[$EventDay] == null) {
	$EventsName[$EventDay] = "<a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>"; }
if ($EventDay<$EventDayEnd) {
$NextDay = $EventDay+1;
$EventDayEnd = $EventDayEnd+1;
while ($NextDay < $EventDayEnd) {
if ($EventsName[$NextDay] != null) {
	$EventsName[$NextDay] .= ",\n\r<a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>";	 }
if ($EventsName[$NextDay] == null) {
	$EventsName[$NextDay] = "<a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>"; }
$NextDay++; } }
$EventsID[$EventDay] = $EventID;
$is++;
} @mysql_free_result($result);
$MyDays = array();
$MyDays[] = "Sunday";
$MyDays[] = "Monday";
$MyDays[] = "Tuesday";
$MyDays[] = "Wednesday";
$MyDays[] = "Thursday";
$MyDays[] = "Friday";
$MyDays[] = "Saturday";
$DayNames = "";
foreach ($MyDays as $x => $y) {
    $DayNames .= '<th class="TableRow2" style="width: 12%;">' . $y . '</th>'."\r\n";
}
$WeekDays = "";
$i = $FirstDayThisMouth + 1;
if ($FirstDayThisMouth != "0") {
    $WeekDays .= '<td class="TableRow3" align="center" colspan="' . $FirstDayThisMouth . '">&nbsp;</td>'."\r\n";
}
$Day_i = "1";
$ii = $i;
for ($i; $i <= ($CountDays + $FirstDayThisMouth) ;$i++) {
if ($ii == 8) {
$WeekDays .= "</tr><tr class=\"TableRow3\">"."\r\n";
$ii = 1; }
 if ($MyDay == $Day_i) {
$Extra = 'class="TableRow3"'; }
else {
$Extra = 'class="TableRow2"'; }
if ($Day_i != $_GET['HighligtDay']) {
if ($Day_i != $MyDay) {
$WeekDays .= '<td class="TableRow3" style="height: 60px; vertical-align: top;">' . $Day_i . '<div style="text-align: left;">' . $EventsName[$Day_i] . '</div></td>'."\r\n";	 }	}
if ($Day_i == $MyDay) {
$WeekDays .= '<td class="TableRow3" style="height: 60px; vertical-align: top;">' . $Day_i . '<div style="text-align: left;">' . $EventsName[$Day_i] . '</div></td>'."\r\n";	 }
$Day_i++;
$ii++;
}
if ((8 - $ii) >= "1") {
$WeekDays .= '<td class="TableRow3" align="center" colspan="' . (8 - $ii) . '">&nbsp;</td>'."\r\n"; } ?>
<div class="Table1Border">
<table class="Table1"><tr class="TableRow1">
<th class="TableRow1" colspan="7">
<span style="float: left;"><?php echo $ThemeSet['TitleIcon']; ?><?php echo "Today is ".$MyDayName." the ".$MyDay2." of ".$MyMonthName.", ".$MyYear; ?></span>
<span style="float: right;"><?php echo "The time is ".GMTimeGet('g:i a',$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']); ?>&nbsp;</span>
</th>
</tr><tr class="TableRow2">
<?php echo $DayNames; ?>
</tr><tr class="TableRow3">
<?php echo $WeekDays; ?>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="7">&nbsp;</td>
</tr>
</table></div>
<div>&nbsp;</div>