<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2009 iDB Support - http://idb.berlios.de/
    Copyright 2004-2008 Game Maker 2k - http://gamemaker2k.org/
    iDB Installer made by Game Maker 2k - http://idb.berlios.net/

    $FileInfo: mkconfig.php - Last Update: 12/06/2009 SVN 379 - Author: cooldude2k $
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
if(!isset($Settings['sqldb'])) { echo "Sorry you can not signup yet."; $Error="Yes"; die(); }
if(!isset($SetupDir['setup'])) { $SetupDir['setup'] = "signup/"; }
if(!isset($SetupDir['convert'])) { $SetupDir['convert'] = null; }
$_POST['DatabaseHost'] = $Settings['sqlhost'];
$_POST['DatabaseUserName'] = $Settings['sqluser'];
$_POST['DatabasePassword'] = $Settings['sqlpass'];
//if($_POST['unlink']=="true") { $_POST['unlink'] = true; }
?>
<tr class="TableRow3" style="text-align: center;">
<td class="TableColumn3" colspan="2">
<?php
$dayconv = array('second' => 1, 'minute' => 60, 'hour' => 3600, 'day' => 86400, 'week' => 604800, 'month' => 2630880, 'year' => 31570560, 'decade' => 15705600);
$_POST['unixname'] = strtolower($_POST['unixname']);
if($_POST['unixname']==null) { $_POST['unixname'] = null; }
$_POST['tableprefix'] = $_POST['unixname']."_";
$_POST['unixname'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_POST['unixname']);
$_POST['tableprefix'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_POST['tableprefix']);
if($_POST['tableprefix']==null||$_POST['tableprefix']=="_") { $_POST['tableprefix']="idb_"; }
if($_POST['sessprefix']==null||$_POST['sessprefix']=="_") { $_POST['sessprefix']="idb_"; }
$checkfile="settings.php";
session_name($_POST['tableprefix']."sess");
$HTTPsTest = parse_url($Settings['idburl']);
session_set_cookie_params(0, "/".$_POST['unixname']."/");
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
if(!function_exists('hash')||!function_exists('hash_algos')) {
if($_POST['usehashtype']!="md5"&&
   $_POST['usehashtype']!="sha1"&&
   $_POST['usehashtype']!="sha256") {
	$_POST['usehashtype'] = "sha256"; } }
if(function_exists('hash')&&function_exists('hash_algos')) {
if(!in_array($_POST['usehashtype'],hash_algos())) {
	$_POST['usehashtype'] = "sha256"; }
if($_POST['usehashtype']!="md2"&&
   $_POST['usehashtype']!="md4"&&
   $_POST['usehashtype']!="md5"&&
   $_POST['usehashtype']!="sha1"&&
   $_POST['usehashtype']!="sha256"&&
   $_POST['usehashtype']!="sha386"&&
   $_POST['usehashtype']!="sha512") {
	$_POST['usehashtype'] = "sha256"; } }
