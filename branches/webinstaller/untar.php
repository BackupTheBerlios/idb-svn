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

    $FileInfo: untar.php - Last Update: 09/23/2010 Ver 3.0 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="untar.php"||$File3Name=="/untar.php") {
    header('Location: ./webinstall.php');
    exit(); }
// PHP iUnTAR Version 3.0
function untar($tarfile,$outdir="./",$chmod=null) {
$TarSize = filesize($tarfile);
$TarSizeEnd = $TarSize - 1024;
if($outdir!=""&&!file_exists($outdir)) {
	mkdir($outdir,0777); }
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
	$LinkedFile = trim(fread($thandle,100));
	fseek($thandle,255,SEEK_CUR);
	if($FileType=="0") {
		$FileContent = fread($thandle,$FileSize); }
	if($FileType=="1") {
		$FileContent = null; }
	if($FileType=="2") {
		$FileContent = null; }
	if($FileType=="5") {
		$FileContent = null; }
	if($FileType=="0") {
		$subhandle = fopen($FileName, "a+");
		fwrite($subhandle,$FileContent,$FileSize);
		fclose($subhandle); 
		chmod($FileName,$FileCHMOD); }
	if($FileType=="1") {
		link($FileName,$LinkedFile); }
	if($FileType=="2") {
		symlink($LinkedFile,$FileName); }
	if($FileType=="5") {
		mkdir($FileName,$FileCHMOD); }
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
?>