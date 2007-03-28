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
if ($File3Name=="functions.php"||$File3Name=="/functions.php") {
	require('index.php');
	exit(); }
function CheckFile($FileName) {
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name==$FileName||$File3Name=="/".$FileName) {
	require('index.php');
	exit(); }
return null; }
function CheckFiles($FileName) {
$File1Name = dirname($_SERVER['SCRIPT_NAME'])."/";
$File2Name = $_SERVER['SCRIPT_NAME'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name==$FileName||$File3Name=="/".$FileName) {
	return true; } }
CheckFile("functions.php");
require($SettDir['misc']."compression.php");
function version_info($proname,$prever,$subver=null,$withver=null) {
if($subver!=null) { 
	if($withver!=null) {
		return $proname." ".$withver." ".$prever." ".$subver; }
	if($withver==null) {
		return $proname." ".$prever." ".$subver; } }
if($subver==null) { 
	if($withver!=null) {
		return $proname." ".$withver." ".$prever; }
	if($withver==null) {
		return $proname." ".$prever; } } }
if(isset($Settings['showverinfo'])) { $idbmisc['showverinfo'] = $Settings['showverinfo']; }
if(!isset($Settings['showverinfo'])) { $idbmisc['showverinfo'] = false; }
$CD2k = "Cool Dude 2k"; $GM2k = "Game Maker 2k";
$iDB = "Internet Discussion Boards"; $iTB = "Internet Tag Boards"; $DF2k = "Discussion Forums 2k"; $TB2k = "Tag Boards 2k";
$iDBURL1 = "<a href=\"http://idb.berlios.de/\" onclick=\"window.open(this.href);return false;\">"; $iDBURL2 = $iDBURL1.$iDB."</a>";
$DF2kURL1 = "<a href=\"http://df2k.berlios.de/\" onclick=\"window.open(this.href);return false;\">"; $DF2kURL2 = $DF2kURL1.$DF2k."</a>";
$GM2kURL = "<a href=\"http://upload.idb.s1.jcink.com/\" title=\"".$GM2k."\" onclick=\"window.open(this.href);return false;\">".$GM2k."</a>";
$iDBURL3 = "<a href=\"http://idb.everywebhost.com/\" title=\"".$iDB."\" onclick=\"window.open(this.href);return false;\">".$iDB."</a>";
$PHPQA = "PHP-Quick-Arcade"; $VER1 = "0.1.4"; $VER2 = "Pre-Alpha 4"; $VER3 = "PA 4"; 
$PHPV1 = @phpversion(); $PHPV2 = "PHP ".$PHPV1; $OSType = PHP_OS;
if($OSType=="WINNT") { $OSType="Windows NT"; } if($OSType=="WIN32") { $OSType="Windows 9x"; }
$OSType2 = $PHPV2." / ".$OSType; $ZENDV1 = @zend_version(); $ZENDV2 = "Zend engine ".$ZENDV1;
if($idbmisc['showverinfo']==true) {
@header("X-iDB-Powered-By: ".version_info("iDB",$VER1,$VER3));
@header("Generator: ".version_info("iDB",$VER1,$VER3)); }
if($idbmisc['showverinfo']!=true) {
@header("X-iDB-Powered-By: iDB");
//@header("X-Powered-By: PHP");
@header("Generator: iDB"); }
	$Names['RS'] = "Renee Sabonis";
define("_renee_", $Names['RS']);
if ($_GET['act']=="DeleteSession") {
	@session_destroy(); }
if ($_GET['act']=="ResetSession") {
	@session_unset(); }
if ($_GET['act']=="NewSessionID") {
	@session_regenerate_id(); }
if ($_GET['act']=="PHPInfo") {
	@phpinfo(); exit(); }
if ($_GET['act']=="phpinfo") {
	@phpinfo(); exit(); }
if ($_GET['act']=="PHPCredits") {
	@phpcredits(); exit(); }
if ($_GET['act']=="phpcredits") {
	@phpcredits(); exit(); }
function ConnectMysql($sqlhost,$sqluser,$sqlpass,$sqldb) {
$StatSQL = @mysql_connect($sqlhost,$sqluser,$sqlpass);
$StatBase = @mysql_select_db($sqldb);
if (!$StatSQL) { return false; }
if (!$StatBase) { return false; }
return true; }
function change_title($new_title,$use_gzip) {
global $Settings;
$output = @ob_get_clean();
$output = preg_replace("/<title>(.*?)<\/title>/", "<title>".$new_title."</title>", $output);
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$SessName = @session_name();
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
$qstrcode = htmlentities($Settings['qstr']);
$output = str_replace($Settings['qstr'].$SessName, $qstrcode.$SessName, $output);
if($use_gzip!=true) {
	if($Settings['send_pagesize']==true) {
	Header("Content-Length: " . strlen($output)); }
	echo $output; }
if($use_gzip==true) {
	$goutput = gzencode($output);
	if($Settings['send_pagesize']==true) {
	Header("Content-Length: " . strlen(gzencode($goutput))); }
	echo $goutput; } }
