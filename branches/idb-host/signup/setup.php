<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2009 iDB Support - http://idb.berlios.de/
    Copyright 2004-2009 Game Maker 2k - http://gamemaker2k.org/
    iDB Installer made by Game Maker 2k - http://idb.berlios.net/

    $FileInfo: setup.php - Last Update: 11/14/2009 SVN 344 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="setup.php"||$File3Name=="/setup.php") {
	require('index.php');
	exit(); }
if(!isset($SetupDir['setup'])) { $SetupDir['setup'] = "signup/"; }
if(!isset($SetupDir['convert'])) { $SetupDir['convert'] = null; }
?>
<tr class="TableRow3">
<td class="TableColumn3">
<?php
require('settings.php');
if(!isset($Settings['sqldb'])) { echo "<span class=\"TableMessage\">";
	echo "<br />Sorry you can not signup yet.<br />\n</span>\n"; $Error="Yes"; }
if($_POST['License']!="Agree") { echo "<span class=\"TableMessage\">";
	echo "<br />You need to agree to the tos.<br />\n</span>\n"; $Error="Yes"; }
$StatSQL = @mysql_connect($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass']);
if(!$StatSQL) { $Error="Yes"; echo "<span class=\"TableMessage\">";
echo "<br />".mysql_errno().": ".mysql_error()."<br />\n</span>\n"; }
if ($Error!="Yes") {
?>
<form style="display: inline;" method="post" id="install" action="signup.php?act=Part3">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 50%;"><label class="TextBoxLabel" for="NewBoardName">Insert Board Name:</label></td>
	<td style="width: 50%;"><input type="text" name="NewBoardName" class="TextBox" id="NewBoardName" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="unixname">Insert Board URL PreFix:<br /></label></td>
	<td style="width: 50%;"><input type="text" name="unixname" class="TextBox" id="unixname" value="cool" size="20" /></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="AdminUser">Insert Admin User Name:</label></td>
	<td style="width: 50%;"><input type="text" name="AdminUser" class="TextBox" id="AdminUser" size="20" /></td>
</tr><tr>
	<td style="width: 30%;"><label class="TextBoxLabel" for="AdminEmail">Insert Admin Email:</label></td>
	<td style="width: 70%;"><input type="text" class="TextBox" name="AdminEmail" size="20" id="AdminEmail" /></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="AdminPassword">Insert Admin Password:</label></td>
	<td style="width: 50%;"><input type="password" name="AdminPasswords" class="TextBox" id="AdminPassword" size="20" maxlength="30" /></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="ReaPassword">ReInsert Admin Password:</label></td>
	<td style="width: 50%;"><input type="password" class="TextBox" name="ReaPassword" size="20" id="ReaPassword" maxlength="30" /></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="WebURL">Insert The WebSite URL:</label></td>
	<td style="width: 50%;"><input type="text" class="TextBox" name="WebURL" size="20" id="WebURL" value="<?php echo $prehost.$_SERVER['HTTP_HOST']."/"; ?>" /></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" title="Store userinfo as a cookie so you dont need to login again." for="storecookie">Store as cookie?</label></td>
	<td style="width: 50%;"><select id="storecookie" name="storecookie" class="TextBox">
<option value="true">Yes</option>
<option value="false">No</option>
</select></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel"" for="usehashtype">Hash user passwords with?</label></td>
	<td style="width: 50%;"><select id="usehashtype" name="usehashtype" class="TextBox">
<option value="sha256">SHA256</option>
<option value="sha1">SHA1</option>
<option value="md5">MD5</option>
<?php // PHP 5 hash algorithms to functions :o 
if(function_exists('hash')&&function_exists('hash_algos')) {
if(in_array("md2",hash_algos())) { ?>
<option value="md2">MD2</option>
<?php } if(in_array("md4",hash_algos())) { ?>
<option value="md4">MD4</option>
<?php } if(in_array("sha384",hash_algos())) { ?>
<option value="sha384">SHA386</option>
<?php } if(in_array("sha512",hash_algos())) { ?>
<option value="sha512">SHA512</option>
<?php } } ?>
</select></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="YourOffSet">Your TimeZone:</label></td>
	<td style="width: 50%;"><select id="YourOffSet" name="YourOffSet" class="TextBox"><?php
if(date("I")!=1) { $myofftime = SeverOffSet(); $mydstime = "off"; }
if(date("I")==1) { $myofftime = SeverOffSet()-1; $mydstime = "on"; }
$plusi = 1; $minusi = 12;
$plusnum = 15; $minusnum = 0;
while ($minusi > $minusnum) {
if($myofftime==-$minusi) {
echo "<option selected=\"selected\" value=\"-".$minusi."\">GMT - ".$minusi.":00 hours</option>\n"; }
if($myofftime!=-$minusi) {
echo "<option value=\"-".$minusi."\">GMT - ".$minusi.":00 hours</option>\n"; }
--$minusi; }
if($myofftime==0) { ?>
<option selected="selected" value="0">GMT +/- 0:00 hours</option>
<?php } if($myofftime!=0) { ?>
<option value="0">GMT +/- 0:00 hours</option>
<?php }
while ($plusi < $plusnum) {
if($myofftime==$plusi) {
echo "<option selected=\"selected\" value=\"".$plusi."\">GMT + ".$plusi.":00 hours</option>\n"; }
if($myofftime!=$plusi) {
echo "<option value=\"".$plusi."\">GMT + ".$plusi.":00 hours</option>\n"; }
++$plusi; }
?></select></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="MinOffSet">Minute OffSet:</label></td>
	<td style="width: 50%;"><select id="MinOffSet" name="MinOffSet" class="TextBox"><?php
$mini = 0; $minnum = 60;
while ($mini < $minnum) {
if(strlen($mini)==2) { $showmin = $mini; }
if(strlen($mini)==1) { $showmin = "0".$mini; }
if($mini==0) {
echo "\n<option selected=\"selected\" value=\"".$showmin."\">0:".$showmin." minutes</option>\n"; }
if($mini!=0) {
echo "<option value=\"".$showmin."\">0:".$showmin." minutes</option>\n"; }
++$mini; }
?></select></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="DST">Is <span title="Daylight Savings Time">DST</span> / <span title="Summer Time">ST</span> on or off:</label></td>
	<td style="width: 50%;"><select id="DST" name="DST" class="TextBox"><?php echo "\n" ?>
<?php if($mydstime=="off"||$mydstime!="on") { ?>
<option selected="selected" value="off">off</option><?php echo "\n" ?><option value="on">on</option>
<?php } if($mydstime=="on") { ?>
<option selected="selected" value="on">on</option><?php echo "\n" ?><option value="off">off</option>
<?php } echo "\n" ?></select></td>
</tr><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="TestReferer">Test Referering URL with host name:</label></td>
	<td style="width: 50%;"><select id="TestReferer" name="TestReferer" class="TextBox">
<option selected="selected" value="off">off</option>
<option value="on">on</option>
</select></td>
</tr></table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<input type="hidden" name="SetupType" value="install" style="display: none;" />
<input type="hidden" name="act" value="Part3" style="display: none;" />
<input type="submit" class="Button" value="Install Board" name="Install_Board" />
<input type="reset" value="Reset Form" class="Button" name="Reset_Form" />
</td></tr></table>
</form>
</td>
</tr>
<?php } ?>
