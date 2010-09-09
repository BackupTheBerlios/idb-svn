<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2010 iDB Support - http://idb.berlios.de/
    Copyright 2004-2010 Game Maker 2k - http://gamemaker2k.org/
    iDB Installer made by Game Maker 2k - http://idb.berlios.net/

    $FileInfo: mkconfig.php - Last Update: 09/08/2010 SVN 530 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="mkconfig.php"||$File3Name=="/mkconfig.php") {
	require('index.php');
	exit(); }
require_once('settings.php');
if($Settings['fixbasedir']==null) { $Settings['fixbasedir'] = "off"; }
if($Settings['fixbasedir']!=null&&$Settings['fixbasedir']!="off") {
		$this_dir = $Settings['fixbasedir']; }
if($Settings['fixcookiedir']==null) { $Settings['fixcookiedir'] = "off"; }
if($Settings['fixcookiedir']!=null&&$Settings['fixcookiedir']!="off") {
		$cookie_dir = $Settings['fixcookiedir']; }
if($Settings['fixcookiedir']!="on"||$Settings['fixcookiedir']=="off") {
		$cookie_dir = $this_dir; }
if(preg_match("/\/$/", $Settings['idburl'])<1) { 
	$Settings['idburl'] = $Settings['idburl']."/"; } 
$URLsTest = parse_url($Settings['idburl']);
$this_dir = $URLsTest['path'];
if(!isset($Settings['sqldb'])) { echo "Sorry you can not signup yet."; $Error="Yes"; die(); }
if(!isset($SetupDir['setup'])) { $SetupDir['setup'] = "signup/"; }
if(!isset($SetupDir['sql'])) { $SetupDir['sql'] = "signup/sql/"; }
if(!isset($SetupDir['convert'])) { $SetupDir['convert'] = null; }
$_POST['DatabaseHost'] = $Settings['sqlhost'];
$_POST['DatabaseUserName'] = $Settings['sqluser'];
$_POST['DatabasePassword'] = $Settings['sqlpass'];
$_POST['DatabaseName'] = $Settings['sqldb'];
if(!isset($_POST['DefaultTheme'])) { $_POST['DefaultTheme'] = "iDB"; }
if(isset($_POST['DefaultTheme'])) { 
	$_POST['DefaultTheme'] = chack_themes($_POST['DefaultTheme']); }
if(!isset($_POST['SQLThemes'])) { $_POST['SQLThemes'] = "off"; }
if($_POST['SQLThemes']!="on"&&$_POST['SQLThemes']!="off") { 
	$_POST['SQLThemes'] = "off"; }
if($Settings['SeparateDatabase']!="no"&&
	$Settings['SeparateDatabase']!="yes") {
	$Settings['SeparateDatabase'] = "no"; }
//if($_POST['unlink']=="true") { $_POST['unlink'] = true; }
if(function_exists("date_default_timezone_set")) { 
	@date_default_timezone_set("UTC"); }
