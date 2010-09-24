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

    $FileInfo: webinstall.php - Last Update: 09/22/2010 Ver 2.9 - Author: cooldude2k $
*/
@ob_start();
$FTPURL = "ftp.berlios.de";
$FTPUSER = "anonymous";
$FTPPASS = "";
$FTPPATH = "/pub/idb/nighty-ver/";
$HTTPURL = "http://download.berlios.de/idb/";
require_once("./untar.php");
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
gunzip("./iDB.tar.gz","./iDB.tar");
unlink("./iDB.tar.gz");
untar("./iDB.tar","./"); 
unlink("./iDB.tar");
unlink("./untar.php");
unlink("./webinstall.php");
header("Location: ./index.php?act=view");
?>