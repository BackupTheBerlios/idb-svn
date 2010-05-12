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
    iDB Installer made by Game Maker 2k - http://idb.berlios.de/support/category.php?act=view&id=2

    $FileInfo: signup.php - Last Update: 05/11/2010 SVN 485 - Author: cooldude2k $
*//*
if(ini_get("register_globals")) {
require_once('inc/misc/killglobals.php'); }
*//* Some ini setting changes uncomment if you need them. 
   Display PHP Errors */
$disfunc = @ini_get("disable_functions");
if($disfunc!="ini_set") { $disfunc = explode(",",$disfunc); }
if($disfunc=="ini_set") { $disfunc = array("ini_set"); }
if(!in_array("ini_set", $disfunc)) {
@ini_set("display_errors", true); 
@ini_set("display_startup_errors", true); }
@error_reporting(E_ALL ^ E_NOTICE);
/* Get rid of session id in urls */
if(!in_array("ini_set", $disfunc)) {
@ini_set("session.use_trans_sid", false);
@ini_set("session.use_cookies", true);
@ini_set("session.use_only_cookies", true);
@ini_set("url_rewriter.tags",""); }
@set_time_limit(30); @ignore_user_abort(true);
/* Change session garbage collection settings */
if(!in_array("ini_set", $disfunc)) {
@ini_set("session.gc_probability", 1);
@ini_set("session.gc_divisor", 100);
@ini_set("session.gc_maxlifetime", 1440);
/* Change session hash type here */
@ini_set('session.hash_function', 1);
@ini_set('session.hash_bits_per_character', 6); }
/* Do not change anything below this line unless you know what you are doing */
$Settings['clean_ob'] = "off";
if($Settings['clean_ob']=="on") {
/* Check for other output handlers/buffers are open
   and close and get the contents in an array */
$numob = count(ob_list_handlers()); $iob = 0; 
while ($iob < $numob) { 
	$old_ob_var[$iob] = ob_get_clean(); 
	++$iob; } } ob_start();
if(ini_get("register_globals")) { 
	if(!isset($SettDir['misc'])) { $SettDir['misc'] = "inc/misc/"; }
	require_once($SettDir['misc'].'killglobals.php'); }
require('settings.php');
if(!isset($preact['idb'])) { $preact['idb'] = null; }
if(!isset($_GET['act'])) { $_GET['act'] = null; }
if(!isset($_POST['act'])) { $_POST['act'] = null; }
if ($_GET['act']==null||$_GET['act']=="view") { $_GET['act']="Part1"; }
if ($_POST['act']==null||$_POST['act']=="view") { $_POST['act']="Part1"; }
$_TEG = array(null); $_TEG['part'] = preg_replace("/Part(1|2|3|4)/","\\1",$_GET['act']);
$_GET['act'] = strtolower($_GET['act']); if(isset($_TEG['part'])) {
if($_TEG['part']<=4&&$_TEG['part']>=1) { $_GET['act'] = "Part".$_TEG['part']; } }
if ($_GET['act']!="Part4"&&$_POST['act']!="Part4") {
	$preact['idb'] = "installing";	}
$SetupDir['setup'] = "signup/"; $ConvertDir['setup'] = $SetupDir['setup']; $SetupDir['sql'] = "signup/sql/"; 
$SetupDir['convert'] = null; $ConvertDir['convert'] = $SetupDir['convert']; $ConvertDir['sql'] = $SetupDir['sql']; 
$Settings['output_type'] = "html"; $Settings['html_type'] = "xhtml10";
$Settings['board_name'] = "iDB Easy Host";
if(!isset($Settings['charset'])) {
	$Settings['charset'] = "ISO-8859-15"; }
if(isset($Settings['charset'])) {
if($Settings['charset']!="ISO-8859-15"&&$Settings['charset']!="ISO-8859-1"&&
	$Settings['charset']!="UTF-8"&&$Settings['charset']!="CP866"&&
	$Settings['charset']!="Windows-1251"&&$Settings['charset']!="Windows-1252"&&
	$Settings['charset']!="KOI8-R"&&$Settings['charset']!="BIG5"&&
	$Settings['charset']!="GB2312"&&$Settings['charset']!="BIG5-HKSCS"&&
	$Settings['charset']!="Shift_JIS"&&$Settings['charset']!="EUC-JP") {
	$Settings['charset'] = "ISO-8859-15"; } }