?>
<tr class="TableRow3" style="text-align: center;">
<td class="TableColumn3" colspan="2">
<?php
$dayconv = array('second' => 1, 'minute' => 60, 'hour' => 3600, 'day' => 86400, 'week' => 604800, 'month' => 2630880, 'year' => 31570560, 'decade' => 315705600);
$_POST['unixname'] = strtolower($_POST['unixname']);
if($_POST['unixname']==null) { $_POST['unixname'] = null; }
$_POST['tableprefix'] = $_POST['unixname']."_";
$_POST['unixname'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_POST['unixname']);
$_POST['tableprefix'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_POST['tableprefix']);
if($_POST['tableprefix']==null||$_POST['tableprefix']=="_") { $_POST['tableprefix']="idb_"; }
if($_POST['sessprefix']==null||$_POST['sessprefix']=="_") { $_POST['sessprefix']="idb_"; }
$checkfile="settings.php";
if (!is_writable($checkfile)) {
   echo "<br />Settings is not writable.";
   @chmod("settings.php",0755); $Error="Yes";
   @chmod("settingsbak.php",0755);
} else { /* settings.php is writable install iDB. ^_^ */ }
session_name($_POST['tableprefix']."sess");
$HTTPsTest = parse_url($Settings['idburl']);
session_set_cookie_params(0, $cookie_dir, $URLsTest['host']);
session_cache_limiter("private, must-revalidate");
header("Cache-Control: private, must-revalidate"); // IE 6 Fix
header("Pragma: private, must-revalidate");
header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
session_start();
if (pre_strlen($_POST['AdminPasswords'])<"3") { $Error="Yes";
echo "<br />Your password is too small."; }
if (!isset($_POST['unixname'])) { $Error="Yes";
echo "<br />You need a URL SubFix Name."; }
if (pre_strlen($_POST['AdminUser'])<"3") { $Error="Yes";
echo "<br />Your user name is too small."; }
if (pre_strlen($_POST['AdminEmail'])<"3") { $Error="Yes";
echo "<br />Your email name is too small."; }
if (pre_strlen($_POST['AdminPasswords'])>"60") { $Error="Yes";
echo "<br />Your password is too big."; }
if (pre_strlen($_POST['AdminUser'])>"30") { $Error="Yes";
echo "<br />Your user name is too big."; }
if(file_exists($_POST['tableprefix']."_settings.php")) { $Error="Yes";
echo "<br />Sorry board exists pick a new board url prefix."; }
if ($_POST['AdminPasswords']!=$_POST['ReaPassword']) { $Error="Yes";
echo "<br />Your passwords did not match."; }
if($_POST['HTMLType']=="xhtml11") { $_POST['HTMLLevel']="Strict"; }
$_POST['BoardURL'] = addslashes($_POST['BoardURL']);
$YourDate = GMTimeStamp();
$YourEditDate = $YourDate + $dayconv['minute'];
$GSalt = salt_hmac(); $YourSalt = salt_hmac();
/* Fix The User Info for iDB */
$_POST['NewBoardName'] = stripcslashes(htmlspecialchars($_POST['NewBoardName'], ENT_QUOTES, $Settings['charset']));
//$_POST['NewBoardName'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['NewBoardName']);
$_POST['NewBoardName'] = remove_spaces($_POST['NewBoardName']);
//$_POST['AdminPassword'] = stripcslashes(htmlspecialchars($_POST['AdminPassword'], ENT_QUOTES, $Settings['charset']));
//$_POST['AdminPassword'] = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $_POST['AdminPassword']);
$_POST['AdminUser'] = stripcslashes(htmlspecialchars($_POST['AdminUser'], ENT_QUOTES, $Settings['charset']));
//$_POST['AdminUser'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['AdminUser']);
$_POST['AdminUser'] = remove_spaces($_POST['AdminUser']);
$_POST['AdminEmail'] = remove_spaces($_POST['AdminEmail']);
if(!function_exists('hash')&&!function_exists('hash_algos')) {
if($_POST['usehashtype']!="md5"&&
   $_POST['usehashtype']!="sha1") {
	$_POST['usehashtype'] = "sha1"; } }
if(function_exists('hash')&&function_exists('hash_algos')) {
if(!in_array($_POST['usehashtype'],hash_algos())) {
	$_POST['usehashtype'] = "sha1"; }
if($_POST['usehashtype']!="md2"&&
   $_POST['usehashtype']!="md4"&&
   $_POST['usehashtype']!="md5"&&
   $_POST['usehashtype']!="sha1"&&
   $_POST['usehashtype']!="sha224"&&
   $_POST['usehashtype']!="sha256"&&
   $_POST['usehashtype']!="sha384"&&
   $_POST['usehashtype']!="sha512"&&
   $_POST['usehashtype']!="ripemd128"&&
   $_POST['usehashtype']!="ripemd160"&&
   $_POST['usehashtype']!="ripemd256"&&
   $_POST['usehashtype']!="ripemd320") {
	$_POST['usehashtype'] = "sha1"; } }
