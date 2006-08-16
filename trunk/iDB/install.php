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

    Copyright 2004-2006 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2006 Game Maker 2k - http://cooldude2k.co.funpic.org/
    Emoticons made by Jcink http://tfbb.jcink.com/
*/
$preact['idb'] = "installing"; 
if ($_GET['act']==null) { $_GET['act']="Part1"; }
if ($_POST['act']==null) { $_POST['act']="Part1"; }
require('preindex.php'); ?>

<title> <?php echo "Installing ".version_info("iDB",$VER1,$VER3)." on ".$OSType2; ?> </title>
</head>
<body>
<?php require('inc/navbar.php'); ?>

<table class="Table1" width="100%">
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textleft">
&nbsp;<a href="Install.php">Install <?php echo version_info("iDB",$VER1,$VER3)." on ".$OSType2; ?> </a></span>
<span class="textright">&nbsp;</span></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">
<span class="textleft">&nbsp;Inert your install info: </span>
<span class="textright">&nbsp;</span>
</th>
</tr>
<?php
if($_SERVER['HTTPS']=="on") { $prehost = "https://"; }
if($_SERVER['HTTPS']!="on") { $prehost = "http://"; }
if(dirname($_SERVER['SCRIPT_NAME'])!=".") {
$this_dir = dirname($_SERVER['SCRIPT_NAME'])."/"; }
if(dirname($_SERVER['SCRIPT_NAME'])==".") {
$this_dir = dirname($_SERVER['PHP_SELF'])."/"; }
if($this_dir=="\/") { $this_dir="/"; }
$idbdir = addslashes(str_replace("\\","/",dirname(__FILE__)."/"));
function sql_list_dbs() {
   $result = mysql_query("SHOW DATABASES;");
   while( $data = mysql_fetch_row($result) ) {
       $array[] = $data[0];
   } return $array; }