$SQLCharset = "latin1";
if(isset($Settings['charset'])) { 
if($Settings['charset']=="ISO-8859-1") {
	$SQLCharset = "latin1"; }
if($Settings['charset']=="ISO-8859-15") {
	$SQLCharset = "latin1"; }
if($Settings['charset']=="UTF-8") {
	$SQLCharset = "utf8"; }
	$Settings['charset'] = $Settings['charset']; }
if(!isset($_GET['board'])) { 
	$_GET['board'] = $Settings['root_board'];
	$_GET['board'] = strtolower($_GET['board']);
	$_GET['board'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_GET['board']);
	$_GET['board'] = preg_replace("/(.*?)\.\/(.*?)/", "", $_GET['board']);
	$_GET['board'] = preg_replace("/(.*?)\/(.*?)/", "", $_GET['board']);
	$_GET['board'] = preg_replace("/(.*?)\.(.*?)/", "", $_GET['board']); }
require($SetupDir['setup'].'preinstall.php');
require_once($SettDir['misc'].'utf8.php');
require_once($SettDir['inc'].'filename.php');
require_once($SettDir['inc'].'function.php');
//require($SetupDir['convert'].'info.php');
require($SettDir['inc'].'xhtml10.php');
$Error = null; $_GET['time'] = false;
?>

<title> Signing up for iDB Easy Host </title>
</head>
<body>
<?php require($SettDir['inc'].'navbar.php'); ?>
<div class="Table1Border">
<?php if($ThemeSet['TableStyle']=="div") { ?>
<div class="TableRow1">
<span style="font-weight: bold; text-align: left;"><?php echo $ThemeSet['TitleIcon']; ?><a href="signup.php"> Signing up for iDB Easy Host </a></span>
</div>
<?php } ?>
<table class="Table1">
<?php if($ThemeSet['TableStyle']=="table") { ?>
<tr class="TableRow1">
<td class="TableColumn1" colspan="2"><span style="font-weight: bold; text-align: left;"><?php echo $ThemeSet['TitleIcon']; ?><a href="signup.php"> Signing up for iDB Easy Host </a></span>
</td>
</tr><?php } ?>
<tr class="TableRow2">
<th class="TableColumn2" style="width: 100%; text-align: left;">
<span style="float: left;">&nbsp;Inert your info: </span>
<span style="float: right;">&nbsp;</span>
</th>
</tr>
<?php
if($_SERVER['HTTPS']=="on") { $prehost = "https://"; }
if($_SERVER['HTTPS']!="on") { $prehost = "http://"; }
$this_dir = null;
if(dirname($_SERVER['SCRIPT_NAME'])!="."||
	dirname($_SERVER['SCRIPT_NAME'])!=null) {
$this_dir = dirname($_SERVER['SCRIPT_NAME'])."/"; }
if($this_dir==null||$this_dir==".") {
if(dirname($_SERVER['SCRIPT_NAME'])=="."||
	dirname($_SERVER['SCRIPT_NAME'])==null) {
$this_dir = dirname($_SERVER['PHP_SELF'])."/"; } }
if($this_dir=="\/") { $this_dir="/"; }
$this_dir = str_replace("//", "/", $this_dir);
$idbdir = addslashes(str_replace("\\","/",dirname(__FILE__)."/"));
function sql_list_dbs() {
   $result = sql_query("SHOW DATABASES;",$SQLStat);
   while( $data = sql_fetch_row($result) ) {
       $array[] = $data[0];
   } return $array; }
if ($_GET['act']!="Part2"&&$_POST['act']!="Part2") {
if ($_GET['act']!="Part3"&&$_POST['act']!="Part3") {
   require($SetupDir['setup'].'license.php'); } }
if ($_GET['act']=="Part2"&&$_POST['act']=="Part2") {
if ($_GET['act']!="Part3"&&$_POST['act']!="Part3") {
   require($SetupDir['setup'].'setup.php'); } }
if ($_GET['act']!="Part2"&&$_POST['act']!="Part2") {
if ($_GET['act']=="Part3"&&$_POST['act']=="Part3") {
   require($SetupDir['setup'].'mkconfig.php'); } }
if ($Error=="Yes") { ?>
<br />Install Failed with errors. <a href="signup.php?act=view">Click here</a> to restart install. &lt;_&lt;
<br /><br />
</td>
</tr>
<?php } ?>
<tr class="TableRow4">
<td class="TableColumn4">&nbsp;<a href="<?php echo url_maker($exfile['index'],$Settings['file_ext'],"act=ReadMe",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index']); ?>">Readme.txt</a>&nbsp;</td>
</tr>
</table></div>
<div>&nbsp;</div>
<?php require($SettDir['inc'].'endpage.php'); ?>
</body>
</html>
<?php fix_amp(null); ?>
