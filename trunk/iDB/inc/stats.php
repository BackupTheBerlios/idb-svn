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

    $FileInfo: stats.php - Last Update: 04/04/2007 SVN 33 - Author: cooldude2k $
*/
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="stats.php"||$File3Name=="/stats.php") {
	require('index.php');
	exit(); }
if($_GET['act']=="view"||$_GET['act']=="stats") {
$toggle = "toggletag('Stats1'),toggletag('Stats2'),toggletag('Stats3');return false;";
$ntquery = query("select * from ".$Settings['sqltable']."topics", array(null));
$ntresult = mysql_query($ntquery);
$numtopics = mysql_num_rows($ntresult);
$npquery = query("select * from ".$Settings['sqltable']."posts", array(null));
$npresult = mysql_query($npquery);
$numposts = mysql_num_rows($npresult);
$nmquery = query("select * from ".$Settings['sqltable']."members", array(null));
$nmresult = mysql_query($nmquery);
$nummembers = mysql_num_rows($nmresult);
?>
<div class="Table1Border">
<table class="Table1">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a id="bstats" href="<?php echo $filewpath; ?>#bstats">Board Statistics</a></span>
<span style="float: right;"><a href="<?php echo $filewpath; ?>#Toggle<?php echo $CategoryID; ?>" onclick="<?php echo $toggle; ?>"><?php echo $ThemeSet['Toggle']; ?></a><?php echo $ThemeSet['ToggleExt']; ?></span></td>
</tr>
<tr id="Stats1" class="TableRow2">
<td class="TableRow2" colspan="2" style="width: 100%; font-weight: bold;">Board Stats</td>
</tr>
<tr class="TableRow3" id="Stats2">
<td style="width: 4%;" class="TableRow3"><div class="forumicon">
<?php echo $ThemeSet['StatsIcon']; ?>&nbsp;</div></td>
<td style="width: 96%;" class="TableRow3"><div class="forumname">
&nbsp;Our members have made a total of <?php echo $numposts; ?> post(s)<br />
&nbsp;We have a total of <?php echo $numtopics; ?> topic(s) made<br />
&nbsp;We have <?php echo $nummembers; ?> registered members<br />
</div></td>
</tr>
<tr id="Stats3" class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
</table></div>
<div>&nbsp;</div>
<?php
@mysql_free_result($ntresult);
@mysql_free_result($npresult);
@mysql_free_result($nmresult); }
?>