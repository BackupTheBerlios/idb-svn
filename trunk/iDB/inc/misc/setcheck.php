<?php
if($Settings['DefaultTheme']==null) {
	$Settings['DefaultTheme'] = "iDB"; }
if($Settings['DefaultTimeZone']==null) {
	$Settings['DefaultTimeZone'] = SeverOffSet(null); }
if(!is_numeric($Settings['DefaultTimeZone'])) {
	$Settings['DefaultTimeZone'] = SeverOffSet(null); }
if($Settings['DefaultDST']!="on"&&
	$Settings['DefaultDST']!="off") { 
	$Settings['DefaultDST'] = "off"; }
if($Settings['DefaultTheme']!=null) {
if (file_exists("themes/".$Settings['DefaultTheme']."/settings.php")) {
/* The file Skin Exists */ }
else { $Settings['DefaultTheme']="iDB";
/* The file Skin Dose Not Exists */ } }
if($Settings['TestReferer']!=true&&
	$Settings['TestReferer']!=false) {
	$Settings['TestReferer'] = false; }
if($Settings['charset']==null) {
	$Settings['charset'] = "iso-8859-15"; }
if($Settings['qstr']==null) {
	$Settings['qstr'] = "&"; }
if($Settings['qsep']==null) {
	$Settings['qsep'] = "="; }
if($Settings['qsep']=="#"||
	$Settings['qstr']=="#") {
	$Settings['qstr'] = "&";
	$Settings['qsep'] = "="; }
if($Settings['qsep']==$Settings['qstr']) {
	$Settings['qstr'] = "&";
	$Settings['qsep'] = "="; }
if($Settings['qstr']=="/"||
	$Settings['qstr']=="&") {
	$Settings['qsep'] = "="; }
if($Settings['qstr']!="&"&&
	$Settings['qstr']!="/") {
@qstring($Settings['qstr'],$Settings['qsep']); }
if($Settings['file_ext']==null) {
	$Settings['file_ext'] = ".php"; }
if($Settings['rss_ext']==null) {
	$Settings['rss_ext'] = ".php"; }
if($Settings['js_ext']==null) {
	$Settings['js_ext'] = ".js"; }
if($Settings['add_power_by']==true) {
$idbpowertitle = " (Powered by ".$iDB.")";
$itbpowertitle = " (Powered by ".$iTB.")"; }
if($Settings['add_power_by']!=true) {
$idbpowertitle = null;
$itbpowertitle = null; }
if($Settings['GuestGroup']==null) {
	$Settings['GuestGroup'] = "Guest"; }
if($Settings['MemberGroup']==null) {
	$Settings['MemberGroup'] = "Member"; }
if($Settings['ValidateGroup']==null&&
	$Settings['AdminValidate']==true) {
$Settings['ValidateGroup'] = "Validate"; }
if($Settings['fixpathinfo']==null) {
	$Settings['fixpathinfo'] = false; }
if($Settings['fixbasedir']==null) {
	$Settings['fixbasedir'] = false; }
if ($_GET['act']=="iDBInfo") { @header('Location: http://developer.berlios.de/projects/idb/'); }
if ($_GET['act']=="iDBSite") { @header('Location: http://idb.berlios.de/'); }
if ($_GET['act']=="GM2kSite") { @header('Location: http://upload.idb.s1.jcink.com/'); }
/*if($_GET['debug']=="true"||$_GET['debug']=="on") {
	output_add_rewrite_var("amp;debug",$_GET['debug']); }*/
if ($_GET['act']==null&&$_GET['action']!=null) { $_GET['act']=$_GET['action']; }
if ($_GET['act']==null&&$_GET['activity']!=null) { $_GET['act']=$_GET['activity']; }
if ($_GET['act']==null&&$_GET['function']!=null) { $_GET['act']=$_GET['function']; }
if ($_GET['act']==null&&$_GET['mode']!=null) { $_GET['act']=$_GET['mode']; }
if ($_GET['act']==null&&$_GET['show']!=null) { $_GET['act']=$_GET['show']; }
if ($_GET['act']==null&&$_GET['do']!=null) { $_GET['act']=$_GET['do']; }
if ($_GET['act']=="idx"||$_GET['act']=="View") { $_GET['act']="view"; }
?>