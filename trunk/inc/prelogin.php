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
$_SESSION['CheckCookie']="done";
$safesql =& new SafeSQL_MySQL;
$querylog2 = $safesql->query("select * from ".$Settings['sqltable']."members where Name = '%s' and Password='%s'", array($_COOKIE['MemberName'],$_COOKIE['SessPass']));
$resultlog2=mysql_query($querylog2);
$numlog2=mysql_num_rows($resultlog2);
if($numlog2>=1) {
$il=0;
$YourIDAM=mysql_result($resultlog2,$il,"id");
$YourGroupAM=mysql_result($resultlog2,$il,"GroupID");
$gquery = $safesql->query("select * from ".$Settings['sqltable']."groups where ID=%i", array($YourGroupAM));
$gresult=mysql_query($gquery);
$YourGroupAM=mysql_result($gresult,0,"Name");
$YourTimeZoneAM=mysql_result($resultlog2,$il,"TimeZone");
$NewDay=GMTimeSend(null);
$NewIP=$_SERVER['REMOTE_ADDR'];
$queryup = $safesql->query("update ".$Settings['sqltable']."members set LastActive='%s',IP='%s' WHERE id='%s'", array($NewDay,$NewIP,$YourIDAM));
$_SESSION['MemberName']=$_COOKIE['MemberName'];
$_SESSION['UserID']=$YourIDAM;
setcookie("UserID", $YourIDAM, time() + (7 * 86400));
} if($numlog2<=0) {
header("Location: Members.php?act=logout");
}
?>