function fix_amp($use_gzip) {
global $Settings;
$output = @ob_get_clean();
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$SessName = @session_name();
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
$qstrcode = htmlentities($Settings['qstr']);
$output = str_replace($Settings['qstr'].$SessName, $qstrcode.$SessName, $output);
if($use_gzip!=true) {
	if($Settings['send_pagesize']==true) {
	Header("Content-Length: " . strlen($output)); }
	echo $output; }
if($use_gzip==true) {
	$goutput = gzencode($output);
	if($Settings['send_pagesize']==true) {
	Header("Content-Length: " . strlen(gzencode($goutput))); }
	echo $goutput; } }
function gzip_page($use_gzip) {
global $Settings;
$output = @ob_get_clean();
	$Names['RJ'] = "René Johnson";
define("_rene_", $Names['RJ']);
if($use_gzip!=true) {
	if($Settings['send_pagesize']==true) {
	Header("Content-Length: " . strlen($output)); }
	echo $output; }
if($use_gzip==true) {
	$goutput = gzencode($output);
	if($Settings['send_pagesize']==true) {
	Header("Content-Length: " . strlen(gzencode($goutput))); }
	echo $goutput; } }
$foo="bar"; $$foo="foo";
// SafeSQL Lite Source Code by Cool Dude 2k
function query($query_string,$query_vars) {
   $query_array = array(array("%i","%I","%F","%S"),array("%d","%d","%f","%s"));
   $query_string = str_replace($query_array[0], $query_array[1], $query_string);
   if (get_magic_quotes_gpc()) {
       $query_vars  = array_map("stripslashes", $query_vars); }
   $query_vars = array_map("mysql_real_escape_string", $query_vars);
   $query_val = $query_vars;
$query_num = count($query_val);
$query_i = 0;
while ($query_i < $query_num) {
$query_is = $query_i+1;
$query_val[$query_is] = $query_vars[$query_i];
++$query_i; }
   $query_val[0] = $query_string;
   return call_user_func_array("sprintf",$query_val); }
function killbadvars($varname) {
$badphp1 = array('$'); $badphp2 = array(null);
$varname = str_replace($badphp1, $badphp2, $varname);
$varname = preg_replace("/(_SERVER|_ENV|_COOKIE|_SESSION)/i", null, $varname);
$varname = preg_replace("/(_GET|_POST|_FILES|_REQUEST|GLOBALS)/i", null, $varname);
$varname = preg_replace("/(HTTP_SERVER_VARS|HTTP_ENV_VARS)/i", null, $varname);
$varname = preg_replace("/(HTTP_COOKIE_VARS|HTTP_SESSION_VARS)/i", null, $varname);
$varname = preg_replace("/(HTTP_GET_VARS|HTTP_POST_VARS|HTTP_POST_FILES)/i", null, $varname);
	return $varname; }