if ($_GET['act']!="Part2"&&$_POST['act']!="Part2") {
if ($_GET['act']!="Part3"&&$_POST['act']!="Part3") {
?>
<tr class="TableRow3">
<td class="TableRow3">
<form method="post" name="install" id="install" action="install.php?act=Part2">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 50%;"><label for="DatabaseUserName">Insert Database User Name:</label></td>
	<td style="width: 50%;"><input type="text" name="DatabaseUserName" class="TextBox" id="DatabaseUserName" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="DatabasePassword">Insert Database Password:</label></td>
	<td style="width: 50%;"><input type="password" name="DatabasePassword" class="TextBox" id="DatabasePassword" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="DatabaseHost">Insert Database Host:</label></td>
	<td style="width: 50%;"><input type="text" name="DatabaseHost" class="TextBox" id="DatabaseHost" size="20" value="localhost" /></td>
</tr></table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<input type="hidden" name="act" value="Part2" style="display: none;" />
<input type="submit" class="Button" value="Next Page" name="Install_Board" />
<input type="reset" value="Reset Form" class="Button" name="Reset_Form" />
</td></tr></table>
</form>
</td>
</tr>
<?php } }
if ($_GET['act']=="Part2"&&$_POST['act']=="Part2") {
if ($_GET['act']!="Part3"&&$_POST['act']!="Part3") {
?>
<tr class="TableRow3">
<td class="TableRow3">
<?php
$checkfile="settings.php";
if (!is_writable($checkfile)) {
   echo "<br />Settings is not writable.";
   @chmod("settings.php",0755); $Error="Yes";
   @chmod("settingsbak.php",0755);
} else { /* settings.php is writable install iDB. ^_^ */ }
$StatSQL = @mysql_connect($_POST['DatabaseHost'],$_POST['DatabaseUserName'],$_POST['DatabasePassword']);
if(!$StatSQL) { $Error="Yes";
echo "<br />".mysql_errno().": ".mysql_error()."\n"; }
if ($Error!="Yes") {
$pretext = "<?php\n/*\n    This program is free software; you can redistribute it and/or modify\n    it under the terms of the GNU General Public License as published by\n    the Free Software Foundation; either version 2 of the License, or\n    (at your option) any later version.\n\n    This program is distributed in the hope that it will be useful,\n    but WITHOUT ANY WARRANTY; without even the implied warranty of\n    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the\n    GNU General Public License for more details.\n\n    Copyright 2004-2006 Cool Dude 2k - http://idb.berlios.de/\n    Copyright 2004-2006 Game Maker 2k - http://cooldude2k.co.funpic.org/\n    Emoticons made by Jcink http://tfbb.jcink.com/\n*/\n";
$BoardSettings=$pretext."\$Settings['sqlhost'] = '".$_POST['DatabaseHost']."';\n\$Settings['sqluser'] = '".$_POST['DatabaseUserName']."';\n\$Settings['sqlpass'] = '".$_POST['DatabasePassword']."';\n?>";
$fp = fopen("./settings.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
//	@cp("settings.php","settingsbak.php");
$fp = fopen("./settingsbak.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
?>
<form method="post" name="install" id="install" action="install.php?act=Part3">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 50%;"><label for="NewBoardName">Insert Board Name:</label></td>
	<td style="width: 50%;"><input type="text" name="NewBoardName" class="TextBox" id="NewBoardName" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="DatabaseName">Insert Database Name:</label></td>
	<td style="width: 50%;"><input type="text" name="DatabaseName" class="TextBox" id="DatabaseName" size="20" />
	<?php /*<select id="dblist" name="dblist" class="TextBox" onchange="document.install.DatabaseName.value=this.value">
	<option value=" ">none on list</option>
	<?php $dblist = sql_list_dbs();
	$num = count($dblist); $i = 0;
	while ($i < $num) {
		echo "<option value=\"".$dblist[$i]."\">";
		echo $dblist[$i]."</option>\n";
		++$i;
	} ?></select><?php */ ?></td>
</tr><tr>
	<td style="width: 50%;"><label for="tableprefix">Insert Table Prefix:<br /></label></td>
	<td style="width: 50%;"><input type="text" name="tableprefix" class="TextBox" id="tableprefix" value="idb_" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="AdminUser">Insert Admin User Name:</label></td>
	<td style="width: 50%;"><input type="text" name="AdminUser" class="TextBox" id="AdminUser" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="AdminPassword">Insert Admin Password:</label></td>
	<td style="width: 50%;"><input type="password" name="AdminPasswords" class="TextBox" id="AdminPassword" size="20" maxlength="30" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="ReaPassword">ReInsert Admin Password:</label></td>
	<td style="width: 50%;"><input type="password" class="TextBox" name="ReaPassword" size="20" id="ReaPassword" maxlength="30" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="BoardURL">Insert The Board URL or localhost to use any url:</label></td>
	<td style="width: 50%;"><input type="text" class="TextBox" name="BoardURL" size="20" id="BoardURL" value="<?php echo $prehost.$_SERVER['HTTP_HOST'].$this_dir; ?>" /></td>
</tr><tr>
	<td style="width: 50%;"><label for="UseGzip">Do you want to GZip Pages:</label></td>
	<td style="width: 50%;"><select size="1" class="TextBox" name="GZip" id="UseGzip">
	<option value="false">No</option>
	<option value="true">Yes</option>
	</select></td>
</tr><tr>
	<td style="width: 50%;"><label for="HTMLType">HTML Type to use:</label></td>
	<td style="width: 50%;"><select size="1" class="TextBox" name="HTMLType" id="HTMLType">
	<option value="xhtml10">XHTML 1.0</option>
	<option value="xhtml11">XHTML 1.1</option>
	<option value="html4">HTML 4.01</option>
	</select></td>
</tr><tr>
	<td style="width: 50%;"><label for="HTMLLevel">HTML level only for XHTML 1.0/HTML 4.01:</label></td>
	<td style="width: 50%;"><select size="1" class="TextBox" name="HTMLLevel" id="HTMLLevel">
	<option value="Transitional">Transitional</option>
	<option value="Strict">Strict</option>
	</select></td>
</tr><tr>
	<td style="width: 50%;"><label for="OutPutType">Output file as:</label></td>
	<td style="width: 50%;"><select size="1" class="TextBox" name="OutPutType" id="OutPutType">
	<option value="html">HTML</option>
	<option value="xhtml">XHTML</option>
	</select></td>
</tr><tr>
	<td style="width: 50%;"><label title="Store userinfo as a cookie so you dont need to login again." for="storecookie">Store as cookie?</label></td>
	<td style="width: 50%;"><select id="storecookie" name="storecookie" class="TextBox">
<option value="true">Yes</option>
<option value="false">No</option>
</select></td>
</tr><tr>
	<td style="width: 50%;"><label for="unlink">Delete Installer When Done?</label></td>
	<td style="width: 50%;"><select id="unlink" name="unlink" class="TextBox">
<option value="true">Yes</option>
<option value="false">No</option>
</select></td>
</tr></table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<input type="hidden" name="act" value="Part3" style="display: none;" />
<input type="submit" class="Button" value="Install Board" name="Install_Board" />
<input type="reset" value="Reset Form" class="Button" name="Reset_Form" />
</td></tr></table>
</form>
</td>
</tr>
<?php } } }
if ($_GET['act']!="Part2"&&$_POST['act']!="Part2") {
if ($_GET['act']=="Part3"&&$_POST['act']=="Part3") {
require_once('settings.php');
$_POST['DatabaseHost'] = $Settings['sqlhost'];
$_POST['DatabaseUserName'] = $Settings['sqluser'];
$_POST['DatabasePassword'] = $Settings['sqlpass'];
?>
<tr class="TableRow3" style="text-align: center;">
<td class="TableRow3" colspan="2">
<?php
$_POST['tableprefix'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_POST['tableprefix']);
if($_POST['tableprefix']==null) { $_POST['tableprefix']="idb_"; }
if($_POST['sessprefix']==null) { $_POST['sessprefix']="idb_"; }
$checkfile="settings.php";
if (!is_writable($checkfile)) {
   echo "<br />Settings is not writable.";
   @chmod("settings.php",0755); $Error="Yes";
   @chmod("settingsbak.php",0755);
} else { /* settings.php is writable install iDB. ^_^ */ }
@session_name($_POST['tableprefix']."sess");
@session_start();
if (strlen($_POST['AdminPasswords'])<="3") { $Error="Yes";
echo "<br />Your password is too small."; }
if (strlen($_POST['AdminUser'])<="3") { $Error="Yes";
echo "<br />Your user name is too small."; }
if (strlen($_POST['AdminPasswords'])>="30") { $Error="Yes";
echo "<br />Your password is too big."; }
if (strlen($_POST['AdminUser'])>="20") { $Error="Yes";
echo "<br />Your user name is too big."; }
if ($_POST['AdminPasswords']!=$_POST['ReaPassword']) { $Error="Yes";
echo "<br />Your passwords did not match."; }
if($_POST['HTMLType']=="xhtml11") { $_POST['HTMLLevel']="Strict"; }
if($_POST['BoardURL']=="http://localhost/"||$_POST['BoardURL']=="http://localhost") {
	$_POST['BoardURL'] = "localhost"; }
if($_POST['BoardURL']=="https://localhost/"||$_POST['BoardURL']=="https://localhost") {
	$_POST['BoardURL'] = "localhost"; }
$_POST['BoardURL'] = addslashes($_POST['BoardURL']);
$YourDate = GMTimeSend(null);
/* Fix The User Info for iDB */
$_POST['NewBoardName'] = htmlentities($_POST['NewBoardName'], ENT_QUOTES);
$_POST['NewBoardName'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['NewBoardName']);
//$_POST['AdminPassword'] = stripcslashes(htmlentities($_POST['AdminPassword'], ENT_QUOTES));
//$_POST['AdminPassword'] = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $_POST['AdminPassword']);
$_POST['AdminUser'] = stripcslashes(htmlspecialchars($_POST['AdminUser'], ENT_QUOTES));
$_POST['AdminUser'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['AdminUser']);
/* We are done now with fixing the info. ^_^ */
$mydbtest = @ConnectMysql($_POST['DatabaseHost'],$_POST['DatabaseUserName'],$_POST['DatabasePassword'],$_POST['DatabaseName']);
if($mydbtest!=true) { $Error="Yes";
echo "<br />".mysql_errno().": ".mysql_error()."\n"; }
if ($Error!="Yes") {
$query="CREATE TABLE `".$_POST['tableprefix']."categorys` ( `ID` int(15) NOT NULL auto_increment, `Name` varchar(150) NOT NULL default '', `ShowCategory` varchar(5) NOT NULL default '', `InSubForum` int(15) NOT NULL default '0', `Description` text NOT NULL, PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."forums` ( `ID` int(15) NOT NULL auto_increment, `CategoryID` int(15) NOT NULL default '0', `Name` varchar(150) NOT NULL default '', `ShowForum` varchar(5) NOT NULL default '', `ForumType` varchar(15) NOT NULL default '', `InSubForum` int(15) NOT NULL default '0', `Description` text NOT NULL, `PostCountAdd` varchar(15) NOT NULL default '', `NumPosts` int(15) NOT NULL default '0', `NumTopics` int(15) NOT NULL default '0', PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."help` ( `ID` int(15) NOT NULL default '0', `HelpName` text NOT NULL, `HelpText` text NOT NULL) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."events` ( `ID` int(15) NOT NULL auto_increment, `UserID` int(15) NOT NULL default '0', `EventName` varchar(150) NOT NULL default '', `EventText` text NOT NULL, `TimeStamp` int(15) NOT NULL default '0', `TimeStampEnd` int(15) NOT NULL default '0', PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."members` ( `id` int(15) NOT NULL auto_increment, `Name` varchar(150) NOT NULL default '', `Password` varchar(150) NOT NULL default '', `HashType` varchar(50) NOT NULL default '', `Email` varchar(150) NOT NULL default '', `GroupID` int(15) NOT NULL default '0', `Validated` varchar(20) NOT NULL default '', `WarnLevel` int(10) NOT NULL default '0', `Interests` varchar(150) NOT NULL default '', `Title` varchar(150) NOT NULL default '', `Joined` int(15) NOT NULL default '0', `LastActive` int(15) NOT NULL default '0', `Signature` text NOT NULL, `Notes` text NOT NULL, `Avatar` varchar(150) NOT NULL default '', `AvatarSize` varchar(10) NOT NULL default '', `Website` varchar(150) NOT NULL default '', `Gender` varchar(15) NOT NULL default '', `PostCount` int(15) NOT NULL default '0', `TimeZone` varchar(5) NOT NULL default '0', `DST` varchar(5) NOT NULL default '0', `UseSkin` varchar(5) NOT NULL default '0', `IP` varchar(20) NOT NULL default '', `Salt` varchar(50) NOT NULL default '', PRIMARY KEY  (`id`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."messenger` ( `id` int(15) NOT NULL auto_increment, `SenderID` int(15) NOT NULL default '0', `PMSentID` int(15) NOT NULL default '0', `MessageTitle` varchar(150) NOT NULL default '', `MessageText` text NOT NULL, `DateSend` int(15) NOT NULL default '0', `Read` int(5) NOT NULL default '0', PRIMARY KEY  (`id`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."posts` ( `ID` int(15) NOT NULL auto_increment, `TopicID` int(15) NOT NULL default '0', `ForumID` int(15) NOT NULL default '0', `CategoryID` int(15) NOT NULL default '0', `UserID` int(15) NOT NULL default '0', `GuestName` varchar(150) NOT NULL default '', `TimeStamp` int(15) NOT NULL default '0', `LastUpdate` int(15) NOT NULL default '0', `Post` text NOT NULL, `Description` text NOT NULL, `IP` varchar(20) NOT NULL default '', PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."smiles` ( `ID` int(15) NOT NULL auto_increment, `FileName` text NOT NULL, `SmileName` text NOT NULL, `SmileText` text NOT NULL, `Directory` text NOT NULL, `Show` varchar(15) NOT NULL default '', PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."tagboard` ( `ID` int(15) NOT NULL auto_increment, `UserID` int(15) NOT NULL default '0', `GuestName` varchar(150) NOT NULL default '', `TimeStamp` int(15) NOT NULL default '0', `Post` text NOT NULL, `IP` varchar(20) NOT NULL default '', PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."topics` ( `ID` int(15) NOT NULL auto_increment, `ForumID` int(15) NOT NULL default '0', `CategoryID` int(15) NOT NULL default '0', `UserID` int(15) NOT NULL default '0', `GuestName` varchar(150) NOT NULL default '', `TimeStamp` int(15) NOT NULL default '0', `LastUpdate` int(15) NOT NULL default '0', `TopicName` varchar(150) NOT NULL default '', `Description` text NOT NULL, `NumReply` int(15) NOT NULL default '0', `Pinned` int(5) NOT NULL default '0', `Closed` int(5) NOT NULL default '0', PRIMARY KEY  (`ID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."sessions` ( `SessionID` varchar(255) NOT NULL default '', `SessID` varchar(255) NOT NULL default '', `LastUpdated` int(15) NOT NULL default '0', `DataValue` text NOT NULL, PRIMARY KEY (`SessionID`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."groups` ( `id` int(15) NOT NULL auto_increment, `Name` varchar(150) NOT NULL default '', `PermissionID` int(15) NOT NULL default '0', `NamePrefix` varchar(150) NOT NULL default '', `NameSuffix` varchar(150) NOT NULL default '', `CanViewBoard` varchar(5) NOT NULL default '', `CanEditProfile` varchar(5) NOT NULL default '', `CanAddEvents` varchar(5) NOT NULL default '', `CanPM` varchar(5) NOT NULL default '', `PromoteTo` varchar(150) NOT NULL default '', `PromotePosts` int(15) NOT NULL default '0', `HasModCP` varchar(5) NOT NULL default '', `HasAdminCP` varchar(5) NOT NULL default '', `ViewDBInfo` varchar(5) NOT NULL default '', PRIMARY KEY  (`id`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query="CREATE TABLE `".$_POST['tableprefix']."permissions` ( `id` int(15) NOT NULL auto_increment, `PermissionID` int(15) NOT NULL default '0', `Name` varchar(150) NOT NULL default '', `ForumID` int(15) NOT NULL default '0', `CanViewForum` varchar(5) NOT NULL default '', `CanMakeTopics` varchar(5) NOT NULL default '', `CanMakeReplys` varchar(5) NOT NULL default '', `CanEditReplys` varchar(5) NOT NULL default '', `CanDeleteReplys` varchar(5) NOT NULL default '', `CanDohtml` varchar(5) NOT NULL default '', `CanUseBBags` varchar(5) NOT NULL default '', `CanModForum` varchar(5) NOT NULL default '', PRIMARY KEY  (`id`)) TYPE=MyISAM ;";
$result=mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."groups VALUES (1, 'Admin', 1, '', '', 'yes', 'yes', 'yes', 'yes', 'none', 0, 'yes', 'yes', 'no'), (2, 'Moderator', 2, '', '', 'yes', 'yes', 'yes', 'yes', 'none', 0, 'yes', 'no', 'no'), (3, 'Member', 3, '', '', 'yes', 'yes', 'yes', 'yes', 'none', 0, 'no', 'no', 'no'), (4, 'Guest', 4, '', '', 'yes', 'no', 'no', 'no', 'none', 0, 'no', 'no', 'no'), (5, 'Banned', 5, '', '', 'no', 'no', 'no', 'no', 'none', 0, 'no', 'no', 'no'), (6, 'Validate', 6, '', '', 'yes', 'yes', 'no', 'no', 'none', 0, 'no', 'no', 'no');"; 
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."permissions VALUES (1, 1, 'Admin', 1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'), (2, 2, 'Moderator', 1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'), (3, 3, 'Member', 1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no'), (4, 4, 'Guest', 1, 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no'), (5, 5, 'Banned', 1, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'), (6, 6, 'Validate', 1, 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no');"; 
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."smiles VALUES (1, 'smile.gif', 'Happy', ':)', 'smiles/', 'Yes'), (2, 'tongue.gif', 'Tongue', ':P', 'smiles/', 'Yes'), (3, 'tongue2.gif', 'Tongue', ':tongue:', 'smiles/', 'Yes'), (4, 'sweat.gif', 'Sweat', ':sweat:', 'smiles/', 'Yes'), (5, 'laugh.gif', 'lol', ':lol:', 'smiles/', 'Yes'), (6, 'cool.gif', 'Cool', 'B)', 'smiles/', 'Yes'), (7, 'sleep.gif', 'Sleep', '-_-', 'smiles/', 'Yes'), (8, 'sad.gif', 'Sad', ':(', 'smiles/', 'Yes'), (9, 'angry.gif', 'Angry', ':angry:', 'smiles/', 'Yes'), (10, 'huh.gif', 'huh', ':huh:', 'smiles/', 'Yes'), (11, 'ohmy.gif', 'ohmy', ':o', 'smiles/', 'Yes'), (12, 'hmm.gif', 'hmm', ':unsure:', 'smiles/', 'Yes'), (13, 'mad.gif', 'Mad', ':mad:', 'smiles/', 'Yes'), (14, 'x.gif', 'X', ':x:', 'smiles/', 'Yes');";
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."tagboard VALUES (1,2,'Cool Dude 2k',".$YourDate.",'Welcome to Your New Tag Board. ^_^','127.0.0.1')"; 
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."help VALUES (1,'How to Make a Topic', 'To Make a New Topic Click on The Create New Topic Link.')"; 
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."help VALUES (2,'How to Make a Post','To Make a Reply Click on Topic You Want to Rely to and Click on Reply to Topic Link.')";
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."help VALUES (3,'How to Use BBCodes', 'Put [B]Then Your Text Here and[/B] to Close it<br />\r\nHere are other BBCodes You Can Use<br />\r\n[B]Text[/B]<br />\r\n[I]Text[/I]<br />\r\n[U]Text[/U]<br />\r\n[S]Text[/S]<br />\r\n[H1]Text[/H1]<br />\r\n[H6]Text[/H6]<br />\r\n[URL=URL Here]Website Name[/URL]<br />\r\n[EMAIL=Your Email]Yourr Email[/H6]<br />\r\n[CODE]Code Here[/CODE]<br />\r\n[PHP]PHP Code here[/PHP]<br />\r\n[HTML]HTML Code Here[/HTML]<br />\r\n[SQL]SQL Code here[/SQL]<br />\r\n[QUOTE]Your QUOTE here[/QUOTE]<br />\r\n[QUOTE=UserName to QUOTE]Your QUOTE here[/QUOTE]<br />')";
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."categorys VALUES (1,'Main','Yes',0,'The Main Category.')";
$result = mysql_query($query);
$MyDay = GMTimeGet("d",$YourOffSet);
$MyMonth = GMTimeGet("m",$YourOffSet);
$MyYear = GMTimeGet("Y",$YourOffSet);
$MyYear10 = $MyYear+10;
$query = "INSERT INTO ".$_POST['tableprefix']."events VALUES (1, 1, 'Opening', 'This is the day the Board was made. ^_^', ".$YourDate.", ".$YourDate.")";
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."forums VALUES (1,1,'Test/Spam','Yes','forum',0,'A Test Board.','off',1,1)";
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."topics VALUES (1,1,1,2,'Cool Dude 2k',$YourDate,$YourDate,'Welcome','Install was Successful',0,1,1)";
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."posts VALUES (1,1,1,1,2,'Cool Dude 2k',".$YourDate.",".$YourDate.",'Welcome to Your Message Board. :) ','Install was Successful','127.0.0.1')"; 
$result = mysql_query($query);
$NewPassword = hmac($_POST['AdminPasswords'],$YourDate,"sha1");
$Name = stripcslashes(htmlspecialchars($AdminUser, ENT_QUOTES));
$YourWebsite = "http://".$_SERVER['HTTP_HOST'].$this_dir."index.php?act=view";
$UserIP = $_SERVER['REMOTE_ADDR'];
$PostCount = 2;
$Email = "admin@".$_SERVER['HTTP_HOST'];
$AdminTime=SeverOffSet(null);
$query = "INSERT INTO ".$_POST['tableprefix']."members VALUES (1,'".$_POST['AdminUser']."','".$NewPassword."','iDBH','".$Email."',1,'yes',0,'".$Interests."','Admin',".$YourDate.",".$YourDate.",'".$NewSignature."','Your Notes','".$Avatar."','100x100','".$YourWebsite."','UnKnow',0,'".$AdminTime."','off','iDB','".$UserIP."','')";
$result = mysql_query($query);
$GEmail = "Guest@".$_SERVER['HTTP_HOST'];
$GuestPassword = hmac("Guest",$YourDate,"sha1");
$query = "INSERT INTO ".$_POST['tableprefix']."members VALUES (2,'Guest','".$GuestPassword."','iDBH','".$GEmail."',4,'no',0,'Guest Account','Guest',".$YourDate.",".$YourDate.",'[B]Test[/B]','Your Notes','http://','100x100','http://".$_SERVER['HTTP_HOST']."/','UnKnow',".rand(-50,50).",'".$AdminTime."','off','iDB','127.0.0.1','')";
$result = mysql_query($query);
$result = mysql_query($query);
$query = "INSERT INTO ".$_POST['tableprefix']."messenger VALUES (1,2,1,'Test','This is a Test PM. :P ',".$YourDate.",0)";
$result = mysql_query($query);
$CHMOD = $_SERVER['PHP_SELF'];
$url_this_dir = "http://".$_SERVER['HTTP_HOST'].$this_dir."index.php?act=view";
$YourIP = $_SERVER['REMOTE_ADDR'];
$pretext = "<?php\n/*\n    This program is free software; you can redistribute it and/or modify\n    it under the terms of the GNU General Public License as published by\n    the Free Software Foundation; either version 2 of the License, or\n    (at your option) any later version.\n\n    This program is distributed in the hope that it will be useful,\n    but WITHOUT ANY WARRANTY; without even the implied warranty of\n    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the\n    GNU General Public License for more details.\n\n    Copyright 2004-2006 Cool Dude 2k - http://idb.berlios.de/\n    Copyright 2004-2006 Game Maker 2k - http://cooldude2k.co.funpic.org/\n    Emoticons made by Jcink http://tfbb.jcink.com/\n*/\n";
$BoardSettings=$pretext."\$Settings['sqlhost'] = '".$_POST['DatabaseHost']."';\n\$Settings['sqldb'] = '".$_POST['DatabaseName']."';\n\$Settings['sqltable'] = '".$_POST['tableprefix']."';\n\$Settings['sqluser'] = '".$_POST['DatabaseUserName']."';\n\$Settings['sqlpass'] = '".$_POST['DatabasePassword']."';\n\$Settings['board_name'] = '".$_POST['NewBoardName']."';\n\$Settings['idbdir'] = '".$idbdir."';\n\$Settings['idburl'] = '".$_POST['BoardURL']."';\n\$Settings['use_gzip'] = ".$_POST['GZip'].";\n\$Settings['html_type'] = '".$_POST['HTMLType']."';\n\$Settings['html_level'] = '".$_POST['HTMLLevel']."';\n\$Settings['output_type'] = '".$_POST['OutPutType']."';\n\$Settings['GuestGroup'] = 'Guest';\n\$Settings['MemberGroup'] = 'Member';\n\$Settings['ValidateGroup'] = 'Validate';\n\$Settings['AdminValidate'] = false;\n\$Settings['add_power_by'] = false;\n\$Settings['max_posts'] = '2';\n\$Settings['qstr'] = '&';\n\$Settings['qsep'] = '=';\n?>";
$fp = fopen("./settings.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
//	@cp("settings.php","settingsbak.php");
$fp = fopen("./settingsbak.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
$_SESSION['MemberName']=$_POST['AdminUser'];
$_SESSION['UserID']=1;
$_SESSION['UserGroup']="Admin";
$_SESSION['UserTimeZone']=$AdminTime;
if($_POST['storecookie']==true) {
@setcookie("MemberName", $_POST['AdminUser'], time() + (7 * 86400));
@setcookie("UserID", 1, time() + (7 * 86400));
@setcookie("SessPass", $NewPassword, time() + (7 * 86400)); }
@mysql_close();
if($_POST['unlink']==true) {
@unlink("install.php"); }
?>
<br />Install Finish <a href="index.php?act=view">Click here</a> to goto board. ^_^
<br /><br />
</td>
</tr>
<?php } } } if ($Error=="Yes") { ?>
<br />Install Failed with errors. <a href="install.php?act=view">Click here</a> to restart install. &lt;_&lt;
<br /><br />
</td>
</tr>
<?php } ?>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;<a href="index.php?act=ReadMe">Readme.txt</a>&nbsp;</td>
</tr>
</table>
<div>&nbsp;</div>
<?php require('inc/endpage.php'); ?>
</body>
</html>
<?php fix_amp(null); ?>