if($_POST['usehashtype']=="md2") { $iDBHashType = "iDBH2"; }
if($_POST['usehashtype']=="md4") { $iDBHashType = "iDBH4"; }
if($_POST['usehashtype']=="md5") { $iDBHashType = "iDBH5"; }
if($_POST['usehashtype']=="sha1") { $iDBHashType = "iDBH"; }
if($_POST['usehashtype']=="sha256") { $iDBHashType = "iDBH256"; }
if($_POST['usehashtype']=="sha386") { $iDBHashType = "iDBH386"; }
if($_POST['usehashtype']=="sha512") { $iDBHashType = "iDBH512"; }
if ($_POST['AdminUser']=="Guest") { $Error="Yes";
echo "<br />You can not use Guest as your name."; }
/* We are done now with fixing the info. ^_^ */
$mydbtest = sql_connect_db($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']);
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
sql_set_charset($SQLCharset);
if($mydbtest===false) { $Error="Yes";
echo "<br />".sql_errorno()."\n"; }
if ($Error!="Yes") {
$ServerUUID = uuid(false,true,false,"sha256",null);
if(!is_numeric($_POST['YourOffSet'])) { $_POST['YourOffSet'] = "0"; }
if($_POST['YourOffSet']>12) { $_POST['YourOffSet'] = "12"; }
if($_POST['YourOffSet']<-12) { $_POST['YourOffSet'] = "-12"; }
if(!is_numeric($_POST['MinOffSet'])) { $_POST['MinOffSet'] = "00"; }
if($_POST['MinOffSet']>59) { $_POST['MinOffSet'] = "59"; }
if($_POST['MinOffSet']<0) { $_POST['MinOffSet'] = "00"; }
$YourOffSet = $_POST['YourOffSet'].":".$_POST['MinOffSet'];
$AdminDST = $_POST['DST'];
$MyDay = GMTimeGet("d",$YourOffSet,0,$AdminDST);
$MyMonth = GMTimeGet("m",$YourOffSet,0,$AdminDST);
$MyYear = GMTimeGet("Y",$YourOffSet,0,$AdminDST);
$MyYear10 = $MyYear+10;
$YourDateEnd = $YourDate + $dayconv['month'];
$EventMonth = GMTimeChange("m",$YourDate,0,0,"off");
$EventMonthEnd = GMTimeChange("m",$YourDateEnd,0,0,"off");
$EventDay = GMTimeChange("d",$YourDate,0,0,"off");
$EventDayEnd = GMTimeChange("d",$YourDateEnd,0,0,"off");
$EventYear = GMTimeChange("Y",$YourDate,0,0,"off");
$EventYearEnd = GMTimeChange("Y",$YourDateEnd,0,0,"off");
$KarmaBoostDay = $EventMonth.$EventDay;
$NewPassword = b64e_hmac($_POST['AdminPasswords'],$YourDate,$YourSalt,"sha256");
//$Name = stripcslashes(htmlspecialchars($AdminUser, ENT_QUOTES, $Settings['charset']));
//$YourWebsite = "http://".$_SERVER['HTTP_HOST']."/".$_POST['unixname']."/"."index.php?act=view";
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
++$i; } $GuestPassword = b64e_hmac($gpass,$YourDate,$GSalt,"sha256");
$url_this_dir = "http://".$_SERVER['HTTP_HOST']."/".$_POST['unixname']."/"."index.php?act=view";
$YourIP = $_SERVER['REMOTE_ADDR'];
require($SetupDir['setup'].'mktable.php');
$CHMOD = $_SERVER['PHP_SELF'];
$iDBRDate = $SVNDay[0]."/".$SVNDay[1]."/".$SVNDay[2];
$iDBRSVN = $VER2[2]." ".$SubVerN;
$LastUpdateS = "Last Update: ".$iDBRDate." ".$iDBRSVN;
$pretext = "<?php\n/*\n    This program is free software; you can redistribute it and/or modify\n    it under the terms of the GNU General Public License as published by\n    the Free Software Foundation; either version 2 of the License, or\n    (at your option) any later version.\n\n    This program is distributed in the hope that it will be useful,\n    but WITHOUT ANY WARRANTY; without even the implied warranty of\n    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the\n    Revised BSD License for more details.\n\nCopyright 2004-".$SVNDay[2]." Game Maker 2k - http://gamemaker2k.org/\n    Copyright 2004-".$SVNDay[2]." Game Maker 2k - http://gamemaker2k.org/\n    iDB Installer made by Game Maker 2k - http://idb.berlios.net/\n\n    \$FileInfo: settings.php & settingsbak.php - ".$LastUpdateS." - Author: cooldude2k \$\n*/\n";
$pretext2 = array("/*   Board Setting Section Begins   */\n\$Settings = array();","/*   Board Setting Section Ends  \n     Board Info Section Begins   */\n\$SettInfo = array();","/*   Board Setting Section Ends   \n     Board Dir Section Begins   */\n\$SettDir = array();","/*   Board Dir Section Ends   */");
$settcheck = "\$File3Name = basename(\$_SERVER['SCRIPT_NAME']);\nif (\$File3Name==\"".$_POST['tableprefix']."settings.php\"||\$File3Name==\"/".$_POST['tableprefix']."settings.php\") {\n    header('Location: index.php');\n    exit(); }\n";
$BoardSettings=$pretext2[0]."\nrequire('settings.php');\n\$Settings['sqltable'] = '".$_POST['tableprefix']."';\n\$Settings['board_name'] = '".$_POST['NewBoardName']."';\n\$Settings['weburl'] = '".$_POST['WebURL']."';\n\$Settings['GuestGroup'] = 'Guest';\n\$Settings['MemberGroup'] = 'Member';\n\$Settings['ValidateGroup'] = 'Validate';\n\$Settings['AdminValidate'] = 'off';\n\$Settings['TestReferer'] = '".$_POST['TestReferer']."';\n\$Settings['DefaultTheme'] = 'iDB';\n\$Settings['DefaultTimeZone'] = '".$AdminTime."';\n\$Settings['DefaultDST'] = '".$AdminDST."';\n\$Settings['use_hashtype'] = '".$_POST['usehashtype']."';\n\$Settings['max_posts'] = '10';\n\$Settings['max_topics'] = '10';\n\$Settings['max_memlist'] = '10';\n\$Settings['max_pmlist'] = '10';\n\$Settings['hot_topic_num'] = '15';\n\$Settings['enable_rss'] = 'on';\n\$Settings['enable_search'] = 'on';\n\$Settings['board_offline'] = 'off';\n\$Settings['BoardUUID'] = '".$ServerUUID."';\n\$Settings['KarmaBoostDays'] = '".$KarmaBoostDay."';\n\$Settings['KBoostPercent'] = '6|10';\n".$pretext2[1]."\n\$SettInfo['board_name'] = '".$_POST['NewBoardName']."';\n\$SettInfo['Author'] = '".$_POST['AdminUser']."';\n\$SettInfo['Keywords'] = '".$_POST['NewBoardName'].",".$_POST['AdminUser']."';\n\$SettInfo['Description'] = '".$_POST['NewBoardName'].",".$_POST['AdminUser']."';\n?>";
$BoardSettingsBak = $pretext.$settcheck.$BoardSettings;
$BoardSettings = $pretext.$settcheck.$BoardSettings;
$fp = fopen($_POST['tableprefix']."settings.php","w+");
fwrite($fp, $BoardSettings);
fclose($fp);
$fp = fopen($_POST['tableprefix']."settingsbak.php","w+");
fwrite($fp, $BoardSettingsBak);
fclose($fp);
@chmod($_POST['tableprefix']."settings.php",0766);
@chmod($_POST['tableprefix']."settingsbak.php",0766);
if($_POST['storecookie']==true) {
//setcookie("MemberName", $_POST['AdminUser'], time() + (7 * 86400), "/".$_POST['unixname']."/", $URLsTest['host']);
//setcookie("UserID", 1, time() + (7 * 86400), "/".$_POST['unixname']."/", $URLsTest['host']);
//setcookie("SessPass", $NewPassword, time() + (7 * 86400), "/".$_POST['unixname']."/", $URLsTest['host']); 
}
mysql_close(); $chdel = true;
?><span class="TableMessage">
<br />Install Finish <a href="/<?php echo $_POST['unixname']; ?>/index.php?act=view">Click here</a> to goto board. ^_^</span>
<?php if($chdel===false) { ?><span class="TableMessage">
<br />Error: Cound not delete installer. Read readme.txt for more info.</span>
<?php } ?><br /><br />
</td>
</tr>
<?php } ?>
