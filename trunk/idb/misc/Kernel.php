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
function CheckFile($FileName) {
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name==$FileName||$File3Name=="/".$FileName) {
	require('index.html');
	exit(); }
return null;
}
function CheckFiles($FileName) {
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name==$FileName||$File3Name=="/".$FileName) {
	return true; }
}
CheckFile("Kernel.php");
require('Act.php');
require('Zlib.php');
function ConnectMysql($sqlhost,$sqluser,$sqlpass,$sqldb) {
$StatSQL = mysql_connect($sqlhost,$sqluser,$sqlpass,null,'MYSQL_CLIENT_COMPRESS');
$StatBase = @mysql_select_db($sqldb);
}
function change_title($new_title) {
$output = ob_get_contents();
ob_end_clean();
$output = preg_replace("/<title>(.*?)<\/title>/", "<title>$new_title</title>", $output);
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$SessName = session_name();
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
$output = str_replace("&".$SessName, "&amp;".$SessName, $output);
echo $output;
}
function fix_amp($null) {
$output = ob_get_contents();
ob_end_clean();
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$SessName = session_name();
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
$output = str_replace("&".$SessName, "&amp;".$SessName, $output);
echo $output;
}
function xml_doc_start($ver,$encode) {
	echo '<?xml version="'.$ver.'" encoding="'.$encode.'"?>'."\n\r";
}
function GMTimeChange($format,$timestamp,$offset)
{
$TCHour = date("H",$timestamp);
$TCMinute = date("i",$timestamp);
$TCSecond = date("s",$timestamp);
$TCMonth = date("n",$timestamp);
$TCDay = date("j",$timestamp);
$TCYear = date("Y",$timestamp);
return gmdate($format,mktime($TCHour+$offset,$TCMinute,$TCSecond,$TCMonth,$TCDay,$TCYear));
}
function TimeChange($format,$timestamp,$offset)
{
$TCHour = date("H",$timestamp);
$TCMinute = date("i",$timestamp);
$TCSecond = date("s",$timestamp);
$TCMonth = date("n",$timestamp);
$TCDay = date("j",$timestamp);
$TCYear = date("Y",$timestamp);
return gmdate($format,mktime($TCHour+$offset,$TCMinute,$TCSecond,$TCMonth,$TCDay,$TCYear));
}
function GMTimeGet($format,$offset)
{
$TimeFix	 = $FixMinute;
return gmdate($format,mktime(date('H')+$offset,date('i'),date('s'),date('n'),date('j'),date('Y')));
}
function SeverOffSet($Cool = null)
{
$TestHour1 = date("H");
$TestHour2 = gmdate("H");
$TestHour3 = $TestHour1-$TestHour2;
$TestHour4 = $TestHour3;
return $TestHour4;
}
function GMTimeSend($none = null)
{
return gmmktime();
}
function Time_UnixStamp($time) {
/*	//strtotime('2005-08-25 12:04:53');
//strtotime('October 30, 2005, 2:17 am');	*/
return strtotime($time);
}
function GMTime_UnixStamp($time) {
/*	//strtotime('2005-08-25 12:04:53');
//strtotime('October 30, 2005, 2:17 am');	*/
return strtotime($time);
}
function parsedate($value)
{
// If it looks like a UK date dd/mm/yy, reformat to US date mm/dd/yy so strtotime can parse it.
$reformatted = preg_replace("/^\s*([0-9]{1,2})[\/\. -]+([0-9]{1,2})[\/\. -]+([0-9]{1,4})/", "\\2/\\1/\\3", $value);
return strtotime($reformatted);
}
function file_get_source($filename,$return = FALSE)
{
// Acts like highlight_file();
$phpsrc = file_get_contents($filename);
$phpsrcs = highlight_string($phpsrc,$return);
return $phpsrcs;
}
function CountPosts($idc,$idf,$sqlt) {
$safesql =& new SafeSQL_MySQL;
$cpquery = $safesql->query("select * from ".$sqlt."posts where CategoryID=%i and ForumID=%i", array($idc,$idf));
unset($safesql);
$cpresult=mysql_query($cpquery);
$cpnum=mysql_num_rows($cpresult);
return $cpnum;
}
function CountReplys($idc,$idf,$idt,$sqlt) {
$safesql =& new SafeSQL_MySQL;
$crquery = $safesql->query("select * from ".$sqlt."posts where CategoryID=%i and ForumID=%i and TopicID=%i", array($idc,$idf,$idt));
unset($safesql);
$crresult=mysql_query($crquery);
$crnum=mysql_num_rows($crresult);
return $crnum;
}
function GetUserName($idu,$sqlt) {
$safesql =& new SafeSQL_MySQL;
$gunquery = $safesql->query("select * from ".$sqlt."members where id=%i", array($idu));
unset($safesql);
$gunresult=mysql_query($gunquery);
$gunnum=mysql_num_rows($gunresult);
if($gunnum>0){
$UsersName=mysql_result($gunresult,$gunnum-1,"Name"); }
return $UsersName;
}
function CountTopics($idc,$idf,$sqlt) {
$safesql =& new SafeSQL_MySQL;
$ctquery = $safesql->query("select * from ".$sqlt."topics where CategoryID=%i and ForumID=%i", array($idc,$idf));
unset($safesql);
$ctresult=mysql_query($ctquery);
$ctnum=mysql_num_rows($ctresult);
return $ctnum;
}
function smf_md5_hmac($data, $key)
{
$key = str_pad(strlen($key) <= 64 ? $key : pack('H*', md5($key)), 64, chr(0x00));
return md5(($key ^ str_repeat(chr(0x5c), 64)) . pack('H*', md5(($key ^ str_repeat(chr(0x36), 64)). $data)));
}
function PassHash2x($Text)
{
$Text = md5($Text);
$Text = sha1($Text);
return $Text;
}
function hmac($key,$data,$hash='sha1',$blocksize=64) {
  if (strlen($key)>$blocksize) {
  $key=pack('H*',$hash($key)); }
  $key=str_pad($key, $blocksize, chr(0x00));
  $ipad=str_repeat(chr(0x36),$blocksize);
  $opad=str_repeat(chr(0x5c),$blocksize);
  return $hash(($key^$opad).pack('H*',$hash(($key^$ipad).$data)));
}
function PassHash2x2($Text,$data)
{
$Text = hmac($Text,$data,"md5");
$Text = hmac($Text,$data,"sha1");
return $Text;
}
function Redirect($url) {
       if(headers_sent()) {
               echo "<script type='text/javascript'>location.href='$url';</script>";
       } else {
               header("Location: $url");
       }
}
function GetQueryStr($Text)
{
$OldBoardQuery = preg_replace("/&/isxS", "&amp;", $_SERVER['QUERY_STRING']);
$BoardQuery = "?".$OldBoardQuery;
return $BoardQuery;
}
function dump_included_files($type)
{
	return var_dump(get_included_files());
}
function count_included_files($type)
{
	return count(get_included_files());
}
function dump_extensions($type)
{
	return var_dump(get_loaded_extensions());
}
function count_extensions($type)
{
	return count(get_loaded_extensions());
}
?>