function text2icons($Text,$sqlt) {
global $Settings;
$renquery="SELECT * FROM ".$sqlt."smileys";
$renresult=mysql_query($renquery);
$rennum=mysql_num_rows($renresult);
$reni=0;
while ($reni < $rennum) {
$FileName=mysql_result($renresult,$reni,"FileName");
$SmileName=mysql_result($renresult,$reni,"SmileName");
$SmileText=mysql_result($renresult,$reni,"SmileText");
$SmileDirectory=mysql_result($renresult,$reni,"Directory");
$ShowSmile=mysql_result($renresult,$reni,"Show");
$Smile1 = array($SmileText);
$Smile2 = array('<img src="'.$SmileDirectory.''.$FileName.'" style="vertical-align: middle; border: 0px;" title="'.$SmileName.'" alt="'.$SmileName.'" />');
$Text=str_replace($Smile1, $Smile2, $Text);
++$reni; } return $Text; }
function remove_spaces($Text) {
$Text = preg_replace("/(^\t+|\t+$)/","",$Text);
$Text = preg_replace("/(^\n+|\n+$)/","",$Text);
$Text = preg_replace("/(^\r+|\r+$)/","",$Text);
$Text = preg_replace("/(\r|\n|\t)+/"," ",$Text);
$Text = preg_replace("/\s\s+/"," ",$Text);
$Text = preg_replace("/(^\s+|\s+$)/","",$Text);
return $Text; }
function fixbamps($text) {
$fixamps1 = array("&amp;copy;","&amp;reg;","&amp;trade;","&amp;quot;","&amp;amp;","&amp;lt;","&amp;gt;","&amp;(a|e|i|o|u|y)acute;","&amp;(a|e|i|o|u)grave;","&amp;(a|e|i|o|u)circ;","&amp;(a|e|i|o|u|y)uml;","&amp;(a|o|n)tilde;","&amp;aring;","&amp;aelig;","&amp;ccedil;","&amp;eth;","&amp;oslash;","&amp;szlig;","&amp;thorn;");
$fixamps2 = array("&copy;","&reg;","&trade;","&quot;","&amp;","&lt;","&gt;","&\\1acute;","&\\1grave;","&\\1circ;","&\\1uml;","&\\1tilde;","&aring;","&aelig;","&ccedil;","&eth;","&oslash;","&szlig;","&thorn;");
$ampnum = count($fixamps1); $ampi=0;
while ($ampi < $ampnum) {
$text = preg_replace("/".$fixamps1[$ampi]."/i", $fixamps2[$ampi], $text);
++$ampi; }
$text = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $text);
return $text; }
function getnextid($tablepre,$table) {
   $getnextidq = query("SHOW TABLE STATUS LIKE '".$tablepre.$table."'", array());
   $getnextidr = mysql_query($getnextidq);
   $getnextid = mysql_fetch_assoc($getnextidr);
   return $getnextid['Auto_increment'];
   @mysql_free_result($getnextidr); }
	$Names['RSA'] = "Rachel Sabonis";
define("_rachel_", $Names['RSA']);
function redirects($type,$url,$time=0) {
if($type!="location"&&
	$type!="refresh") {
	$type=="location"; }
if($type=="refresh") {
header("Refresh: ".$time."; URL=".$url); }
if($type=="location") {
header("Location: ".$url); }
return true; }
function xml_doc_start($ver,$encode,$retval=false) {
	if($retval!=false&&$retval!=true) { $retval=false; }
	if($retval==false) {
	echo '<?xml version="'.$ver.'" encoding="'.$encode.'"?>'."\n"; }
	if($retval==true) {
	return '<?xml version="'.$ver.'" encoding="'.$encode.'"?>'."\n"; } }
function GMTimeChange($format,$timestamp,$offset,$minoffset=null,$dst=null) {
$TCHour = date("H",$timestamp);
$TCMinute = date("i",$timestamp);
$TCSecond = date("s",$timestamp);
$TCMonth = date("n",$timestamp);
$TCDay = date("d",$timestamp);
$TCYear = date("Y",$timestamp);
unset($dstake); $dstake = null;
if(!is_numeric($offset)) { $offset = 0; }
if(!is_numeric($minoffset)) { $minoffset = 0; }
if($dst!="on"&&$dst!="off") { $dst = "off"; }
if($dst=="on") { 
if($dstake!="done") {
if($offset>=0) { $dstake = "done";
	$offset = $offset-1; } }
if($dstake!="done") {
if($offset<0) { $dstake = "done";
	$offset = $offset+1; } } }
$TCHour = $TCHour + $offset;
$TCMinute = $TCMinute + $minoffset;
return date($format,mktime($TCHour,$TCMinute,$TCSecond,$TCMonth,$TCDay,$TCYear)); }
function TimeChange($format,$timestamp,$offset,$minoffset=null,$dst=null) {
$TCHour = date("H",$timestamp);
$TCMinute = date("i",$timestamp);
$TCSecond = date("s",$timestamp);
$TCMonth = date("n",$timestamp);
$TCDay = date("d",$timestamp);
$TCYear = date("Y",$timestamp);
unset($dstake); $dstake = null;
if(!is_numeric($offset)) { $offset = 0; }
if(!is_numeric($minoffset)) { $minoffset = 0; }
if($dst!="on"&&$dst!="off") { $dst = "off"; }
if($dst=="on") { 
if($dstake!="done") {
if($offset>=0) { $dstake = "done";
	$offset = $offset-1; } }
if($dstake!="done") {
if($offset<0) { $dstake = "done";
	$offset = $offset+1; } } }
$TCHour = $TCHour + $offset;
$TCMinute = $TCMinute + $minoffset;
return date($format,mktime($TCHour,$TCMinute,$TCSecond,$TCMonth,$TCDay,$TCYear)); }
function GMTimeStamp() {
$GMTHour = gmdate("H");
$GMTMinute = gmdate("i");
$GMTSecond = gmdate("s");
$GMTMonth = gmdate("n");
$GMTDay = gmdate("d");
$GMTYear = gmdate("Y");
return mktime($GMTHour,$GMTMinute,$GMTSecond,$GMTMonth,$GMTDay,$GMTYear); }
function GMTimeStampS() { return time() - date('Z', time()); }
function GMTimeGet($format,$offset,$minoffset=null,$dst=null) { 
	return GMTimeChange($format,GMTimeStamp(),$offset,$minoffset,$dst); }
