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

    $FileInfo: webinstall.php - Last Update: 09/22/2010 Ver 2.8 - Author: cooldude2k $
*/
@ob_start();
$FTPURL = "ftp.berlios.de";
$FTPUSER = "anonymous";
$FTPPASS = "";
$FTPPATH = "/pub/idb/nighty-ver/";
$HTTPURL = "http://download.berlios.de/idb/";
// PHP iUnTAR Version 2.8
function untar($tarfile,$outdir="./",$chmod=null) {
$TarSize = filesize($tarfile);
$TarSizeEnd = $TarSize - 1024;
if($outdir!=""&&!file_exists($outdir)) {
	mkdir($outdir,0777,true); }
$thandle = fopen($tarfile, "r");
while (ftell($thandle)<$TarSizeEnd) {
	$FileName = $outdir.trim(fread($thandle,100));
	$FileMode = trim(fread($thandle,8));
	if($chmod===null) {
		$FileCHMOD = octdec("0".substr($FileMode,-3)); }
	if($chmod!==null) {
		$FileCHMOD = $chmod; }
	$OwnerID = trim(fread($thandle,8));
	$GroupID = trim(fread($thandle,8));
	$FileSize = octdec(trim(fread($thandle,12)));
	$LastEdit = trim(fread($thandle,12));
	$Checksum = trim(fread($thandle,8));
	$FileType = trim(fread($thandle,1));
	fseek($thandle,355,SEEK_CUR);
	if($FileType=="0") {
		$FileContent = fread($thandle,$FileSize); }
	if($FileType=="5") {
		$FileContent = null; }
	if($FileType=="0") {
		$subhandle = fopen($FileName, "a+");
		fwrite($subhandle,$FileContent,$FileSize);
		fclose($subhandle); 
		chmod($FileName,$FileCHMOD); }
	if($FileType=="5") {
		mkdir($FileName,$FileCHMOD,true); }
	//touch($FileName,$LastEdit);
	if($FileType=="0") {
		$CheckSize = 512;
		while ($CheckSize<$FileSize) {
			if($CheckSize<$FileSize) {
			$CheckSize = $CheckSize + 512; } }
		$SeekSize = $CheckSize - $FileSize;
		fseek($thandle,$SeekSize,SEEK_CUR); } }
	fclose($thandle); 
	return true; }
//Check if zlib is loaded
if(extension_loaded("zlib")) {
function gunzip($infile, $outfile) {
  $string = null;
  $zp = gzopen($infile, "r");
  while(!gzeof($zp))
       $string .= gzread($zp, 4096);
  gzclose($zp);
  $fp = fopen($outfile, "w");
  fwrite($fp, $string, strlen($string));
  fclose($fp);
}
function gunzip2($infile, $outfile) {
 $string = implode("", gzfile($infile));
 $fp = fopen($outfile, "w");
 fwrite($fp, $string, strlen($string));
 fclose($fp);
} }
$mydir = addslashes(str_replace("\\","/",dirname(__FILE__)."/"));
$conn_id = ftp_connect($FTPURL,21,90);
$login_result = ftp_login($conn_id, $FTPUSER, $FTPPASS);
if((!$conn_id)||(!$login_result)) { 
$tarhandle = fopen("./iDB.tar.gz", "a+");
fwrite($tarhandle,file_get_contents($HTTPURL."iDB.tar.gz"));
fclose($tarhandle);
chmod("./iDB.tar.gz",0777);
} else {
ftp_pasv($conn_id, true);
ftp_chdir($conn_id, $FTPPATH);
ftp_get($conn_id, "./iDB.tar.gz", "./iDB.tar.gz", FTP_BINARY);
ftp_close($conn_id); }
gunzip("iDB.tar.gz","iDB.tar");
unlink("iDB.tar.gz");
untar("./iDB.tar","./"); 
unlink("iDB.tar");
unlink("webinstall.php");
header("Location: ./index.php?act=view");
?>