if($_POST['usehashtype']=="md2") { $iDBHashType = "iDBH2"; }
if($_POST['usehashtype']=="md4") { $iDBHashType = "iDBH4"; }
if($_POST['usehashtype']=="md5") { $iDBHashType = "iDBH5"; }
if($_POST['usehashtype']=="sha1") { $iDBHashType = "iDBH"; }
if($_POST['usehashtype']=="sha224") { $iDBHashType = "iDBH224"; }
if($_POST['usehashtype']=="sha256") { $iDBHashType = "iDBH256"; }
if($_POST['usehashtype']=="sha384") { $iDBHashType = "iDBH384"; }
if($_POST['usehashtype']=="sha512") { $iDBHashType = "iDBH512"; }
if($_POST['usehashtype']=="ripemd128") { $iDBHashType = "iDBHRMD128"; }
if($_POST['usehashtype']=="ripemd160") { $iDBHashType = "iDBHRMD160"; }
if($_POST['usehashtype']=="ripemd256") { $iDBHashType = "iDBHRMD256"; }
if($_POST['usehashtype']=="ripemd320") { $iDBHashType = "iDBHRMD320"; }
if ($_POST['AdminUser']=="Guest") { $Error="Yes";
echo "<br />You can not use Guest as your name."; }
/* We are done now with fixing the info. ^_^ */
if($Settings['SeparateDatabase']=="no") {
$SQLStat = sql_connect_db($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
if($Settings['SeparateDatabase']=="yes") {
$SQLStat = sql_connect_db($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass']); 
$Settings['sqldb'] = $_POST['unixname']; 
if($Settings['sqltype']=="sqlite") {
$Settings['sqldb'] = $_POST['unixname'].".sqlite"; }
if($Settings['sqltype']=="mysql"||
	$Settings['sqltype']=="mysqli"||
	$Settings['sqltype']=="pgsql") {
$query=sql_pre_query("CREATE DATABASE \"".$Settings['sqldb']."\";", array(null));
sql_query($query,$SQLStat); }
$SQLStat = sql_connect_db($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
$SQLCollate = "latin1_general_ci";
$SQLCharset = "latin1"; 
if($Settings['charset']=="ISO-8859-1") {
	$SQLCollate = "latin1_general_ci";
	$SQLCharset = "latin1"; }
if($Settings['charset']=="ISO-8859-15") {
	$SQLCollate = "latin1_general_ci";
	$SQLCharset = "latin1"; }
if($Settings['charset']=="UTF-8") {
	$SQLCollate = "utf8_unicode_ci";
	$SQLCharset = "utf8"; }
sql_set_charset($SQLCharset,$SQLStat);
if($SQLStat===false) { $Error="Yes";
echo "<br />".sql_errorno($SQLStat)."\n"; }
if ($Error!="Yes") {
$ServerUUID = rand_uuid("rand");
if(!is_numeric($_POST['YourOffSet'])) { $_POST['YourOffSet'] = "0"; }
if(!is_numeric($_POST['MinOffSet'])) { $_POST['MinOffSet'] = "00"; }
if($_POST['MinOffSet']<0) { $_POST['MinOffSet'] = "00"; }
$YourOffSet = $_POST['YourOffSet'].":".$_POST['MinOffSet'];
$AdminDST = $_POST['DST'];
$MyDay = GMTimeGet("d",$YourOffSet,0,$AdminDST);
$MyMonth = GMTimeGet("m",$YourOffSet,0,$AdminDST);
$MyYear = GMTimeGet("Y",$YourOffSet,0,$AdminDST);
$MyYear10 = $MyYear+10;
$YourDateEnd = $YourDate;
$EventMonth = GMTimeChange("m",$YourDate,0,0,"off");
$EventMonthEnd = GMTimeChange("m",$YourDateEnd,0,0,"off");
$EventDay = GMTimeChange("d",$YourDate,0,0,"off");
$EventDayEnd = GMTimeChange("d",$YourDateEnd,0,0,"off");
$EventYear = GMTimeChange("Y",$YourDate,0,0,"off");
$EventYearEnd = GMTimeChange("Y",$YourDateEnd,0,0,"off");
$KarmaBoostDay = $EventMonth.$EventDay;
$NewPassword = b64e_hmac($_POST['AdminPasswords'],$YourDate,$YourSalt,$_POST['usehashtype']);
//$Name = stripcslashes(htmlspecialchars($AdminUser, ENT_QUOTES, $Settings['charset']));
//$YourWebsite = "http://".$_SERVER['HTTP_HOST'].$this_dir."index.php?act=view";
$YourWebsite = $_POST['WebURL'];
$UserIP = $_SERVER['REMOTE_ADDR'];
$PostCount = 2;
$Email = "admin@".$_SERVER['HTTP_HOST'];
$AdminTime = $_POST['YourOffSet'].":".$_POST['MinOffSet'];
$GEmail = "guest@".$_SERVER['HTTP_HOST'];
$grand = rand(6,16); $i = 0; $gpass = "";
while ($i < $grand) {
$csrand = rand(1,3);
if($csrand!=1&&$csrand!=2&&$csrand!=3) { $csrand=1; }
if($csrand==1) { $gpass .= chr(rand(48,57)); }
if($csrand==2) { $gpass .= chr(rand(65,90)); }
if($csrand==3) { $gpass .= chr(rand(97,122)); }
++$i; } $GuestPassword = b64e_hmac($gpass,$YourDate,$GSalt,$_POST['usehashtype']);
$url_this_dir = "http://".$_SERVER['HTTP_HOST'].$this_dir."index.php?act=view";
$YourIP = $_SERVER['REMOTE_ADDR'];
if($Settings['sqltype']=="mysql"||
	$Settings['sqltype']=="mysqli") {
require($SetupDir['sql'].'mysql.php'); }
if($Settings['sqltype']=="pgsql") {
require($SetupDir['sql'].'pgsql.php'); }
if($Settings['sqltype']=="sqlite") {
require($SetupDir['sql'].'sqlite.php'); }
if($_POST['SQLThemes']=="on") {
$OldThemeSet = $ThemeSet; 
$Settings['board_name'] = $_POST['NewBoardName'];
$skindir = dirname(realpath("sql.php"))."/".$SettDir['themes'];
if ($handle = opendir($skindir)) { $dirnum = null;
   while (false !== ($file = readdir($handle))) {
	   if ($dirnum==null) { $dirnum = 0; }
	   if (file_exists($skindir.$file."/info.php")) {
		   if ($file != "." && $file != "..") {
	   include($skindir.$file."/info.php");
       $themelist[$dirnum] =  $file;
	   ++$dirnum; } } }
   closedir($handle); asort($themelist);
   $themenum=count($themelist); $themei=0; 
   while ($themei < $themenum) {
   include($skindir.$themelist[$themei]."/settings.php");
   $query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."themes\" (\"Name\", \"ThemeName\", \"ThemeMaker\", \"ThemeVersion\", \"ThemeVersionType\", \"ThemeSubVersion\", \"MakerURL\", \"CopyRight\", \"CSS\", \"CSSType\", \"FavIcon\", \"TableStyle\", \"MiniPageAltStyle\", \"PreLogo\", \"Logo\", \"LogoStyle\", \"SubLogo\", \"TopicIcon\", \"MovedTopicIcon\", \"HotTopic\", \"MovedHotTopic\", \"PinTopic\", \"MovedPinTopic\", \"HotPinTopic\", \"MovedHotPinTopic\", \"ClosedTopic\", \"MovedClosedTopic\", \"HotClosedTopic\", \"MovedHotClosedTopic\", \"PinClosedTopic\", \"MovedPinClosedTopic\", \"HotPinClosedTopic\", \"MovedHotPinClosedTopic\", \"MessageRead\", \"MessageUnread\", \"Profile\", \"WWW\", \"PM\", \"TopicLayout\", \"AddReply\", \"FastReply\", \"NewTopic\", \"QuoteReply\", \"EditReply\", \"DeleteReply\", \"Report\", \"LineDivider\", \"ButtonDivider\", \"LineDividerTopic\", \"TitleDivider\", \"ForumStyle\", \"ForumIcon\", \"SubForumIcon\", \"RedirectIcon\", \"TitleIcon\", \"NavLinkIcon\", \"NavLinkDivider\", \"StatsIcon\", \"NoAvatar\", \"NoAvatarSize\") VALUES\n".
   "('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');", array($themelist[$themei], $ThemeSet['ThemeName'], $ThemeSet['ThemeMaker'], $ThemeSet['ThemeVersion'], $ThemeSet['ThemeVersionType'], $ThemeSet['ThemeSubVersion'], $ThemeSet['MakerURL'], $ThemeSet['CopyRight'], $ThemeSet['CSS'], $ThemeSet['CSSType'], $ThemeSet['FavIcon'], $ThemeSet['TableStyle'], $ThemeSet['MiniPageAltStyle'], $ThemeSet['PreLogo'], $ThemeSet['Logo'], $ThemeSet['LogoStyle'], $ThemeSet['SubLogo'], $ThemeSet['TopicIcon'], $ThemeSet['MovedTopicIcon'], $ThemeSet['HotTopic'], $ThemeSet['MovedHotTopic'], $ThemeSet['PinTopic'], $ThemeSet['MovedPinTopic'], $ThemeSet['HotPinTopic'], $ThemeSet['MovedHotPinTopic'], $ThemeSet['ClosedTopic'], $ThemeSet['MovedClosedTopic'], $ThemeSet['HotClosedTopic'], $ThemeSet['MovedHotClosedTopic'], $ThemeSet['PinClosedTopic'], $ThemeSet['MovedPinClosedTopic'], $ThemeSet['HotPinClosedTopic'], $ThemeSet['MovedHotPinClosedTopic'], $ThemeSet['MessageRead'], $ThemeSet['MessageUnread'], $ThemeSet['Profile'], $ThemeSet['WWW'], $ThemeSet['PM'], $ThemeSet['TopicLayout'], $ThemeSet['AddReply'], $ThemeSet['FastReply'], $ThemeSet['NewTopic'], $ThemeSet['QuoteReply'], $ThemeSet['EditReply'], $ThemeSet['DeleteReply'], $ThemeSet['Report'], $ThemeSet['LineDivider'], $ThemeSet['ButtonDivider'], $ThemeSet['LineDividerTopic'], $ThemeSet['TitleDivider'], $ThemeSet['ForumStyle'], $ThemeSet['ForumIcon'], $ThemeSet['SubForumIcon'], $ThemeSet['RedirectIcon'], $ThemeSet['TitleIcon'], $ThemeSet['NavLinkIcon'], $ThemeSet['NavLinkDivider'], $ThemeSet['StatsIcon'], $ThemeSet['NoAvatar'], $ThemeSet['NoAvatarSize'])); 
   sql_query($query,$SQLStat);
   ++$themei; } }
$ThemeSet = $OldThemeSet; }
$CHMOD = $_SERVER['PHP_SELF'];
$iDBRDate = $SVNDay[0]."/".$SVNDay[1]."/".$SVNDay[2];
$iDBRSVN = $VER2[2]." ".$SubVerN;
$LastUpdateS = "Last Update: ".$iDBRDate." ".$iDBRSVN;
$pretext = "<?php\n/*\n    This program is free software; you can redistribute it and/or modify\n    it under the terms of the GNU General Public License as published by\n    the Free Software Foundation; either version 2 of the License, or\n    (at your option) any later version.\n\n    This program is distributed in the hope that it will be useful,\n    but WITHOUT ANY WARRANTY; without even the implied warranty of\n    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the\n    Revised BSD License for more details.\n\n    Copyright 2004-".$SVNDay[2]." iDB Support - http://idb.berlios.de/\n    Copyright 2004-".$SVNDay[2]." Game Maker 2k - http://gamemaker2k.org/\n    iDB Installer made by Game Maker 2k - http://idb.berlios.net/\n\n    \$FileInfo: settings.php & settingsbak.php - ".$LastUpdateS." - Author: cooldude2k \$\n*/\n";
$pretext2 = array("/*   Board Setting Section Begins   */\n\$Settings = array();","/*   Board Setting Section Ends  \n     Board Info Section Begins   */\n\$SettInfo = array();","/*   Board Setting Section Ends   \n     Board Dir Section Begins   */\n\$SettDir = array();","/*   Board Dir Section Ends   */");
$settcheck = "\$File3Name = basename(\$_SERVER['SCRIPT_NAME']);\nif (\$File3Name==\"".$_POST['tableprefix']."settings.php\"||\$File3Name==\"/".$_POST['tableprefix']."settings.php\") {\n    header('Location: index.php');\n    exit(); }\n";
$BoardSettings=$pretext2[0]."\n".
"require('settings.php');\n".
"\$Settings['sqltable'] = '".$_POST['tableprefix']."';\n".
"\$Settings['board_name'] = '".$_POST['NewBoardName']."';\n".
"\$Settings['weburl'] = '".$_POST['WebURL']."';\n".
"\$Settings['SQLThemes'] = '".$_POST['SQLThemes']."';\n".
"\$Settings['GuestGroup'] = 'Guest';\n".
"\$Settings['MemberGroup'] = 'Member';\n".
"\$Settings['ValidateGroup'] = 'Validate';\n".
"\$Settings['AdminValidate'] = 'off';\n".
"\$Settings['TestReferer'] = '".$_POST['TestReferer']."';\n".
"\$Settings['DefaultTheme'] = '".$_POST['DefaultTheme']."';\n".
"\$Settings['DefaultTimeZone'] = '".$AdminTime."';\n".
"\$Settings['DefaultDST'] = '".$AdminDST."';\n".
"\$Settings['start_date'] = ".$YourDate.";\n".
"\$Settings['use_hashtype'] = '".$_POST['usehashtype']."';\n".
"\$Settings['max_posts'] = '10';\n".
"\$Settings['max_topics'] = '10';\n".
"\$Settings['max_memlist'] = '10';\n".
"\$Settings['max_pmlist'] = '10';\n".
"\$Settings['hot_topic_num'] = '15';\n".
"\$Settings['enable_rss'] = 'on';\n".
"\$Settings['enable_search'] = 'on';\n".
"\$Settings['board_offline'] = 'off';\n".
"\$Settings['BoardUUID'] = '".$ServerUUID."';\n".
"\$Settings['KarmaBoostDays'] = '".$KarmaBoostDay."';\n".
"\$Settings['KBoostPercent'] = '6|10';\n".$pretext2[1]."\n".
"\$SettInfo['board_name'] = '".$_POST['NewBoardName']."';\n".
"\$SettInfo['Author'] = '".$_POST['AdminUser']."';\n".
"\$SettInfo['Keywords'] = '".$_POST['NewBoardName'].",".$_POST['AdminUser']."';\n".
"\$SettInfo['Description'] = '".$_POST['NewBoardName'].",".$_POST['AdminUser']."';\n?>";
$BoardSettingsBak = $pretext.$settcheck.$BoardSettings;
$BoardSettings = $pretext.$settcheck.$BoardSettings;
$fp = fopen($_POST['tableprefix']."settings.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
$fp = fopen($_POST['tableprefix']."settingsbak.php","w+");
fwrite($fp, $BoardSettingsBak);
fclose($fp);
if($_POST['storecookie']=="true") {
if($URLsTest['host']!="localhost") {
setcookie("MemberName", $_POST['AdminUser'], time() + (7 * 86400), $this_dir, $URLsTest['host']);
setcookie("UserID", 1, time() + (7 * 86400), $this_dir, $URLsTest['host']);
setcookie("SessPass", $NewPassword, time() + (7 * 86400), $this_dir, $URLsTest['host']); }
if($URLsTest['host']=="localhost") {
setcookie("MemberName", $_POST['AdminUser'], time() + (7 * 86400), $this_dir, false);
setcookie("UserID", 1, time() + (7 * 86400), $this_dir, false);
setcookie("SessPass", $NewPassword, time() + (7 * 86400), $this_dir, false); } }
$chdel = true;
?><span class="TableMessage">
<br />Install Finish <a href="index.php?act=view&amp;board=<?php echo $_POST['unixname']; ?>">Click here</a> to goto board. ^_^</span>
<?php if($chdel===false) { ?><span class="TableMessage">
<br />Error: Cound not delete installer. Read readme.txt for more info.</span>
<?php } ?><br /><br />
</td>
</tr>
<?php } ?>
