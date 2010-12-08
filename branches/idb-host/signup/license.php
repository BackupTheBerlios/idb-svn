<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2011 iDB Support - http://idb.berlios.de/
    Copyright 2004-2011 Game Maker 2k - http://gamemaker2k.org/
    iDB Installer made by Game Maker 2k - http://idb.berlios.net/

    $FileInfo: license.php - Last Update: 12/07/2010 SVN 600 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="presetup.php"||$File3Name=="/presetup.php") {
	require('index.php');
	exit(); }
if(!isset($SetupDir['setup'])) { $SetupDir['setup'] = "setup/"; }
if(!isset($SetupDir['convert'])) { $SetupDir['convert'] = null; }
if(isset($_GET['unixname'])&&
	file_exists($_GET['unixname']."_settings.php")) {
	$_GET['unixname'] = "idb"; }
if(isset($_GET['unixname'])&&
	!file_exists($_GET['unixname']."_settings.php")) {
$_GET['unixname'] = preg_replace("/[^A-Za-z0-9_$]/", "", $_GET['unixname']); }
if(!isset($_GET['unixname'])) {
	$_GET['unixname'] = "idb"; }
?>
<tr class="TableRow3">
<td class="TableColumn3">
<form style="display: inline;" method="post" id="install" action="signup.php?act=Part2">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 50%;"><label class="TextBoxLabel" for="LicenseBox">License - Please read fully and check 'I agree' box ONLY if you agree to license</label><br />
	<textarea rows="34" id="LicenseBox" name="LicenseBox" class="TextBox" cols="79" readonly="readonly" accesskey="L">
	<?php echo stripcslashes(htmlspecialchars(file_get_contents("LICENSE"), ENT_QUOTES, $Settings['charset'])); ?></textarea><br />
	<input type="checkbox" class="TextBox" name="License" value="Agree" id="License" /><label class="TextBoxLabel" for="License">I Agree</label><br/></td>
</tr></table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<?php if($ConvertInfo['ConvertFile']==null) { ?>
<input type="hidden" name="SetupType" value="install" style="display: none;" />
<?php } ?>
<input type="hidden" name="act" value="Part2" style="display: none;" />
<input type="hidden" name="unixname" value="<?php echo $_GET['unixname']; ?>" style="display: none;" />
<input type="submit" class="Button" value="Next Page" name="Install_Board" />
<input type="reset" value="Reset Form" class="Button" name="Reset_Form" />
</td></tr></table>
</form>
</td>
</tr>
