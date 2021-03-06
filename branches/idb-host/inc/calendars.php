<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2012 iDB Support - http://idb.berlios.de/
    Copyright 2004-2012 Game Maker 2k - http://gamemaker2k.org/

    $FileInfo: calendars.php - Last Update: 12/30/2011 SVN 781 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="calendars.php"||$File3Name=="/calendars.php") {
	require('index.php');
	exit(); }
$_SESSION['ViewingPage'] = url_maker(null,"no+ext","act=view","&","=",null,null);
if($Settings['file_ext']!="no+ext"&&$Settings['file_ext']!="no ext") {
$_SESSION['ViewingFile'] = $exfile['calendar'].$Settings['file_ext']; }
if($Settings['file_ext']=="no+ext"||$Settings['file_ext']=="no ext") {
$_SESSION['ViewingFile'] = $exfile['calendar']; }
$_SESSION['PreViewingTitle'] = "Viewing";
$_SESSION['ViewingTitle'] = "Calendar";
if(!isset($_GET['HighligtDay'])) { $_GET['HighligtDay'] = null; }
if(!isset($_GET['calmadd'])) { $_GET['calmadd'] = 0; }
if(!is_numeric($_GET['calmadd'])) { $_GET['calmadd'] = 0; }
$nextcalm = $_GET['calmadd'] + 1;
$backcalm = $_GET['calmadd'] - 1;
if($_GET['calmadd']===0||$_GET['calmadd']=="0") {
$calmounthaddd = ($_GET['calmadd'] * $dayconv['month']); }
if($_GET['calmadd']!==0&&$_GET['calmadd']!="0") {
$calmounthaddd = ($_GET['calmadd'] * $dayconv['month']) + ($dayconv['day'] * 1); }
// Extra month stuff
$MyRealMonthNum1 = GMTimeGet("m",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$MyRealYear = GMTimeGet("Y",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
// Count the Days in this month
$MyTimeStamp = GMTimeStamp() + $calmounthaddd;
$CountDays = GMTimeGet("t",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyDay = GMTimeGet("j",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyDay2 = GMTimeGet("jS",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyDayNum = GMTimeGet("d",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyDayName = GMTimeGet("l",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyYear = GMTimeGet("Y",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyYear2 = GMTimeGet("y",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyMonth = GMTimeGet("m",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyTimeStamp1 = mktime(0,0,0,$MyMonth,1,$MyYear);
$MyTimeStamp2 = mktime(23,59,59,$MyMonth,$CountDays,$MyYear);
$MyMonthName = GMTimeGet("F",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyMonthNum1 = GMTimeGet("m",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$MyMonthNum2 = GMTimeGet("n",$_SESSION['UserTimeZone'],0,$_SESSION['UserDST'],$calmounthaddd);
$FirstDayThisMonth = date("w", mktime(0, 0, 0, $MyMonth, 1, $MyYear));
$EventsName = array();
$query = sql_pre_query("SELECT * FROM \"".$Settings['sqltable']."events\" WHERE (\"EventMonth\">=%i AND \"EventYear\"<%i AND \"EventYearEnd\">=%i) OR (\"EventMonth\"<=%i AND \"EventMonthEnd\">=%i AND \"EventYearEnd\">=%i) OR (\"EventMonth\"<=%i AND \"EventMonthEnd\"<=%i AND \"EventYear\"<=%i AND \"EventYearEnd\">%i)",  array($MyMonth,$MyYear,$MyYear,$MyMonth,$MyMonth,$MyYear,$MyMonth,$MyMonth,$MyYear,$MyYear));
$result=sql_query($query,$SQLStat);
$num=sql_num_rows($result);
$is=0;
while ($is < $num) {
$EventID=sql_result($result,$is,"id");
$EventUser=sql_result($result,$is,"UserID");
$EventGuest=sql_result($result,$is,"GuestName");
$EventName=sql_result($result,$is,"EventName");
$EventText=sql_result($result,$is,"EventText");
$EventStart=sql_result($result,$is,"TimeStamp");
$EventEnd=sql_result($result,$is,"TimeStampEnd");
//$EventMonth=sql_result($result,$is,"EventMonth");
$EventMonth=GMTimeChange("m",$EventStart,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
//$EventMonthEnd=sql_result($result,$is,"EventMonthEnd");
$EventMonthEnd=GMTimeChange("m",$EventEnd,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
//$EventDay=sql_result($result,$is,"EventDay");
$EventDay=GMTimeChange("j",$EventStart,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
//$EventDayEnd=sql_result($result,$is,"EventDayEnd");
$EventDayEnd=GMTimeChange("j",$EventEnd,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
//$EventYear=sql_result($result,$is,"EventYear");
$EventYear=GMTimeChange("Y",$EventStart,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
//$EventYearEnd=sql_result($result,$is,"EventYearEnd");
$EventYearEnd=GMTimeChange("Y",$EventEnd,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
if($EventMonthEnd!=$MyMonth) { $EventDayEnd = $CountDays; }
if($EventMonth<$MyMonth) { $EventDay = 1; }
$oldeventname=$EventName;
$EventName1 = pre_substr($EventName,0,20);
if (pre_strlen($EventName)>20) { $EventName1 = $EventName1."..."; }
$EventName=$EventName1;
if(!isset($EventsName[$EventDay])) { $EventsName[$EventDay] = null; }
if ($EventsName[$EventDay] != null) {
	$EventsName[$EventDay] .= ", <a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>";	 }
if ($EventsName[$EventDay] == null) {
	$EventsName[$EventDay] = "<a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>"; }
if ($EventDay<$EventDayEnd) {
$NextDay = $EventDay+1;
$EventDayEnd = $EventDayEnd+1;
while ($NextDay < $EventDayEnd) {
if(!isset($EventsName[$NextDay])) { $EventsName[$NextDay] = null; }
if ($EventsName[$NextDay] != null) {
	$EventsName[$NextDay] .= ", <a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>";	 }
if ($EventsName[$NextDay] == null) {
	$EventsName[$NextDay] = "<a href=\"".url_maker($exfile['event'],$Settings['file_ext'],"act=event&id=".$EventID,$Settings['qstr'],$Settings['qsep'],$prexqstr['event'],$exqstr['event'])."\" style=\"font-size: 9px;\" title=\"View Event ".$oldeventname.".\">".$EventName."</a>"; }
$NextDay++; } }
$EventsID[$EventDay] = $EventID;
++$is; } 
sql_free_result($result);
$bdquery = sql_pre_query("SELECT * FROM \"".$Settings['sqltable']."members\" WHERE \"BirthMonth\"=%i", array($MyMonth));
$bdresult=sql_query($bdquery,$SQLStat);
$bdnum=sql_num_rows($bdresult);
$bdi=0;
while ($bdi < $bdnum) {
$UserNamebd=sql_result($bdresult,$bdi,"Name");
$BirthDay=sql_result($bdresult,$bdi,"BirthDay");
$BirthMonth=sql_result($bdresult,$bdi,"BirthMonth");
$BirthYear=sql_result($bdresult,$bdi,"BirthYear");
$oldusername=$UserNamebd;
$UserNamebd1 = pre_substr($UserNamebd,0,20);
if (pre_strlen($UserNamebd)>20) { $UserNamebd1 = $UserNamebd1."..."; }
$UserNamebd=$UserNamebd1;
if(!isset($EventsName[$BirthDay])) { $EventsName[$BirthDay] = null; }
if ($EventsName[$BirthDay] != null) {
	$EventsName[$BirthDay] .= ", <span title=\"".$oldusername."'s birthday.\">".$UserNamebd1."</span>";	 }
if ($EventsName[$BirthDay] == null) {
	$EventsName[$BirthDay] = "<span title=\"".$oldusername."'s birthday.\">".$UserNamebd1."</span>"; }
++$bdi; } 
sql_free_result($bdresult);
$MyDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
$DayNames = "";
foreach ($MyDays as $x => $y) {
    $DayNames .= '<th class="CalTableColumn2" style="width: 12%;">' . $y . '</th>'."\r\n";
}
$WeekDays = "";
$i = $FirstDayThisMonth + 1;
if ($FirstDayThisMonth != "0") {
    $WeekDays .= '<td class="CalTableColumn3Blank" style="text-align: center;" colspan="' . $FirstDayThisMonth . '">&nbsp;</td>'."\r\n";
}
$Day_i = "1";
$ii = $i;
for ($i; $i <= ($CountDays + $FirstDayThisMonth) ;$i++) {
if ($ii == 8) {
$WeekDays .= "</tr><tr class=\"CalTableRow3\">"."\r\n";
$ii = 1; }
 if ($MyDay == $Day_i && $MyMonthNum1 == $MyRealMonthNum1 && $MyYear == $MyRealYear) {
$Extra = 'CalTableColumn3Current'; }
else {
$Extra = 'CalTableColumn3'; }
if ($Day_i != $_GET['HighligtDay']) {
if(!isset($EventsName[$Day_i])) { $EventsName[$Day_i] = null; }
if($EventsName[$Day_i]!=null) { $EventsName[$Day_i] = "&nbsp;( ".$EventsName[$Day_i]." )"; }
if ($Day_i != $MyDay) {
$WeekDays .= '<td class="'.$Extra.'" style="vertical-align: top;"><div class="CalDate">' . $Day_i . '</div>' . $EventsName[$Day_i] . '</td>'."\r\n";	 }	}
if ($Day_i == $MyDay) {
$WeekDays .= '<td class="'.$Extra.'" style="vertical-align: top;"><div class="CalDateCurrent">' . $Day_i  . '</div>' . $EventsName[$Day_i] . '</td>'."\r\n";	 }
$Day_i++;
$ii++;
}
if ((8 - $ii) >= "1") {
$WeekDays .= '<td class="CalTableColumn3Blank" style="text-align: center;" colspan="' . (8 - $ii) . '">&nbsp;</td>'."\r\n"; } ?>
<div class="NavLinks"><?php echo $ThemeSet['NavLinkIcon']; ?><a href="<?php echo url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index']); ?>"><?php echo $Settings['board_name']; ?></a><?php echo $ThemeSet['NavLinkDivider']; ?><a href="<?php echo url_maker($exfile['calendar'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['calendar'],$exqstr['calendar']); ?>">Calendar</a></div>
<div class="DivNavLinks">&nbsp;</div>
<div class="CalTable1Border">
<?php if($ThemeSet['TableStyle']=="div") { ?>
<div class="CalTableRow1" style="font-weight: bold;">
<span style="float: left;"><?php echo $ThemeSet['TitleIcon']; ?><?php echo "Viewing ".$MyMonthName." ".$MyYear; ?>&nbsp;</span>&nbsp;
<span style="float: right;">&nbsp;<a href="<?php echo url_maker($exfile['calendar'],$Settings['file_ext'],"act=view&calmadd=".$backcalm,$Settings['qstr'],$Settings['qsep'],$prexqstr['calendar'],$exqstr['calendar']); ?>">&lt;</a><?php echo $ThemeSet['LineDivider']; ?><a href="<?php echo url_maker($exfile['calendar'],$Settings['file_ext'],"act=view&calmadd=".$nextcalm,$Settings['qstr'],$Settings['qsep'],$prexqstr['calendar'],$exqstr['calendar']); ?>">&gt;</a>&nbsp;</span>&nbsp;</div>
<?php } ?>
<table class="CalTable1">
<?php if($ThemeSet['TableStyle']=="table") { ?>
<tr class="CalTableRow1">
<th class="CalTableColumn1" colspan="7">
<span style="float: left;"><?php echo $ThemeSet['TitleIcon']; ?><?php echo "Viewing ".$MyMonthName." ".$MyYear; ?>&nbsp;</span>&nbsp;
<span style="float: right;">&nbsp;<a href="<?php echo url_maker($exfile['calendar'],$Settings['file_ext'],"act=view&calmadd=".$backcalm,$Settings['qstr'],$Settings['qsep'],$prexqstr['calendar'],$exqstr['calendar']); ?>">&lt;</a><?php echo $ThemeSet['LineDivider']; ?><a href="<?php echo url_maker($exfile['calendar'],$Settings['file_ext'],"act=view&calmadd=".$nextcalm,$Settings['qstr'],$Settings['qsep'],$prexqstr['calendar'],$exqstr['calendar']); ?>">&gt;</a>&nbsp;</span>&nbsp;
</th>
</tr><?php } ?>
<tr class="CalTableRow2">
<?php echo $DayNames; ?>
</tr><tr class="CalTableRow3">
<?php echo $WeekDays; ?>
</tr>
<tr class="CalTableRow4">
<td class="CalTableColumn4" colspan="7">&nbsp;</td>
</tr>
</table></div>
<div class="DivCalendar">&nbsp;</div>
