<?php
header('Content-type: text/plain');
$thisdir = dirname(realpath("hash.php"))."/";
if ($handle = opendir($thisdir)) {
   while (false !== ($file = readdir($handle))) {
	   $thisfile = filetype($thisdir.$file);
	   if ($thisfile=="file") {
		   if ($file != "." && $file != "..") {
       $MD5Files = $MD5Files.md5_file($thisdir.$file)." *".$file."\n";
       $SHA1Files = $SHA1Files.sha1_file($thisdir.$file)." *".$file."\n"; } }
   }
   closedir($handle);
   $fp = fopen($thisdir."MD5.txt","w+");
   fwrite($fp, $MD5Files);
   fclose($fp);
   $fp = fopen($thisdir."SHA1.txt","w+");
   fwrite($fp, $SHA1Files);
   fclose($fp);
   echo "MD5 Values\n";
   require(dirname(realpath("Hash.php")).'/MD5.txt');
   echo "\nSHA1 Values\n";
   require(dirname(realpath("Hash.php")).'/SHA1.txt');
} ?>