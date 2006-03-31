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
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="Preindex.php"||$File3Name=="/Preindex.php") {
	require('inc/403.html');
	exit(); }
$thisdir = dirname(realpath("Preindex.php"))."/";
require('MySQL.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta http-equiv="content-language" content="en-US" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15" />
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="null" />
<meta name="Keywords" content="null" />
<meta name="Description" content="null" />
<meta name="ROBOTS" content="Index, FOLLOW" />
<meta name="revisit-after" content="1 days" />
<meta name="GOOGLEBOT" content="Index, FOLLOW" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<?php echo $SkinSet['CSSHTML']."\n"; ?>
<script type="text/javascript" src="misc/KernelJS.php"></script>