function GMTimeGetS($format,$offset,$minoffset=null,$dst=null) {
unset($dstake); $dstake = null;
if(!is_numeric($offset)) { $offset = 0; }
if(!is_numeric($minoffset)) { $minoffset = 0; }
if($dst!="on"&&$dst!="off") { $dst = "off"; }
if($dst=="on") { 
if($dstake!="done") {
if($offset>=0) { $dstake = "done";
	$offset = $offset-1; } }
if($dstake!="done") {
if($offset<0) { $dstake = "done";
	$offset = $offset+1; } } }
return date($format,mktime(gmdate('h')+$offset,gmdate('i')+$minoffset,gmdate('s'),gmdate('n'),gmdate('j'),gmdate('Y'))); }
function GetSeverZone() {
$TestHour1 = date("H");
@putenv("OTZ=".@getenv("TZ"));
@putenv("TZ=GMT");
$TestHour2 = date("H");
@putenv("TZ=".@getenv("OTZ"));
$TestHour3 = $TestHour1-$TestHour2;
return $TestHour3; }
function SeverOffSet() {
$TestHour1 = date("H");
$TestHour2 = gmdate("H");
$TestHour3 = $TestHour1-$TestHour2;
return $TestHour3; }
function SeverOffSetNew() {
return gmdate("g",mktime(0,date("Z"))); }
function gmtime() { return time() - (int) date('Z'); }
function file_get_source($filename,$return = FALSE) {
// Acts like highlight_file();
$phpsrc = file_get_contents($filename);
$phpsrcs = highlight_string($phpsrc,$return);
return $phpsrcs; }
function GetUserName($idu,$sqlt) {
$gunquery = query("select * from ".$sqlt."members where id=%i", array($idu));
$gunresult=mysql_query($gunquery);
$gunnum=mysql_num_rows($gunresult);
if($gunnum>0){
$UsersName=mysql_result($gunresult,$gunnum-1,"Name"); }
@mysql_free_result($gunresult);
return $UsersName; }
function hmac($data,$key,$hash='sha1',$blocksize=64) {
  if (strlen($key)>$blocksize) {
  $key=pack('H*',$hash($key)); }
  $key=str_pad($key, $blocksize, chr(0x00));
  $ipad=str_repeat(chr(0x36),$blocksize);
  $opad=str_repeat(chr(0x5c),$blocksize);
  return $hash(($key^$opad).pack('H*',$hash(($key^$ipad).$data))); }
function b64e_hmac($data,$key,$hash='sha1',$blocksize=64) {
  return base64_encode(hmac($data,$key,$hash,$blocksize)); }
function b64d_hmac($data) { return base64_decode($data); }
function PassHash2x($Text) {
$Text = md5($Text);
$Text = sha1($Text);
return $Text; }
function PassHash2x2($data,$key) {
$Text = hmac($data,$key,"md5");
$Text = hmac($Text,$key,"sha1");
return $Text; }
function cp($infile,$outfile,$mode="w") { 
   $contents = file_get_contents($infile);
   $cpfp = fopen($outfile,$mode);
   fwrite($cpfp, $contents);
   fclose($cpfp);
   return true; }
/* str_ireplace for PHP below ver. 5 // 
// by René Johnson - Cool Dude 2k    */
if(!function_exists('str_ireplace')) {
function str_ireplace($search,$replace,$subject) {
$search = preg_quote($search, "/");
return preg_replace("/".$search."/i", $replace, $subject); } }
$foobar="fubar"; $$foobar="foobar";
function dump_included_files() {	return var_dump(get_included_files()); }
function count_included_files() {	return count(get_included_files()); }
function dump_extensions() {	return var_dump(get_loaded_extensions()); }
function count_extensions() {	return count(get_loaded_extensions()); }
?>
